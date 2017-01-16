<div class="strem_box" style="margin-top:0px;text-align:center;">
	<!--<h3>Channel Info</h3>-->
	<h3><?php echo $stream_detail['Channel']['name']; ?></h3>
	<div class="col-md-10 streaming-box_30 pad0" style="margin-top:0px;">
		<div class="stream-details-box-popup">
			<div style="border-bottom:none;" class="full-box">
				
				<!--<h3 style="margin:0px;border-bottom:1px solid #ddd;" class="heading">Channel Image</h3>-->
				<div>
					<p>
					<?php 
					$channelPath		=	IMAGE_PATH_FOR_TIM_THUMB.CHANNEL_IMAGE_FULL_DIR."/";
					$channel_image		=	$stream_detail['Channel']['image'];
					if(!empty($channel_image))
					{
						echo $this->Html->image(SITE_URL.'/timthumb.php?src='.$channelPath.$channel_image.'&w=457&h=200&a=t',array('class'=>'','alt'=>$stream_detail['Channel']['name'],'title'=>$stream_detail['Channel']['name'],'class'=>'imgClass'));
					}

					?>
					</p>
				</div>
			</div><?php
		/* 
			<div style="border-bottom:none;" class="full-box">
				<h3 style="margin:0px;border-bottom:1px solid #ddd;" class="heading">Channel Name</h3>
				<div>
				<p><?php echo $stream_detail['Channel']['name']; ?></p>
				</div>
			</div>
				<div style="border-bottom:none;" class="full-box">
				<h3 style="margin:0px;border-bottom:1px solid #ddd;" class="heading">Company</h3>
				<div>
				<p><?php echo $stream_detail['Channel']['company']; ?></p>
				</div>
			</div>
			<div style="border-bottom:none;" class="full-box">
				<h3 style="margin:0px;border-bottom:1px solid #ddd;" class="heading">Website</h3>
				<div>
				<p><?php echo $stream_detail['Channel']['website']; ?></p>
				</div>
			</div>
			<div style="border-bottom:none;" class="full-box">
				<h3 style="margin:0px;border-bottom:1px solid #ddd;" class="heading">Bio</h3>
				<div>
				<p><?php echo $stream_detail['Channel']['bio']; ?></p>
				</div>
			</div> */
			?>
		</div>
	</div>
	<div class="modal-footer md-footer">
        <button type="button" class="btn btn-default can" data-dismiss="modal">CANCEL</button>
          <button type="button" id="chanel_subscribe_submit" class="btn btn-default don">Subscribe Now</button>
    </div>
</div>
<div class="loading"  id="loading_channel_subscribe_img" style="visibility:hidden">
	<?php echo $this->Html->image('ajax-loader.gif', array('title'=>'loading','alt'=>'loading','id'=>'loading-image')) ?>
</div>	