@extends('layouts.dashboard')
@section('page_heading','Envio de repuestos')
@section('section')
<div class="row">
    <div class="col-sm-12">
	
		@section ('cotable_panel_title','Listado de envios')
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
			@foreach($registros as $envio)
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
		<div class="col-md-6 <col-md-offset-4></col-md-offset-4>">
				<a class="btn btn-primary" href="/validado/envios">
				    Regresar
				</a>
        </div>		
		@endsection
		@include('widgets.panel', array('header'=>true, 'as'=>'cotable'))
	</div>
</div>
@stop
