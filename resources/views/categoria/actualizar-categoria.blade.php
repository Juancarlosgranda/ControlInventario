@extends('layouts.dashboard')
@section('page_heading','Editar categoría')
@section('section')
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Editar</div>
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
					<form class="form-horizontal" role="form" method="POST" action="/validado/categoria/editar-categoria">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" value="{{ $categoria->id_categoria }}">
						<div class="form-group">
							<label class="col-md-4 control-label">Categoria: </label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="nombre" value="{{$categoria->nombre}}">
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
								<a class="btn btn-primary" href="/validado/categoria">
									Regresar
								</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		
@stop
