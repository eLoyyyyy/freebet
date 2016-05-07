<?php

include '../../../includes/glb_variable.php';
include '../../../includes/connection.php';
include '../../../includes/functions.php';

$data_1 = '';
$row = [];
$total_account = 0;
$tempRow = [];
$current = $_POST['current'];
$rowCount = $_POST['rowCount'];
$offset = (($current * $rowCount) - $rowCount) == 0 ? 1 : ($current * $rowCount) - $rowCount;
$searchPhrase = "";
if (isset($_POST['searchPhrase']) && strlen($_POST['searchPhrase'])>0){
	$search = $_POST['searchPhrase'];
	$searchPhrase = "AND CONCAT_WS(',',entries_id,user_id,user_name,facebook_url,ip_address,reason_type,app_status,account_id,timestamp) LIKE \'%{$search}%\'";
}

/*
$sql_1 = "
		SELECT
		fb_form_data.entries_id as entries_id,
		fb_form_data.user_id as user_id,
		fb_form_data.user_name as user_name,
		fb_form_data.facebook_url as facebook_url,
		INET_NTOA(fb_form_data.ip_address) as ip_address,
		fb_form_data.reason_type as reason_type,
		fb_form_data.app_status as app_status,
		fb_form_data.account_id as account_id,
		fb_form_data.timestamp as timestamp,
		CONCAT_WS(',',entries_id,user_id,user_name,facebook_url,ip_address,reason_type,app_status,account_id,timestamp) AS searchphrase
		FROM
		fb_form_data
		WHERE
		fb_form_data.app_status = '3'
	";*/
$sql_1 = "
		SELECT
		fb_fd.entries_id as entries_id,
		fb_fd.user_id as user_id,
		fb_fd.user_name as user_name,
		fb_fd.facebook_url as facebook_url,
		INET_NTOA(fb_fd.ip_address) as ip_address,
		fb_fd.reason_type as reason_type,
		fb_fd.app_status as app_status,
		(SELECT fb_tbl.first_name FROM freebet_tbl_accounts as fb_tbl WHERE fb_tbl.id = fb_fd.account_id) as account_cs,
		fb_fd.timestamp as timestamp
		FROM
		fb_form_data as fb_fd
		WHERE
		fb_fd.app_status = '3'
	";
if($query_1 = sys_mysql_query($conn,$sql_1)){
	$query_count = sys_mysql_query($conn,"SELECT COUNT(*) as total_count FROM fb_form_data WHERE fb_form_data.app_status = 3");
	$data_2 = sys_mysql_fetch_assoc($query_count);
	$total_account = $data_2['total_count'];
	if($total_account>0){
		while($data_1 = sys_mysql_fetch_assoc($query_1)){
			/*echo "<tr>";
				echo "<td>" . $data_1['entries_id'] . "</td>";
				echo "<td>" . $data_1['user_id'] . "</td>";
				echo "<td>" . $data_1['facebook_url'] . "</td>";
				echo "<td>" . $data_1['user_name'] . "</td>";
				echo "<td>" . $data_1['ip_address'] . "</td>";
				echo "<td>" . $data_1['timestamp'] . "</td>";
				echo "<td>" . $data_1['app_status'] . "</td>";
				echo "<td></td>";
			echo "</tr>"; */
			$timestamp = $data_1['timestamp'];
			$tempRow = array( "entries_id" => $data_1['entries_id'],
							  "userid" => $data_1['user_id'],
							  "facebook" => $data_1['facebook_url'],
							  "name" => $data_1['user_name'],
							  "ipv4" => $data_1['ip_address'],
							  "cs" => $data_1['account_cs'],
							  "date_submitted" => bangkokConverter($timestamp),
							  "message" => $data_1['reason_type']);
			$row[] = $tempRow;
		}
	}else{
		echo sys_mysql_error($conn);
	}
}else{
	echo sys_mysql_error($conn);
}

echo json_encode(array( "current" => $current,
						"rowCount" => $rowCount,
						"rows" => $row,
						"total" => $total_account));