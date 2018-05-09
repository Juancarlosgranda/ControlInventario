<?php
	ob_start();
?>
<html lang="es">
	<head>
	<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" >
	</head>
	<table>

				<tr bgcolor="#E4E2E2" rowspan=9>
					<td colspan="6"><font size='6' color='#084B8A'><center>H&C TRANSPORTE. HERNAN COLLADO BLANCO. S.R.L</center></font></td>
					
				</tr>
				<tr bgcolor="#E4E2E2" rowspan=9>
					<td colspan="6"><font size='5' color='#084B8A'><strong>Gastos en repuestos entre las fechas:</strong>{{$fechas}}</font></td> 
					
				</tr>
				
			</table>
	<table border=\"1\" align=\"center\">
		<font size='6' color='#084B8A'><center>Gastos</center></font>
					<tr bgcolor=\"#FDFEFE\"  align=\"center\"  height='40'>
						<th bgcolor='#1B4F72' ><font color="#FDFEFE"><strong>Repuesto</strong></font></th>
						<th bgcolor='#1B4F72' ><font color="#FDFEFE"><strong>Fecha</strong></font></th>
						<th bgcolor='#1B4F72' ><font color="#FDFEFE"><strong>Factura</strong></font></th>
						<th bgcolor='#1B4F72' ><font color="#FDFEFE"><strong>Remisión</strong></font></th>
						<th bgcolor='#1B4F72' ><font color="#FDFEFE"><strong>Cantidad</strong></font></th>
						<th bgcolor='#1B4F72' ><font color="#FDFEFE"><strong>Precio</strong></font></th>
					</tr>
			
		
				
				@foreach ($registros as $registro)
					
					<tr>
						<td style="vertical-align: middle; text-align:left;">{{$registro->repuesto->nombre}}</td>
						<td style="vertical-align: middle; text-align:left;">{{$registro->fecha}}</td>
						<td style="vertical-align: middle; text-align:right;">{{$registro->factura}}</td>
						<td style="vertical-align: middle; text-align:center;">{{$registro->remision}}</td>
						<td style="mso-number-format:'#,##0.00;-#,##0.00';vertical-align: middle; text-align:right;">{{$registro->cantidad}}</td>
						<td style="mso-number-format:'#,##0.00;-#,##0.00';vertical-align: middle; text-align:right;">{{$registro->precio_compra}}</td>
					</tr>
                    @endforeach
                    <tr>
                       <td colspan="5"><font size='4' color='#084B8A'><center>TOTAL DE GASTOS</center></font></td>
                        <td><font size='4' color='#084B8A'><center>{{$gastos}}</center></font></td>
                    </tr>
			</table>
</html>


<?php
	$reporte = ob_get_clean();
	header("Content-type: application/vnd.ms-excel");  
	header("Content-Disposition: attachment; filename=Gastos.xls");  
	header("Pragma: no-cache");  
	header("Expires: 0");   

	echo $reporte;  
?>