<button type="button" class="close" data-dismiss="modal">&times;</button>
<div class="login_inside">
  <div class="form_logo">
	<?php echo $this->Html->image('Front/forms_logo.png', array('title'=>'yoohcan','alt'=>'yoohcan')); ?>
	<h1 class="sign_up_text sign_up_text_cap1"><span><?php echo Configure::read('SITE_SLOGAN');?></span></h1> 
  </div>
  
 
  <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
	<div class="login-form sign_form social_cap">
		<h1 class="sign_up_text_inner"><span>Sign In Using Your Social Network</span></h1> 
		
		</div></div>
  
  
  <div class="container">
	<ul class="share_link row">
		  <li class="col-xs-12 col-md-4 soc-icns"><a href="javascript:;" class="fb_login social_icons" data-attr="facebook_login"><?php echo $this->Html->image('Front/fb.png', array('title'=>'Facebook','alt'=>'facebook login')) ?></a></li>
		  <li class="col-xs-12 col-md-4 soc-icns"><?php echo $this->Html->link($this->Html->image('Front/twitter1.png', array('title'=>'Twitter','alt'=>'Twitter')),'javascript:;', array('escape'=>false,'class'=>'twitter_login social_icons','data-attr'=>'twitter_login')); ?></li>
		  <li class="col-xs-12 col-md-4 soc-icns"><?php echo $this->Html->link($this->Html->image('Front/linkedin.png', array('title'=>'Linkedin','alt'=>'Linkedin')),"javascript:;", array('escape'=>false,'data-attr'=>'linkdin_login','class'=>'social_icons')); ?></li>
		</ul>
  </div>
  
  <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
	<div class="login-form sign_form">
		<h1 class="sign_up_text_inner"><span>Sign In Using Your Registred Account</span></h1>
			 <div id="signinmsg"></div>
	  <?php $this->Layout->sessionFlash(); ?>
	<?php echo $this->Form->create('User',array('url'=>array('controller'=>'users','action'=>'register'),'id'=>'login_form')); ?>
		<div class="sign_in">
		  <label><span class="icon"><?php echo $this->Html->image('Front/user_input.png', array('title'=>'Email','alt'=>'Email')); ?></span><?php  echo ($this->Form->input('email', array('type'=>'text','validate'=>true,'placeholder'=>'Email','div'=>false,'label'=>false,"autocomplete"=>"off","maxlength"=>50)));?></label>
		  <label><span class="icon"><?php echo $this->Html->image('Front/lock_input.png', array('title'=>'Password','alt'=>'Password')); ?></span>
		  
		  
		  <?php  echo ($this->Form->input('password_new', array('validate'=>true,'placeholder'=>'Password','type'=>'password','div'=>false,  'label'=>false,"autocomplete"=>"off","maxlength"=>30)));?>
		  
		  </label>                  
		</div>
		<div class="col-xs-12">
			<div class="sgnup-btm-lft" style="width:100%;">
				<?php
				/* <?php echo $this->Form->input('accept_policy', array('required' =>'required',"id"=>"login_terms_conditions","type"=>"checkbox","div"=>false,"label"=>false)); ?>
				<span>I have read and agreed with the 
				<?php echo $this->Html->link('Terms',array('controller'=>'static_pages', 'action'=>'page','slug'=>Terms), array('escape'=>false)); ?>, 
				<?php echo $this->Html->link('Privacy Policy',array('controller'=>'static_pages', 'action'=>'page','slug'=>Privacy), array('escape'=>false)); ?> and 
				<?php echo $this->Html->link('Cookie Policy',array('controller'=>'static_pages', 'action'=>'page','slug'=>Cookie), array('escape'=>false)); ?>
				</span> */
				?>
			</div>
		</div>
		<div class="col-xs-12 m-top">
			<input class="submit_btn" type="button" value="Sign in"  id="login_submit_button"/>
			<!--<input class="create_account" type="button" value="CREATE ACCOUNT" />-->
		</div>
		<span class="sign_forgt_pass">Don’t have an account? <a href="javascript:;" data-dismiss="modal" data-toggle="modal" data-target="#signupModal" id="signupLink">Sign Up</a><br /><a href="javascript:;" data-dismiss="modal"  data-toggle="modal" data-target="#forgetModal" id="foggetLink">Forgot Password</a></span>
	   <?php echo $this->Form->end(); ?>
	</div>
  </div>
</div>	
