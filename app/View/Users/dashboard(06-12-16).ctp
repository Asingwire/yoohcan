<?php 

 echo $this->Element('photo_upload_js');?>
<div class="right-contant">  


	<div class="col-md-12 channel_detail">  
		<h3><?php echo $title_for_layout; ?></h3>
		<?php echo ($this->Element('Front/User/left_sub_menu'));?>
		<div class="col-md-10">
			<?php echo $this->Session->flash(); ?>

			<div class="col-md-6 streaming-box_70 set-left">
				
				<p>Account Settings</p>
				<div class="stream-details-box">
					<div class="full-box user_edit_box">
						<h3 class="heading">General Info</h3>
						<span class="edit_general_info">
							<?php echo $this->Html->link($this->Html->image('Front/edit.png'),"javascript:;",array('alt'=>'Edit Info','title'=>'Edit Info','escape'=>false,'id'=>'general_info_link','class'=>'general_info_edit')); ?>
							
						</span>
						<?php /*<div class="edt-name">
						 <p><label><?php echo $user_data['User']['first_name'].' '.$user_data['User']['last_name']?></label><span>Name</span></p>
						</div> */ ?>
					</div>
					<div class="full-box pad-box">
						<div class="edt-name">
							<p><label><?php echo $user_data['User']['first_name'] ?></label><span>First Name</span></p>
						</div>
					</div>
					<div class="full-box pad-box">
						<div class="edt-name">
							<p><label><?php echo $user_data['User']['last_name'] ?></label><span>Last Name</span></p>
						</div>
					</div>
					<div class="full-box pad-box">
						<div class="edt-name">
							<p><label><?php echo $user_data['User']['email'] ?></label><span>Email</span></p>
						</div>
					</div>
					<div class="full-box pad-box">
					
						
						<div class="edt-name">		

							<p style="float: left;text-align: center;width: 66%"><label id="proImage"></label><span>&nbsp;&nbsp;</span></p>
											
							<p>
								<div class="img_box">								
									<div class="usr-img userimageid kmaal">
									<?php
									$imagePath	=	IMAGE_PATH_FOR_TIM_THUMB.'/'.PROFILE_IMAGE_FULL_DIR.'/';
									$image		=	$userData['User']['profile_image'];			
									if($image &&  file_exists(WWW_ROOT.PROFILE_IMAGE_FULL_DIR.DS.$image )) {
										echo $this->Html->image(SITE_URL.'/timthumb.php?src='.$imagePath.$image.'&w=102&h=102&a=t',array('title'=>$userData['User']['first_name'],'alt'=>$userData['User']['first_name'],'class'=>'user-img'));
									} else {					
										echo $this->Html->image('Admin/avatar5.png',array('escape'=>false,'alt'=>'No Image','class'=>'user-img'));
									}
									?>
										
									</div>
									<div class="action-btn">
										<?php echo $this->Html->link($this->Html->image('Front/image-icon.png',array('title'=>'edit','alt'=>'edit')),'javascript:;',array('class'=>'upload','escape'=>false,'title'=>'edit','alt'=>'edit')); ?>										
										<?php echo $this->Html->link($this->Html->image('Front/trash-icon.png',array('title'=>'delete','alt'=>'delete')),array('controller' => 'users', 'action' => 'image_delete'),array('escape'=>false,'title'=>'delete','alt'=>'delete')); ?>
									</div>									
								</div>
								
								<span style="float:left;">Avatar <span class="size">JPG, PNG or GIF</span></span>
								
							</p>
						</div>
					</div>
					<!--
					<div class="full-box pad-box">
						<div class="edt-name">
							<p><label>London, United Kingdom</label><span>Country</span></p>
						</div>
					</div>
					-->
					<div class="full-box pad-box1 border-none">
						<div class="edt-name">
							<p><label><?php echo $user_data['User']['nickname'] ?></label><span>Nickname</span></p>
						</div>
					</div>
				</div>
				<div class="stream-details-box ">					
					<div class="full-box border-none pad20">
				
					<h3 class="heading">General Info</h3>
					</div>
					<?php echo($this->Form->create('UserNotification', array('url' => array('controller' => 'users', 'action' => 'notification'),'class'=>'form-horizontal','type'=>'file'))); ?>
					<div class="full-box ">
						<div class="tongle_list ">
							<p>Email me when any broadcaster i am following starts to broadcast
							<span>
							<?php  echo($this->Form->checkbox('UserNotification.email_brodcast_start', array("class" => "lcs_check lcs_tt1",'data-toggle'=>"toggle",'data-filed_type'=>'email_brodcast_start','autocomplete'=>'off'))); ?>
							 </span></p>
						</div>
					</div>
					<div class="full-box ">
						<div class="tongle_list ">
						<p>Email me when any broadcaster i am following uploads a new video  <span>
						<?php  echo($this->Form->checkbox('UserNotification.email_brodcast_video', array("class" => "lcs_check lcs_tt1",'data-filed_type' =>"email_brodcast_video",'data-toggle'=>"toggle",'autocomplete'=>'off'))); ?>
						</span></p>
						</div>
					</div>
					<div class="full-box ">
						<div class="tongle_list ">
						<p class="disable">Never send me email notifications<span> 
						<?php  echo($this->Form->checkbox('UserNotification.email_notification', array("class" => "lcs_check lcs_tt1",'data-filed_type' =>"email_notification",'data-toggle'=>"toggle",'autocomplete'=>'off'))); ?></span></p>
						</div>
					</div>
					<div class="full-box ">
						<div class="tongle_list ">
						<p>Allow Push notifications <span><?php  echo($this->Form->checkbox('UserNotification.push_notification', array("class" => "lcs_check lcs_tt1",'data-toggle'=>"toggle",'data-filed_type' =>"push_notification",'autocomplete'=>'off'))); ?></span></p>
						</div>
					</div>
					<div class="full-box last">
						<div class="tongle_list ">
						<p>Block messages from people you don't follow <span><?php  echo($this->Form->checkbox('UserNotification.block_messages', array("class" => "lcs_check lcs_tt1",'value' =>"",'data-filed_type' =>"block_messages",'data-toggle'=>"toggle",'autocomplete'=>'off'))); ?></span></p>
						</div>
					</div>
				</div>
				<div class="stream-details-box">
					<div class="full-box border-none pad20">
						<h3 class="heading">Channel Notifications</h3>
					</div>
					<div class="full-box ">
						<div class="tongle_list ">
						<p>Automatically archive my broadcasts
						<span><?php  echo($this->Form->checkbox('UserNotification.archive_broadcast', array("class" => "lcs_check lcs_tt1",'data-filed_type' =>"archive_broadcast",'data-toggle'=>"toggle",'value' =>"",'autocomplete'=>'off'))); ?></span></p>
						</div>
					</div>
					<div class="full-box ">
						<div class="tongle_list ">
						<p>Friends can comment on posts  <span><?php  echo($this->Form->checkbox('UserNotification.friend_comment', array("class" => "lcs_check lcs_tt1",'data-filed_type' =>"friend_comment",'data-toggle'=>"toggle",'value' =>"",'autocomplete'=>'off'))); ?></span></p>
						</div>
					</div>
					<div class="full-box ">
						<div class="tongle_list ">
						<p class="disable">Disable all comments on Channel Feed posts<span><?php  echo($this->Form->checkbox('UserNotification.disable_comment_post', array("class" => "lcs_check lcs_tt1",'data-filed_type' =>"disable_comment_post",'data-toggle'=>"toggle",'autocomplete'=>'off'))); ?></span></p>
						</div>
					</div>
					<div class="full-box ">
						<div class="tongle_list ">
						<p>Require a verified email to enter chat <span>
						<?php  echo($this->Form->checkbox('UserNotification.email_brodcast_video', array("class" => "lcs_check lcs_tt1",'data-toggle'=>"toggle",'data-filed_type' =>"email_brodcast_video",'autocomplete'=>'off'))); ?>
						</span></p>
						</div>
					</div>
					<div class="full-box last">
						<div class="tongle_list ">
										<p>Delete links in chat <span><?php  echo($this->Form->checkbox('UserNotification.delete_chat', array("class" => "lcs_check lcs_tt1",'data-toggle'=>"toggle",'data-filed_type' =>"delete_chat",'autocomplete'=>'off'))); ?></span></p>
						</div>
					</div>
					<?php echo($this->Form->end());?>
				</div>
				<div class="stream-details-box">
					<div class="full-box border-none pad20">
						<h3 class="heading">Disable Your Yoohcan Account</h3>
					</div>
					<div class="full-box ">
						<div class="tongle_list ">
					
						<p>If you want to disable your Yoohcan account
						<span>
							<?php 	echo $this->Html->link('Deactivate your account',array('controller' => 'users', 'action' => 'account_disable',0),array('escape'=>false,'title'=>'Deactivate your account','alt'=>'Deactivate your account')); ?>
						
						</span></p>
						
						</div>
					</div>
			
				
					<?php echo($this->Form->end());?>
				</div>
			</div>
			<div class="col-md-6  streaming-box_30 pad0">
			
				<div class="left-dis">
					<span class="edit">
						<a href="javascript:;" data-toggle="modal" data-target="#bank_pay_edit">
							<?php echo $this->Html->image('Front/edit.png',array('alt'=>'edit','title'=>'edit')); ?>					
						</a>						
					</span>

					
					
					<div class="visa visa_btn_position">	
					<span class="edit_visa_card">
						<a href="javascript:;" alt="edit" title="edit" data-toggle="modal" data-target="#cc_pay_edit">
							<?php echo $this->Html->image('Front/edit.png',array('alt'=>'edit','title'=>'edit')); ?>						
						</a>
					</span>
					<?php echo $this->Html->image('Front/visa.jpg'); ?>
					<p>
						<?php 
						if(!empty($user_data['UserDetail']['card_number']))
						{

						$cc_num = $user_data['UserDetail']['card_number'];

						echo "**** **** ****&nbsp;".substr($cc_num,-3);
						}
						?><br>
						<span>
							<?php 
							if(!empty($user_data['UserDetail']['expire_month']) && !empty($user_data['UserDetail']['expire_year']))
							{
							echo "Valid&nbsp;".$user_data['UserDetail']['expire_month'].'/'.$user_data['UserDetail']['expire_year'];
							}
							?>
						</span>
					</p>
					</div>
					<div class="ac-dtl">
						<h4>Your Bank Account</h4>
						<p><span>Bank :</span><?php echo $user_data['UserDetail']['bank_name'] ?><br>
						<span>Account No :</span><?php echo $user_data['UserDetail']['account_number'] ?></p>
					</div>
				</div>
				<div class="stream-details-box">
					<div class="full-box border-none pad20">
						<h3 class="heading" style="font-size:24px;">Payment Options</h3>
					</div>

					<div class="full-box_2">
						<div class="account_list">
						<p><?php echo $this->Html->image('Front/paypal.png'); ?> &nbsp; Paypal
						<span><?php echo $user_data['UserDetail']['paypal_email'] ?> &nbsp;
						<?php //echo $this->Html->link($this->Html->image('Front/cross.png'),"#",array('escape'=>false)); ?>
						<a href="javascript:;" data-toggle="modal" data-target="#bank_pay_edit"><?php echo $this->Html->image('Front/edit.png',array('alt'=>'edit','title'=>'edit','width'=>20,'height'=>20)); ?>		</a>
						</span></p>
						</div>
					</div>
				</div>
				
				<div class="stream-details-box">
					<div class="full-box border-none pad20">
						<h3 class="heading" style="font-size:24px;">Connected Services</h3>
					</div>
					<div class="full-box_2">
						<div class="account_list">
						<p><?php echo $this->Html->image('Front/linkdin.png') ?> &nbsp; Linkedin
						<span>
						<?php 
						if($user_data['User']['linkedin_verified_status'] == "1" && !empty($user_data['User']['linkedin_id'])){
							echo $this->Html->link('<i class="glyphicon glyphicon-ok"></i>','javascript:;',array('escape'=>false,'title'=>'verified','alt'=>'verified'));
						}else{
							echo $this->Html->link('<i class="glyphicon glyphicon-remove"></i>',array('controller' => 'users', 'action' => 'linkedin_verification'),array('escape'=>false,'title'=>'not verified','alt'=>'not verified'));
						}
						?>
						</span></p>
						</div>
					</div>
					<div class="full-box_2">
						<div class="account_list">
						<p><?php echo $this->Html->image('Front/facebook.png') ?> &nbsp; Facebook
					
						<span>
						<?php 
						if($user_data['User']['facebook_verified_status'] == "1" && !empty($user_data['User']['fb_id']) ){
							echo $this->Html->link('<i class="glyphicon glyphicon-ok"></i>','javascript:;',array('escape'=>false,'title'=>'verified','alt'=>'verified'));
						}else{ ?>
							<a href="javascript:;" class="fb_login" alt="not verified" title="not verified"  onclick="fbVerifification();"><i class="glyphicon glyphicon-remove"></i></a>
						<?php }
						?>
						</span></p>
						</div>
					</div>
					<div class="full-box_2 border-none_1">
						<div class="account_list">
						
						
						
						<p><?php echo $this->Html->image('Front/twitter.png') ?> &nbsp; Twitter
						<span>	
							<?php 
							if($user_data['User']['twitter_verified_status'] == "1" && !empty($user_data['User']['twitter_id'])){
								echo $this->Html->link('<i class="glyphicon glyphicon-ok"></i>','javascript:;',array('escape'=>false,'title'=>'verified','alt'=>'verified'));
							}else{
								echo $this->Html->link('<i class="glyphicon glyphicon-remove"></i>',array('controller' => 'users', 'action' => 'twitter_verification'),array('escape'=>false,'title'=>'not verified','alt'=>'not verified'));
							}
							?>
						</span>
						
						
						</p>
						</div>
					</div>
				</div>

				
				

				<!--
				<div class="stream-details-box">
					<div class="full-box border-none pad20">
						<h3 class="heading" style="font-size:24px;">Stripe Payment history</h3>
					</div>

					<div class="full-box_2">
						<div class="account_list">
						<p>
							<span>
								<div class="panel-body">
								<div class="list-group">
										<div title="Jul  7, 2016 action taken by " class="list-group-item"> 
										<div class="row">
										<div class="col-md-2 ">Price</div>
										<div class="col-xs-6 col-md-4">Transaction ID</div>
										<div class="col-xs-6 col-md-4">Date</div>
										</div>
										</div>
									<div class="list-group" style="max-height:330px;overflow-y:auto;">
										<div title="Jul  7, 2016 action taken by " class="list-group-item"> 
										<div class="row">
										<div class="col-md-2 ">$50</div>
										<div class="col-xs-6 col-md-4">#AQERT123456</div>
										<div class="col-xs-6 col-md-4">2015,May 10</div>
										</div>
										</div>
										<div title="Jul  7, 2016 action taken by " class="list-group-item"> 
										<div class="row">
										<div class="col-md-2 ">$50</div>
										<div class="col-xs-6 col-md-4">#AQERT123456</div>
										<div class="col-xs-6 col-md-4">2015,May 10</div>
										</div>
										</div>
										<div title="Jul  7, 2016 action taken by " class="list-group-item"> 
										<div class="row">
										<div class="col-md-2 ">$50</div>
										<div class="col-xs-6 col-md-4">#AQERT123456</div>
										<div class="col-xs-6 col-md-4">2015,May 10</div>
										</div>
										</div>
										<div title="Jul  7, 2016 action taken by " class="list-group-item"> 
										<div class="row">
										<div class="col-md-2 ">$50</div>
										<div class="col-xs-6 col-md-4">#AQERT123456</div>
										<div class="col-xs-6 col-md-4">2015,May 10</div>
										</div>
										</div>
										<div title="Jul  7, 2016 action taken by " class="list-group-item"> 
										<div class="row">
										<div class="col-md-2 ">$50</div>
										<div class="col-xs-6 col-md-4">#AQERT123456</div>
										<div class="col-xs-6 col-md-4">2015,May 10</div>
										</div>
										</div>
										<div title="Jul  7, 2016 action taken by " class="list-group-item"> 
										<div class="row">
										<div class="col-md-2 ">$50</div>
										<div class="col-xs-6 col-md-4">#AQERT123456</div>
										<div class="col-xs-6 col-md-4">2015,May 10</div>
										</div>
										</div>
										<div title="Jul  7, 2016 action taken by " class="list-group-item"> 
										<div class="row">
										<div class="col-md-2 ">$50</div>
										<div class="col-xs-6 col-md-4">#AQERT123456</div>
										<div class="col-xs-6 col-md-4">2015,May 10</div>
										</div>
										</div>
										<div title="Jul  7, 2016 action taken by " class="list-group-item"> 
										<div class="row">
										<div class="col-md-2 ">$50</div>
										<div class="col-xs-6 col-md-4">#AQERT123456</div>
										<div class="col-xs-6 col-md-4">2015,May 10</div>
										</div>
										</div>
										<div title="Jul  7, 2016 action taken by " class="list-group-item"> 
										<div class="row">
										<div class="col-md-2 ">$50</div>
										<div class="col-xs-6 col-md-4">#AQERT123456</div>
										<div class="col-xs-6 col-md-4">2015,May 10</div>
										</div>
										</div>
										<div title="Jul  7, 2016 action taken by " class="list-group-item"> 
										<div class="row">
										<div class="col-md-2 ">$50</div>
										<div class="col-xs-6 col-md-4">#AQERT123456</div>
										<div class="col-xs-6 col-md-4">2015,May 10</div>
										</div>
										</div>
										
									</div>
								</div>
								</div>
							</span>
						</p>
						</div>
					</div>
				</div> -->
			
			
			</div>
			<div class="col-md-6" style="position: relative;" id="dasboard_video">

			<?php if(isset($streaming_guide_pdf) && !empty($streaming_guide_pdf)){
			
			echo $this->Html->link($this->Html->image('Front/video_bg_with_logo.jpg'),SITE_URL.'uploads/stream_guide/'.$streaming_guide_pdf,array('escape'=>false,'title'=>'Download Streaming Guide','alt'=>'Download Streaming Guide','target'=>'blank'));
			echo $this->Html->link('Download Streaming Guide',SITE_URL.'uploads/stream_guide/'.$streaming_guide_pdf,array('target'=>'blank'));
			}else{
			
			echo $this->Html->image('Front/video_bg_with_logo.jpg');
			
			
			}?>

			
