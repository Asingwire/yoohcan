<div class="right-contant">  
<?php
 /* <div class="dashboard-menu col-md-3" style="display:none;">
  <h4>Menu <span><a href="#"><img src="images/setting.png" alt="" /></a></span></h4>
  <ul class="dashbord-menu01">
   <li><a href="#">Account Settings</a></li>
   <li><a href="#">Messages</a><span>54</span></li>
   <li><a href="#">Channel</a></li>
   <li><a href="#">Video Manager</a></li>
   <li><a href="#">Logout</a></li>
  </ul>
   <h4>Your Products <span><a href="#"><img src="images/setting.png" alt="" /></a></span></h4>
  <ul class="dashbord-menu02">
   <li class="faq"><a href="#">FAQ</a></li>
   <li class="tutorial"><a href="#">Tutorials</a></li>
   <li class="help"><a href="#">Help</a></li>
   <li class="statist"><a href="#">Statistics</a></li>
  </ul>
    <h4>MOre At yoohcan <span><a href="#"><img src="images/setting.png" alt="" /></a></span></h4>
  <ul class="dashbord-menu03">
   <li><a href="#">About</a></li>
   <li><a href="#">Blog</a></li>
   <li><a href="#">Press</a></li>
   <li><a href="#">Terms</a></li>
   <li><a href="#">Privacy</a></li>   
  </ul>
 </div> */
 ?>
	<div class="col-md-12 channel_detail">  
		<h3><?php echo $title_for_layout; ?></h3>
		<?php echo ($this->Element('Front/User/left_sub_menu'));?>

		<div class="col-md-10 chnl-pad0">
			<!-- BANNER IMAGE -->
			<div class="banner_box">
				<!-- UPLOAD IMAGE -->
				<div class="file_upload_btn">
				<input id="file-3" type="file" multiple=true>
				</div>
				<!-- USER IMG -->
				<div class="user_info">
				<div class="user_image">
					<?php
									$imagePath	=	IMAGE_PATH_FOR_TIM_THUMB.'/'.PROFILE_IMAGE_FULL_DIR.'/';
									$image		=	$userData['User']['profile_image'];			
									if($image &&  file_exists(WWW_ROOT.PROFILE_IMAGE_FULL_DIR.DS.$image )) {
										echo $this->Html->image(SITE_URL.'/timthumb.php?src='.$imagePath.$image.'&w=102&h=102&a=t',array('title'=>$userData['User']['first_name'],'alt'=>$userData['User']['first_name'],'class'=>'user-img-chanel'));
									} else {					
										echo $this->Html->image('Front/avtar.png',array('escape'=>false,'alt'=>'No Image','class'=>'user-img-chanel'));
									}
									?>
				
				
								</div>
				<div class="channel_name">
				<h3>Channel Name <?php echo $this->Html->link($this->Html->image('Front/channel-setting.png'),"#",array('escape'=>false)); ?></h3>
				</div>
				</div>
			</div>
			<!-- Video Box -->
			<div class="strem_box">
				<h3>Previous Streams</h3>

				<ul class="channel_list_1">
					<li>
						<div class="video-img">
						<?php echo $this->Html->link($this->Html->image('Front/channel-img.jpg'),"#",array('escape'=>false)); ?>
						</div>
						<div class="video-title">
						<h3><a href="#">Video title</a> <span>2016 | 13 jun | 8:13 min</span></h3>
						</div>
						<div class="video-setting">
						<?php echo $this->Html->link($this->Html->image('Front/setting1.png'),"#",array('escape'=>false)); ?>
						</div>

					</li>
					<li>
						<div class="video-img">
						<?php echo $this->Html->link($this->Html->image('Front/channel-img.jpg'),"#",array('escape'=>false)); ?>
						</div>
						<div class="video-title">
						<h3><a href="#">Video title</a> <span>2016 | 13 jun | 8:13 min</span></h3>
						</div>
						<div class="video-setting">
						<?php echo $this->Html->link($this->Html->image('Front/setting1.png'),"#",array('escape'=>false)); ?>
						</div>

					</li>
					<li>
						<div class="video-img">
						<?php echo $this->Html->link($this->Html->image('Front/channel-img.jpg'),"#",array('escape'=>false)); ?>
						</div>
						<div class="video-title">
						<h3><a href="#">Video title</a> <span>2016 | 13 jun | 8:13 min</span></h3>
						</div>
						<div class="video-setting">
						<?php echo $this->Html->link($this->Html->image('Front/setting1.png'),"#",array('escape'=>false)); ?>
						</div>

					</li>
					<li>
						<div class="video-img">
						<?php echo $this->Html->link($this->Html->image('Front/channel-img.jpg'),"#",array('escape'=>false)); ?>
						</div>
						<div class="video-title">
						<h3><a href="#">Video title</a> <span>2016 | 13 jun | 8:13 min</span></h3>
						</div>
						<div class="video-setting">
						<?php echo $this->Html->link($this->Html->image('Front/setting1.png'),"#",array('escape'=>false)); ?>
						</div>

					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
