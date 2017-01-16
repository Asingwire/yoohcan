<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Dashboard 
		<small>Category Detail</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="javascript:void(0)"><i class="fa fa-dashboard"></i> <?php echo $this->Html->link('Home', array('controller' => 'admins', 'action' => 'dashboard', 'plugin' => null)); ?></a></li>
		<li class="active">Category Detail</li>
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
							<label class="width30Percent">Image</label>
								<?php
									$imagePath	=	IMAGE_PATH_FOR_TIM_THUMB.'/'.CATEGORY_IMAGE_FULL_DIR.'/';
									$image		=	$data['Category']['image'];
													
									$noImage	=	'avatar5.png';
									if($image &&  file_exists(WWW_ROOT.CATEGORY_IMAGE_FULL_DIR.DS.$image )) {
										echo $this->Html->image(SITE_URL.'/timthumb.php?src='.$imagePath.$image.'&w=60&h=60&a=t',array('class'=>'','alt'=>'Category Image','width'=>'60','class'=>'imgClass'));
									} else {
										echo $this->Html->image('Admin/'.$noImage,array('escape'=>false,'class'=>'','alt'=>'No Image','width'=>'60','class'=>'imgClass'));
									} 
								?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">Background Image</label>
								<?php
									$backgroundImagePath	=	IMAGE_PATH_FOR_TIM_THUMB.'/'.CATEGORY_BACKGROUND_IMAGE_FULL_DIR.'/';
									$background_image		=	$data['Category']['background_image'];
													
									$noImage	=	'avatar5.png';
									if($background_image &&  file_exists(WWW_ROOT.CATEGORY_BACKGROUND_IMAGE_FULL_DIR.DS.$background_image )) {
										echo $this->Html->image(SITE_URL.'/timthumb.php?src='.$backgroundImagePath.$background_image.'&w=60&h=60&a=t',array('class'=>'','alt'=>'Category Background Image','width'=>'60','class'=>'imgClass'));
									} else {
										echo $this->Html->image('Admin/'.$noImage,array('escape'=>false,'class'=>'','alt'=>'No Image','width'=>'60','class'=>'imgClass'));
									} 
								?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">Name</label>
								<?php echo ucfirst($data['Category']['name']); ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">Description</label>
								<?php echo ucfirst(nl2br($data['Category']['description'])); ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">Status</label>
								<?php 
									if($data['Category']['status']) {
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
								<?php echo date('d-m-Y h:i:s A',strtotime($data['Category']['created'])); ?>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">Modified</label>
								<?php echo date('d-m-Y h:i:s A',strtotime($data['Category']['modified'])); ?>
							</div>
						</div>
					
						
					</div><!-- /.box-body -->
					<div class="box-footer">
						<?php echo $this->Html->link("Back", array('controller'=>'categories', 'action'=>'index'), array("title"=>"", "escape"=>false ,'class'=>'btn btn-primary')); ?>
					</div>
			</div><!-- /.box -->
		</div>
	</div>
	<!-- /.row -->
</section><!-- /.content -->