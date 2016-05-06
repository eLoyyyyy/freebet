<?php
session_start();
include '../../../../../includes/connection.php';
include '../../../../../includes/functions.php';
include '../../../../../includes/glb_variable.php';

$message = '';
$messageType = '';

if(isset($_POST['entry_id']) && strlen($_POST['entry_id'])>0){$entry_id = $_POST['entry_id'];}else{$entry_id = "";}
if(isset($_POST['process']) && strlen($_POST['process'])>0){$process = $_POST['process'];}else{$process = "";}

if($mysql_real_escape_status == 1){
	$entry_id = sys_mysql_real_escape_string($conn,$entry_id);
	$process = sys_mysql_real_escape_string($conn,$process);
}

if(isset($_SESSION['account_id'])){
	$account_id = $_SESSION['account_id'];
	$sql_1 = "
		UPDATE fb_form_data
		SET
			fb_form_data.app_status = '$process',
			fb_form_data.account_id = '$account_id'
		WHERE
			fb_form_data.entries_id = '$entry_id'
	";
	if($query_1 = sys_mysql_query($conn,$sql_1)){
			$message = "Success";
			$messageType = 1;
			
	}else{
		$message = sys_mysql_error($conn);
		$messageType = 2;
	}
}else{
	$message = "Unable to connect";
	$messageType = 2;
}

$message = str_replace("'","&#39;",$message);
$messageType = str_replace("'","&#39;",$messageType);

echo '{';
echo "'message' : '" . $message . "',";
echo "'messageType' : '" . $messageType . "'";
echo '}';
?>