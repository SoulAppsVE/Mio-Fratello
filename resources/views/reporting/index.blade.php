@extends('app')

@section('title')
  {{trans('core.report')}}
  || @parent
@stop

@section('breadcrumb')
  {{trans('core.report')}}
@stop

@section('main-content')

<div class="panel-body">
  <div class="row">
    <!--Product Report-->
    <div class="col-md-4">
      <div class="tile-box tile-box-alt bg-primary">
          <div class="tile-header">
              
          </div>
          <div class="tile-content-wrapper">
              <i class="glyph-icon fa fa-cubes"></i>
              <div class="tile-content">
                <span>
                  {{trans('core.product')}} <br>
                  <small>{{trans('core.report')}}</small>
                </span>
              </div>
          </div>
          <a href="#" class="tile-footer tooltip-button" data-placement="bottom" title="Ver informe de producto" data-toggle="modal" data-target="#productModal">
              {{trans('core.view_report')}}
              <i class="glyph-icon icon-arrow-right"></i>
          </a>
      </div>
    </div>
    <!--Product Report-->

    <!--Purchase Report
    <div class="col-md-4">
      <div class="tile-box tile-box-alt bg-purple">
          <div class="tile-header">
              
          </div>
          <div class="tile-content-wrapper">
              <i class="glyph-icon fa fa-bar-chart"></i>
              <div class="tile-content">
                <span>
                  {{trans('core.purchase')}} 
                  <br><small>{{trans('core.report')}}</small>
                </span>
              </div>
          </div>
          <a href="#" class="tile-footer tooltip-button" data-placement="bottom" title="Ver informe de compra" data-toggle="modal" data-target="#purchaseModal">
              {{trans('core.view_report')}}
              <i class="glyph-icon icon-arrow-right"></i>
          </a>
      </div>
    </div>
    Purchase Report Ends-->

    <!--Sell Report-->
    <div class="col-md-4">
      <div class="tile-box tile-box-alt bg-blue-alt">
          <div class="tile-header">
              
          </div>
          <div class="tile-content-wrapper">
              <i class="glyph-icon fa fa-balance-scale"></i>
              <div class="tile-content">
                <span>
                  {{trans('core.sell')}} <br><small>{{trans('core.report')}}</small>
                </span>
              </div>
          </div>
          <a href="#" class="tile-footer tooltip-button" data-placement="bottom" title="Ver informe de ventas" data-toggle="modal" data-target="#sellsModal">
              {{trans('core.view_report')}}
              <i class="glyph-icon icon-arrow-right"></i>
          </a>
      </div>
    </div>
    <!--Sell Report Ends-->

    <div class="col-md-3 hidden">
      <div class="tile-box tile-box-alt bg-green">
          <div class="tile-header">
              
          </div>
          <div class="tile-content-wrapper">
              <i class="glyph-icon fa fa-cubes"></i>
              <div class="tile-content">
                <span>
                  Clients <br><small>Report</small>
                </span>
              </div>
          </div>
          <a href="#" class="tile-footer tooltip-button" data-placement="bottom" title="Ver informe de clientes" data-toggle="modal" data-target="#clientModal">
              {{trans('core.view_report')}}
              <i class="glyph-icon icon-arrow-right"></i>
          </a>
      </div>
    </div>

    <!--Stock Report-->
    <div class="col-md-4">
      <div class="tile-box tile-box-alt bg-warning" >
          <div class="tile-header">
              
          </div>
          <div class="tile-content-wrapper">
              <i class="glyph-icon fa fa-pie-chart"></i>
              <div class="tile-content">
                <span>
                  {{trans('core.stock')}}<br>
                  <small>{{trans('core.chart')}}</small>
                </span>
              </div>
          </div>
          <a href="#" class="tile-footer tooltip-button" data-placement="bottom" title="Ver informe de existencias" data-toggle="modal" data-target="#stockModal">
              {{trans('core.view_report')}}
              <i class="glyph-icon icon-arrow-right"></i>
          </a>
      </div>
    </div>
    <!--Stock Report Ends-->

    <!-- Category Report -->
    <div class="col-md-4">
      <div class="tile-box tile-box-alt" style="background-color: #ab6666;color: #fff;">
          <div class="tile-header">
              
          </div>
          <div class="tile-content-wrapper">
              <i class="glyph-icon fa fa-tag"></i>
              <div class="tile-content">
                <span>
                  {{trans('core.category')}} <br>
                  <small>{{trans('core.report')}}</small>
                </span>
              </div>
          </div>
          <a href="#" class="tile-footer tooltip-button" data-placement="bottom" title="Ver informe de categoría" data-toggle="modal" data-target="#categoryModal">
              {{trans('core.view_report')}}
              <i class="glyph-icon icon-arrow-right"></i>
          </a>
      </div>
    </div>
    <!-- Category Report Ends -->
    <!-- Warehouse Report Ends-->

    <!-- Profit Report -->
    <div class="col-md-4">
      <div class="tile-box tile-box-alt" style="margin-top: 5px;background-color: #db3b8a; color: white;">
          <div class="tile-header">
              
          </div>
          <div class="tile-content-wrapper">
              <i class="glyph-icon fa fa-area-chart"></i>
              <div class="tile-content">
                <span>
                  {{trans('core.profit')}}
                  <br><small>{{trans('core.report')}}</small>
                </span>
              </div>
          </div>
          <a href="#" class="tile-footer tooltip-button" data-placement="bottom" title="Ver informe de ganancias" data-toggle="modal" data-target="#profitModal">
              {{trans('core.view_report')}}
              <i class="glyph-icon icon-arrow-right"></i>
          </a>
      </div>
    </div>
    <!-- Profit Report Ends-->

    <!-- Due Report -->
    <!--<div class="col-md-4">
      <div class="tile-box tile-box-alt" style="margin-top: 5px;background-color: #5ec019; color: white;">
          <div class="tile-header"></div>
          <div class="tile-content-wrapper">
              <i class="glyph-icon fa fa-usd"></i>
              <div class="tile-content">
                <span>
                  Deuda 
                  <br>
                  <small>
                    {{trans('core.report')}}
                  </small>
                </span>
              </div>
          </div>
          <a href="#" class="tile-footer tooltip-button" data-placement="bottom" title="Ver informe de deudas" data-toggle="modal" data-target="#dueReport">
              {{trans('core.view_report')}}
              <i class="glyph-icon icon-arrow-right"></i>
          </a>
      </div>
    </div>-->
    <!-- Due Report -->
