@extends('layouts.dashboard')
@section('page_heading','Tipos de usuario')
@section('section')
@if(Session::has('creado'))
<div class="alert alert-success">
    <p>Tipo de usuario creado</p>
</div>
@endif
  @if(Session::has('actualizado'))
<div class="alert alert-success">
    <p>Tipo de usuario modificado</p>
</div>
@endif
  @if(Session::has('eliminado'))
<div class="alert alert-danger">
    <p>Tipo de usuario eliminado correctamente</p>
</div>
@endif
<div class="row">
	<div class="col-sm-6 col-md-offset-3">
	<p><a href="{{ url('/validado/tipo/crear-tipo')}}" class="btn btn-primary" role="button">Crear Tipo de Usuario</a></p>
		@section ('cotable_panel_title','Listado de tipos de usuario')
		@section ('cotable_panel_body')
		<table class="table table-bordered">
			<thead>
				<tr class="info">
					<th>Código</th>
					<th>Tipo de usuario</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
			@foreach($tipos as $tipo)
				<tr class="success">
					<td>{{$tipo->id_tipo}}</td>
					<td>{{$tipo->nombre}}</td>
					<td><a href="/validado/tipo/editar-tipo?id={{$tipo->id_tipo}}" class="btn btn-success" role="button">Actualizar</a>
					<a href="/validado/tipo/eliminar-tipo?id={{$tipo->id_tipo}}" class="btn btn-danger" onclick="return confirm('Esta seguro que desea eliminar?')" role="button">Eliminar</a></td>
				</tr>
				@endforeach
			</tbody>
		</table>	
		@endsection
		@include('widgets.panel', array('header'=>true, 'as'=>'cotable'))
	</div>
</div>
@stop
