<?php
	echo $this->Html->css(array('datetimepicker/bootstrap-datetimepicker'));
	echo($this->Html->script(array('datetimepicker/moment','datetimepicker/bootstrap-datetimepicker.min')));
?>
<style>
.stream_form label{
	color: #6e6e6e;	
	font-family: "ProximaNovaA-Regular";
	font-size: 14px;
	margin: 13px 0 0;
}
#start_date_box .error-message {
		margin-top: 30px;
		position: absolute;
	}
</style>


<div class="right-contant" style="min-height:800px;">  


	<div class="col-md-12 channel_detail">  
		
		<?php echo ($this->Element('Front/User/left_sub_menu'));?>
		<div class="col-md-10">
		
			<div class="col-sm-6 col-md-6 streaming-box_70 set-left">
				
				<p>Add Stream</p>

				<div class="stream-details-box" style="width: auto;"><br/>
					<?php echo $this->Session->flash(); ?>

				<div class="signuptabcon signuptabcon_new">
				<?php 
					echo $this->Form->create('Stream', array('url' => array('controller' => 'streams', 'action' => 'add'),'class'=>'form-horizontal stream_form','type'=>'file','novalidate'=>true));
					
					
					echo $this->Form->input("hidden_user_id", array( 'label'=>'Title',"type"=>"hidden","value"=>$this->Session->read('Auth.User.id'),"div"=>false,"label"=>false,"class"=>"file"));

					
					
					
				?>	
				<div class="col-md-12">
				<?php echo $this->Html->link($this->Html->image('tooltip.png',array('class'=>'tooltip_img')),"javascript:;",array('alt'=>'Edit Info','title'=>'To be able to do a live video stream, we’re going to have to add a stream to our channel. Click on the add stream button to get started. The fields marked with a red star are required to be filled in.','escape'=>false,'class'=>'tooltip_img')); ?>	
			
					<?php echo ($this->Form->input("image", array( 'label'=>'Image<span class="red_star_mendatry">*</span>',"type"=>"file","div"=>false,"class"=>"file"))); ?>
				</div>
				<div class="col-md-12">
					<?php  echo ($this->Form->input('title', array('div'=>false, 'placeholder'=>false, 'label'=>'Title<span class="red_star_mendatry">*</span>',"autocomplete"=>"off", "class" => "signfild","maxlength"=>200)));?>
				</div>
				<div class="col-md-12">
					<?php  echo ($this->Form->input('subject', array('div'=>false, 'placeholder'=>false, 'label'=>'Subject<span class="red_star_mendatry">*</span>',"autocomplete"=>"off", "class" => "signfild")));?>
				</div>
				<div class="col-md-12">
				<?php echo $this->Html->link($this->Html->image('tooltip.png',array('class'=>'tooltip_img')),"javascript:;",array('alt'=>'Edit Info','title'=>'When selecting the encoder, this is the program used for customising and connecting the stream, if you have a preferred program select that otherwise we’d advise OBS, which is free to use.','escape'=>false,'class'=>'tooltip_img')); ?>
					<?php echo ($this->Form->input('stream_encoder_type', array('options'=>Configure::read('Stream.Encoder.Type'), 'empty'=>'Select Encoder','div' => false, 'label' => 'Select Encoder<span class="red_star_mendatry">*</span>',"data-live-search"=>"true"))); ?>
				</div>
				<div class="col-md-12">
					<?php echo ($this->Form->input('stream_broadcast_location', array('options'=>$broadcast_location, 'empty'=>'--Select--','div' => false, 'label' => 'Which location is closest to where you\'re broadcasting from?<span class="red_star_mendatry">*</span> ',"data-live-search"=>"true"))); ?>
				</div>
				<div class="col-md-12" id="stream_aspect_ration_options">
				<?php echo $this->Html->link($this->Html->image('tooltip.png',array('class'=>'tooltip_img')),"javascript:;",array('alt'=>'Edit Info','title'=>'Aspect ratio is you preferred video sizing and quality. The most used setting here is 1280x720.','escape'=>false,'class'=>'tooltip_img')); ?>
					<?php echo $this->Element('/Front/Streams/stream_aspect_ration_options'); ?>
				</div>
				<div class="col-md-12" id="bitrate_renditions">
					<?php echo $message; ?>
				</div>
				<div class="col-md-12">
					<label for="StreamAspectRatio">Start Date(Schedule work according UTC time)</label>
					<div class='input-group date' id='start_date_box'>	
						<?php //echo ($this->Form->input('schedule_start_date', array('type'=>'text','div' =>false,'label' =>false, "class" => "form-control"))); ?>
						
						<?php 
							$stdate = '';
							if(!empty($this->request->data['Stream']['schedule_start_date'])){
								$stdate = $this->request->data['Stream']['schedule_start_date'];
							}
							echo ($this->Form->input('schedule_start_date', array('type'=>'text','div' =>false, 'label' =>false,'value'=>$stdate, "class" => "form-control")));
						?>
						
						
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-calendar"></span>
						</span>
					</div>
				</div>
				<?php /*  
				<div class="col-md-12">
					<?php echo ($this->Form->input('schedule_start_time', array('type'=>'text','div' =>false, 'label' =>'Start Time', "class" => "signfild"))); ?>
				</div> 
				 */ ?>
				<div class="col-md-12">
					<label>End Date(Schedule work according UTC time)</label>
					<div class='input-group date' id='end_date_box'>
						<?php echo ($this->Form->input('schedule_end_date', array('type'=>'text','div' =>false, 'label' =>false, "class" => "form-control"))); ?>
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-calendar"></span>
						</span>
					</div>
				</div>
				<div class="col-md-12">
					<label>Do you want to record this live stream?</label>
					<?php echo $this->Form->input('recording_enabled', array('type'=>'checkbox','label'=>'Yes, record this live stream')); ?>
				</div>
				<div class="col-md-12">
					<?php  echo ($this->Form->input('stream_bio', array('div'=>false, 'label'=>'Video Description', "class" => "signfild1", 'rows'=>'5')));?>
				</div>
				<div class="col-md-12">
					<?php  echo ($this->Form->input('twitter_link', array('div'=>false, 'placeholder'=>false, 'label'=>'Twitter Link',"autocomplete"=>"off", "class" => "signfild")));?>
				</div>
				<div class="col-md-12">
					<?php  echo ($this->Form->input('linkdin_link', array('div'=>false, 'placeholder'=>false, 'label'=>'Linkedin Link',"autocomplete"=>"off", "class" => "signfild")));?>
				</div>
				<div class="col-md-12">
					<?php  echo ($this->Form->input('facebook_link', array('div'=>false, 'placeholder'=>false, 'label'=>'Facebook Link',"autocomplete"=>"off", "class" => "signfild")));?>
				</div>
				<div class="col-md-12">
					<?php  echo ($this->Form->input('notes', array('div'=>false, 'placeholder'=>false, 'label'=>'Note',"autocomplete"=>"off", "class" => "signfild1","maxlength"=>30)));?>
				</div>
				<div class="col-md-12">
					<?php  echo ($this->Form->submit("Add", array('class' => 'submit_btn', "div"=>false)));?>
				</div>

				
				<?php echo ($this->Form->end());?>
			</div>
		
				</div>
			</div>
			<div class="col-sm-6 col-md-6" style="position: relative;margin-top:45px" id="dasboard_video">

			<?php if(isset($streaming_guide_pdf) && !empty($streaming_guide_pdf)){

				echo $this->Html->link($this->Html->image('Front/video_bg_with_logo.jpg'),SITE_URL.'uploads/stream_guide/'.$streaming_guide_pdf,array('escape'=>false,'title'=>'Download Streaming 	Guide','alt'=>'Download Streaming Guide','target'=>'blank'));
				echo $this->Html->link('Download Streaming Guide',SITE_URL.'uploads/stream_guide/'.$streaming_guide_pdf,array('target'=>'blank'));
			}else{
				echo $this->Html->image('Front/video_bg_with_logo.jpg');
			}
			?>
			
			
				<?php
