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
	<body onload="window.print()">
		<div>
		<h1>H&C TRANSPORTE. HERNAN COLLADO BLANCO. S.R.L</h1>
				<h3>Repuesto usados de la fecha {{$fechas}}  </h3>
            @while($tamanio > 0)
            {{$total=0}}
			<table class="table">
						<tr>
							<th>Repuesto</th>
							<th>Fecha</th>
							<th>Factura</th>
							<th>Remision</th>
							<th>Cantidad</th>
							<th>Precio</th>

						</tr>
					@foreach ($registros as $registro)
						<tr>
							<td>{{$registro->repuesto->nombre}}</td>
							<td>{{$registro->fecha}}</td>
							<td>{{$registro->placa}}</td>
							<td>{{$registro->sede->nombre}}</td>
                            <td>{{$registro->cantidad}}</td>
                            <td>{{$registro->costo}}</td>
						</tr>
						{{$total=$total+$registro->costo}}
					@endforeach
					<tr>
					    <th colspan="5"> TOTAL DE GASTOS</th>
					    <td>{{$total}}</td>
					</tr>

				</table>
           {{$tamanio--}}
            @endwhile
		<br>
		</div>
  </body>
</html>