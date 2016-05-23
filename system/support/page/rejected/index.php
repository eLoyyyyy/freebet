<div class="page-header">
	<div class="row">
		<h1 class="col-sm-12">
			<i class="fa fa-trash page-header-icon"></i>&nbsp;&nbsp;T&#7915; ch&#7889;i
		</h1>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<table id="table" data-toggle="table"
				data-url="page/rejected/data.php"
				data-page-list=[10]
				data-page-size="10"
				data-sticky-header="true"
				data-height="750"
				data-search="true"
				data-pagination="true"
				data-toolbar="#toolbar"
				data-click-to-select="true"
				data-id-field="entries_id"
				data-editable-emptytext="Default empty text."
				data-editable-url="page/rejected/update.php">
			<thead>
				<tr>
				<th data-field="state" data-checkbox="true"></th>
				<th data-field="entries_id">NO.ID</th>
				<th data-field="userid">T&#234;n t&#224;i kho&#7843;n</th>
				<th data-field="facebook" data-width="180px">FACEBOOK</th>
				<th data-field="name">T&#234;n &#273;&#7847;y &#273;&#7911;</th>
				<th data-field="ipv4" data-width="150px">&#273;&#7883;a ch&#7881; IP</th>
				<th data-field="cs" data-width="150px">C.S.</th>
				<th data-field="date_submitted" data-width="251px">chung ky&#832;</th>
				<th data-field="message" >&#273;i&#234;&#832;u chu&#833; y</th>
				<th data-field="commands" data-formatter="actionFormatter" data-events="actionEvents">ho&#7841;t &#273;&#7897;ng</th>
				</tr>
			</thead>
			<tbody id="body">
				
			</tbody>
		</table>
	</div>
</div>
<script src="<?php echo $domain;?>js/ajax/page/support/rejected/rejected.js"></script>