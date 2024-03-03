@extends('layouts.pos')

@section('title')
	@parent :: POS
@stop

@section('css')
	<link rel="stylesheet" href="/assets/css-core/pos-invoice.css">
@stop

@section('main-content')
	<div >
	   <div id="printableArea">
		<div id="row">
			<!--<div id="invoice-POS">-->
		    <div id="top" style="border-bottom: 1px solid #EEE; margin-bottom: 8px;">
			    <center>
			      <!--<div class="logo" style="background: url({{asset('uploads/site/'.settings('site_logo')) }}) no-repeat">
			      </div>-->
			      <img src="{{asset('uploads/site/'.settings('site_logo')) }}">
			      <div class="info"> 
			        <h2>
			        	<b>{{settings('site_name')}}</b>
			        </h2>
			        <p> 
			            {{trans('core.address')}}: 
			            {{settings('address')}}
			            <br>
			            {{trans('core.email')}}: 
			            {{settings('email')}}
			            <br>
			            {{trans('core.phone')}}: 
			            {{settings('phone')}}
			            <br><br>
			        </p>
			      </div><!--End Info-->
			    </center>

			    <div class="row ref">
			    	<div class="col-md-12">
			    		<strong>Nota de Entrega: </strong>
			    		{{$transaction->reference_no}}
			    	</div>
			    	<div class="col-md-12">
			    		Fecha:
                        {{ date('d/m/Y h:i A', strtotime($transaction->created_at)) }}
			    		<!--{{carbonDate($transaction->created_at, '')}}-->
			    	</div>
			    	@foreach($clients as $row)
			    	 @if($row->id == $transaction->client_id)
				    	<div class="col-md-12">
				    		Cliente: {{$row->first_name}}
				    	</div>
				    	<div class="col-md-12">
				    		CI/RIF: {{$row->last_name}}
				    	</div>
				    	<div class="col-md-12">
				    		Dirección:{{$row->address}}
				    	</div>
				    	<div class="col-md-12">
				    		TELÉFONO:{{$row->phone}}
				    	</div>                  
				     @endif
			    	@endforeach
			    </div>
			</div>
			<!--End InvoiceTop-->
		      
	    
	    	<div id="bot">
				<div id="table">
					<table class="table table-bordered">
						<tr class="tabletitle" >
							<td class="text-center">
								<span class="table-header">Item</span>
							</td>
							<td class="text-center">
								<span class="table-header">Cant</span>
							</td>
							<td class="text-center">
								<span class="table-header">Precio</span>
							</td>
							<td class="text-center">
								<span class="table-header">Sub Total</span>
							</td>
						</tr>
                        <?php $subtotal=0; ?>  

						@foreach($transaction->sells as $sell)
						<tr class="service">
							<td class="tableitem">
								<p class="itemtext">{{$sell->product->name}}</p>
							</td>
							<td class="tableitem">
								<p class="itemtext">{{$sell->quantity}}</p>
							</td>
							<td class="tableitem">
								<p class="itemtext">
									@if($sell->quantity > 0)
										{{ number_format(($sell->sub_total * $dolar / $sell->quantity),2,",",".") }}
									@else
										0
									@endif
								</p>
							</td>
							<td class="tableitem">
								<p class="itemtext">
									<!-- {{settings('currency_code')}} -->
									{{ number_format((($sell->sub_total * $dolar)),2,",",".")   }}
								</p>
							</td>
							<?php  $subtotal = twoPlaceDecimal($subtotal + $sell->sub_total); ?> 
						</tr>
						@endforeach

						<!--<tr class="tabletitle">
							<td class="Rate text-right" colspan="3">
								<span class="table-footer">IVA: &nbsp;&nbsp;</span class="table-footer">
								<span class="table-footer">{{trans('core.total')}}: &nbsp;&nbsp;</span class="table-footer">
							</td>
							<td class="payment">
								<span class="table-footer">
									 {{settings('currency_code')}} 
									{{ number_format((($transaction->total * $dolar) * 16 / 100),2,",",".")  }}
								</span class="table-footer">
							</td>
						</tr>-->

						<tr class="tabletitle">
							<td class="Rate text-right" colspan="3">
								<span class="table-footer">SubTotal: &nbsp;&nbsp;</span class="table-footer">
								<!--<span class="table-footer">ddd{{trans('core.net_total')}}: &nbsp;&nbsp;</span class="table-footer">	-->								
							</td>
							<td class="payment">
								<span class="table-footer">
									<!-- {{settings('currency_code')}} -->
									 {{number_format((($subtotal * $dolar)),2,",",".") }}
								</span class="table-footer">
							</td>
						</tr>	
						<?php $porcentaje = 0;
                            $porcentaje = ($transaction->discount) * 100 / $subtotal ;
						?>

						<tr class="tabletitle" style="font-size: 11px;">
							<td class="Rate text-right" colspan="3">
								<span >DESCUENTO: {{ $porcentaje }} % &nbsp;&nbsp;</span class="table-footer">
							</td>
							<td class="payment">
								<span >
									$
									{{ number_format(($transaction->discount * $dolar),2,",",".") }}
								</span class="table-footer">
							</td>
						</tr>   


						<tr class="tabletitle">
							<td class="Rate text-right" colspan="3">
								<span class="table-footer">Total: &nbsp;&nbsp;</span class="table-footer">
								<!--<span class="table-footer">ddd{{trans('core.net_total')}}: &nbsp;&nbsp;</span class="table-footer">	-->								
							</td>
							<td class="payment">
								<span class="table-footer">
									<!-- {{settings('currency_code')}} -->
									 {{ number_format(($transaction->net_total * $dolar),2,",",".") }}
								</span class="table-footer">
							</td>
						</tr>		
										                   
                        <!-- CODIGO PERSONALIZADO
						<tr class="tabletitle"> 
							<td class="Rate text-right" colspan="3">
								<span class="table-footer">Monto Referencial BVC: &nbsp;&nbsp;</span class="table-footer">
							</td>
							<td class="payment">
								<span class="table-footer">
 										
 										{{ number_format((($transaction->net_total * $dolar)),2,",",".")  }}
								</span class="table-footer">
							</td>
						</tr>--> 
                         
                        <!-- CODIGO REAL --> 
						<!--<tr class="tabletitle">
							<td class="Rate text-right" colspan="3">
								<span class="table-footer">Monto Referencial : &nbsp;&nbsp;</span class="table-footer">
							</td>
							<td class="payment">
								<span class="table-footer">
 										
 										{{ number_format((($transaction->net_total)),2,",",".")  }}
								</span class="table-footer">
							</td>
						</tr>-->

					</table>
				</div><!--End Table-->

				<div id="legalcopy" style="padding-bottom: 10px;">
					<span class="table-footer">
						<strong>Gracias por su compra!</strong>  
						<br>
						 {{settings('pos_invoice_footer_text')}}
					</span>
				</div>

			</div><!--End InvoiceBot-->

			<!--<div style="text-align: center;  font-size: 10px; color: black;">
				Credito a 4 días
				<br>
				Pago en bolívares al cambio del día según página monitor dolar
			</div>-->
	  	</div><!--End Invoice-->
  	</div> <!--Printable Div Ends-->

  	<div class="invoice-pos-footer">
  		<div class="row">
  			<div class="col-md-6">
  				<a class="btn btn-success btn-block" onclick="printDiv('printableArea')" >
  					{{trans('core.print')}}
  					<i class="fa fa-print"></i>
  				</a>
  			</div>

  			<div class="col-md-6">
  				<a class="btn btn-danger btn-block" href="{{route('sell.pos')}}">
  					<i class="fa fa-backward"></i>
  					{{trans('core.back')}}
  				</a>
  			</div>
  		</div>
  	</div>
@stop


@section('js')
	@parent
	<script>
		function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }

		$("#vendedor").change(mostrar);
	        
	    function mostrar(){
	           vend = $('#vendedor').val();	
	           //alert(vend);
	           $(".com").css("display","none");
	           $("#ven").html(vend);
	        }
	</script>

@stop