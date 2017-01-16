<div class="right-contant" style="min-height:800px;">  
	<div class="col-md-12 channel_detail">  
	<?php $this->Layout->sessionFlash(); ?>
		<h3><?php echo $title_for_layout; ?></h3>
		<?php echo ($this->Element('Front/User/left_sub_menu'));?>
		<div class="col-md-10">
			<div class="col-md-6 streaming-box_70 set-left">
				<p>Stream Detail</p>
				<div class="stream-details-box">
					
								
					<div class="full-box pad-box">
						<div class="edt-name">
							<p><label><?php


							$imagePath		=	IMAGE_PATH_FOR_TIM_THUMB.'/'.STREAM_IMAGE_FULL_DIR.'/';
								$image		=	$stream_detail['Stream']['stream_image'];
												
							$noImage	=	'avatar5.png';
							if($image &&  file_exists(WWW_ROOT.STREAM_IMAGE_FULL_DIR.DS.$image )) {
								echo $this->Html->image(SITE_URL.'/timthumb.php?src='.$imagePath.$image.'&w=480&h=270&a=t',array('class'=>'','alt'=>$stream_detail['Stream']['title'],'width'=>'300','class'=>'imgClass'));
							} else {
								echo $this->Html->image('Front/stream_no_image.png',array('escape'=>false,'class'=>'','alt'=>$stream_detail['Stream']['title'],'height'=>'270','width'=>'480','class'=>'imgClass'));
							} 



							?></label><span>Image</span></p>
						</div>
					</div>			
					<div class="full-box pad-box">
						<div class="edt-name">
							<p><label><?php echo $stream_detail['Stream']['title'] ?></label><span>Title</span></p>
						</div>
					</div>
					<div class="full-box pad-box">
						<div class="edt-name">
							<p><label><?php echo $stream_detail['Stream']['subject'] ?></label><span>Subject</span></p>
						</div>
					</div>
						
					<div class="full-box pad-box">
						<div class="edt-name">
							<p><label><?php echo $stream_detail['Stream']['stream_bio'] ?></label><span>Bio</span></p>
						</div>
					</div>
					<?php
					if(!empty($stream_detail['Stream']['connection_code']))
					{
					?>
					<div class="full-box pad-box">
						<div class="edt-name">
							<p><label id="connection_code_label"><?php echo $stream_detail['Stream']['connection_code'] ?></label><span>Connection Code</span>
							<?php echo $this->Html->image('ajax-loader.gif', array('style'=>'display: none','title'=>'loading','alt'=>'loading','id'=>'loader','width'=>10,'height'=>10)) ?>
							</p>
							
						</div>
						
							
						
						<a href="javascript:;" id="connection_code_link" > Get New Connection Code</a>
					</div>
					<?php
						
					}
					?>
					
					<div class="full-box pad-box">
						<div class="edt-name">
							<p><label><?php echo $stream_detail['Stream']['stream_name'] ?></label><span>Stream Key</span></p>
						</div>
					</div>
					
					<div class="full-box pad-box">
						<div class="edt-name">
							<?php
							if($stream_detail['Stream']['stream_encoder_type'] == 'wowza_gocoder')
							{
							?>
							<p><label><?php echo "rtsp://".$stream_detail['Stream']['primary_server']; ?></label><span>URL</span></p>
							<?php
							}
							else
							{
							?>
							<p><label><?php echo $stream_detail['Stream']['primary_server']; ?></label><span>URL</span></p>
							<?php
							}
							?>
						</div>
					</div>
					
					<div class="full-box pad-box">
						<div class="edt-name">
							<p><label><?php echo $stream_detail['Stream']['aspect_ratio']; ?></label><span>Aspect Ratio</span></p>
						</div>
					</div>
					
					
					<div class="full-box pad-box">
						<div class="edt-name">
							<p><label><?php 
							/* pr($stream_detail);
							die; */
							$message= '';	
							if($stream_detail['Stream']['aspect_ratio']=='3840x2160')
							{
								$message = 'Setting: This setting creates <strong>7 bitrate renditions.</strong>';
							}
							else if($stream_detail['Stream']['aspect_ratio']=='1920x1080')
							{
								$message = 'Setting:This setting creates <strong>6 bitrate renditions.</strong>';
							}
							else if($stream_detail['Stream']['aspect_ratio']=='1280x720')
							{
								$message = 'Setting:This setting creates <strong>5 bitrate renditions.</strong>';
							}
							else if($stream_detail['Stream']['aspect_ratio']=='1024x576')
							{
								$message = 'Setting:This setting creates <strong>5 bitrate renditions.</strong>';
							}
							echo $message;

							?></label>
							<span>&nbsp;</span>
							
							</p>
						</div>
					</div>
					<div class="full-box pad-box">
						<div class="edt-name">
							<p><label><?php
							if($stream_detail['Stream']['recording_enabled'] == '1' )
							{	
								echo "Yes";
							}else
							{
								echo "No";
							}

							?></label><span>Recording</span></p>
						</div>
					</div>
					
					
					<div class="full-box pad-box">
						<div class="edt-name">
							<p><label><?php
							if(!empty($stream_detail['Stream']['schedule_start_date']) && $stream_detail['Stream']['schedule_start_date'] != '0000-00-00 00:00:00')
							{	
								echo $stream_detail['Stream']['schedule_start_date']." UTC";
							}

							?></label><span>Schedule Start Date</span></p>
						</div>
					</div>
					
					
					<div class="full-box pad-box">
						<div class="edt-name">
							<p><label><?php
							if(!empty($stream_detail['Stream']['schedule_end_date']) && $stream_detail['Stream']['schedule_end_date'] != '0000-00-00 00:00:00')
							{	
								echo $stream_detail['Stream']['schedule_end_date']. " UTC";
							}

							?></label><span>Schedule End Date</span></p>
						</div>
					</div>
					<?php
					if($stream_detail['Stream']['stream_state'] == 2)
					{
					?>
						<div class="full-box pad-box">
						<?php echo $this->Html->link('Stop',array('controller'=>'streams','action'=>'stop_stream',$stream_detail['Stream']['id']),array('escape'=>false,'id'=>'btnStop','class'=>'btn btn-warning')) ?>
						</div>
					<?php
					}
					elseif($stream_detail['Stream']['stream_state'] == 0 || $stream_detail['Stream']['stream_state'] == 4)
					{
					?>
					<div class="full-box pad-box">
						<?php echo $this->Html->link('Start','javascript:;',array('escape'=>false,'id'=>'btnStart','class'=>'btn btn-success')) ?>
					</div>
					<?php
					}
					?>
				</div>
			</div>
			
			<div class="col-md-6  streaming-box_30 pad0">
				
				<div class="stream-details-box">
					<div class="full-box border-none pad20">
						<div id='wowza_player' style="width:500px; !important"></div>
						<script id='player_embed' src='//player.cloud.wowza.com/hosted/<?php echo $stream_detail['Stream']['player_id']; ?>/wowza.js' type='text/javascript'></script>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo $this->element('Front/footer'); ?>


