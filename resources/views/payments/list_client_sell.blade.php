@extends('app')

@section('title')
	Lista de Clientes por Compras Hechas
@stop

@section('contentheader')
	Lista de Clientes por Compras Hechas
@stop

@section('breadcrumb')
	Lista de Clientes por Compras Hechas
@stop

@section('main-content')

    <div class="panel-heading" >
        <a class="btn botom btn-alt btn-xs" id="searchBList">
            <i class="fa fa-search"></i> 
                Buscar ventas por mes
        </a>

    </div>
	<div class="panel-body">
        <div class="table-responsive" id="tableDIv">
    		<table class="table table-bordered table-striped" >
    			<thead style="background-color:#1b2f4c;">
    				<td class="text-center font-white">Nombre Completo</td>
    				<td class="text-center font-white">Compras $</td>
    			</thead>

    			<tbody style="background-color: #fff;">
    				@foreach($payments as $payment)
    					<tr>
    						<td class="text-center">
                                @foreach($clients as $row)
                                  @if($row->id == $payment->client_id)
>                                    {{ $row->first_name }} / {{ $row->company_name}}
                                  @endif
                                @endforeach

                            </td>
    						<td class="text-center">
                                {{settings('currency_code')}}
                                {{$payment->amount}}
                            </td>
    					</tr>
    				@endforeach
    			</tbody>
    		</table>

    		<!--Pagination-->
            <div class="pull-right">
              {{ $payments->links() }}
            </div>
            <!--Ends-->
        </div>
	</div>



    <!-- Sell search modal -->
    <div class="modal fade" id="searchList">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['class' => 'form-horizontal']) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> {{ trans('core.search').' '.trans('core.sell') }}</h4>
                </div>

                <div class="modal-body">                  

                    <div class="form-group">
                        <label class="col-sm-3" @if(rtlLocale()) style="text-align: left;" @endif>
                            Desde
                        </label>
                        <div class="col-sm-9">
                            {!! Form::text('from', Request::get('from'), ['class' => 'form-control dateTime','placeholder'=>"yyyy-mm-dd"]) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3" @if(rtlLocale()) style="text-align: left;" @endif>
                            Hasta
                        </label>
                        <div class="col-sm-9">
                            {!! Form::text('to', Request::get('to'), ['class' => 'form-control dateTime','placeholder'=>"yyyy-mm-dd"]) !!}
                        </div>
                    </div>
                                                             
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('core.close')}}</button>
                    {!! Form::submit('Buscar', ['class' => 'btn btn-primary', 'data-disable-with' => trans('core.searching')]) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <!-- search modal ends -->   
@stop
@section('js')
    @parent
    <script>
        $(function() {
            $('#searchButton').click(function(event) {
                event.preventDefault();
                $('#searchModal').modal('show')
            });
        })
        $(function() {
            $('#searchBList').click(function(event) {
                event.preventDefault();
                $('#searchList').modal('show')
            });
        })
        function showSummary() {
            var x = document.getElementById("summaryDiv");
            var y = document.getElementById("tableDIv");
            var elem = document.getElementById("summaryBtn");
            if (elem.value=="Summary") elem.value = "Transaction List";
            else elem.value = "Summary";
            if (x.style.display === "none") {
                x.style.display = "block";
                y.style.display = "none";
            } else {
                x.style.display = "none";
                y.style.display = "block";
            }
        }
    </script>
@stop