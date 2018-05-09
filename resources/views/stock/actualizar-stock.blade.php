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

					<form class="form-horizontal" role="form" method="POST" action="/validado/stocks/editar-stock">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" value="{{ $stock->id_stock }}">
						<div class="form-group">
							<label class="col-md-4 control-label">Stock mínimo:</label>
							<div class="col-md-6">
								<input type="number" class="form-control" name="minimo" value="{{ $stock->stock_min }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Stock máximo:</label>
							<div class="col-md-6">
								<input type="number" class="form-control" name="maximo" value="{{ $stock->stock_max }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Stock actual</label>
							<div class="col-md-6">
								<input type="number" class="form-control" name="actual" value="{{ $stock->stock_actual }}">
							</div>
						</div>
						<div class="form-group">
						<div class="col-md-6 col-md-offset-4">
							<div class="col-md-6 col-md-offset-4" >
								<button type="submit" class="btn btn-primary">
									Actualizar
								</button>
								<p></p>
								<a class="btn btn-primary" href="/validado/stocks">
									Regresar
								</a>
							</div>
				        </div>
						</div>
						
					</form>
				</div>
			</div>
		</div>
@endsection
