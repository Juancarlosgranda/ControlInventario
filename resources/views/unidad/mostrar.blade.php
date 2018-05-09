@extends('layouts.dashboard')
@section('page_heading','Unidades de medida')
@section('section')
@if(Session::has('creado'))
<div class="alert alert-success">
    <p>La unidad de medida ha sido creado</p>
</div>
@endif
  @if(Session::has('actualizado'))
<div class="alert alert-success">
    <p>La unidad de medida ha sido modificada</p>
</div>
@endif
  @if(Session::has('eliminado'))
<div class="alert alert-danger">
    <p>La unidad de medida ha sido eliminada</p>
</div>
@endif
<div class="row">
	<div class="col-sm-6 col-md-offset-3">
	<p><a href="{{ url('/validado/unidad/crear-unidad')}}" class="btn btn-primary" role="button">Crear una nueva unidad de medida</a></p>
		@section ('cotable_panel_title','Listado de las unidades de medida')
		@section ('cotable_panel_body')
		<table class="table table-bordered">
			<thead>
				<tr class="info">
					<th>Código</th>
					<th>Unidad</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
			@foreach($unidades as $unidad)
				<tr class="success">
					<td>{{$unidad->id_unidad}}</td>
					<td>{{$unidad->nombre}}</td>
					<td><a href="/validado/unidad/editar-unidad?id={{$unidad->id_unidad}}" class="btn btn-success" role="button">Actualizar</a>
					<a href="/validado/unidad/eliminar-unidad?id={{$unidad->id_unidad}}" class="btn btn-danger" onclick="return confirm('Esta seguro que desea eliminar?')" role="button">Eliminar</a></td>
				</tr>
				@endforeach
			</tbody>
		</table>	
		@endsection
		@include('widgets.panel', array('header'=>true, 'as'=>'cotable'))
	</div>
</div>
@stop
