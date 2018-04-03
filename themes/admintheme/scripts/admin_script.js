/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    $(document).ready(function() {
            $('#selecctall').on('click', function(event) {  //on click 
                    if(this.checked) { // check select 
                            $('.selectbox').each(function() { //loop through each checkbox
                                    this.checked = true;  //select all checkboxes with class "checkbox1"               
                            });
                    }else{
                            $('.selectbox').each(function() { //loop through each checkbox
                                    this.checked = false; //deselect all checkboxes with class "checkbox1"                       
                            });         
                    }
            });
            $('#selecctall_pop').on('click', function(event) {  //on click 
                    if(this.checked) { // check select 
                            $('.selectbox_pop').each(function() { //loop through each checkbox
                                    this.checked = true;  //select all checkboxes with class "checkbox1"               
                            });
                    }else{
                            $('.selectbox_pop').each(function() { //loop through each checkbox
                                    this.checked = false; //deselect all checkboxes with class "checkbox1"                       
                            });         
                    }
            });

		// write a code which will display all subcategories aftr clicking on category check box.
		// if there is no any subcategory under that category nothjing will be displayed..
		$(".category_list").click(function()
		{
			var cat_id = "";
			cat_id = $(this).val();
			if($(this).is(":checked")){
//				alert(cat_id);				
				$("#"+cat_id+"").show();
			}else
				$("#"+cat_id+"").hide();			
		});
        

    });

////////// function to block single user/////////
	function activate(action_url, id)
	{
		var a = confirm("Are you sure you want change status");
		//alert(a);
		if(a == true){
			document.fromCheckAction.check_ids.value = id;			
			document.fromCheckAction.status.value = '1';			
			document.fromCheckAction.action = ADMINURL+action_url;			
			document.fromCheckAction.submit();
		}
	}
	////////// function to unblock single user/////////
	function deactivate(action_url, id)
	{
		var a = confirm("Are you sure you want change status");
		//alert(a);
		if(a == true){
			document.fromCheckAction.check_ids.value = id;			
			document.fromCheckAction.status.value = '0';			
			document.fromCheckAction.action = ADMINURL+action_url;			
			document.fromCheckAction.submit();
		}
	}
        ////////// function to deactivate user on the basis of type../////////
	function deactivate_user_type(action_url, user_id, user_type_id)
	{
		var a = confirm("Are you sure you want change status");
		//alert(a);
		if(a == true){
			document.fromCheckAction.user_id.value = user_id;
                        document.fromCheckAction.user_type_id.value = user_type_id;
			document.fromCheckAction.status.value = '0';			
			document.fromCheckAction.action = ADMINURL+action_url;			
			document.fromCheckAction.submit();
		}
	}
	////////// function to block multiple user/////////
	function activate_multiple(action_url)
	{
		//alert("hii");
		var checkBoxes = $('input[name="ids[]"]:checked'); /////////checking is at least one user selected or not//////
		//alert(atLeastOneIsChecked);
		if(checkBoxes.length == 0){
			alert("Select atleast one record");
			return;
		}
		var a = confirm("Are you sure you want change status");
		//alert(a);
		if(a == true){ 
                    var val = '';
                    
                    checkBoxes.each(function(i){
                    var is_last_item = (i == (checkBoxes.length - 1));
                      if($(this).val()!='Yes')
                              val = val+jQuery(this).val();
                      if(is_last_item == false)
                        val = val+'^';
                    });
                    
                    document.fromCheckAction.check_ids.value = val;			
                    document.fromCheckAction.status.value = '1';			
                    document.fromCheckAction.action = ADMINURL+action_url;			
                    document.fromCheckAction.submit();
		}
	}
	////////// function to unblock multiple user/////////
	function deactivate_multiple(action_url)
	{
		var checkBoxes = $('input[name="ids[]"]:checked'); /////////checking is at least one user selected or not//////
		//alert(atLeastOneIsChecked);
		if(checkBoxes.length == 0){
			alert("Select atleast one record");
			return;
		}
		var a = confirm("Are you sure you want change status");
		//alert(a);
		if(a == true){ 
                    var val = '';
                    
                    checkBoxes.each(function(i){
                    var is_last_item = (i == (checkBoxes.length - 1));
                      if($(this).val()!='Yes')
                              val = val+jQuery(this).val();
                      if(is_last_item == false)
                        val = val+'^';
                    });
                    document.fromCheckAction.check_ids.value = val;			
                    document.fromCheckAction.status.value = '0';			
                    document.fromCheckAction.action = ADMINURL+action_url;			
                    document.fromCheckAction.submit();
		}
	}
	//////////function to delete multiple user record///////////
	function delete_multiple(action_url)
	{
            var checkBoxes = $('input[name="ids[]"]:checked'); /////////checking is at least one user selected or not//////
		//alert(atLeastOneIsChecked);
		if(checkBoxes.length == 0){
			alert("Select atleast one record");
			return;
		}
		var a = confirm("Are you sure you want to delete");
		//alert(a);
		if(a == true){ 
			var val = '';
			checkBoxes.each(function(i){
				var is_last_item = (i == (checkBoxes.length - 1));
				// now we need to write a ajax code which will check whether the selected service have any subservices attached or not..
				// if any services have sub services then it won't be deleted and check box will be unchecked..
				
				/*var service_id = $(this).val();
				alert("sid = "+service_id);
				$.ajax({
					url:ADMINURL+'/service/check_service_subservice',
					type:'POST',
					data:{service_id:service_id, _fm_token:csrf_value},
					success: function(data){
						alert(data);
						if (data == "1"){
							if($(this).val()!='Yes')
								val = val+jQuery(this).val();
							if(is_last_item == false)
								val = val+'^';

							
								
						} else {
							alert("We acan't delete a service with id "+service_id+" as its have some sub services under that");
							return false;
						}
					}
				}); */
				
				if($(this).val()!='Yes')
					val = val+jQuery(this).val();
				if(is_last_item == false)
					val = val+'^';
			});
			
				document.fromCheckAction.check_ids.value = val;		
				document.fromCheckAction.action = ADMINURL+action_url;			
				document.fromCheckAction.submit();
			
		}
	}