/* 


				<video style="width:100%;height:auto;margin:43px 0 0;" controls  src="<?php echo SITE_URL ?>video/OBS_YOOHCAN.mp4" type="video/mp4" 
				id="player4"  
				controls="controls" preload="none" ></video>
				<div class="default_play_pause_box">	
					<?php echo $this->Html->image('Front/play_btn_new.png', array('title'=>'play','alt'=>'play','class'=>'default_play_pause_btn')) ?>
				</div>
				 */?>
				 
				
			</div>
			
		</div>
	</div>
</div>

<?php echo $this->element('Front/footer'); ?>
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


/* 	$(function () {
		$('#start_date_box').datetimepicker({
			format:"YYYY-MM-DD HH:mm",
			minDate:new Date()
			
		});
		$('#StreamScheduleStartDate').val("");
		$('#end_date_box').datetimepicker({
				format:"YYYY-MM-DD HH:mm",
			useCurrent: false 
		});
		$("#start_date_box").on("dp.change", function (e) {
			$('#end_date_box').data("DateTimePicker").minDate(e.date);
		});
		$("#end_date_box").on("dp.change", function (e) {
			$('#start_date_box').data("DateTimePicker").maxDate(e.date);
		});
	}); */
	
	
	$(function () {
		$('#start_date_box').datetimepicker({
			format:"YYYY-MM-DD HH:mm",
			minDate:new Date()
			
		});
		//$('#StreamScheduleStartDate').val("");
		
		var stDate = $('#StreamScheduleStartDate').attr('value');		
		$('#StreamScheduleStartDate').val(stDate);		
		
		$('#end_date_box').datetimepicker({
				format:"YYYY-MM-DD HH:mm",
			useCurrent: false //Important! See issue #1075
		});
		$("#start_date_box").on("dp.change", function (e) {
			$('#end_date_box').data("DateTimePicker").minDate(e.date);
		});
		$("#end_date_box").on("dp.change", function (e) {
			$('#start_date_box').data("DateTimePicker").maxDate(e.date);
		});
	});



