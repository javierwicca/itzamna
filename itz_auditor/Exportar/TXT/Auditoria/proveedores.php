<?php
	setlocale(LC_CTYPE, 'es_ES');
	
	if (base64_decode($_POST[list_delimitado])=='tab') $del='	';
	elseif (base64_decode($_POST[list_delimitado])=='otro') $del=base64_decode($_POST[list_otro]);
	else $del=base64_decode($_POST[list_delimitado]);
	
	$arch.="IDENTIFICACIÒN".$del."NOMBRE".$del."DIRECCIÒN".$del."TELÉFONO".$del."PERSONA".$del."TP. DOCUMENTO"."\r\n";
	
	$filas=explode('##', $datos);
	for ($i=0;$i<count($filas);$i++) {
		$columnas=explode('@@', $filas[$i]);
		$arch.=$columnas[0].$del.$columnas[15].$del.$columnas[9].$del.mb_strtoupper($columnas[13]).$del.$columnas[16].$del.
		mb_strtoupper($columnas[17])."\r\n";
	}
	
	header('Content-Type: text/plain');
	header('Content-Disposition: attachment;filename="Proveedores.txt"');
	header('Cache-Control: max-age=0');
	
	print $arch;
?>