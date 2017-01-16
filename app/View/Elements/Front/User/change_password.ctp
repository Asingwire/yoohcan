<?php 

			echo $this->Html->css('Front/extra');

?>

<style>
input.submit_btn[type="submit"], input.create_account[type="submit"] {
    display: inherit;
    font-size: 27px;
    font-weight: 700;
    margin: 0 auto 15px !important;
    padding: 18px 35px;
    text-transform: uppercase;
    width: 50% !important;
}

</style>


<div class="login_inside" style="margin-top:80px">
  <div class="form_logo">
	<?php echo $this->Html->image('Front/forms_logo.png', array('title'=>'yoohcan','alt'=>'yoohcan')); ?>
	 <h1 class="sign_up_text sign_up_text_cap1"><span><?php echo Configure::read('SITE_SLOGAN');?></span></h1>
  </div>
  <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
	<div class="login-form sign_form social_cap">
		<h1 class="sign_up_text_inner"><span>Change Password In Using Your Registered Account</span></h1> 
		<?php $this->Layout->sessionFlash(); ?>
		<?php echo $this->Form->create('User',array('url'=>array('controller'=>'users','action'=>'change_password',base64_encode($email), $verification_code))); ?>
		<div class="sign_in">
		 
		  <label><span class="icon"><?php echo $this->Html->image('Front/lock_input.png', array('title'=>'Password','alt'=>'Password')); ?></span>
		 
			<?php  echo ($this->Form->input('password1', array('type'=>'password','placeholder'=>'Password','div'=>false,'label'=>false,"autocomplete"=>"off","maxlength"=>30)));?>
		  </label>     
		 
		 <label><span class="icon"><?php echo $this->Html->image('Front/lock_input.png', array('title'=>'Confirm Password','alt'=>'Confirm Password')); ?></span>
		 
			<?php  echo ($this->Form->input('password2', array('type'=>'password','placeholder'=>'Confirm Password','div'=>false, 'label'=>false,"autocomplete"=>"off","maxlength"=>30)));?>
		  </label>                  
		</div>
		
		<div class="col-xs-12 m-top">
			<input class="create_account sgn-btn" value="SUBMIT" type="submit">
			
		</div>
		
	  <?php echo $this->Form->end(); ?>
	</div>
  </div>
</div>