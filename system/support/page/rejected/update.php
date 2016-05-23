<?php
include '../../../includes/glb_variable.php';
include '../../../includes/connection.php';
include '../../../includes/functions.php';

/*ajax var start*/
$message = "";
$messageType = "";
/*ajax var end*/

if(isset($_POST['pk']) && strlen($_POST['pk'])>0){$pk_id = $_POST['pk'];}else{$pk_id = "";}
if(isset($_POST['name']) && strlen($_POST['name'])>0){$name = $_POST['name'];}else{$name = "";}
if(isset($_POST['value']) && strlen($_POST['value'])>0){$value = $_POST['value'];}else{$value = "";}

if($mysql_real_escape_status == 1){
	$pk_id = sys_mysql_real_escape_string($conn,$pk_id);
	$name = sys_mysql_real_escape_string($conn,$name);
	$value = sys_mysql_real_escape_string($conn,$value);
}
if(isset($_SESSION['account_id'])){
	
	$sql_1 = "UPDATE fb_form_data set facebook_url = '$value' where entries_id = '$pk_id'";
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