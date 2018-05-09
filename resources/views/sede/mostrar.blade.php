@extends('layouts.dashboard')
@section('page_heading','Sedes')
@section('section')
@if(Session::has('creado'))
<div class="alert alert-success">
    <p>La sede ha sido creada</p>
</div>
@endif
  @if(Session::has('actualizado'))
<div class="alert alert-success">
    <p>La sede ha sido modificada</p>
</div>
@endif
  @if(Session::has('eliminado'))
<div class="alert alert-danger">
    <p>La sede ha sido eliminada</p>
</div>
@endif
<div class="row">
	<div class="col-sm-6 col-md-offset-3">
	<p><a href="{{ url('/validado/sedes/crear-sede')}}" class="btn btn-primary" role="button">Crear una sede nueva</a></p>
		@section ('cotable_panel_title','Listado de las sedes')
		@section ('cotable_panel_body')
		<table class="table table-bordered">
			<thead>
				<tr class="info">
					<th>Código</th>
					<th>Ubicación de la sede</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
			@foreach($sedes as $sede)
				<tr class="success">
					<td>{{$sede->id_sede}}</td>
					<td>{{$sede->nombre}}</td>
					<td><a href="/validado/sedes/editar-sede?id={{$sede->id_sede}}" class="btn btn-success" role="button">Actualizar</a>
					<a href="/validado/sedes/eliminar-sede?id={{$sede->id_sede}}" class="btn btn-danger" onclick="return confirm('Esta seguro que desea eliminar?')" role="button">Eliminar</a></td>
				</tr>
				@endforeach
			</tbody>
		</table>	
		@endsection
		@include('widgets.panel', array('header'=>true, 'as'=>'cotable'))
	</div>
</div>
@stop
