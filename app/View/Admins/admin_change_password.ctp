<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Dashboard
		<small>Change Password</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="javascript:void(0)"><i class="fa fa-dashboard"></i> <?php echo $this->Html->link('Home', array('controller' => 'admins', 'action' => 'dashboard', 'plugin' => null)); ?></a></li>
		<li class="active">Change Password</li>
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
				echo($this->Form->create('Admin', array('url' => array('controller' => 'admins', 'action' => 'change_password'),'class'=>'form-horizontal')));
				echo($this->Form->hidden('token_key', array('value' => $this->params['_Token']['key'])));
				?>
					<div class="box-body">
						<div class="form-group">
							<div class="col-sm-6">
							<label for="exampleInputPassword1">Old Password </label>
							
							<?php echo ($this->Form->input('old_password', array('type'=>'password','placeholder'=>'Enter old password','div' => false, 'label' => false, "class" => "form-control "))); ?>
							</div>
						</div>
						<div class="form-group">
						<div class="col-sm-6">
							<label for="exampleInputPassword1">New Password</label>
							<?php echo ($this->Form->input('new_password', array('type'=>'password','placeholder'=>'Enter new password','div' => false, 'label' => false, "class" => "form-control"))); ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6">
							<label for="exampleInputPassword1">Confirm Password</label>
							<?php echo ($this->Form->input('confirm_password', array('type'=>'password','placeholder'=>'Enter confirm password','div' => false, 'label' => false, "class" => "form-control"))); ?>
							</div>
						</div>
					</div><!-- /.box-body -->
					<div class="box-footer">
						<?php echo ($this->Form->submit('Submit', array('class' => 'btn btn-primary'))); ?>
					</div>
				<?php echo($this->Form->end());?>
			</div><!-- /.box -->
		</div>
	</div>
	<!-- /.row -->
</section><!-- /.content -->