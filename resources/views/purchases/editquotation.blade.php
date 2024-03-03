@extends('app')

@section('title')
	Cotización
@stop

@section('contentheader')
@stop

@section('breadcrumb')
	Cotización
@stop

@section('main-content')

<div class="panel-heading" >
            <a href="{{route('sell.quotations')}}" class="btn btn-success btn-alt btn-xs" style="border-radius: 0px !important;" >
                <i class="fa fa-arrow-left"></i> 
                Regresar
            </a>
</div> 

<div class="panel-body">
	{{ csrf_field() }}
	<h3 class="title-hero"> Editar Cotización</h3>
		<div style="margin-top: 20px;">
			<div class="form-group">
			    <label class="col-md-offset-2 col-md-2  control-label">
			    	Nombre de Cliente:
			    </label>
			    <div class="col-md-5">	
			      <select class="form-control selectpicker" data-live-search="true">
			      	@foreach($suppliers as $supplier)
			      	    @if($supplier->id == $quotation->client_id)
			      			<option value="{{$supplier->id}}" selected="true">{{$supplier->name}}</option>
			      		@endif
			      	@endforeach
			      </select>
			    </div>
		  	</div>
		</div>
    	<div>
    		<table class="table table-bordered bg-purchase" id="table">
    			<thead class="{{settings('theme')}}">
					<tr>
						<td class="text-center font-white" style="width: 5%;">#</td>
						<td class="text-center font-white" style="width: 25%;">
							{{trans('core.product')}}
						</td>
						<td class="text-center font-white" style="width: 15%;">
							Precio
						</td>
						<td class="text-center font-white" style="width: 15%;">
							{{trans('core.quantity')}}
						</td>			
						<td class="text-center font-white" style="width: 20%;">
							{{trans('core.sub_total')}}
						</td>
						<td class="text-center font-white" style="width: 8%;">&nbsp;</td>
					</tr>
				</thead>

				<tbody>
				 @foreach($quotationd as $item)
					<tr class="item{{$item->id}}">
						  <td class="text-center">
						  	{{$item->id}}
						  </td>
						  <td>
                             {{$item->name}}
						  </td>
					      <td class="text-center">
					         {{$item->mrp}}
					      </td>
					      <td class="text-center">
					      	{{$item->quantity}}
					      </td>
					      <td class="text-center">
					      	{{$item->subtotal}}
					      </td>
                          <td class="text-center">
                         	<button class="edit-modal btn btn-info"
							data-info="{{ $item->id }},{{ $item->name }},{{ $item->mrp }},{{ $item->quantity }},{{ $item->subtotal }}">
							<span class="glyphicon glyphicon-edit"></span>
							</button>
							<button class="delete-modal btn btn-danger"
							data-info="{{ $item->id }},{{ $item->name }},{{ $item->mrp }},{{ $item->quantity }},{{ $item->subtotal }}">
							<span class="glyphicon glyphicon-trash"></span>
							</button>
                          </td>
					</tr>
                   @endforeach
				</tbody>
    		</table>  	 
	</div>	

    <div id="app">
    	<div>
    		<input type="hidden" id="norden" value="{{$quotation->id}}">
    		<table class="table table-bordered bg-purchase">
    			<thead class="{{settings('theme')}}">
					<tr>
						<td class="text-center font-white" style="width: 25%;">
							{{trans('core.product')}}
						</td>
						<td class="text-center font-white" style="width: 15%;">
							Precio
						</td>
						<td class="text-center font-white" style="width: 15%;">
							{{trans('core.quantity')}}
						</td>
						<td class="text-center font-white" v-if="enableProductTax == 1" style="width: 15%;">
							{{trans('core.product_tax')}}
						</td>				
						<td class="text-center font-white" style="width: 20%;">
							{{trans('core.sub_total')}}
						</td>
						<td class="text-center font-white" style="width: 5%;">&nbsp;</td>
					</tr>
				</thead>

				<tbody>
					<tr 
						is="purchase"
						v-for="purchase in purchases" 
						:id="purchase.id"
						:purchase="purchase"
						:enable_product_tax="{{ settings('product_tax') }}"
						:add="addInput"
						:remove="removeInput"
					></tr>
				</tbody>

				<tfoot>
					<tr>
						<td colspan="6">
							<button type="submit" @click.prevent="postForm" :disabled="submitted" class="btn btn-success pull-right">
							<i class="fa fa-spinner fa-pulse fa-fw" v-if="submitted"></i>  
							Guardar
							</button>
						</td>
					</tr>
				</tfoot>
    		</table>  	 
		</div>
	</form>
