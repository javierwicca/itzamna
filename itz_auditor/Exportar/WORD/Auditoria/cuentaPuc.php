<?php
	setlocale(LC_CTYPE, 'es_ES');
	
	require_once '../PHPWord/PHPWord.php';
	
	// New Word Document
	$PHPWord = new PHPWord();
	$PHPWord->getProperties()->setCreator(utf8_encode("Itzamn� SAS - $nm_usr"))
	->setLastModifiedBy(utf8_encode("Itzamn� SAS - $nm_usr"))
	->setTitle(utf8_encode("Itzamn� Auditor"))
	->setSubject(utf8_encode("Listado de Cuentas PUC."))
	->setDescription(utf8_encode("Listado de cuentas puc con la siguiente condici�n: $where."))
	->setKeywords(utf8_encode("CUENTAS PIC"));
	
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
	$table->addCell(5000,array('valign'=>'center'))->addText("ITZAMN� AUDITOR",'fSize10','pCenter');
	$table->addCell(5000,array('valign'=>'center'))->addText(date('d/m/Y h:i:s A'),'fSize10','pRight');
	$table->addRow();
	$table->addCell(5000,array('valign'=>'center'))->addText('','fSize10',null);
	$table->addCell(5000,array('valign'=>'center'))->addText("CUENTAS PUC",'fSize10','pCenter');
	$table->addCell(5000,array('valign'=>'center'))->addText('','fSize10','pRight');
	
	$footer = $section->createFooter();
	$footer->addPreserveText('P�gina {PAGE} de {NUMPAGES}.','fSize10','pCenter');
	
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
	$table->addCell(4000, $styleCell)->addText('Cliente', 'fBold','pCenter');
	$table->addCell(2000, $styleCell)->addText('Cuenta PUC', 'fBold','pCenter');
	$table->addCell(4000, $styleCell)->addText('Nombre', 'fBold','pCenter');
	$table->addCell(3000, $styleCell)->addText('Ecuaci�n Patrimonial', 'fBold','pCenter');
	$table->addCell(2000, $styleCell)->addText('Nivel Detalle', 'fBold','pCenter');
	$table->addCell(2000, $styleCell)->addText('Naturaleza', 'fBold','pCenter');
	
	$act=0;
	$ina=0;
	$filas=explode('##', $datos);
	for ($i=0;$i<count($filas);$i++) {
		$columnas=explode('@@', $filas[$i]);
		$table->addRow();
		$table->addCell(4000, $styleCell)->addText(mb_strtoupper($columnas[6]));
		$table->addCell(2000, $styleCell)->addText($columnas[1]);
		$table->addCell(4000, $styleCell)->addText(mb_strtoupper($columnas[2]));
		$table->addCell(3000, $styleCell)->addText(mb_strtoupper($columnas[7]));
		$table->addCell(2000, $styleCell)->addText($columnas[4],null,'pCenter');
		$table->addCell(2000, $styleCell)->addText(mb_strtoupper($columnas[8]));
	}
	
	$section->addTextBreak(2);
	
	$fontStyle = array('color'=>PHPWord_Style_Font::FGCOLOR_BLUE,'bold'=>true, 'size'=>12);
	$section->addText('Total: '.(count($filas)), $fontStyle,null);
	
	header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
	header('Content-Disposition: attachment;filename="cuentasPuc.docx"');
	header('Cache-Control: max-age=0');
	// Save File
	$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
	$objWriter->save('php://output');
?>