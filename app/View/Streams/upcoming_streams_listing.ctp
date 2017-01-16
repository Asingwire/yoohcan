<div class="right-contant" style="min-height:800px;">
	<div class="channel_contant">
		<div class="header_title">
			<h2><?php echo $title_for_layout;?></h2> 
			<?php
		/* 	<ul class="grib_contrl">
				<li><?php echo $this->Html->link($this->Html->image('Front/grid_view.jpg',array('alt'=>'Grid View','title'=>'Grid View')),"#",array('escape'=>false,'alt'=>'Grid View','title'=>'Grid View')); ?></li>
				<li><?php echo $this->Html->link($this->Html->image('Front/list_view.jpg',array('alt'=>'List View','title'=>'List View')),"#",array('escape'=>false,'alt'=>'List View','title'=>'List View')); ?></li>
				<li><?php echo $this->Html->link($this->Html->image('Front/progress.jpg',array('alt'=>'Progress','title'=>'Progress')),"#",array('escape'=>false,'alt'=>'Progress','title'=>'Progress')); ?></li>
			</ul> */
			?>
		</div>
		<?php
		if(!empty($upcoming_streams_listing))
		{
		?>
		<ul class="channel_list">
		
			<?php
			foreach($upcoming_streams_listing as $upcoming_streams_key=>$upcoming_streams_value)
			{
				$imagePath	=	IMAGE_PATH_FOR_TIM_THUMB.'/'.STREAM_IMAGE_FULL_DIR.'/';
				$image		=	$upcoming_streams_value['Stream']['stream_image'];	
			?>
				<li>
					<div>
					
					<a href="<?php echo $this->Html->url(array('controller'=>'streams','action'=>'stream_detail',$upcoming_streams_value['Stream']['id'])) ?>">
						<?php
						if($image &&  file_exists(WWW_ROOT.STREAM_IMAGE_FULL_DIR.DS.$image )) {
							echo $this->Html->image(SITE_URL.'/timthumb.php?src='.$imagePath.$image.'&w=280&h=158&a=t',array('title'=>$upcoming_streams_value['Stream']['title'],'alt'=>$upcoming_streams_value['Stream']['title'],'class'=>''));
						} else {					
							echo $this->Html->image('Front/channel-img.jpg',array('escape'=>false,'alt'=>'No Image','class'=>''));
						}
						?>
					</a>
					<span>
					<?php echo $this->Html->link($upcoming_streams_value['Stream']['title'],array('controller'=>'streams','action'=>'stream_detail',$upcoming_streams_value['Stream']['id']),array('escape'=>false,'alt'=>'Progress','title'=>'Progress','style'=>'color:#fff;')); ?>
					</span>
					</div>
				</li>
			<?php
			}
			?>
		</ul>
		<?php
		}
		else
		{
			echo $this->Element('no_record_found',array('message'=>'No channels found.'));
		}
		?>
	</div>
 </div>
 <?php echo ($this->element('Front/footer'))?>