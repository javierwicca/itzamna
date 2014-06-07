<?php
	setlocale(LC_CTYPE, 'es_ES');
	
	require_once '../PHPWord/PHPWord.php';
	
	// New Word Document
	$PHPWord = new PHPWord();
	$PHPWord->getProperties()->setCreator(utf8_encode("Itzamná SAS - $nm_usr"))
	->setLastModifiedBy(utf8_encode("Itzamná SAS - $nm_usr"))
	->setTitle(utf8_encode("Itzamná Auditor"))
	->setSubject(utf8_encode("Listado de Roles."))
	->setDescription(utf8_encode("Listado de roles con la siguiente condición: $where."))
	->setKeywords(utf8_encode("ROLES"));
	
	$PHPWord->setDefaultFontName('Arial');
	$PHPWord->setDefaultFontSize(10);
	
	$PHPWord->addFontStyle('fSize10', array('size'=>9));
	$PHPWord->addFontStyle('fBold', array('bold'=>true));
	$PHPWord->addParagraphStyle('pCenter', array('align'=>'center'));
	$PHPWord->addParagraphStyle('pRight', array('align'=>'right'));
	// New portrait section
	
	$section = $PHPWord->createSection();
	
	$header = $section->createHeader();
	$table = $header->addTable();
	$table->addRow();
	$table->addCell(4000,array('valign'=>'center'))->addText(ucwords(strtolower($nm_usr)),'fSize10',null);
	$table->addCell(2500,array('valign'=>'center'))->addText("ITZAMNÁ AUDITOR",'fSize10','pCenter');
	$table->addCell(2500,array('valign'=>'center'))->addText(date('d/m/Y h:i:s A'),'fSize10','pRight');
	$table->addRow();
	$table->addCell(4000,array('valign'=>'center'))->addText('','fSize10',null);
	$table->addCell(2500,array('valign'=>'center'))->addText("ROLES",'fSize10','pCenter');
	$table->addCell(2500,array('valign'=>'center'))->addText('','fSize10','pRight');
	
	$footer = $section->createFooter();
	$footer->addPreserveText('Página {PAGE} de {NUMPAGES}.','fSize10','pCenter');
	
	// Define table style arrays
	$styleTable = array('borderSize'=>1, 'cellMargin'=>80);
	
	// Define cell style arrays
	$styleCell = array('valign'=>'center');
	
	// Add table style
	$PHPWord->addTableStyle('myOwnTableStyle', $styleTable);
	
	// Add table
	$table = $section->addTable('myOwnTableStyle');
	
	// Add row
	$table->addRow();
	
	// Add cells
	$table->addCell(2000, $styleCell)->addText('Código', 'fBold','pCenter');
	$table->addCell(7000, $styleCell)->addText('Nombre', 'fBold','pCenter');
	
	$act=0;
	$ina=0;
	$filas=explode('##', $datos);
	for ($i=0;$i<count($filas);$i++) {
		$columnas=explode('@@', $filas[$i]);
		if ($columnas[2]=='A') {
			$color=PHPWord_Style_Font::FGCOLOR_BLACK;
			$act++;
		} else {
			$color=PHPWord_Style_Font::FGCOLOR_RED;
			$ina++;
		}
		
		$fontStyle = array('color'=>$color);
		$table->addRow();
		$table->addCell(2000, $styleCell)->addText($columnas[0], $fontStyle,'pCenter');
		$table->addCell(7000, $styleCell)->addText(mb_strtoupper($columnas[1]), $fontStyle,null);
	}
	
	$section->addTextBreak(2);
	
	$fontStyle = array('color'=>PHPWord_Style_Font::FGCOLOR_BLACK,'bold'=>true);
	$section->addText('Activos: '.$act, $fontStyle,null);
	
	$fontStyle = array('color'=>PHPWord_Style_Font::FGCOLOR_RED,'bold'=>true);
	$section->addText('Inactivos: '.$ina, $fontStyle,null);
	
	$fontStyle = array('color'=>PHPWord_Style_Font::FGCOLOR_BLUE,'bold'=>true, 'size'=>12);
	$section->addText('Total: '.($ina+$act), $fontStyle,null);
	
	header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
	header('Content-Disposition: attachment;filename="roles.docx"');
	header('Cache-Control: max-age=0');
	// Save File
	$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
	$objWriter->save('php://output');
?>