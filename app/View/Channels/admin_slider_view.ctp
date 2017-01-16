<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Dashboard 
		<small>View Detail</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="javascript:void(0)"><i class="fa fa-dashboard"></i> <?php echo $this->Html->link('Home', array('controller' => 'admins', 'action' => 'dashboard', 'plugin' => null)); ?></a></li>
		<li class="active">View Detail</li>
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
					<div class="box-body">
						
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">User Name</label>
								<?php echo ucfirst($data['User']['first_name']); ?>
							</div>
						</div>
					
						<div class="form-group" style="border:0px;">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">User Image</label>
								<?php
									$imagePath	=	IMAGE_PATH_FOR_TIM_THUMB.'/'.PROFILE_IMAGE_FULL_DIR.'/';
									$image		=	$data['User']['profile_image'];
													
									$noImage	=	'avatar5.png';
									if($image &&  file_exists(WWW_ROOT.PROFILE_IMAGE_FULL_DIR.DS.$image )) {
										echo $this->Html->image(SITE_URL.'/timthumb.php?src='.$imagePath.$image.'&w=60&h=60&a=t',array('class'=>'','alt'=>'User Image','width'=>'60','class'=>'imgClass'));
									} else {
										echo $this->Html->image('Admin/'.$noImage,array('escape'=>false,'class'=>'','alt'=>'No Image','width'=>'60','class'=>'imgClass'));
									} 
								?>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">Channel Name</label>
								<?php echo ucfirst($data['Channel']['name']); ?>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">Image</label>
								<?php
									$imagePath	=	IMAGE_PATH_FOR_TIM_THUMB.'/'.RECORDING_IMAGE_FULL_DIR.'/';
									$image		=	$data['RecordingStream']['image'];
													
									$noImage	=	'avatar5.png';
									if($image &&  file_exists(WWW_ROOT.RECORDING_IMAGE_FULL_DIR.DS.$image )) {
										echo $this->Html->image(SITE_URL.'/timthumb.php?src='.$imagePath.$image.'&w=300&h=200&a=t',array('class'=>'','alt'=>'Image','width'=>'300','class'=>'imgClass'));
									} else {
										echo $this->Html->image('Admin/'.$noImage,array('escape'=>false,'class'=>'','alt'=>'No Image','width'=>'60','class'=>'imgClass'));
									} 
								?>
							</div>
						</div>
						
						
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">Video Title</label>
								<?php echo ucfirst($data['RecordingStream']['title']); ?>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">Description</label>
								<?php echo $data['RecordingStream']['description']; ?>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">Stream Key</label>
								<?php echo $data['RecordingStream']['stream_key']; ?>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">Recording Key</label>
								<?php echo $data['RecordingStream']['recording_key']; ?>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">Download Url</label>
								<?php echo $data['RecordingStream']['download_url']; ?>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">Play Count</label>
								<?php echo $data['Channel']['play_count']; ?>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">Status</label>
								<?php 
									if($data['RecordingStream']['status']) {
										echo "Active";
									} else {
										echo "Inactive";
									}
									
								?>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">Created</label>
								<?php echo date('d-m-Y h:i:s A',strtotime($data['RecordingStream']['created'])); ?>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">Modified</label>
								<?php echo date('d-m-Y h:i:s A',strtotime($data['RecordingStream']['modified'])); ?>
							</div>
						</div>
					</div><!-- /.box-body -->
					<div class="box-footer">
						<?php echo $this->Html->link("Back", 'javascript:;', array("onclick"=>"history.go(-1)","title"=>"", "escape"=>false ,'class'=>'btn btn-primary')); ?>
					</div>
			</div><!-- /.box -->
		</div>
	</div>
	<!-- /.row -->
</section><!-- /.content -->