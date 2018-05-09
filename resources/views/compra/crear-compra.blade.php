@extends('layouts.dashboard')
@section('page_heading','Registrar una compra de repuestos')
@section('section')
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Registrar</div>
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
					<form class="form-horizontal" role="form" method="POST" action="/validado/compras/crear-compra">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
                            <label class="col-md-4 control-label">Repuesto: </label>
                            <div class="col-md-6">
                            <select class="form-control" name="repuesto"  onmousedown="if(this.options.length>8){this.size=10;}"  onchange='this.size=0;' onblur="this.size=0;">
                             @foreach($repuestos as $repuesto)
									<option value='{{$repuesto->id_repuesto}}'>{{$repuesto->nombre.'.  '. $repuesto->unidad_medida->nombre}}</option>
				            @endforeach
                            </select> 
                            </div>
                        </div>
                        <div class="form-group">
							<label class="col-md-4 control-label">Cantidad:</label>
							<div class="col-md-6">
								<input type="number" class="form-control" name="cantidad">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Precio de compra</label>
							<div class="col-md-6">
								<input type="number" step="0.01" class="form-control" name="precio" value="">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Fecha:</label>
							<div class="col-md-6">
								<input type="date" class="form-control" name="fecha" value="{{$fecha}}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Factura: </label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="factura" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Guía de remisión:</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="remision" required>
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
