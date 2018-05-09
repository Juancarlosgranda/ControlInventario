@extends ('layouts.plane')
@section ('body')
<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
            <br /><br /><br />
               @section ('login_panel_title','Recuperar contraseña')
               @section ('login_panel_body')
                       @if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong>Al parecer algoe sta mal.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
                        <p></p>
                       <form class="form-horizontal" role="form" method="POST" action="/validacion/recuperar">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Correo Electronico</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label"> Nueva contraseña</label>
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
								<input type="password" class="form-control" name="pregunta">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Respuesta</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="respuesta">
							</div>
						</div>
						

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Recuperar contraseña
								</button>
							</div>
						</div>
					</form>
                @endsection
                @include('widgets.panel', array('as'=>'login', 'header'=>true))
            </div>
        </div>
    </div>
@stop
