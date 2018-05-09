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
					<td colspan="5"><font size='6' color='#000'><center>H&C TRANSPORTE. HERNAN COLLADO BLANCO. S.R.L</center></font></td>
					
				</tr>
				<tr bgcolor="#E4E2E2" rowspan=9>
					<td style="vertical-align: middle; text-align:left;" colspan="5"><font size='4' color='#000'><strong></strong>{{$nota}}</font></td> 
					
				</tr>
				
			</table>
	<table border=\"1\" align=\"center\">
					<tr bgcolor=\"#FDFEFE\"  align=\"center\"  height='40'>
						<th bgcolor='#1B4F72' ><font color="#FDFEFE"><strong>Repuesto</strong></font></th>
						<th bgcolor='#1B4F72' ><font color="#FDFEFE"><strong>Stock mínimo</strong></font></th>
						<th bgcolor='#1B4F72' ><font color="#FDFEFE"><strong>Stock actual</strong></font></th>
						<th bgcolor='#1B4F72' ><font color="#FDFEFE"><strong>Stock máximo</strong></font></th>
						<th bgcolor='#1B4F72' ><font color="#FDFEFE"><strong>Sede</strong></font></th>
					</tr>
				@foreach ($registros as $registro)
					<tr>
						<td style="vertical-align: middle; text-align:center;">{{$registro->repuesto->nombre}}</td>
						<td style="vertical-align: middle; text-align:center;">{{$registro->stock_min}}</td>
						<td style="vertical-align: middle; text-align:center;">{{$registro->stock_actual}}</td>
						<td style="vertical-align: middle; text-align:center;">{{$registro->stock_max}}</td>
						<td style="vertical-align: middle; text-align:center;">{{$registro->sede->nombre}}</td>
					</tr>
                    @endforeach
			</table>
</html>


<?php
	$reporte = ob_get_clean();
	header("Content-type: application/vnd.ms-excel");  
	header("Content-Disposition: attachment; filename=Stocks.xls");  
	header("Pragma: no-cache");  
	header("Expires: 0");   

	echo $reporte;  
?>