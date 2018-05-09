@extends('layouts.dashboard')
@section('page_heading','Repuestos por agotarse')
@section('section')
<div class="row">
	<div class="col-sm-12">
	<p><a href="{{ url('/validado/compras/crear-compra')}}" class="btn btn-primary" role="button">Realizar una nueva compra</a></p>
		@section ('cotable_panel_title','Productos por agotarse')
		@section ('cotable_panel_body')
		<table class="table table-bordered">
			<thead>
				<tr class="info">
					<th>Repuesto</th>
					<th>Stock mínimo</th>
					<th>Stock máximo</th>
					<th>Stock actual</th>
					<th>Sede</th>
				</tr>
			</thead>
			<?php  $a=0; ?>
			<tbody>
			@foreach($stocks as $stock)
			@if($a%2==0)
				<tr class="warning">
					<td>{{$stock->nombre}}</td>
					<td>{{$stock->stock_min}}</td>
					<td>{{$stock->stock_max}}</td>
					<td>{{$stock->stock_actual}}</td>
					<td>{{$stock->sede}}</td>
				</tr>
				@else
				<tr class="success">
					<td>{{$stock->nombre}}</td>
					<td>{{$stock->stock_min}}</td>
					<td>{{$stock->stock_max}}</td>
					<td>{{$stock->stock_actual}}</td>
					<td>{{$stock->sede}}</td>
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
