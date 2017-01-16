<?php   echo $this->Html->script('jquery.validate'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1> Dashboard <small>Category Edit</small> </h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo Router::url(array('controller'=>'admins','action'=>'dashboard'))?>"><i class="fa fa-dashboard"></i> Home </a></li>
		<li class="active">Category Edit</li>
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
					echo($this->Form->create('Category', array('url' => array('controller' => 'categories', 'action' => 'edit'),'class'=>'form-horizontal','type'=>'file')));
					echo($this->Form->hidden('Category.id'));
					echo($this->Form->hidden('token_key', array('value' => $this->params['_Token']['key'])));
					echo($this->Form->hidden('Category.status'));
					echo($this->Form->hidden('Category.featured'));
					echo($this->Form->hidden('Category.image'));
					echo($this->Form->hidden('Category.background_image'));
				?>
				
					<div class="box-body">
						
						<?php
						$imagePath		=	IMAGE_PATH_FOR_TIM_THUMB.'/'.CATEGORY_IMAGE_FULL_DIR.'/';
						$image		=	$this->request->data['Category']['image'];
										
						$noImage	=	'avatar5.png';
						if($image &&  file_exists(WWW_ROOT.CATEGORY_IMAGE_FULL_DIR.DS.$image )) {
							echo $this->Html->image(SITE_URL.'/timthumb.php?src='.$imagePath.$image.'&w=60&h=60&a=t',array('class'=>'','alt'=>'Category Image','width'=>'60','class'=>'imgClass'));
						} else {
							echo $this->Html->image('Admin/'.$noImage,array('escape'=>false,'class'=>'','alt'=>'No Image','width'=>'60','class'=>'imgClass'));
						} 
						?>
						
						<div class="form-group">
							<div class="col-sm-6">
								<label for="exampleInputPassword1">Category Image </label>
								<?php echo ($this->Form->input("Category.cat_image", array("type"=>"file","div"=>false,"label"=>false,"class"=>"file"))); ?>
							</div>
						</div>
						
						
						
						
						<?php
						$backgroundImagePath		=	IMAGE_PATH_FOR_TIM_THUMB.'/'.CATEGORY_BACKGROUND_IMAGE_FULL_DIR.'/';
						$background_image		=	$this->request->data['Category']['background_image'];
										
						$noImage	=	'avatar5.png';
						if($image &&  file_exists(WWW_ROOT.CATEGORY_BACKGROUND_IMAGE_FULL_DIR.DS.$background_image )) {
							echo $this->Html->image(SITE_URL.'/timthumb.php?src='.$backgroundImagePath.$background_image.'&w=60&h=60&a=t',array('class'=>'','alt'=>'Category Background Image','width'=>'60','class'=>'imgClass'));
						} else {
							echo $this->Html->image('Admin/'.$noImage,array('escape'=>false,'class'=>'','alt'=>'No Image','width'=>'60','class'=>'imgClass'));
						} 
						?>
						
						<div class="form-group">
							<div class="col-sm-6">
								<label for="exampleInputPassword1">Category Backgroud Image </label>
								<?php echo ($this->Form->input("Category.cat_back_image", array("type"=>"file","div"=>false,"label"=>false,"class"=>"file"))); ?>
							</div>
						</div>
						
						
						
						
						
						
						
						<div class="form-group">
							<div class="col-sm-6">
							<label for="exampleInputPassword1"> Category Name </label>
								<?php echo ($this->Form->input('Category.name', array('required' => false,'placeholder'=>'Category Name',"type"=>"text","div"=>false,"label"=>false,"class"=>"form-control"))); ?>
							</div>
						</div>
						
						
						<div class="form-group">
							<div class="col-sm-6">
							<label for="exampleInputPassword1"> Category Description </label>
								<?php echo ($this->Form->input('Category.description', array('required' => false,'placeholder'=>'Category Description',"type"=>"textarea","div"=>false,"label"=>false,"class"=>"form-control"))); ?>
							</div>
						</div>
						
						
					</div><!-- /.box-body -->
					
					<div class="box-footer">
						<?php echo $this->Html->link("Back", array('controller'=>'categories', 'action'=>'index'), array("title"=>"", "escape"=>false ,'class'=>'btn btn-primary')); ?>
						
						<?php echo ($this->Form->submit('Submit', array('class' => 'btn btn-primary',"div"=>false))); ?>
						
					</div>
					
				<?php echo($this->Form->end());?>
			</div><!-- /.box -->
		</div>
	</div>
	<!-- /.row -->
</section><!-- /.content -->