<?php
	setlocale(LC_CTYPE, 'es_ES');
	
	if (base64_decode($_POST[list_delimitado])=='tab') $del='	';
	elseif (base64_decode($_POST[list_delimitado])=='otro') $del=base64_decode($_POST[list_otro]);
	else $del=base64_decode($_POST[list_delimitado]);
	
	$arch.="CONS.".$del."BIEN O SERVICIO".$del."% RETEFUENTE PERSONA JURÍDICA".$del."% RETEFUENTE PERSONA NATURAL".$del."UVT".$del."% IVA".$del."% IMPUESTO AL CONSUMO"."\r\n";
	
	$filas=explode('##', $datos);
	for ($i=0;$i<count($filas);$i++) {
		$columnas=explode('@@', $filas[$i]);
		$arch.=$columnas[0].$del.$columnas[1].$del.$columnas[2].$del.mb_strtoupper($columnas[3]).$del.$columnas[4].$del.
		mb_strtoupper($columnas[5]).$del.$columnas[6]."\r\n";
	}
	
	header('Content-Type: text/plain');
	header('Content-Disposition: attachment;filename="Bienes y servicios.txt"');
	header('Cache-Control: max-age=0');
	
	print $arch;
?>