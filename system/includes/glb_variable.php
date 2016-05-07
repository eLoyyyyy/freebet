<?php
/****Variables for *****
*System Connection to url
*Minified Files
*/
$system_test = 0;
$minified_js = 0;
$minified_css = 0;
$header_status = 0;
$web_type = 1;
$removeForAwhile = 1;
$removeStyle = '';

if($system_test == 1){
	$main_url = "http://www.sandbox.freebetqq101.com";/*Test Mode*/
}else{
	$main_url = "http://" . $_SERVER['HTTP_HOST']; /* Live */
}
if($removeForAwhile == 1)
{
	$removeStyle = 'display:none';
}
$domain = $main_url . '/system/';

$glb_variable_version = 1;
$apply_iframe_version = "&v=" . $glb_variable_version;
$apply_css_version = "?v=" . $glb_variable_version;
$apply_js_version = "?v=" . $glb_variable_version;

date_default_timezone_set('GMT');
$timestamp = time();


if (getenv('HTTP_CLIENT_IP'))
{
	$ip_address = getenv('HTTP_CLIENT_IP');
}
else if(getenv('HTTP_X_FORWARDED_FOR'))
{
	$ip_address = getenv('HTTP_X_FORWARDED_FOR');
}
else if(getenv('HTTP_X_FORWARDED'))
{
	$ip_address = getenv('HTTP_X_FORWARDED');
}
else if(getenv('HTTP_FORWARDED_FOR'))
{
	$ip_address = getenv('HTTP_FORWARDED_FOR');
}
else if(getenv('HTTP_FORWARDED'))
{
	$ip_address = getenv('HTTP_FORWARDED');
}
else if(getenv('REMOTE_ADDR'))
{
	$ip_address = getenv('REMOTE_ADDR');
}
else
{
	$ip_address = 'UNKNOWN';
}	

$computer_name = gethostbyaddr($ip_address);
$mysql_real_escape_status = 1;

/*Time Stamp Convertor*/
function timeStampConvertor($elem,$type){
	$h = "7";
	$hm = $h * 60;
	$ms = $hm * 60;
	
	if($type == 1){
		return gmdate('M d Y h:i A',$elem+($ms));
	}
	else if($type == 2){
		return gmdate('M d Y',$elem+($ms));
	}
}

function bangkokConverter($timestampUnique){
	return date('M d Y h:i:s A', strtotime($timestampUnique)+54000); //25200 (+8h)
}
?>