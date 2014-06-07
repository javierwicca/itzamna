<?php
	setlocale(LC_CTYPE, 'es_ES');
	
	require_once '../PHPExcel/Classes/PHPExcel.php';
	
	// Create nuevo PHPExcel objeto
	$objPHPExcel = new PHPExcel();
	// Set document properties
	$objPHPExcel->getProperties()->setCreator(utf8_encode("Itzamná SAS"))
	->setLastModifiedBy(utf8_encode("Itzamná SAS"))
	->setTitle(utf8_encode("Itzamná Auditor"))
	->setSubject(utf8_encode("Plantilla Cuenta PUC."))
	->setDescription(utf8_encode("Plantilla Cuenta PUC."))
	->setKeywords(utf8_encode("Plantilla Cuenta PUC."));
	$objPHPExcel->setActiveSheetIndex(0);
	//ENCABEZADO Y PIE DE PAGINA
	
	// Rename worksheet
	$objPHPExcel->getActiveSheet()->setTitle('Datos');
	
	$format=
	array(
			'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
			),
			'borders' => array(
					'allborders' => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN,
					)
			),
			'font' => array(
					'size' => 10,
					'name' => 'Arial'
			),
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('argb' => 'FFffcccc')
			)
	);
	
	$objPHPExcel->getActiveSheet()->getStyle('A1:E1')->applyFromArray($format);
	
	$objPHPExcel->getActiveSheet()->setCellValue('A1',utf8_encode('CUENTA PUC'));
	$objPHPExcel->getActiveSheet()->getComment('A1')->getText()->createTextRun(utf8_encode('Código de la cuenta PUC.'));
	$objPHPExcel->getActiveSheet()->getComment('A1')->getText()->createTextRun("\r\n");
	$objPHPExcel->getActiveSheet()->getComment('A1')->getText()->createTextRun("(obligatorio)");
	
	$objPHPExcel->getActiveSheet()->setCellValue('B1',utf8_encode('NOMBRE CUENTA'));
	$objPHPExcel->getActiveSheet()->getComment('B1')->getText()->createTextRun(utf8_encode('Nombre de la cuenta PUC.'));
	$objPHPExcel->getActiveSheet()->getComment('B1')->getText()->createTextRun("\r\n");
	$objPHPExcel->getActiveSheet()->getComment('B1')->getText()->createTextRun("(obligatorio)");
	
	$objPHPExcel->getActiveSheet()->setCellValue('C1',utf8_encode('ECUACIÓN PATRIMONIAL'));
	$objPHPExcel->getActiveSheet()->getComment('C1')->getText()->createTextRun(utf8_encode('AC: ACTIVO'));
	$objPHPExcel->getActiveSheet()->getComment('C1')->getText()->createTextRun("\r\n");
	$objPHPExcel->getActiveSheet()->getComment('C1')->getText()->createTextRun(utf8_encode('PA: PASIVO'));
	$objPHPExcel->getActiveSheet()->getComment('C1')->getText()->createTextRun("\r\n");
	$objPHPExcel->getActiveSheet()->getComment('C1')->getText()->createTextRun(utf8_encode('CA: CAPITAL O PATRIMONIO'));
	$objPHPExcel->getActiveSheet()->getComment('C1')->getText()->createTextRun("\r\n");
	$objPHPExcel->getActiveSheet()->getComment('C1')->getText()->createTextRun(utf8_encode('IN: INGRESO'));
	$objPHPExcel->getActiveSheet()->getComment('C1')->getText()->createTextRun("\r\n");
	$objPHPExcel->getActiveSheet()->getComment('C1')->getText()->createTextRun(utf8_encode('EG: EGRESO'));
	$objPHPExcel->getActiveSheet()->getComment('C1')->getText()->createTextRun("\r\n");
	$objPHPExcel->getActiveSheet()->getComment('C1')->getText()->createTextRun(utf8_encode('CO: COSTO'));
	$objPHPExcel->getActiveSheet()->getComment('C1')->getText()->createTextRun("\r\n");
	$objPHPExcel->getActiveSheet()->getComment('C1')->getText()->createTextRun(utf8_encode('OD: CUENTAS DE ORDEN DEUDORAS'));
	$objPHPExcel->getActiveSheet()->getComment('C1')->getText()->createTextRun("\r\n");
	$objPHPExcel->getActiveSheet()->getComment('C1')->getText()->createTextRun(utf8_encode('OA: CUENTAS DE ORDEN ACREEDORAS'));
	$objPHPExcel->getActiveSheet()->getComment('C1')->getText()->createTextRun("\r\n");
	$objPHPExcel->getActiveSheet()->getComment('C1')->getText()->createTextRun("(obligatorio)");
	$objPHPExcel->getActiveSheet()->getComment('C1')->setWidth('220pt');
	$objPHPExcel->getActiveSheet()->getComment('C1')->setHeight('150pt');
	
	$objPHPExcel->getActiveSheet()->setCellValue('D1',utf8_encode('NIVEL DE DETALLE'));
	$objPHPExcel->getActiveSheet()->getComment('D1')->getText()->createTextRun(utf8_encode('Nivel de detalle de la cuenta PUC.'));
	$objPHPExcel->getActiveSheet()->getComment('D1')->getText()->createTextRun("\r\n");
	$objPHPExcel->getActiveSheet()->getComment('D1')->getText()->createTextRun("(numerico y obligatorio)");
	$objPHPExcel->getActiveSheet()->getComment('D1')->setHeight('60pt');
	
	$objPHPExcel->getActiveSheet()->setCellValue('E1',utf8_encode('NATURALEZA'));
	$objPHPExcel->getActiveSheet()->getComment('E1')->getText()->createTextRun(utf8_encode('D: DÉBITO'));
	$objPHPExcel->getActiveSheet()->getComment('E1')->getText()->createTextRun("\r\n");
	$objPHPExcel->getActiveSheet()->getComment('E1')->getText()->createTextRun(utf8_encode('C: CRÉDITO'));
	$objPHPExcel->getActiveSheet()->getComment('E1')->getText()->createTextRun("\r\n");
	$objPHPExcel->getActiveSheet()->getComment('E1')->getText()->createTextRun("(obligatorio)");
	
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(28);
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(28);
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(28);
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
	
	// Redirect output to a clientâ€™s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="plantillaCuentaPuc.xlsx"');
	header('Cache-Control: max-age=0');
	
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	exit;
?>