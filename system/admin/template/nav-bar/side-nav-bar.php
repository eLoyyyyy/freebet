<?php
$linkSiteName = '';
$account_id = $_SESSION['account_id'];
$account_type = $_SESSION['account_type'];
if(isset($account_id))
{
	if($account_type == 1)
	{
		$linkSiteName .= 'admin/';
	}
	else if($account_type == 2)
	{
		$linkSiteName .= 'support/';
	}
	else
	{
		$linkSiteName .= '404';
	}
?>
<div id="main-menu" role="navigation">
	<div style="position:relative;overflow:hidden;width:auto;height:100%;">
		<div id="main-menu-inner" style="overflow:hidden;width:auto;height:100%;">
			<ul class="navigation">
				<?php
				if($account_type == 1) /* Admin */{
					// Dashboard
					$selected = "";
					$page_url = 'dashboard';
					$page_url_label = 'Dashboard';
					if($page == $page_url){$selected = ' class="active"';}
					echo '<li' . $selected . '><a href="' . $domain . $linkSiteName . '?page=' . $page_url . '"><i class="menu-icon fa fa-wrench"></i><span class="mm-text mmc-dropdown-delay">' . $page_url_label . '</span></a></li>';
					
				}
				else if($account_type == 2) /* Client */{
					
					/*// Dashboard
					$selected = "";
					$page_url = 'dashboard';
					$page_url_label = 'Dashboard';
					if($page == $page_url){$selected = ' class="active"';}
					echo '<li' . $selected . '><a href="' . $domain . $linkSiteName . '?page=' . $page_url . '"><i class="menu-icon fa fa-dashboard"></i><span class="mm-text mmc-dropdown-delay">' . $page_url_label . '</span></a></li>';*/
				
					// Pending
					$selected = "";
					$page_url = 'pending';
					$page_url_label = 'Pending';
					if($page == $page_url){$selected = ' class="active"';}
					echo '<li' . $selected . '><a href="' . $domain . $linkSiteName . '?page=' . $page_url . '"><i class="menu-icon fa fa-flag-o"></i><span class="mm-text mmc-dropdown-delay">' . $page_url_label . '</span></a></li>';
					
					// On Process
					$selected = "";
					$page_url = 'onprocess';
					$page_url_label = 'On-Process';
					if($page == $page_url){$selected = ' class="active"';}
					echo '<li' . $selected . '><a href="' . $domain . $linkSiteName . '?page=' . $page_url . '"><i class="menu-icon fa fa-refresh"></i><span class="mm-text mmc-dropdown-delay">' . $page_url_label . '</span></a></li>';
					
					// Approved
					$selected = "";
					$page_url = 'approved';
					$page_url_label = 'Approved';
					if($page == $page_url){$selected = ' class="active"';}
					echo '<li' . $selected . '><a href="' . $domain . $linkSiteName . '?page=' . $page_url . '"><i class="menu-icon fa fa-check"></i><span class="mm-text mmc-dropdown-delay">' . $page_url_label . '</span></a></li>';
					
					// Rejected
					$selected = "";
					$page_url = 'rejected';
					$page_url_label = 'Rejected';
					if($page == $page_url){$selected = ' class="active"';}
					echo '<li' . $selected . '><a href="' . $domain . $linkSiteName . '?page=' . $page_url . '"><i class="menu-icon fa fa-trash"></i><span class="mm-text mmc-dropdown-delay">' . $page_url_label . '</span></a></li>';
				}	
				?>
				
				<li class="mm-dropdown mm-dropdown-root" style="<?php echo $removeStyle;?>">
					<a href="#">
						<i class="menu-icon fa fa-dashboard"></i><span class="mm-text mmc-dropdown-delay">test</span>
					</a>
					<ul class="mmc-dropdown-delay animated fadeIn">
						<div class="mmc-title">Layouts</div>
						<li><a href="#">test</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</div>
<?php
}
?>