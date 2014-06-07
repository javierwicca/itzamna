<?php
	setlocale(LC_CTYPE, 'es_ES');
	
	if (base64_decode($_POST[list_delimitado])=='tab') $del='	';
	elseif (base64_decode($_POST[list_delimitado])=='otro') $del=base64_decode($_POST[list_otro]);
	else $del=base64_decode($_POST[list_delimitado]);
	
	$arch.="CLIENTE".$del."CUENTA PUC".$del."NOMBRE".$del."ECUACIÓN PATRIMONIAL".$del."NIVEL DETALLE".$del."NATURALEZA"."\r\n";
	
	$filas=explode('##', $datos);
	for ($i=0;$i<count($filas);$i++) {
		$columnas=explode('@@', $filas[$i]);
		$arch.=mb_strtoupper($columnas[6]).$del.$columnas[1].$del.mb_strtoupper($columnas[2]).$del.mb_strtoupper($columnas[7]).$del.$columnas[4].$del.
		mb_strtoupper($columnas[8])."\r\n";
	}
	
	header('Content-Type: text/plain');
	header('Content-Disposition: attachment;filename="cuentasPuc.txt"');
	header('Cache-Control: max-age=0');
	
	print $arch;
?>