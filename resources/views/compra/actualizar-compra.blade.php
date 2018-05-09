@extends('layouts.dashboard')
@section('page_heading','Actualizar compra')
@section('section')
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Actualizar</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> Algo salio mal.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					<form class="form-horizontal" role="form" method="POST" action="/validado/compras/editar-compra">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="id" value="{{ $compra->id_compra }}">
				        <div class="form-group">
                            <label class="col-md-4 control-label">Repuesto: </label>
                            <div class="col-md-4">
                            <select class="form-control" name="repuesto"  onmousedown="if(this.options.length>8){this.size=10;}"  onchange='this.size=0;' onblur="this.size=0;">
                             @foreach($repuestos as $repuesto)
                             @if($compra->repuesto_id==$repuesto->id_repuesto)
									<option value='{{$repuesto->id_repuesto}}' selected>{{$repuesto->nombre}}</option>
                             @else
                                     <option value='{{$repuesto->id_repuesto}}' >{{$repuesto->nombre}}</option>
                             @endif
				            @endforeach
                            </select> 
                            </div>
                        </div>
                        <div class="form-group">
							<label class="col-md-4 control-label">Cantidad:</label>
							<div class="col-md-6">
								<input type="number" class="form-control" name="cantidad" value="{{$compra->cantidad}}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Precio de compra</label>
							<div class="col-md-6">
								<input type="number" step="any" class="form-control" name="precio" value="{{$compra->precio_compra}}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">fecha</label>
							<div class="col-md-6">
								<input type="date" class="form-control" name="fecha" value="{{$compra->fecha}}">
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Grabar
								</button>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<a class="btn btn-primary" href="/validado/compras">
									Regresar
								</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
@stop
