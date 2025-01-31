@extends('app')

@section('title')
	@if($product->id)
		{{trans('core.editing')}} {{$product->name}}
	@else
		{{trans('core.add_new_product')}}
	@endif
	|| @parent
@stop

@section('contentheader')
@stop

@section('breadcrumb')
	<a href="{{route('product.index')}}">{{trans('core.product_list')}}</a>
	<li>
		@if($product->id)
			{{trans('core.editing')}} {{$product->name}}
		@else
			{{trans('core.add_new_product')}}
		@endif
	</li>
@stop

@section('main-content')

	<div class="panel-body">
		<h3 class="title-hero">
			@if($product->id)
				{{trans('core.editing')}} {{$product->name}}
			@else
				{{trans('core.add_new_product')}}
			@endif
		</h3>

		<div class="example-box-wrapper"> 
		{!! Form::model($product,['method' => 'post', 'files' => true, 'class' => 'form-horizontal bordered-row', 'id' => 'ism_form']) !!}
				<div class="form-group">					
					<label class="col-sm-2 control-label"> 
						{{ trans('core.product_name')}}
						<span class="required">*</span>
					</label>
						
					<div class="col-sm-4"> 
						{!! Form::text('name', $product->name, ['class' => 'form-control', 'id' => 'productName']) !!}
					</div>

					<label class="col-sm-2 control-label"> 
						{{ trans('core.product_code')}} 
						<span class="required">*</span>
					</label>
					<div class="col-md-3">		
						{!! Form::text('code', $product->code, ['class' => 'form-control', 'id' => 'code']) !!}
					</div>

					<button 
						class="btn botom col-sm-1 tooltip-button" 
						type="button" 
						onclick="document.getElementById('code').value = generateCode()" 
						title="Click here to generate random code"
						> 
						<i class="fa fa-random"></i> 
					</button>

				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label"> {{ trans('core.category_name')}} <span class="required">*</span></label>
					<div class="col-sm-10">
						{!! Form::select('category_id', $categories, $product->category_id, ['class' => 'form-control selectpicker', 'id' => 'category_id', 'placeholder' => 'Seleccione una categoría', 'data-live-search' => "true"]) !!}
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label"> 
						{{ trans('core.cost_price')}}
						<span class="required">*</span>
					</label>
					<div class="col-sm-4">
						{!! Form::text('cost_price', $product->cost_price, ['class' => 'form-control number','id' => 'cost_price' ]) !!}
					</div>

					<!--<label class="col-sm-1 control-label"> 
						  % Ganancia
					</label>
					<div class="col-sm-2">
						<input type="text" class="form-control" name="porcentaje" id="porcentaje">
					</div>-->

					<label class="col-sm-2 control-label"> 
						Precio de Venta
						<span class="required">*</span>
					</label>
					<div class="col-sm-4">
						<!--<span class="form-control" id="mrp" readonly>$</span>-->
						{!! Form::text('mrp', $product->mrp, ['class' => 'form-control number','id' => 'mrp']) !!}
					</div>

				</div>

				<!--<div class="form-group">
					<label class="col-sm-2 control-label" > 
						{{ trans('core.minimum_retails_price')}}
					</label>
					<div class="col-sm-4">
						{!! Form::text('minimum_retail_price', $product->minimum_retail_price, ['class' => 'form-control popover-button-default number', 'data-content' => 'Show this value when new sell only, no effect to any transaction', 'data-placement' => 'bottom', 'data-trigger' => 'focus']) !!}
					</div>

					@if(settings('product_tax') == 1)
						<label class="col-sm-2 control-label"> 
							{{ trans('core.product_tax')}} 
						</label>

						<div class="col-sm-4">
						{!!Form::select('tax_id', $taxes, null, ['class' => 'form-control selectpicker'])!!}
						</div>

					@else
						<label class="col-sm-2 control-label"> 
							{{ trans('core.product_tax')}} 
						</label>

						<div class="col-sm-4 tooltip-button" title="To enable product tax, go to the settings">
							<input type="text" disabled class="form-control" value="disabled">
						</div>

					@endif
				</div>-->
				

				<div class="form-group">
					<label class="col-sm-2 control-label"> {{ trans('core.unit')}} </label>
					<div class="col-sm-4">
						{!! Form::text('unit', $product->unit, ['class' => 'form-control']) !!}
					</div>

					<!--<label for="featured" class="col-sm-2 control-label">
						Status
					</label>
					<div class="col-sm-4 tooltip-button" title="Only active products shows in new sell & purchases">		
						{!! Form::select('status', [1 => 'Active', 0=> 'Inactive'],$product->status, ['class' => 'form-control selectpickerLive', 'data-live-search' => "true"]) !!}
					</div>-->
					<label class="col-sm-2 control-label tooltip-button" title="“Existencias iniciales"> 
						{{ trans('core.opening_stocks')}}
					</label>
					<div class="col-sm-4">
						{!! Form::text('opening_stock', $product->opening_stock, ['class' => 'form-control number']) !!}
					</div>
					
				</div>

				<!-- <div class="form-group">
					<label class="col-sm-2 control-label"> {{ trans('core.description')}} </label>
					<div class="col-sm-10">
						{!! Form::textarea('details', $product->product_details, ['class' => 'form-control', 'rows'=>3]) !!}
					</div>
				</div> -->

				<div class="form-group">

					<!--<label class="col-sm-2 control-label"> 
						{{ trans('core.alert_range')}} 
					</label>
					<div class="col-sm-4">
						{!! Form::text('alert_quantity', $product->alert_quantity, ['class' => 'form-control']) !!}
					</div>-->
				</div>

				<div class="form-group">
	                <label class="col-sm-2 control-label">
	                	{{trans('core.image')}}
	                </label>
	                <div class="col-sm-4">
	                    {!! Form::file('image') !!}
	                </div>

	                @if(!empty($product->image))
		                <div class="col-sm-3" >
			                <p>
			                    <a href="{{url('uploads/products/' . $product->image)}}">
			                        <abbr title="Show Product Image">
			                            <img src="{!! asset('uploads/products/'. $product->image)!!}" 
			                                class="img-thumbnail img-responsive" alt="" >
			                        </abbr>
			                    </a>
			                </p>
						</div>
					@endif
	            </div>
			</div>
	
		    <div class="bg-default content-box text-center pad20A mrg25T">
                <input type="submit" class="btn btn-lg botom" id="submitButton" value="{{ trans('core.save') }}" onclick="submitted()">
            </div>
		{!! Form::close() !!}
	</div>

