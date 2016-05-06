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
	<div class="page-heading">
		<h3>Thank you</h3>
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
						<h1>Registration Form</h1><br>
					<!-- <form class="form-horizontal" id="claim-form" method="POST" action="index.php"> action="index.php"-->
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-3 control-label">User ID</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="userid" name="userid" pattern="^[A-Za-z0-9 ]*[A-Za-z0-9][A-Za-z0-9 ]*$" placeholder="User ID" required>
							</div>
						</div>
						<div class="form-group">
							<label for="inputPassword3" class="col-sm-3 control-label">Nama di Facebook</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="username" name="username" pattern="^[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]*$" placeholder="Name" required>
							</div>
						</div>
						<div class="form-group">
							<label for="inputPassword4" class="col-sm-3 control-label">Facebook URL</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="facebook_url" name="facebook_url" pattern="(?:(?:http|https):\/\/)?(?:www.)?facebook.com\/(?:(?:\w)*#!\/)?(?:pages\/)?(?:[?\w\-]*\/)?(?:profile.php\?id=(?=\d.*))?([\w\-]*)?" placeholder="Facebook URL" required>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-9">
								<button type="submit" class="btn btn-default" id="claim_form">Sign in</button>
							</div>
						</div>
					<!--</form>-->
				</div>
			</div>
<?php } else { ?>
		<div class="page-heading">
			<h3>MOHON MAAF ATAS KETIDAK NYAMANANNYA.. SESUAI DENGAN KETENTUAN YANG TELAH DITETAPKAN SELURUH MEMBER (peserta freebet QQ101.COM) TIDAK DAPAT MELAKUKAN KLAIM FREEBET LEBIH DARI 1X DENGAN IP (INTERNET PROTOKOL) YANG SAMA..</h3>
		</div>
<?php	}
	} ?>
		</div>
	</body>
</html>