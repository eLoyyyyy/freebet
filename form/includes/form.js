jq(document).ready(function(){
	jq('.form-reg').each(function(){

		jq(this).bind("change blur",function(){
			data_compare = jq(this).data("compare") || "";
			data_field = jq(this).data("field") || "";
			data_element = jq(this).data("element") || "";
			data_format = jq(this).data("format") || "";
			data_minLength = jq(this).data("minLength") || "";
			data_maxLength = jq(this).data("maxLength") || "";
			data_required_class_name = jq(this).data("required_class_name") || "";
			data_required = jq(this).data("required") || "";
			/* Fetch Value Start */
			value = "";
			if(data_element=="textbox")
			{
				value = jq(this).val();
			}
			/* Fetch Value End */
			errorCount = 0;
			/* Required Feature Start */
			if(data_required==true)
			{
				if(value.trim().length>0)
				{
					jq(this).removeClass(data_required_class_name);
				}
				else
				{
					jq(this).addClass(data_required_class_name);
					errorCount = 1;
				}
			}
			/* Required Feature End */
			
			if(errorCount == 0)
			{
				if(data_format == "email")
				{
					mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
					if(value.match(mailformat))
					{
						jq(this).removeClass(data_required_class_name);
					}
					else
					{
						jq(this).addClass(data_required_class_name);
						errorCount = 1;
					}
				}
				if(data_compare.length>0)
				{
					compare_data_element = jq("#" + data_compare).data("element");
					compare_value = "";
					if(compare_data_element=="textbox")
					{
						compare_value = jq("#" + data_compare).val();
					}
					if(compare_value == value)
					{
						jq(this).removeClass(data_required_class_name);
						jq("#" + data_compare).removeClass(data_required_class_name);
					}
					else
					{
						jq(this).addClass(data_required_class_name);
						jq("#" + data_compare).addClass(data_required_class_name);
						errorCount = 1;
					}
				}
				if(data_field == "userid"){
					var args = /^[A-Za-z0-9 ]*[A-Za-z0-9][A-Za-z0-9 ]*$/;
					userid = jq("#" + data_field).val();
					if(userid.trim().length>0){
						if(userid.match(args)){
							jq(this).removeClass(data_required_class_name);
							jq("#" + data_compare).removeClass(data_required_class_name);
						}else{
							jq(this).addClass(data_required_class_name);
							jq("#" + data_compare).addClass(data_required_class_name);
							errorCount = 1;
						}
					}
				}
				if(data_field == "username"){
					var args = /^[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]*$/;
					username = jq("#" + data_field).val();
					if(username.trim().length>0){
						if(username.match(args)){
							jq(this).removeClass(data_required_class_name);
							jq("#" + data_compare).removeClass(data_required_class_name);
						}else{
							jq(this).addClass(data_required_class_name);
							jq("#" + data_compare).addClass(data_required_class_name);
							errorCount = 1;
						}
					}
				}
				if(data_field == "facebook_url"){
					var args = /(?:(?:http|https):\/\/)?(?:www.)?facebook.com\/(?:(?:\w)*#!\/)?(?:pages\/)?(?:[?\w\-]*\/)?(?:profile.php\?id=(?=\d.*))?([\w\-]*)?/;
					facebook_url = jq("#" + data_field).val();
					if(facebook_url.trim().length>0){
						if(facebook_url.match(args)){
							jq(this).removeClass(data_required_class_name);
							jq("#" + data_compare).removeClass(data_required_class_name);
						}else{
							jq(this).addClass(data_required_class_name);
							jq("#" + data_compare).addClass(data_required_class_name);
							errorCount = 1;
						}
					}
				}
				
			}
		});
	});
	
	jq('#registration').click(function(){
		jq('.form-reg').each(function(){
			jq(this).change();
		});
		errorCount = jq('.form-reg.field_required').length;
		
		if(errorCount == 0)
		{
			var xmlhttp_submitReg;
			
			userid = _('userid').value;
			username = _('username').value;
			facebook_url = _('facebook_url').value;
			
			if(window.XMLHttpRequest)
			{
				xmlhttp_submitReg = new XMLHttpRequest();
			}
			else
			{
				xmlhttp_submitReg = new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			xmlhttp_submitReg.onreadystatechange = function()
			{
				if(xmlhttp_submitReg.readyState == 4 && xmlhttp_submitReg.status == 200)
				{
					var jsonResponse = xmlhttp_submitReg.responseText;
					jsonResponse = eval('(' + jsonResponse + ')');
					
					/*setTimeout(function(){
						jq('#registration').button('reset');
					},1000);*/
					
					if(jsonResponse.process_status == 1)
					{
						if(jsonResponse.redirect.length>0)
						{
							window.location.assign(jsonResponse.redirect);
						}
					}
					if(jsonResponse.message.length>0)
					{
						systemNotify(jsonResponse.message,jsonResponse.messageType,true);
					}
				}
			}
			var url = main_url + '/form/includes/form_process.php';
			xmlhttp_submitReg.open('POST',url);
			xmlhttp_submitReg.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp_submitReg.send('userid=' + userid + '&username=' + username + '&facebook_url=' + facebook_url);
		}
		else
		{
			systemNotify('There is an error on the form','2',true);
		}
	});
	
});