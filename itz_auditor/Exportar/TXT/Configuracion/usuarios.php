<?php
	setlocale(LC_CTYPE, 'es_ES');
	
	if (base64_decode($_POST[list_delimitado])=='tab') $del='	';
	elseif (base64_decode($_POST[list_delimitado])=='otro') $del=base64_decode($_POST[list_otro]);
	else $del=base64_decode($_POST[list_delimitado]);
	
	$arch.="USUARIO".$del."NOMBRE".$del."CORREO".$del."PERFIL"."\r\n";
	
	$filas=explode('##', $datos);
	for ($i=0;$i<count($filas);$i++) {
		$columnas=explode('@@', $filas[$i]);
		
		if ($columnas[2]=='A') $estado='ACTIVO';
		else $estado='INACTIVO';
		
		$arch.=$columnas[0].$del.mb_strtoupper($columnas[6]).$del.mb_strtoupper($columnas[1]).$del.mb_strtoupper($columnas[7])."\r\n";
	}
	
	header('Content-Type: text/plain');
	header('Content-Disposition: attachment;filename="Usuarios.txt"');
	header('Cache-Control: max-age=0');
	
	print $arch;
?>
