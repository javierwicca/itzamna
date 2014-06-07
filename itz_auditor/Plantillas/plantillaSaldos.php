<?php
	setlocale(LC_CTYPE, 'es_ES');
	
	require_once '../PHPExcel/Classes/PHPExcel.php';
	
	// Create nuevo PHPExcel objeto
	$objPHPExcel = new PHPExcel();
	// Set document properties
	$objPHPExcel->getProperties()->setCreator(utf8_encode("Itzamná SAS"))
	->setLastModifiedBy(utf8_encode("Itzamná SAS"))
	->setTitle(utf8_encode("Itzamná Auditor"))
	->setSubject(utf8_encode("Plantilla Saldos."))
	->setDescription(utf8_encode("Plantilla Saldos."))
	->setKeywords(utf8_encode("Plantilla Saldos."));
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
	
	$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($format);
	
	$objPHPExcel->getActiveSheet()->setCellValue('A1',utf8_encode('CUENTA PUC'));
	$objPHPExcel->getActiveSheet()->getComment('A1')->getText()->createTextRun(utf8_encode('Código de la cuenta PUC.'));
	$objPHPExcel->getActiveSheet()->getComment('A1')->getText()->createTextRun("\r\n");
	$objPHPExcel->getActiveSheet()->getComment('A1')->getText()->createTextRun("(obligatorio)");
	$objPHPExcel->getActiveSheet()->getComment('A1')->setHeight('50pt');
	
	$objPHPExcel->getActiveSheet()->setCellValue('B1',utf8_encode('TERCERO'));
	$objPHPExcel->getActiveSheet()->getComment('B1')->getText()->createTextRun(utf8_encode('Tercero del movimiento.'));
	$objPHPExcel->getActiveSheet()->getComment('B1')->setHeight('30pt');
	
	$objPHPExcel->getActiveSheet()->setCellValue('C1',utf8_encode('2º TERCERO'));
	$objPHPExcel->getActiveSheet()->getComment('C1')->getText()->createTextRun(utf8_encode('Segundo tercero del movimiento.'));
	$objPHPExcel->getActiveSheet()->getComment('C1')->setHeight('30pt');
	
	$objPHPExcel->getActiveSheet()->setCellValue('D1',utf8_encode('CENTRO DE COSTO'));
	$objPHPExcel->getActiveSheet()->getComment('D1')->getText()->createTextRun(utf8_encode('Centro de costo.'));
	$objPHPExcel->getActiveSheet()->getComment('D1')->setHeight('20pt');
	
	$objPHPExcel->getActiveSheet()->setCellValue('E1',utf8_encode('SALDO INICIAL'));
	$objPHPExcel->getActiveSheet()->getComment('E1')->getText()->createTextRun(utf8_encode('Valor del saldo inicial.'));
	$objPHPExcel->getActiveSheet()->getComment('E1')->getText()->createTextRun("\r\n");
	$objPHPExcel->getActiveSheet()->getComment('E1')->getText()->createTextRun("(obligatorio)");
	
	$objPHPExcel->getActiveSheet()->setCellValue('F1',utf8_encode('DÉBITOS'));
	$objPHPExcel->getActiveSheet()->getComment('F1')->getText()->createTextRun(utf8_encode('Valor de los movimientos débitos.'));
	$objPHPExcel->getActiveSheet()->getComment('F1')->getText()->createTextRun("\r\n");
	$objPHPExcel->getActiveSheet()->getComment('F1')->getText()->createTextRun("(obligatorio)");
	
	$objPHPExcel->getActiveSheet()->setCellValue('G1',utf8_encode('CRÉDITOS'));
	$objPHPExcel->getActiveSheet()->getComment('G1')->getText()->createTextRun(utf8_encode('Valor de los movimientos créditos.'));
	$objPHPExcel->getActiveSheet()->getComment('G1')->getText()->createTextRun("\r\n");
	$objPHPExcel->getActiveSheet()->getComment('G1')->getText()->createTextRun("(obligatorio)");
	
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
	
	// Redirect output to a clientâ€™s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="plantillaSaldos.xlsx"');
	header('Cache-Control: max-age=0');
	
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	exit;
?>