<?php
require_once '../PHPWord.php';

// New Word Document
$PHPWord = new PHPWord();

// New portrait section
$section = $PHPWord->createSection();

// Define table style arrays
$styleTable = array('borderSize'=>6, 'borderColor'=>'006699', 'cellMargin'=>80);
$styleFirstRow = array('borderBottomSize'=>18, 'borderBottomColor'=>'0000FF', 'bgColor'=>'66BBFF');

// Define cell style arrays
$styleCell = array('valign'=>'center');
$styleCellBTLR = array('valign'=>'center', 'textDirection'=>PHPWord_Style_Cell::TEXT_DIR_BTLR);

// Define font style for first row
$fontStyle = array('bold'=>true, 'align'=>'center');

// Add table style
$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);

// Add table
$table = $section->addTable('myOwnTableStyle');

// Add row
$table->addRow(900);

// Add cells
$table->addCell(2000, $styleCell)->addText('Row 1', $fontStyle);
$table->addCell(2000, $styleCell)->addText('Row 2', $fontStyle);
$table->addCell(2000, $styleCell)->addText('Row 3', $fontStyle);
$table->addCell(2000, $styleCell)->addText('Row 4', $fontStyle);
$table->addCell(500, $styleCellBTLR)->addText('Row 5', $fontStyle);

// Add more rows / cells
for($i = 1; $i <= 10; $i++) {
	$table->addRow();
	$table->addCell(2000)->addText("Cell $i");
	$table->addCell(2000)->addText("Cell $i");
	$table->addCell(2000)->addText("Cell $i");
	$table->addCell(2000)->addText("Cell $i");
	
	$text = ($i % 2 == 0) ? 'X' : '';
	$table->addCell(500)->addText($text);
}

header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Disposition: attachment;filename="roles.docx"');
header('Cache-Control: max-age=0');
// Save File
$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
$objWriter->save('php://output');
?>