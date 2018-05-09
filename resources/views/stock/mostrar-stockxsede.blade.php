@extends('layouts.dashboard')
@section('page_heading','Cantidad de repuestos')
@section('section')
<div class="row">
	<div class="col-sm-12">
		@section ('cotable_panel_title','Cantidad de respuestos')
		@section ('cotable_panel_body')
		<table class="table table-striped">
			<thead>
				<tr  class="info">
					<th>Repuesto</th>
					<th>Stock mínimo</th>
					<th>Stock máximo</th>
					<th>Stock actual</th>
					<th>Categoría</th>
					<th>Sede</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
			@foreach($stocks as $stock)
				<tr>
					<td>{{$stock->nombre}}</td>
					<td>{{$stock->stock_min}}</td>
					<td>{{$stock->stock_max}}</td>
					<td>{{$stock->stock_actual}}</td>
					<td>{{$stock->categoria}}</td>
					<td>{{$stock->sede}}</td>
					<td><a href="/validado/stocks/editar-stock?id={{$stock->id_stock}}" class="btn btn-success" role="button">Actualizar</a>
					<a href="/validado/stocks/eliminar-stock?id={{$stock->id_stock}}" class="btn btn-danger" onclick="return confirm('Esta seguro que desea eliminar?')" role="button">Eliminar</a></td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<div class="col-md-6 <col-md-offset-4></col-md-offset-4>">
				<a class="btn btn-primary" href="/validado/stocks">
				    Regresar
				</a>
        </div>	
		@endsection
		@include('widgets.panel', array('header'=>true, 'as'=>'cotable'))
	</div>
</div>
@stop
