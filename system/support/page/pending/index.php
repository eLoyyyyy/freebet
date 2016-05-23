<div class="page-header">
	<div class="row">
		<h1 class="col-sm-12">
			<i class="fa fa-flag-o page-header-icon"></i>&nbsp;&nbsp;Ch&#7901; x&#7917; l&#253;
		</h1>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<table id="table" data-toggle="table"
				data-url="page/pending/data.php"
				data-page-list=[10]
				data-page-size="10"
				data-sticky-header="true"
				data-height="750"
				data-search="true"
				data-pagination="true"
				data-toolbar="#toolbar"
				data-click-to-select="true"
				data-id-field="entries_id">
			<thead>
				<tr>
				<th data-width="35px" data-field="state" data-checkbox="true"></th>
				<th data-width="40px" data-field="entries_id">NO.ID</th>
				<th data-width="190px" data-field="userid">T&#234;n t&#224;i kho&#7843;n</th>
				<th data-field="facebook" data-width="180px">FACEBOOK</th>
				<th data-width="350px" data-field="name">T&#234;n &#273;&#7847;y &#273;&#7911;</th>
				<th data-width="150px" data-field="ipv4" data-width="150px">&#273;&#7883;a ch&#7881; IP</th>
				<th data-width="240px" data-field="date_submitted" data-width="251px">chung ky&#832;</th>
				<th data-width="100px" data-field="commands" data-formatter="actionFormatter" data-events="actionEvents">ho&#7841;t &#273;&#7897;ng</th>
				</tr>
			</thead>
			<tbody id="body">
				
			</tbody>
		</table> 
	</div>
</div>
<script src="<?php echo $domain;?>js/ajax/page/support/pending/pending.js"></script>