@extends('layouts.dashboard')
@section('page_heading','Bienvenido')
@section('section')
     @if(Session::has('error'))
     <div class="alert alert-danger">
     <strong>Whoops!</strong>Al parecer algo salio mal<br><br>
     {{Session::get('error')}}
     </div>
     @endif
       @if(Session::has('nohay'))
            <div class="alert alert-danger">
                {{Session::get('nohay')}}
            </div>
    @endif
            <div class="col-md-12">
<div class="col-md-3"></div> <div class="col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-legal fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">{{$registros}}</div>
                                    <div>Productos por agotarse</div>
                                </div>
                            </div>
                        </div>
                        <a href="{{ url('/validado/ver')}}">
                            <div class="panel-footer">
                                <span class="pull-left">Ver los Detalles</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div><div class="col-md-3"></div>
                </div>
        <div class="col-md-12">
        <div class="col-md-3"></div> <div class="col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">{{$registrados}}</div>
                                    <div>¡Registros de repuesto se realizaron hoy!</div>
                                </div>
                            </div>
                        </div>
                        <a href="{{ url('/validado/ver-registro')}}">
                            <div class="panel-footer">
                                <span class="pull-left">Ver los Detalles</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
            </div><div class="col-md-3"></div>
            </div>
    

	
	
@stop
