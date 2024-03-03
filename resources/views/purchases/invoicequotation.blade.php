@extends('printer')

<style>
	thead tr th{
		text-align: center;
		font-size: 14px !important;
	}

	tbody tr td{
		font-size: 13px !important;
	}
</style>

@section('main-content')
	<section class="invoice">
	    <div class="row">
	      <div class="col-sm-4" style="margin-left: 20px; padding: 20px; ">
	          @if(!empty(settings('site_logo')))
              	<img src="{!! asset('uploads/site/'.settings('site_logo')) !!}" style="height: 84px; width: 190px;">
              @else
                <h4>{{settings('site_name')}}</h4>
                <p>
                	{{ trans('core.phone') }}:
		          	{{ bangla_digit(settings('phone'))}}
		        </p>
		        <p>
		          	{{ bangla_digit(settings('address'))}}
		        </p>
              @endif
	      </div>
	       <div class="col-sm-3">
	        <h3 class="" style="text-align: center;  padding: 20px; font-weight: bolder;">
	           	Cotización
	          	<br>
	        </h3>
	        <p class="" style="text-align: center; ">
	          <b>Nombre de Cliente:  </b>	
	          <b>
                    @php
                            $quotationc= DB::table('clients')
                                      ->join('quotations','clients.id','=','quotations.client_id')
                                      ->select('clients.first_name as nombre')
                                      ->where('clients.id','=', $quotation->client_id)
                                      ->get();
                    @endphp

                    {{ 

                        $quotationc[0]->nombre

                    }}
	      	  </b>
	        </p>
	      </div>

	       <div class="col-sm-4" style="margin-left: 20px; padding: 20px;">
	          <table class="table table-bordered">
	          	 <tr>
	          	 	<td>
	          	 		{{trans('core.date')}} : {{$quotation->date}}
	          	 	</td>
	          	 </tr>
	          </table>
	      </div>
	      <!-- /.col -->
	    </div> 
	    <!-- header row ends-->

	    <div class="row" >
	      <div class="col-sm-12 table-responsive" style="margin-left: 0px; ">
	        <table class="table table-bordered">
	          <thead style="background-color: #FFF !important;color: black !important;">
	          <tr>
	          	<th width="5%">{{ trans('core.si_no') }}</th>
	            <th width="15%">{{ trans('core.name') }}</th>
	            <th width="15%">{{ trans('core.unit_price') }}</th>
	            <th width="15%">{{ trans('core.quantity') }}</th>
	            <th width="20%">{{ trans('core.sub_total') }}</th>
	          </tr>
	          </thead>      
	          <tbody>
              <?php $total=0; ?>
	          @foreach ($quotationd as $det)
	          <tr>
	              <td>{{$det->id}}</td>
	              <td style="text-align:center;">
	              	{{$det->name}}
	              </td>
	              <td style="text-align:center;">
	              	{{$det->mrp}}
	              </td>
	              <td style="text-align:center;">
	              	{{$det->quantity}}
	              </td>
	              <td style="text-align:center;">
	              	{{$det->subtotal}}
	              	<?php $total= $total + $det->subtotal ?>
	              </td>
	          </tr>
	          @endforeach
	          </tbody>
	          <tfoot>
	           <tr style="background-color: #F8FCD4;">
          			<td>&nbsp;</td>
          			<td>&nbsp;</td>
          			<td>&nbsp;</td>
          			<td><b>{{trans('core.total')}}</b></td>
          			<td><b>{{$total}}</b></td>
          	   </tr>
          	  </tfoot> 
	        </table>
	      </div>
	      <!-- /.col -->
	    </div>
	    <!-- /.row -->

	    <div class="row">
	    	<div class="col-md-12" style="margin-left: 20px;">
		    	<!--<span class="amount-in-words">
			    	{{trans('core.amount')}} (In Words)
			        <br>
			    	<br>
			    	<br>
			    </span>-->
	    	</div>
	    </div>

	    <div class="row">
	    	<!--<div class="col-sm-5" style="margin-left: 20px;">
	          	<span class="declaration_header">
	          		{{trans('core.declaration')}}
	          	</span>
	          	<br>
	          		{{trans('core.declaration_text')}}
		    	<br>
		    	<br><br>
		    	<span class="customer-signature">
		    		{{trans('core.supplier_seal')}}:
		    	</span>
		    	<br><br><br>
	        </div>-->

	        <div class="col-sm-offset-2 col-sm-4 pull-right" >
	          	<span>&nbsp;</span>
	    		<br><br><br>
	    		Por <b>{{settings('site_name')}}</b>
	    		<br><br>
	    		<!--{{trans('core.authorized_signature')}}-->
	        </div>
	    </div>
  	</section>
	
@stop