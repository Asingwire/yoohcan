<?php echo $this->Html->script('nicescroll.min'); ?>
<div class="right-contant" style="min-height:800px;"> 
<span class="chat-slide"><?php echo $this->Html->link($this->Html->image('Front/open-chat.png'),'javascript:;',array('escape'=>false)); ?></span>

 
	<div class="col-md-12 channel_detail">
		
		<?php $this->Layout->sessionFlash(); ?>
		<h3><?php //echo $title_for_layout; ?></h3>
		<?php echo ($this->Element('Front/User/left_sub_menu'));?>
		<!--<div class="tab-content">			
			
			<div class="table-responsive" style="float: left;margin-left: 14px;width: 50%;">
		
				<div class="col-md-12 streaming-box_70 set-left">
					<div class="row">
						<p class="hedding_in">My Streams </p>
						<span class="pull-right"><?php  echo ($this->Html->link('Add Stream', array('controller'=>'streams','action' => 'add'), array('escape' => false,'title'=>'start', 'type'=>'button', 'class'=>'btn btn-primary'))); ?></span>
					</div>
				</div>

		
			</div>
		</div>-->
		<div class="col-md-6">
			
			<div id="video_stream_top_controls_f"><span class="icons_f glyphicon glyphicon-play" aria-hidden="true"></span>     <span id="record_f" class="icons_f pull-right glyphicon glyphicon-record" aria-hidden="true"></span> </div>
			<br>
				<div id="video_stream_frame_f">

				<?php echo $this->Html->image('streaming.jpg', ['alt' => 'streaming', 'class' => 'img-responsive']); ?>	
			

				</div>
				<br>

			<div id="video_stream_bottom_controls_f">
				<select width="250" style="width: 250px">
  					<option>screen share select</option>
  					<option>1</option>
  					<option>2</option>
				</select>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<span class="icons_f glyphicon glyphicon-facetime-video" aria-hidden="true"></span>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<span class="icons_f glyphicon glyphicon-ice-lolly" aria-hidden="true"></span>				
				<span class="icons_f pull-right glyphicon glyphicon-cog" aria-hidden="true"></span>


			</div>
			<br>

			<div class="heading_f">Select Template</div>
			<br>
			<div>

				<label class="radio-inline">
  				<input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
  				<span class="icons_large_f glyphicon glyphicon-th-large" aria-hidden="true"></span>
				</label>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<label class="radio-inline">
  				<input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
  				<span class="icons_large_f glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
				</label>

			</div>

		</div>

		<!--chat-start-->
  <div class="chat-part col-md-4 shift-chat">
  <div class="chat-part-whole">
  
 <div class="top-btns">
    <span class="close-btn"><?php echo $this->Html->link($this->Html->image('Front/close-chat.png'),'javascript:;',array('escape'=>false)); ?></span> 
   <span class="elips">&nbsp;<?php //echo $this->Html->link($this->Html->image('Front/chat-elips.png'),'javascript:;',array('escape'=>false)); ?></span> 
 </div>
 <div class="chat-itms">
	<?php 
	if(isset($recorded_stream_detail['Message']) && !empty($recorded_stream_detail['Message']) )
	{
		foreach($recorded_stream_detail['Message'] as $message_key=>$message_value)
		{
		
			if(isset($message_value['User']['nickname']) && isset($message_value['User']['profile_image']))
			{
		
				$imagePath	=	IMAGE_PATH_FOR_TIM_THUMB.'/'.PROFILE_IMAGE_FULL_DIR.'/';
				$image		=	$message_value['User']['profile_image'];	
				if($image &&  file_exists(WWW_ROOT.PROFILE_IMAGE_FULL_DIR.DS.$image )) {
					$profile_image = SITE_URL.'/timthumb.php?src='.$imagePath.$image.'&w=57&h=57&a=t';
				} else {					
					
					
					$profile_image =  SITE_URL.'/timthumb.php?src='.SITE_URL.'/img/Admin/avatar5.png&w=57&h=57&a=t';
				}
			
			
				
				if($message_value['sender_id'] == $this->Session->read('Auth.User.id'))
				{
					/* echo '<div class="cht-prsn reply-prsn">
							<p>'.$message_value['message'].'
							<span class="chat-time" time="'.strtotime($message_value['created']).'">'.date('g a',strtotime($message_value['created'])).'</span></p>
							</div>';
							 */
					echo '<div class="cht-prsn reply-prsn">
							<p><span style="display:block;">'.$message_value['message'].'</span></p>
							</div>';		
				}
				else
				{
					/* echo '<div class="cht-prsn">
						<img alt="" src="'.$profile_image.'"><p>'.$message_value['message'].'<span class="chat-time" time="'.strtotime($message_value['created']).'">'.date('g a',strtotime($message_value['created'])).'</span></p>
						</div>'; */

					echo '<div class="cht-prsn">
						<img alt="" src="'.$profile_image.'"><p><span class="chat_user_name">'.$message_value['User']['nickname'].'</span><span style="display:block;">'.$message_value['message'].'</span></p></div>';		
				}
			}	
		}
	}
	?>
  
   </div>
   
   <form class="chat-form" id="chatform">
   <span class="text-outer">
   <?php
	if($this->Session->check('Auth.User.id'))
	{
	?>
    <input type="text" placeholder="Write here..." id="message"/>
	<?php
	}
	else
	{
	?>
		 <input type="text" placeholder="Write here..." id="without_login_message"/>
	<?php
	}
	?>
     <!--<label><?php //echo $this->Html->image('Front/attechment.png'); ?><input type="file" /></label>-->
    </span>
	<?php
	if($this->Session->check('Auth.User.id'))
	{
	?>
    <input type="submit" value="Send" />
	<?php
	}
	else
	{
	?>
	 <input type="button"  class="chat-form-button" value="Send" data-target="#loginModal" data-toggle="modal" />
	<?php
	}
	?>
   </form>
   </div>
  </div>
  <!--chat-end-->








	</div>
</div>
<?php echo $this->element('Front/footer'); ?>
