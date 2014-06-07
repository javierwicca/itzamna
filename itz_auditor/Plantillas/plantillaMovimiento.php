<?php
	setlocale(LC_CTYPE, 'es_ES');
	
	require_once '../PHPExcel/Classes/PHPExcel.php';
	
	// Create nuevo PHPExcel objeto
	$objPHPExcel = new PHPExcel();
	// Set document properties
	$objPHPExcel->getProperties()->setCreator(utf8_encode("Itzamná SAS"))
	->setLastModifiedBy(utf8_encode("Itzamná SAS"))
	->setTitle(utf8_encode("Itzamná Auditor"))
	->setSubject(utf8_encode("Plantilla Movimiento."))
	->setDescription(utf8_encode("Plantilla Movimiento."))
	->setKeywords(utf8_encode("Plantilla Movimiento."));
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
	
	$objPHPExcel->getActiveSheet()->getStyle('A1:N1')->applyFromArray($format);
	
	$objPHPExcel->getActiveSheet()->setCellValue('A1',utf8_encode('Nº COMPROBANTE'));
	$objPHPExcel->getActiveSheet()->getComment('A1')->getText()->createTextRun(utf8_encode('Númnero del documento.'));
	$objPHPExcel->getActiveSheet()->getComment('A1')->getText()->createTextRun("\r\n");
	$objPHPExcel->getActiveSheet()->getComment('A1')->getText()->createTextRun("(numerico y obligatorio)");
	$objPHPExcel->getActiveSheet()->getComment('A1')->setHeight('60pt');
	
	$objPHPExcel->getActiveSheet()->setCellValue('B1',utf8_encode('CÓDIGO COMPROBANTE'));
	$objPHPExcel->getActiveSheet()->getComment('B1')->getText()->createTextRun(utf8_encode('Código del comprobante contable, usado por el cliente.'));
	$objPHPExcel->getActiveSheet()->getComment('B1')->getText()->createTextRun("\r\n");
	$objPHPExcel->getActiveSheet()->getComment('B1')->getText()->createTextRun("(obligatorio)");
	$objPHPExcel->getActiveSheet()->getComment('B1')->setHeight('80pt');
	
	$objPHPExcel->getActiveSheet()->setCellValue('C1',utf8_encode('NOMBRE COMPROBANTE'));
	$objPHPExcel->getActiveSheet()->getComment('C1')->getText()->createTextRun(utf8_encode('Nombre del comprobante contable, usado por el cliente.'));
	$objPHPExcel->getActiveSheet()->getComment('C1')->setHeight('60pt');
	
	$objPHPExcel->getActiveSheet()->setCellValue('D1',utf8_encode('FECHA'));
	$objPHPExcel->getActiveSheet()->getComment('D1')->getText()->createTextRun(utf8_encode('Fecha contable, formato validos:'));
	$objPHPExcel->getActiveSheet()->getComment('D1')->getText()->createTextRun("\r\n");
	$objPHPExcel->getActiveSheet()->getComment('D1')->getText()->createTextRun("1) AAAA-MM-DD.");
	$objPHPExcel->getActiveSheet()->getComment('D1')->getText()->createTextRun("\r\n");
	$objPHPExcel->getActiveSheet()->getComment('D1')->getText()->createTextRun("2) DD-MM-AAAA.");
	$objPHPExcel->getActiveSheet()->getComment('D1')->getText()->createTextRun("\r\n");
	$objPHPExcel->getActiveSheet()->getComment('D1')->getText()->createTextRun("3) AAAA/MM/DD.");
	$objPHPExcel->getActiveSheet()->getComment('D1')->getText()->createTextRun("\r\n");
	$objPHPExcel->getActiveSheet()->getComment('D1')->getText()->createTextRun("4) DD/MM/AAAA.");
	$objPHPExcel->getActiveSheet()->getComment('D1')->getText()->createTextRun("\r\n");
	$objPHPExcel->getActiveSheet()->getComment('D1')->getText()->createTextRun("5) AAAAMMDD.");
	$objPHPExcel->getActiveSheet()->getComment('D1')->getText()->createTextRun("\r\n");
	$objPHPExcel->getActiveSheet()->getComment('D1')->getText()->createTextRun("6) DDMMAAA.");
	$objPHPExcel->getActiveSheet()->getComment('D1')->getText()->createTextRun("\r\n");
	$objPHPExcel->getActiveSheet()->getComment('D1')->getText()->createTextRun("(obligatorio)");
	$objPHPExcel->getActiveSheet()->getComment('D1')->setHeight('140pt');
	
	$objPHPExcel->getActiveSheet()->setCellValue('E1',utf8_encode('CUENTA PUC'));
	$objPHPExcel->getActiveSheet()->getComment('E1')->getText()->createTextRun(utf8_encode('Código de la cuenta PUC.'));
	$objPHPExcel->getActiveSheet()->getComment('E1')->getText()->createTextRun("\r\n");
	$objPHPExcel->getActiveSheet()->getComment('E1')->getText()->createTextRun("(obligatorio)");
	$objPHPExcel->getActiveSheet()->getComment('E1')->setHeight('50pt');
	
	$objPHPExcel->getActiveSheet()->setCellValue('F1',utf8_encode('TERCERO'));
	$objPHPExcel->getActiveSheet()->getComment('F1')->getText()->createTextRun(utf8_encode('Tercero del movimiento.'));
	$objPHPExcel->getActiveSheet()->getComment('F1')->setHeight('30pt');
	
	$objPHPExcel->getActiveSheet()->setCellValue('G1',utf8_encode('2º TERCERO'));
	$objPHPExcel->getActiveSheet()->getComment('G1')->getText()->createTextRun(utf8_encode('Segundo tercero del movimiento.'));
	$objPHPExcel->getActiveSheet()->getComment('G1')->setHeight('30pt');
	
	$objPHPExcel->getActiveSheet()->setCellValue('H1',utf8_encode('CENTRO DE COSTO'));
	$objPHPExcel->getActiveSheet()->getComment('H1')->getText()->createTextRun(utf8_encode('Centro de costo.'));
	$objPHPExcel->getActiveSheet()->getComment('H1')->setHeight('20pt');
	
	$objPHPExcel->getActiveSheet()->setCellValue('I1',utf8_encode('DETALLE'));
	$objPHPExcel->getActiveSheet()->getComment('I1')->getText()->createTextRun(utf8_encode('Detalle del movimiento.'));
	$objPHPExcel->getActiveSheet()->getComment('I1')->getText()->createTextRun("\r\n");
	$objPHPExcel->getActiveSheet()->getComment('I1')->getText()->createTextRun("(obligatorio)");
	
	$objPHPExcel->getActiveSheet()->setCellValue('J1',utf8_encode('DÉBITO/CRÉDITO'));
	$objPHPExcel->getActiveSheet()->getComment('J1')->getText()->createTextRun(utf8_encode('Naturaleza del movimiento:'));
	$objPHPExcel->getActiveSheet()->getComment('J1')->getText()->createTextRun("\r\n");
	$objPHPExcel->getActiveSheet()->getComment('J1')->getText()->createTextRun(utf8_encode('D: DÉBITO.'));
	$objPHPExcel->getActiveSheet()->getComment('J1')->getText()->createTextRun("\r\n");
	$objPHPExcel->getActiveSheet()->getComment('J1')->getText()->createTextRun(utf8_encode('C: CRÉDITO.'));
	$objPHPExcel->getActiveSheet()->getComment('J1')->getText()->createTextRun("\r\n");
	$objPHPExcel->getActiveSheet()->getComment('J1')->getText()->createTextRun("(obligatorio)");
	$objPHPExcel->getActiveSheet()->getComment('J1')->setHeight('80pt');
	
	$objPHPExcel->getActiveSheet()->setCellValue('K1',utf8_encode('VALOR'));
	$objPHPExcel->getActiveSheet()->getComment('K1')->getText()->createTextRun(utf8_encode('Valor del movimiento.'));
	$objPHPExcel->getActiveSheet()->getComment('K1')->getText()->createTextRun("\r\n");
	$objPHPExcel->getActiveSheet()->getComment('K1')->getText()->createTextRun("(obligatorio)");
	
	$objPHPExcel->getActiveSheet()->setCellValue('L1',utf8_encode('USUARIO EMPRESA'));
	$objPHPExcel->getActiveSheet()->getComment('L1')->getText()->createTextRun(utf8_encode('Usuario que crea o modifica el movimiento.'));
	
	$objPHPExcel->getActiveSheet()->setCellValue('M1',utf8_encode('FECHA EMPRESA'));
	$objPHPExcel->getActiveSheet()->getComment('M1')->getText()->createTextRun(utf8_encode('Fecha en que se crea o modifica el movimiento.'));
	$objPHPExcel->getActiveSheet()->getComment('M1')->getText()->createTextRun("\r\n");
	$objPHPExcel->getActiveSheet()->getComment('M1')->getText()->createTextRun("1) AAAA-MM-DD.");
	$objPHPExcel->getActiveSheet()->getComment('M1')->getText()->createTextRun("\r\n");
	$objPHPExcel->getActiveSheet()->getComment('M1')->getText()->createTextRun("2) DD-MM-AAAA.");
	$objPHPExcel->getActiveSheet()->getComment('M1')->getText()->createTextRun("\r\n");
	$objPHPExcel->getActiveSheet()->getComment('M1')->getText()->createTextRun("3) AAAA/MM/DD.");
	$objPHPExcel->getActiveSheet()->getComment('M1')->getText()->createTextRun("\r\n");
	$objPHPExcel->getActiveSheet()->getComment('M1')->getText()->createTextRun("4) DD/MM/AAAA.");
	$objPHPExcel->getActiveSheet()->getComment('M1')->getText()->createTextRun("\r\n");
	$objPHPExcel->getActiveSheet()->getComment('M1')->getText()->createTextRun("5) AAAAMMDD.");
	$objPHPExcel->getActiveSheet()->getComment('M1')->getText()->createTextRun("\r\n");
	$objPHPExcel->getActiveSheet()->getComment('M1')->getText()->createTextRun("6) DDMMAAA.");
	$objPHPExcel->getActiveSheet()->getComment('M1')->getText()->createTextRun("\r\n");
	$objPHPExcel->getActiveSheet()->getComment('M1')->getText()->createTextRun("(obligatorio)");
	$objPHPExcel->getActiveSheet()->getComment('M1')->setHeight('140pt');
	
	$objPHPExcel->getActiveSheet()->setCellValue('N1',utf8_encode('ESTADO'));
	$objPHPExcel->getActiveSheet()->getComment('N1')->getText()->createTextRun(utf8_encode('Estado del movimiento:'));
	$objPHPExcel->getActiveSheet()->getComment('N1')->getText()->createTextRun("\r\n");
	$objPHPExcel->getActiveSheet()->getComment('N1')->getText()->createTextRun(utf8_encode('C: CORRECTO.'));
	$objPHPExcel->getActiveSheet()->getComment('N1')->getText()->createTextRun("\r\n");
	$objPHPExcel->getActiveSheet()->getComment('N1')->getText()->createTextRun(utf8_encode('A: ANULADO.'));
	$objPHPExcel->getActiveSheet()->getComment('N1')->getText()->createTextRun("\r\n");
	$objPHPExcel->getActiveSheet()->getComment('N1')->getText()->createTextRun("(obligatorio)");
	$objPHPExcel->getActiveSheet()->getComment('N1')->setHeight('80pt');
	
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(18);
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(24);
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(28);
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
	$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
	$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(25);
	$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(25);
	$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
	
	// Redirect output to a clientâ€™s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="plantillaMovimiento.xlsx"');
	header('Cache-Control: max-age=0');
	
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	exit;
?>