<?php
/* 
			
				<video style="width:100%;height:auto;margin:43px 0 0;" controls  src="<?php echo SITE_URL ?>video/OBS_YOOHCAN.mp4" type="video/mp4" 
				id="player4"  
				controls="controls" preload="none" ></video>
				<div class="default_play_pause_box default_play_pause_box_dashboard">	
					<?php echo $this->Html->image('Front/play_btn_new.png', array('title'=>'play','alt'=>'play','class'=>'default_play_pause_btn')) ?>
				</div>
				 */?>
				
			</div>
		</div>
	</div>
</div>
<?php echo $this->element('/Front/footer'); ?>


<div class="modle_popup">
<div class="modal md1 fade in" id="user_image_error" role="dialog">
    <div class="modal-dialog md-width">
    
      <!-- Modal content-->
      <div class="modal-content md-content">
        <div class="modal-header md-header">
         <button type="button" style="top:70px;right:0px;z-index:9 !important;" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Alert</h4>
        </div>
        <div class="modal-body md-body">
			<p  style="align:center;color: #354052;font-family: 'ProximaNovaA-Regular';font-size: 16px;font-weight: 600;" id="user_image_error_msg"></p>
        </div>
      </div>
      
    </div>
  </div>
</div>




<div class="modal md1 fade in general_info_cl_edit" id="general_info_edit" role="dialog">
	<div class="modal-dialog md-width">
    <!-- Modal content-->
	<div class="modal-content md-content">
		<div class="modal-header md-header">
		  <h4 class="modal-title">User Info Edit</h4>
			
		  <div class="delete_btn"><button type="button" class="close" style="right:1px" data-dismiss="modal">×</button></div>
		</div>
		<div class="modal-body md-body" id="general_info_detail">	
		<?php echo $this->element('/Front/User/general_info_edit'); ?>
		</div>
	</div>
    </div>
