@extends('layouts.dashboard')
@section('page_heading','Registrar un nuveo vehiculo')
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
					<form class="form-horizontal" role="form" method="POST" action="/validado/vehiculos/crear-vehiculo">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Placa</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="placa" value="">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Modelo</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="modelo" value="">
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
								<a class="btn btn-primary" href="/validado/vehiculos">
									Regresar
								</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
@stop
