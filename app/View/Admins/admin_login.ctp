<div class="header"><?php echo $this->Html->image('Admin/logo.png',array('escape'=>false,'class'=>'','height'=>'140px')); ?></div>
	<?php echo $this->Form->create('Admin', array('url' => array('controller' => 'admins', 'action' => 'login'),'class'=>'sdsd'));?>
		<div class="body bg-gray">
			<div class="form-group">
				<?php echo $this->Form->input("Admin.email", array("type" => "text", "div" => false, "label" => false, 'class'=>'form-control','placeholder'=>'Enter Email')); ?>
			</div>
			<div class="form-group">
				<?php echo $this->Form->input("Admin.password", array("type" => "password", "div" => false, "label" => false, 'class'=>'form-control','placeholder'=>'Enter Password'));?>
			</div>          
			<div class="form-group">
				<?php /* <input type="checkbox" name="remember_me"/> Remember me */  ?>
			</div>
		</div>
		<div class="footer">  
			<?php echo $this->Form->submit("Login", array("class" => "btn bg-olive btn-block")); ?>
		</div>
	<?php echo $this->Form->end(); ?>