<?php
	phpinfo();
	die();
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
	<div class="page-heading">
		<h3>&#3586;&#3629;&#3586;&#3629;&#3610;&#3588;&#3640;&#3603;</h3>
	</div>
<?php
	} else {
		$block_it = 0;
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
						<h1>
							<!-- Registration Form -->
							&#3649;&#3610;&#3610;&#3615;&#3629;&#3619;&#3660;&#3617;&#3621;&#3591;&#3607;&#3632;&#3648;&#3610;&#3637;&#3618;&#3609;
						</h1>
						<br>
					<!-- <form class="form-horizontal" id="claim-form" method="POST" action="index.php"> action="index.php"-->
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-3 control-label">
								<!-- User ID : English
									ยูเซอร์ไอดี : Thailand
								-->
								&#3618;&#3641;&#3648;&#3595;&#3629;&#3619;&#3660;&#3652;&#3629;&#3604;&#3637;
							</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="userid" name="userid" pattern="^[A-Za-z0-9 ]*[A-Za-z0-9][A-Za-z0-9 ]*$" placeholder="&#3618;&#3641;&#3648;&#3595;&#3629;&#3619;&#3660;&#3652;&#3629;&#3604;&#3637;" required>
							</div>
						</div>
						<div class="form-group">
							<label for="inputPassword3" class="col-sm-3 control-label">
								<!-- Nama di Facebook : Indonesian -->
								&#3594;&#3639;&#3656;&#3629;&#3607;&#3637;&#3656;&#3651;&#3594;&#3657;&#3651;&#3609;&#3648;&#3615;&#3626;&#3610;&#3640;&#3658;&#3588;
							</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="username" name="username" pattern="^[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]*$" placeholder="&#3594;&#3639;&#3656;&#3629;&#3586;&#3629;&#3591;&#3588;&#3640;&#3603;" required>
							</div>
						</div>
						<div class="form-group">
							<label for="inputPassword4" class="col-sm-3 control-label">URL &#3648;&#3615;&#3626;&#3610;&#3640;&#3658;&#3588;&#3586;&#3629;&#3591;&#3588;&#3640;&#3603;</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="facebook_url" name="facebook_url" pattern="(?:(?:http|https):\/\/)?(?:www.)?facebook.com\/(?:(?:\w)*#!\/)?(?:pages\/)?(?:[?\w\-]*\/)?(?:profile.php\?id=(?=\d.*))?([\w\-]*)?" placeholder="URL &#3648;&#3615;&#3626;&#3610;&#3640;&#3658;&#3588;&#3586;&#3629;&#3591;&#3588;&#3640;&#3603;" required>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-9">
								<button type="submit" class="btn btn-default" id="claim_form">&#3621;&#3591;&#3607;&#3632;&#3648;&#3610;&#3637;&#3618;&#3609;</button>
							</div>
						</div>
					<!--</form>-->
				</div>
			</div>
<?php } else { ?>
		<div class="page-heading">
			<h3>&#3648;&#3604;&#3636;&#3617;&#3614;&#3633;&#3609;&#3615;&#3619;&#3637;&#3607;&#3637;&#3656; QQ101 &#3626;&#3634;&#3617;&#3634;&#3619;&#3606;&#3586;&#3629;&#3619;&#3633;&#3610;&#3652;&#3604;&#3657;&#3648;&#3614;&#3637;&#3618;&#3591;&#3588;&#3619;&#3633;&#3657;&#3591;&#3648;&#3604;&#3637;&#3618;&#3623;&#3648;&#3607;&#3656;&#3634;&#3609;&#3633;&#3657;&#3609; &#3648;&#3619;&#3634;&#3627;&#3623;&#3633;&#3591;&#3648;&#3611;&#3655;&#3609;&#3629;&#3618;&#3656;&#3634;&#3591;&#3618;&#3636;&#3656;&#3591;&#3623;&#3656;&#3634;&#3612;&#3641;&#3657;&#3648;&#3621;&#3656;&#3609;&#3607;&#3640;&#3585;&#3588;&#3609;&#3592;&#3632;&#3611;&#3599;&#3636;&#3610;&#3633;&#3605;&#3636;&#3605;&#3634;&#3617;&#3586;&#3657;&#3629;&#3585;&#3635;&#3627;&#3609;&#3604;&#3649;&#3621;&#3632;&#3648;&#3591;&#3639;&#3656;&#3629;&#3609;&#3652;&#3586; &#3648;&#3619;&#3634;&#3652;&#3617;&#3656;&#3629;&#3609;&#3640;&#3597;&#3634;&#3605;&#3651;&#3627;&#3657;&#3626;&#3617;&#3634;&#3594;&#3636;&#3585;&#3607;&#3640;&#3585;&#3607;&#3656;&#3634;&#3609;&#3607;&#3635;&#3585;&#3634;&#3619;&#3607;&#3640;&#3592;&#3619;&#3636;&#3605; &#3585;&#3619;&#3640;&#3603;&#3634;&#3605;&#3619;&#3623;&#3592;&#3626;&#3629;&#3610;&#3623;&#3656;&#3634;&#3586;&#3657;&#3629;&#3617;&#3641;&#3621;&#3607;&#3637;&#3656;&#3588;&#3640;&#3603;&#3585;&#3619;&#3629;&#3585;&#3609;&#3633;&#3657;&#3609;&#3652;&#3604;&#3657;&#3606;&#3641;&#3585;&#3605;&#3657;&#3629;&#3591;&#3649;&#3621;&#3657;&#3623;&#3607;&#3633;&#3657;&#3591;&#3627;&#3617;&#3604; &#3649;&#3621;&#3657;&#3623;&#3607;&#3634;&#3591;&#3648;&#3619;&#3634;&#3592;&#3632;&#3605;&#3619;&#3623;&#3592;&#3626;&#3629;&#3610;&#3629;&#3637;&#3585;&#3588;&#3619;&#3633;&#3657;&#3591;&#3627;&#3609;&#3638;&#3656;&#3591;</h3>
		</div>
<?php	}
	} ?>
		</div>
	</body>
</html>