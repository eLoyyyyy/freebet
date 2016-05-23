<?php
session_start();
include '../../../../../includes/connection.php';
include '../../../../../includes/functions.php';
include '../../../../../includes/glb_variable.php';

$message = '';
$messageType = '';
$content = '';

if(isset($_POST['popStatus']) && strlen($_POST['popStatus'])>0){$popStatus = $_POST['popStatus'];}else{$popStatus = "";}
if(isset($_POST['popType']) && strlen($_POST['popType'])>0){$popType = $_POST['popType'];}else{$popType = "";}
if(isset($_POST['popId']) && strlen($_POST['popId'])>0){$popId = $_POST['popId'];}else{$popId = "";}


if($popType == 1){
	$content.= "<div style=\"width:450px;margin:12em auto; max-width:100%;\">";
		$content.= "<div class=\"popContanier panel panel-danger\">";
			$content.= "<div class=\"panel-heading\">";
				$content.= "<h3>Reject Confirmation</h3>";
				$content.= "<span class=\"fa fa-xmark\"></span>";
			$content.= "</div>";
			$content.= "<div class=\"panel-body\">";	
				$content.= "<div class=\"col-md-6\">";
					$content.= "<button class=\"btn btn-default btn-lg\" style=\"width:100%;\" onclick=\"showInfo('" . $popStatus . "','2','" . $popId . "')\">Continue</button>";
				$content.= "</div>";	
				$content.= "<div class=\"col-md-6\">";
					$content.= "<button class=\"btn btn-danger btn-lg\" style=\"width:100%;\"  onclick=\"formHide();\">Cancel</button>";
				$content.= "</div>";
			$content.= "</div>";
		$content.= "</div>";
	$content.= "</div>";
	$message = "1";
	$messageType = 3;
}
else if($popType == 2){
	$content.= "<div style=\"width:550px;margin:12em auto; max-width:100%;\">";
		$content.= "<div class=\"popContanier panel panel-danger\">";
			$content.= "<div class=\"panel-heading\">";
				$content.= "<h4 style=\"display:inline-block;\">Reason</h4>";
				$content.= "<span class=\"pull-right side-icon fa fa-times\" onclick=\"formHide2()\" style=\"cursor:pointer;\"></span>";
			$content.= "</div>";
			$content.= "<div class=\"panel-body\" style=\"padding: 20px 20px 15px;\">";
				$content.= "<div>";
					$content.= "<select class=\"form-control\" id=\"reject_reason\" onchange=\"changeThis()\" style=\"font-size:16px;height: 37px;\">";
						$content.= "<option value=\"\">Please Select</option>";
						$content.= "<option value=\"Salah share gambar\">Salah share gambar</option>";
						$content.= "<option value=\"Salah share teks promo\">Salah share teks promo</option>";
						$content.= "<option value=\"Tidak share ke public\">Tidak share ke public</option>";
						$content.= "<option value=\"Tag tidak sampai 50\">Tag tidak sampai 50</option>";
						$content.= "<option value=\"Jumlah teman tidak mencukupi\">Jumlah teman tidak mencukupi</option>";
						$content.= "<option value=\"Link facebook tidak valid\">Link facebook tidak valid</option>";
						$content.= "<option value=\"Facebook dalam keadaan Private/Lock\">Facebook dalam keadaan Private/Lock</option>";
						$content.= "<option value=\"Jumlah teman tidak di tampilkan ke public\">Jumlah teman tidak di tampilkan ke public</option>";
						$content.= "<option value=\"others\">Others</option>";
					$content.= "</select>";
					$content.= "<div id=\"tblTxtAreaCon\">";
						$content .= "<textarea id=\"tblTxtArea\" style=\"width:582px;height:155px;margin:10px 0 0;resize:none;padding:10px;border-radius: 2px;border-color: #c2c2c2;\"></textarea>";
					$content.= "</div>";
				$content.= "</div>";
				$content.= "<hr class=\"panel-wide\"/>";
				$content.= "<div class=\"pull-right\">";
					$content.= "<button class=\"btn btn-success\" style=\"margin-right:10px;\" onclick=\"submitReject('" . $popStatus . "','" . $popId . "')\">Save</button>";
					$content.= "<button class=\"btn btn-danger\" onclick=\"formHide2()\">Cancel</button>";
				$content.= "</div>";
			$content.= "</div>";
		$content.= "</div>";
	$content.= "</div>";
	$message = "2";
	$messageType = 3;
}
else{
	$message = "Hello";
	$messageType = 2;
}



$message = str_replace("'","&#39;",$message);
$content = str_replace("'","&#39;",$content);
$messageType = str_replace("'","&#39;",$messageType);
$popType = str_replace("'","&#39;",$popType);

echo '{';
echo "'message' : '" . $message . "',";
echo "'content' : '" . $content . "',";
echo "'messageType' : '" . $messageType . "',";
echo "'popType' : '" . $popType . "'";
echo '}';
?>