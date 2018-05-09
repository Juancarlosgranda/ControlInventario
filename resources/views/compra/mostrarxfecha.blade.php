@extends('layouts.dashboard')
@section('page_heading','Compras de repuestos')
@section('section')
<div class="row">
    <div class="col-sm-12">
	
		@section ('cotable_panel_title','Listado de las compras')
		@section ('cotable_panel_body')
		<table class="table table-striped">
			<thead>
				<tr class="info">
					<th>Código</th>
					<th>Repuesto</th>
					<th>Cantidad</th>
					<th>Costo</th>
					<th>Fecha de compra</th>
					<th>Factura/Guía de remisión</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
			@foreach($registros as $registro)
				<tr>
					<td>{{$registro->id_compra}}</td>
					<td>{{$registro->repuesto->nombre}}</td>
					<td>{{$registro->cantidad}}</td>
					<td>{{$registro->precio_compra}}</td>
					<td>{{$registro->fecha}}</td>
					<td>{{$registro->factura.' / '.$registro->remision}}</td>
					<td><a href="/validado/compras/editar-compra?id={{$registro->id_compra}}" class="btn btn-success" role="button">Actualizar</a>
					<a href="/validado/compras/eliminar-compra?id={{$registro->id_compra}}" class="btn btn-danger" onclick="return confirm('Esta seguro que desea eliminar?')" role="button">Eliminar</a></td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<div class="col-md-6 <col-md-offset-4></col-md-offset-4>">
				<a class="btn btn-primary" href="/validado/compras">
				    Regresar
				</a>
        </div>		
		@endsection
		@include('widgets.panel', array('header'=>true, 'as'=>'cotable'))
	</div>
</div>
@stop
