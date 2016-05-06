<?php
session_start();
include('includes/glb_variable.php');
include('includes/connection.php');
include('includes/functions.php');

/*Session Destroy*/
session_destroy();

header("location:" . $main_url . "/signin");
?>