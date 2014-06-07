<?php
	setlocale(LC_CTYPE, 'es_ES');
	
	require_once '../PHPExcel/Classes/PHPExcel.php';
	
	// Create nuevo PHPExcel objeto
	$objPHPExcel = new PHPExcel();
	// Set document properties
	$objPHPExcel->getProperties()->setCreator("Itzamná SAS - $nm_usr")
	->setLastModifiedBy("Itzamná SAS - $nm_usr")
	->setTitle("Itzamná Auditor")
	->setSubject("Listado de Usuarios.")
	->setDescription("Listado de usuarios con la siguiente condición: $where.")
	->setKeywords("USUARIOS");
	$objPHPExcel->setActiveSheetIndex(0);
	//ENCABEZADO Y PIE DE PAGINA
	$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader(utf8_encode("&L".ucwords(strtolower($nm_usr))."&CITZAMNÁ AUDITOR".
			"\nUSUARIOS&R".date('d/m/Y h:i:s A')));
	$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter(utf8_encode("Página &P de &N"));
	
	// Rename worksheet
	$objPHPExcel->getActiveSheet()->setTitle('Usuarios');
	
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
	
	$objPHPExcel->getActiveSheet()->getStyle('A1:D3')->applyFromArray($format);
	
	$objPHPExcel->getActiveSheet()->getCell('A1')->setValue(utf8_encode('ITZAMNÁ AUDITOR'));
	$objPHPExcel->getActiveSheet()->mergeCells('A1:D1');
	
	$objPHPExcel->getActiveSheet()->getCell('A2')->setValue('USUARIOS');
	$objPHPExcel->getActiveSheet()->mergeCells('A2:D2');
	
	$objPHPExcel->getActiveSheet()->getCell('A3')->setValue('');
	$objPHPExcel->getActiveSheet()->mergeCells('A3:D3');
	
	$format['font']['size']=10;
	
	$objPHPExcel->getActiveSheet()->getStyle('A4:D4')->applyFromArray($format);
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
	
	$objPHPExcel->getActiveSheet()->getCell('A4')->setValue(utf8_encode('Usuario'));
	$objPHPExcel->getActiveSheet()->getCell('B4')->setValue(utf8_encode('Nombre'));
	$objPHPExcel->getActiveSheet()->getCell('C4')->setValue(utf8_encode('Correo'));
	$objPHPExcel->getActiveSheet()->getCell('D4')->setValue(utf8_encode('Perfil'));
	
	$r=5;
	$act=0;
	$ina=0;
	$filas=explode('##', $datos);
	for ($i=0;$i<count($filas);$i++) {
		$columnas=explode('@@', $filas[$i]);
		if ($columnas[2]=='A') {
			$color=PHPExcel_Style_Color::COLOR_BLACK;
			$act++;
		} else {
			$color=PHPExcel_Style_Color::COLOR_RED;
			$ina++;
		}
	
		$format['font']['bold']=false;
		$format['alignment']['horizontal']=PHPExcel_Style_Alignment::HORIZONTAL_RIGHT;
		$format['font']['color']['argb']=$color;
	
		$objPHPExcel->getActiveSheet()->getStyle("A$r")->applyFromArray($format);
	
		$format['alignment']['horizontal']=PHPExcel_Style_Alignment::HORIZONTAL_LEFT;		
	
		$objPHPExcel->getActiveSheet()->getStyle("B$r")->applyFromArray($format);
		$objPHPExcel->getActiveSheet()->getStyle("C$r")->applyFromArray($format);
		$objPHPExcel->getActiveSheet()->getStyle("D$r")->applyFromArray($format);
	
		
		$objPHPExcel->getActiveSheet()->getStyle("A$r:D$r")->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getStyle("A$r")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER1);
		
		$objPHPExcel->getActiveSheet()->getCell("A$r")->setValue(utf8_encode($columnas[0]));
		$objPHPExcel->getActiveSheet()->getCell("B$r")->setValue(utf8_encode(mb_strtoupper($columnas[6])));
		$objPHPExcel->getActiveSheet()->getCell("C$r")->setValue(utf8_encode(mb_strtoupper($columnas[1])));
		$objPHPExcel->getActiveSheet()->getCell("D$r")->setValue(utf8_encode(mb_strtoupper($columnas[7])));
		$r++;
	}
	
	$format['font']['bold']=true;
	$format['font']['size']=11;
	$format['alignment']['horizontal']=PHPExcel_Style_Alignment::HORIZONTAL_LEFT;
	$format['font']['color']['argb']=PHPExcel_Style_Color::COLOR_BLACK;
	
	$objPHPExcel->getActiveSheet()->getStyle("A".($r+1).":B".($r+1))->applyFromArray($format);
	$objPHPExcel->getActiveSheet()->getCell("A".($r+1))->setValue(utf8_encode("Activos: $act"));
	$objPHPExcel->getActiveSheet()->mergeCells('A'.($r+1).':B'.($r+1));
	
	$format['font']['color']['argb']=PHPExcel_Style_Color::COLOR_RED;
	
	$objPHPExcel->getActiveSheet()->getStyle("A".($r+2).":B".($r+2))->applyFromArray($format);
	$objPHPExcel->getActiveSheet()->getCell("A".($r+2))->setValue(utf8_encode("Inactivos: $ina"));
	$objPHPExcel->getActiveSheet()->mergeCells('A'.($r+2).':B'.($r+2));
	
	$format['font']['color']['argb']=PHPExcel_Style_Color::COLOR_BLUE;
	
	$objPHPExcel->getActiveSheet()->getStyle("A".($r+3).":B".($r+3))->applyFromArray($format);
	$objPHPExcel->getActiveSheet()->getCell("A".($r+3))->setValue(utf8_encode("TOTAL: ".($ina+$act)));
	$objPHPExcel->getActiveSheet()->mergeCells('A'.($r+3).':B'.($r+3));
	
	$objPHPExcel->setActiveSheetIndex(0);
	
	$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
	$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LETTER);
	$objPHPExcel->getActiveSheet()->getPageSetup()->setPrintAreaByColumnAndRow(0, 4, 3, $r+3);
	$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(4,4);
	//$objPHPExcel->getActiveSheet()->getPageSetup()->setScale(70,true);
	
	// Redirect output to a clientâ€™s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="Usuarios.xls"');
	header('Cache-Control: max-age=0');
	
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
	exit;
?>