

<div class="home-contant">
      <div class="left-video"><?php 
		$streamPath		=	IMAGE_PATH_FOR_TIM_THUMB.STREAM_IMAGE_FULL_DIR."/";
		$stream_image		=	$featured_stream_detail['Stream']['stream_image'];
		
		echo $this->Html->image(SITE_URL.'/timthumb.php?src='.$streamPath.$stream_image.'&w=320&h=180&a=t',array('class'=>'','alt'=>$featured_stream_detail['Stream']['title'],'title'=>$featured_stream_detail['Stream']['title'],'class'=>'imgClass'))
	  
	  //echo ($this->Html->image('Front/slide_img.jpg')); ?>
	  </div>
      <div class="right-text">
        <h2><?php echo $featured_stream_detail['Stream']['title']?></h2>
        
        <h6> 2h 34m  /   <?php echo date('d-M-Y',strtotime($featured_stream_detail['Stream']['created'])); ?> <?php //echo ($this->Html->image('Front/like.png')); ?></h6>
        <p><?php echo $featured_stream_detail['Stream']['stream_bio']?>
          <br />		  
		<p style="text-align:justify">
			<?php
				echo $this->Html->link('Click here',array('controller'=>'streams','action'=>'stream_detail',$featured_stream_detail['Stream']['id']),array('style'=>'color:#4b96aa;','escape'=>false,'alt'=>$featured_stream_detail['Stream']['title'],'title'=>$featured_stream_detail['Stream']['title']));
			?>
			to watch and chat live with Level | Up!
		</p>

		<?php 
		if($featured_stream_detail['ChannelFollower']['is_follow'] == 0){
			$relValWall = 'Follow';
			$heart_img = 'Front/heart_icn.png';
		}else{
			$relValWall = 'Following';
			$heart_img = 'Front/heart-icn-green.png';
		} 
		?>

	   <div class="share_links">
          <ul> 
			<?php
			if($this->Session->check('Auth.User.id'))
			{
				$user_id = $this->Session->read('Auth.User.id');
				if($user_id != $featured_stream_detail['Stream']['user_id'] && $channel_subscribe_check_user == 0)
				{
			?>
				<li id="subscribe_channel_div">	
					<a href="javascript:;" id="subscribe_channel"><?php echo ($this->Html->image('Front/video_icn.png')); ?></a>
				</li>
				<?php
				}
				elseif($user_id != $featured_stream_detail['Stream']['user_id'] && $featured_stream_detail > 0)
				{	?>
				
					<li id='subscribe_channel_div'><a href='javascript:;' onclick = stream_already_subscribe('<?php echo $featured_stream_detail['Channel']['id']; ?>')><?php echo $this->Html->image("Front/video_icn_green.png") ?></a></li>
					
			<?php	}
				
				?>
			<?php
			}
			else
			{
			?>
				<li>
					<a href="javascript:;" data-toggle="modal" data-target="#loginModal"><?php echo ($this->Html->image('Front/video_icn.png')); ?></a>
				</li>
			<?php	
			}
			?>
            
			 <li class="followPostCl_<?php echo $featured_stream_detail['Stream']['id']; ?>" rel="<?php echo $relValWall; ?>" >	<?php 
			if($this->Session->check('Auth.User.id') ){
				echo $this->Html->link($this->Html->image($heart_img,array('class'=>"reposttext_".$featured_stream_detail['Stream']['id']."")),"javascript:;", array("onclick"=> "followStream('".$featured_stream_detail['Stream']['id']."','".$featured_stream_detail['Stream']['channel_id']."');",'escape'=>false));			
			} else {
				echo ($this->Html->link('<span class="reposttext_'.$featured_stream_detail['Stream']['id'].'">'.$this->Html->image('Front/heart_icn.png').'</span>', 'javascript:;', array('escape'=>false,'class'=>'',"data-toggle"=>"modal" ,"data-target"=>"#loginModal" )));
			}
			?>
			
			</li>
			 <li>
				<?php if($this->Session->check('Auth.User.id') ){
					 
					$streamTitle ='';
					$streamBio ='';
					if(!empty($featured_stream_detail['Stream']['title'])){ 
						$streamTitle = $featured_stream_detail['Stream']['title']; 
					} 
					
					if(!empty($featured_stream_detail['Stream']['stream_bio'])){ 
						$streamBio = $featured_stream_detail['Stream']['stream_bio']; 
					} 
					
					//pr($featured_stream_detail);
					$image		=	$featured_stream_detail['Stream']['stream_image'];	
					$imageProfile	=	$featured_stream_detail['User']['profile_image'];	
					$imagePath	=	IMAGE_PATH_FOR_TIM_THUMB.'/'.STREAM_IMAGE_FULL_DIR.'/';
					$imagePathProfile	=	IMAGE_PATH_FOR_TIM_THUMB.'/'.PROFILE_IMAGE_FULL_DIR.'/';
					
					if($image &&  file_exists(WWW_ROOT.STREAM_IMAGE_FULL_DIR.DS.$image )) {
						$shareImage = $imagePath.$image;
					} elseif($imageProfile &&  file_exists(WWW_ROOT.PROFILE_IMAGE_FULL_DIR.DS.$imageProfile )) 	  {
						$shareImage = $imagePathProfile.$imageProfile;
					}else{
						$shareImage = SITE_URL.'/img/logo.png';
					}					
				?>
			
			
			 <li>
				 <a style="cursor:pointer;">
					<span  style="color:#fff;" class="st_sharethis" st_url="<?php echo SITE_URL.'/streams/stream_detail/'.$featured_stream_detail['Stream']['id']; ?>" st_title="<?php echo $streamTitle;  ?>" st_summary="<?php echo $streamBio;  ?>" st_image="<?php echo $shareImage; ?>"><?php echo ($this->Html->image('Front/share_icn.png')); ?></span> 
				 </a>
			 </li>
			 
			<?php }else{ ?>
				
				<li><a style="cursor:pointer;" data-toggle="modal" data-target="#loginModal"><?php echo ($this->Html->image('Front/share_icn.png')); ?></a></li>
				
			<?php
			}
			?>			 
			</li>
          </ul>
        </div>
      </div>
</div>
	
	<div class="modal md1 fade in" id="channel_box" role="dialog">
		<div class="modal-dialog md-width">
		  <!-- Modal content-->
		<div class="modal-content md-content">
			<div class="modal-header md-header">          
			  <h4 class="modal-title">Subscribe Featured Streams</h4>
			   <div class="delete_btn"><button type="button" class="close" style="right:1px" data-dismiss="modal">×</button></div>
			</div>			
			<div id="channel_data" class="modal-body md-body">
				<?php echo $this->Element('/Front/Streams/channel_info_subscribe_home'); ?>
			</div>
		</div>		  
		</div>
	</div>
	
