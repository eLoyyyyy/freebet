jq(document).ready(function(){
	/*Login Validation Start*/
	jq('.form-signin').each(function(){

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
			}
		});
	});
	/*Login Validation End*/
	/*Login btn */
	jq('#signinBtn').click(function(){
		jq('.form-signin').each(function(){
			jq(this).change();
		});
		errorCount = jq('.form-signin.field_required').length;
		
		if(errorCount == 0)
		{
			var xmlhttp_submitLogin;
			
			freebet_email = _('freebet_email').value;
			password_id = _('password_id').value;
			
			jq('#signinBtn').button('loading');
			
			if(window.XMLHttpRequest)
			{
				xmlhttp_submitLogin = new XMLHttpRequest();
			}
			else
			{
				xmlhttp_submitLogin = new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			xmlhttp_submitLogin.onreadystatechange = function()
			{
				if(xmlhttp_submitLogin.readyState == 4 && xmlhttp_submitLogin.status == 200)
				{
					var jsonResponse = xmlhttp_submitLogin.responseText;
					jsonResponse = eval('(' + jsonResponse + ')');
					
					setTimeout(function(){
						jq('#signinBtn').button('reset');
					},1000);
					
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
			var url = domain + '/js/ajax/page/login/login.php';
			xmlhttp_submitLogin.open('POST',url);
			xmlhttp_submitLogin.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp_submitLogin.send('freebet_email=' + freebet_email + '&password_id=' + password_id);
		}
		else
		{
			systemNotify('There is an error on the form','2',true);
		}
	});
});