</div>

<div class="modal md1 fade in" id="cc_pay_edit" role="dialog">
	<div class="modal-dialog md-width">
    <!-- Modal content-->
	<div class="modal-content md-content">
		<div class="modal-header md-header">
		  <h4 class="modal-title">Credit Card Account Details</h4>
			
		  <div class="delete_btn"><button type="button" class="close" style="right:1px" data-dismiss="modal">×</button></div>
		</div>
		<div class="modal-body md-body" id="cc_account_detail">	
		<?php echo $this->element('/Front/User/cc_account_detail'); ?>
		</div>
	</div>
    </div>
</div>


<div class="modal md1 fade in" id="bank_pay_edit" role="dialog">
	<div class="modal-dialog md-width">
    <!-- Modal content-->
	<div class="modal-content md-content">
		<div class="modal-header md-header">
		  <h4 class="modal-title">Bank Account Details</h4>
			
		  <div class="delete_btn"><button type="button" class="close" style="right:1px" data-dismiss="modal">×</button></div>
		</div>
		<div class="modal-body md-body" id="bank_account_detail">			
		<?php echo $this->Element('/Front/User/bank_account_detail'); ?>
		</div>
	</div>
    </div>
</div>

<script>



$(document).on('click',".default_play_pause_btn",function(){ 

	var myVideo=document.getElementById("player4"); 
	if (myVideo.paused)
	{
		$('.default_play_pause_box').css('display','none');
		myVideo.play();
	}
	else 
	{
		myVideo.pause(); 
	}
})

