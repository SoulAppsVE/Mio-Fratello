@extends('app')

@section('title')
    401
@endsection

@section('contentheader')
    401 No autorizado
@endsection

@section('$contentheader_description')
@endsection

@section('main-content')
<div class="panel-body">
    <div class="error-page">
        <h2 class="headline text-red"> 401</h2>
        <div class="error-content">
            <h3><i class="fa fa-warning text-red"></i> No autorizado</h3>
            <p>
                La solicitud no se ha aplicado porque carece de credenciales de autenticación válidas para el recurso de destino, es posible que <a href='{{ url('/home') }}'>volver al Inicio</a>
            </p>
        </div><!-- /.error-content -->
    </div><!-- /.error-page -->
</div>
@endsection