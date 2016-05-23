/*jQuery("#grid-data").on("loaded.rs.jquery.bootgrid", function () {
		jQuery('.command-approve').on('click', function() {
			approve(jQuery(this).attr('data-entries-id'), 1);
		});
}).bootgrid({
	ajax: true,
	url: "page/onprocess/data.php",
	navigation: 0,
	rowCount: -1,
	labels: {
		noResults: "Kh&#244;ng c&#243; k&#7871;t qu&#7843; n&#224;o!"
	},
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
});*/
var jqtable = jq('#table');
	jq('#toolbar').find('select').change(function () {
});
var refreshT = function(){jqtable.bootstrapTable('refresh');}
jq('#table').bootstrapTable({
	showExport: true, 
	exportDataType: "all",
	exportTypes: ['excel', 'pdf'],
	exportOptions: { 
		fileName: 'data' , 
		worksheetName:  'export' , 
		ignoreColumn: [0, 9] ,
		jspdf : {     
			format: 'a4',
			autotable : {
				styles : {  rowHeight : 20,  fontSize : 8 },
				tableWidth: 'wrap',
				headerStyles : {  fillColor : 255,  textColor : 0 },
				alternateRowStyles : {  fillColor : [60, 69, 79],  textColor : 255 }
			}
		}
	}
});
	
jq('#button').click(function () {
	jq('#table').bootstrapTable('refresh');
});

jq('#toolbar').find('select').change(function () {
	jq('#table').bootstrapTable({
		exportDataType: jq(this).val()
	});
});

function actionFormatter(value, row, index) {
    return [
        '<div class="text-center"><button class="check btn btn-default" title="check">',
			'<i class="fa fa-check fa-lg"></i>',
        '</button>',
		'<button class="trash btn btn-default" title="trash" style="margin-left:5px;">',
			'<i class="fa fa-trash fa-lg"></i>',
        '</button></div>'
    ].join('');
}
window.actionEvents = {
    'click .check': function (e, value, row, index) {
		approve(row.entries_id,1);
    },
    'click .trash': function (e, value, row, index) {
		showInfo(3,1,row.entries_id);
    }
};




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
function approve(entry_id,process){
		
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
				refreshT();
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

var encode = function(uniString) 
{
	if (encodeURIComponent) {
	    uniString= encodeURIComponent(uniString);
	} else {
	    uniString= escape(uniString);
	}
	return uniString;
}
function unicode2htmldec(b) {
	var c= '';
	for(i=0; i<b.length; i++){
	 if(b.charCodeAt(i)>127){ c += '&#' + b.charCodeAt(i) + ';'; }else{ c += b.charAt(i); }
	}
	return  c;
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
	tblTxtArea =  unicode2htmldec(tblTxtArea);
	reject_reason =  unicode2htmldec(reject_reason);
	
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
	dataSubmit += "&reject_reason=" + encode(reject_reason);
	dataSubmit += "&tblTxtArea=" + encode(tblTxtArea);
	
	xmlhttp_submitReject.onreadystatechange = function(){
		if(xmlhttp_submitReject.readyState == 4 && xmlhttp_submitReject.status == 200){
			var jsonResponse = xmlhttp_submitReject.responseText;
			jsonResponse = eval('(' + jsonResponse + ')');
			if(jsonResponse.message.length>0){
				systemNotify(jsonResponse.message,jsonResponse.messageType,true);
				refreshT();
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