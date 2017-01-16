<div class="menu-left">
<?php /* <span class="chat-slide"><a href="#"><?php echo ($this->Html->image('Front/chat-icn.png')); ?></a></span> */ ?>
  <ul>
    <!--
	<li class="menu"><a href="#">Menu</a></li>
	<li class="setting"><a href="#">DASHBOARD</a></li>
    <li class="video"><a href="#">MY CHANNEL</a></li>
    <li class="dropbox"><a href="#">CHANNELS</a></li>
	
	-->
	<li class="menu"><?php echo $this->Html->link('Home',array('controller'=>'homes','action'=>'index'),array('title'=>'Home','alt'=>'Home','escape'=>false)); ?></li>
	
    <?php
	if($this->Session->check('Auth.User.id'))
	{
	?>
		<li class="setting">
	<?php	
		echo $this->Html->link('DASHBOARD',array('controller'=>'users','action'=>'dashboard'),array('escape'=>false,'title'=>'Dashboard','alt'=>'Dashboard'));
	?>
		</li>
	<?php
		
	}
	/* else
	{
		echo $this->Html->link('DASHBOARD','javascript:;',array('title'=>'Dashboard','alt'=>'Dashboard','data-target'=>'#loginModal','data-toggle'=>'modal','escape'=>false));
	} */
	?>
	
	
	<?php
	if($this->Session->check('Auth.User.id'))
	{
		?>
		<li class="video">
		<?php
		echo $this->Html->link('MY CHANNEL',array('controller'=>'channels','action'=>'my_channel'),array('escape'=>false,'title'=>'My Channel','alt'=>'My Channel'));
		?>
		</li>
		<?php
	}
	/* else
	{
		echo $this->Html->link('MY CHANNEL','javascript:;',array('data-target'=>'#loginModal','data-toggle'=>'modal','escape'=>false,'title'=>'My Channel','alt'=>'My Channel'));
	} */
	?>
	
    <li class="dropbox"><?php echo $this->Html->link('CHANNELS',array('controller'=>'channels','action'=>'index'),array('escape'=>false,'title'=>'Channels','alt'=>'Channels')); ?></li>
    <span class="close01"><?php echo ($this->Html->image('Front/close.png')); ?></span>
  </ul>
</div>

<script type="text/javascript">
	/* $(document).on('ready', function() {

	$(".chat-slide a, .close-btn a").click(function(){
	$(".chat-part").slideToggle();
	});

	}); */
	</script>