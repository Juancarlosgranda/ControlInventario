@extends('layouts.dashboard')
@section('page_heading','Registrar un nuevo repuesto')
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
					<form class="form-horizontal" role="form" method="POST" action="/validado/repuestos/crear-sede">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<label class="col-md-4 control-label">Nombre</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="nombre" value="">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Precio</label>
							<div class="col-md-6">
								<input type="number" step="0.01" class="form-control" name="precio" value="">
							</div>
						</div>
						<div class="form-group">
                            <label class="col-md-4 control-label">Unidad de medida: </label><div class="col-md-4">
                            <select class="form-control" name="unidad">
                             @foreach($unidades as $unidad)
									<option value='{{$unidad->id_unidad}}'>{{$unidad->nombre}}</option>
				            @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Categoría: </label><div class="col-md-4">
                            <select class="form-control" name="categoria">
                             @foreach($categorias as $categoria)
									<option value='{{$categoria->id_categoria}}'>{{$categoria->nombre}}</option>
				            @endforeach
                            </select>
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
								<a class="btn btn-primary" href="/validado/repuestos">
									Regresar
								</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
@stop
