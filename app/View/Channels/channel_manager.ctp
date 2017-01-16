<?php echo $this->Element('channel_upload_js');?>
<div class="right-contant">  
	<div class="col-md-12 channel_detail">  
		<h3><?php //echo $title_for_layout; ?></h3>
		<?php echo ($this->Element('Front/User/left_sub_menu'));?>

		<div class="col-md-10 chnl-pad0">
			<?php echo $this->Session->flash(); ?>
			<!-- BANNER IMAGE -->
			<div id="mestatus"></div>
		
			<div class="row">
				<div class="col-md-6 streaming-box_70 set-left">	
					
							<p class="hedding_in">My Channel
											
											
											<?php /* echo $this->Html->link($this->Html->image('tooltip.png',array('class'=>'tooltip_img')),"javascript:;",array('alt'=>'Edit Info','title'=>'These are your general account settings. Add a picture to function as you avatar.','escape'=>false,'class'=>'tooltip_img')); */ ?>	
									
							</p>
					
				</div>
				</div>
			
			<div class="banner_box banner_box_custom">
			
				<!-- UPLOAD IMAGE -->
				<div class="banner_button">
					<div class="file_upload_btn">
                    <?php echo $this->Html->link('UPLOAD (1230x320 or Greater)','javascript:;',array('class'=>'upload','alt'=>'Background Image','title'=>'Background Image','escape'=>false,'style'=>'color:#fff;margin:10px;font-size: 12px;')); ?>					
					</div>
				</div>
				<!-- USER IMG -->
				<div class="user_info">
					<div class="user_image">
						<?php
							$imagePath	=	IMAGE_PATH_FOR_TIM_THUMB.'/'.PROFILE_IMAGE_FULL_DIR.'/';
							$image		=	$userData['User']['profile_image'];			
							if($image &&  file_exists(WWW_ROOT.PROFILE_IMAGE_FULL_DIR.DS.$image )) {
								echo $this->Html->image(SITE_URL.'/timthumb.php?src='.$imagePath.$image.'&w=202&h=202&a=t',array('title'=>$userData['User']['first_name'],'alt'=>$userData['User']['first_name'],'class'=>'user-img-chanel'));
							} else {					
								echo $this->Html->image('Admin/no_image.jpg',array('escape'=>false,'alt'=>'No Image','class'=>'user-img-chanel'));
							}
						?>
					</div>
					<div class="channel_name">					
					<?php if(isset($user_detail['Channel']['name']) && !empty($user_detail['Channel']['name'])){ ?>
						<h3>
							<?php echo $user_detail['Channel']['name'] ?> 
							<?php //echo $this->Html->link($this->Html->image('Front/edit.png'),"javascript:;",array('alt'=>'Edit Channel Info','title'=>'Edit Channel Info','escape'=>false,'id'=>'channel_setting')); ?>
						</h3>						
					<?php }else{ ?>					
					<h3>					
					<?php //echo $this->Html->link($this->Html->image('Front/edit.png'),"javascript:;",array('alt'=>'Channel Setting','title'=>'Edit Channel Info','escape'=>false,'id'=>'channel_setting')); ?>
					
				
					
					
					</h3>				
					<?php  } ?>
					</div>
				</div>
			</div>
			
	
			
			<!-- Video Box -->
			<div style=" position: relative;top: 105px;" >
				<p class="hedding_in" style="margin-bottom:15px;">	   
				
				</p>
			</div>
			<div class="col-md-12" style="margin-top: 101px; margin-bottom: 6px;">
			<?php echo $this->Html->link($this->Html->image('tooltip.png',array('class'=>'tooltip_img_c')),"javascript:;",array('alt'=>'Edit Info','title'=>'Here you can bring your channel to live by adding a description/bio, uploading a banner and some more info about your channel. It decides what the user sees on the front end.','escape'=>false,'class'=>'')); ?>	
			</div>
			<div class="strem_box">
				
				<h3>
				
				
				&nbsp;&nbsp;Channel Info <?php echo $this->Html->link($this->Html->image('Front/edit.png'),"javascript:;",array('alt'=>'Channel Setting','title'=>'Edit Channel Info','escape'=>false,'id'=>'channel_setting')); ?></h3>			
				<div class="col-md-6 streaming-box_30 set-left">
					<div class="stream-details-box">
						<div class="full-box" style="border-bottom:none;">
							<h3 class="heading" style="margin:0px;border-bottom:1px solid #ddd;" >Bio</h3>
							<div >
							<p><?php if(!empty($user_detail)){ echo $user_detail['Channel']['bio']; }else{ echo '-';} ?></p>
							</div>
						</div>							
					</div>					
				</div>
				
				<div class="col-md-5 streaming-box_30 pad0">
					<div class="stream-details-box">
						<div class="full-box" style="border-bottom:none;" >
							<h3 class="heading" style="margin:0px;border-bottom:1px solid #ddd;">Company</h3>
							<div >
							<p><?php if(!empty($user_detail)){ echo $user_detail['Channel']['company']; }else{ echo '-';} ?></p>
							</div>
						</div>
						<div class="full-box" style="border-bottom:none;">
							<h3 class="heading" style="margin:0px;border-bottom:1px solid #ddd;">Website</h3>
							<div>
							<p><?php if(!empty($user_detail)){ echo $user_detail['Channel']['website']; }else{ echo '-';} ?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="strem_box" style="margin-bottom:10px;margin-top:25px;">
				<h3>Previous Streams</h3>
				<?php
				if(!empty($user_detail['RecordingStream'])){
				?>
				<ul class="channel_list_1">
					<?php 
					
					foreach($user_detail['RecordingStream'] as $value){ ?>
					
					<li>
						<div class="video-img">
						<?php //echo $this->Html->link($this->Html->image('Front/channel-img.jpg'),"#",array('alt'=>$value['title'],'title'=>$value['title'],'escape'=>false)); ?>
						
						
						<?php
						$recordingPath		=	IMAGE_PATH_FOR_TIM_THUMB.RECORDING_IMAGE_FULL_DIR."/";
						$recording_image		=	$value['image'];
						
						if($recording_image && file_exists(WWW_ROOT.RECORDING_IMAGE_FULL_DIR.DS.$recording_image )) {
							//$image_url = SITE_URL.'/timthumb.php?src='.$recordingPath.$recording_image.'&w=280&h=158&a=t';	
							//echo $this->Html->image(SITE_URL.$recordingPath.$recording_image,array('class'=>'','alt'=>$value['title'],'title'=>$value['title'],'class'=>'imgClass'));
						?>							
							<?php echo $this->Html->link($this->Html->image(SITE_URL.'/timthumb.php?src='.$recordingPath.$recording_image.'&w=280&h=158&a=t',array('title'=>$value['title'],'alt'=>$value['title'])),array('controller'=>'streams','action'=>'recorded_stream_detail',$value['id']),array('escape' => false,'title'=>$value['title'],'alt'=>$value['title']));  ?>
							
						<?php								
						}
						else
						{
							echo $this->Html->link($this->Html->image('Front/channel-img.jpg'),array('controller'=>'streams','action'=>'recorded_stream_detail',$value['id']),array('alt'=>$value['title'],'title'=>$value['title'],'escape'=>false));	
						}
						?>
						
						</div>
						<div class="video-title">
						<h3><?php echo $this->Html->link($value['title'],array('controller'=>'streams','action'=>'recorded_stream_detail',$value['id']),array('escape'=>false,'alt'=>$value['title'],'title'=>$value['title'])); ?><span><?php echo date('Y',strtotime($value['created'])); ?> | <?php echo date('d M',strtotime($value['created'])); ?> | <?php echo date('H:i',strtotime($value['created'])); ?> min</span></h3>
						</div>				
						
						<div class="dropdown video-setting" id="dropdown_channel">
						<a href="" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<?php echo $this->Html->image('Front/setting1.png'); ?>
						</a>
						<ul class="dropdown-menu dropdown-menu-channel" aria-labelledby="dLabel">
							<li><?php  echo $this->Html->link('Edit',"javascript:;",array('alt'=>'Edit','title'=>'Edit','escape'=>false,'id'=>'stream_setting','class'=>'stream_setting_box','name'=>$value['id'])); ?></li>
							<li><?php  echo $this->Html->link('Delete',array('controller'=>'channels',"action"=>'delete',$value['id']),array('alt'=>'Delete','title'=>'Delete','escape'=>false,'id'=>'stream_setting','class'=>'stream_setting_box','name'=>$value['id'])); ?></li>
						</ul>
						</div>
						<?php 
						/* 
						<div class="video-setting">
						
						<?php /* echo $this->Html->link($this->Html->image('Front/setting1.png'),"javascript:;",array('alt'=>'Edit Info','title'=>'Edit Info','escape'=>false,'id'=>'stream_setting','class'=>'stream_setting_box','name'=>$value['id'])); ?>
						
						<?php echo $this->Html->link($this->Html->image('Front/setting1.png'),"javascript:;",array('alt'=>'Edit Info','title'=>'Edit Info','escape'=>false,'id'=>'stream_setting','class'=>'stream_setting_box','name'=>$value['id'])); ?>
						</div>
					 */	?>
					</li>					
					
					<?php }
					
					?>
				</ul>
		
			<script>
				 $(document).on('ready', function() {
					$(".dropdown_channel").click(function(){
						$(".open-drop").slideToggle();
					});
				});
			</script>
				<?php
				}else
				{
					echo $this->Element('no_record_found',array('message'=>'No previous stream found.'));
				}
				?>
				
			</div>
		
		</div>
	</div>
