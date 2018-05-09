@extends('layouts.plane')
@section('body')

 <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <img src="/img/logo3.PNG" width=100 height=50 /><a class="navbar-brand" href="#"><b>  H&C TRANSPORTE. HERNAN COLLADO BLANCO. S.R.L</b></a>
            </div>
            <!-- /.navbar-header -->
            
            <ul class="nav navbar-top-links navbar-right">
               
                <!-- /Menu de el logueado -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> {{Auth::user()->tipo->nombre}} <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="{{ url ('/validacion/salida') }}"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.Termina el menu del logueado -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                       <li class="sidebar-search">
                           @if((Auth::user()->tipo_id)==1)
                           <form  class="form-horizontal" role="form" method="POST" action="/validado/stocks/show">
						    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control"  name="buscar"placeholder="Buscar...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="submit" >
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            </form>
                            @else
                            <fieldset disabled>
                            <form  class="form-horizontal" role="form" method="POST" action="/validado/stocks/show">
						    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control"  name="buscar"placeholder="Buscar...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="submit" >
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            </form>
                           </fieldset>
                            @endif
                            <!-- /input-group -->
                        </li>
                        
                        @if((Auth::user()->tipo_id)==1)
                        <li {{ (Request::is('/') ? 'class="active"' : '') }}>
                            <a href="{{ url ('/validado') }}"><i class="fa fa-home fa-fw"></i> Página principal</a>
                        </li>
                        <li >
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> Mantenimientos<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li {{ (Request::is('*icons') ? 'class="active"' : '') }}>
                                    <a href="{{ url ('/validado/categoria') }}" ><i class="fa fa-bookmark-o fa-fw"></i> Categorías</a>
                                </li>
                                <li {{ (Request::is('*panels') ? 'class="active"' : '') }}>
                                    <a href="{{ url('/validado/repuestos') }}" ><i class="fa fa-gavel fa-fw"></i> Repuestos</a>
                                </li>
                                <li {{ (Request::is('*buttons') ? 'class="active"' : '') }}>
                                    <a href="{{ url ('/validado/sedes' ) }}" ><i class="fa fa-plane fa-fw"></i> Sedes</a>
                                </li>
                                <li {{ (Request::is('*notifications') ? 'class="active"' : '') }}>
                                    <a href="{{ url('/validado/tipo') }}" ><i class="fa fa-sitemap fa-fw"></i> Tipos de usuario</a>
                                </li>
                                <li {{ (Request::is('*typography') ? 'class="active"' : '') }}>
                                    <a href="{{ url ('/validado/unidad') }}" ><i class="fa fa-thumb-tack fa-fw"></i> Unidades de medida</a>
                                </li>
                                <li {{ (Request::is('*icons') ? 'class="active"' : '') }}>
                                    <a href="{{ url ('/validado/usuario') }}" ><i class="fa fa-group fa-fw"></i> Usuarios</a>
                                </li>
                                <li {{ (Request::is('*grid') ? 'class="active"' : '') }}>
                                    <a href="{{ url ('/validado/vehiculos') }}" ><i class="fa fa-car fa-fw"></i> Vehiculos</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li >
                            <a href="#"><i class="fa fa-user-md fa-fw"></i> Operaciones<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li {{ (Request::is('*panels') ? 'class="active"' : '') }}>
                                    <a href="{{ url ('validado/registros') }}"><i class="fa fa-pencil-square fa-fw"></i> Registrar el uso de repuesto</a>
                                </li>
                                <li {{ (Request::is('*buttons') ? 'class="active"' : '') }}>
                                    <a href="{{ url ('/validado/envios' ) }}"><i class="fa fa-truck fa-fw"></i> Registrar envios</a>
                                </li>
                                <li {{ (Request::is('*notifications') ? 'class="active"' : '') }}>
                                    <a href="{{ url('/validado/compras') }}"><i class="fa fa-shopping-cart fa-fw"></i> Registrar compras</a>
                                </li>
                                <li {{ (Request::is('*typography') ? 'class="active"' : '') }}>
                                    <a href="{{ url ('/validado/stocks') }}"><i class="fa fa-eye fa-fw"></i> Visualizar stocks</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li >
                            <a href="#"><i class="fa fa-edit fa-fw"></i> Reportes<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li {{ (Request::is('*panels') ? 'class="active"' : '') }}>
                                   <a href="{{ url ('/validado/reportes/buscar-gastos') }}"><i class="fa fa-building fa-fw"></i> Gastos por respuestos</a>
                                </li>
                                <li {{ (Request::is('*buttons') ? 'class="active"' : '') }}>
                                    <a href="{{ url ('/validado/reportes/buscar-usos') }}"><i class="fa fa-building fa-fw"></i> Repuestos usados por carro</a>
                                </li>
                                <li {{ (Request::is('*buttons') ? 'class="active"' : '') }}>
                                    <a href="{{ url ('/validado/reportes/reportes') }}"><i class="fa fa-building fa-fw"></i> Reportes en general</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        @else
                        <li {{ (Request::is('*panels') ? 'class="active"' : '') }}>
                           <a href="{{ url ('validado/registros') }}"><i class="fa fa-pencil-square fa-fw"></i> Registrar el uso de repuesto</a>
                        </li>
                        @endif
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
     <div id="page-wrapper">
			 <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">@yield('page_heading')</h1>
                </div>
                <!-- /.col-lg-12 -->
           </div>
			<div class="row">  
				@yield('section')

            </div>
            <!-- /#page-wrapper -->
        </div>
</div>
@stop

