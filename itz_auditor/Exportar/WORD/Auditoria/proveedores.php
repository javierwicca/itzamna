<?php
	setlocale(LC_CTYPE, 'es_ES');
	
	require_once '../PHPWord/PHPWord.php';
	
	// New Word Document
	$PHPWord = new PHPWord();
	$PHPWord->getProperties()->setCreator(utf8_encode("Itzamná SAS - $nm_usr"))
	->setLastModifiedBy(utf8_encode("Itzamná SAS - $nm_usr"))
	->setTitle(utf8_encode("Itzamná Auditor"))
	->setSubject(utf8_encode("Listado Proveedores."))
	->setDescription(utf8_encode("Listado de Proveedores con la siguiente condición: $where."))
	->setKeywords(utf8_encode("PROVEEDORES"));
	
	$PHPWord->setDefaultFontName('Arial');
	$PHPWord->setDefaultFontSize(10);
	
	$PHPWord->addFontStyle('fSize10', array('size'=>9));
	$PHPWord->addFontStyle('fBold', array('bold'=>true));
	$PHPWord->addParagraphStyle('pCenter', array('align'=>'center'));
	$PHPWord->addParagraphStyle('pRight', array('align'=>'right'));
	// New portrait section
	
	$section = $PHPWord->createSection(array('orientation'=>'landscape'));
	
	$header = $section->createHeader();
	$table = $header->addTable();
	$table->addRow();
	$table->addCell(5000,array('valign'=>'center'))->addText(ucwords(strtolower($nm_usr)),'fSize10',null);
	$table->addCell(5000,array('valign'=>'center'))->addText("ITZAMNÁ AUDITOR",'fSize10','pCenter');
	$table->addCell(5000,array('valign'=>'center'))->addText(date('d/m/Y h:i:s A'),'fSize10','pRight');
	$table->addRow();
	$table->addCell(5000,array('valign'=>'center'))->addText('','fSize10',null);
	$table->addCell(5000,array('valign'=>'center'))->addText("PROVEEDORES",'fSize10','pCenter');
	$table->addCell(5000,array('valign'=>'center'))->addText('','fSize10','pRight');
	
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
	$table->addCell(2000, $styleCell)->addText('Identificación', 'fBold','pCenter');
	$table->addCell(4000, $styleCell)->addText('Nombre', 'fBold','pCenter');
	$table->addCell(4000, $styleCell)->addText('Direcciòn', 'fBold','pCenter');
	$table->addCell(3000, $styleCell)->addText('Teléfono', 'fBold','pCenter');
	$table->addCell(2000, $styleCell)->addText('Persona', 'fBold','pCenter');
	$table->addCell(2000, $styleCell)->addText('Tp. Documento', 'fBold','pCenter');
	
	$act=0;
	$ina=0;
	$filas=explode('##', $datos);
	for ($i=0;$i<count($filas);$i++) {
		$columnas=explode('@@', $filas[$i]);
		$table->addRow();
		$table->addCell(2000, $styleCell)->addText($columnas[0]);
		$table->addCell(4000, $styleCell)->addText($columnas[15]);
		$table->addCell(4000, $styleCell)->addText(mb_strtoupper($columnas[9]));
		$table->addCell(3000, $styleCell)->addText(mb_strtoupper($columnas[13]));
		$table->addCell(2000, $styleCell)->addText($columnas[16]);
		$table->addCell(2000, $styleCell)->addText(mb_strtoupper($columnas[17]));
	}
	
	$section->addTextBreak(2);
	
	$fontStyle = array('color'=>PHPWord_Style_Font::FGCOLOR_BLUE,'bold'=>true, 'size'=>12);
	$section->addText('Total: '.(count($filas)), $fontStyle,null);
	
	header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
	header('Content-Disposition: attachment;filename="Proveedores.docx"');
	header('Cache-Control: max-age=0');
	// Save File
	$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
	$objWriter->save('php://output');
?>