/**
 * 
 * @param {string} action_url
 * @param {int} id
 * @returns {Boolean}
 */
	function delete_service(action_url, id, pid)
	{
		if(confirm("Are you sure you want to delete it?"))
			window.location.href=ADMINURL + '/' + action_url + '/' +id+ '/' +pid;
		else
			return false;
	}

	function delete_single(action_url, id)
	{
		if(confirm("Are you sure you want to delete it?"))
			window.location.href=ADMINURL + '/' + action_url + '/' +id;
		else
			return false;
	}
	function active_verified(action_url, id)
	{
		if(confirm("Are you sure you want to Verified this User"))
			window.location.href=ADMINURL + '/' + action_url + '/' +id;
		else
			return false;
	}
	function delete_image(action_url, id)
	{
		if(confirm("Are you sure you want to delete it?"))
			window.location.href=ADMINURL + '/' + action_url + '/' +id;
		else
			return false;
	}

/**
 *      function to search for user
 * @returns {Boolean} 
 */
	function admin_search()
	{
		if(document.frmSearch.search_keyword.value == ''){
			alert('Please enter keyword');
			return false;
		}		
		document.frmSearch.submit();
	}
/**
 * 
 * @param {string} action_url
 * @returns {undefined}
 */
	function show_all(action_url)
	{
		window.location.href=ADMINURL + action_url;
	}
/**
 * 
 * @param {string} frmName is the name of form
 * @returns {undefined}
 */
    function save(frmName)
	{
        console.log(frmName);
		document.forms[frmName].action_type.value = 'save';
		document.forms[frmName].submit.click();
	}
/**
 * 
 * @param {string} frmName is the name of form
 * @returns {undefined}
 */
	function save_close(frmName)
	{
		console.log(frmName);
		document.forms[frmName].action_type.value = 'save_new';
		document.forms[frmName].submit.click();
	}
/**
 * Page Rendering effect
 */        
       /* $(document).ready(function(){
           $('body').fadeIn('slow'); 
        });*/

