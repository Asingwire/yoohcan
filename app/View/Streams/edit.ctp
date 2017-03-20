<?php
	echo $this->Html->css(array('datetimepicker/bootstrap-datetimepicker'));
	echo($this->Html->script(array('datetimepicker/moment','datetimepicker/bootstrap-datetimepicker.min')));
?>

<div class="right-contant" style="min-height:800px;">  


	<div class="col-md-12 channel_detail">  
		
		<?php echo ($this->Element('Front/User/left_sub_menu'));?>
		<div class="col-md-10">
		
			<div class="col-md-6 streaming-box_70 set-left">
				
				<p>Edit Stream</p>
				
				<div class="stream-details-box" style="width: auto;"><br/>
					<?php echo $this->Session->flash(); ?>

					<div class="signuptabcon">
						<?php 
							echo $this->Form->create('Stream', array('url' => array('controller' => 'streams', 'action' => 'edit'),'class'=>'form-horizontal','type'=>'file'));
						?>	
						<ul class="signinfrm">
							<?php  echo ($this->Form->input('id'));
									echo $this->Form->hidden('Stream.stream_image');
							?>
							<li>
								<?php
								$imagePath		=	IMAGE_PATH_FOR_TIM_THUMB.'/'.STREAM_IMAGE_FULL_DIR.'/';
								$image		=	$this->request->data['Stream']['stream_image'];
												
								$noImage	=	'avatar5.png';
								if($image &&  file_exists(WWW_ROOT.STREAM_IMAGE_FULL_DIR.DS.$image )) {
									echo $this->Html->image(SITE_URL.'/timthumb.php?src='.$imagePath.$image.'&w=480&h=270&a=t',array('class'=>'','alt'=>$stream_data['Stream']['title'],'class'=>'imgClass'));
								} else {
									echo $this->Html->image('Front/stream_no_image.png',array('escape'=>false,'class'=>'','alt'=>$stream_data['Stream']['title'],'height'=>'270','width'=>'480','class'=>'imgClass'));
								} 
								?>
							</li>
							<li>
								<?php echo ($this->Form->input("image", array( 'label'=>'Image<span class="red_star_mendatry">*</span>',"type"=>"file","div"=>false,"class"=>"file"))); ?>
							</li>
							
							<li>
							<?php  echo ($this->Form->input('title', array('div'=>false, 'placeholder'=>false, 'label'=>'Title<span class="red_star_mendatry">*</span>',"autocomplete"=>"off", "class" => "signfild","maxlength"=>200)));?>
							</li>
							
							<li>
								<?php  echo ($this->Form->input('subject', array('div'=>false, 'placeholder'=>false, 'label'=>'Subject<span class="red_star_mendatry">*</span>',"autocomplete"=>"off", "class" => "signfild")));?>
							</li>
							
							<li>
								<?php  echo ($this->Form->input('stream_bio', array('div'=>false, 'label'=>'Video Description', "class" => "signfild1", 'rows'=>'5')));?>
								
							</li>
							<li>
								<?php  echo ($this->Form->input('notes', array('div'=>false, 'placeholder'=>false, 'label'=>'Note',"autocomplete"=>"off", "class" => "signfild1")));?>
							</li>
							
							
							<li>
								<?php  echo ($this->Form->submit("Save", array('class' => 'submit_btn', "div"=>false)));?>
							</li>
						</ul>
						<?php echo ($this->Form->end());?>
					</div>
		
				</div>
			</div>
			
		</div>
	</div>
</div>
<?php echo $this->element('Front/footer'); ?>
<script>
$(function() {
		$('#StreamScheduleStartDate').datetimepicker({
			format:"YYYY-MM-DD",
		});
		$('#StreamScheduleStartTime').datetimepicker({
			format:"HH:mm",
		});
		
		
	});
</script>
