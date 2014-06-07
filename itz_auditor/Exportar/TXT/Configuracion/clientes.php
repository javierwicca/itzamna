<?php
	setlocale(LC_CTYPE, 'es_ES');
	
	if (base64_decode($_POST[list_delimitado])=='tab') $del='	';
	elseif (base64_decode($_POST[list_delimitado])=='otro') $del=base64_decode($_POST[list_otro]);
	else $del=base64_decode($_POST[list_delimitado]);
	
	$arch.="IDENTIFICACIÓN".$del."NOMBRE".$del."DIRECCIÓN".$del."TELÉFONO".$del."PERSONA".$del."Tp. DOCUMENTO"."\r\n";
	
	$filas=explode('##', $datos);
	for ($i=0;$i<count($filas);$i++) {
		$columnas=explode('@@', $filas[$i]);
		
		if ($columnas[8]=='A') $estado='ACTIVO';
		else $estado='INACTIVO';
		
		$arch.=$columnas[0].$del.mb_strtoupper($columnas[15]).$del.mb_strtoupper($columnas[9]).$del.mb_strtoupper($columnas[13]).$del.mb_strtoupper($columnas[16]).$del.mb_strtoupper($columnas[17])."\r\n";
	}
	
	header('Content-Type: text/plain');
	header('Content-Disposition: attachment;filename="Usuarios.txt"');
	header('Cache-Control: max-age=0');
	
	print $arch;
?>

