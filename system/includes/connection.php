<?php
error_reporting(E_ALL ^ E_DEPRECATED);

$system_test_connection = 1;

/*Database Start Connection*/
if($system_test_connection == 1){
	/*Test Mode*/
	$db_host = "localhost";
	$db_name = "freebetqq101";
	$db_user = "root";
	$db_pass = "";
}
else{
	/*Live Mode*/
	$db_host = "localhost";
	$db_name = "freetqq1_wp598";
	$db_user = "freetqq1_wp598";
	$db_pass = "Rb8)]6Pn4S";
}
/*Database End Connection*/

$conn = mysqli_connect($db_host,$db_user,$db_pass,$db_name) or die(mysqli_connect_error());
//$conn = mysql_connect($db_host, $db_user, $db_pass,$db_name) or die("Connecting to MySQL failed");

/*mysqli_set_charset($conn,"utf8");*/

function sys_mysql_fetch_fields($data){return mysqli_fetch_field($data);}
//function sys_mysql_fetch_fields($data){return mysql_num_fields($data);}

function sys_mysql_fetch_assoc($data){return mysqli_fetch_assoc($data);}
//function sys_mysql_fetch_assoc($data){return mysql_fetch_assoc($data,MYSQL_ASSOC);}

function sys_mysql_fetch_array($data){return mysqli_fetch_array($data,MYSQL_ASSOC);}
//function sys_mysql_fetch_array($data){return mysql_fetch_array($data);}

function sys_mysql_query($conn,$data){return mysqli_query($conn,$data);}
//function sys_mysql_query($data){return mysql_query($data);}

function sys_mysql_real_escape_string($conn,$data){return mysqli_real_escape_string($conn,$data);}
//function sys_mysql_real_escape_string($data){return mysql_real_escape_string($data);}

function sys_mysql_insert_id($conn){return mysqli_insert_id($conn);}
//function sys_mysql_insert_id($conn){return mysql_insert_id();}

function sys_mysql_error($conn){return mysqli_error($conn);}
//function sql_error(){return mysql_error();}

function sys_mysql_num_rows($data){return mysqli_num_rows($data);}
//function sys_mysql_num_rows($data){return mysql_num_rows($data);}

function sys_mysql_affected_rows($conn){return mysqli_affected_rows($conn);}
//function sys_mysql_affected_rows($conn){return mysql_affected_rows();}