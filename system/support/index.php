<?php
ini_set('session_cookie_httponly',true);
session_start();
include '../includes/glb_variable.php';
if(!isset($_SESSION['account_id']))
{
	header("location: " . $main_url. "/signin/");
}
else
{
	if($_SESSION['account_type'] == 1){
		header("location: " . $main_url . '/system/admin/');
	}
}
include '../includes/connection.php';
include '../includes/functions.php';

if(isset($_SESSION['account_id']) && strlen($_SESSION['account_id'])>0)
{
	$account_type = $_SESSION['account_type'];
	if($account_type == 2)
	{
		$account_id = $_SESSION['account_id'];
?>
<?php
		$account_id = $_SESSION['account_id'];
		$account_type = $_SESSION['account_type'];
		if(!isset($_SESSION['account_id']) && strlen($_SESSION['account_id'])>0)
		{
			header("location: " . $domain . "/signin");
		}
		else
		{
		?>
			<html lang="en-th">
				<head>
					<?php
					if(isset($_GET['page']) && strlen($_GET['page'])>0)
					{
						$page = $_GET['page'];
						if(strtolower($page)=='dashboard'){echo '<title>Freebet QQ101 - Dashboard</title>';}
						if(strtolower($page)=='pending'){echo '<title>Freebet QQ101 - Pending</title>';}
						if(strtolower($page)=='onprocess'){echo '<title>Freebet QQ101 - On Process</title>';}
						if(strtolower($page)=='approved'){echo '<title>Freebet QQ101 - Approved</title>';}
						if(strtolower($page)=='rejected'){echo '<title>Freebet QQ101 - Reject</title>';}
						else
						{
							echo '<title>Freebet QQ101 - 404</title>';
						}
					}
					else
					{						
						//$page = 'dashboard';
						$page = 'pending';
					}
					$page = strtolower($page);
					?>
					<meta charset="utf-8">
					<meta name="viewport" content="width=device-width, initial-scale=1">
					<!--/*Include the header*/-->
					<?php
						include '../admin/template/header/header_connection.php';
					?>
					<script type="text/javascript">var domain = "<?php echo $domain;?>";
					var main_url = "<?php echo $main_url;?>";</script>
					<style type="text/css">
						#main-navbar li a i
						{
							padding-top:15px;
							padding-bottom:15px;
						}
						@media (min-width: 768px)
						{
							#main-navbar .user-menu>img
							{
								margin-top:5px;
							}
							.theme-freebet #main-navbar .nav>li>a i
							{
								padding-bottom:15px;
							}
						}
					</style>
				</head>
				<body class='theme-freebet default animate-lg gh'>
					<?php include '../admin/template/pop-up/popupcontainer.php'?>
					<div id="main-wrapper">
						<!---/*Include Header Here*/-->
						<?php include '../admin/template/nav-bar/top-nav-bar.php';?>
						<?php include '../admin/template/nav-bar/side-nav-bar.php';?>
						<div id="content-wrapper">
							<!--/*Breadcrumbs*/-->
						<?php
							if($page == 'dashboard')
							{
								include 'page/dashboard/index.php';
							}
							else if($page == 'pending')
							{
								include 'page/pending/index.php';
							}
							else if($page == 'onprocess')
							{
								include 'page/onprocess/index.php';
							}
							else if($page == 'approved')
							{
								include 'page/approved/index.php';
							}
							else if($page == 'rejected')
							{
								include 'page/rejected/index.php';
							}
							else
							{
								include '../http_err/err_404.php';
							}
						?>
						
						</div>
						<div id="main-menu-bg"></div>
					</div>
					<!--Script start-->
						<script type="text/javascript">
							jq('.notify-list').slimScroll({
								distance: '2px',
								railVisible: true,
								railColor: '#222',
								railOpacity: 0.3,
								wheelStep: 10,
								allowPageScroll: false
							});
							jq('.message-list').slimScroll({
								distance: '2px',
								railVisible: true,
								railColor: '#222',
								railOpacity: 0.3,
								wheelStep: 10,
								allowPageScroll: false
							});
							
							jq('.notify-list').css({'height':''});
							jq('.message-list').css({'height':''});
							jq('.slimScrollDiv').css({'height':''});
							jq('.slimScrollDiv').css({'max-height':'250px'});
							
							jq(document).ready(function(){
								jq('.mm-dropdown').hover(function(){
									jq(this).addClass('open active mmc-dropdown-open');
									jq('.mmc-dropdown-delay').addClass('mmc-dropdown-open-ul');
								},
								function(){
									jq(this).removeClass('open active mmc-dropdown-open');
									jq('.mmc-dropdown-delay').removeClass('mmc-dropdown-open-ul');
								});
							});
						</script>
					<!--Script end-->
				</body>
			</html>
		<?php
		}
	}
}
?>