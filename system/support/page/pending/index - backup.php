<?php
$message = '';
$messageType = '';
$data_1 = '';
$entries_id = '';
$table_index = 1;
?>

<div class="page-header">
	<div class="row">
		<h1 class="col-sm-12">
			<i class="fa fa-flag-o page-header-icon"></i>&nbsp;&nbsp;Pending
		</h1>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<table id="grid-data" class="table table-condensed table-hover table-striped">
			<thead>
				<tr>
					<th data-column-id="entries_id" data-width="75px">NO.ID</th>
					<th data-width="190px" data-column-id="userid">USER ID</th>
					<th data-column-id="facebook">FACEBOOK</th>
					<th data-column-id="name">Name</th>
					<th data-column-id="ipv4">IP Address</th>
					<th data-column-id="date_submitted">DATE</th>
					<th data-column-id="status">STATUS</th>
					<th data-column-id="commands" data-formatter="commands" data-sortable="false">Action</th>
				</tr>
			</thead>
			<tbody id="body">
				<?php 
				$sql_1 = "
					SELECT
					fb_form_data.entries_id as entries_id,
					fb_form_data.user_id as user_id,
					fb_form_data.user_name as user_name,
					fb_form_data.facebook_url as facebook_url,
					fb_form_data.website_type as website_type,
					INET_NTOA(fb_form_data.ip_address) as ip_address,
					fb_form_data.message as message,
					fb_form_data.app_status as app_status,
					fb_form_data.account_id as account_id,
					fb_form_data.timestamp as timestamp
					FROM
					fb_form_data
					WHERE
					fb_form_data.app_status = '0'
				";
				if($query_1 = sys_mysql_query($conn,$sql_1)){
					$total_account = sys_mysql_num_rows($query_1);
					if($total_account>0){
						while($data_1 = sys_mysql_fetch_assoc($query_1)){
							echo "<tr>";
								echo "<td>" . $data_1['entries_id'] . "</td>";
								echo "<td>" . $data_1['user_id'] . "</td>";
								echo "<td>" . $data_1['facebook_url'] . "</td>";
								echo "<td>" . $data_1['user_name'] . "</td>";
								echo "<td>" . $data_1['ip_address'] . "</td>";
								echo "<td>" . $data_1['timestamp'] . "</td>";
								echo "<td>" . $data_1['app_status'] . "</td>";
								echo "<td></td>";
							echo "</tr>";
						}
					}else{
						echo sys_mysql_error($conn);
					}
				}else{
					echo sys_mysql_error($conn);
				}
				 ?>
			</tbody>
		</table>
	</div>
</div>
<script src="<?php echo $domain;?>js/ajax/page/support/pending/pending.js"></script>