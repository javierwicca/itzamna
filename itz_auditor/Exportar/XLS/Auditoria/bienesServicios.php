<?php
	setlocale(LC_CTYPE, 'es_ES');
	
	require_once '../PHPExcel/Classes/PHPExcel.php';
	
	// Create nuevo PHPExcel objeto
	$objPHPExcel = new PHPExcel();
	// Set document properties
	$objPHPExcel->getProperties()->setCreator("Itzamná SAS - $nm_usr")
	->setLastModifiedBy("Itzamná SAS - $nm_usr")
	->setTitle("Itzamná Auditor")
	->setSubject("Listado de Bienes y Servicios.")
	->setDescription("Listado de Bienes y Servicios con la siguiente condición: $where.")
	->setKeywords("Proveedores");
	$objPHPExcel->setActiveSheetIndex(0);
	//ENCABEZADO Y PIE DE PAGINA
	$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader(utf8_encode("&L".ucwords(strtolower($nm_usr))."&CITZAMNÁ AUDITOR".
			"\nBIENES Y SERVICIOS&R".date('d/m/Y h:i:s A')));
	$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter(utf8_encode("Página &P de &N"));
	
	// Rename worksheet
	$objPHPExcel->getActiveSheet()->setTitle('Bienes Y Servicios');
	
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
					'bold' => true,
					'size' => 13,
					'name' => 'Times New Roman'
			)
	);
	
	$objPHPExcel->getActiveSheet()->getStyle('A1:G2')->applyFromArray($format);
	
	$objPHPExcel->getActiveSheet()->getCell('A1')->setValue(utf8_encode('ITZAMNÁ AUDITOR'));
	$objPHPExcel->getActiveSheet()->mergeCells('A1:G1');
	
	$objPHPExcel->getActiveSheet()->getCell('A2')->setValue('BIENES Y SERVICIOS');
	$objPHPExcel->getActiveSheet()->mergeCells('A2:G2');
	
	$format['font']['size']=10;
	
	$objPHPExcel->getActiveSheet()->getStyle('A4:G4')->applyFromArray($format);
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(45);
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
	
	$objPHPExcel->getActiveSheet()->getCell('A4')->setValue(utf8_encode('Cons.'));
	$objPHPExcel->getActiveSheet()->getCell('B4')->setValue(utf8_encode('Bien o Servicio'));
	$objPHPExcel->getActiveSheet()->getCell('C4')->setValue(utf8_encode('% Retefuente Persona Jurídica'));
	$objPHPExcel->getActiveSheet()->getCell('D4')->setValue(utf8_encode('% Retefuente Persona Natural'));
	$objPHPExcel->getActiveSheet()->getCell('E4')->setValue(utf8_encode('UVT'));
	$objPHPExcel->getActiveSheet()->getCell('F4')->setValue(utf8_encode('% IVA'));
	$objPHPExcel->getActiveSheet()->getCell('G4')->setValue(utf8_encode('% Impuesto al Consumo'));
	
	$r=5;
	$act=0;
	$ina=0;
	$filas=explode('##', $datos);
	for ($i=0;$i<count($filas);$i++) {
		$columnas=explode('@@', $filas[$i]);
		
		if ($columnas[8]=='A') {
			$color=PHPExcel_Style_Color::COLOR_BLACK;
			$act++;
		} else {
			$color=PHPExcel_Style_Color::COLOR_RED;
			$ina++;
		}
		
		$objPHPExcel->getActiveSheet()->getStyle("A$r:F$r")->getAlignment()->setWrapText(true);
		
		$format['font']['bold']=false;
		$format['alignment']['horizontal']=PHPExcel_Style_Alignment::HORIZONTAL_CENTER;
		
		$objPHPExcel->getActiveSheet()->getStyle("A$r")->applyFromArray($format);
		$objPHPExcel->getActiveSheet()->getStyle("C$r:G$r")->applyFromArray($format);
		
		$format['alignment']['horizontal']=PHPExcel_Style_Alignment::HORIZONTAL_LEFT;
		
		$objPHPExcel->getActiveSheet()->getStyle("B$r")->applyFromArray($format);
		
		
		
		
		$objPHPExcel->getActiveSheet()->getCell("A$r")->setValue(utf8_encode($columnas[0]));
		$objPHPExcel->getActiveSheet()->getCell("B$r")->setValue(utf8_encode(mb_strtoupper($columnas[1])));
		$objPHPExcel->getActiveSheet()->getCell("C$r")->setValue(utf8_encode(mb_strtoupper($columnas[2])));
		$objPHPExcel->getActiveSheet()->getCell("D$r")->setValue(utf8_encode(mb_strtoupper($columnas[3])));
		$objPHPExcel->getActiveSheet()->getCell("E$r")->setValue(utf8_encode(mb_strtoupper($columnas[4])));
		$objPHPExcel->getActiveSheet()->getCell("F$r")->setValue(utf8_encode(mb_strtoupper($columnas[5])));
		$objPHPExcel->getActiveSheet()->getCell("G$r")->setValue(utf8_encode(mb_strtoupper($columnas[6])));
		
		$r++;
	}
	
	$format['font']['bold']=true;
	$format['font']['size']=11;
	$format['alignment']['horizontal']=PHPExcel_Style_Alignment::HORIZONTAL_LEFT;
	$format['font']['color']['argb']=PHPExcel_Style_Color::COLOR_BLACK;
	
	$objPHPExcel->getActiveSheet()->getStyle("A".($r+1).":B".($r+1))->applyFromArray($format);
	$objPHPExcel->getActiveSheet()->getCell("A".($r+1))->setValue(utf8_encode("TOTAL: ".count($filas)));
	$objPHPExcel->getActiveSheet()->mergeCells('A'.($r+1).':B'.($r+1));
	

	
	$objPHPExcel->setActiveSheetIndex(0);
	
	$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
	$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LETTER);
	$objPHPExcel->getActiveSheet()->getPageSetup()->setPrintAreaByColumnAndRow(0, 4, 1, $r+3);
	$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(4,4);
	//$objPHPExcel->getActiveSheet()->getPageSetup()->setScale(70,true);
	
	// Redirect output to a clientâ€™s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="Bienes y Servicios.xls"');
	header('Cache-Control: max-age=0');
	
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
	exit;
?>