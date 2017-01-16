<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Dashboard 
		<small>User Detail</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="javascript:void(0)"><i class="fa fa-dashboard"></i> <?php echo $this->Html->link('Home', array('controller' => 'admins', 'action' => 'dashboard', 'plugin' => null)); ?></a></li>
		<li class="active">User Detail</li>
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
							<label class="width30Percent">Profile Image</label>
								<?php
									$imagePath	=	IMAGE_PATH_FOR_TIM_THUMB.'/'.PROFILE_IMAGE_FULL_DIR.'/';
									$image		=	$data['User']['profile_image'];
													
									$noImage	=	'avatar5.png';
									if($image &&  file_exists(WWW_ROOT.PROFILE_IMAGE_FULL_DIR.DS.$image )) {
										echo $this->Html->image(SITE_URL.'/timthumb.php?src='.$imagePath.$image.'&w=60&h=60&a=t',array('class'=>'','alt'=>'Profile Image','width'=>'60','class'=>'imgClass'));
									} else {
										echo $this->Html->image('Admin/'.$noImage,array('escape'=>false,'class'=>'','alt'=>'No Image','width'=>'60','class'=>'imgClass'));
									} 
								?>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">Bcakground Image</label>
								<?php
									$imagePath	=	IMAGE_PATH_FOR_TIM_THUMB.'/'.BACKGROUND_IMAGE_FULL_DIR.'/';
									$image		=	$data['User']['background_image'];
													
									$noImage	=	'avatar5.png';
									if($image &&  file_exists(WWW_ROOT.BACKGROUND_IMAGE_FULL_DIR.DS.$image )) {
										echo $this->Html->image(SITE_URL.'/timthumb.php?src='.$imagePath.$image.'&w=60&h=60&a=t',array('class'=>'','alt'=>'Profile Image','width'=>'60','class'=>'imgClass'));
									} else {
										echo $this->Html->image('Admin/'.$noImage,array('escape'=>false,'class'=>'','alt'=>'No Image','width'=>'60','class'=>'imgClass'));
									} 
								?>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">First Name</label>
								<?php echo ucfirst($data['User']['first_name']); ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">Last Name</label>
								<?php echo ucfirst($data['User']['last_name']); ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">Nick Name</label>
								<?php echo ucfirst($data['User']['nickname']); ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">Email</label>
								<?php echo $data['User']['email']; ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">Status</label>
								<?php 
									if($data['User']['status']) {
										echo "Active";
									} else {
										echo "Inactive";
									}
									
								?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">Bip Update</label>
								<?php echo $data['User']['bio_update']; ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">User Type</label>
								<?php echo Configure::read('User.Paid.Type.'.$data['User']['is_paid']); ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">Created</label>
								<?php echo date('d-m-Y h:i:s A',strtotime($data['User']['created'])); ?>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">Modified</label>
								<?php echo date('d-m-Y h:i:s A',strtotime($data['User']['modified'])); ?>
							</div>
						</div>
					</div><!-- /.box-body -->
					<div class="box-footer">
						<?php echo $this->Html->link("Back", array('controller'=>'users', 'action'=>'index'), array("title"=>"", "escape"=>false ,'class'=>'btn btn-primary')); ?>
					</div>
			</div><!-- /.box -->
		</div>
	</div>
	<!-- /.row -->
</section><!-- /.content -->