</div>

</div>

<template id="purchase">
	<tr>
		<td>
			<select 
				class="form-control selectPickerLive" 
				@change="setPrice" 
				v-model="purchase.product_id" 
				data-live-search="true"
			>
				<option>{{trans('core.select_product')}}</option>
				@foreach($products as $product)
					<option 
						value="{{$product->id}}" 
						data-price="{{$product->mrp}}"
						data-taxrate="{{$product->tax ? $product->tax->rate : 0}}"
						data-taxtype="{{$product->tax ? $product->tax->type : null }}"
					>
						{{$product->name}} ({{$product->code}})
					</option>
				@endforeach
			</select>
		</td>
		<td>
			<input type="text" v-model="purchase.price" class="form-control text-center" disabled="true">
		</td>
		<td>
			<input type="text" v-model="purchase.quantity" class="form-control text-center">
		</td>
		
		<td v-if="enable_product_tax ==1">
			<input type="text" v-model="purchase.product_tax" class="form-control text-center" disabled="true"> 
		</td>
		
		<td>
			<input type="text" v-model="purchase.subtotal" class="form-control text-center" disabled="true">
		</td>
		<td>
			<button @click.prevent="remove(id)" class="btn btn-danger" v-if="id != 1">
				<i class="fa fa-times"></i>
			</button>
			<button @click.prevent="add()" class="btn btn-success" v-else >
				<i class="fa fa-plus"></i>
			</button>
		</td>
	</tr>
</template>


<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"></h4>

				</div>
				<div class="modal-body">
					<form class="form-horizontal" role="form">
						<div class="form-group">
							<label class="control-label col-sm-2" for="fid">ID</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="fid" disabled>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="name">Producto</label>
							<div class="col-sm-10">
								<input type="name" class="form-control" id="name" readonly>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="price">Precio:</label>
							<div class="col-sm-10">
								<input type="name" class="form-control" id="mrp" readonly>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="quantity">Cantidad</label>
							<div class="col-sm-10">
								<input type="name" class="form-control" id="quantity">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="subtotal">Subtotal</label>
							<div class="col-sm-10">
								<input type="name" class="form-control" id="subtotal">
							</div>
						</div>
					</form>
					<div class="deleteContent">
						Are you Sure you want to delete <span class="dname"></span> ? <span
							class="hidden did"></span>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn actionBtn" data-dismiss="modal">
							<span id="footer_action_button" class='glyphicon'> </span>
						</button>
						<button type="button" class="btn btn-warning" data-dismiss="modal">
							<span class='glyphicon glyphicon-remove'></span> Close
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

