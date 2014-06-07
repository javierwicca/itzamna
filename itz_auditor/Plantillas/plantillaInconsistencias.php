<?php
	setlocale(LC_CTYPE, 'es_ES');
	
	require_once '../PHPExcel/Classes/PHPExcel.php';
	
	$archivo=base64_decode($_GET[nmArchivo]);
	$objPHPExcel = PHPExcel_IOFactory::load(sys_get_temp_dir().'/itz_auditor/'.$archivo);
	// Redirect output to a client’s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="inconsistencias.xlsx"');
	header('Cache-Control: max-age=0');
	
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	exit;
?>