@extends('layouts.dashboard')
@section('page_heading','Actualizar registro de repuesto')
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
					<form class="form-horizontal" role="form" method="POST" action="/validado/registros/editar-registro">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="id" value="{{ $registro->id_registro }}">
                    <div class="form-group">
                            <label class="col-md-4 control-label">Vehiculo: </label>
                            <div class="col-md-7">
                            <select class="form-control" name="carro"  onmousedown="if(this.options.length>8){this.size=10;}"  onchange='this.size=0;' onblur="this.size=0;">
                             @foreach($carros as $carro)
                             @if($registro->placa==$carro->placa)
								<option value='{{$carro->placa}}' selected>{{$carro->placa}}</option>
                             @else
									<option value='{{$carro->placa}}'>{{$carro->placa}}</option>
                            @endif
				            @endforeach
                            </select> 
                            </div>
                        </div>
				        <div class="form-group">
                            <label class="col-md-4 control-label">Repuesto: </label>
                            <div class="col-md-4">
                            <select class="form-control" name="repuesto"  onmousedown="if(this.options.length>8){this.size=10;}"  onchange='this.size=0;' onblur="this.size=0;">
                             @foreach($repuestos as $repuesto)
                             @if($registro->repuesto_id==$repuesto->id_repuesto)
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
							<div class="col-md-7">
								<input type="number" class="form-control" name="cantidad" value="{{$registro->cantidad}}"required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">fecha</label>
							<div class="col-md-7">
								<input type="date" class="form-control" name="fecha" value="{{$registro->fecha}}" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Mano de obra</label>
							<div class="col-md-7">
								<input type="number" step="0.01" class="form-control" name="costo" value="{{$registro->costo}}" required>
							</div>
				        </div> 
						<div class="form-group">
                            <label class="col-md-4 control-label">Ubicado en la sede de:: </label>
                            <div class="col-md-4">
                            <select class="form-control" name="sede">
                             @foreach($sedes as $sede)
									@if($registro->sede_id==$sede->id_sede)
									    <option value='{{$sede->id_sede}}' selected>{{$sede->nombre}}</option>
                                    @else
								        <option value="{{$sede->id_sede}}">{{$sede->nombre}}</option>
				                    @endif
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
								<a class="btn btn-primary" href="/validado/registros">
									Regresar
								</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
@stop
