@extends('layouts.dashboard')
@section('page_heading','Categorías')
@section('section')
@if(Session::has('creado'))
<div class="alert alert-success">
    <p>categoría creada</p>
</div>
@endif
  @if(Session::has('actualizado'))
<div class="alert alert-success">
    <p>categoría modificada</p>
</div>
@endif
  @if(Session::has('eliminado'))
<div class="alert alert-danger">
    <p>categoría eliminada</p>
</div>
@endif
<div class="row">
	<div class="col-sm-8 col-md-offset-2">
	<p><a href="{{ url('/validado/categoria/crear-categoria')}}" class="btn btn-primary" role="button">Crear categoría</a></p>
		@section ('cotable_panel_title','Listado de categorías de repuestos')
		@section ('cotable_panel_body')
		<table class="table table-bordered">
			<thead>
				<tr class="info">
					<th>Código</th>
					<th>Categoría</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
			@foreach($categorias as $categoria)
				<tr class="success">
					<td>{{$categoria->id_categoria}}</td>
					<td>{{$categoria->nombre}}</td>
					<td><a href="/validado/categoria/editar-categoria?id={{$categoria->id_categoria}}" class="btn btn-success" role="button">Actualizar</a>
					<a href="/validado/categoria/eliminar-categoria?id={{$categoria->id_categoria}}" class="btn btn-danger" onclick="return confirm('Esta seguro que desea eliminar?')" role="button">Eliminar</a></td>
				</tr>
				@endforeach
			</tbody>
		</table>	
		@endsection
		@include('widgets.panel', array('header'=>true, 'as'=>'cotable'))
	</div>
</div>
@stop