@extends('layouts.dashboard')
@section('page_heading','Actualizar registro de envio')
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
					<form class="form-horizontal" role="form" method="POST" action="/validado/envios/editar-envio">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="id" value="{{ $envio->id_envio }}">
				        <div class="form-group">
                            <label class="col-md-4 control-label">Repuesto: </label>
                            <div class="col-md-4">
                            <select class="form-control" name="repuesto"  onmousedown="if(this.options.length>8){this.size=10;}"  onchange='this.size=0;' onblur="this.size=0;">
                             @foreach($repuestos as $repuesto)
                             @if($envio->repuesto_id==$repuesto->id_repuesto)
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
								<input type="number" class="form-control" name="cantidad" value="{{$envio->cantidad}}">
							</div>
						</div>
						<div class="form-group">
                            <label class="col-md-4 control-label">Ubicado en la sede de:: </label>
                            <div class="col-md-4">
                            <select class="form-control" name="sede">
                             @foreach($sedes as $sede)
									@if($envio->sede_id==$sede->id_sede)
									    <option value='{{$sede->id_sede}}' selected>{{$sede->nombre}}</option>
                                    @else
								        <option value="{{$sede->id_sede}}">{{$sede->nombre}}</option>
				                    @endif
				            @endforeach
                            </select>
                            </div>
                        </div>
						<div class="form-group">
							<label class="col-md-4 control-label">fecha</label>
							<div class="col-md-6">
								<input type="date" class="form-control" name="fecha" value="{{$envio->fecha}}">
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
								<a class="btn btn-primary" href="/validado/envios">
									Regresar
								</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
@stop
