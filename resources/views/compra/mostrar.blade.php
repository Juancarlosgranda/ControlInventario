@extends('layouts.dashboard')
@section('page_heading','Compra de repuestos')
@section('section')
@if(Session::has('creado'))
<div class="alert alert-success">
    <p>La compra ha sido realizada y se actualizó el stock principal</p>
</div>
@endif
@if(Session::has('seacreado'))
<div class="alert alert-success">
    <p>La compra ha sido realizada y se creo el repuesto en el stock principal</p>
</div>
@endif
  @if(Session::has('actualizado'))
<div class="alert alert-success">
    <p>La compra ha sido modificada</p>
</div>
@endif
  @if(Session::has('eliminado'))
<div class="alert alert-danger">
    <p>La compra ha sido eliminada</p>
</div>
 @endif
  @if(Session::has('bus'))
<div class="alert alert-danger">
    <p>{{Session::get('bus')}}</p>
</div>
 @endif
  @if(Session::has('bus2'))
<div class="alert alert-danger">
    <p>{{Session::get('bus2')}}</p>
</div>
@endif
<div class="row">    
   <div class="col-sm-12">
    @section ('grid14_panel_body')
           <h5><b>Buscar registros de las compras </b></h5><br>
            <form class="form-horizontal" role="form" method="POST" action="/validado/compras/ver-compra">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
				<label class="col-md-4 control-label">Desde:</label>
				<div class="col-md-7">
				    <input type="date" class="form-control" name="fecha1" value="" required>
				</div>
				<BR></BR>
				<label class="col-md-4 control-label">a:</label>
				<div class="col-md-7">
				     <input type="date" class="form-control" name="fecha2" value="" required><br>
				</div>
            </div>
            <div class="form-group">
				    <div class="col-md-6 col-md-offset-4">
				        <button type="submit" class="btn btn-primary">
					    			Buscar
				        </button>
				    </div>
				</div>
				</form>
		@endsection
		@include('widgets.panel', array('controls'=> true, 'as'=> 'grid14'))
    
    </div>
	<div class="col-sm-12">
	<p><a href="{{ url('/validado/compras/crear-compra')}}" class="btn btn-primary" role="button">Realizar una nueva compra</a></p>
		@section ('cotable_panel_title','Listado de las 20 últimas compras')
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
			@foreach($compras as $compra)
				<tr>
					<td>{{$compra->id_compra}}</td>
					<td>{{$compra->repuesto->nombre}}</td>
					<td>{{$compra->cantidad}}</td>
					<td>{{$compra->precio_compra}}</td>
					<td>{{$compra->fecha}}</td>
					<td>{{$compra->factura.' / '.$compra->remision}}</td>
					<td><a href="/validado/compras/editar-compra?id={{$compra->id_compra}}" class="btn btn-success" role="button">Actualizar</a>
					<a href="/validado/compras/eliminar-compra?id={{$compra->id_compra}}" class="btn btn-danger" onclick="return confirm('Esta seguro que desea eliminar?')" role="button">Eliminar</a></td>
				</tr>
				@endforeach
			</tbody>
		</table>	
		@endsection
		@include('widgets.panel', array('header'=>true, 'as'=>'cotable'))
	</div>
</div>
@stop