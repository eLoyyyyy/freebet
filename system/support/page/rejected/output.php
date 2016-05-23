<?php
include '../../../includes/glb_variable.php';
include '../../../includes/connection.php';
include '../../../includes/functions.php';
require_once '../../../php/library/phpexcel/PHPExcel.php';

$data_1 = '';
$row = [];
$total_account = 0;
$tempRow = [];

$sql_1 = "
	SELECT
		fb_form_data.entries_id as entries_id,
		fb_form_data.user_id as user_id,
		fb_form_data.user_name as user_name,
		fb_form_data.facebook_url as facebook_url,
		INET_NTOA(fb_form_data.ip_address) as ip_address,
		fb_form_data.reason_type as reason_type,
		fb_form_data.app_status as app_status,
		fb_form_data.account_id as account_id,
		fb_form_data.timestamp as timestamp
	FROM
		fb_form_data
	WHERE
		fb_form_data.app_status = '3'
	";
if($query_1 = sys_mysql_query($conn,$sql_1)){
	$total_account = sys_mysql_num_rows($query_1);
	if($total_account>0){
		while($data_1 = sys_mysql_fetch_assoc($query_1)){
			$tempRow = array( "entries_id" => $data_1['entries_id'],
							  "userid" => $data_1['user_id'],
							  "facebook" => $data_1['facebook_url'],
							  "name" => $data_1['user_name'],
							  "ipv4" => $data_1['ip_address'],
							  "date_submitted" => $data_1['timestamp'],
							  "message" => $data_1['reason_type']);
			$row[] = $tempRow;
		}
	}else{
		exit();
	}
}else{
	exit();
}

$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle('Export');
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'No. ID');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'USER ID');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'FACEBOOK');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'NAME');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'IP ADDRESS');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'DATE');
$objPHPExcel->getActiveSheet()->setCellValue('G1', 'REASON');

foreach ($row as $singleRow){
	$rowCount = $objPHPExcel->getActiveSheet()->getHighestRow()+1;
	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $singleRow["entries_id"]);
	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $singleRow["userid"]);
	$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $singleRow["facebook"]);
	$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $singleRow["name"]);
	$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $singleRow["ipv4"]);
	$objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $singleRow["date_submitted"]);
	$objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $singleRow["message"]);
}

foreach(range('A','G') as $columnID)
{
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="export_rejected.xlsx"');
header('Cache-Control: max-age=0');

//var_dump($row);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output'); 
?>

