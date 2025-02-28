@extends('app')

@section('title')
	Lista de Cotizaciones
@stop

@section('contentheader')
	Lista de Cotizaciones
@stop

@section('breadcrumb')
	Lista de Cotizaciones
@stop


@section('main-content')
    <div class="panel-heading" >
        @if (auth()->user()->can('purchase.create'))
            <a href="{{route('sell.quotation')}}" class="btn btn-success btn-alt btn-xs" style="border-radius: 0px !important;" >
                <i class="fa fa-plus"></i> 
                Agregar nueva Cotización
            </a>
        @endif

    </div> 
   
    <div class="panel-body">
        <div class="table-responsive" style="min-height: 250px;" id="tableDIv">
        	<table class="table table-bordered table-striped">
                <thead class="{{settings('theme')}}">
                    <td class="text-center font-white">ID</td>
                    <td class="text-center font-white">{{trans('core.date')}}</td>
                    <td class="text-center font-white">{{trans('core.supplier')}}</td>
                    <td class="text-center font-white">{{trans('core.actions')}}</td>
                </thead>

                <tbody>

                    @foreach($quotations as $quotation)
                        <tr>
                            <td class="text-center">
                                {{$quotation->id}}
                            </td>
                            <td class="text-center tooltip-button" data-placement="bottom" title="{{ carbonDate($quotation->date, 'g:i:a') }}">
                                <!--{{ carbonDate($quotation->date, 'y-m-d') }}-->
                                {{ date('d/m/Y h:i A', strtotime($quotation->date)) }}
                            </td>
                            
                            <td class="text-center">
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
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                  <button type="button" class="btn btn-info btn-alt btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{trans('core.actions')}} 
                                    <span class="caret"></span>
                                  </button>
                                  <ul class="dropdown-menu pull-right">
                                    <li>
                                        <a href="{{ route('quotation.edit', $quotation->id)}}" title="Edit" >
                                            <i class="fa fa-edit" style="color: #069996;"></i>
                                            {{trans('core.edit')}}
                                        </a> 
                                    </li>
                                    <li>
                                        <a target="_BLINK" href="{{ route('sell.invoicequotation', $quotation->id)}}">
                                            <i class="fa fa-print" style="color: #edb426;"></i>
                                            {{trans('core.print')}}
                                        </a>
                                    </li>
                                    
                                    <li>
                                        @if(auth()->user()->can('purchase.manage'))
                                            <a href="#" data-id="{{$quotation->id}}" data-name="$quotation->id" class="btn-delete">
                                               <i class="fa fa-trash" style="color: red;"></i>
                                               {{trans('core.delete')}}
                                            </a>
                                            <!--delete button trigger ends--> 
                                        @endif 
                                    </li>
                                  </ul>
                                </div>
                            </td>                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
         </div>
            <!--Pagination-->
        <div class="pull-right">
        {{ $quotations->links() }}
        </div>
        <!--Ends-->      
</div>
         <!-- Delete Modal Starts -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
          {!! Form::open(['route'=>'quotation.delete','method'=>'POST']) !!}
          {!! Form::hidden('id',null,['id'=>'deleteExpenseInput']) !!}
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">
                    Eliminar Cotización
                    <span id="deleteExpenseName" ></span>
                </h4>
              </div>
              <div class="modal-body">
                <h3>Are you sure you want to delete this Cotización?</h3>
                <br>
                <h4 style="color: red;">
                    Note: If you delete this Cotización, all the transactions of this Cotización will also be deleted &amp; product will also adjusted.
                </h4>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Delete</button>
              </div>
            </div>
          </div>
          {!! Form::close() !!}
        </div>
        <!-- Modal Ends -->  
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

        $(document).ready(function(){
            $('.btn-delete').on('click',function(e){
                e.preventDefault();
                $('#deleteModal').modal();
                $('#deleteExpenseInput').val($(this).attr('data-id'));
                $('#deleteExpenseName').val($(this).attr('data-name'));
            })
        });


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