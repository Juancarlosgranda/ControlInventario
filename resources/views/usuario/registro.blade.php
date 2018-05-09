@extends('layouts.dashboard')
@section('page_heading','Registrar nuevo usuario')
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

					<form class="form-horizontal" role="form" method="POST" action="/validado/usuario/registro">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Usuario</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Contraseña</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Confirmar contraseña</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Pregunta</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="pregunta">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Respuesta</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="respuesta">
							</div>
						</div>
						<div class="form-group">
                            <label class="col-md-4 control-label">Tipo de usuario:</label>
                            <div class="col-md-6">
                            <select class="form-control" name="tipo">
                                @foreach($tipos as $tipo)
									<option value="{{$tipo->id_tipo}}">{{$tipo->nombre}}</option>
								@endforeach
                            </select>
                            </div>
                        </div>
						 <div class="form-group">
                            <label class="col-md-4 control-label">En la sede de:</label>
                            <div class="col-md-6">
                            <select class="form-control" name="sede">
                             @foreach($sedes as $sede)
									<option value='{{$sede->id_sede}}'>{{$sede->nombre}}</option>
				            @endforeach
                            </select>
                            </div>
                        </div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Registrar
								</button>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<a class="btn btn-primary" href="/validado/usuario">
									Regresar
								</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
@stop
