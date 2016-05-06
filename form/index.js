/*
 *	Jem, Ikaw na bahala dito. 
 *		- Jared
 */


jq(document).ready(function() {
    jq('#claim-form')
        .formValidation({
            
        })
        .on('success.form.fv', function(e) {
            // Prevent form submission
            e.preventDefault();

            var $form = $(e.target);
            $form.ajaxSubmit({
                // You can change the url option to desired target
                url: $form.attr('action'),
                dataType: 'json',
                success: function(responseText, statusText, xhr, $form) {
                    // Process the response returned by the server ...
                    // console.log(responseText);
                }
            });
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
	