<?php
/* pr($recorded_stream_detail);
die; */
?>
<?php echo $this->Html->script('jwplayer/jwplayer'); ?>
		<script type="text/javascript;">jwplayer.key="HglrMHMi9wUmSJ+Jmc/zE1SekGmhSi61k4mISw==";</script>
<div class="right-contant">
    <span class="chat-slide"><?php echo $this->Html->link($this->Html->image('Front/open-chat.png'),'javascript:;',array('escape'=>false)); ?></span>
  <div class="channels-slide streams01">
    <div class="bottom_recorded secound-option">
      <div class="row">
      <div class="streaming-mid col-md-8">
      <div class="strem_vdo text-center">
	  <?php //echo $this->Html->image('Front/chat-video.jpg') ?>
		<div id="player"></div>
		<script type="text/javascript;">
			
		jwplayer("player").setup({
			file: "<?php echo $recorded_stream_detail['RecordingStream']['download_url']; ?>",  
			image: SiteUrl+"img/Front/slide_img.jpg",
			width: "100%",
			aspectratio: "12:5",
			autostart: true
		}).onPlay(function(){
			
			$.ajax({
				url: '<?php echo $this->Html->url(array('controller'=>'channels','action'=>'update_channel_play_count')); ?>',
				type:'POST',
				data:{channel_id:'<?php echo  $recorded_stream_detail['RecordingStream']['channel_id'] ?>'},
				success: function(result){
				//alert(result)
				}
			});
			
		});
		</script>
	  </div>
	  
	   <!--Follow-->
		<?php 
		//pr($recorded_stream_detail);die;
		  if($recorded_stream_detail['ChannelFollower']['is_follow'] == 0){
			$relValWall = 'Follow';
		  }else{
			$relValWall = 'Following';
		  }
		?>		
		<div class="container followPostCl_<?php echo $recorded_stream_detail['RecordingStream']['id']; ?>" rel="<?php echo $relValWall; ?>" style="margin-top:20px;">		
		<?php 
		if($this->Session->check('Auth.User.id') ){
			echo $this->Html->link('<span class="follow-cls reposttext_'.$recorded_stream_detail['RecordingStream']['id'].'">'.$relValWall.'</span>',"javascript:;", array( "onclick"=>"followStream('".$recorded_stream_detail['RecordingStream']['id']."','".$recorded_stream_detail['RecordingStream']['channel_id']."','".$recorded_stream_detail['RecordingStream']['stream_id']."');",'escape'=>false));
		} else {
			echo ($this->Html->link('<span class="follow-cls reposttext_'.$recorded_stream_detail['RecordingStream']['id'].'">Follow</span>', 'javascript:;', array('escape'=>false,'class'=>'',"data-toggle"=>"modal" ,"data-target"=>"#loginModal" )));
		}
		?>
		</div>
		<script>				
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
					if (value == 'Follow') {
							$('.followPostCl_' + recording_stream_id).attr('rel', 'Following');
							$('.reposttext_' + recording_stream_id).text('Following');							
						} else if (value == 'Following') {
							$('.followPostCl_' + recording_stream_id).attr('rel', 'Follow');
							$('.reposttext_' + recording_stream_id).text('Follow');							
						}
					obj = jQuery.parseJSON(response);					
				},
				error: function (request, status, error) {
					alert(error);
				}
			});
		}
		</script>
	  
	  
    <h1>RELATED VIDEOS</h1>
     <ul class="channel_list">
	 <?php
/*   <li><?php echo $this->Html->link($this->Html->image('Front/channel-img.jpg'),'javascript:;',array('escape'=>false)); ?></li>
  <li><?php echo $this->Html->link($this->Html->image('Front/channel-img.jpg'),'javascript:;',array('escape'=>false)); ?></li>
  <li><?php echo $this->Html->link($this->Html->image('Front/channel-img.jpg'),'javascript:;',array('escape'=>false)); ?></li>
  <li><?php echo $this->Html->link($this->Html->image('Front/channel-img.jpg'),'javascript:;',array('escape'=>false)); ?></li>
  <li><?php echo $this->Html->link($this->Html->image('Front/channel-img.jpg'),'javascript:;',array('escape'=>false)); ?></li>
  <li><?php echo $this->Html->link($this->Html->image('Front/channel-img.jpg'),'javascript:;',array('escape'=>false)); ?></li>
  <li><?php echo $this->Html->link($this->Html->image('Front/channel-img.jpg'),'javascript:;',array('escape'=>false)); ?></li>
  <li><?php echo $this->Html->link($this->Html->image('Front/channel-img.jpg'),'javascript:;',array('escape'=>false)); ?></li>
  <li><?php echo $this->Html->link($this->Html->image('Front/channel-img.jpg'),'javascript:;',array('escape'=>false)); ?></li>
  <li><?php echo $this->Html->link($this->Html->image('Front/channel-img.jpg'),'javascript:;',array('escape'=>false)); ?></li>
  <li><?php echo $this->Html->link($this->Html->image('Front/channel-img.jpg'),'javascript:;',array('escape'=>false)); ?></li>
  <li><?php echo $this->Html->link($this->Html->image('Front/channel-img.jpg'),'javascript:;',array('escape'=>false)); ?></li> */
  ?>
	<?php
	if(!empty($related_recorded_stream_listing))
	{
		
		foreach($related_recorded_stream_listing as $key=>$value)
		{
		?>
			<li><?php echo $this->Html->link($this->Html->image('Front/channel-img.jpg'),array('controller'=>'streams','action'=>'recorded_stream_detail',$value['RecordingStream']['id']),array('escape'=>false)); ?></li>
		<?php
		}
	}
	else
	{
	?>
	<li>No video found.</li>
	<?php
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
   <span class="elips"><?php echo $this->Html->link($this->Html->image('Front/chat-elips.png'),'javascript:;',array('escape'=>false)); ?></span> 
 </div>
 <div class="chat-itms">
    <div class="cht-prsn">
    <?php echo $this->Html->image('Front/chat-person.png'); ?>
    <p>Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio.
    <span class="chat-time">2 a.m</span></p>
    </div>
    
     <div class="cht-prsn">
   <?php echo $this->Html->image('Front/chat-person.png'); ?>
    <p>Nam nec tellus a odio tincidunt auctor? <span class="chat-time">2 a.m</span></p>
    </div>
    
     <div class="cht-prsn reply-prsn">
    <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem bibendum auctor, 
    <span class="chat-time">2 a.m <span class="return">R</span></span></p>
    </div>
  
     <div class="cht-prsn">
    <?php echo $this->Html->image('Front/chat-person.png'); ?>
    <p>Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit.  <span class="chat-time">2 a.m</span></p>
    </div>
    
     <div class="cht-prsn reply-prsn">
    <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem bibendum auctor, 
    <span class="chat-time">2 a.m <span class="return">D</span></span></p>
    </div>
  
     <div class="cht-prsn">
    <?php echo $this->Html->image('Front/chat-person.png'); ?>
    <p>Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit.  <span class="chat-time">2 a.m</span></p>
    </div>    
     
    <div class="cht-prsn reply-prsn">
    <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem bibendum auctor, 
    <span class="chat-time">2 a.m <span class="return">D</span></span></p>
    </div>
  
   </div>
   
   <form class="chat-form">
   <span class="text-outer">
    <input type="text" placeholder="Write here..." />
     <label><?php echo $this->Html->image('Front/attechment.png'); ?><input type="file" /></label>
    </span>
    <input type="submit" value="Send" />
   </form>
   </div>
  </div>
  <!--chat-end-->

</div>