<div class="modle_popup">
<div class="modal md1 fade in" id="check_stream_running_status" role="dialog">
    <div class="modal-dialog md-width">
    
      <!-- Modal content-->
      <div class="modal-content md-content">
        <div class="modal-header md-header">
         <button type="button" style="top:70px;right:0px;z-index:9 !important;" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Alert</h4>
        </div>
        <div class="modal-body md-body">
			<p  style="align:center;color: #354052;font-family: 'ProximaNovaA-Regular';font-size: 16px;font-weight: 600;">A stream is already running.So you cannot run the multiple stream at same time.</p>
        </div>
      </div>
      
    </div>
  </div>
</div>



<div class="modle_popup">
<div class="modal md1 fade in" id="myModal" role="dialog">
    <div class="modal-dialog md-width">
    
      <!-- Modal content-->
      <div class="modal-content md-content">
        <div class="modal-header md-header">
          
          <h4 class="modal-title">Confirmation</h4>
          <!--<div class="delete_btn"><a href="#">Delete video <img src="images/trash-icon1.png" alt=""/></a></div>-->
        </div>
        <div class="modal-body md-body">
			<?php echo $this->Html->image('Front/ajax-loader.gif',array('id'=>'loading_img','style'=>'display:none;')); ?>
			<p id="lblMsgConfirm" style="align:center;color: #354052;font-family: 'ProximaNovaA-Regular';font-size: 16px;font-weight: 600;"></p>
        </div>
        <div class="modal-footer md-footer">
        <button type="button" id="btnNoConfirmYesNo" class="btn btn-default can" >No</button>
        <button type="button" id="btnYesConfirmYesNo" class="btn btn-default don" >Yes</button>
        </div>
      </div>
      
    </div>
  </div>
