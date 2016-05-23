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
						$content.= "<option value=\"Chia s&#7867; Sai &#7842;nh\">Chia s&#7867; Sai &#7842;nh</option>";
						$content.= "<option value=\"Chia S&#7867; Sai N&#7897;i Dung Khuy&#7871;n M&#227;i\">Chia S&#7867; Sai N&#7897;i Dung Khuy&#7871;n M&#227;i</option>";
						$content.= "<option value=\"Ch&#432;a Chia S&#7867; &#7842;nh C&#244;ng Khai\">Ch&#432;a Chia S&#7867; &#7842;nh C&#244;ng Khai</option>";
						$content.= "<option value=\"Ch&#432;a Tag &#272;&#7911; 50 Ng&#432;&#7901;i\">Ch&#432;a Tag &#272;&#7911; 50 Ng&#432;&#7901;i</option>";
						$content.= "<option value=\"Số Lượng Bạn Bè Chưa Đủ\">Số Lượng Bạn Bè Chưa Đủ</option>";
						$content.= "<option value=\"Sai Link Facebook C&#225; Nh&#226;n\">Sai Link Facebook C&#225; Nh&#226;n</option>";
						$content.= "<option value=\"T&#224;i Kho&#7843;n Facebook &#7902; tr&#7841;ng Th&#225;i Ri&#234;ng T&#432; ho&#7863;c b&#7883; Kh&#243;a\">T&#224;i Kho&#7843;n Facebook &#7902; tr&#7841;ng Th&#225;i Ri&#234;ng T&#432; ho&#7863;c b&#7883; Kh&#243;a</option>";
						$content.= "<option value=\"Number of Friends didnt show to the Public = Kh&#244;ng Hi&#7875;n Th&#7883; C&#244;ng Khai S&#7889; L&#432;&#7907;ng B&#7841;n B&#232;\">Number of Friends didnt show to the Public = Kh&#244;ng Hi&#7875;n Th&#7883; C&#244;ng Khai S&#7889; L&#432;&#7907;ng B&#7841;n B&#232;</option>";
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
}
else{
	$message = "Error load this modal";
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