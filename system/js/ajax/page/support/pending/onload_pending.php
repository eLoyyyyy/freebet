<?php
session_start();
include '../../../../../includes/connection.php';
include '../../../../../includes/functions.php';
include '../../../../../includes/glb_variable.php';

$request_content = '';
if(isset($_POST['request_input']) && strlen($_POST['request_input'])>0){$request_input = $_POST['request_input'];}else{$request_input = "";}


	$request_content .= 'test'; 


$request_content = str_replace("'","&#39;",$request_content);

echo '{';
echo "'request_content' : '" . $request_content . "'";
echo '}';
?>