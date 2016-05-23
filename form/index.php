<?php
	session_start();
	include '../system/includes/glb_variable.php';
	include '../system/includes/connection.php';
	include '../system/includes/functions.php';
	/* Check if post array contains data */
	$result = '';
	
   /* if ($_POST) {
           		
        //... process form here ... 
		$userid = isset($_POST['userid']) ? stripslashes($_POST["userid"]) : "";
		$username = isset($_POST['username']) ? stripslashes($_POST["username"]) : "";
		$facebook_url = isset($_POST['facebook_url']) ? stripslashes($_POST["facebook_url"]) : "";
		
		$message = '';
		$messageType = '';
		$redirect = '';
		$process_status = 0;

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
					// prevent re-posting prompt 
					//by redirecting to same url with a 303 status 
					header('Content-type: text/html; charset=utf-8');
					//header("Location: " . $_SERVER['REQUEST_URI'] . "?success=true", true, 303);
					exit;
					
					$process_status = 1;
					//$redirect = $main_url . "?success=true";
					if($process_status == 1){
						$message = "With redirect";
					}else{
						$message = "No Redirect";
					}
					$messageType = 3;
				} else {
					$message = sys_mysql_error($conn);
					$messageType = 2;
				}				
				
		} else {
			$message = "Sorry you've already submitted your entry for claim";//sys_mysql_error($conn);
			$messageType = 2;
		}

		
		$message = str_replace("'","&#39;",$message);
		$messageType = str_replace("'","&#39;",$messageType);
		
		echo '{';
		echo "'message' : '" . $message . "',";
		echo "'messageType' : '" . $messageType . "'";
		echo '}'; 
		echo json_encode(array( 'message' => $message,
					'messageType' => $messageType,
					'process_status' => $process_status));
    } */
?>
<!DOCTYPE>
<html>
	<head>
		<?php include "../system/admin/template/header/header_connection.php"; ?>
		<script src="includes/form.js"></script>
		<script>
			var domain = "<?php echo $domain;?>";
			var main_url = "<?php echo $main_url;?>";
		</script>
	</head>
	<body>
		<div class="container">

<?php	

	if (isset($_GET['success']) && $_GET['success'] == true) {
?>
	<div>
		<div class="page-heading text-center">
			<h3>khi b&#7841;n &#273;&#259;ng k&#253; th&#224;nh c&#244;ng</h3>
		</div>
	</div>
<?php
	} else {
		$block_it = 1;
		$sql_3 = "
				SELECT 
					* 
				FROM 
					fb_form_data 
				WHERE 
					EXISTS(SELECT * FROM fb_form_data WHERE INET_NTOA(ip_address) = '" . $_SERVER['REMOTE_ADDR'] . "') = ". $block_it ."
			";
		$query3 = sys_mysql_query($conn, $sql_3);
		$block_ip = sys_mysql_num_rows($query3);
		if ($block_ip == 0) {
?>
			<div class="col-lg-8 col-lg-offset-2">
				<div class="loginmodal-container">
						<h1>M&#7851;u &#272;&#259;ng K&#253;</h1><br>
					<!-- <form class="form-horizontal" id="claim-form" method="POST" action="index.php"> action="index.php"-->
						<div class="form-group clearfix">
							<label for="inputEmail3" class="col-sm-3 control-label">T&#234;n &#272;&#259;ng Nh&#7853;p t&#7841;i QQ188</label>
							<div class="col-sm-9">
								<input type="text" name="userid" class="form-control input-lg form-reg" id="userid" onkeypress="press_enter(event,'registration')" data-required="true" data-required_class_name="field_required" data-maxLength="100" data-minLength="5" data-element="textbox" data-format="text" data-field="userid" placeholder="T&#234;n &#272;&#259;ng Nh&#7853;p t&#7841;i QQ188">
							</div>
						</div>
						<div class="form-group clearfix">
							<label for="inputPassword3" class="col-sm-3 control-label">T&#234;n T&#224;i kho&#7843;n Facebook</label>
							<div class="col-sm-9">
								<input type="text" name="username" class="form-control input-lg form-reg" id="username" onkeypress="press_enter(event,'registration')" data-required="true" data-required_class_name="field_required" data-maxLength="100" data-minLength="5" data-element="textbox" data-format="text" data-field="username" placeholder="T&#234;n &#273;&#7847;y &#273;&#7911;">
							</div>
						</div>
						<div class="form-group clearfix">
							<label for="inputPassword4" class="col-sm-3 control-label">Link Facebook</label>
							<div class="col-sm-9">
								<input type="text" name="facebook_url" class="form-control input-lg form-reg" id="facebook_url" onkeypress="press_enter(event,'registration')" data-required="true" data-required_class_name="field_required" data-maxLength="100" data-minLength="5" data-element="textbox" data-format="text" data-field="facebook_url" placeholder="Link Facebook">
							</div>
						</div>
						<div class="form-group clearfix">
							<div class="col-sm-offset-3 col-sm-9">
								<button type="submit" class="btn btn-default" id="registration">&#272;&#259;ng nh&#7853;p</button>
							</div>
						</div>
					<!--</form>-->
				</div>
			</div>
<?php } else { ?>
		<div class="page-heading">
			<h3>XIN L&#7894;I QU&#221; KH&#193;CH, NH&#7856;M M&#7908;C &#272;&#205;CH C&#212;NG B&#7856;NG CHO T&#7844;T C&#7842; NG&#431;&#7900;I CH&#416;I, M&#7894;I NG&#431;&#7900;I CH&#416;I CH&#7880; &#272;&#431;&#7906;C D&#217;NG 1 M&#195; IP &#272;&#7874; &#272;&#258;NG K&#221; NH&#7852;N C&#431;&#7906;C MI&#7876;N PH&#205; T&#7914; QQ188.COM</h3>
		</div>
<?php	}
	} ?>
		</div>
	</body>
</html>