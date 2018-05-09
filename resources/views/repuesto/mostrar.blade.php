@extends('layouts.dashboard')
@section('page_heading','Repuestos')
@section('section')
@if(Session::has('creado'))
<div class="alert alert-success">
    <p>El repuesto ha sido creado</p>
</div>
@endif
  @if(Session::has('actualizado'))
<div class="alert alert-success">
    <p>El repuesto ha sido modificado</p>
</div>
@endif
  @if(Session::has('eliminado'))
<div class="alert alert-danger">
    <p>El repuesto ha sido eliminado</p>
</div>
@endif
<div class="row">
	<div class="col-sm-12">
	<p><a href="{{ url('/validado/repuestos/crear-repuesto')}}" class="btn btn-primary" role="button">Crear un nuevo repuesto</a></p>
		@section ('cotable_panel_title','Listado de los repuestos')
		@section ('cotable_panel_body')
		<table class="table table-bordered">
			<thead>
				<tr class="info">
					<th>Código</th>
					<th>Repuesto</th>
					<th>Precio</th>
					<th>Unidad de medida</th>
					<th>Categoría</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
			@foreach($repuestos as $repuesto)
				<tr class="success">
					<td>{{$repuesto->id_repuesto}}</td>
					<td>{{$repuesto->nombre}}</td>
					<td>{{$repuesto->precio}}</td>
					<td>{{$repuesto->unidad_medida->nombre}}</td>
					<td>{{$repuesto->categoria->nombre}}</td>
					<td><a href="/validado/repuestos/editar-repuesto?id={{$repuesto->id_repuesto}}" class="btn btn-success" role="button">Actualizar</a>
					<a href="/validado/repuestos/eliminar-repuesto?id={{$repuesto->id_repuesto}}" class="btn btn-danger" onclick="return confirm('Esta seguro que desea eliminar?')" role="button">Eliminar</a></td>
				</tr>
				@endforeach
			</tbody>
		</table>	
		@endsection
		@include('widgets.panel', array('header'=>true, 'as'=>'cotable'))
	</div>
</div>
@stop
