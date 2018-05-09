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
					<td colspan="6"><font size='6' color='#000'><center>H&C TRANSPORTE. HERNAN COLLADO BLANCO. S.R.L</center></font></td>
					
				</tr>
				<tr bgcolor="#E4E2E2" rowspan=9>
					<td colspan="6"><font size='5' color='#000'><strong>El uso de repuestos entre las fechas:</strong>{{$fechas}}</font></td> 
					
				</tr>
				
			</table>
	<table border=\"1\" align=\"center\">
		<font size='6' color='#084B8A'><center><strong>Todos los vehiculos:</strong></center></font>
					<tr bgcolor=\"#FDFEFE\"  align=\"center\"  height='40'>
					   <th bgcolor='#1B4F72' ><font color="#FDFEFE"><strong>Vehículo</strong></font></th>
						<th bgcolor='#1B4F72' ><font color="#FDFEFE"><strong>Repuesto</strong></font></th>
						<th bgcolor='#1B4F72' ><font color="#FDFEFE"><strong>Fecha</strong></font></th>
						<th bgcolor='#1B4F72' ><font color="#FDFEFE"><strong>Cantidad/unidad</strong></font></th>
						<th bgcolor='#1B4F72' ><font color="#FDFEFE"><strong>Coste</strong></font></th>
						<th bgcolor='#1B4F72' ><font color="#FDFEFE"><strong>Sede</strong></font></th>
						<th bgcolor='#1B4F72' ><font color="#FDFEFE"><strong>Mano de obra</strong></font></th>
					</tr>
			
		
				
				@foreach ($registros as $registro)
					
					<tr>
					<td style="vertical-align: middle; text-align:left;">{{$registro->placa}}</td>
						<td style="vertical-align: middle; text-align:left;">{{$registro->repuesto->nombre}}</td>
						<td style="vertical-align: middle; text-align:left;">{{$registro->fecha}}</td>
						<td style="vertical-align: middle; text-align:right;">{{$registro->cantidad.' / '.$registro->repuesto->unidad_medida->nombre}}</td>
						<td style="mso-number-format:'#,##0.00;-#,##0.00';vertical-align: middle; text-align:right;">{{$registro->precio}} S/.</td>
						<td style="vertical-align: middle; text-align:center;">{{$registro->sede->nombre}}</td>
						<td style="mso-number-format:'#,##0.00;-#,##0.00';vertical-align: middle; text-align:right;">{{$registro->costo}} S/.</td>
					</tr>
                    @endforeach
                    <tr>
                       <td colspan="4"><font size='4' color='#084B8A'><center>TOTAL DE GASTOS</center></font></td><td><font size='4' color='#084B8A'><center>{{$gastosRe}} S/.</center></font></td>
                       <td></td>
                        <td><font size='4' color='#084B8A'><center>{{$gastos}} S/.</center></font></td>
                    </tr>
			</table>
</html>


<?php
	$reporte = ob_get_clean();
	header("Content-type: application/vnd.ms-excel");  
	header("Content-Disposition: attachment; filename=UsosporFecha.xls");  
	header("Pragma: no-cache");  
	header("Expires: 0");   

	echo $reporte;  
?>