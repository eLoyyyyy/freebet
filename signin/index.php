<?php
session_start();
include '../system/includes/glb_variable.php';
include '../system/includes/connection.php';
include '../system/includes/functions.php';

if(!isset($_SESSION['account_id'])){
	
}else{
	if(isset($_SESSION['account_act_status']) && strlen($_SESSION['account_act_status'])>0){
		$account_act_status = $_SESSION['account_act_status'];
	}else{
		$account_act_status = 0;
	}
	
	if($account_act_status == 1){
		header("location: " . $main_url . '/system/admin/');
	}else if($account_act_status == 2){
		header("location: " . $main_url . '/system/support/');
	}
}
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php include "../system/admin/template/header/header_connection.php";?>
		<script type="text/javascript">
			var domain = "<?php echo $domain;?>";
			var main_url = "<?php echo $main_url;?>";
		</script>
	</head>
	<body>
		<div class="loginmodal-container">
			<h1>Login to Your Account</h1><br>
			<input type="text" name="user" class="form-control input-lg form-signin" id="freebet_email" onkeypress="press_enter(event,'signinBtn')" data-required="true" data-required_class_name="field_required" data-maxLength="100" data-minLength="5" data-element="textbox" data-format="email" data-field="freebet_email" placeholder="Email Address"  placeholder="Username" >
			<input type="password" name="pass" class="form-control input-lg form-signin" id="password_id" onkeypress="press_enter(event,'signinBtn')" data-required="true" data-required_class_name="field_required" data-maxLength="100" data-minLength="5" data-element="textbox" data-format="text" data-field="password_id" placeholder="Password">
			<!--<input type="submit" name="login" onclick="loginAlert()" class="login loginmodal-submit" value="Login">-->
			<button class="login loginmodal-submit" id="signinBtn">Submit</button>
		</div>
		<script type="text/javascript" src="<?php echo $domain;?>js/ajax/page/login/login.js"></script>
	</body>
</html>