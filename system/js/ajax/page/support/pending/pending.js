jQuery( #grid-data ).on( loaded.rs.jquery.bootgrid , function () {
		jQuery('.command-edit').on('click', function() {
			onprocess(jQuery(this).attr('data-entries-id'), 2);
		});
}).bootgrid({
	ajax: true,
	url:  page/pending/data.php ,
	navigation: 0,
	rowCount: -1,
	formatters: {
		 link : function(column, row){

			return  <a id=\ approve\  class=\   + disable_buttons(row.status) +  \  href=\ approve.php?approve=1&entries_id=  + row.entries_id +  \ >APPROVE</a>  +  &nbsp;|&nbsp;  +
				 <a href=\ #jem\  data-toggle=\ modal\  id=\ reject\  class=\   + disable_buttons(row.status) +   \  onclick=\ Show(   + row.entries_id +  )\    >REJECT</a> ; 
		},
		 commands : function(column, row){
					return  <button type=\ button\  class=\ btn btn-xs btn-default command-edit\  data-entries-id=\   + row.entries_id +  \  data-toggle=\ modal\  data-target=\ #bryan\ ><span class=\ fa fa-refresh fa-2x\ ></span></button>  ;
		},
	}
});

	var $table = jQuery('#table');
	jQuery('#toolbar').find('select').change(function () {
    $table.bootstrapTable('refreshOptions', {
      exportDataType: jQuery(this).val()
    });
  });
  
  jQuery('#table').bootstrapTable({
        showExport: true, 
		exportTypes: ['excel', 'pdf'],
		exportDataType: ['basic','all','selected'],
		exportOptions: { 
			fileName: 'testo' , 
			worksheetName:  'test1' , 
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
	
/*function onprocess(entry_id, process){
	
		//process = [0 - pending,1 - approve,2 - on-process,3 - reject]
	
	var dataArray = {
		'process': process,
		'entry_id': entry_id
	};
	
	jq.ajax({
		url:  ../js/ajax/page/support/pending/pending.php ,
		type:  POST ,
		data: dataArray
	}).done(function (response, textStatus, jqXHR){
		// show successfully for submit message
		var jsonResponse = 
		messageShow('Please Wait');
		console.log(response.message);
		//window.location.reload();
	}).fail(function (){
	   // show error
		alert('fail');
	});
	
}*/
var xmlhttp_onprocess;
function onprocess(entry_id, process){
		
		if(window.XMLHttpRequest){
			xmlhttp_onprocess = new XMLHttpRequest();
		}
		else{
			xmlhttp_onprocess = new ActiveXObject( Microsoft.XMLHTTP );
		}
		messageShow('Please Wait');
		xmlhttp_onprocess.onreadystatechange = function(){
			if(xmlhttp_onprocess.readyState == 4 && xmlhttp_onprocess.status == 200){
				var jsonResponse = xmlhttp_onprocess.responseText;
				jsonResponse = eval('(' + jsonResponse + ')');
				
				if(jsonResponse.message.length>0){
					systemNotify(jsonResponse.message,jsonResponse.messageType,true);
					jQuery( #grid-data ).bootgrid('reload');
				}
				messageHide();	
			}
		}
		var url = domain +  js/ajax/page/support/pending/pending.php ;
		xmlhttp_onprocess.open('POST',url,true);
		xmlhttp_onprocess.setRequestHeader( Content-type , application/x-www-form-urlencoded );
		xmlhttp_onprocess.send( entry_id=  + entry_id +  &process=  + process);
}