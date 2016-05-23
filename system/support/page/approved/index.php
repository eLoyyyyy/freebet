<div class="page-header">
	<div class="row">
		<h1 class="col-sm-12">
			<i class="fa fa-check page-header-icon"></i>&nbsp;&nbsp;&#272;&#7891;ng &#253;
		</h1>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<table id="table" data-toggle="table"
			data-url="page/approved/data.php"
			data-page-list=[10]
			data-page-size="10"
			data-sticky-header="true"
			data-height="750"
			data-search="true"
			data-pagination="true"
			data-toolbar="#toolbar"
			data-id-field="entries_id">
			<thead>
				<tr>
					<th data-field="entries_id" data-width="75px" >NO.ID</th>
					<th data-width="190px" data-field="userid">T&#234;n T&#224;i Kho&#7843;n</th>
					<th data-field="facebook">FACEBOOK</th>
					<th data-field="name" data-width="375px">T&#234;n &#273;&#7847;y &#273;&#7911;</th>
					<th data-field="ipv4" data-width="150px">&#273;&#7883;a ch&#7881; IP</th>
					<th data-field="cs" data-width="150px">C.S.</th>
					<th data-field="date_submitted" data-width="250px">chung ky&#832;</th>
					<th data-field="commands" data-formatter="actionFormatter" data-events="actionEvents">HO&#7840;T &#272;&#7896;NG</th>
				</tr>
			</thead>
			<tbody id="body">
				
			</tbody>
		</table>
	</div>
</div>
<script src="<?php echo $domain;?>js/ajax/page/support/approved/approved.js"></script>