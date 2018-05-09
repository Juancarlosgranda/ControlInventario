@extends('layouts.dashboard')
@section('page_heading','Registrar un nuevo stock')
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
					<form class="form-horizontal" role="form" method="POST" action="/validado/stocks/crear-stock">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
                            <label class="col-md-4 control-label">Repuesto: </label>
                            <div class="col-md-4">
                            <select class="form-control" name="repuesto" onmousedown="if(this.options.length>8){this.size=10;}"  onchange='this.size=0;' onblur="this.size=0;">
                             @foreach($repuestos as $repuesto)
									<option value='{{$repuesto->id_repuesto}}'>{{$repuesto->nombre}}</option>
				            @endforeach
                            </select> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Ubicado en la sede de:: </label>
                            <div class="col-md-4">
                            <select class="form-control" name="sede">
                             @foreach($sedes as $sede)
									<option value='{{$sede->id_sede}}'>{{$sede->nombre}}</option>
				            @endforeach
                            </select>
                            </div>
                        </div>
						<div class="form-group">
							<label class="col-md-4 control-label">Stock mínimo:</label>
							<div class="col-md-6">
								<input type="number" class="form-control" name="minimo">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Stock máximo:</label>
							<div class="col-md-6">
								<input type="number" class="form-control" name="maximo">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Stock actual</label>
							<div class="col-md-6">
								<input type="number" class="form-control" name="actual">
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
								<a class="btn btn-primary" href="/validado/stocks">
									Regresar
								</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
@stop
