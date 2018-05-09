@extends('layouts.dashboard')
@section('page_heading','Usuarios')
@section('section')
@if(Session::has('creado'))
<div class="alert alert-success">
    <p>El usuario fue creado correctamente</p>
</div>
@endif
  @if(Session::has('actualizado'))
<div class="alert alert-success">
    <p>El usuario fue modificado correctamente</p>
</div>
@endif
  @if(Session::has('eliminado'))
<div class="alert alert-danger">
    <p>El usuario fue eliminado correctamente</p>
</div>
@endif

<div class="row">
	<div class="col-sm-10 col-md-offset-1">
	<p><a href="{{ url('/validado/usuario/registro')}}" class="btn btn-primary" role="button">Crear Usuario</a></p>
		@section ('cotable_panel_title','Listado de usuarios')
		@section ('cotable_panel_body')
		<table class="table table-bordered">
			<thead>
				<tr class="info">
					<th>Código</th>
					<th>Email</th>
					<th>Tipo de usuario</th>
					<th>Ubicación</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
			@foreach($usuarios as $usuario)
				<tr class="success">
					<td>{{$usuario->id}}</td>
					<td>{{$usuario->email}}</td>
					<td>{{$usuario->tipo->nombre}}</td>
					<td>{{$usuario->sede->nombre}}</td>
					<td><a href="/validado/usuario/editar-perfil/{{$usuario->id}}" class="btn btn-success" role="button">Actualizar</a>
					<a href="/validado/usuario/eliminar?id={{$usuario->id}}" class="btn btn-danger" onclick="return confirm('Esta seguro que desea eliminar?')" role="button">Eliminar</a></td>
				</tr>
				@endforeach
			</tbody>
		</table>	
		@endsection
		@include('widgets.panel', array('header'=>true, 'as'=>'cotable'))
	</div>
</div>
@stop