$(function() {
	
	
		video_player_align();
	
		/* $('#StreamScheduleStartDate').datetimepicker({
			format:"YYYY-MM-DD",
		});
		$('#StreamScheduleStartTime').datetimepicker({
			format:"HH:mm",
		}); */
	

	$( window ).resize(function() {
		video_player_align();
	});
	
		
	function video_player_align()
	{
		
		video_height = $("#dasboard_video").height();
		$(".default_play_pause_box").css('padding-top',parseInt(video_height/2) + 'px');
		$(".default_play_pause_btn").css('margin-top','-34px');
		
	}
		
		/* video_height = $("#player4").height();
		$(".default_play_pause_box").css('padding-top',parseInt(video_height/2) + 'px'); */


	
		
		
		
		$("#StreamScheduleStartDate").on("dp.change", function (e) {
			$('#StreamScheduleStartDate').data("DateTimePicker").minDate(e.date);
		});
		
		
		
		
		
		$("#StreamStreamBroadcastLocation").on('change',function(){
			broadcast_location = $(this).val();
			
			$.ajax({
				url: "<?php echo $this->Html->url(array('controller'=>'streams','action'=>'stream_aspect_ration_options')); ?>",
				type:'POST',
				data:{broadcast_location:broadcast_location},
				success: function(result){
					$("#stream_aspect_ration_options").html(result);
				}
			});
		});
		
		$(document).on('change','#StreamAspectRatio',function(){
			
			aspect_ratio = $(this).val();
			$.ajax({
				url: "<?php echo $this->Html->url(array('controller'=>'streams','action'=>'bitrate_renditions')); ?>",
				type:'POST',
				data:{aspect_ratio:aspect_ratio},
				success: function(result){
					$("#bitrate_renditions").html(result);
				}
			});
			
		});
		
		
		
		
	});
</script>
