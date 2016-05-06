<?php
session_start();
include '../../system/includes/glb_variable.php';
include '../../system/includes/connection.php';
include '../../system/includes/functions.php';

$message = '';
$messageType = '';
$redirect = '';
$process_status = 0;

if(isset($_POST['userid']) && strlen($_POST['userid'])>0){
	$userid = $_POST['userid'];
}else{
	$userid = '';
}
if(isset($_POST['username']) && strlen($_POST['username'])>0){
	$username= $_POST['username'];
}else{
	$username= '';
}
if(isset($_POST['facebook_url']) && strlen($_POST['facebook_url'])>0){
	$facebook_url= $_POST['facebook_url'];
}else{
	$facebook_url = '';
}

$sql_1 = "
		SELECT 
			user_name 
		FROM 
			fb_form_data 
		WHERE 
			facebook_url = '" . $facebook_url . "'
			OR
			user_id = '" . $userid . "'
			OR 
			user_name = '" . $username . "'
	";
$query = sys_mysql_query($conn, $sql_1);
$total_count = sys_mysql_num_rows($query);
/*check if the account is already exist*/
if($total_count == 0){
	$sql_2 = "
		INSERT INTO 
			fb_form_data 
		VALUES 
			(null, 
			'" . $userid . "', 
			'" . $username . "', 
			'" . $facebook_url . "', 
			'QQ101', 
			" . ip2long($_SERVER['REMOTE_ADDR']) . ", 
			null,
			null, 
			0, 
			0, 
			null)
	";
	$query2 = sys_mysql_query($conn, $sql_2);
	$total_inserted = sys_mysql_affected_rows($conn);
	if($total_inserted == 1){
		//header('Content-type: text/html; charset=utf-8');
		//exit;
		$process_status = 1;
		$redirect = $main_url . '/form/?success=true';
		$message = "Success";
		$messageType = 3;
	}else{
		$message = sys_mysql_error($conn);
		$messageType = 2;
	}
}
else{
	$message = 'Sorry your account already exists';
	$messageType = 2;
}

$message = str_replace("'","&#39;",$message);

echo '{';
echo "'message' : '" . $message . "',";
echo "'messageType' : '" . $messageType . "',";
echo "'process_status' : '" . $process_status . "',";
echo "'redirect' : '" . $redirect . "'";
echo '}';
?>