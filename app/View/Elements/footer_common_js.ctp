<script type="text/javascript">
function checkPostCode () {
	var postCodeStr	=	$("#RestaurantPostcode").val();
	
	if ($.trim(postCodeStr) == '') {
		alert('Please enter your postcode.');
		return false;
	} else {
		return true;
	}
}

function submit_sign_up () {
	
	var errorFlag	=	0;	
	var postData 	=	$("#UserSignupForm").serialize();
	var action		=	$("#UserSignupForm").attr('action');
	
	$("#errorMsg").hide();
	$("#errorMsg").html("");
	$("#reloaded").show();
	var options 	= 	{
		url:action, 
		type:'POST', 
		data:postData,
		//dataType :'json',
		success:    function(response) { 
			var json = $.parseJSON(response);
			if(json.status=='true'){
				$.fancybox.close();
				//window.location.reload(true);
				window.location.href = "<?php echo SITE_URL;?>/users/login";
			} else {
				$("#errorMsg").show();
				$("#reloaded").hide();
				var text	=	'';
				var errorArray	=	json.error
				
				for (var key in errorArray) {
					text += errorArray[key][0]+'<br/>';
				}
				$("#errorMsg").html(text);
				return false;
			}
		}
	};	
	$("#UserSignupForm").ajaxSubmit(options);	
	return false;		
}
	
function submit_sign_in () {
	var errorFlag	=	0;
	var postData 	=	$("#UserSigninForm").serialize();
	var action		=	$("#UserSigninForm").attr('action');
	
	$("#reloaded").show();
	$("#errorMsg").hide();
	$("#errorMsg").html("");
		
	var options 	= 	{ 
		url:action, 
		type:'POST', 
		data:postData,
		//dataType :'json',
		success:    function(response) { 
			var json = $.parseJSON(response);
			if ( json.status == true) {
				$.fancybox.close();
				window.location.reload(true);
				window.location.href = "<?php echo SITE_URL;?>/feeds/explore";
			} else {
				$("#reloaded").hide();
				$("#errorMsg").show();				
				$("#errorMsg").html(json.error);
				return false;
			}
		}
	};
	$("#UserSigninForm").ajaxSubmit(options); 
	return false;
}

function upload_feed () {
	var errorFlag	=	0;
	$('.slugerrMsg').text('');
	if($("#FeedSlug").val()==''){
		$('.slugerrMsg').text('Please fill slug name.');
	}
	var postData 	=	$("#UploadFeedForm").serialize();
	var action		=	$("#UploadFeedForm").attr('action');
	
	$("#reloaded").show();
	
	$("#errorMsg").html("");
	$("#flash_good").html("");
		
	var options 	= 	{
		url:action, 
		type:'POST', 
		data:postData,
		dataType :'json',
		success:    function(response) { 			
			if ( response.status == true) {
				//console.log(response)
				//$("#successMsg").html(response.message);
				//$.fancybox.close();				
				window.location.href = "<?php echo SITE_URL;?>/feeds/explore";
			} else {
				
				
				var text	=	'';
				var errorArray	=	response.error
				
				for (var key in errorArray) {
					
					text += errorArray[key][0]+'<br/>';
				}
				$("#errorMsg").html(text);
				$("#errorMsg").show();
				return false;
			}
		}
	};
	$("#UploadFeedForm").ajaxSubmit(options); 
	return false;
}

function submit_edit_profile () {
	var errorFlag	=	0;
	var postData 	=	$("#UserEditProfileForm").serialize();
	var action		=	$("#UserEditProfileForm").attr('action');
	
	$("#reloaded").show();
	$("#errorMsg").hide();
	$("#errorMsg").html("");
		
	var options 	= 	{ 
		url:action, 
		type:'POST', 
		data:postData,
		//dataType :'json',
		success:    function(response) { 	
			var json = $.parseJSON(response);
			//console.log(json.error.profile_url);
			if(json.status==true){
			
			//if ( response.status == true) {
				$("#reloaded").hide();
				$.fancybox.close();
				window.location.reload(true);
				//window.location.href = SITE_URL+"/feeds/explore";
			} else {
				$("#reloaded").hide();
				$("#errorMsg").show();		
				var text	=	'';
				var errorArray	=	json.error				
				for (var key in errorArray) {
					text += errorArray[key][0]+'<br/>';
				}
				$("#errorMsg").html(text);
				return false;
			}		
		}
	};
	$("#UserEditProfileForm").ajaxSubmit(options); 
	return false;
}

function submit_forgot_password () {
	var errorFlag	=	0;
	var postData 	=	$("#UserForgotForm").serialize();
	var action		=	$("#UserForgotForm").attr('action');
	
	$("#errorMsg").hide();
	$("#errorMsg").html("");
	$("#forgotReloaded").show();
		
	var options 	= 	{ 
		url:action, 
		type:'POST', 
		data:postData,
		dataType :'json',
		success:    function(response) { 
			if ( response.status == true) {
				$.fancybox.close();
				window.location.reload(true);
			} else {
				$("#forgotReloaded").hide();
				$("#errorMsg").show();				
				$("#errorMsg").html(response.error['email'][0]);
				return false;
			}
		}
	};
	$("#UserForgotForm").ajaxSubmit(options); 
	return false;
}


function submit_album () {
	
	var errorFlag	=	0;	
	var postData 	=	$("#AlbumForm").serialize();
	var action		=	$("#AlbumForm").attr('action');
	
	$("#errorMsg").hide();
	$("#errorMsg").html("");
	$("#reloaded").show();
	var options 	= 	{
		url:action, 
		type:'POST', 
		data:postData,
		success:    function(response) { 
			
			if ( response!='') {
				parent.$('.album-list').html(response);
				$.fancybox.close();
				
			} else {
				$("#errorMsg").show();
				$("#reloaded").hide();
				var text	=	'';
				var errorArray	=	response.error
				
				for (var key in errorArray) {
					text += errorArray[key][0]+'<br/>';
				}
				$("#errorMsg").html(text);
				return false;
			}
		}
	};	
	$("#AlbumForm").ajaxSubmit(options);	
	return false;		
}

</script>
