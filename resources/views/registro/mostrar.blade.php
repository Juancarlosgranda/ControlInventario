@extends('layouts.dashboard')
@section('page_heading','Registro de repuestos')
@section('section')

@if(Session::has('welcome'))
<div class="alert alert-warning">
    <p>{{Session::get('welcome')}}</p>
</div>
@endif
@if(Session::has('creado'))
<div class="alert alert-success">
    <p>{{Session::get('creado')}}</p>
</div>
@endif
 @if(Session::has('actualizado'))
<div class="alert alert-success">
    <p>{{Session::get('actualizado')}}</p>
</div>
@endif
  @if(Session::has('eliminado'))
<div class="alert alert-danger">
    <p>{{Session::get('eliminado')}}</p>
</div>
@endif
 @if(Session::has('null'))
<div class="alert alert-danger">
    <p>{{Session::get('null')}}</p>
</div>
@endif
 @if(Session::has('null2'))
<div class="alert alert-danger">
    <p>{{Session::get('null2')}}</p>
</div>
@endif
 @if(Session::has('nel'))
<div class="alert alert-warning">
    <p>{{Session::get('nel')}}</p>
</div>
@endif
 @if(Session::has('nel1'))
<div class="alert alert-warning">
    <p>{{Session::get('nel1')}}</p>
</div>
@endif
<div class="row">
    <div class="col-sm-4">
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
        </div>
		@section ('grid11_panel_body')
       <h5><b>Registrar el uso de un repuesto </b> </h5><br>
       
        <form class="form-horizontal" role="form" method="POST" action="/validado/registros/crear-registro">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
                            <label class="col-md-4 control-label">Vehiculo: </label>
                            <div class="col-md-7">
                            <select class="form-control" name="carro"  onmousedown="if(this.options.length>8){this.size=10;}"  onchange='this.size=0;' onblur="this.size=0;">
                             @foreach($carros as $carro)
									<option value='{{$carro->placa}}'>{{$carro->placa}}</option>
				            @endforeach
                            </select> 
                            </div>
                        </div>
                        <div class="form-group">
                         <label class="col-md-4 control-label">Repuesto:</label>
                            <div class="col-md-7">
                            <select class="form-control" name="repuesto" id="repuesto" onmousedown="if(this.options.length>8){this.size=10;}"  onchange='this.size=0;' onblur="this.size=0;">
                            @foreach($repuestos as $repuesto)
									<option value='{{$repuesto->id_repuesto}}'>{{$repuesto->nombre.' '. $repuesto->unidad_medida->nombre}}</option>
                           @endforeach
                            </select>
                            
                            </div>
                        </div>
                        <div class="form-group">
							<label class="col-md-4 control-label">Cantidad:</label>
							<div class="col-md-7">
								<input type="number" class="form-control" name="cantidad" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">fecha</label>
							<div class="col-md-7">
								<input type="date" class="form-control" name="fecha" value="{{$fecha}}" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Mano de obra</label>
							<div class="col-md-7">
								<input type="number" step="0.01" class="form-control" name="costo" value="" required>
							</div>
				        </div> 
						@if(Auth::user()->tipo_id==1)
						<div class="form-group">
                            <label class="col-md-4 control-label">En la sede de:</label>
                            <div class="col-md-7">
                            <select class="form-control" name="sede">
                             @foreach($sedes as $sede)
									<option value='{{$sede->id_sede}}'>{{$sede->nombre}}</option>
				             @endforeach
                            </select>
                            </div>
                        </div>
                        @else
                        <div class="form-group">
                            <label class="col-md-4 control-label">Ubicado en la sede de:</label>
                            <div class="col-md-7">
                            <select class="form-control" name="sede">
								<option value='{{Auth::user()->sede_id}}'>{{Auth::user()->sede->nombre}}</option>
                            </select>
                            </div>
                        </div>
                        @endif
                        
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary" onclick="return confirm('Antes de grabar, serciorese que los datos a registrarse sean los correctos, una vez verificado presione aceptar')">
									Grabar
								</button>
							</div>
						</div>
					</form>
		@endsection
		@include('widgets.panel', array('controls'=> true, 'as'=> 'grid11'))
		@section ('grid14_panel_body')
           <h5><b>Buscar registros </b></h5><br>
            <form class="form-horizontal" role="form" method="POST" action="/validado/registros/ver-registro">
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
            @if(Auth::user()->tipo_id==1)
						<div class="form-group">
                            <label class="col-md-4 control-label">En la sede:</label>
                            <div class="col-md-7">
                            <select class="form-control" name="sede">
                             @foreach($sedes as $sede)
									<option value='{{$sede->id_sede}}'>{{$sede->nombre}}</option>
				            @endforeach
                            </select>
                            </div>
                        </div>
                        @else
                        <div class="form-group">
                            <label class="col-md-4 control-label">En la sede de:</label>
                            <div class="col-md-7">
                            <select class="form-control" name="sede">
								<option value='{{Auth::user()->sede_id}}'>{{Auth::user()->sede->nombre}}</option>
                            </select>
                            </div>
                        </div>
                        @endif 
                  
            
				<div class="form-group">
				    <div class="col-md-6 col-md-offset-4">
				        <button type="submit" class="btn btn-primary">
					    			Buscar
				        </button>
				    </div>
				</div>
				</form>
		@endsection
		@include('widgets.panel', array('controls'=> true, 'as'=> 'grid14'))
	</div>
    <div class="col-sm-8">
		
		@section ('cotable_panel_title','Listado de los 30 últimos registros')
		@section ('cotable_panel_body')
		<table class="table table-striped">
			<thead>
				<tr class="info">
					<th>Placa</th>
					<th>Repuesto</th>
					<th>Cantidad</th>
					<th>Precio</th>
					<th>Fecha</th>
					<th>Sede</th>
					<th>Mano de obra</th>
				</tr>
			</thead>
			<tbody>
			@foreach($registros as $registro)
				<tr>
					<td>{{$registro->placa}}</td>
					<td>{{$registro->repuesto->nombre}}</td>
					<td>{{$registro->cantidad}}</td>
					<td>{{$registro->precio}}</td>
					<td>{{$registro->fecha}}</td>
					<td>{{$registro->sede->nombre}}</td>
					<td>{{$registro->costo}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>	
		@endsection
		@include('widgets.panel', array('header'=>true, 'as'=>'cotable'))
	</div>
</div>
@stop
@section('jquery')
<script>
  /*function getUp(sel)
	{	    
	    var categoria_id = sel.value;

        $.get('/ajax-state-repuesto?categoria_id=' + categoria_id, function(data) {
            $('#repuesto').empty();
            alert(categoria_id);
             $.each(data,function(index,repuesto){
        $('#repuesto').append('<option value="0">hola</option>');
                });
        });
	}
/*$('#categoria').on('change',function(e){
    var categoria_id = e.target.value;
    $.get('/information/create/ajax-repuesto?categoria_id='+categoria_id,function (data){
    $('#repuesto').empty();
    $.each(data,function(index,repuesto){
        $('#repuesto').append('<option value="'+ repuesto.id_repuesto+'">'+repuesto.nombre+'</option>');
    });
        
    });
    
});*/
</script>
@stop