var myVideo=document.getElementById("player4"); 

function playPause()
{ 
	if (myVideo.paused)
	{	
		$('.default_play_pause_box').css('display','none');
		myVideo.play();
	}
	else 
	{
		myVideo.pause(); 
	} 
}




	$('#UserDetailCardNumber').keyup(function() {
	  var foo = $(this).val().split("-").join(""); // remove hyphens
	  if (foo.length > 0) {
		foo = foo.match(new RegExp('.{1,4}', 'g')).join("-");
	  }
	  $(this).val(foo);
	});

		$('body').delegate('.lcs_check', 'lcs-statuschange', function() {
			var checked_val = ($(this).is(':checked')) ? 'checked' : 'unchecked';
			var name_val = $(this).attr('data-filed_type');
			
			$.ajax({
			type: "POST",
			url: "<?php echo $this->Html->url(array("controller"=>"users","action"=>"notification")) ;?>",
			data: {checked_val : checked_val,name_val : name_val}, // serializes the form's elements.
			success: function(data)
			{		
				
			}
			});
			
			
		});
	 $(function() {
		$("input[type='checkbox']").change(function() {
			
			
			
		})
	  })
 $(document).ready(function(){
	var $modal = $('.general_info_cl_edit');
	$('#general_info_link').on('click', function(){ 
	// $('.loading_bank_channel').css('visibility','visible');
	var _this = this
	var stream_id = $(_this).attr("name");
		$.ajax({
			type: "POST",
			url: '<?php echo $this->Html->Url(array('controller'=>'users','action'=>'general_info_edit'))?>',
			success: function(data)
			{	
			 $("#general_info_detail").html(data);
				$modal.modal('show');
			}
		});
	});
});

