function validateChk(frmName, action){
	
	
	var frm_length=document.forms[frmName].elements.length;
	var chk_length=0;
	var chk_total=0;
	for(i=0;i<frm_length;i++)
	{
		if(document.forms[frmName].elements[i].type=="checkbox")
		{
			if(document.forms[frmName].elements[i].checked  && document.forms[frmName].elements[i].name!="chkbox_n" ){
				chk_length++;
			}else{
				chk_total++;
			}
		}
	}
	if(chk_length==0){
		if(chk_total==1){
			alert("There is nothing to delete.");
		}else{
			alert("Please select at least one checkbox", "Alert");
		}		
		return false;
	}else{
			if(action == "delete"){ 
				
				if (confirm("Are you sure you want to delete this record?")) {
					jQuery('#pageAction').val('delete');
					document.forms[frmName].submit();            	  
					return true;
				}
				return false;
			} 
			if(action == "activate"){ 
			
					if (confirm("Are you sure you want to activate selected record(s)?")) {
						jQuery('#pageAction').val('activate');
						document.forms[frmName].submit();            	  
						return true;
					}
					return false;
			}
			if(action == "send_email"){ 
			
					if (confirm("Are you sure you want to send email selected record(s)?")) {
						jQuery('#pageAction').val('send_email');
						document.forms[frmName].submit();            	  
						return true;
					}
					return false;
			}
			if(action == "deactivate"){ 
				if (confirm("Are you sure you want to deactivate selected record(s)?")) {
						jQuery('#pageAction').val('deactivate');	            	 
						document.forms[frmName].submit();            	  
						return true;
				}
				return false;
			} 
		}
		return true;
}

function validateChkTab(frmName, action)
{

	var frm_length=document.forms[frmName].elements.length;
	var chk_length=0;
	var chk_total=0;
	var newids = new Array();
	for(i=0;i<frm_length;i++)
	{
		if(document.forms[frmName].elements[i].type=="checkbox")
		{
			if(document.forms[frmName].elements[i].checked  && document.forms[frmName].elements[i].name!="chkbox_n" ){
				newids.push(document.forms[frmName].elements[i].value);
				chk_length++;
				
			}else{
				chk_total++;
			}
		}
	}
	if(chk_length==0){
		if(chk_total==1){
			alert("There is nothing to delete.");
		}else{
			alert("Please select at least one checkbox", "Alert");
		}		
		return false;
	}else{
			if(action == "delete"){ 
				if (confirm("Are you sure you want to delete this record?")) {
					jQuery('#pageAction').val('delete');
					home_stor_ajax(action,newids);
					return false;
				}
				return false;
			} 
			if(action == "activate"){ 
			
					if (confirm("Are you sure you want to activate selected record(s)?")) {
						jQuery('#pageAction').val('activate');
						home_stor_ajax(action,newids);
						return false;
					}
					return false;
			}
			if(action == "deactivate"){ 
				if (confirm("Are you sure you want to deactivate selected record(s)?")) {
						jQuery('#pageAction').val('deactivate');	
						home_stor_ajax(action,newids);						
						return false;
				}
				return false;
			} 
		}
		return true;
	
	

}
function home_stor_ajax(action,newids){
		var tab_id = $('#BusinessDescriptionTabId').val();
		var urlToSend = SiteUrl+'/admin/home_stores/process/';
		var dataToSend =  {'newids':newids,'action':action}
	if(action == 'delete'){
		urlToSend = SiteUrl+'/admin/home_stores/index/';	
		var dataToSend =  {'newids':newids,'action':action,'tab_id':tab_id}
	}
	 $.ajax({
		type: "POST",
		url: urlToSend,
		cache: false,
		async : false,
		data: dataToSend,
		type: "POST",
		success: function(data){ 
			data = eval('(' + data + ')');
			if(data.statusResponse == 'success'){
				if(action == 'deactivate'){
					$(newids).each(function(key, value){
						$('#status_'+value).text('Inactive');
					});
					$("input[type='checkbox']", ".table-mailbox").iCheck("uncheck");
				}
				else if(action == 'activate'){
					$(newids).each(function(key, value){
						$('#status_'+value).text('Active');
					});
					$("input[type='checkbox']", ".table-mailbox").iCheck("uncheck");
				}
				else if(action == 'delete'){
					$('.seasonalStores').html(data.response);
				}
				
			}
		},
		error: function(){ 
			alert ('Please try again.');
		}
	});
}




jQuery(document).ready(function(){
	
	jQuery('.deleteItem').bind('click',function(){
		var target_url = jQuery(this).attr("href");
		var name = jQuery(this).children().attr("title");	
		var formName = jQuery('#pageAction').attr("name").split('[');
		formName = formName[1].replace(']', '');		
		if (confirm("Are you sure you want to delete selected record(s)?")) {
			document.forms[formName].action = target_url;
			document.forms[formName].method = 'post';
			document.forms[formName].submit();                       	  
			return true;
		}
		return false;
	});
	jQuery('.flash_good').animate({opacity: 1.0}, 4000).fadeOut();
})






