<?php 
function web_url()
{
	return $_SESSION['DIR_SYS'];
}
function url($l)
{
	$l =  web_url() . "redirect.php?url=" . $l;
	return $l;
}

function get_url()
{
	$current_url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	return $current_url;
}

function change_special_chars($text)
{
	return htmlspecialchars($text);
}

function get_ip_address()
{
	if(isset($_SERVER['HTTP_CLIENT_IP']))
	{
		$http_client_ip = $_SERVER['HTTP_CLIENT_IP'];
	}
	if(isset($_SERVER['HTP_X_FORWARDED_FOR']))
	{
		$http_x_forwarded_for = $_SERVER['HTP_X_FORWARDED_FOR'];
	}
	if(isset($_SERVER['REMOTE_ADDR']))
	{
		$remote_addr = $_SERVER['REMOTE_ADDR'];
	}
	
	if(!empty($http_client_ip))
	{
		$ip_address = $http_client_ip;
	}
	else if(!empty($http_x_forwarded_for))
	{
		$ip_address = $http_x_forwarded_for;
	}
	else
	{
		$ip_address = $remote_addr;
	}
	return $ip_address;
}

function convert_file_size($size)
{
    $filesizename = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
    return $size ? round($size/pow(1024, ($i = floor(log($size, 1024)))), 2) . $filesizename[$i] : '0 Bytes';
}

function allowedtextinurlonly($str)
{
    $get_str = "";
    $new_str = "";
    $current_number = 0;
    if(strlen($str)>0)
    {
           /*
           allowed = 0123456789*-+abcdefghijklmnopqrstuvwxyz`~!@#$^&*()_=[];',.{}:0<>?            
           */
            while($current_number != strlen($str))
            {
                    $get_str = substr($str,$current_number,1);
                    $get_str_convert = strtolower(substr($str,$current_number,1));
                    if($get_str_convert == "a" || $get_str_convert == "b" || $get_str_convert == "c" || $get_str_convert == "d" || $get_str_convert == "e" || $get_str_convert == "f" || $get_str_convert == "g" || $get_str_convert == "h" || $get_str_convert == "i" || $get_str_convert == "j" || $get_str_convert == "k" || $get_str_convert == "l" || $get_str_convert == "m" || $get_str_convert == "n" || $get_str_convert == "o" || $get_str_convert == "p" || $get_str_convert == "q" || $get_str_convert == "r" || $get_str_convert == "s" || $get_str_convert == "t" || $get_str_convert == "u" || $get_str_convert == "v" || $get_str_convert == "w" || $get_str_convert == "x" || $get_str_convert == "y" || $get_str_convert == "z" || $get_str_convert == " " || $get_str_convert == "1" || $get_str_convert == "2" || $get_str_convert == "3" || $get_str_convert == "4" || $get_str_convert == "5" || $get_str_convert == "6" || $get_str_convert == "7" || $get_str_convert == "8" || $get_str_convert == "9" || $get_str_convert == "0" || $get_str_convert == "`" || $get_str_convert == "~" || $get_str_convert == "!" || $get_str_convert == "@" || $get_str_convert == "#" || $get_str_convert == "$" || $get_str_convert == "^" || $get_str_convert == "&" || $get_str_convert == "*" || $get_str_convert == "(" || $get_str_convert == "" || $get_str_convert == "_" || $get_str_convert == "=" || $get_str_convert == "[" || $get_str_convert =="]" || $get_str_convert ==";" || $get_str_convert =="'" || $get_str_convert =="," || $get_str_convert =="." || $get_str_convert =="{" || $get_str_convert =="}" || $get_str_convert ==":" || $get_str_convert =="?")
                    {
                            $new_str .= $get_str;
                    }
                    $current_number++;
            }
			return $new_str;
    }
}

function PriceTag($str)
{
	$get_str = "";
	$new_str = "";
	$current_number = 0;
	if(strlen($str)>0)
	{
		while($current_number != strlen($str))
		{
			$get_str = substr($str,$current_number,1);
			$get_str_convert = strtolower(substr($str,$current_number,1));			
			if($get_str == "0" || $get_str == "1" || $get_str == "2" || $get_str == "3" || $get_str == "4" || $get_str == "5" || $get_str == "6" || $get_str == "7" || $get_str == "8" || $get_str == "9" || $get_str == ".")
			{
				$new_str .= $get_str;
			}
			$current_number++;
		}
		return $new_str;
	}
}

function NumberOnly($str)
{
	$get_str = "";
	$new_str = "";
	$current_number = 0;
	if(strlen($str)>0)
	{
		while($current_number != strlen($str))
		{
			$get_str = substr($str,$current_number,1);
			$get_str_convert = strtolower(substr($str,$current_number,1));			
			if($get_str == "0" || $get_str == "1" || $get_str == "2" || $get_str == "3" || $get_str == "4" || $get_str == "5" || $get_str == "6" || $get_str == "7" || $get_str == "8" || $get_str == "9")
			{
				$new_str .= $get_str;
			}
			$current_number++;
		}
		return $new_str;
	}
}

