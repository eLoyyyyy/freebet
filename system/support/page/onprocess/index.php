<style type="text/css">
#tblTxtAreaCon{
	display:none;
}
</style>
<div class="page-header">
	<div class="row">
		<h1 class="col-sm-12">
			<i class="fa fa-refresh page-header-icon"></i>&nbsp;&nbsp;&#272;ang ki&#7875;m tra
		</h1>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<table id="table"
			data-url="page/onprocess/data.php"
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
			data-editable-url="page/onprocess/update.php">
			<thead>
				<tr>
					<th data-field="entries_id" data-width="75px" data-type="numeric">NO.ID</th>
					<th data-width="190px" data-field="userid">T&#234;n t&#224;i kho&#7843;n</th>
					<th data-field="facebook" data-editable="true" data-pk="entries_id" data-editable-emptytext="Custom empty text." data-width="350px">FACEBOOK</th>
					<th data-field="name" data-width="180px">T&#234;n &#273;&#7847;y &#273;&#7911;</th>
					<th data-field="ipv4" data-width="150px">&#273;&#7883;a ch&#7881; IP</th>
					<th data-field="cs" data-width="150px">C.S.</th>
					<th data-field="date_submitted" data-width="220px">chung ky&#832;</th>
					<th data-field="commands" data-formatter="actionFormatter" data-events="actionEvents"data-width="100px">HO&#7840;T &#272;&#7896;NG</th>
				</tr>
			</thead>
			<tbody id="body">
			</tbody>
		</table>
	</div>
</div>
<script src="<?php echo $domain;?>js/ajax/page/support/onprocess/onprocess.js"></script>