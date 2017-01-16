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
		if(!empty($channel_listing))
		{
		?>
		<ul class="channel_list">
		
			<?php
			foreach($channel_listing as $channel_key=>$channel_value)
			{
				$imagePath	=	IMAGE_PATH_FOR_TIM_THUMB.'/'.CHANNEL_IMAGE_FULL_DIR.'/';
				$image		=	$channel_value['Channel']['image'];	
			?>
				<li>
					<div>
					<a href="<?php echo $this->Html->url(array('controller'=>'channels','action'=>'channel_detail',$channel_value['Channel']['id'])) ?>">
						<?php
						if($image &&  file_exists(WWW_ROOT.CHANNEL_IMAGE_FULL_DIR.DS.$image )) {
						//z=rc
							echo $this->Html->image(SITE_URL.'/timthumb.php?src='.$imagePath.$image.'&w=280&h=158&zc=0',array('title'=>$channel_value['Channel']['name'],'alt'=>$channel_value['Channel']['name'],'class'=>''));
						} else {					
							echo $this->Html->image('Front/channel-img.jpg',array('escape'=>false,'alt'=>'No Image','class'=>''));
						}
						?>
					</a>
					<span>
					<?php 
					$channel_name = "&nbsp;";
					if(!empty($channel_value['Channel']['name']))
					{
					$channel_name = $channel_value['Channel']['name'];
					// $channel_name = 'NLGroelt Live ot Ondernemersdo member to achivement';
					$string = (strlen($channel_name) > 23) ? substr($channel_name,0,20).'...' : $channel_name;
					}
					//$string = '';
					echo $this->Html->link($string,array('controller'=>'channels','action'=>'channel_detail',$channel_value['Channel']['id']),array('escape'=>false,'alt'=>$channel_name,'title'=>$channel_name,'style'=>'color:#fff;float:left;width:100%!important;')); ?>
					</span>
					</div>
				</li>
			<?php
			}
			?>
		</ul>
		<?php echo $this->element('Front/front_paging', array("paging_model_name" => "Channel", "total_title" => "Channel"));  ?>
		<?php
		}
		else
		{
			echo $this->Element('no_record_found',array('message'=>'No channels found.'));
		}
		?>
		
		
		<?php
		if(!empty($live_channels))
		{
		?>
		
		<div class="header_title">
		<h2><?php echo "Currently Live";?></h2> 
		<?php
	/* 	<ul class="grib_contrl">
			<li><?php echo $this->Html->link($this->Html->image('Front/grid_view.jpg',array('alt'=>'Grid View','title'=>'Grid View')),"#",array('escape'=>false,'alt'=>'Grid View','title'=>'Grid View')); ?></li>
			<li><?php echo $this->Html->link($this->Html->image('Front/list_view.jpg',array('alt'=>'List View','title'=>'List View')),"#",array('escape'=>false,'alt'=>'List View','title'=>'List View')); ?></li>
			<li><?php echo $this->Html->link($this->Html->image('Front/progress.jpg',array('alt'=>'Progress','title'=>'Progress')),"#",array('escape'=>false,'alt'=>'Progress','title'=>'Progress')); ?></li>
		</ul> */
		?>
		</div>
		
		
		
		<ul class="channel_list">
		
			<?php
			foreach($live_channels as $channel_key=>$channel_value)
			{
				$streamPath		=	IMAGE_PATH_FOR_TIM_THUMB.STREAM_IMAGE_FULL_DIR."/";
				$stream_image		=	$channel_value['Stream']['stream_image'];			
				//if($stream_image) {
				$thumbnail_url = $this->Layout->get_live_channels_images($channel_value['Stream']['stream_key']);
					
			?>
				<li>
					<div>
					
					
					
					
					<?php
					$channel_name = "&nbsp;";
					if(!empty($channel_value['Channel']['name']))
					{
						$channel_name = $channel_value['Channel']['name'];
						$channel_string = (strlen($channel_name) > 30) ? substr($channel_name,0,27).'...' : $channel_name;
					}
					else if(!empty($channel_value['Stream']['title']))
					{
						$channel_name = $channel_value['Stream']['title'];
						$channel_string = (strlen($channel_name) > 30) ? substr($channel_name,0,27).'...' : $channel_name;
					}
					
					$check_live_stream_image = @fopen($thumbnail_url['live_stream']['thumbnail_url'],'r');
					
					
					if(!empty($thumbnail_url['live_stream']['thumbnail_url']) && $check_live_stream_image)
					{
					
					
					?>
					<a  alt="<?php echo $channel_string ?>" title="<?php  echo $channel_string?>" href="<?php echo $this->Html->url(array('controller'=>'streams','action'=>'stream_detail',$channel_value['Stream']['id'])); ?>"><img style="height:118px !important;" width="280" src="<?php echo $thumbnail_url['live_stream']['thumbnail_url']; ?>"  alt="<?php echo $channel_string ?>" title="<?php  echo $channel_string?>"/></a>
					<?php
						/* echo $streamPath.$stream_image;
						echo $this->Html->link($this->Html->image(SITE_URL.'/timthumb.php?src='.$thumbnail_url['live_stream']['thumbnail_url'].'&w=320&h=180&a=t',array('class'=>'','alt'=>$channel_value['Stream']['title'],'title'=>$channel_value['Stream']['title'],'class'=>'imgClass')),array('controller'=>'streams','action'=>'stream_detail',$channel_value['Stream']['id']),array('escape'=>false,'alt'=>$channel_value['Stream']['title'],'title'=>$channel_value['Stream']['title'])); *///
					
					
					}
					else
					{
						echo $this->Html->link($this->Html->image(SITE_URL.'/timthumb.php?src='.$streamPath.$stream_image.'&w=280&h=158&a=t',array('class'=>'','alt'=>$channel_string,'title'=>$channel_string,'class'=>'imgClass')),array('controller'=>'streams','action'=>'stream_detail',$channel_value['Stream']['id']),array('escape'=>false,'alt'=>$channel_string,'title'=>$channel_string)); 
					
						//echo $this->Html->link($this->Html->image(SITE_URL.'/timthumb.php?src='.$streamPath.$stream_image.'&w=320&h=180&a=t',array('class'=>'','alt'=>$channel_value['Stream']['title'],'title'=>$channel_value['Stream']['title'],'class'=>'imgClass')),array('controller'=>'streams','action'=>'stream_detail',$channel_value['Stream']['id']),array('escape'=>false,'alt'=>$channel_value['Stream']['title'],'title'=>$channel_value['Stream']['title']));
					}
					?>
					<span>
					<?php 
					
					
					echo $this->Html->link($channel_string,array('controller'=>'streams','action'=>'stream_detail',$channel_value['Stream']['id']),array('escape'=>false,'alt'=>$channel_string,'title'=>$channel_string,'style'=>'color:#fff;')); ?>
					</span>
					</div>
				</li>
			<?php
			}
			?>
		</ul>
		<?php echo $this->element('Front/front_paging', array("paging_model_name" => "Channel", "total_title" => "Channel"));  ?>
		<?php
		}
		else
		{
			//echo $this->Element('no_record_found',array('message'=>'No channels found.'));
		}
		?>
		
		
		
		
		
		
		
		
		
	</div>
 </div>
 <?php echo ($this->element('Front/footer'))?>