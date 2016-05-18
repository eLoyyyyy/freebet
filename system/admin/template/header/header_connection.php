<?php
if(isset($_SESSION['account_type']) && strlen($_SESSION['account_type'])>0){
	$account_type = $_SESSION['account_type'];
}else{
	$account_type = 0;
}
if($header_status == 1){
?>
<!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<!--Bootgrid-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-bootgrid/1.3.1/jquery.bootgrid.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-bootgrid/1.3.1/jquery.bootgrid.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-bootgrid/1.3.1/jquery.bootgrid.fa.min.js"></script>

<?php
}else{
?>
	<link rel="stylesheet" href="<?php echo $domain . "js/library/bootstrap/bootstrap-3.3.6/css/bootstrap.min.css";?>">
	<link rel="stylesheet" href="<?php echo $domain;?>css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo $domain;?>css/jquery.bootgrid.min.css">
	<link rel="stylesheet" href="<?php echo $domain . "js/library/bootstrap-table/dist/bootstrap-table.css";?>">
	<script src="<?php echo $domain . "js/library/jquery/jquery.min.js";?>"></script>
	<script src="<?php echo $domain . "js/library/bootstrap/bootstrap-3.3.6/js/bootstrap.js";?>"></script>
	<script src="<?php echo $domain . "js/library/bootgrid/jquery.bootgrid-1.3.1/jquery.bootgrid.min.js";?>"></script>
	<script src="<?php echo $domain . "js/library/bootgrid/jquery.bootgrid-1.3.1/jquery.bootgrid.fa.min.js";?>"></script>
	<script src="<?php echo $domain . "js/library/bootstrap-table/dist/bootstrap-table.js";?>"></script>
	<script src="<?php echo $domain . "js/library/bootstrap-table/dist/extensions/export/bootstrap-table-export.js";?>"></script>
	<script src="<?php echo $domain . "js/library/bootstrap-table/dist/extensions/editable/bootstrap-table-editable.js";?>"></script>
	<script src="<?php echo $domain . "js/library/tableExport.jquery.plugin/tableExport.js";?>"></script>
	<script src="<?php echo $domain . "js/library/tableExport.jquery.plugin/libs/jsPDF/jspdf.min.js";?>"></script>
	<script src="<?php echo $domain . "js/library/tableExport.jquery.plugin/libs/FileSaver/FileSaver.min.js";?>"></script>
	<script src="<?php echo $domain . "js/library/tableExport.jquery.plugin/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js";?>"></script>
	<link rel="stylesheet" href="<?php echo $domain;?>css/template.css">
	<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
	<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<?php	
}
if($account_type > 0)
{
	echo '<script type="text/javascript" src="' . $domain . 'js/library/jQuery-slimScroll-1.3.7/jquery.slimscroll.min.js"></script>';
	echo '<link rel="stylesheet" href="' . $domain . 'css/main_style.css">';
	echo '<link rel="stylesheet" href="' . $domain . 'css/widget.css">';
}
else
{
	echo '<link rel="stylesheet" href="' . $domain . 'css/pixels.css">';
}
?>
<link rel="stylesheet" href="<?php echo $domain;?>css/bootstrap-datepicker.min.css">
<script src="<?php echo $domain;?>js/ajax/general.js"></script>
	