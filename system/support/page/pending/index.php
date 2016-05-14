<div class="page-header">
	<div class="row">
		<h1 class="col-sm-12">
			<i class="fa fa-flag-o page-header-icon"></i>&nbsp;&nbsp;Pending
		</h1>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<!--<div id="toolbar">
		  <select class="form-control">
			<option value="">Export Basic</option>
			<option value="all">Export All</option>
			<option value="selected">Export Selected</option>
		  </select>
		</div> -->
		<table id="table" 
				data-toggle="table"
				data-url="page/pending/data.php"
				data-height="750"
				data-search="true"
				data-pagination="true"
				data-click-to-select="true">
			<thead>
				<tr>
					<th data-field="state" data-checkbox="true"></th>
					<th data-field="entries_id" >NO.ID</th>
					<th data-field="userid">USER ID</th>
					<th data-field="facebook">FACEBOOK</th>
					<th data-field="name">Name</th>
					<th data-field="ipv4">IP Address</th>
					<th data-field="date_submitted">DATE</th>
					<th data-field="commands">Action</th>
				</tr>
			</thead>
			<tbody id="body">
				
			</tbody>
		</table>
	</div>
</div>
<!--<script src="<?php echo $main_url;?>:3000/socket.io/socket.io.js"></script>-->
<script src="<?php echo $domain;?>js/ajax/page/support/pending/pending.js"></script>