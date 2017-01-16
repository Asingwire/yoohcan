<div class="login_popup login_popwrp">
<?php $from = null; ?>
			<?php if(($this->request->is('ajax') && empty($this->request->params['named']['from']))  || ( $this->request->is('ajax') && !empty($this->request->params['named']) && !empty($this->request->params['named']['from'])) && $this->request->params['named']['from'] != "register"): ?>
				<ul class="signintab">
					<li class="active"><a href="#">Sign in</a></li>
					<li><?php echo $this->Html->link('SIGN UP',array('controller'=>'users','action'=>'register','ext'=>'html'),array('class'=>'group2 fancybox','border'=>'0')); ?></li>
				</ul>
			<?php elseif($this->request->is('ajax')): ?>
				<?php $from = $this->request->params['named']['from']; ?>
				<div class="full headingrw paddrileft ajax_h2"></div>
			<?php endif; ?>
			<div class="Clear"></div>

<div class="login_inside">
<div class="left-logo"><?php echo ($this->Html->image('../img/Front/login_left_text.png')); ?></div>
<div class="right_text">
<h1>Change Password</h1>
<div class="login-form signuptabcon">
	<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'get_password',base64_encode($email), $verification_code),
				'inputDefaults' => array(
					'error' => array(
						'attributes' => array(
						'wrap' => 'span',
						'class' => 'notification error png_bg'
						)
					)
				)
			));?>
	<?php if($this->request->is('ajax')){  $this->Layout->sessionFlash();  } ?>
<?php echo ($this->element('Front/User/get-password-form'));?>

<?php echo ($this->Form->end());?>
</div>
</div>
<div class="bottom-bar">
<ul>  
<li><a href="#">About</a></li>
<li><a href="#">FAQ</a></li>
<li><a href="#">Sales</a></li>
<li><a href="#">Dashboard</a></li>
</ul>
<span class="sign_up_link"><a href="#">Don’t have an account yet? Sign Up</a></span>

</div>
</div>


</div>

















