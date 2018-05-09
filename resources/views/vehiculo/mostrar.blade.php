@extends('layouts.dashboard')
@section('page_heading','Vehiculos')
@section('section')
@if(Session::has('creado'))
<div class="alert alert-success">
    <p>Vehículo creado correctamente</p>
</div>
@endif
  @if(Session::has('actualizado'))
<div class="alert alert-success">
    <p>Vehículo modificado correctamente</p>
</div>
@endif
  @if(Session::has('eliminado'))
<div class="alert alert-danger">
    <p>Vehículo eliminado correctamente</p>
</div>
@endif
<div class="row">
	<div class="col-sm-8 col-md-offset-2">
	<p><a href="{{ url('/validado/vehiculos/crear-vehiculo')}}" class="btn btn-primary" role="button">Registrar un nuevo vehiculo</a></p>
		@section ('cotable_panel_title','Listado de vehiculos')
		@section ('cotable_panel_body')
		<table class="table table-bordered">
			<thead>
				<tr class="info">
					<th>Placa</th>
					<th>Modelo</th>
					<th>Ubicación</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
			@foreach($vehiculos as $carro)
				<tr class="success">
					<td>{{$carro->placa}}</td>
					<td>{{$carro->modelo}}</td>
					<td>{{$carro->sede->nombre}}</td>
					<td><a href="/validado/vehiculos/editar-vehiculo?id={{$carro->placa}}" class="btn btn-success" role="button">Actualizar</a>
					<a href="/validado/vehiculos/eliminar-vehiculo?id={{$carro->placa}}" class="btn btn-danger" onclick="return confirm('Esta seguro que desea eliminar?')" role="button">Eliminar</a></td>
				</tr>
				@endforeach
			</tbody>
		</table>	
		@endsection
		@include('widgets.panel', array('header'=>true, 'as'=>'cotable'))
	</div>
</div>
@stop
