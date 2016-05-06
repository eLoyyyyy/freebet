/*var socket = io.connect( 'http://192.168.60.110:3000' );
socket.on('update_table', function( data ) {
	jQuery("#grid-data").bootgrid('reload');
});*/

jQuery("#grid-data").on("loaded.rs.jquery.bootgrid", function () {
		jQuery('.command-approve').on('click', function() {
			approve(jQuery(this).attr('data-entries-id'), 1);
			/*socket.emit('update_table', { 
				update: "TRUE"
			});*/
		});
}).bootgrid({
	ajax: true,
	url: "page/onprocess/data.php",
	navigation: 0,
	rowCount: -1,
	formatters: {
		"link": function(column, row){

			return "<a id=\"approve\" class=\"" + disable_buttons(row.status) + "\" href=\"approve.php?approve=1&entries_id=" + row.entries_id + "\">APPROVE</a>" + "&nbsp;|&nbsp;" +
				"<a href=\"#jem\" data-toggle=\"modal\" id=\"reject\" class=\"" + disable_buttons(row.status) + " \" onclick=\"Show("  + row.entries_id + ")\"   >REJECT</a>"; 
		},
		"commands": function(column, row){
					return "<button type=\"button\" class=\"btn btn-xs btn-default command-approve\" data-entries-id=\"" + row.entries_id + "\" data-toggle=\"modal\" data-target=\"#bryan\"><span class=\"fa fa-check fa-2x\"></span></button> " + 
					"<button type=\"button\" class=\"btn btn-xs btn-default command-reject\" data-entries-id=\"" + row.entries_id + "\" data-toggle=\"modal\" data-target=\"#bryan\" onclick=\"showInfo('3','1','" + row.entries_id + "')\"><span class=\"fa fa-trash fa-2x\"></span></button> ";
		},
	}
});

	
/*function approve(entry_id, process){
	
	//*	process = [0 - pending,1 - approve,2 - on-process,3 - reject]
	
	
	var dataArray = {
		'process': process,
		'entry_id': entry_id
	};
	
	jq.ajax({
		url: "../js/ajax/page/support/onprocess/onprocess.php",
		type: "POST",
		data: dataArray
	}).done(function (response, textStatus, jqXHR){
		// show successfully for submit message
		console.log(response);
		window.location.reload();
	}).fail(function (){
	   // show error
		alert('fail');
	});
	
}*/

var xmlhttp_showInfo;
var showInfo = function(popStatus,popType,popId){
		if(window.XMLHttpRequest){
			xmlhttp_showInfo = new XMLHttpRequest();
		}
		else{
			xmlhttp_showInfo = new ActiveXObject("Microsoft.XMLHTTP");
		}
		messageShow('Please Wait');
		xmlhttp_showInfo.onreadystatechange = function(){
			if(xmlhttp_showInfo.readyState == 4 && xmlhttp_showInfo.status == 200){
				var jsonResponse = xmlhttp_showInfo.responseText;
				jsonResponse = eval('(' + jsonResponse + ')');
				
				if(jsonResponse.message.length>0){
					systemNotify(jsonResponse.message,jsonResponse.messageType,true);
				}
				if(jsonResponse.content.length>0){
					if(jsonResponse.popType == 1){
						formShow(jsonResponse.content);
					}
					else if(jsonResponse.popType == 2){
						formShow2(jsonResponse.content);
					}
				}
				messageHide();	
			}
		}
		var url = domain + "js/ajax/page/support/onprocess/onprocess_pop.php";
		xmlhttp_showInfo.open('POST',url,true);
		xmlhttp_showInfo.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp_showInfo.send("popStatus=" + popStatus + "&popType=" + popType + "&popId=" + popId);
}

var xmlhttp_approve;
function approve(entry_id, process){
		
	if(window.XMLHttpRequest){
		xmlhttp_approve = new XMLHttpRequest();
	}
	else{
		xmlhttp_approve = new ActiveXObject("Microsoft.XMLHTTP");
	}
	messageShow('Please Wait');
	xmlhttp_approve.onreadystatechange = function(){
		if(xmlhttp_approve.readyState == 4 && xmlhttp_approve.status == 200){
			var jsonResponse = xmlhttp_approve.responseText;
			jsonResponse = eval('(' + jsonResponse + ')');
			
			if(jsonResponse.message.length>0){
				systemNotify(jsonResponse.message,jsonResponse.messageType,true);
				jQuery("#grid-data").bootgrid('reload');
			}
			messageHide();	
		}
	}
	var url = domain + "js/ajax/page/support/onprocess/onprocess.php";
	xmlhttp_approve.open('POST',url,true);
	xmlhttp_approve.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp_approve.send("entry_id=" + entry_id + "&process=" + process);
}

/*Show & Hide the textarea*/
var changeThis = function(){
	reject_reason = _('reject_reason').value;
	
	if(reject_reason == "others"){
		jq('#tblTxtAreaCon').show();
	}else{
		jq('#tblTxtAreaCon').hide();
	}
}
/*Submit Reject Start*/
var xmlhttp_submitReject;
var submitReject = function(process,entry_id){
	
	reject_reason = _('reject_reason').value;
	if(reject_reason == "others"){
		tblTxtArea = _('tblTxtArea').value;
	}else{
		tblTxtArea = _('tblTxtArea').value = "";
	}
	
	if(window.XMLHttpRequest){
		xmlhttp_submitReject = new XMLHttpRequest();
	}
	else{
		xmlhttp_submitReject = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	//Data Submit
	var dataSubmit = "";
	dataSubmit += "entry_id=" + entry_id;
	dataSubmit += "&process=" + process;
	dataSubmit += "&reject_reason=" + reject_reason;
	dataSubmit += "&tblTxtArea=" + tblTxtArea;
	
	messageShow('Please Wait');
	xmlhttp_submitReject.onreadystatechange = function(){
		if(xmlhttp_submitReject.readyState == 4 && xmlhttp_submitReject.status == 200){
			var jsonResponse = xmlhttp_submitReject.responseText;
			jsonResponse = eval('(' + jsonResponse + ')');
			
			if(jsonResponse.message.length>0){
				systemNotify(jsonResponse.message,jsonResponse.messageType,true);
				jQuery("#grid-data").bootgrid('reload');
			}
			messageHide();
			formHide2();
			formHide();
		}
	}
	var url = domain + 'js/ajax/page/support/onprocess/rejected.php';
	xmlhttp_submitReject.open('POST',url,true);
	xmlhttp_submitReject.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp_submitReject.send(dataSubmit);
}