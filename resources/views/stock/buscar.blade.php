@extends('layouts.dashboard')
@section('page_heading','Stocks en todas las sedes')
@section('section')
@if(Session::has('nohay'))
<div class="alert alert-success">
    <p>No se obtuvo resultados :c</p>
</div>
@endif
<div class="row">
	<div class="col-sm-12">
		@section ('cotable_panel_title','Listado de stocks')
		@section ('cotable_panel_body')
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Código</th>
					<th>Repuesto</th>
					<th>Cantidad</th>
					<th>Sede</th>
				</tr>
			</thead>
			<tbody>
			<?php $a=0;?>
			@foreach($stocks as $stock)
			@if($a%2==0)
				<tr class="success">
					<td>{{$stock->id_stock}}</td>
					<td>{{$stock->repuesto->nombre}}</td>
					<td>{{$stock->stock_actual}}</td>
					<td>{{$stock->sede->nombre}}</td>
				</tr>
            @else
            <tr>
					<td>{{$stock->id_stock}}</td>
					<td>{{$stock->repuesto->nombre}}</td>
					<td>{{$stock->stock_actual}}</td>
					<td>{{$stock->sede->nombre}}</td>
				</tr>
            @endif
            <?php  $a++;?>
				@endforeach
			</tbody>
		</table>	
		@endsection
		@include('widgets.panel', array('header'=>true, 'as'=>'cotable'))
	</div>
</div>
@stop
