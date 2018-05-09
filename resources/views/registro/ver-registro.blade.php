@extends('layouts.dashboard')
@section('page_heading','Registro de repuestos')
@section('section')
<div class="row">
	<div class="col-sm-12">
		
		@section ('cotable_panel_title','Resultados de la búsqueda')
		@section ('cotable_panel_body')
		<table class="table table-bordered">
			<thead>
				<tr class="info">
					<th>Placa</th>
					<th>Repuesto</th>
					<th>Cantidad</th>
					<th>Precio</th>
					<th>Fecha</th>
					<th>Sede</th>
					<th>Mano de obra</th>
					@if(Auth::user()->tipo_id==1)
					<th>Acciones</th>
					@endif
				</tr>
			</thead>
			<tbody>
			@foreach($registros as $registro)
				<tr class="success">
					<td>{{$registro->placa}}</td>
					<td>{{$registro->repuesto->nombre}}</td>
					<td>{{$registro->cantidad}}</td>
					<td>{{$registro->precio}}</td>
					<td>{{$registro->fecha}}</td>
					<td>{{$registro->sede->nombre}}</td>
					<td>{{$registro->costo}}</td>
					@if(Auth::user()->tipo_id==1)
					<td><a href="/validado/registros/editar-registro?id={{$registro->id_registro}}" class="btn btn-success" role="button">Actualizar</a>
					<a href="/validado/registros/eliminar-registro?id={{$registro->id_registro}}" class="btn btn-danger" onclick="return confirm('Esta seguro que desea eliminar?')" role="button">Eliminar</a></td>
					@endif
				</tr>
				@endforeach
			</tbody>
		</table>
		<div class="col-md-6 <col-md-offset-4></col-md-offset-4>">
				<a class="btn btn-primary" href="/validado/registros">
				    Regresar
				</a>
        </div>		
		@endsection
		@include('widgets.panel', array('header'=>true, 'as'=>'cotable'))
	</div>
</div>
@stop
