
<div class="strem_box" style="margin-top:0px;text-align:center;">
	<!--<h3>Channel Info</h3>-->
	<h3><?php echo $featured_stream_detail['Channel']['name']; ?></h3>
	<div class="col-md-10 streaming-box_30 pad0" style="margin-top:0px;">
		<div class="stream-details-box-popup">
			<div style="border-bottom:none;" class="full-box">
				
				<!--<h3 style="margin:0px;border-bottom:1px solid #ddd;" class="heading">Channel Image</h3>-->
				<div>
					<p>
					<?php 
					$channelPath		=	IMAGE_PATH_FOR_TIM_THUMB.STREAM_IMAGE_FULL_DIR."/";
					$channel_image		=	$featured_stream_detail['Stream']['stream_image'];
					if(!empty($channel_image))
					{
						echo $this->Html->image(SITE_URL.'/timthumb.php?src='.$channelPath.$channel_image.'&w=457&h=200&a=t',array('class'=>'','alt'=>$featured_stream_detail['Channel']['name'],'title'=>$featured_stream_detail['Channel']['name'],'class'=>'imgClass'));
					}

					?>
					</p>
				</div>
			</div><?php
		
			?>
		</div>
	</div>
	<div class="modal-footer md-footer">
	
		<button type="button" class="btn btn-default can" data-dismiss="modal">CANCEL</button>  
		 <?php 
		 echo $this->Html->link('Subscribe Now',"javascript:;", array("onclick"=> "stream_subscribe('".$featured_stream_detail['Channel']['id']."','".$featured_stream_detail['Stream']['id']."');",'escape'=>false,'class'=>'btn btn-default don'));
		 ?>
    </div>
</div>
<div class="loading"  id="loading_channel_subscribe_img" style="visibility:hidden">
	<?php echo $this->Html->image('ajax-loader.gif', array('title'=>'loading','alt'=>'loading','id'=>'loading-image')) ?>
</div>	

		
<script>	
	
	$(document).on('click','#subscribe_channel',function(){	
			$('#channel_box').modal('show');			
	});
		
	function stream_subscribe(channel_id,stream_id) {
		 $('#loading_channel_subscribe_img').css('visibility', 'visible');
		 $.ajax({
		   type: "POST",
		   url: "<?php echo $this->Html->url(array("controller"=>"channels","action"=>"subscribe")) ;?>",
		   async: false,
		   data:{channel_id:channel_id,stream_id:stream_id}, // serializes the form's elements.
		   success: function(data)
		   {		
			   if(data == 1)
			  {
			  
				$('#loading_channel_subscribe_img').css('visibility', 'hidden');
				$("#subscribe_channel_div").html("<a href='javascript:;' onclick = stream_already_subscribe('<?php echo $featured_stream_detail['Channel']['id']; ?>','<?php echo $featured_stream_detail['Stream']['id']; ?>')><img src='"+SiteUrl+"/img/Front/video_icn_green.png'/><a>");
				$('#channel_box').modal('hide');
			  }
			  
				
		   }
		 }); 
	}
		
	function stream_already_subscribe(channel_id,stream_id) { 
	$.ajax({
		   type: "POST",
		   url: "<?php echo $this->Html->url(array("controller"=>"channels","action"=>"unsubscribe")) ;?>",
		   async: false,
			data:{channel_id:channel_id,stream_id:stream_id}, // serializes the form's elements.
		   success: function(data)
		   {		
			   if(data == 1)
			  {
				$('#loading_channel_subscribe_img').css('visibility', 'hidden');
				$("#subscribe_channel_div").html("<a href='javascript:;' id='subscribe_channel'><img src='"+SiteUrl+"/img/Front/video_icn.png'/></a>");
				$('#channel_box').modal('hide');
			  }
			  
				
		   }
		});
	}
	
	
	
	</script>