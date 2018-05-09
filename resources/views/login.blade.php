@extends ('layouts.plane')
@section ('body')

<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
            <br /><br /><br />
               @section ('login_panel_title','Porfavor inicia sesión')
               @section ('login_panel_body')
                   @if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops! </strong> Al parecer algo esta mal.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					@if(Session::has('csrf'))
					<div class="alert alert-danger">
					    <strong>Whoops! </strong>Al parecer algo salio mal <br><br>
					    {{Session::get('csrf')}}
					</div>
                    @endif      
                    @if(Session::has('recuperada'))
					<div class="alert alert-success">
					    <strong>Whoops! </strong>Cambios realizados... <br><br>
					    {{Session::get('recuperada')}}
					</div>
                    @endif 
                       
                        <p></p>
                        <form role="form" method="POST" action="/validacion/inicio">
                           <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Usuario" name="email" type="email" autofocus value="{{ old('email') }}">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Contraseña" name="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Recuerdame
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" class="btn btn-lg btn-success btn-block">
									Iniciar sesión
								</button>
                                <p></p>
                                
                                <a href="/validacion/recuperar">Olvide mi contraseña</a>
                            </fieldset>
                        </form>
                    
                @endsection
                @include('widgets.panel', array('as'=>'login', 'header'=>true))
            </div>
        </div>
    </div>
@stop