$(document).on('click','#general_info_submit',function(){
	$('#loading_stream_img').css('visibility','visible');
	 $.ajax({
	   type: "POST",
	   url: "<?php echo $this->Html->url(array("controller"=>"users","action"=>"general_info_edit")) ;?>",
	   data: $("#general_info_form").serialize(), // serializes the form's elements.
	   success: function(data)
	   {		
		   $("#general_info_detail").html(data); // show respsonse from the php script.
			
	   }
	 });
});


/* 	$(document).ready(function(){
		 $(function(){  
			$('#general_info_edit').on('click', function (e) {
			  $('.alert').remove();
			  $('.error-message').remove();
			});
			
		});
	}); */

	$(document).ready(function(){
		 $(function(){  
			$('#cc_pay_edit').on('click', function (e) {
			  $('.alert').remove();
			  $('.error-message').remove();
			});
			
		});
	});
	$(document).ready(function(){
		
		 $(function(){  
			$('#bank_pay_edit').on('click', function (e) {
			  $('.alert').remove();
			  $('.error-message').remove();
			});
			
		});
	});

		
	$(document).on('click','#cc_submit',function(){
		 $('#loading_cc_img').css('visibility', 'visible');
		  $.ajax({
		   type: "POST",
		   url: "<?php echo $this->Html->url(array("controller"=>"users","action"=>"cc_account_detail")) ;?>",
		   data: $("#account_detail_form").serialize(), // serializes the form's elements.
		   success: function(data)
		   {
				
			   $("#cc_account_detail").html(data); // show respsonse from the php script.
				
		   }
		 });
	});

	$(document).on('click','#bank_submit',function(){
		$('#loading_bank_img').css('visibility', 'visible');
		 $.ajax({
		   type: "POST",
		   url: "<?php echo $this->Html->url(array("controller"=>"users","action"=>"bank_account_detail")) ;?>",
		   data: $("#bank_account_detail_form").serialize(), // serializes the form's elements.
		   success: function(data)
		   {		
			   $("#bank_account_detail").html(data); // show respsonse from the php script.
			  
		   }
		 });
	});