</div>
<script type="text/javascript">
	
	$(document).ready(function(){
	
	
		$("#connection_code_link").on('click',function(){
			$("#loader").css('display','block');
			$.ajax({
				url: "<?php echo $this->Html->url(array('controller'=>'streams','action'=>'get_connection_code',$stream_detail['Stream']['id'])); ?>",
				success: function(result){
					obj = jQuery.parseJSON(result);
					if(obj.key == 'success')
					{
						$("#connection_code_label").html(obj.connection_code);
						$("#loader").css('display','none');
						
					}
					else if(obj.key == 'failed')
					{
						location.reload();
						
					}
					
				}
			});
		})
	
	
		$("#btnStart").on('click',function(){
		
			// check stream alrady running or not start //
			stream_id = '<?php echo $stream_detail['Stream']['id']; ?>';
			
			$.ajax({
				url: "<?php echo $this->Html->url(array('controller'=>'streams','action'=>'check_user_stream_running_status_count')); ?>",
				data:{stream_id:stream_id},
				type:'POST',
				success: function(result){
					obj = jQuery.parseJSON(result);
					if(obj.check_stream_running_status_count==0)
					{
						$("#lblMsgConfirm").html('Are your ready to start streaming?');
						$("#myModal").modal({keyboard: false,show:true});
					}
					else
					{
						//alert("not allowed.");
						$("#check_stream_running_status").modal({keyboard: false,show:true});
						
					}					
				}
			});
			
			// check stream alrady running or not end //
		
			//$("#lblMsgConfirm").html('Are your ready to start streaming?');
			//$("#myModal").modal({keyboard: false,show:true});
		})
		$("#btnYesConfirmYesNo").off('click').click(function () {
		
			$("#btnNoConfirmYesNo").css('display','none');
			$("#btnYesConfirmYesNo").css('display','none');
			$("#loading_img").css('display','block');
			$.ajax({
				url: "<?php echo $this->Html->url(array('controller'=>'streams','action'=>'start_stream',$stream_detail['Stream']['id'])); ?>",
				success: function(result){
					obj = jQuery.parseJSON(result);
					if(obj.key == 'success')
					{
						$("#lblMsgConfirm").html(obj.msg);
						setInterval(
						function(){
							$.ajax({
								url: "<?php echo $this->Html->url(array('controller'=>'streams','action'=>'check_stream_status',$stream_detail['Stream']['id'])); ?>",
								success: function(result){
									obj = jQuery.parseJSON(result);
									if(obj.stream_state==2)
									{
										location.reload();
									}
								}
							});
						}, 
						5000
						);
					}
					else if(obj.key == 'success_already_running')
					{
						$("#lblMsgConfirm").html(obj.msg);
						setInterval(
						function(){
							$.ajax({
								url: "<?php echo $this->Html->url(array('controller'=>'streams','action'=>'check_stream_status',$stream_detail['Stream']['id'])); ?>",
								success: function(result){
									obj = jQuery.parseJSON(result);
									if(obj.stream_state==2)
									{
										location.reload();
									}
								}
							});
						}, 
						5000
						);
						
					}
					else
					{
						location.reload();
					}
				}
			});
		});
		
		$("#btnNoConfirmYesNo").off('click').click(function () {
			$("#myModal").modal('hide');
		});
	
	})
  
	var stream_state = "<?php echo $stream_detail['Stream']['stream_state'] ?>";
	if(stream_state == '1')
	{
		$("#loading_img").css('display','block');
		
		
		
		$("#lblMsgConfirm").html("Stream started successfully. This may take a few minutes. Thank you for your patience.");
		$("#btnNoConfirmYesNo").css('display','none');
		$("#btnYesConfirmYesNo").css('display','none');
		$("#myModal").modal({keyboard: false,show:true});
		setInterval(
		function(){
			$.ajax({
				url: "<?php echo $this->Html->url(array('controller'=>'streams','action'=>'check_stream_status',$stream_detail['Stream']['id'])); ?>",
				success: function(result){
					obj = jQuery.parseJSON(result);
					if(obj.stream_state==2)
					{
						location.reload();
					}
				}
			});
		}, 
		5000
		);
	}
	
  
  </script>