@stop


@section('js')
    @parent
     <script type="text/javascript">
        $(document).ready(function(){
            $('#category_id').on('change',function(){
            	$('#subcategoryOptions').html('');
                var categoryID = $(this).val();
                if(categoryID){
                    $.ajax({
                        type:'get',
                        url:'ajaxData',
                        data:'categoryID='+categoryID,
                        success:function(html){
                            $('#subcategoryOptions').html(html);
                        }
                    }); 
                }
            });
        });


        $(document).ready(function(){
            $('#porcentaje').on('change',function(){
               var cost_price = $("#cost_price").val();
               var porcentaje = $("#porcentaje").val();
               var result = (( cost_price * porcentaje ) / 100);
               var mrp = parseFloat(cost_price) +  parseFloat(result);
               console.log(mrp);
               $('#mrp').val($('#mrp').text());
               $('#mrp').html(parseFloat(mrp));
            });
        });

        /*generate random product code*/
        var productName = document.getElementById('productName');
        var randomNumber;
		productName.onkeyup = function(){
		    randomNumber = productName.value.toUpperCase();
		}

        function generateCode() {
    		if(randomNumber){
    			return randomNumber.substring(0, 2) + (Math.floor(Math.random()*1000)+ 999);
    		}else{
    			return Math.floor(Math.random()*90000) + 100000;
    		}	
		}
		/*ends*/

		$(function() {
          $('.number').on('input', function() {
            match = (/(\d{0,100})[^.]*((?:\.\d{0,5})?)/g).exec(this.value.replace(/[^\d.]/g, ''));
            this.value = match[1] + match[2];
          });
        });
    </script>
@stop