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
        '<div class="text-center"><button class="like btn btn-default" title="Like">',
			'<i class="fa fa-refresh fa-lg"></i>',
        '</button></div>'
    ].join('');
}
window.actionEvents = {
    'click .like': function (e, value, row, index) {
		onprocess(row.entries_id,2);
    }
};

var xmlhttp_onprocess;
function onprocess(entry_id, process){
	
	if(window.XMLHttpRequest){
		xmlhttp_onprocess = new XMLHttpRequest();
	}
	else{
		xmlhttp_onprocess = new ActiveXObject("Microsoft.XMLHTTP");
	}
	messageShow('Please Wait');
	xmlhttp_onprocess.onreadystatechange = function(){
		if(xmlhttp_onprocess.readyState == 4 && xmlhttp_onprocess.status == 200){
			var jsonResponse = xmlhttp_onprocess.responseText;
			jsonResponse = eval('(' + jsonResponse + ')');
			
			if(jsonResponse.message.length>0){
				systemNotify(jsonResponse.message,jsonResponse.messageType,true);
				refreshT();
			}
			messageHide();	
		}
	}
	var url = domain + "js/ajax/page/support/rejected/rejected.php";
	xmlhttp_onprocess.open('POST',url,true);
	xmlhttp_onprocess.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp_onprocess.send("entry_id=" + entry_id + "&process=" + process);
}
