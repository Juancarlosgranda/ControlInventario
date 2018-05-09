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
            <div class="alert alert-success">
                {{Session::get('nohay')}}
            </div>
            @endif
           
@stop
