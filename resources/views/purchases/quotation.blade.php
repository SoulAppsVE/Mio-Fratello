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
<div class="panel-body">
	<h3 class="title-hero">Cotización</h3>
	<form method="post" id="app" class="form-horizontal bordered-row">
		{{ csrf_field() }}
		<div style="margin-top: 20px;">
			<div class="form-group">
			    <label class="col-md-offset-2 col-md-2  control-label">
			    	Cliente
			    </label>
			    <div class="col-md-5">
			      <select class="form-control selectpicker" v-model="supplier"  data-live-search="true">
			      	<option value="1">Seleccione Cliente</option>
			      	@foreach($suppliers as $supplier)
			      		<option value="{{$supplier->id}}" selected>{{$supplier->name}}</option>
			      	@endforeach
			      </select>
			    </div>
		  	</div>
		</div>

    	<div>
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
					<!-- Date -->
					<tr>
						<td colspan="{{colSpanNumber()}}" @if(!rtlLocale()) style="text-align: right; font-weight: bold;" @endif>
							{{trans('core.date')}} &nbsp;&nbsp;
						</td>
						<td colspan="2">
							<input type="text" ref="sellDate" class="datepicker form-control text-center">
						</td> 
					</tr>
					<!-- Ends -->

					<tr>
						<td colspan="{{colSpanNumber()}}" @if(!rtlLocale()) style="text-align: right; font-weight: bold;" @endif>
							{{trans('core.total')}} 
						</td>
						<td colspan="2">
							<input type="text" class="form-control text-center" :value="total" disabled="true" />
						</td>
					</tr>
					<tr>
						<td colspan="6">
							<button type="submit" @click.prevent="postForm" :disabled="submitted" class="btn btn-success pull-right">
							<i class="fa fa-spinner fa-pulse fa-fw" v-if="submitted"></i>  
							<!--{{trans('core.submit')}} -->
							Guardar
							</button>
						</td>
					</tr>
				</tfoot>
    		</table>  	 
		</div>
	</form>
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
			<input type="text" v-model="purchase.price" class="form-control text-center">
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
@stop

@section('js')
    @parent
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
		        	var self = this
					axios.post('/admin/sell/quotation', { purchases: this.purchases, supplier: this.supplier, date: this.$refs.sellDate.value })
					  .then(function (response) {
					    console.log(JSON.stringify(response.data));
					    //swal('Your changes were saved successfully.')
					    //self.purchase = '';
					    window.location.href = '{{ route("sell.quotations") }}';
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