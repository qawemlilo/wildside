<?php
$companyname= Test;

error_reporting(E_ALL);

date_default_timezone_set('Europe/London');

/** PHPExcel */
require_once 'http://www.wildsidesa.co.za/cms-wildside/phpexel/Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");


// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Order_id')
            ->setCellValue('B1', 'Company_Name')
            ->setCellValue('C1', 'Authorisation')
            ->setCellValue('D1', 'Tel/Fax')
			->setCellValue('E1', 'Email')
			->setCellValue('F1', 'Product Description')
			->setCellValue('G1', 'Order price sub total')
			->setCellValue('H1', 'Vat')
			->setCellValue('I1', 'Total')
			->setCellValue('A2', $companyname)
			;
			
	// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('ws_invoice');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client's web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="01simple.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;		
		