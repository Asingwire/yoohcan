<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Dashboard 
		<small>Admin Edit</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="javascript:void(0)"><i class="fa fa-dashboard"></i> <?php echo $this->Html->link('Home', array('controller' => 'admins', 'action' => 'dashboard', 'plugin' => null)); ?></a></li>
		<li class="active">Admin Edit</li>
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
				echo($this->Form->create('Admin', array('url' => array('controller' => 'admins', 'action' => 'edit'),'class'=>'form-horizontal')));
				echo($this->Form->hidden('token_key', array('value' => $this->params['_Token']['key'])));
				echo($this->Form->hidden('Admin.id'));
				?>
					<div class="box-body">
						
						<div class="form-group">
							<div class="col-sm-6">
								<label for="exampleInputPassword1">First Name </label>
								<?php echo ($this->Form->input("Admin.first_name", array('placeholder'=>'First Name',"type"=>"text",'required'=>false,"div"=>false,"label"=>false,"class"=>"form-control"))); ?>
							</div>
						</div>
					
						<div class="form-group">
							<div class="col-sm-6">
								<label for="exampleInputPassword1">Last Name </label>
								<?php echo ($this->Form->input("Admin.last_name", array('placeholder'=>'Last Name',"type"=>"text",'required'=>false,"div"=>false,"label"=>false,"class"=>"form-control"))); ?>
							</div>
						</div>
					
						<div class="form-group">
							<div class="col-sm-6">
								<label for="exampleInputPassword1">Nick Name </label>
								<?php echo ($this->Form->input("Admin.nickname", array('placeholder'=>'Nick Name',"type"=>"text",'required'=>false,"div"=>false,"label"=>false,"class"=>"form-control"))); ?>
							</div>
						</div>
					
						<div class="form-group">
							<div class="col-sm-6">
								<label for="exampleInputPassword1">Email Address </label>
								<?php echo ($this->Form->input("Admin.email", array('placeholder'=>'Email Address',"type"=>"text",'required'=>false,"div"=>false,"label"=>false,"class"=>"form-control"))); ?>
							</div>
						</div>						
						
						<div class="form-group">
							<div class="col-sm-6">
							<label for="exampleInputPassword1">Status </label>
								<?php echo ($this->Form->input("Admin.status", array('options'=>array('1'=>'Active','0'=>'Inactive'),'required'=>false,"div"=>false,"label"=>false,"class"=>"form-control"))); ?>
							</div>
						</div>						
							
					</div><!-- /.box-body -->
					<div class="box-footer">
					
						<?php echo $this->Html->link("Back", array('controller'=>'admins', 'action'=>'index'), array("title"=>"", "escape"=>false ,'class'=>'btn btn-primary')); ?>
						<?php echo ($this->Form->submit('Submit', array('class' => 'btn btn-primary',"div"=>false))); ?>
					</div>
				<?php echo($this->Form->end());?>
			</div><!-- /.box -->
		</div>
	</div>
	<!-- /.row -->
</section><!-- /.content -->