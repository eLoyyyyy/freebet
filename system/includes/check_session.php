<?php
if(!isset($_SESSION['account_id'])){	
	header("location: " . $main_url. "/signin/");
}
else{
	if(isset($_SESSION['account_act_status']) && strlen($_SESSION['account_act_status'])>0)
	{
		$account_act_status = $_SESSION['account_act_status'];
	}
	else
	{
		$account_act_status = 0;
	}
	
	
	if($account_act_status == 0) /* Account must be active */
	{
		session_destroy();
		header("location: " . $main_url . '/signin/');
	}
	else if($_SESSION['account_type'] == 1){
		header("location: " . $main_url . '/system/admin/');
	}
	else if($_SESSION['account_type'] == 2){
		header("location: " . $main_url . '/system/support/');
	}
}
?>