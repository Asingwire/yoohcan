<?php /*<button type="button" class="close" data-dismiss="modal">&times;</button>
<div class="login_inside">
	<div class="left-logo">
		<?php echo $this->Html->image('Front/login_left_text.png', array('title'=>'yoohcan','alt'=>'yoohcan')) ?>
	</div>
	<div class="right_text">
		<h1>Forgot Password</h1>
		<?php $this->Layout->sessionFlash(); ?>
		<div class="login-form">		
			<?php echo $this->Form->create('User',array('url'=>array('controller'=>'users','action'=>'forgot_password'),'id'=>'forget_form')); ?>
			<div class="white-outer">
				<?php  echo ($this->Form->input('email', array('div'=>false, 'placeholder'=>'FranciscoGeorge@gmail.com', 'label'=>'Email',"autocomplete"=>"off","maxlength"=>50)));?> 
			</div>			
			<input type="button" class="submit_button" value="Submit" id="foget_submit"/>
			<div class="loading_login"  id="loading_forget_img" style="visibility:hidden">
				<?php echo $this->Html->image('ajax-loader.gif', array('title'=>'loading','alt'=>'loading','id'=>'loading-image')) ?>
			</div>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>
*/ ?>



<button type="button" class="close" data-dismiss="modal">&times;</button>
<div class="login_inside">
  <div class="form_logo">
	<?php echo $this->Html->image('Front/forms_logo.png', array('title'=>'Yoohcan','alt'=>'Yoohcan')); ?>
	<h1 class="sign_up_text sign_up_text_cap1"><span><?php echo Configure::read('SITE_SLOGAN');?></span></h1> 
  </div>
  
  <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 ">
	<div class="login-form sign_form social_cap" style="margin-bottom: 58px;">
		<h1 class="sign_up_text_inner"><span>Reset Your Password</span></h1> 
		<h1 class="sign_up_text_inner"><span>Yoohcan will send reset instructions to the email address associated with your account.</span></h1> 
		</div></div>
  

  <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
	<div class="login-form ">
		<?php $this->Layout->sessionFlash(); ?>
		<?php echo $this->Form->create('User',array('url'=>array('controller'=>'users','action'=>'forgot_password'),'id'=>'forget_form')); ?>
		<div class="sign_in">
		  <label><span class="icon"><?php echo $this->Html->image('Front/user_input.png', array('title'=>'Email','alt'=>'Email')); ?></span>
		  <?php  echo ($this->Form->input('email', array('type'=>'text','validate'=>true,'div'=>false,'label'=>false,"autocomplete"=>"off","maxlength"=>50)));?></label>
		 
		</div>
		<div class="col-xs-12 m-top">
			<input class="submit_btn" type="button" value="Send"   id="foget_submit" />
			
		</div>
	
	   <?php echo $this->Form->end(); ?>
	</div>
  </div>
</div>	

	