</script>

<script type="text/javascript" src="http://connect.facebook.net/en_US/all.js"></script>
<div id="fb-root"></div>
<script type="text/javascript">

	function video_player_align()
	{
		
		video_height = $("#dasboard_video").height();
		$(".default_play_pause_box").css('padding-top',parseInt(video_height/2) + 'px');
		$(".default_play_pause_btn").css('margin-top','-34px');
		
	}
	
	$( window ).resize(function() {
		video_player_align();
	});
	


	$(document).ready(function(){
		video_player_align();
	
		
		

	})


	function fbVerifification(){
		FB.init({appId: "<?php echo Configure::read("FACEBOOK_APP_ID");?>", status: true, cookie: false, xfbml: true});
		var response="";
		FB.login(function(response) 
		{
			if (response.authResponse) 
			{
				FB.api('/me', { locale: 'en_US', fields: 'id,first_name,last_name,name, email' }, function(response)
				{
					var uid=response.id;
					if(uid > 1)
					{	
						fb_verification_data(response);
					}
				});
			}
		}, {
		scope:'email,user_friends'
		}); 
	}

	function fb_verification_data(response)
	{
		jQuery.ajax({
			type:'POST',	
			url: "<?php echo $this->Html->url(array('controller'=>'users', 'action'=>'fbVerificationData'));?>",
			data:response,
			beforeSend:function(xhr){
			},
			success: function(data){
				window.location.href = "<?php echo $this->Html->url(array('controller'=>'users', 'action'=>'dashboard'));?>";	
				
			}
		});
	}	
	
	$("#foggetLink").click(function(){        
         $('#loginModal').modal('hide');
    });
	
	
</script>


