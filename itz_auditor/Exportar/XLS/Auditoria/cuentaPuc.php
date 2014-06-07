<?php
	setlocale(LC_CTYPE, 'es_ES');
	
	require_once '../PHPExcel/Classes/PHPExcel.php';
	
	// Create nuevo PHPExcel objeto
	$objPHPExcel = new PHPExcel();
	// Set document properties
	$objPHPExcel->getProperties()->setCreator("Itzamná SAS - $nm_usr")
	->setLastModifiedBy("Itzamná SAS - $nm_usr")
	->setTitle("Itzamná Auditor")
	->setSubject("Listado de Cuentas PUC.")
	->setDescription("Listado de cuentas PUC con la siguiente condición: $where.")
	->setKeywords("ROLES");
	$objPHPExcel->setActiveSheetIndex(0);
	//ENCABEZADO Y PIE DE PAGINA
	$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader(utf8_encode("&L".ucwords(strtolower($nm_usr))."&CITZAMNÁ AUDITOR".
			"\nCUENTAS PUC&R".date('d/m/Y h:i:s A')));
	$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter(utf8_encode("Página &P de &N"));
	
	// Rename worksheet
	$objPHPExcel->getActiveSheet()->setTitle('Roles');
	
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
	
	$objPHPExcel->getActiveSheet()->getStyle('A1:F2')->applyFromArray($format);
	
	$objPHPExcel->getActiveSheet()->getCell('A1')->setValue(utf8_encode('ITZAMNÁ AUDITOR'));
	$objPHPExcel->getActiveSheet()->mergeCells('A1:F1');
	
	$objPHPExcel->getActiveSheet()->getCell('A2')->setValue('CUENTAS PUC');
	$objPHPExcel->getActiveSheet()->mergeCells('A2:F2');
	
	$format['font']['size']=10;
	
	$objPHPExcel->getActiveSheet()->getStyle('A4:F4')->applyFromArray($format);
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
	
	$objPHPExcel->getActiveSheet()->getCell('A4')->setValue(utf8_encode('Cliente'));
	$objPHPExcel->getActiveSheet()->getCell('B4')->setValue(utf8_encode('Cuenta PUC'));
	$objPHPExcel->getActiveSheet()->getCell('C4')->setValue(utf8_encode('Nombre'));
	$objPHPExcel->getActiveSheet()->getCell('D4')->setValue(utf8_encode('Ecuación Patrimonial'));
	$objPHPExcel->getActiveSheet()->getCell('E4')->setValue(utf8_encode('Nivel Detalle'));
	$objPHPExcel->getActiveSheet()->getCell('F4')->setValue(utf8_encode('Naturaleza'));
	
	$r=5;
	$act=0;
	$ina=0;
	$filas=explode('##', $datos);
	
	for ($i=0;$i<count($filas);$i++) {
		$columnas=explode('@@', $filas[$i]);
		
		$objPHPExcel->getActiveSheet()->getStyle("A$r:F$r")->getAlignment()->setWrapText(true);
		
		$format['font']['bold']=false;
		$format['alignment']['horizontal']=PHPExcel_Style_Alignment::HORIZONTAL_LEFT;
		
		$objPHPExcel->getActiveSheet()->getStyle("A$r:D$r")->applyFromArray($format);
		$objPHPExcel->getActiveSheet()->getStyle("F$r")->applyFromArray($format);
		
		$format['alignment']['horizontal']=PHPExcel_Style_Alignment::HORIZONTAL_CENTER;
	
		$objPHPExcel->getActiveSheet()->getStyle("E$r")->applyFromArray($format);
		
		$objPHPExcel->getActiveSheet()->getCell("A$r")->setValue(utf8_encode(mb_strtoupper($columnas[6])));
		$objPHPExcel->getActiveSheet()->getCell("B$r")->setValue(utf8_encode($columnas[1]));
		$objPHPExcel->getActiveSheet()->getCell("C$r")->setValue(utf8_encode(mb_strtoupper($columnas[2])));
		$objPHPExcel->getActiveSheet()->getCell("D$r")->setValue(utf8_encode(mb_strtoupper($columnas[7])));
		$objPHPExcel->getActiveSheet()->getCell("E$r")->setValue(utf8_encode($columnas[4]));
		$objPHPExcel->getActiveSheet()->getCell("F$r")->setValue(utf8_encode(mb_strtoupper($columnas[8])));
		
		$r++;
	}
	
	$format['font']['bold']=true;
	$format['font']['size']=11;
	$format['alignment']['horizontal']=PHPExcel_Style_Alignment::HORIZONTAL_LEFT;
	
	$format['font']['color']['argb']=PHPExcel_Style_Color::COLOR_BLUE;
	
	$objPHPExcel->getActiveSheet()->getStyle("A".($r+1).":B".($r+3))->applyFromArray($format);
	$objPHPExcel->getActiveSheet()->getCell("A".($r+1))->setValue(utf8_encode("TOTAL: ".(count($filas))));
	$objPHPExcel->getActiveSheet()->mergeCells('A'.($r+1).':B'.($r+1));
	
	$objPHPExcel->setActiveSheetIndex(0);
	
	$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
	$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LETTER);
	$objPHPExcel->getActiveSheet()->getPageSetup()->setPrintAreaByColumnAndRow(0, 4, 1, $r+1);
	$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(4,4);
	//$objPHPExcel->getActiveSheet()->getPageSetup()->setScale(70,true);
	
	// Redirect output to a clientâ€™s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="cuentasPuc.xls"');
	header('Cache-Control: max-age=0');
	
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
	exit;
?>