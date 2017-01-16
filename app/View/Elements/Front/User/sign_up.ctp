<button type="button" class="close" data-dismiss="modal">&times;</button>
<div class="login_inside">
  <div class="form_logo">
	<?php echo $this->Html->image('Front/forms_logo.png', array('title'=>'yoohcan','alt'=>'yoohcan')); ?>
	 <h1 class="sign_up_text sign_up_text_cap1"><span><?php echo Configure::read('SITE_SLOGAN');?></span></h1>
  </div>
  
  	<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
		<div class="login-form sign_form social_cap">
			<h1 class="sign_up_text_inner"><span>Sign In Using Your Social Network</span></h1> 
		</div>
	</div>
  
    <div class="container">
		<ul class="share_link row">
			<li class="col-xs-12 col-md-4 soc-icns"><a href="javascript:;" class="fb_login social_icons" data-attr="facebook_login"><?php echo $this->Html->image('Front/fb.png', array('title'=>'Facebook','alt'=>'facebook login')) ?></a></li>
			<li class="col-xs-12 col-md-4 soc-icns"><?php echo $this->Html->link($this->Html->image('Front/twitter1.png', array('title'=>'Twitter','alt'=>'Twitter')),'javascript:;', array('escape'=>false,'class'=>'twitter_login social_icons','data-attr'=>'twitter_login')); ?></li>
			<li class="col-xs-12 col-md-4 soc-icns"><?php echo $this->Html->link($this->Html->image('Front/linkedin.png', array('title'=>'Linkedin','alt'=>'Linkedin')),"javascript:;", array('escape'=>false,'data-attr'=>'linkdin_login','class'=>'social_icons')); ?></li>
		</ul>
	</div>
	
  <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
	<div class="login-form sign_form">
		<h1 class="sign_up_text_inner"><span>Or Register for a New Account</span></h1> 
		<?php $this->Layout->sessionFlash(); ?>
		<?php echo $this->Form->create('User',array('url'=>array('controller'=>'users','action'=>'register'),'id'=>'signup_form')); ?>
		<div class="sign_in">
		  <label>
		  <span class="icon"><?php echo $this->Html->image('Front/user_input.png', array('title'=>'Nickname','alt'=>'Nickname')); ?></span>
		 
		  <?php  echo $this->Form->input('nickname', array('div'=>false,'placeholder'=>'Nickname','label'=>false,"autocomplete"=>"off","maxlength"=>50));?> 
		  </label>
		  
		  <label><span class="icon"><?php echo $this->Html->image('Front/user_input.png', array('title'=>'First Name','alt'=>'First Name')); ?></span>
		 
			<?php  echo ($this->Form->input('first_name', array('div'=>false,'placeholder'=>'First Name','label'=>false,"autocomplete"=>"off","maxlength"=>50)));?> 
		  </label> 
		  
		  <label><span class="icon"><?php echo $this->Html->image('Front/user_input.png', array('title'=>'Last Name','alt'=>'Last Name')); ?></span>
		 
			<?php  echo ($this->Form->input('last_name', array('div'=>false,'placeholder'=>'Last Name', 'label'=>false,"autocomplete"=>"off","maxlength"=>50)));?> 
		  </label>   
		 
		 <label><span class="icon"><?php echo $this->Html->image('Front/email.png', array('title'=>'Email','alt'=>'Email')); ?></span>
		 
			<?php  echo ($this->Form->input('email', array('type'=>'text','div'=>false,'placeholder'=>'Email', 'label'=>false,"autocomplete"=>"off","maxlength"=>50)));?>
		  </label>     
		  
		  <label><span class="icon"><?php echo $this->Html->image('Front/lock_input.png', array('title'=>'Password','alt'=>'Password')); ?></span>
		 
			<?php  echo ($this->Form->input('password_new', array('type'=>'password','placeholder'=>'Password','div'=>false,'label'=>false,"autocomplete"=>"off","maxlength"=>30)));?>
		  </label>     
		 
		 <label><span class="icon"><?php echo $this->Html->image('Front/lock_input.png', array('title'=>'Confirm Password','alt'=>'Confirm Password')); ?></span>
		 
			<?php  echo ($this->Form->input('confirm_password', array('type'=>'password','placeholder'=>'Confirm Password','div'=>false, 'label'=>false,"autocomplete"=>"off","maxlength"=>30)));?>
		  </label>                  
		</div>
		<div class="col-xs-12">
			<div class="sgnup-btm-lft" style="width:100%;">
				<?php echo $this->Form->input('accept_policy', array('required' =>'required',"type"=>"checkbox","div"=>false,"label"=>false)); ?>
				<span>I have read and agreed with the 
				<?php echo $this->Html->link('Terms',array('controller'=>'static_pages', 'action'=>'page','slug'=>Terms), array('target'=>'_blank','escape'=>false)); ?>, 
				<?php echo $this->Html->link('Privacy Policy',array('controller'=>'static_pages', 'action'=>'page','slug'=>Privacy), array('target'=>'_blank','escape'=>false)); ?> and 
				<?php echo $this->Html->link('Cookie Policy',array('controller'=>'static_pages', 'action'=>'page','slug'=>Cookie), array('target'=>'_blank','escape'=>false)); ?>
				</span>
			</div>
		</div>
		<div class="col-xs-12 m-top">
			<input class="create_account sgn-btn" value="SIGN UP"  id="signup_submit"  type="button">
			
		</div>
		<span class="sign_forgt_pass">Already have an account? <a id="login_submit" data-dismiss="modal" data-target="#loginModal" data-toggle="modal" href="javascript:;">Login here</a></span>
	  
		
		
		
		<?php 
		/*
		<div class="sgnup-btm">
			<div class="sgnup-btm-lft">
				<?php echo $this->Form->input('accept_policy', array('required' =>'required',"type"=>"checkbox","div"=>false,"label"=>false)); ?>
				<span>I have read and agreed with the 
				<?php echo $this->Html->link('Terms',array('controller'=>'static_pages', 'action'=>'page','slug'=>Terms), array('escape'=>false)); ?>, 
				<?php echo $this->Html->link('Privacy Policy',array('controller'=>'static_pages', 'action'=>'page','slug'=>Privacy), array('escape'=>false)); ?> and 
				<?php echo $this->Html->link('Cookie Policy',array('controller'=>'static_pages', 'action'=>'page','slug'=>Cookie), array('escape'=>false)); ?>
				</span>
			</div>
			<div class="sgnup-btm-rht">
				<input class="create_account sgn-btn" value="SIGN UP"  id="signup_submit"  type="button">
				<p>Already have an account? <a id="login_submit" data-dismiss="modal" data-target="#loginModal" data-toggle="modal" href="javascript:;">Login here</a></p>
			</div>
		</div>
		*/?>
		
		
		
		
		
		
	  <?php echo $this->Form->end(); ?>
	</div>
  </div>
</div>
<script type="text/javascript">
<?php
if(isset($check_registration_status) && $check_registration_status)
{
?>

$(".white-outer input").attr("value","");

	$('#signupModal').modal('hide');
	$('#loginModal').modal('show');
	$('#signinmsg').html('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>An verification email has been sent over to your email address. Please click over the verification link.</div>');


<?php
}
?>
</script>
