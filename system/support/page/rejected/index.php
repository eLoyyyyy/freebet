<div class="page-header">
	<div class="row">
		<h1 class="col-sm-12">
			<i class="fa fa-trash page-header-icon"></i>&nbsp;&nbsp;Rejected
		</h1>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div id="toolbar">
            <select class="form-control">
                <option value="">Export Basic</option>
                <option value="all">Export All</option>
                <option value="selected">Export Selected</option>
            </select>
        </div>
		<table id="table" data-toggle="table"
				data-url="page/rejected/data.php"
				data-height="750"
				data-search="true"
				data-pagination="true"
				data-toolbar="#toolbar"
				data-click-to-select="true"
				data-id-field="entries_id"
				data-editable-emptytext="Default empty text."
				data-editable-url="/my/editable/update/path">
			<thead>
				<tr>
				<th data-field="state" data-checkbox="true"></th>
				<th data-field="entries_id">NO.ID</th>
				<th data-field="userid">USER ID</th>
				<th data-field="facebook" data-editable="true" data-pk="entries_id" data-editable-emptytext="Custom empty text.">FACEBOOK</th>
				<th data-field="name">Name</th>
				<th data-field="ipv4" data-width="150px">IP Address</th>
				<th data-field="cs" data-width="150px">C.S.</th>
				<th data-field="date_submitted" data-width="251px">DATE</th>
				<th data-field="message" >REMARK</th>
				<th data-field="commands">Action</th>
				</tr>
			</thead>
			<tbody id="body">
				
			</tbody>
		</table>
		<div class="pull-right"><a href="page/rejected/output.php" class="btn btn-default"><i class="fa fa-download"> Export</i></a></div>
	</div>
</div>
<script src="<?php echo $domain;?>js/ajax/page/support/rejected/rejected.js"></script>