////////// function to check is one checkbox checked only/////////
	function is_selected(action_url)
	{
		//alert("hii");
		var checkBoxes = $('input[name="ids[]"]:checked'); /////////checking is at least one user selected or not//////
		//alert(atLeastOneIsChecked);
		if(checkBoxes.length == 0){
			alert("Select one record only");
			return false;
		}
                else if(checkBoxes.length > 1){
			alert("Select one record only");
			return false;
		}
		window.location.href=action_url+'/'+checkBoxes.val();
	}
        
	function is_select_checkbox(title){
		//alert("hii");
		var checkBoxes = $('input[name="ids[]"]:checked'); /////////checking is at least one user selected or not//////
		//alert(checkBoxes.length);
		//alert(title);
		//alert($('#common_search input[name="search_text"]').val());
		if(checkBoxes.length == 0 && $('#common_search input[name="search_text"]').val()==""){
			alert("Please select record");
			return false;
		} else {
			var val = '';
			if(checkBoxes.length>0){
				checkBoxes.each(function(i){
				var is_last_item = (i == (checkBoxes.length - 1));
				  if($(this).val()!='Yes')
						  val = val+jQuery(this).val();
				  if(is_last_item == false)
					val = val+'^';
				});
				document.add_to_list.check_ids.value = val;
				return true;
			} else if($('#common_search input[name="search_text"]').val()!=""){
				var qname = $('#common_search input[name="search_text"]').val();
				if(confirm("Are you sure to add "+title+" '"+qname+"'"))
				{
					document.add_to_list.check_ids.value = val;
					return true;
				}
				else
				{
					return false;
				}
			}
		}
	}

	/*write a java script fun which will be just a replica of above fun..
	the purpose of this fun is to call another pop up modules to add dimension under category section..*/
	
	function is_select_checkbox_cat_dimension(title){
		//alert("hii");
		
		var checkBoxes = $('input[name="ids[]"]:checked'); /////////checking is at least one user selected or not//////
		//alert(checkBoxes.length);
		//alert(title);
		//alert($('#common_search input[name="search_text"]').val());
		if(checkBoxes.length == 0 && $('#common_search input[name="search_text"]').val()==""){
			alert("Please select record");
			return false;
		} else {
			var val = '';
			if(checkBoxes.length>0){
				checkBoxes.each(function(i){
				var is_last_item = (i == (checkBoxes.length - 1));
				  if($(this).val()!='Yes')
						  val = val+jQuery(this).val();
				  if(is_last_item == false)
					val = val+'^';
				});
				document.add_to_list.check_ids.value = val;
				return true;
			} else if($('#common_search input[name="search_text"]').val()!=""){
				//$(".close").trigger("click"); // close the previous open pop up and open a new pop up..
				//alert("we r calling diff view from diff modules..");
				//$("#new_dimension").modal('show', {backdrop: 'static'});
				//$('#new_dimension').click(function () { $('#new_dimension').dialog('open'); return false; });
				
				
			}
		}
	}

        function getServices(service_id){
			if(service_id != "") {
				alert("chk box chkd...");
				$(document).ready(function(){
				   $.ajax({
						url:ADMINURL+'/subservice/ajax_service',
						type:'POST',
						data:{service_id:service_id, _fm_token:csrf_value},
						success: function(data){
							$('#service_list').html(data);
								
						}
					}); 
				});
			}else {$("#service_list").hide();}
        }

        $(document).ready(function() {
            var iCnt = parseInt($('#iCnt').val());
            
            $('#btAdd').on('click',function() {
                if (iCnt <= 10) {
                    iCnt = iCnt + 1;
                    // ADD TEXTBOX.
                    $('#container').append('<div class="pull-left" id="divtb' + iCnt +'" style="width:100%;margin-bottom:10px;"><input type=text name="answer[]" class="textfield2" style="width: 250px;" id=tb' + iCnt + ' ' +
                                'placeholder="Enter possible answer for question" value="" /></div>');

                }
                else {      // AFTER REACHING THE SPECIFIED LIMIT, DISABLE THE "ADD" BUTTON. (20 IS THE LIMIT WE HAVE SET)
                    $(container).append('<label>Reached the limit</label>'); 
                    //$('#btAdd').attr('class', 'bt-disable'); 
                    $('#btAdd').attr('disabled', 'disabled');
                }
            });
            $('#btRemove').click(function() {   // REMOVE ELEMENTS ONE PER CLICK.
                if (iCnt != 1) { $('#tb' + iCnt).remove(); 
                    $('#divtb' + iCnt).remove(); 
                    $('#container label').remove();
                    iCnt = iCnt - 1; 
                }
                if (iCnt == 1) { 
                    $('#btAdd').removeAttr('disabled'); 
                    //$('#btAdd').attr('class', 'bt') 
                }
            });
        
        $('#is_free').on('click', function(event) {
        if(this.checked) {
		//$('#amount').prop('readonly', true);
		$('#price_amt').hide();
		//$('#amount').value =0;
		} else {
		//$('#amount').prop('readonly', false);
		$('#price_amt').show();
		}
        });    
    });
	function hideAmount()
	{
		//$("#amount").hide();
		//$("#amount").toggle('show');
		
	}
// 	function select_type(type)
// {
// 	if(type=='datetime'){
// 		//alert('You Select Long text box');
// 		//$("#quest_date").css("display", "block");
// 		$('#quest_date').hide();
// 		$('#quest_time').hide();
// 		$('#quest_datetime').toggle('show');
// 	}
// 	if(type=='longtext'){
// 		$('#quest_datetime').hide();
// 		$('#quest_date').hide();
// 		$('#quest_time').hide();
// 		var textbox = $("#question");
// 		var textarea = $("<textarea id='textarea' name='question'></textarea>");

// 		if ($("#question").length === 1) {
//         //Copy value to textarea
//         textarea.val(textbox.val());
//         //Replace textbox with textarea
//         textbox = textbox.replaceWith(textarea);
//     } else {
//         //Copy value to textbox
//         textbox.val(textarea.val());
//         //Replace textarea with textbox
//         textarea = textarea.replaceWith(textbox);
//     }
// 	}
// 	if(type=='dateonly'){
// 		//alert('You Select Long text box');
// 		//$("#quest_date").css("display", "block");
// 		$('#quest_datetime').hide();
// 		$('#quest_date').toggle('show');
// 		$('#quest_time').hide();
// 	}
// 	if(type=='timeonly'){
// 		//alert('You Select Long text box');
// 		//$("#quest_date").css("display", "block");
// 		$('#quest_datetime').hide();
// 		$('#quest_date').hide();
// 		$('#quest_time').toggle('show');
// 	}
// }