</div>
<?php echo $this->element('Front/footer'); ?>



<div class="modle_popup">
<div class="modal md1 fade in" id="banner_image_error" role="dialog">
    <div class="modal-dialog md-width">
    
      <!-- Modal content-->
      <div class="modal-content md-content">
        <div class="modal-header md-header">
         <button type="button" style="top:70px;right:0px;z-index:9 !important;" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Alert</h4>
        </div>
        <div class="modal-body md-body">
			<p  style="align:center;color: #354052;font-family: 'ProximaNovaA-Regular';font-size: 16px;font-weight: 600;" id="banner_image_error_msg"></p>
        </div>
      </div>
      
    </div>
  </div>
</div>





<div class="modal md1 fade in" id="channel_box" role="dialog">
    <div class="modal-dialog md-width">
    
      <!-- Modal content-->
      <div class="modal-content md-content">
        <div class="modal-header md-header">          
          <h4 class="modal-title">Update Channel Info</h4>
		   <div class="delete_btn"><button type="button" class="close" style="right:1px" data-dismiss="modal">×</button></div>
        </div>
		
		<div id="channel_data" class="modal-body md-body">
		<?php echo $this->Element('/Front/Streams/channel_detail'); ?>
		</div>
		</div>
      
    </div>
 </div>
 
 
 
 

 
 <div class="modal md1 fade in" id="recording_box" role="dialog">
    <div class="modal-dialog md-width">
    
      <!-- Modal content-->
      <div class="modal-content md-content">
        <div class="modal-header md-header">          
          <h4 class="modal-title">Edit Recorded Stream</h4>
		   <div class="delete_btn"><button type="button" class="close" style="right:1px" data-dismiss="modal">×</button></div>
        </div>
		
		<div id="recording_data" class="modal-body md-body">
		<?php echo $this->Element('/Front/Streams/channel_detail'); ?>
		</div>
		</div>
      
    </div>
 </div>





