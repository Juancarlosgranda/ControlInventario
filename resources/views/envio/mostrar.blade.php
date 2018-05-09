@extends('layouts.dashboard')
@section('page_heading','Envio de repuestos')
@section('section')
@if(Session::has('creado'))
<div class="alert alert-success">
    <p>{{Session::get('creado')}}</p>
</div>
@endif
  @if(Session::has('eliminado'))
<div class="alert alert-danger">
    <p>{{Session::get('eliminado')}}</p>
</div>
@endif
 @if(Session::has('null'))
<div class="alert alert-danger">
    <p>{{Session::get('null')}}</p>
</div>
@endif
 @if(Session::has('nullo'))
<div class="alert alert-success">
    <p>{{Session::get('nullo')}}</p>
</div>
@endif
 @if(Session::has('actualizado'))
<div class="alert alert-success">
    <p>{{Session::get('actualizado')}}</p>
</div>
@endif
 @if(Session::has('actualizado1'))
<div class="alert alert-success">
    <p>{{Session::get('actualizado1')}}</p>
</div>
@endif
 @if(Session::has('bus'))
<div class="alert alert-danger">
    <p>{{Session::get('bus')}}</p>
</div>
 @endif
  @if(Session::has('bus2'))
<div class="alert alert-danger">
    <p>{{Session::get('bus2')}}</p>
</div>
@endif
<div class="row">
 <div class="col-sm-12">
    @section ('grid14_panel_body')
           <h5><b>Buscar registros de envios. </b></h5><br>
            <form class="form-horizontal" role="form" method="POST" action="/validado/envios/ver-envio">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
				<label class="col-md-4 control-label">Desde:</label>
				<div class="col-md-7">
				    <input type="date" class="form-control" name="fecha1" value="" required>
				</div>
				<BR></BR>
				<label class="col-md-4 control-label">a:</label>
				<div class="col-md-7">
				     <input type="date" class="form-control" name="fecha2" value="" required><br>
				</div>
            </div>
            <div class="form-group">
				    <div class="col-md-6 col-md-offset-4">
				        <button type="submit" class="btn btn-primary">
					    			Buscar
				        </button>
				    </div>
				</div>
				</form>
		@endsection
		@include('widgets.panel', array('controls'=> true, 'as'=> 'grid14'))
    
    </div>
	<div class="col-sm-12">
	<p><a href="{{ url('/validado/envios/crear-envio')}}" class="btn btn-primary" role="button">Registrar envió de repuestos</a></p>
		@section ('cotable_panel_title','Listado de los 20 ultimos envios')
		@section ('cotable_panel_body')
		<table class="table table-striped">
			<thead>
				<tr class="success">
					<th>Código</th>
					<th>Repuesto</th>
					<th>Cantidad</th>
					<th>Sede</th>
					<th>Fecha de envío</th>
					<th>Nro de documento de envío</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
			@foreach($envios as $envio)
				<tr>
					<td>{{$envio->id_envio}}</td>
					<td>{{$envio->repuesto->nombre}}</td>
					<td>{{$envio->cantidad}}</td>
					<td>{{$envio->sede->nombre}}</td>
					<td>{{$envio->fecha}}</td>
					<td>{{$envio->remision}}</td>
					<td><a href="/validado/envios/editar-envio?id={{$envio->id_envio}}" class="btn btn-success" role="button">Actualizar</a>
					<a href="/validado/envios/eliminar-envio?id={{$envio->id_envio}}" class="btn btn-danger" onclick="return confirm('Esta seguro que desea eliminar?')" role="button">Eliminar</a></td>
				</tr>
				@endforeach
			</tbody>
		</table>	
		@endsection
		@include('widgets.panel', array('header'=>true, 'as'=>'cotable'))
	</div>
</div>
@stop
