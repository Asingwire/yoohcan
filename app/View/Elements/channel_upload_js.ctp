<?php echo $this->Html->script(array('ajaxupload'));?>
<script type="text/javascript">
//code for uploading user image start here
jQuery(function($){
	var siteurl 	= '<?php echo SITE_URL; ?>';
	var btnUpload=$('.upload');  
      var mestatus=$('#mestatus');		
        up_archive = new AjaxUpload(btnUpload, {
	   
         action: '<?php echo SITE_URL;?>/channels/channelpicupload',		 
		 //Name of the file input box  
         name: 'uploadfile',  
         onSubmit: function(file, ext){
		if (up_archive._input.files[0].size > 8388608){ 
			//alert('Image size should not be greater than 8 MB.');
			$("#banner_image_error_msg").html('Image size should not be greater than 8 MB.');
			$("#banner_image_error").modal({keyboard: false,show:true});
			return false;
		}
		 if(ext != 'jpg' && ext != 'png' && ext != 'jpeg' && ext != 'gif') {
			/* alert('Only JPG, PNG or GIF files are allowed'); */
			$("#banner_image_error_msg").html('Only JPG, PNG or GIF files are allowed.');
			$("#banner_image_error").modal({keyboard: false,show:true});
			
			return false;
		}	
        mestatus.html('<?php echo $this->Html->image('Front/ajax-loader1.gif',array('alt'=>'Loading','title'=>'Loading'));?> Loading, please wait...');
        },		
        onComplete: function(file, response)
		{
			//On completion clear the status  
			mestatus.text(''); 
			//Add uploaded file to list  
			var myimageresponse = response.split('|');
			/* var thumb 		= '<?php echo IMAGE_PATH_FOR_TIM_THUMB; ?>';
			var full_url 	= '<?php echo CHANNEL_IMAGE_FULL_DIR; ?>/';
			var siteurl 	= '<?php echo SITE_URL; ?>';
			$('.banner_img_box').html('<img class="chanel-banner-img" src="'+siteurl+'/timthumb.php?src='+thumb+full_url+myimageresponse[1]+'&w=1230&h=390&a=t'+myimageresponse[1]+ '"/>'); */
			
			if(myimageresponse[0]==="success")
			{			
				var thumb 		= '<?php echo IMAGE_PATH_FOR_TIM_THUMB; ?>';
				var full_url 	= '<?php echo CHANNEL_IMAGE_FULL_DIR; ?>/';
				var siteurl 	= '<?php echo SITE_URL; ?>';
				var image_url = siteurl+'/timthumb.php?src='+thumb+full_url+myimageresponse[1]+'&w=1230&h=320&zc=1'+myimageresponse[1];
				//var image_url = thumb+full_url+myimageresponse[1];
				
				var banner_url = 'url('+image_url+')';
				$(".banner_box").css("background", banner_url);
			}
			else if(myimageresponse[0]==="sizeError")
			{
				//alert(myimageresponse[1]);
				$("#banner_image_error_msg").html(myimageresponse[1]);
				$("#banner_image_error").modal({keyboard: false,show:true});
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
