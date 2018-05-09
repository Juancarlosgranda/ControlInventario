@extends('layouts.dashboard')
@section('page_heading','Stocks en todas las sedes')
@section('section')
@if(Session::has('creado'))
<div class="alert alert-success">
    <p>El stock ha sido creado</p>
</div>
@endif
  @if(Session::has('actualizado'))
<div class="alert alert-success">
    <p>Se modifico el stock correctamente</p>
</div>
@endif
  @if(Session::has('eliminado'))
<div class="alert alert-danger">
    <p>El stokc ha sido eliminado</p>
</div>
@endif
  @if(Session::has('existe'))
<div class="alert alert-danger">
    <p>{{Session::get('existe')}}</p>
</div>
@endif

<div class="row">
	<div class="col-sm-12">
	<form class="form-horizontal" role="form" method="POST" action="/validado/stocks/ver">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<fieldset class="form-group">
        <label class="col-md-4 control-label">Visualizar stock en:</label>
        <div class="col-md-4">
            <select class="form-control" name="sede">
            @foreach($sedes as $sede)
				<option value="{{$sede->id_sede}}">{{$sede->nombre}}</option>
            @endforeach
            <option value="all">En todas las sedes</option>
        </select>
        </div>
    </fieldset>
    <fieldset class="form-group">
        <label class="col-md-4 control-label">Categoría:</label>
        <div class="col-md-4">
            <select class="form-control" name="cate">
            @foreach($cates as $cate)
				<option value="{{$cate->id_categoria}}">{{$cate->nombre}}</option>
            @endforeach
            <option value="all">En todas las categorias</option>

        </select>
        </div>
    </fieldset>
	<div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
            	Ver Stocks
            </button>
        </div>
    </div>
    </form>
    <p><a href="{{ url('/validado/stocks/crear-stock')}}" class="btn btn-primary" role="button">Registrar un nuevo stock</a></p>
    <p></p>
		@section ('cotable_panel_title','Listado de stocks')
		@section ('cotable_panel_body')
		<table class="table table-striped">
			<thead>
				<tr class="success">
					<th>Código</th>
					<th>Repuesto</th>
					<th>Categoría</th>
					<th>Cantidad</th>
					<th>Sede</th>
				</tr>
			</thead>
			<tbody>
			@foreach($stocks as $stock)
				<tr>
					<td>{{$stock->id_stock}}</td>
					<td>{{$stock->repuesto->nombre}}</td>
					<td>{{$stock->repuesto->categoria->nombre}}</td>
					<td>{{$stock->stock_actual}}</td>
					<td>{{$stock->sede->nombre}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>	
		@endsection
		@include('widgets.panel', array('header'=>true, 'as'=>'cotable'))
	</div>
</div>
@stop
