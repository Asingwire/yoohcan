<?php echo $this->Html->script(array('ajaxupload'));?>
<script type="text/javascript">
//code for uploading user image start here
jQuery(function($){
	var siteurl 	= '<?php echo SITE_URL; ?>';
	var btnUpload=$('.upload');  
      var status=$('#status');	
		var proImage=$('#proImage');		  
      up_archive = new AjaxUpload(btnUpload, {
	   
         action: '<?php echo SITE_URL;?>/users/userpicupload',		 
		 //Name of the file input box  
         name: 'uploadfile',  
         onSubmit: function(file, ext){
			if (up_archive._input.files[0].size > 8388608){ 
				//alert('Image size should not be greater than 8 MB.');
				$("#user_image_error_msg").html('Image size should not be greater than 8 MB.');
				$("#user_image_error").modal({keyboard: false,show:true});
				return false;
			}	
		 if(ext != 'jpg' && ext != 'png' && ext != 'jpeg' && ext != 'gif') {
			//alert('Only JPG, PNG or GIF files are allowed');
			$("#user_image_error_msg").html('Only JPG, PNG or GIF files are allowed.');
			$("#user_image_error").modal({keyboard: false,show:true});
			return false;
		}	
         proImage.html('<?php echo $this->Html->image('Front/ajax-loader1.gif',array('alt'=>'Loading','title'=>'Loading'));?> Loading, please wait...');
        },		
        onComplete: function(file, response)
		{
			//On completion clear the status  
			proImage.text('');   
			//Add uploaded file to list  
			var myimageresponse = response.split('|');
			if(myimageresponse[0]==="success")
			{			
				var thumb 		= '<?php echo IMAGE_PATH_FOR_TIM_THUMB; ?>';
				var full_url 	= '<?php echo PROFILE_IMAGE_FULL_DIR; ?>/';
				var siteurl 	= '<?php echo SITE_URL; ?>';
				$('.userimageid').html('<img class="user-img" src="'+siteurl+'/timthumb.php?src='+thumb+full_url+myimageresponse[1]+'&w=102&h=102&a=t'+myimageresponse[1]+ '"/>');
			}
			else if(myimageresponse[0]==="sizeError")
			{
				//alert(myimageresponse[1]);
				$("#user_image_error_msg").html(myimageresponse[1]);
				$("#user_image_error").modal({keyboard: false,show:true});
				return false;
			}
			else
			{			 
				$('<li></li>').appendTo('#files').text(file).addClass('errorTxt');  
			}
        }
       });
		
});
String.prototype.trim = function() {
	return this.replace(/^\s+|\s+$/g,"");
}
//code for uploading user image end here
</script>
