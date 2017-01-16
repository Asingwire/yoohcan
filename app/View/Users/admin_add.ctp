<?php   echo $this->Html->script('jquery.validate'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1> Dashboard <small>User Add</small> </h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo Router::url(array('controller'=>'admins','action'=>'dashboard'))?>"><i class="fa fa-dashboard"></i> Home </a></li>
		<li class="active">User Add</li>
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
					echo($this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'add'),'class'=>'form-horizontal','type'=>'file')));
					echo($this->Form->hidden('token_key', array('value' => $this->params['_Token']['key'])));
					echo($this->Form->hidden('User.status', array('value' => 1)));
				?>
				
					<div class="box-body">						
						<div class="form-group">
							<div class="col-sm-6">
								<label for="exampleInputPassword1">Upload Profile Pic </label>
								<?php echo ($this->Form->input("User.image", array("type"=>"file","div"=>false,"label"=>false,"class"=>"file"))); ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6">
								<label for="exampleInputPassword1">Upload Background Pic </label>
								<?php echo ($this->Form->input("User.image1", array("type"=>"file","div"=>false,"label"=>false,"class"=>"file"))); ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6">
							<label for="exampleInputPassword1"> First Name </label>
								<?php echo ($this->Form->input('User.first_name', array('required' => false,'placeholder'=>'First Name',"type"=>"text","div"=>false,"label"=>false,"class"=>"form-control"))); ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6">
							<label for="exampleInputPassword1"> Last Name </label>
								<?php echo ($this->Form->input('User.last_name', array('required' => false,'placeholder'=>'Last Name',"type"=>"text","div"=>false,"label"=>false,"class"=>"form-control"))); ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6">
							<label for="exampleInputPassword1"> Nick Name </label>
								<?php echo ($this->Form->input('User.nickname', array('required' => false,'placeholder'=>'Nick Name',"type"=>"text","div"=>false,"label"=>false,"class"=>"form-control"))); ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6">
							<label for="exampleInputPassword1"> Email </label>
								<?php echo ($this->Form->input('User.email', array('required' => false,'placeholder'=>'Email',"type"=>"text","div"=>false,"label"=>false,"class"=>"form-control"))); ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6">
							<label for="exampleInputPassword1"> Password </label>
								<?php echo ($this->Form->input('User.new_password', array('required' => false,'placeholder'=>'Password',"type"=>"password","div"=>false,"label"=>false,"class"=>"form-control"))); ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6">
							<label for="exampleInputPassword1"> Featured </label>
								<?php echo ($this->Form->input('User.featured', array('required' => false,"type"=>"checkbox","div"=>false,"label"=>false,"class"=>"form-control"))); ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6">
							<label for="exampleInputPassword1"> Bio Update </label>
								<?php echo ($this->Form->input('User.bio_update', array('required' => false,'placeholder'=>'Bio Update',"type"=>"textarea","div"=>false,"label"=>false,"class"=>"form-control"))); ?>
							</div>
						</div>
						
						
					</div><!-- /.box-body -->
					
					<div class="box-footer">
						<?php echo $this->Html->link("Back", array('controller'=>'users', 'action'=>'index'), array("title"=>"", "escape"=>false ,'class'=>'btn btn-primary')); ?>
						
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
			
			var imageWidth	=	'400';
			var imageHight	=	'400';
			
			var file, img;
			
			var id		=	$(this).attr('id');
			var name	=	$(this).attr('name');
				
			if ((file = this.files[0])) {
				
				img = new Image();
				img.onload = function () {
					
					if(this.width < imageWidth || this.height < imageHight) {
						alert("Please upload 400*400  or big size image.");
						$(this).replaceWith('<input type="file" id="'+id+'" name="'+name+'" class="file">');
					}
				};
				img.src = _URL.createObjectURL(file);
			}
			
			/// go through the list of files
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