<script type="text/javascript">

$(document).ready(function(){
	var $modal = $('#channel_box');
	$('#channel_setting').on('click', function(){
		$('.loading_bank_channel').css('visibility','visible');
		
		$.ajax({
			type: "POST",
			url: '<?php echo $this->Html->url(array("controller"=>"channels","action"=>"setting")) ;?>',
			success: function(data)
			{	
			 $("#channel_data").html(data);
				$modal.modal('show');
				
			}
		});
	});
});

$(document).ready(function(){
	var $modal = $('#recording_box');
	$('.stream_setting_box').on('click', function(){
	$('.loading_bank_channel').css('visibility','visible');
	var _this = this
	var stream_id = $(_this).attr("name");
		$.ajax({
			type: "POST",
			url: '<?php echo $this->Html->Url(array('controller'=>'channels','action'=>'edit_recording'))?>/'+stream_id,
			success: function(data)
			{	
			 $("#recording_data").html(data);
				$modal.modal('show');
			}
		});
	});
});




$(document).on('click','#channel_setting_submit',function(){
	$('.loading_bank_channel').css('visibility','visible');
	$.ajax({
	   type: "POST",
	   url: "<?php echo $this->Html->url(array("controller"=>"channels","action"=>"setting")) ;?>",
	   data: $("#channel_setting_form").serialize(), // serializes the form's elements.
	   success: function(data)
	   {		
		   $("#channel_data").html(data); // show respsonse from the php script.
			
	   }
	 });
});

$(document).on('click','#streming_recording_submit',function(){
	$('#loading_stream_img').css('visibility','visible');
	 $.ajax({
	   type: "POST",
	   url: "<?php echo $this->Html->url(array("controller"=>"channels","action"=>"edit_recording")) ;?>",
	   data: $("#setting_recording_form").serialize(), // serializes the form's elements.
	   success: function(data)
	   {		
		   $("#recording_data").html(data); // show respsonse from the php script.
			
	   }
	 });
});

</script>


<script type="text/javascript">
	
	$(document).ready(function(){
		<?php
		$channelPath		=	IMAGE_PATH_FOR_TIM_THUMB.CHANNEL_IMAGE_FULL_DIR."/";
		$channel_image		=	$user_detail['Channel']['image'];
		if($channel_image) {
			$image_url = SITE_URL.'/timthumb.php?src='.$channelPath.$channel_image.'&w=1230&h=320&zc=1';			
			//$image_url = $channelPath.$channel_image;			
		}
		else
		{
			$image_url = SITE_URL.'/img/Front/channel-banner-bg.jpg';			
		}
		$banner_image = "url($image_url)";
		?>
		banner_image = '<?php echo $banner_image  ?>';
		$(".banner_box").css("background", banner_image);
	
	
	});
	
</script>