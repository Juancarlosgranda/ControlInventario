<html lang="en">
	<head>
	
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>PRODUCTOS</title>
		<link href="/css/pdf1.css" rel="stylesheet">
		<style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even){background-color: #f2f2f2}
        </style>
	</head>
	<body onload="">
		<div>
		<h1>H&C TRANSPORTE. HERNAN COLLADO BLANCO. S.R.L</h1>
				<h3>El uso de repuestos entre las fechas {{$fechas}}</h3>
           <br>
           <h3>En el vehículo: {{$carro}}  </h3>
            
			<table class="table">
                   
						<tr>
							<th>Repuesto</th>
							<th>Fecha</th>
							<th>Cantidad/unidad</th>
							<th>Coste</th>
							<th>Sede</th>
							<th>Mano de obra</th>

						</tr>
					@foreach ($registros as $registro)
						<tr>
						
							<td>{{$registro->repuesto->nombre}}</td>
							<td>{{$registro->fecha}}</td>
                            <td>{{$registro->cantidad.' / '.$registro->repuesto->unidad_medida->nombre}}</td>
                            <td>{{$registro->precio}} S/.</td>
                            <td>{{$registro->sede->nombre}}</td>
                            <td>{{$registro->costo}} S/.</td>
						</tr>
					@endforeach
					<tr>
					    <th colspan="3">Total de gastos</th>
					    <td>{{$gastosRe}} S/.</td>
					    <td></td>
					    <td>{{$gastos}} S/.</td>
					</tr>

				</table>

		<br>
		</div>
  </body>
</html>