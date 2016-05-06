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
				
			</tbody>
		</table>
		<a href="page/pending/output.php">Export</a>
	</div>
</div>
<!--<script src="<?php echo $main_url;?>:3000/socket.io/socket.io.js"></script>-->
<script src="<?php echo $domain;?>js/ajax/page/support/pending/pending.js"></script>