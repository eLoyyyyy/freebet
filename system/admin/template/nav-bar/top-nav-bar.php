<?php
/*Set all the SESSION*/
if(isset($_SESSION['account_id']) && strlen($_SESSION['account_id'])>0)
{
	$account_id = $_SESSION['account_id'];
	$account_type = $_SESSION['account_type'];
	
	if(isset($_SESSION['account_first_name']) && strlen($_SESSION['account_first_name'])>0){$account_first_name = $_SESSION['account_first_name'];}else{$account_first_name = 0;}
	if(isset($_SESSION['account_middle_name']) && strlen($_SESSION['account_middle_name'])>0){$account_middle_name = $_SESSION['account_middle_name'];}else{$account_middle_name=0;}
	if(isset($_SESSION['account_last_name']) && strlen($_SESSION['account_last_name'])>0){$account_last_name = $_SESSION['account_last_name'];}else{$account_last_name=0;}
?>
<div id="main-navbar" class="navbar navbar-inverse" role="navigation">
	<!--button here--->
	<button type="button" id="main-menu-toggle" style="background: #FFFFFF;">
		<i class="navbar-icons fa fa-cog icon" style="display:none;"></i>
		<span class='hide-text-menu'>Header Menu</span>
	</button>
	<div class="navbar-inner">
		<div class="navbar-header">
			<!--Logo-->
			<?php
				/*logo link*/
				$logo_lnk = "";
				if($_SESSION['account_type']==2)
				{
					$logo_lnk .= $domain . 'support';
				}
				else
				{
					$logo_lnk .= $domain . 'admin';
				}
			?>
			<a href="<?php echo $logo_lnk;?>" class="navbar-brand"><div></div>freebetqq101</a>
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar-collapse">
				<i class="navbar-icons fa fa-bars"></i>
			</button>
		</div>
		<!--navbar header-->
		<div id="main-navbar-collapse" class="navbar-collapse main-navbar-collapse collapse gh-border-top">
			<div class="right">
				<ul class="nav navbar-nav pull-right">
					<li><a href="<?php echo $domain?>signout.php"><i class="fa fa-power-off fa-2x icon-menu-off"></i></a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<?php
}
?>