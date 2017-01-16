<div class="slide_img">
<?php  //echo $this->Session->flash();?>
  <div class="container ">
    <!--header section-->
    <div class="row">
      <div class="col-md-2 col-sm-2 col-xs-6 logohead">
        <div class="logo"><?php echo ($this->Html->link($this->Html->image('logo.png', array('alt'=>'JockDrive','title'=>'JockDrive')), array('controller'=>'homes','action'=>'index'), array('escape'=>false)));?></div>
      </div>
      <div class="col-md-4 col-sm-6 col-xs-6 col-md-offset-6 col-sm-offset-4 headright-btn">
        <ul class="top_btn pull-right">
          <li>
            <div class="sign_in_btn">
			<?php
				if($this->Session->check('Auth.FrontUser') ){
						echo ($this->Html->link('<span style="color:#fff;">Welcome, '.$this->Session->read('Auth.FrontUser.username').'</span>', array('controller'=>'feeds','action'=>'explore'), array('escape'=>false,'class'=>''))); 
				} else {
					echo ($this->Html->link('Sign in', array('controller'=>'users','action'=>'login'), array('escape'=>false,'class'=>'nav-item fancybox','id'=>'LoginBtn','data-fancybox-type'=>'ajax'))); 
				}
			?></div>
          </li>
          <li>
            <div class="create_account">
			<?php 
				if($this->Session->check('Auth.FrontUser') ){
					echo $this->Html->link('Logout',array('controller'=>'users','action'=>'logout'),array('escape' => false,'class'=>'nav-item','id'=>'')); 
				} else {
					 echo ($this->Html->link('Create Account',array('controller'=>'users','action'=>'signup'), array('escape'=>false,'class'=>'nav-item fancybox','id'=>'SignupBtn','data-fancybox-type'=>'ajax')));
				}
			?></div>
          </li>
        </ul>
      </div>
    </div>
    <!--//header section-->
   