function get_file_type($file)
{
	$file_tmp = strrev($file);
	$str_start = 0;
	$str_end = strlen($file);
	
	$get_start_index = "0";
	$get_end_index = "0";
	$current_text = "";
	$dot = 0;
	while($str_start <= $str_end)
	{
		$current_text = substr($file_tmp,$str_start,1);
		if($dot == 0)
		{
			if($current_text == ".")
			{
				$get_end_index = $str_start;
				$dot = 1;
			}
		}
		$str_start++;
	}
	$file_type = substr($file_tmp,$get_start_index,$get_end_index);
	$file_type = strrev($file_type);
	return $file_type;
}

// Time format is UNIX timestamp or
// PHP strtotime compatible strings
function getAge($time2, $precision = 6)
{
	$time1 = time();
	// If not numeric then convert texts to unix timestamps
	if (!is_int($time1)) {
	$time1 = strtotime($time1);
	}
	if (!is_int($time2)) {
	$time2 = strtotime($time2);
	}

	// If time1 is bigger than time2
	// Then swap time1 and time2
	if ($time1 > $time2) {
	$ttime = $time1;
	$time1 = $time2;
	$time2 = $ttime;
	}

	// Set up intervals and diffs arrays
	//$intervals = array('year','month','day','hour','minute','second');
	$intervals = array('year','month','day');
	$diffs = array();

	// Loop thru all intervals
	foreach ($intervals as $interval) {
	// Create temp time from time1 and interval
	$ttime = strtotime('+1 ' . $interval, $time1);
	// Set initial values
	$add = 1;
	$looped = 0;
	// Loop until temp time is smaller than time2
	while ($time2 >= $ttime) {
	// Create new temp time from time1 and interval
	$add++;
	$ttime = strtotime("+" . $add . " " . $interval, $time1);
	$looped++;
	}

	$time1 = strtotime("+" . $looped . " " . $interval, $time1);
	$diffs[$interval] = $looped;
	}

	$count = 0;
	$times = array();
	// Loop thru all diffs
	foreach ($diffs as $interval => $value) {
	// Break if we have needed precission
	if ($count >= $precision) {
	break;
	}
	// Add value and interval 
	// if value is bigger than 0
	if ($value > 0) {
	// Add s if value is not 1
	if ($value != 1) {
	$interval .= "s";
	}
	// Add value and interval to times array
	$times[] = $value . " " . $interval;
	$count++;
	}
	}

	// Return string with times
	return implode(", ", $times);
}

function send_mail($fromname, $emailaddress, $fromaddress, $emailsubject, $msg)
{
	/* Is the OS Windows or Mac or Linux */
	if (strtoupper(substr(PHP_OS,0,3)=='WIN'))	{		$eol="\r\n";	}	elseif (strtoupper(substr(PHP_OS,0,3)=='MAC'))	{		$eol="\r";	}	else	{		$eol="\n";	}
	$mime_boundary_1 = md5(time());
	$mime_boundary_2 = "1_".$mime_boundary_1;
	$mail_sent = false;
	$now = time();
	/* Common Headers */
	$headers = "";
	$headers .= 'From: '.$fromname.'<'.$fromaddress.'>'.$eol;
	$headers .= 'Reply-To: '.$fromname.'<'.$fromaddress.'>'.$eol;
	$headers .= 'Return-Path: '.$fromname.'<'.$fromaddress.'>'.$eol;	/* these two to set reply address */
	$headers .= "Message-ID: <".$now."webmaster@".$_SERVER['SERVER_NAME'].">".$eol;
	$headers .= "X-Mailer: PHP v".phpversion().$eol;		  /* These two to help avoid spam-filters */
	/* Boundry for marking the split & Multitype Headers */
	$headers .= 'MIME-Version: 1.0'.$eol;
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . $eol;
	$headers .= "	boundary=\"".$mime_boundary_1."\"".$eol;
	$msg = str_replace("\n","<br/>",$msg);
	/* SEND THE EMAIL */
	if (mail($emailaddress, $emailsubject, $msg, $headers)) $mail_sent = true;
	return $mail_sent;
}
function ignore_tags($text)
{
	if(strlen($text)>0)
	{
		$text = str_replace("<","&lt;",$text);
		$text = str_replace(">","&gt;",$text);
		$text = str_replace("=","&equals;",$text);
		$text = str_replace("'","&apos;",$text);
		$text = str_replace('"',"&quot;",$text);
		$text = str_replace("\\","&bsol;",$text);
	}
	return $text;
}
function unignore_tags($text)
{

	if(strlen($text)>0)
	{
		$text = str_replace("&lt;","<",$text);
		$text = str_replace("&gt;",">",$text);
		$text = str_replace("&equals;","=",$text);
		$text = str_replace("&apos;","'",$text);
		$text = str_replace("&quot;",'"',$text);
		$text = str_replace("&bsol;","\\",$text);
	}
	
	return $text;
}
function url_exists($url){
   $headers = get_headers($url);
   return stripos($headers[0],"200 OK")?true:false;
}
?>