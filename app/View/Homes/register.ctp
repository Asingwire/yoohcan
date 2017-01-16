<div class="popwrp register_popwrp">
	<div class="popwrpin">
		<?php $from = null; ?>
		<?php if($this->request->is('ajax') && ( empty($this->request->params['named']) && empty($this->request->params['named']['from']))): ?>
			<ul class="signintab">
				<li class=""><?php echo $this->Html->link('Sign In',array('controller'=>'homes','action'=>'login','ext'=>'html'),array('class'=>'group3 fancybox','border'=>'0')); ?></li>
				<li class="active"><a href="#">sign up</a></li>
			</ul>
		<?php elseif($this->request->is('ajax')): ?>
			<?php $from = (isset($this->request->params['named']) && isset($this->request->params['named']['from'])) ?$this->request->params['named']['from'] : null; ?>
			<div class="full headingrw paddrileft ajax_h2"> <h2><?php echo($title_for_layout);?></h2> </div>
		<?php endif; ?>
		<div class="Clear"></div>
		<div class="signuptabcon">
			<?php if($this->request->is('ajax')){  $this->Layout->sessionFlash();  } ?>
			<?php echo $this->Form->create('User', array('url' => array('controller' => 'homes', 'action' => 'register',"from"=>$from)));?>
				<?php echo ($this->element('Front/User/register-form'));?>
				<div class="clear"></div><!-- End .clear -->
			<?php echo ($this->Form->end());?>	
		</div>
	</div>
  <div class="Clear"></div>
</div>

