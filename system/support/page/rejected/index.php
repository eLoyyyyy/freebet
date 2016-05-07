<div class="page-header">
	<div class="row">
		<h1 class="col-sm-12">
			<i class="fa fa-trash page-header-icon"></i>&nbsp;&nbsp;Rejected
		</h1>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<table id="grid-data" class="table table-condensed table-hover table-striped">
			<thead>
				<tr>
					<th data-column-id="entries_id" data-width="75px" data-type="numeric">NO.ID</th>
					<th data-width="190px" data-column-id="userid">USER ID</th>
					<th data-column-id="facebook">FACEBOOK</th>
					<th data-column-id="name">Name</th>
					<th data-column-id="ipv4" data-width="150px">IP Address</th>
					<th data-column-id="cs" data-width="150px">C.S.</th>
					<th data-column-id="date_submitted" data-width="251px">DATE</th>
					<th data-column-id="message" >REMARK</th>
					<th data-column-id="commands" data-formatter="commands" data-sortable="false" data-width="100px">Action</th>
					
				</tr>
			</thead>
			<tbody id="body">
				
			</tbody>
		</table>
		<div class="pull-right"><a href="page/rejected/output.php" class="btn btn-default"><i class="fa fa-download"> Export</i></a></div>
	</div>
</div>
<script src="<?php echo $domain;?>js/ajax/page/support/rejected/rejected.js"></script>