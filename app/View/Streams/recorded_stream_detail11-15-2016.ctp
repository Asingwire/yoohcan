<?php echo $this->Html->script('nicescroll.min'); ?>

<div class="right-contant">
    <span class="chat-slide"><?php echo $this->Html->link($this->Html->image('Front/open-chat.png'),'javascript:;',array('escape'=>false)); ?></span>
  <div class="channels-slide streams01">
    <div class="bottom_recorded secound-option">
      <div class="row">
      <div class="streaming-mid col-md-8">
      <div class="strem_vdo text-center">
		<?php //echo $this->Html->image('Front/chat-video.jpg') ?>
		<?php
		/* <video autoplay src="<?php echo $recorded_stream_detail['RecordingStream']['download_url']; ?>" type="video/mp4" 
		id="player1"  
		controls="controls" preload="none" style="width:100%;height:auto;margin-left:0;"></video> */
		?>
		
		<video id="myVideo" width="100%" height="auto" controls autoplay>
		  <source src="<?php echo $recorded_stream_detail['RecordingStream']['download_url']; ?>" type="video/mp4">
		  Your browser does not support HTML5 video.
		</video>
		
	  </div>
	  
	   <!--Follow-->
		<?php 
		//pr($recorded_stream_detail);die;
		  if($recorded_stream_detail['ChannelFollower']['is_follow'] == 0){
			$relValWall = 'Follow';
			$followClass = '';
		  }else{
			$relValWall = 'Following';
			$followClass = 'active';
		  }
		?>		
		<?php 
		/*<div class="container followPostCl_<?php echo $recorded_stream_detail['RecordingStream']['id']; ?>" rel="<?php echo $relValWall; ?>" style="margin-top:20px;">		
		<?php 
		if($this->Session->check('Auth.User.id') ){
			echo $this->Html->link('<span class="follow-cls reposttext_'.$recorded_stream_detail['RecordingStream']['id'].'">'.$relValWall.'</span>',"javascript:;", array( "onclick"=>"followStream('".$recorded_stream_detail['RecordingStream']['id']."','".$recorded_stream_detail['RecordingStream']['channel_id']."','".$recorded_stream_detail['RecordingStream']['stream_id']."');",'escape'=>false));
		} else {
			echo ($this->Html->link('<span class="follow-cls reposttext_'.$recorded_stream_detail['RecordingStream']['id'].'">Follow</span>', 'javascript:;', array('escape'=>false,'class'=>'',"data-toggle"=>"modal" ,"data-target"=>"#loginModal" )));
		}
		?>
		</div>
		*/ ?>
		<div style="margin-top:-41px;float:right;width:33%;" class="share_button">	
		
		<?php //echo $this->Html->link('<span class="follow-cls" >Share</span>','javascript:;',array("id"=>"share_popup",'escape'=>false,'alt'=>'Channel','title'=>'','style'=>'color:#3d3d3d;')); ?>
		</div>
		 <div id="share_detail" class="hide" >
			<div>
				<?php
					$pageLink = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
					$pageLinkNew = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
					
				?>
				<?php $videoLink =  "<iframe src='".$recorded_stream_detail['RecordingStream']['download_url']."' frameborder='0' scrolling='no' height='378' width='620'></iframe>"; ?>
				
				
					
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
							
								<?php 
								$streamPath = IMAGE_PATH_FOR_TIM_THUMB.PROFILE_IMAGE_FULL_DIR."/";
								$stream_user_image = $recorded_stream_detail['User']['profile_image'];

								echo $this->Html->image(SITE_URL.'/timthumb.php?src='.$streamPath.$stream_user_image.'&w=50&h=50&a=t',array('class'=>'','alt'=>$recorded_stream_detail['User']['nickname'],'title'=>$recorded_stream_detail['User']['nickname'],'class'=>'user-img'))
								?>							
							
								
							</div>
						</div>
						<div class="col-md-11 user_detail">
							<span class="user_detail_tit"><?php echo $recorded_stream_detail['RecordingStream']['title'] ?></span>
							<div class="col-md-12 streming_detail_duratins">
							<span class="user_detail_by">Stream by:</span>
							<span class="stream_user_name">
							<?php echo $recorded_stream_detail['User']['nickname']; ?>
							</span>
							
							
							 Date Recorded by  <?php echo date('M d, Y',strtotime($recorded_stream_detail['RecordingStream']['created'])); ?>
							</div>
						</div>									
					</div>
					<div class="col-md-9 streming_detail_discription streming_detail_discription_in">
						<p><?php echo $recorded_stream_detail['RecordingStream']['description'] ?><br>
						<br>
						<?php if(isset($recorded_stream_detail['Channel']['website']) && !empty($recorded_stream_detail['Channel']['website'])){ ?>
							<span><?php echo $recorded_stream_detail['Channel']['website'] /* <a style="text-decoration:none;color:#999999" href="<?php echo $stream_detail['Channel']['website'] ?>" target="blank"><?php echo $stream_detail['Channel']['website'] ?></a> */ ?>
							 <?php //echo $this->Html->link($stream_detail['Channel']['website'],'http://'.$stream_detail['Channel']['website'],array('target'=>'_blank','escape'=>false,'alt'=>'Channel','title'=>'Channel')); ?>
							</span><br>						
 						<?php } ?>
						
						
					</div>
					</div>
				</div>
				<div class="col-md-2 right_discription strm_dtl_right_discription">
					<ul>
						<li  title="Total Unique Viewer" alt="Total Unique Viewer" class="viewer" id="total_viewers_count"><?php echo $total_unique_viewers; ?></li>						
						<?php /*<li class="follower active"><?php echo $recorded_stream_detail['Channel']['follower_count'] ?></li>
						
						<div class="container followPostCl_<?php echo $recorded_stream_detail['RecordingStream']['id']; ?>" rel="<?php echo $relValWall; ?>" style="margin-top:20px;">		
						<?php 
						if($this->Session->check('Auth.User.id') ){
							echo $this->Html->link('<span class="follow-cls reposttext_'.$recorded_stream_detail['RecordingStream']['id'].'">'.$relValWall.'</span>',"javascript:;", array( "onclick"=>"followStream('".$recorded_stream_detail['RecordingStream']['id']."','".$recorded_stream_detail['RecordingStream']['channel_id']."','".$recorded_stream_detail['RecordingStream']['stream_id']."');",'escape'=>false));
						} else {
							echo ($this->Html->link('<span class="follow-cls reposttext_'.$recorded_stream_detail['RecordingStream']['id'].'">Follow</span>', 'javascript:;', array('escape'=>false,'class'=>'',"data-toggle"=>"modal" ,"data-target"=>"#loginModal" )));
						}
						?>
						</div>
						*/ ?>
						
						<?php if($this->Session->check('Auth.User.id') ){ ?>
						
							<li  title="<?php echo $relValWall; ?>"  alt="<?php echo $relValWall; ?>"   class="follower   <?php echo $followClass;?> followPostCl_<?php echo $recorded_stream_detail['RecordingStream']['id']; ?>" onclick="followStream('<?php echo $recorded_stream_detail['RecordingStream']['id'] ?>','<?php echo $recorded_stream_detail['RecordingStream']['channel_id']; ?>','<?php echo $recorded_stream_detail['RecordingStream']['stream_id']; ?>')" style="cursor:pointer;" rel="<?php echo $relValWall; ?>" id="follower_li">
							
								<?php 
									echo $this->Html->link($streamCountData,"javascript:;", array("id"=>"countUpdate",'escape'=>false,'style'=>'color:#fff;'));	
								?>
								
							</li>
						
						<?php }else{ ?>
						
							<li  class="follower" style="cursor:pointer;"  data-toggle="modal"  data-target="#loginModal" title="Follow"  alt="Follow" >
							
								<?php 
									echo ($this->Html->link($streamCountData, 'javascript:;', array("id"=>"countUpdate",'escape'=>false,'class'=>'','style'=>'color:#fff;' )));
								?>
							</li>
						
						<?php } ?>
		
						<li style="cursor:pointer;"  class="share" title="Share" alt="Share"><?php echo $this->Html->link('<p class="share">SHARE</p>','javascript:;',array("id"=>"share_popup",'escape'=>false,'alt'=>'Channel','title'=>'','style'=>'color:#3d3d3d;')); ?></li>
						
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
$recordingKey = $recorded_stream_detail['RecordingStream']['recording_key'];
$recordingId = $recorded_stream_detail['RecordingStream']['id'];
$streamId = $recorded_stream_detail['RecordingStream']['stream_id'];
$streamKey = $recorded_stream_detail['RecordingStream']['stream_key'];
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
    socket.emit('join_room', {id: '<?php echo $recordingKey; ?>',recordingId:'<?php echo $recordingId; ?>', image: '<?php echo $image; ?>',username: name});
	
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
			socket.emit('msg', {msg: textarea.val(), SenderId: '<?php echo $userId; ?>', user: '<?php echo $userName; ?>', img: img,  recordingId: '<?php echo $recordingId; ?>',id:'<?php echo $recordingKey; ?>',streamId:'<?php echo $streamId?>',streamKey:'<?php echo $streamKey ?>'});


		}
		// Empty the textarea
		textarea.val("");
	});
	
	
	socket.on('receive', function(data) {
				
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
		//messageTimeSent.last().html(now.fromNow());
		messageTimeSent = $(".chat-time");
		messageTimeSent.last().text(now.fromNow());
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
	
	$(window).bind("load", function() {
		var wtf    = $('.chat-itms');
	  var height = wtf[0].scrollHeight;
	  wtf.animate({scrollTop: height});
	});
	
	<!-- chat end -->
	
	$("#without_login_message").keypress(function(e) {

		// Submit the form on enter

		if (e.which == 13) {
			$('#loginModal').modal('show');
			return false
		}

	});


	
	//Follow Script
	function followStream(recording_stream_id,channel_id,stream_id) {
		var url = SITE_URL + 'streams/follow_ajax';
		var value = $('.followPostCl_' + recording_stream_id).attr('rel');
		
		var recording_stream_id = recording_stream_id;
		var stream_id = stream_id;
		var channel_id = channel_id;
		var status = value == 'Follow' ? '1' : '0';
		var param1 = new Object();
		param1.user_id = '<?php echo $this->Session->read('Auth.User.id'); ?>';
		param1.recording_stream_id = recording_stream_id;
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
						$('.followPostCl_' + recording_stream_id).attr('rel', 'Following');
						$('.followPostCl_' + recording_stream_id).attr('title', 'Following');
						$('.reposttext_' + recording_stream_id).text('Following');	
						$("#follower_li").addClass('active');							
					} else if (value == 'Following') {
						$("#follower_li").removeClass('active');	
						$('.followPostCl_' + recording_stream_id).attr('rel', 'Follow');
						$('.followPostCl_' + recording_stream_id).attr('title', 'Follow');
						$('.reposttext_' + recording_stream_id).text('Follow');							
					}
				$("#countUpdate").text(obj.response.count);										
			},
			error: function (request, status, error) {
				alert(error);
			}
		});
	}
		
	
	/* $('audio,video').mediaelementplayer({
		stretching: 'fill',
		success: function(player, node) {
			$('#' + node.id + '-mode').html('mode: ' + player.pluginType);
			
			 $('.mejs-overlay-play').on('click', function() {
			   
				$.ajax({
					url: '<?php echo $this->Html->url(array('controller'=>'channels','action'=>'update_channel_play_count')); ?>',
					type:'POST',
					data:{channel_id:'<?php echo  $recorded_stream_detail['RecordingStream']['channel_id'] ?>'},
					success: function(result){
					}
				});
			   
				
			   });
		}
	}); */
	
	
	video = jQuery('#myVideo').get()[0];
	video.addEventListener('play', function() {
	
		$.ajax({
			url: '<?php echo $this->Html->url(array('controller'=>'channels','action'=>'update_channel_play_count')); ?>',
			type:'POST',
			data:{channel_id:'<?php echo  $recorded_stream_detail['RecordingStream']['channel_id'] ?>'},
			success: function(result){
			}
		});
	});
	
	
	
	
	
	
	
	
	
	
$(document).ready(function(){   
	 $(".chat-itms").niceScroll().resize();
	 
	 $(function(){
			$('#share_popup').popover({       
				placement: 'top',
				title: 'Channel',
				html:true,
				content:  $('#share_detail').html()
			});			
		})
	 
});
</script>		
	  

	  