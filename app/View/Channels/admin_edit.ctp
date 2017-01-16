<?php   echo $this->Html->script('jquery.validate'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1> Dashboard <small>Recorded Stream Edit</small> </h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo Router::url(array('controller'=>'admins','action'=>'dashboard'))?>"><i class="fa fa-dashboard"></i> Home </a></li>
		<li class="active">Recorded Stream Edit</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<!-- top row -->
	<div class="row">
		<div class="col-md-12">
			<!-- general form elements -->
			<div class="box box-primary">
				<!-- form start -->
				<?php 
			
					echo($this->Form->create('RecordingStream', array('url' => array('controller' => 'channels', 'action' => 'edit'),'class'=>'form-horizontal','type'=>'file')));
					echo $this->Form->hidden('RecordingStream.id');
					echo $this->Form->hidden('RecordingStream.user_id');
					echo $this->Form->hidden('RecordingStream.channel_id');
					echo $this->Form->hidden('RecordingStream.stream_id');
					echo($this->Form->hidden('token_key', array('value' => $this->params['_Token']['key'])));
					echo($this->Form->hidden('RecordingStream.status', array('value' => 1)));
					echo($this->Form->hidden('RecordingStream.is_home', array('value' => $this->request->data['RecordingStream']['is_home'])));
					echo($this->Form->hidden('RecordingStream.image'));
				?>
				
					<div class="box-body">
						<?php
						$imagePath		=	IMAGE_PATH_FOR_TIM_THUMB.'/'.RECORDING_IMAGE_FULL_DIR.'/';
						$image		=	$this->request->data['RecordingStream']['image'];
										
						$noImage	=	'avatar5.png';
						if($image &&  file_exists(WWW_ROOT.RECORDING_IMAGE_FULL_DIR.DS.$image )) {
							echo $this->Html->image(SITE_URL.'/timthumb.php?src='.$imagePath.$image.'&w=300&h=200&a=t',array('class'=>'','alt'=>'Profile Image','width'=>'300','class'=>'imgClass'));
						} else {
							echo $this->Html->image('Admin/'.$noImage,array('escape'=>false,'class'=>'','alt'=>'No Image','width'=>'60','class'=>'imgClass'));
						} 
						?>
						
						<div class="form-group">
							<div class="col-sm-6">
								<label for="exampleInputPassword1">Upload Image </label>
								<?php echo ($this->Form->input("RecordingStream.recording_stream_image", array("type"=>"file","div"=>false,"label"=>false,"class"=>"file"))); ?>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-6">
							<label for="exampleInputPassword1"> Title </label>
								<?php echo ($this->Form->input('RecordingStream.title', array('required' => false,'placeholder'=>'Title',"type"=>"text","div"=>false,"label"=>false,"class"=>"form-control"))); ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6">
							<label for="exampleInputPassword1"> Description </label>
								<?php echo ($this->Form->input('RecordingStream.description', array('required' => false,'placeholder'=>'Description',"type"=>"textarea","div"=>false,"label"=>false,"class"=>"form-control"))); ?>
							</div>
						</div>
						
					</div><!-- /.box-body -->
					
					<div class="box-footer">
						<?php echo $this->Html->link("Back", 'javascript:;', array("onclick"=>"history.go(-1)","title"=>"", "escape"=>false ,'class'=>'btn btn-primary')); ?>
						
						<?php echo ($this->Form->submit('Submit', array('class' => 'btn btn-primary',"div"=>false))); ?>
						
					</div>
					
				<?php echo($this->Form->end());?>
			</div><!-- /.box -->
		</div>
	</div>
	<!-- /.row -->
</section><!-- /.content -->

<script type="text/javascript">
	$(function(){
		
		var _URL = window.URL || window.webkitURL;
		
		$("input.file").on('change',function (e) {
			
			var imageWidth	=	'200';
			var imageHight	=	'200';
			
			var file, img;
			
			var id		=	$(this).attr('id');
			var name	=	$(this).attr('name');
				
			if ((file = this.files[0])) {				
				img = new Image();
				img.onload = function () {
					
					if(this.width < imageWidth || this.height < imageHight) {
						alert("Please upload 200*200 or big size image for better image quality.");
						$(this).replaceWith('<input type="file" id="'+id+'" name="'+name+'" class="file">');
					}
				};
				img.src = _URL.createObjectURL(file);
			}
			
			// Go through the list of files
			for (var i = 0, file; file = this.files[i]; i++) {
				var sFileName = file.name;
				var sFileExtension = sFileName.split('.')[sFileName.split('.').length - 1].toLowerCase();
				
				if(sFileExtension != 'gif' && sFileExtension != 'jpeg' && sFileExtension != 'jpg' && sFileExtension != 'png' ) {
					alert('Please upload a valid image file (jpg/png/gif/jpeg)');
					$(this).replaceWith('<input type="file" id="'+id+'" name="'+name+'" class="file">');
				}
			}
		});
		
	});
</script>	