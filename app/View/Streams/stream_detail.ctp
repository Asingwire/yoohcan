<?php echo $this->Html->script('nicescroll.min'); ?>
<div class="right-contant">
    <span class="chat-slide"><?php echo $this->Html->link($this->Html->image('Front/open-chat.png'),'javascript:;',array('escape'=>false)); ?></span>
  <div class="channels-slide streams01">
    <div class="bottom_recorded secound-option strm-mid-sec">
      <div class="row">
      <div class="streaming-mid col-md-8">
	   <?php echo $this->Session->flash(); ?>
      <div class="strem_vdo text-center">
	  <?php //echo $this->Html->image('Front/chat-video.jpg') ?>
	  
		<?php
		if(!empty($stream_detail))
		{
		?>
		<div id='wowza_player'></div>
		<script id='player_embed' src='//player.cloud.wowza.com/hosted/<?php echo $stream_detail['Stream']['player_id']; ?>/wowza.js' type='text/javascript'></script>
		
		
		
		<div style="margin-top:20px;float:left;width:33%;" class="share_button">	
		
		<?php /* echo $this->Html->link('<span class="follow-cls" >Share</span>','javascript:;',array("id"=>"share_popup",'escape'=>false,'alt'=>'Channel','title'=>'','style'=>'color:#3d3d3d;')); */ ?>
		</div>
		
		<?php /* ?>
		
		<div class="container"  style="margin-top:20px;float:right;width:33%">
			<?php
			if($this->Session->check('Auth.User.id'))
			{
				$user_id = $this->Session->read('Auth.User.id');
				if($user_id != $stream_detail['Stream']['user_id'] && $channel_subscribe_check_user == 0)
				{
			?>
				
				<div id="subscribe_channel_div"><a href="javascript:;" id="subscribe_channel"><span class="follow-cls" >Subscribe</span></a></div>
			
				<?php
				}
				elseif($user_id != $stream_detail['Stream']['user_id'] && $channel_subscribe_check_user > 0)
				{
					echo "<div id='subscribe_channel_div'><a href='javascript:;' id='already_subscribe'><span class='follow-cls' >Subscribed</span><a></div>";
				}
				
				?>
			<?php
			}
			else
			{
			?>
				<div style="float:right">
				<a href="javascript:;" data-toggle="modal" data-target="#loginModal"><span class="follow-cls" >Subscribe</span><a>
				</div>
			<?php	
			}
			?>
		</div>
		
		<?php */ ?>
		
		
		
		<?php
		}  ?>
	  </div>
	  <?php //echo $this->Html->link('Payment',array('controller'=>'Subscriptions','action'=>'payment'),array('escape'=>false,'alt'=>'Channel','title'=>'Channel')); ?>
	 
	
	
	
	 
	   <div id="share_detail" class="hide" >
			<div>
			<?php
				$pageLink = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
				$pageLinkNew = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
			?>
			<?php $videoLink =  "<div id='wowza_player'></div><script id='player_embed' src='//player.cloud.wowza.com/hosted/".$stream_detail['Stream']['player_id']."/wowza.js' type='text/javascript'></script>"; ?>
		
				<div style="float:left;">
					<iframe src="https://www.facebook.com/plugins/like.php?href=http%3A%2F%2F<?php echo $pageLinkNew; ?>%2F&width=63&layout=button_count&action=like&size=small&show_faces=true&share=false&height=21&appId=1273220112712745" width="63" height="21" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
				</div>
				<div style="float:right;">
					<a href="https://twitter.com/share" class="twitter-share-button" data-show-count="false">Tweet</a><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
				</div>
				
				<div style="padding-top:25px;">
				
				<label style='color:#3d3d3d;'>Channel Link:</label>
				<input type="email" name="email" id="email" class="form-control input-md" value="<?php echo $pageLink; ?>">
				<label for="name" style='color:#3d3d3d;'>Embed Code:</label>
				<input type="text" name="name" id="name" class="form-control input-md"  value="<?php echo $videoLink; ?>" >
				</div>
				
			</div>		
		</div>
		
		
		
		<div class="row">
			<div class="col-md-12" style="padding:15px 0 0 0">
				<div class="col-md-10">
					<div class="row">
					<div class="clearfix"></div>
					<div class="strm-dtl-top">
						<div class="user-img-div">
							<div class="usr-img">
							
								<?php $user_name = substr($stream_detail['User']['nickname'],0,6).".";
									$image		=	$stream_detail['User']['profile_image'];
									$imagePath		=	IMAGE_PATH_FOR_TIM_THUMB.'/'.PROFILE_IMAGE_FULL_DIR.'/';

									if($image &&  file_exists(WWW_ROOT.PROFILE_IMAGE_FULL_DIR.DS.$image )) {
										echo $this->Html->image(SITE_URL.'/timthumb.php?src='.$imagePath.$image.'&w=50&h=50&a=t',array('alt'=>$user_name,'title'=>$user_name,'class'=>'user-img'));
									}
									else
									{
										echo $this->Html->image('Admin/avatar5.png', array('width'=>'50','height'=>'50','alt'=>'no image','title'=>'no image','class'=>'user-img'));
									}
								?>
							
							
								
							</div>
						</div>
						<div class="col-md-11 user_detail">
							<span class="user_detail_tit"><?php echo $stream_detail['Stream']['title'] ?></span>
							<div class="col-md-12 streming_detail_duratins">
							<span class="user_detail_by">Stream by:</span>
							<span class="stream_user_name">
							<?php echo $stream_detail['User']['nickname']; ?>
							</span>
							
							
							 <?php /* Date Recorded by  <?php echo date('M d,Y',strtotime($stream_detail['Stream']['created'])); ?> */ ?>
							</div>
						</div>									
					</div>
					<div class="col-md-9 streming_detail_discription streming_detail_discription_in">
						<p><?php echo $stream_detail['Stream']['stream_bio'] ?><br>
						<br>
						<?php if(isset($stream_detail['Channel']['website']) && !empty($stream_detail['Channel']['website'])){ ?>
							<span><?php echo $stream_detail['Channel']['website'] /* <a style="text-decoration:none;color:#999999" href="<?php echo $stream_detail['Channel']['website'] ?>" target="blank"><?php echo $stream_detail['Channel']['website'] ?></a> */ ?>
							 <?php //echo $this->Html->link($stream_detail['Channel']['website'],'http://'.$stream_detail['Channel']['website'],array('target'=>'_blank','escape'=>false,'alt'=>'Channel','title'=>'Channel')); ?>
							</span><br>						
 						<?php } ?>						
					</div>
					</div>
				</div>
				
				<div class="col-md-2 right_discription strm_dtl_right_discription">
					<ul>
					
					
						<?php if($this->Session->check('Auth.User.id') ){ ?>
						
						<?php } else { ?>
							
						<?php } ?>
						
						
						<li title="Total Unique Viewers"  alt="Total Unique Viewers" class="viewer" id="total_viewers_count"><?php echo $total_unique_viewers; ?></li>	
							<?php 
							  if($stream_detail['ChannelFollower']['is_follow'] == 0){
								$relValWall = 'Follow';
								$followClass = '';
							  }else{
								$relValWall = 'Following';
								$followClass = 'active';
							  }
							?>
						<?php if($this->Session->check('Auth.User.id') ){ ?>	
						
							<li  title="<?php echo $relValWall; ?>"  alt="<?php echo $relValWall; ?>"  class="follower   <?php echo $followClass;?> followPostCl_<?php echo $stream_detail['Stream']['id']; ?>" onclick="followStream('<?php echo $stream_detail['Stream']['id'] ?>','<?php echo $stream_detail['Stream']['channel_id']; ?>')" style="cursor:pointer;" rel="<?php echo $relValWall; ?>" id="follower_li">
								<?php 
								echo $this->Html->link($streamCountData,"javascript:;", array("id"=>"countUpdate",'escape'=>false,'style'=>'color:#fff;'));	
								?>
							</li>
							
						<?php } else { ?>
						
							<li  class="follower" style="cursor:pointer;" data-toggle="modal"  data-target="#loginModal" title="Follow"  alt="Follow">
								<?php 
									echo ($this->Html->link($streamCountData, 'javascript:;', array("id"=>"countUpdate",'escape'=>false,'class'=>'','style'=>'color:#fff;')));
								?>
							</li>
							
						<?php } ?>
						
						<li  style="cursor:pointer;" class="share" title="Share" alt="Share"><?php echo $this->Html->link('<p >SHARE</p>','javascript:;',array("id"=>"share_popup",'escape'=>false,'alt'=>'Channel','title'=>'','style'=>'color:#3d3d3d;')); ?></li>
						<li  style="padding-left:9px !important;cursor:pointer !important;" title="donate" alt="donate">
						
						<?php
						if($this->Session->check('Auth.User.id') ){
						
						echo $this->Html->link($this->Html->image('Front/paypal_donate.png',array('title'=>'Donate','width'=>120,'height'=>70,'escape'=>false)),array('controller'=>'streams','action'=>'donate_for_stream',$stream_detail['Stream']['id']),array('class'=>'submit_button','escape'=>false));
						}
						else
						{
							echo $this->Html->link($this->Html->image('Front/paypal_donate.png',array('title'=>'Donate','id'=>'donate_button_stream','width'=>120,'height'=>70,'escape'=>false)),"#",array('class'=>'submit_button','escape'=>false));
						}	
						?>
						</li> 
					</ul>
				</div>
	  
			</div>	
		</div>	
		
		
   
	 <h1>RELATED VIDEOS</h1>
	 <?php
	if(!empty($related_recorded_stream_listing))
	{
		
	?>
     <ul class="channel_list">
	
	<?php
	
		foreach($related_recorded_stream_listing as $key=>$value)
		{
		?>
			<li><?php //echo $this->Html->link($this->Html->image('Front/channel-img.jpg'),array('controller'=>'streams','action'=>'recorded_stream_detail',$value['RecordingStream']['id']),array('escape'=>false));
			$recordingPath		=	IMAGE_PATH_FOR_TIM_THUMB.RECORDING_IMAGE_FULL_DIR."/";
			$recording_image		=	$value['RecordingStream']['image'];
			if($recording_image &&  file_exists(WWW_ROOT.RECORDING_IMAGE_FULL_DIR.DS.$recording_image )) {	
				
				echo $this->Html->link($this->Html->image(SITE_URL.'/timthumb.php?src='.$recordingPath.$recording_image.'&w=251&h=144&a=t',array('title'=>$value['RecordingStream']['title'],'alt'=>$value['RecordingStream']['title'])),array('controller'=>'streams','action'=>'recorded_stream_detail',$value['RecordingStream']['id']),array('escape' => false,'title'=>$value['RecordingStream']['title'],'alt'=>$value['RecordingStream']['title'])); 
			
			}
			else
			{
				echo $this->Html->link($this->Html->image('Front/channel-img.jpg'),array('controller'=>'streams','action'=>'recorded_stream_detail',$value['RecordingStream']['id']),array('alt'=>$value['RecordingStream']['title'],'title'=>$value['RecordingStream']['title'],'escape'=>false));	
			}	
			?>
			
			
			
			</li>
		<?php
		}
	}
	else
	{
		echo $this->Element('no_record_found',array('message'=>'No videos found.'));
	}
	?>
	
   </ul>
    </div>
    
      <div class="col-md-4"></div>
      </div>
	  </div>
  </div>


 <!--chat-start-->
  <div class="chat-part col-md-4 shift-chat">
  <div class="chat-part-whole">
  
 <div class="top-btns">
    <span class="close-btn"><?php echo $this->Html->link($this->Html->image('Front/close-chat.png'),'javascript:;',array('escape'=>false)); ?></span> 
   <span class="elips">&nbsp;</span> 
 </div>
 <div class="chat-itms">
	<?php 
	if(isset($stream_detail['Message']) && !empty($stream_detail['Message']) )
	{
		foreach($stream_detail['Message'] as $message_key=>$message_value)
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
							</div>'; */
							
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
						<img alt="" src="'.$profile_image.'"><p><span class="chat_user_name">'.$message_value['User']['nickname'].'</span><span style="display:block;">'.$message_value['message'].'</span></p>
						</div>';
				
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
<div class="modal md1 fade in" id="channel_box" role="dialog">
    <div class="modal-dialog md-width">
    
      <!-- Modal content-->
      <div class="modal-content md-content">
        <div class="modal-header md-header">          
          <h4 class="modal-title">Subscribe Channel</h4>
		   <div class="delete_btn"><button type="button" class="close" style="right:1px" data-dismiss="modal">×</button></div>
        </div>
		
		<div id="channel_data" class="modal-body md-body">
			<?php echo $this->Element('/Front/Streams/channel_info_subscribe'); ?>
		</div>
		</div>
      
    </div>
 </div>
<?php echo ($this->element('Front/footer'))?>





 <?php echo $this->Html->script('moment.min'); ?>
<script src="<?php echo SITE_HOST; ?>:3000/socket.io/socket.io.js"></script>
<?php
if($this->Session->check('Auth.User.id'))
{
?>
<?php

$imagePath	=	IMAGE_PATH_FOR_TIM_THUMB.'/'.PROFILE_IMAGE_FULL_DIR.'/';
$image		=	$user_detail['User']['profile_image'];	
$userName   = $user_detail['User']['nickname'];

$streamId = $stream_detail['Stream']['id'];
$streamKey = $stream_detail['Stream']['stream_key'];
$userId	 = $this->Session->read('Auth.User.id');
if($image &&  file_exists(WWW_ROOT.PROFILE_IMAGE_FULL_DIR.DS.$image )) {
	$profile_image = SITE_URL.'/timthumb.php?src='.$imagePath.$image.'&w=57&h=57&a=t';
} else {					
	
	
	$profile_image =  SITE_URL.'/timthumb.php?src='.SITE_URL.'/img/Admin/avatar5.png&w=57&h=57&a=t';
}

?>
   
<script text="type/javascript">		
	

	name = '<?php echo $user_detail['User']['nickname']; ?>';
	 img = "<?php echo $profile_image; ?>";
	loginuserId = "<?php echo $userId; ?>";
	
	
	<!-- chat start -->
	//var socket = io.connect("http://192.168.1.16:3000");
	var socket = io.connect("<?php echo SITE_HOST; ?>:3000");
    socket.emit('join_room_stream', {id: '<?php echo $streamKey; ?>',streamId:'<?php echo $streamId; ?>', image: '<?php echo $image; ?>',username: name});
	
	var chatForm = $("#chatform"),
		textarea = $("#message"),
		messageTimeSent = $(".chat-time"),
		chats = $(".chat-itms");
	
	textarea.keypress(function(e) {

		// Submit the form on enter

		if (e.which == 13) {
			e.preventDefault();
			chatForm.trigger('submit');
		}

	});
	
	chatForm.on('submit', function(e) {
		e.preventDefault();

		// Create a new chat message and display it directly

		//showMessage("chatStarted");

		if (textarea.val().trim().length) {
			createChatMessage(textarea.val(), name, img, moment());
			//scrollToBottom();
			chatScrlBtm();

			// Send the message to the other person in the chat
			socket.emit('msg_stream', {msg: textarea.val(), SenderId: '<?php echo $userId; ?>', user: '<?php echo $userName; ?>', img: img,  streamId: '<?php echo $streamId; ?>',id:'<?php echo $streamKey; ?>'});


		}
		// Empty the textarea
		textarea.val("");
	});
	
	
	socket.on('receive_stream', function(data) {
				
			console.log(data);	
			
		
			
		
		 
		  if ($('div.chat-itms>div.cht-prsn').length=='0'){
			 
			var who = '';
			if(data.SenderId == loginuserId)	
			{
				who = 'cht-prsn reply-prsn';
				var div = $(
				'<div class="cht-prsn reply-prsn">'+
				'<p><span class="chat_user_name">'+data.user+'</span><span style="display:block;">'+data.msg+'</span></p>'+
				'</div>'
				)
			}
			else
			{
				who = 'cht-prsn';
				
				var div = $(
				'<div class="cht-prsn">' + '<img src=' + data.img + ' />'+
				'<p><span class="chat_user_name">'+data.user+'</span><span style="display:block;">'+data.msg+'</span></p>'+
				'</div>'
				)
			}
			
			chats.append(div);
			//scrollToBottom();
			chatScrlBtm();
		
		 }
	   else {     
	
			if (data.msg.trim().length) {
			createChatMessage(data.msg, data.user, data.img, moment());
			//scrollToBottom();
			chatScrlBtm();
			}   
	   }	  
	});

	
	
	function chatScrlBtm(){
	
	//var height = $('.chat-itms').height();
	//$('.chat-itms').animate({scrollTop: height});
	var wtf    = $('.chat-itms');
	  var height = wtf[0].scrollHeight;
	  wtf.animate({scrollTop: height});
	  //wtf.scrollTop(height);
	}
				
	
	


	function scrollToBottom() {
		$("html, body").animate({scrollTop: $(document).height() - $(window).height()}, 1000);
	}
	
	function createChatMessage(msg, user, imgg, now) {
					
	
		var who = '';

		if (user === name) {
			who = 'cht-prsn reply-prsn';
			
			var div = $(
			'<div class="cht-prsn reply-prsn">'+
			'<p></p>'+
			'</div>'
			)
		}
		else {
			
			who = 'cht-prsn';
			
			var div = $(
			'<div class="cht-prsn">' + '<img src=' + imgg + ' />'+
			'<p></p>'+
			'</div>'
			)
			
		}
		
		//div.find('p').html(msg+'<span class="chat-time timesent" time=' + moment().unix() + '></span>');
		div.find('p').html(msg);
		//div.find('b').text(user);
		chats.append(div);
		//messageTimeSent = $(".timesent");
		messageTimeSent = $(".chat-time");
		messageTimeSent.last().text(now.fromNow());
		//var each = $(this).attr('time');
		//messageTimeSent.last().html(now.fromNow());
		//messageTimeSent.last().html(moment.unix(parseInt(each)).fromNow());
	}			
	
	/*setInterval(function(){
		
		messageTimeSent.each(function(){
			var each = $(this).attr('time');
			$(this).text(moment.unix(parseInt(each)).fromNow());
			
		});
		
	},3000);*/
	
</script>
<?php
}
?>

<script type="text/javascript">	
	
	//window.onload = function () { chatScrlBtm(); }
	$(window).bind("load", function() {
		var wtf    = $('.chat-itms');
	  var height = wtf[0].scrollHeight;
	  wtf.animate({scrollTop: height});
	});
	
	
	
	
	
		$(document).ready(function(){
		setInterval(
			function(){
				$.ajax({
					url: "<?php echo $this->Html->url(array('controller'=>'streams','action'=>'update_stream_unique_viewers',$stream_detail['Stream']['id'])); ?>",
					success: function(result){
						obj = jQuery.parseJSON(result);
						$("#total_viewers_count").html(obj.total_unique_viewers);
					}
				});
			}, 
			5000
		);
		$("#without_login_message").keypress(function(e) {

		// Submit the form on enter

			if (e.which == 13) {
				$('#loginModal').modal('show');
				return false
			}

		});
		
		
		$("#donate_button_stream").click(function() {
			$('#loginModal').modal('show');
			return false;
		});
		
		
		$(".chat-itms").niceScroll().resize();
		 
		/* $(document).on('click','#subscribe_channel',function(){	
			$('#channel_box').modal('show');
			
		}); */
		
	
	
		
		
		
		
		/* 
		$(document).on('click','#chanel_subscribe_submit',function(){
			 $('#loading_channel_subscribe_img').css('visibility', 'visible');
			$.ajax({
			   type: "POST",
			   url: "<?php echo $this->Html->url(array("controller"=>"channels","action"=>"subscribe")) ;?>",
			   async: false,
			   data:{channel_id:'<?php echo $stream_detail['Channel']['id']; ?>',stream_id:'<?php echo $stream_detail['Stream']['id']; ?>'}, // serializes the form's elements.
			   success: function(data)
			   {		
				   //$("#channel_data").html(data); // show respsonse from the php script.
				  if(data == 1)
				  {
					$('#loading_channel_subscribe_img').css('visibility', 'hidden');
					$("#subscribe_channel_div").html("<a href='javascript:;' id='already_subscribe'><span class='follow-cls' >Subscribed</span><a>");
					$('#channel_box').modal('hide');
				  }
				  
					
			   }
			 });
		});
		
		
		$(document).on('click','#already_subscribe',function(){
			
			$.ajax({
			   type: "POST",
			   url: "<?php echo $this->Html->url(array("controller"=>"channels","action"=>"unsubscribe")) ;?>",
			   async: false,
			   data:{channel_id:'<?php echo $stream_detail['Channel']['id']; ?>',stream_id:'<?php echo $stream_detail['Stream']['id']; ?>'}, // serializes the form's elements.
			   success: function(data)
			   {		
				   //$("#channel_data").html(data); // show respsonse from the php script.
				  if(data == 1)
				  {
					$('#loading_channel_subscribe_img').css('visibility', 'hidden');
					$("#subscribe_channel_div").html("<a href='javascript:;' id='subscribe_channel'><span class='follow-cls' >Subscribe</span><a>");
					$('#channel_box').modal('hide');
				  }
				  
					
			   }
			});
		}); */
		
		
		
		
	});




			
		//Follow Script
		function followStream(stream_id,channel_id) {
			
			var url = SITE_URL + 'streams/follow_ajax';
			var value = $('.followPostCl_' + stream_id).attr('rel');
			
			var stream_id = stream_id;
			var channel_id = channel_id;
			var status = value == 'Follow' ? '1' : '0';
			var param1 = new Object();
			param1.user_id = '<?php echo $this->Session->read('Auth.User.id'); ?>';
			param1.stream_id = stream_id;
			param1.channel_id = channel_id;
			param1.status = status;				
			$.ajax({
				url: url,
				type: "POST",
				async: false,
				data: {
					data: param1,
				},
				success: function (response) {
					
					obj = jQuery.parseJSON(response);	
					if (value == 'Follow') {
							$('.followPostCl_' + stream_id).attr('rel', 'Following');
							$('.followPostCl_' + stream_id).attr('title', 'Following');
							
							$("#follower_li").addClass('active');		
						} else if (value == 'Following') {
							
							$("#follower_li").removeClass('active');	
							$('.followPostCl_' + stream_id).attr('rel', 'Follow');
							$('.followPostCl_' + stream_id).attr('title', 'Follow');
							$('.reposttext_' + stream_id).text('Follow');							
						}
						
					$("#countUpdate").text(obj.response.count);	
					
				},
				error: function (request, status, error) {
					alert(error);
				}
			});
		}
		$(function(){
			$('#share_popup').popover({       
				placement: 'top',
				title: 'Channel',
				html:true,
				content:  $('#share_detail').html()
			});			
		})
</script>

