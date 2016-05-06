<?php
ini_set('session_cookie_httponly',true);
session_start();
include '../includes/glb_variable.php';
include '../includes/connection.php';
include '../includes/functions.php';

if(!isset($_SESSION['account_id']))
{
	header('location:' . $domain . '/signin');
}
else
{
	$admin_locked = 1;
	if(isset($_SESSION['account_type']) && strlen($_SESSION['account_type'])>0){$account_type = $_SESSION['account_type'];}else{$account_type = "";}

	if($_SESSION['account_type'] == 2){
		$admin_locked = 0;
		header("location: " . $main_url . '/system/support/');
	}
	
	if($admin_locked == 1)
	{
?>
		<!doctype html>
		<html>
			<head>
				<title>Grab Help</title>
				<meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<?php include '../admin/template/header/header_connection.php';?>
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
						.theme-grab #main-navbar .nav>li>a i
						{
							padding-bottom:15px;
						}
					}
				</style>
				<?php
					$errorStatus = 1;
					$errorStyle = 'background:#FF875F';
					
					if(isset($_GET['page']) && strlen($_GET['page'])>0)
					{
						$page = $_GET['page'];
						if(strtolower($page)=='dashboard')
						{
							
						}
						else if(strtolower($page)=='profile'){}
					}
					else
					{
						$page = 'dashboard';
					}
				?>
			</head>
			<body class='theme-freebet default animate-lg gh'>
				<?php include '../admin/template/pop-up/popupcontainer.php'?>
				<div id="main-wrapper">
					<!--/*Include top-nav-bar And Side-nav-bar*/-->
					<?php include '../admin/template/nav-bar/top-nav-bar.php';?>
					<?php include '../admin/template/nav-bar/side-nav-bar.php';?>
					<div id="content-wrapper">
						<?php
						if($page == 'dashboard')
						{
							include 'page/dashboard/index.php';
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
?>
