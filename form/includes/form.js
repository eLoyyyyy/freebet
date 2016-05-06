/*
 *	Jem, Ikaw na bahala dito. 
 *		- Jared
 */


jq(document).ready(function() {/*
    jq('#claim-form').on('success.form.fv', function(e) {
            // Prevent form submission
            e.preventDefault();

            jq(this).find("button[type='submit']").attr("disabled", true);
            jq.ajax({
			type: "POST",
			data: jq(this).serialize(),
			dataType: 'json',
		}).done(function (response, textStatus, jqXHR){
			// show successfully for submit message
			var json_pattr = /\{.*\}/g;
			var json_str = json_pattr.exec(response)[0];
			console.log(json_str);
			
			//window.location.reload();
		}).fail(function (){
		   // show error
			alert('fail');
		});
        }); */
        
        jq("#claim_form").click(function(e) {
		e.preventDefault(); // avoid to execute the actual submit of the form.
	
		/*jq.ajax({
			type: "POST",
	   		data: jq("#claim-form").serialize(), // serializes the forms elements.
		}).done(function (response, textStatus, jqXHR){
			// show successfully for submit message
			var json_pattr = /\{.*\}/g;
			var json_str = json_pattr.exec(response);
			if (json_str !== null) {
				var data = JSON.parse(json_str[0]);
				systemNotify(String(data.message), String(data.messageType), true);
				if (data.messageType == '3') {
					//window.location.assign('http://www.freebetqq101.com/form/?success=true');
					systemNo
				} else {
					return false;
				}
				if(data.process_status == 1){
					if(data.message.length>0){
						systemNotify(String(data.message), String(data.messageType), true);
					}
				}
				
			}
			//window.location.reload();
			
		}).fail(function (){
		   // show error
			alert('fail');
		});*/
		
		var xmlhttp_submit;
		
		userid = _('userid').value;
		username = _('username').value;
		facebook_url = _('facebook_url').value;
		
		if(window.XMLHttpRequest)
		{
			xmlhttp_submit = new XMLHttpRequest();
		}
		else
		{
			xmlhttp_submit = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp_submit.onreadystatechange = function(){
			if(xmlhttp_submit.readyState == 4 && xmlhttp_submit.status == 200){
				var jsonResponse = xmlhttp_submit.responseText;
				jsonResponse = eval("(" + jsonResponse + ")");
				console.log(jsonResponse);
				
				if(jsonResponse.message.length>0){
					systemNotify(jsonResponse.message, jsonResponse.messageType, true);
				}
				if(jsonResponse.process_status == '1'){
					window.location.assign(jsonResponse.redirect);
				}
				
			}
		}
		var url = main_url = '/form/includes/form_process.php';
		xmlhttp_submit.open('POST',url,true);
		xmlhttp_submit.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp_submit.send('userid=' + userid + '&username=' + username + '&facebook_url=' + facebook_url);
	});
});
	
	function onprocess(entry_id, process){
		/*
		*	process = [0 - pending,1 - approve,2 - on-process,3 - reject]
		*
		*/
		var dataArray = {
			'process': process,
			'entry_id': entry_id
		};
		
		jq.ajax({
			url: "../js/ajax/page/support/pending/pending.php",
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
		
	}
	