</div>

<!-- Modal for Purchase-->
  <div class="modal fade" id="purchaseModal" tabindex="-1" role="dialog" aria-labelledby="houseBillModalLabel">
    {!! Form::open(['route'=>'report.purchase']) !!}
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="houseBillModalLabel">
            {{trans('core.purchase')}} 
            {{trans('core.purchase')}}
          </h4>
        </div>
        <div class="modal-body">
          <div class="form-group"  style="visibility: hidden"> 
            <div class="row">
               {!! Form::label('Sucursal', 'Sucursal', ['class' => 'col-sm-2']) !!} 
              <div class="col-sm-10"> 
                <select class="form-control selectpicker" name="warehouse_id" data-live-search = true>
                    <option value="all">TODAS LAS SUCURSALES</option>
                    @foreach($warehouses as $warehouse)
                      <option value="{{$warehouse->id}}">
                        {{$warehouse->name}}
                      </option>
                    @endforeach
                  </select>
              </div>
            </div>  
          </div>

          <div class="form-group"> 
            <div class="row">
               {!! Form::label('Desde', 'Desde', ['class' => 'col-sm-2']) !!} 
              <div class="col-sm-10"> 
                {!! Form::text('from', Request::get('from'), ['class' => 'form-control dateTime','placeholder'=>"yyyy-mm-dd"]) !!}
              </div>
            </div>  
          </div>

          <div class="form-group">
              <div class="row">
                {!! Form::label('Hasta', 'Hasta', ['class' => 'col-sm-2']) !!} 
                <div class="col-sm-10">   
                  {!! Form::text('to', Request::get('to'), ['class' => 'form-control dateTime','placeholder'=>"yyyy-mm-dd"]) !!}
                </div>
              </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              {{trans('core.close')}}
            </button>
            <button type="submit" class="btn botom">
              {{trans('core.generate_report')}}
            </button>
          </div>
        </div> <!--modal body-->
    </div>
    {!! Form::close() !!}
  </div>
  </div>
  <!-- purchase modal ends here -->

  <!-- Modal for sells-->
  <div class="modal fade" id="sellsModal" tabindex="-1" role="dialog" >
    {!! Form::open(['route'=>'report.sells']) !!}
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Informe de Ventas</h4>
        </div>
        <div class="modal-body">
          <div class="form-group"> 
            <div class="row" style="visibility: hidden">
               {!! Form::label('Sucursal', 'Sucursal', ['class' => 'col-sm-2']) !!} 
              <div class="col-sm-10"> 
                <select class="form-control selectpicker" name="warehouse_id" data-live-search = true>
                    <option value="all">TODAS LAS SUCURSALES</option>
                    @foreach($warehouses as $warehouse)
                      <option value="{{$warehouse->id}}">
                        {{$warehouse->name}}
                      </option>
                    @endforeach
                  </select>
              </div>
            </div>  
          </div>
          
          <div class="form-group"> 
            <div class="row">
               {!! Form::label('Desde', 'Desde', ['class' => 'col-sm-2']) !!} 
              <div class="col-sm-10"> 
                {!! Form::text('from', Request::get('from'), ['class' => 'form-control dateTime','placeholder'=>"yyyy-mm-dd"]) !!}
              </div>
            </div>  
          </div>

           <div class="form-group">
              <div class="row">
                {!! Form::label('Hasta', 'Hasta', ['class' => 'col-sm-2']) !!} 
                <div class="col-sm-10">   
                  {!! Form::text('to', Request::get('to'), ['class' => 'form-control dateTime','placeholder'=>"yyyy-mm-dd"]) !!}
                </div>
              </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('core.close')}}</button>
            <button type="submit" class="btn botom">{{trans('core.generate_report')}}</button>
          </div>
        </div>
      </div>
    {!! Form::close() !!}
    </div>
  </div>
  <!-- sells modal Ends Here -->

  <!-- Product Report -->
  <div class="modal fade" id="productModal" tabindex="-1" role="dialog" >
    {!! Form::open(['route'=>'report.product']) !!}
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Informe de producto</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="row">
              {!! Form::label('Producto', 'Producto', ['class' => 'col-sm-2']) !!} 
              <div class="col-sm-10">   
                <select class="form-control selectpicker" name="product_id" data-live-search = true>
                  <option value="all">TODOS LOS PRODUCTOS</option>
                  @foreach($products as $product)
                    <option value="{{$product->id}}">
                      {{$product->name}}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>

          <div class="form-group"> 
            <div class="row">
               {!! Form::label('Desde', 'Desde', ['class' => 'col-sm-2']) !!} 
              <div class="col-sm-10"> 
                {!! Form::text('from', Request::get('from'), ['class' => 'form-control dateTime','placeholder'=>"yyyy-mm-dd"]) !!}
              </div>
            </div>  
          </div>

          <div class="form-group">
            <div class="row">
              {!! Form::label('Hasta', 'Hasta', ['class' => 'col-sm-2']) !!} 
              <div class="col-sm-10">   
                {!! Form::text('to', Request::get('to'), ['class' => 'form-control dateTime','placeholder'=>"yyyy-mm-dd"]) !!}
              </div>
            </div>
          </div>
          <div class="form-group" style="visibility: hidden"> 
            <div class="row">
               {!! Form::label('Sucursal', 'Sucursal', ['class' => 'col-sm-2']) !!} 
              <div class="col-sm-10"> 
                <select class="form-control selectpicker" name="warehouse_id" data-live-search = true>
                    <option value="all">TODAS LAS SUCURSALES</option>
                    @foreach($warehouses as $warehouse)
                      <option value="{{$warehouse->id}}">
                        {{$warehouse->name}}
                      </option>
                    @endforeach
                  </select>
              </div>
            </div>  
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('core.close')}}</button>
            <button type="submit" class="btn botom">{{trans('core.generate_report')}}</button>
          </div>
        </div>
      </div>
    {!! Form::close() !!}
    </div>
  </div>
  <!-- Product Report Ends-->

  <!--Clients Report-->
  <div class="modal fade" id="clientModal" tabindex="-1" role="dialog" >
    {!! Form::open(['route'=>'report.client']) !!}
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Reporte de Cliente</h4>
        </div>
        <div class="modal-body">
            <div class="form-group"> 
              <div class="row">
                 {!! Form::label('Desde', 'Desde', ['class' => 'col-sm-2']) !!} 
                <div class="col-sm-10"> 
                  {!! Form::text('from', Request::get('from'), ['class' => 'form-control dateTime','placeholder'=>"yyyy-mm-dd"]) !!}
                </div>
              </div>  
            </div>

           <div class="form-group">
              <div class="row">
                {!! Form::label('Hasta', 'Hasta', ['class' => 'col-sm-2']) !!} 
                <div class="col-sm-10">   
                  {!! Form::text('to', Request::get('to'), ['class' => 'form-control dateTime','placeholder'=>"yyyy-mm-dd"]) !!}
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                {!! Form::label('Producto', 'Producto', ['class' => 'col-sm-2']) !!} 
                <div class="col-sm-10">   
                  <select class="form-control selectpicker" name="client_id" data-live-search = true>
                    <option value="all">TODOS LOS CLIENTES</option>
                    @foreach($clients as $client)
                      <option value="{{$client->id}}">
                        {{$client->name}}
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('core.close')}}</button>
            <button type="submit" class="btn botom">{{trans('core.generate_report')}}</button>
          </div>
        </div>
      </div>
    {!! Form::close() !!}
    </div>
  </div>
  <!--Clients Report Ends-->

  <!--Stock Report Modal-->
  <div class="modal fade" id="stockModal" tabindex="-1" role="dialog" >
    {!! Form::open(['route'=>'report.stock']) !!}
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">{{trans('core.stock_report')}}</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <div class="row">
                {!! Form::label('Producto', 'Producto', ['class' => 'col-sm-2']) !!} 
                <div class="col-sm-10">   
                  <select class="form-control selectpicker" name="product_id" data-live-search = true>
                    <option value="all">TODOS LOS PRODUCTOS</option>
                    @foreach($products as $product)
                      <option value="{{$product->id}}">
                        {{$product->name}}
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('core.close')}}</button>
            <button type="submit" class="btn botom">{{trans('core.generate_report')}}</button>
          </div>
        </div>
      </div>
    {!! Form::close() !!}
    </div>
  </div>
  <!--Stock Report Modal Ends-->

  <!--Category Report-->
  <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" >
    {!! Form::open(['route'=>'report.category']) !!}
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">{{trans('core.report_category')}}</h4>
        </div>
        <div class="modal-body">
            <div class="form-group"> 
              <div class="row">
                 {!! Form::label('Desde', 'Desde', ['class' => 'col-sm-2']) !!} 
                <div class="col-sm-10"> 
                  {!! Form::text('from', Request::get('from'), ['class' => 'form-control dateTime','placeholder'=>"yyyy-mm-dd"]) !!}
                </div>
              </div>  
            </div>

           <div class="form-group">
              <div class="row">
                {!! Form::label('Hasta', 'Hasta', ['class' => 'col-sm-2']) !!} 
                <div class="col-sm-10">   
                  {!! Form::text('to', Request::get('to'), ['class' => 'form-control dateTime','placeholder'=>"yyyy-mm-dd"]) !!}
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                {!! Form::label('Categoría', 'Categoría', ['class' => 'col-sm-2']) !!} 
                <div class="col-sm-10">   
                  <select class="form-control selectpicker" name="category_id" data-live-search = true>
                    <option value="all">TODA LAS CATEGORÍAS</option>
                    @foreach($categories as $category)
                      <option value="{{$category->id}}">
                        {{$category->category_name}}
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn botom">{{trans('core.generate_report')}}</button>
          </div>
        </div>
      </div>
    {!! Form::close() !!}
    </div>
  </div>
  <!--Category Report Ends-->

  <!-- Subcategory Report -->
  <div class="modal fade" id="subcategoryModal" tabindex="-1" role="dialog" >
    {!! Form::open(['route'=>'report.subcategory']) !!}
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Informe de subcategoría</h4>
        </div>
        <div class="modal-body">
            <div class="form-group"> 
              <div class="row">
                 {!! Form::label('Desde', 'Desde', ['class' => 'col-sm-2']) !!} 
                <div class="col-sm-10"> 
                  {!! Form::text('from', Request::get('from'), ['class' => 'form-control dateTime','placeholder'=>"yyyy-mm-dd"]) !!}
                </div>
              </div>  
            </div>

           <div class="form-group">
              <div class="row">
                {!! Form::label('Hasta', 'Hasta', ['class' => 'col-sm-2']) !!} 
                <div class="col-sm-10">   
                  {!! Form::text('to', Request::get('to'), ['class' => 'form-control dateTime','placeholder'=>"yyyy-mm-dd"]) !!}
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                {!! Form::label('sub_category', 'Sub-Categoría', ['class' => 'col-sm-2']) !!} 
                <div class="col-sm-10">   
                  <select class="form-control selectpicker" name="subcategory_id" data-live-search = true>
                    <option value="all">TODAS LAS SUB-CATEGORÍAS</option>
                      @foreach($categories as $category)
                         <optgroup label="{{$category->category_name}}">
                           @foreach($category->subcategories as $subcategory)
                            <option value="{{$subcategory->id}}">
                              {{$subcategory->name}}
                            </option>
                          @endforeach
                        </optgroup>
                      @endforeach
                  </select>
                </div>
              </div>
            </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              {{trans('core.close')}}
            </button>
            <button type="submit" class="btn btn-primary">{{trans('core.generate_report')}}</button>
          </div>
        </div>
      </div>
    {!! Form::close() !!}
    </div>
  </div>
  <!-- Subcategory Report Ends-->

  <!-- Warehouse Report -->
  <div class="modal fade" id="warehouseModal" tabindex="-1" role="dialog" >
    {!! Form::open(['route'=>'report.branch']) !!}
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Reporte Sucursal</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="row">
              {!! Form::label('Producto', 'Producto', ['class' => 'col-sm-2']) !!} 
              <div class="col-sm-10">   
                <select class="form-control selectpicker" name="product_id" data-live-search = true>
                  <option value="all">TODOS LOS PRODUCTOS</option>
                  @foreach($products as $product)
                    <option value="{{$product->id}}">
                      {{$product->name}} 
                      ({{$product->code}})
                    </option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              {!! Form::label('Sucursal', 'Sucursal', ['class' => 'col-sm-2']) !!} 
              <div class="col-sm-10">   
                <select class="form-control selectpicker" name="warehouse_id" data-live-search = true>
                  <option value="all">TODAS LAS SUCURSALES</option>
                    @foreach($warehouses as $warehouse)
                      <option value="{{$warehouse->id}}">
                        {{$warehouse->name}}
                      </option>
                    @endforeach
                </select>
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              {{trans('core.close')}}
            </button>
            <button type="submit" class="btn btn-primary">{{trans('core.generate_report')}}</button>
          </div>
        </div>
      </div>
    {!! Form::close() !!}
    </div>
  </div>
  <!-- Subcategory Report Ends-->

  <!-- Profit Modal Starts -->
  <div class="modal fade" id="profitModal" tabindex="-1" role="dialog" >
    {!! Form::open(['route'=>'report.profit']) !!}
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Informe de Ganancias</h4>
        </div>
        <div class="modal-body">

          <div class="form-group"  style="visibility: hidden">
            <div class="row">
              {!! Form::label('Sucursal', 'Sucursal', ['class' => 'col-sm-2']) !!} 
              <div class="col-sm-10">   
                <select class="form-control selectpicker" name="warehouse_id" data-live-search = true>
                  <option value="all">TODAS LAS SUCURSALES</option>
                    @foreach($warehouses as $warehouse)
                      <option value="{{$warehouse->id}}">
                        {{$warehouse->name}}
                      </option>
                    @endforeach
                </select>
              </div>
            </div>
          </div>

          <div class="form-group"> 
            <div class="row">
               {!! Form::label('Desde', 'Desde', ['class' => 'col-sm-2']) !!} 
              <div class="col-sm-10"> 
                {!! Form::text('from', Request::get('from'), ['class' => 'form-control dateTime','placeholder'=>"yyyy-mm-dd"]) !!}
              </div>
            </div>  
          </div>

          <div class="form-group">
            <div class="row">
              {!! Form::label('Hasta', 'Hasta', ['class' => 'col-sm-2']) !!} 
              <div class="col-sm-10">   
                {!! Form::text('to', Request::get('to'), ['class' => 'form-control dateTime','placeholder'=>"yyyy-mm-dd"]) !!}
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              {{trans('core.close')}}
            </button>
            <button type="submit" class="btn botom">{{trans('core.generate_report')}}</button>
          </div>
        </div>
      </div>
    {!! Form::close() !!}
    </div>
  </div>
  <!-- Profit Report Modal Ends-->

  <!-- Modal for Due Report-->
  <div class="modal fade" id="dueReport" tabindex="-1" role="dialog" >
    {!! Form::open(['route'=>'report.due']) !!}
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Reporte de Deuda</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
              <div class="row">
                {!! Form::label('Cliente', 'Cliente', ['class' => 'col-sm-2']) !!} 
                <div class="col-sm-10">   
                  <select class="form-control selectpicker" name="client_id" data-live-search = true>
                    <option value="all">TODOS LOS CLIENTES</option>
                    @foreach($clients as $client)
                      <option value="{{$client->id}}">
                        {{$client->first_name}}
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>


          <div class="form-group"> 
            <div class="row">
               {!! Form::label('Desde', 'Desde', ['class' => 'col-sm-2']) !!} 
              <div class="col-sm-10"> 
                {!! Form::text('from', Request::get('from'), ['class' => 'form-control dateTime','placeholder'=>"yyyy-mm-dd"]) !!}
              </div>
            </div>  
          </div>

           <div class="form-group">
              <div class="row">
                {!! Form::label('Hasta', 'Hasta', ['class' => 'col-sm-2']) !!} 
                <div class="col-sm-10">   
                  {!! Form::text('to', Request::get('to'), ['class' => 'form-control dateTime','placeholder'=>"yyyy-mm-dd"]) !!}
                </div>
              </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('core.close')}}</button>
            <button type="submit" class="btn btn-primary">{{trans('core.generate_report')}}</button>
          </div>
        </div>
      </div>
    {!! Form::close() !!}
    </div>
  </div>
  <!-- Due Report modal Ends Here -->
</div>
@stop