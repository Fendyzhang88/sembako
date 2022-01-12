<?php
include("plugins/phpexcel/PHPExcel.php");
include("koneksi.php");

$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0);

//set ukuran cell
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth('20');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth('20');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth('30');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth('50');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth('20');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth('10');

//set tulisan menjadi bold
$objPHPExcel->getActiveSheet()->getStyle("A1:F1")->getFont()->setBold(true);
//menambahkan auto filter
$objPHPExcel->getActiveSheet()->setAutoFilter('A1:F1');

//membuat isi cel
$objPHPExcel->getActiveSheet()->setCellValue("A1", "No KK");
$objPHPExcel->getActiveSheet()->setCellValue("B1", "No KTP");
$objPHPExcel->getActiveSheet()->setCellValue("C1", "Nama");
$objPHPExcel->getActiveSheet()->setCellValue("D1", "Alamat");
$objPHPExcel->getActiveSheet()->setCellValue("E1", "No Kupon");
$objPHPExcel->getActiveSheet()->setCellValue("F1", "Jenis");

$row = 2;
$q = $database->query("select * from tbl_warga");
while($warga = $q->fetch_array(MYSQLI_ASSOC)){
  $objPHPExcel->getActiveSheet()->setCellValue("A".$row, $warga['no_kk']);
  $objPHPExcel->getActiveSheet()->setCellValue("B".$row, $warga['no_ktp']);
  $objPHPExcel->getActiveSheet()->setCellValue("C".$row, $warga['nama']);
  $objPHPExcel->getActiveSheet()->setCellValue("D".$row, $warga['alamat']);
  $objPHPExcel->getActiveSheet()->setCellValue("E".$row, $warga['no_kupon']);
  $objPHPExcel->getActiveSheet()->setCellValue("F".$row, $warga['jenis']);
  $row++;
}

header('Content-Type: application/vnd.ms-excel'); 
header('Content-Disposition: attachment;filename="Database Sembako.xlsx"'); 
header('Cache-Control: max-age=0'); 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
$objWriter->save('php://output');
?>