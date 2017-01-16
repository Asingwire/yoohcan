<ul class="channel_list channel_flash_msg">
<?php if(isset($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'videos' && empty($videos)){ ?>

<li>	<?php echo $this->Element('no_record_found',array('message'=>'No videos found.')); ?></li>
<?php } ?>

<?php if(isset($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'streams' && empty($streams) || (!isset($this->request->params['named']['type']) && empty($streams))){ ?>
<li>	<?php echo $this->Element('no_record_found',array('message'=>'No streams found.')); ?></li>
<?php } ?>

</ul>
<ul class="channel_list">


<?php if((!empty($streams)) &&  (isset($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'streams')  || !isset($this->request->params['named']['type']))
	{ 
?>

	<?php
	foreach($streams as $key=>$value)
	{
		$streamPath		=	IMAGE_PATH_FOR_TIM_THUMB.STREAM_IMAGE_FULL_DIR."/";
		$stream_image		=	$value['Stream']['stream_image'];	
		
	?>

	<li>	
		<div>
			<?php echo $this->Html->link($this->Html->image(SITE_URL.'/timthumb.php?src='.$streamPath.$stream_image.'&w=280&h=158&a=t',array('class'=>'','alt'=>$value['Stream']['title'],'title'=>$value['Stream']['title'],'class'=>'imgClass')),array('controller'=>'streams','action'=>'stream_detail',$value['Stream']['id']),array('escape'=>false,'alt'=>$value['Stream']['title'],'title'=>$value['Stream']['title']));  ?>
			<span>
			<?php 
			if(strlen($value['Stream']['title']) > 30)
			{
				$stream_title = substr($value['Stream']['title'],0,30)."..";
			}
			else
			{
				$stream_title = $value['Stream']['title'];
			}
			
			echo $this->Html->link($stream_title,array('controller'=>'streams','action'=>'stream_detail',$value['Stream']['id']),array('escape'=>false,'alt'=>$value['Stream']['title'],'title'=>$value['Stream']['title'],'style'=>'color:#fff;')); 
			
			?>
			</span>		
		</div>
	</li>
	<?php
	}
	}
	?>


<?php 
if(!empty($videos) &&  isset($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'videos')
{
	?>

	<?php
	foreach($videos as $key=>$value)
	{ 
		$recordingPath		=	IMAGE_PATH_FOR_TIM_THUMB.RECORDING_IMAGE_FULL_DIR."/";
		$recording_image		=	$value['RecordingStream']['image'];
		
		if(strlen($value['RecordingStream']['title']) > 30)
		{
			$video_title = substr($value['RecordingStream']['title'],0,30)."..";
		}
		else
		{
			$video_title = $value['RecordingStream']['title'];
		}
		
		?>
			
			<li>
			<div>
			<?php echo $this->Html->link($this->Html->image(SITE_URL.'/timthumb.php?src='.$recordingPath.$recording_image.'&w=280&h=158&a=t',array('class'=>'test','alt'=>$value['RecordingStream']['title'],'title'=>$value['RecordingStream']['title'])),array('controller'=>'streams','action'=>'recorded_stream_detail',$value['RecordingStream']['id']),array("onclick"=>"getdetail('".$value['RecordingStream']['id']."')",'escape'=>false,'alt'=>$value['RecordingStream']['title'],'title'=>$value['RecordingStream']['title']));  ?>
			
			<span>	
			<?php echo $this->Html->link($video_title,array('controller'=>'streams','action'=>'recorded_stream_detail',$value['RecordingStream']['id']),array('escape'=>false,'alt'=>$value['RecordingStream']['title'],'title'=>$value['RecordingStream']['title'],'style'=>'color:#fff;'));  ?>			
			<?php /* echo $this->Html->link($value['RecordingStream']['title'],'javascript:;',array("onclick"=>"getdetail('".$value['RecordingStream']['id']."')",'escape'=>false,'alt'=>$value['RecordingStream']['title'],'title'=>$value['RecordingStream']['title'],'style'=>'color:#fff;')); */  ?>		
			</span>	
			</div>
			</li>
		
		
		
		
		
		
		<?php
	}
	}
	?>

	</ul>
