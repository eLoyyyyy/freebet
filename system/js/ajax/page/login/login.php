<?php
session_start();
include '../../../../includes/connection.php';
include '../../../../includes/functions.php';
include '../../../../includes/glb_variable.php';

/*Set Variables*/
$process_status = 0;
$message = '';
$messageType = '';
$redirect = '';
$save_session_status = 0;
$web_type = 'QQ188';

if(isset($_POST['freebet_email']) && strlen($_POST['freebet_email'])>0){$email_address = $_POST['freebet_email'];}else{$email_address = '';}
if(isset($_POST['password_id']) && strlen($_POST['password_id'])>0){$password = $_POST['password_id'];}else{$password = '';}

if($mysql_real_escape_status == 1){
	$email_address = sys_mysql_real_escape_string($conn,$email_address);
	$password = sys_mysql_real_escape_string($conn,$password);
}
$enc_password = md5($password);

if($email_address && $password){
	$sql_1 = "
		SELECT
			freebet_tbl_accounts.id as account_id,
			freebet_tbl_accounts.enc_id as enc_id,
			freebet_tbl_accounts.first_name as first_name,
			freebet_tbl_accounts.middle_name as middle_name,
			freebet_tbl_accounts.last_name as last_name,
			freebet_tbl_accounts.email_address as email_address,
			freebet_tbl_accounts.password as password,
			freebet_tbl_accounts.account_type as account_type,
			freebet_tbl_accounts.website_type as website_type,
			freebet_tbl_accounts.activation_status as activation_status
		FROM
			freebet_tbl_accounts
		WHERE
			freebet_tbl_accounts.email_address = '$email_address' AND
			freebet_tbl_accounts.password = '$password' AND
			freebet_tbl_accounts.website_type = '$web_type' AND
			freebet_tbl_accounts.activation_status = '1'
	";
	if($query_1 = sys_mysql_query($conn,$sql_1)){
		$total_account = sys_mysql_num_rows($query_1);
		if($total_account>0){
			$data_1 = sys_mysql_fetch_assoc($query_1);
			
			/*check the account type of the user*/
			$process_status = 1;
			
			if($data_1['account_type'] == 1){ /*Admin*/
				$redirect = $domain . 'admin/';
				$save_session_status = 1;
				$messageType = 1;
			}else if($data_1['account_type'] == 2){/*Customer Service*/
				$redirect = $domain . 'support/';
				$save_session_status = 1;
				$messageType = 1;
			}else{
				/*Unknown Account*/
				$process_status = 0;
				$message = 'Unknown Account type';
				$messageType = 2;
			}
			
			if($save_session_status == 1){
				$_SESSION['account_id'] = $data_1['account_id'];
				$_SESSION['account_enc_id'] = $data_1['enc_id'];
				$_SESSION['account_first_name'] = $data_1['first_name'];
				$_SESSION['account_middle_name'] = $data_1['middle_name'];
				$_SESSION['account_last_name'] = $data_1['last_name'];
				$_SESSION['account_email_address'] = $data_1['email_address'];
				$_SESSION['account_password'] = $data_1['password'];
				$_SESSION['account_type'] = $data_1['account_type'];
				$_SESSION['account_website_type'] = $data_1['website_type'];
				$_SESSION['account_act_status'] = $data_1['activation_status'];
			}
		}
		else{
			$message = "<i class=\"glyphicon glyphicon-warning-sign\"></i> wrong email address or password";
			$messageType = 2;
		}
	}else{
		$message = sys_mysql_error($conn);
		$messageType = 2;
	}
}
else{
	$message = sys_mysql_error($conn);
	$messageType = 2;
}
/*Send Back to JS*/
$message = str_replace("'","&#39;",$message);
$redirect = str_replace("'","&#39;",$redirect);

echo '{';
echo "'message' : '" . $message . "',";
echo "'messageType' : '" . $messageType . "',";
echo "'redirect' : '" . $redirect . "',";
echo "'process_status' : '" . $process_status . "'";
echo '}';

?>