@section('js')
    @parent
    <script>
		  $(document).ready(function() {
		    $('#table').DataTable();
		} );
    </script>
	<script>

	    $(document).on('click', '.delete-modal', function() {
	        $('#footer_action_button').text(" Delete");
	        $('#footer_action_button').removeClass('glyphicon-check');
	        $('#footer_action_button').addClass('glyphicon-trash');
	        $('.actionBtn').removeClass('btn-success');
	        $('.actionBtn').addClass('btn-danger');
	        $('.actionBtn').removeClass('edit');
	        $('.actionBtn').addClass('delete');
	        $('.modal-title').text('Eliminar');
	        $('.deleteContent').show();
	        $('.form-horizontal').hide();
	        var stuff = $(this).data('info').split(',');
	        $('.did').text(stuff[0]);
	        $('.dname').html(stuff[1] +" "+stuff[2]);
	        $('#myModal').modal('show');
	    });


	    $(document).on('click', '.edit-modal', function() {
	        $('#footer_action_button').text(" Update");
	        $('#footer_action_button').addClass('glyphicon-check');
	        $('#footer_action_button').removeClass('glyphicon-trash');
	        $('.actionBtn').addClass('btn-success');
	        $('.actionBtn').removeClass('btn-danger');
	        $('.actionBtn').removeClass('delete');
	        $('.actionBtn').addClass('edit');
	        $('.modal-title').text('Editar');
	        $('.deleteContent').hide();
	        $('.form-horizontal').show();
	        var stuff = $(this).data('info').split(',');
	        fillmodalData(stuff)
	        $('#myModal').modal('show');
	    });
		function fillmodalData(details){
		    $('#fid').val(details[0]);
		    $('#name').val(details[1]);
		    $('#mrp').val(details[2]);
		    $('#quantity').val(details[3]);
		    $('#subtotal').val(details[4]);
		}

		$('.modal-footer').on('click', '.edit', function() {
			    subtotal = $('#mrp').val() *  $('#quantity').val(); 
		        $.ajax({
		            type: 'post',
		            url: '/admin/quotationd/update',
		            data: {
		                '_token': $('input[name=_token]').val(),
		                'id': $("#fid").val(),
		                'name': $('#name').val(),
		                'mrp': $('#mrp').val(),
		                'quantity': $('#quantity').val(),
		                'subtotal': subtotal
		            },
		            success: function(data) {

		                $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td>" +
		                        data.id + "</td><td>" + data.name +
		                        "</td><td>" + data.mrp + "</td><td>" + data.quantity + "</td><td>" +
		                         data.subtotal + "</td><td><button class='edit-modal btn btn-info' data-info='" + data.id+","+data.name+","+data.mrp+","+data.quantity+","+data.subtotal+"'><span class='glyphicon glyphicon-edit'></span></button> <button class='delete-modal btn btn-danger' data-info='" + data.id+","+data.name+","+data.mrp+","+data.quantity+","+data.subtotal+"' ><span class='glyphicon glyphicon-trash'></span> </button></td></tr>");
		                window.location.reload();

		            	}
		        });
		    });

		    $('.modal-footer').on('click', '.delete', function() {
		        $.ajax({
		            type: 'post',
		            url: '/admin/quotationd/delete',
		            data: {
		                '_token': $('input[name=_token]').val(),
		                'id': $('.did').text()
		            },
		            success: function(data) {
		                $('.item' + $('.did').text()).remove();
		            }
		        });
		    });
    </script>
	<script src="/assets/js-core/vue.min.js"></script>
    <script src="/assets/js-core/axios.min.js"></script>
    <script>

    	$(document).ready(function () {
    		$('.selectPickerLive').selectpicker();
    	})

    	axios.defaults.headers.common['X-CSRF-TOKEN'] = window.Laravel.csrfToken;
		axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

    	Vue.component('purchase', {
    		template: '#purchase',
    		props: ['id', 'purchase', 'add', 'remove', 'enable_product_tax'],
    		data: function () {
	    		return {}
	    	},
	    	methods: {
	    		setPrice: function (event) {
	    			var selectedPrice = $('option:selected', event.target).data('price')
	    			this.purchase.price = selectedPrice
	    			this.purchase.unit_tax_rate = $('option:selected', event.target).data('taxrate')
	    			this.purchase.tax_type = $('option:selected', event.target).data('taxtype')
	    		}
	    	},
	    	mounted: function () {
	    		this.$watch('purchase.price', function (value) {
	    			if(this.enable_product_tax === 1){
		    			var unitTax = this.purchase.unit_tax_rate
		    			if(this.purchase.tax_type == 1){
		    				this.purchase.product_tax = (unitTax * value * this.purchase.quantity) / 100
		    			}else{
		    				this.purchase.product_tax = unitTax * this.purchase.quantity
		    			}
		    		}

	    			this.purchase.subtotal = (value * this.purchase.quantity) + this.purchase.product_tax
	    		})

	    		this.$watch('purchase.quantity', function (value) {
	    			if(this.enable_product_tax === 1){
	    				var unitTax = this.purchase.unit_tax_rate
		    			if(this.purchase.tax_type == 1){
		    				this.purchase.product_tax = (unitTax * this.purchase.price * value) / 100
		    			}else{
		    				this.purchase.product_tax = unitTax * this.purchase.quantity
		    			}
	    			}
	    			
	    			this.purchase.subtotal = (this.purchase.price * value) + this.purchase.product_tax
	    		})
	    	}
    	})

    	var app = new Vue({
		    el: '#app',
		    data: {
		    	supplier: '',
		    	paid: 0,
		    	method: 'cash',
		    	purchases: [
		    		{ 
		    			id: 1,
		    			price: 0, 
		    			quantity: 1, 
		    			unit_tax_rate: 0,
		    			tax_type: 0,
		    			product_tax: 0, 
		    			subtotal: 0, 
		    			product_id: 0
		    		},
		    	],
		    	discount: 0,
		    	discountType: 'cash',
		    	submitted: false,
		    	enableInvoiceTax: {{ settings('invoice_tax') ?: 0 }},
		    	invoice_tax_rate: {{ settings('invoice_tax_rate') ?: 0 }},
		    	invoice_tax_type: {{ settings('invoice_tax_type') ?: 2 }},
		    	ref_no: '',
		    	enableProductTax: {{settings('product_tax')}}        
		    },
		    computed: {
		    	total: function () {
		    		var total = 0
		    		for (var i = 0; i < this.purchases.length; i++) {
		        		total = total + this.purchases[i].subtotal
		        	}
		        	return total
		    	},

		    	discountAmount: function () {
		    		var discountAmount = this.discount
		        	if (this.discountType === 'percentage') {
		        		discountAmount = this.total * (1 * this.discount / 100)
		        	}
		        	return discountAmount
		    	},

		    	netTotal: function () {
		    		return (parseFloat(this.total) + parseFloat(this.invoice_tax) - parseFloat(this.discountAmount)).toFixed(2)
		    	},

		    	due: function () {
		    		return (this.netTotal - this.paid).toFixed(2)
		    	},

		    	total_product_tax: function () {
		    		var totalProductTax = 0
		    		for (var i = 0; i < this.purchases.length; i++) {
		        		totalProductTax = totalProductTax + (this.purchases[i].product_tax)
		        	}
		        	return parseFloat(totalProductTax).toFixed(2)
		    	},

		    	//calculate total invoice tax
		    	invoice_tax: function () {
		    		var invoice_tax_amount = 0
		    		if(this.enableInvoiceTax == 1){
			    		//check if tax type is percentage(1) or fixed (2)
			    		if(this.invoice_tax_type == 1){
			    			invoice_tax_amount = (this.invoice_tax_rate * (this.total - this.discountAmount)) / 100
			    		}else{
			    			invoice_tax_amount = this.invoice_tax_rate
			    		}
		    		}
		    		return parseFloat(invoice_tax_amount).toFixed(2)
		    	},
		    },
		    methods:{
		        addInput: function () {
		        	var newInputId = 1
		        	for (var i = 0; i < this.purchases.length; i++) {
		        		newInputId = this.purchases[i].id + 1
		        	}
		        	this.purchases.push({ id: newInputId, price: 0, quantity: 1, subtotal: 0, product_tax: 0})
		        	this.$nextTick(function () {
		        		$('.selectPickerLive').selectpicker()
		        	})
		        },
		        removeInput: function (id) {
		        	console.log('PASSED ID', id)
		           var index = this.purchases.findIndex(function (purchase) {
		           		return purchase.id === id
		           })
		           console.log('INDEX', index)
		           this.purchases.splice(index, 1)
		        },
		        postForm: function () {
		        	/*console.log(this.total)*/
		        	this.submitted = true
		        	/*if(parseFloat(this.paid) > this.netTotal){
		        		 swal("Sorry", "Paid amount (" + this.paid + ") cant\'be greater than total amount (" + this.netTotal + ")", "error");
		        		return false;
		        	}*/
		        	var norden = $('#norden').val() ;
		        	var self = this
					axios.post('/admin/addquotation', { purchases: this.purchases, norden: norden })
					  .then(function (response) {
					    console.log(JSON.stringify(response.data));
					    //swal('Your changes were saved successfully.')
					    //self.purchase = '';
					    window.location.reload();
					  })
					  .catch(function (error) {
					  	self.submitted = false
					    console.log(JSON.stringify(error))
					    swal('Something went wrong..', error.response.data.message, 'error')
					  });
		        },
		        bootExternalLibraries: function () {
		        	this.$nextTick(function () {
						$('.datepicker').datetimepicker({
					          format : 'YYYY-M-D H:mm:ss'
					      })
		        	})
		        }
		    },
		    created: function () {
		    	this.bootExternalLibraries()
		    }
		});
    </script>    
@stop