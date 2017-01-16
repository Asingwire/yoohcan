 <?php if($this->Session->check('Auth.User.id') ){ ?>
			<script type="text/javascript">var switchTo5x=true;</script>
			<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
			<script type="text/javascript">stLight.options({publisher: "3c404603-90e8-4032-8931-fe478ae2f807",embeds:'true', doNotHash: false, doNotCopy: false, hashAddressBar: false,onhover: false,shorten:false});</script>
			<?php 
			$channelName ='';
			$channelBio ='';
			if(!empty($featured_stream_detail['Channel']['name'])){ 
				$channelName = $featured_stream_detail['Channel']['name']; 
			} 
			
			if(!empty($featured_stream_detail['Channel']['bio'])){ 
				$channelBio = $featured_stream_detail['Channel']['bio']; 
			} 
			
			
			$image		=	$featured_stream_detail['Channel']['image'];	
			$imageProfile	=	$featured_stream_detail['User']['profile_image'];	
			$imagePath	=	IMAGE_PATH_FOR_TIM_THUMB.'/'.CHANNEL_IMAGE_FULL_DIR.'/';
			$imagePathProfile	=	IMAGE_PATH_FOR_TIM_THUMB.'/'.PROFILE_IMAGE_FULL_DIR.'/';
			
			if($image &&  file_exists(WWW_ROOT.CHANNEL_IMAGE_FULL_DIR.DS.$image )) {
				$shareImage = $imagePath.$image;
			} elseif($imageProfile &&  file_exists(WWW_ROOT.PROFILE_IMAGE_FULL_DIR.DS.$imageProfile )) 	  {
				$shareImage = $imagePathProfile.$imageProfile;
			}else{
				$shareImage = SITE_URL.'/img/logo.png';
			}
			
			?>
			 <a style="cursor:pointer;"> <span  style="color:#fff;" class="st_sharethis" st_title="<?php echo $channelName;  ?>" st_summary="<?php echo $channelBio;  ?>" st_image="<?php echo $shareImage; ?>"><li class="share">Share</li></span> </a>
			
			<?php
		  }else{
		 
				echo $this->Html->link(' <li class="share">SHARE</li>', 'javascript:;', array('escape'=>false,'class'=>'',"data-toggle"=>"modal" ,"data-target"=>"#loginModal","style"=>"color:#fff;" ));
			}
			?>			