@extends('app')

@section('title')
	Tasa
@stop

@section('contentheader')
	Tasa
@stop

@section('breadcrumb')
	{{trans('core.invoice_tax_rate')}}
@stop

@section('main-content')

<div class="panel-heading">
	@if(auth()->user()->can('tasa.actions'))
    <!--<a id="addButton" class="btn btn-success btn-alt btn-xs" style="border-radius: 0px !important;">
  		<i class='fa fa-plus'></i>
  		Agregar Tasa 
  	</a>-->
  @endif
</div>

<div class="panel-body" style="min-height: 600px !important;">
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered">
		<thead class="table-header-color">
			<td class="text-center">#</td>
			<td class="text-center">Tasa Dolar</td>
			@if(auth()->user()->can('tasa.actions'))
        <td class="text-center">{{trans('core.actions')}}</td>
      @endif
		</thead>

		<tbody>
			@foreach($tasas as $tasa)
				<tr>
					<td class="text-center">{{$loop->iteration}}</td>
					<td class="text-center">{{$tasa->tasa}}</td>

          @if(auth()->user()->can('tasa.actions'))
            <!--Tax Edit button trigger-->
            <td class="text-center">
  						<a href="#"
  							data-id="{{$tasa->id}}"
  							data-name="{{$tasa->tasa}}"
  							class="btn btn-info btn-alt btn-xs btn-edit">
  							<i class="fa fa-edit"></i>
                {{trans('core.edit')}}
  						</a>

              <!--Tax Delete button trigger
              <a href="#" data-id="{{$tasa->id}}" data-name="{{$tasa->tasa}}"  class="btn btn-danger btn-alt btn-xs btn-delete">
                 <i class="fa fa-trash"></i>
                 {{trans('core.delete')}}
              </a>-->
  					</td>
          @endif
				</tr>
			@endforeach
		</tbody>
	</table>

	<!--Pagination-->
	<div class="pull-right">

	</div>
	<!--Ends-->
</div>

<!--Create Taxrate Modal -->
<div class="modal fade" id="addModal">
    <div class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(['class' => '']) !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> {{trans('core.add_tax_rate')}}</h4>
            </div>

            <div class="modal-body">
                <div class="form-group">
				    <label>{{trans('core.name')}}</label>
				    <input type="text" name="name" class="form-control" required>
				</div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                	{{trans('core.close')}}
                </button>
                {!! Form::submit('Save', ['class' => 'btn btn-primary', 'data-disable-with' => 'Saving']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<!-- Create Taxrate modal ends -->

<!-- Delete Modal Starts -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  {!! Form::open(['route'=>'tax.delete','method'=>'POST']) !!}
  {!! Form::hidden('id',null,['id'=>'deleteTaxInput']) !!}
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">
            Delete <span id="deleteTaxName"></span>
        </h4>
      </div>
      <div class="modal-body">
        <h3>Are you sure you want to delete this tasa rate?</h3>
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


<!-- Edit Modal Starts -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  {!! Form::open(['route'=>'tasa.edit','method'=>'POST']) !!}
  {!! Form::hidden('id',null,['id'=>'editTaxInput']) !!}
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">
            Editar <span id="editTaxName"></span>
        </h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
		    <label>Tasa</label>
		    <input type="text" name="tasa" class="form-control" id="editTasa" required>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-info">Update</button>
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
            $('#addButton').click(function(event) {
                event.preventDefault();
                $('#addModal').modal('show')
            });
        })

        $(document).ready(function(){
            $('.btn-delete').on('click',function(e){
                e.preventDefault();
                $('#deleteModal').modal();
                $('#deleteTaxInput').val($(this).attr('data-id'));
                var taxName = ($(this).attr('data-name'));
                document.getElementById("deleteTaxName").innerHTML = taxName;
            })
        });

        $(document).ready(function(){
            $('.btn-edit').on('click',function(e){
                e.preventDefault();
                $('#editModal').modal();
                $('#editTaxInput').val($(this).attr('data-id'));
                $('#editTasa').val($(this).attr('data-name'));
                var taxNameEdit = ($(this).attr('data-name'));
                document.getElementById("editTaxName").innerHTML = taxNameEdit;
            })
        });
	</script>

@stop
