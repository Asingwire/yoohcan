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



							?></label><span class="colour_blue">Image</span></p>
						</div>
					</div>			
					<div class="full-box pad-box">
						<div class="edt-name">
							<p><label><?php echo $stream_detail['Stream']['title'] ?></label><span class="colour_blue">Title</span></p>
						</div>
					</div>
					<div class="full-box pad-box">
						<div class="edt-name">
							<p><label><?php echo $stream_detail['Stream']['subject'] ?></label><span class="colour_blue">Subject</span></p>
						</div>
					</div>
						
					<div class="full-box pad-box">
						<div class="edt-name">
							<p><label><?php echo $stream_detail['Stream']['stream_bio'] ?></label><span class="colour_blue">Bio</span></p>
						</div>
					</div>
					
					
					<div class="full-box pad-box">
						<div class="edt-name">
							<p><label><?php echo $stream_detail['Stream']['stream_key'] ?></label><span class="colour_blue">Stream Key</span></p>
						</div>
					</div>
					
					<div class="full-box pad-box">
						<div class="edt-name">
						
							
							<p><label><?php echo $stream_detail['Stream']['rtmp_url']; ?></label><span class="colour_blue">RTMP/FMS PUSH URL</span></p>
							
						</div>
					</div>
					
					<!--<div class="full-box pad-box">
						<div class="edt-name">
							<p><label><?php //echo $stream_detail['Stream']['encoding_profile']; ?></label><span class="colour_blue">Aspect Ratio</span></p>
						</div>
					</div>-->
					
					<div class="full-box pad-box">
						<div class="edt-name">
							<p><label><?php echo $stream_detail['Stream']['stream_mpd_url']; ?></label><span class="colour_blue">MPEG DASH URL</span></p>
						</div>
					</div>

					<div class="full-box pad-box">
						<div class="edt-name">
							<p><label><?php echo $stream_detail['Stream']['stream_hls_url']; ?></label><span class="colour_blue">HLS URL</span></p>
						</div>
					</div>

					<div class="full-box pad-box">
						<div class="edt-name">
							<p><label><?php echo $stream_detail['Stream']['timeshift']; ?></label><span class="colour_blue">Timeshift</span></p>
						</div>
					</div>

					<div class="full-box pad-box">
						<div class="edt-name">
							<p><label><?php echo $stream_detail['Stream']['live_edge_offset']; ?></label><span class="colour_blue">Live Edge Offset</span></p>
						</div>
					</div>

					<div class="full-box pad-box">
						<div class="edt-name">
							<p><label>24.00 FPS</label><span class="colour_blue">Video Frame Rate (FPS)</span></p>
						</div>
					</div>

					<div class="full-box pad-box">
						<div class="edt-name">
							<p><label>48 kHz</label><span class="colour_blue">Audio Sample Rate (Format)</span></p>
						</div>
					</div>

					<div class="full-box pad-box">
						<div class="edt-name">
							<p><label>
							<?php if($val['Stream']['instance_status'] == 1){
								echo 'RUNNING';
							}else{ echo 'TERMINATED'; }
							?>
							</label><span class="colour_blue">STATUS</span></p>
						</div>
					</div>
					
					
					
					
					
				</div>
			</div>
			
			<div class="col-md-6  streaming-box_30 pad0">
				
				<!--<div class="stream-details-box">
					<div class="full-box border-none pad20">
						<div id='wowza_player' style="width:500px; !important"></div>
						<script id='player_embed' src='//player.cloud.wowza.com/hosted/<?php echo $stream_detail['Stream']['player_id']; ?>/wowza.js' type='text/javascript'></script>
					</div>
				</div>-->
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