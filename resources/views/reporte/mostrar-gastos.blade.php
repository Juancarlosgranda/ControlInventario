@extends('layouts.dashboard')
@section('page_heading','Generar reportes')
@section('section')

@if(Session::has('null2'))
<div class="alert alert-danger">
    <p>{{Session::get('null2')}}</p>
</div>
@endif
@if(Session::has('null'))
<div class="alert alert-danger">
    <p>{{Session::get('null')}}</p>
</div>
@endif
<div class="row">
	<div class="col-sm-12">
		@section ('grid15_panel_body')
           <h5><b>Generar reporte por fecha</b></h5><br>
            <form class="form-horizontal" role="form" method="POST" action="/validado/reportes/buscar-gastos">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
				<label class="col-md-4 control-label">Desde:</label>
				<div class="col-md-7">
				    <input type="date" class="form-control" name="fecha1" value="" required>
				</div>
				<BR></BR>
				<label class="col-md-4 control-label">a:</label>
				<div class="col-md-7">
				     <input type="date" class="form-control" name="fecha2" value="" required><br>
				</div>
            </div>
            <div class="form-group">
                <label  class="col-md-4 control-label" >Tipo de reporte:</label>
                <div class="col-md-7">
                <div class="radio-inline">
                    <label>
                        <input type="radio" name="reporte" id="optionsRadios1" value="1" checked>Pdf
                    </label>
                </div>
                
                <div class="radio-inline">
                    <label>
                        <input type="radio" name="reporte" id="optionsRadios2" value="2">Excel
                    </label>
                </div>
                </div>
            </div>
				<div class="form-group">
				    <div class="col-md-6 col-md-offset-4">
				        <button type="submit" class="btn btn-primary">
					    			Generar Reporte
				        </button>
				    </div>
				</div>
				</form>
		@endsection
		@include('widgets.panel', array('controls'=> true, 'as'=> 'grid15'))
		
	</div>
</div>
@stop
