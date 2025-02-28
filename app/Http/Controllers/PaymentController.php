<?php
namespace App\Http\Controllers;

use App\Client;
use App\Payment;
use Carbon\Carbon;
use App\Transaction;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $searchParams = ['receipt_no', 'invoice_no', 'client', 'type', 'from', 'to', 'method'];

    public function getIndex(Request $request)
    {
        $clients = Client::pluck('first_name', 'id');
        $type = ['debit' => 'Debit', 'credit' => 'Credit', 'return' => 'Return'];
        $methods = ['cash' => 'Cash', 'card' => 'Card', 'cheque' => 'Cheque', 'others' => 'Others', ];

        $payments = Payment::orderBy('id', 'desc');

        if($request->get('receipt_no')) {
            $str = ltrim($request->get('receipt_no'), '0');
            $payments->whereId($str);
        }

        if($request->get('invoice_no')) {
            $payments->where('reference_no', 'LIKE', '%' . $request->get('invoice_no') . '%');
        }

        if($request->get('client')) {
            $payments->whereClientId($request->get('client'));
        }

        if($request->get('type')) {
            $payments->whereType($request->get('type'));
        }

        if($request->get('method')) {
            $payments->whereMethod($request->get('method'));
        }

        $from = $request->get('from');
        $to = $request->get('to')?:date('Y-m-d');
        $to = Carbon::createFromFormat('Y-m-d',$to);
        $to = filterTo($to);

        if($request->get('from') || $request->get('to')) {
            if(!is_null($from)){
                $from = Carbon::createFromFormat('Y-m-d',$from);
                $from = filterFrom($from);
                $payments->whereBetween('created_at',[$from,$to]);
            }else{
                $payments->where('created_at','<=',$to);
            }
        }

        $cloneForDebit = clone $payments;
        $cloneForCredit = clone $payments;
        $cloneForReturn = clone $payments;

        $total_debit = $cloneForDebit->whereType('debit')->sum('amount');
        $total_credit = $cloneForCredit->whereType('credit')->sum('amount');
        $total_return = $cloneForReturn->whereType('return')->sum('amount');

        if($request->get('print')){
            $printable_payments = $payments->get();
            return view('payments.print-payment-list', compact('printable_payments','total_debit', 'total_credit', 'total_return','from', 'to'));
        }

        return view('payments.list')
                ->withClients($clients)
                ->withType($type)
                ->with('total_debit',$total_debit)
                ->with('total_credit',$total_credit)
                ->with('total_return',$total_return)
                ->with('methods', $methods)
                ->withPayments($payments->paginate(20));
    }

    /**
     * post of paymentList.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postIndex(Request $request) {
        $params = array_filter($request->only($this->searchParams));
        return redirect()->action('PaymentController@getIndex', $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postPayment(Request $request)
    {
        if($request->get('invoice_payment') == 1){
            //direct invoice-wise payment starts
            $ref_no = $request->get('reference_no');
            $transaction = Transaction::where('reference_no', $ref_no)->first();
            $previously_paid = $transaction->paid;
            $transaction->paid = round(($previously_paid + $request->get('amount')), 2);
            $transaction->save();

            //saving paid amount into payment table
            $payment = new Payment;
                $payment->client_id = $request->get('client_id');
                $payment->amount = round($request->get('amount'),2);
                $payment->method = $request->get('method');
                $payment->type = $request->get('type');
                if($request->get('reference_no')){
                    $payment->reference_no = $request->get('reference_no');
                }
                $payment->note = $request->get('note');
                $payment->date = Carbon::parse($request->get('date'))->format('Y-m-d H:i:s');
            $payment->save();

        }else{
            //client-wise payment starts
            $amount = round($request->get('amount'), 2);
            $client_id = $request->get('client_id');
            $client = Client::find($client_id);
            
            foreach($client->transactions as $transaction){
                $due = round(($transaction->net_total - $transaction->paid), 2);
                $previously_paid = $transaction->paid;
                if($due >= 0 && $amount > 0){
                    if($amount > $due){
                        $restAmount = $amount - $due;
                        $transaction->paid = $due + $previously_paid;
                        $transaction->save();

                        //payment
                        $payment = new Payment;
                        $payment->client_id = $client_id;
                        $payment->amount = $due;
                        $payment->method = $request->get('method');
                        $payment->type = $request->get('type');
                        $payment->reference_no = $transaction->reference_no;
                        
                        $payment->note = $request->get('note');
                        $payment->date = Carbon::parse($request->get('date'))->format('Y-m-d H:i:s');
                        $payment->save();

                    }else{
                        $restAmount = 0;
                        $transaction->paid = $amount + $previously_paid;
                        $transaction->save();

                        //payment
                        $payment = new Payment;
                        $payment->client_id = $client_id;
                        $payment->amount = $amount;
                        $payment->method = $request->get('method');
                        $payment->type = $request->get('type');
                        $payment->reference_no = $transaction->reference_no;
                        
                        $payment->note = $request->get('note');
                        $payment->date = Carbon::parse($request->get('date'))->format('Y-m-d H:i:s');
                        $payment->save();
                    }

                    $amount = $restAmount;
                }
                if($amount <= 0){
                    break;
                }
            }
            //client-wise payment ends   
        }
        
        $message = trans('core.payment_received');
        return redirect()->back()->withSuccess($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function printReceipt(Payment $payment)
    {
        return view('payments.receipt-print', compact('payment'));
    }
  
  
   //REQUERIMIENTO VICTOR

    private $parametros = ['from', 'to'];

    public function getList(Request $request)
    {

        $from = $request->get('from');
        $to = $request->get('to')?:date('Y-m-d');
        $to = Carbon::createFromFormat('Y-m-d',$to);
        $to = filterTo($to);

        $clients = Client::all();

        /*$payments = DB::table('payments')
                     ->select('client_id',DB::raw("SUM(payments.amount) as amount"))
                     ->groupBy('client_id')
                     ->orderBy('amount', 'desc');*/
      
      
      
      $payments = DB::table('payments')
                  ->join('clients', 'payments.client_id', '=', 'clients.id')
                  ->select('payments.client_id', DB::raw("SUM(payments.amount) as amount"))
                  ->where('clients.client_type', 'retailer')
                  ->groupBy('payments.client_id')
                  ->orderBy('amount', 'desc');

      
        /*$payments = DB::table('sells')
                     ->select('client_id',DB::raw("SUM(sells.sub_total) as amount"))
                     ->groupBy('client_id')
                     ->orderBy('amount', 'desc');  */           

        if($request->get('from') || $request->get('to')) {
            if(!is_null($from)){
                $from = Carbon::createFromFormat('Y-m-d',$from);
                $from = filterFrom($from);
                $payments->whereBetween('payments.created_at',[$from,$to]);
                $payments->where('payments.deleted_at','=',NULL);
            }else{

                $payments->where('payments.created_at','<=',$to);
            }
        }


  

        return view('payments.list_client_sell')
                ->withClients($clients)
                ->withPayments($payments->paginate(40));
    }  
  
      public function postList(Request $request) {
        $paramss = array_filter($request->only($this->parametros));
        return redirect()->action('PaymentController@getList', $paramss);
     }
  
  
  
  
}
