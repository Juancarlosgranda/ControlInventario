@extends('layouts.dashboard')
@section('page_heading','Uso de repuestos')
@section('section')
<div class="row">
	<div class="col-sm-12">
		@section ('cotable_panel_title','Productos registrados el día de hoy')
		@section ('cotable_panel_body')
		<table class="table table-bordered">
			<thead>
				<tr class="info">
				    <th>Código</th>
					<th>Repuesto</th>
					<th>Cantidad</th>
					<th>Fecha</th>
					<th>Placa</th>
					<th>Sede</th>
					<th>Mano de obra</th>
				</tr>
			</thead>
			<?php  $a=0; ?>
			<tbody>
			@foreach($registros as $registro)
			@if($a%2==0)
				<tr class="warning">
				    <td>{{$registro->id_registro}}</td>
					<td>{{$registro->repuesto->nombre}}</td>
					<td>{{$registro->cantidad}}</td>
					<td>{{$registro->fecha}}</td>
					<td>{{$registro->placa}}</td>
					<td>{{$registro->sede->nombre}}</td>
					<td>{{$registro->costo}}</td>
				</tr>
				@else
				<tr class="success">
					 <td>{{$registro->id_registro}}</td>
					<td>{{$registro->repuesto->nombre}}</td>
					<td>{{$registro->cantidad}}</td>
					<td>{{$registro->fecha}}</td>
					<td>{{$registro->placa}}</td>
					<td>{{$registro->sede->nombre}}</td>
					<td>{{$registro->costo}}</td>
				</tr>
				@endif
				<?php $a++; ?>
				@endforeach
			</tbody>
		</table>
		<div class="col-md-6 <col-md-offset-4></col-md-offset-4>">
				<a class="btn btn-primary" href="/validado">
				    Regresar
				</a>
        </div>
		@endsection
		@include('widgets.panel', array('header'=>true, 'as'=>'cotable'))
	</div>
</div>
@stop
