<?php
	//Selected tabs
	$about = '';
	if($this->params['slug'] == 'about-us'){
		$about	= 'activePage';
	}
	?>
<div class="footer">
	<div class="container">
		<div class="row">
			<div class="col-md-3 col-sm-3 col-xs-6">
				<ul class="block1">
					<li><?php echo ($this->Html->link('About Us',array('controller'=>'static_pages', 'action'=>'page','slug'=>AboutUs), array('escape'=>false,'class'=>$about)));?></li>
					<li><?php echo ($this->Html->link('Blog', "#", array('escape'=>false)));?></li>
					<li><?php echo ($this->Html->link('Jobs', "#", array('escape'=>false)));?></li>
				</ul>
			</div>

			<div class="col-md-3 col-sm-3 col-xs-6">
				<ul class="block1">
					<li><?php echo ($this->Html->link('Developers', "#", array('escape'=>false)));?></li>
					<li><?php echo ($this->Html->link('Help', "#", array('escape'=>false)));?></li>
					<li><?php echo ($this->Html->link('Cookies', array('controller'=>'static_pages', 'action'=>'page','slug'=>Cookie), array('escape'=>false)));?></li>
				</ul>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-6">
				<ul class="block1">
					<li><?php echo ($this->Html->link('Imprint', "#", array('escape'=>false)));?></li>
					<li><?php echo ($this->Html->link('Directory', "#", array('escape'=>false)));?></li>
					<li><?php echo ($this->Html->link('Popular Searches', "#", array('escape'=>false)));?></li>
				</ul>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-6">
				<ul class="block1">
					<li>Follow Us</li>
					<li>
						<?php echo ($this->Html->link($this->Html->image('fb.png', array('alt'=>'Facebook','title'=>'Facebook')), "#", array('escape'=>false)));?>
						<?php echo ($this->Html->link($this->Html->image('tw.png', array('alt'=>'Twitter','title'=>'Twitter')), "#", array('escape'=>false)));?>
						<?php echo ($this->Html->link($this->Html->image('in.png', array('alt'=>'Linked-In','title'=>'Linked-In')), "#", array('escape'=>false)));?>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<ul class="termsclass">
		<li>Copyright &copy; 2015 JockDrive</li>   
		<li><?php echo ($this->Html->link('Terms of Use', array('controller'=>'static_pages', 'action'=>'page','slug'=>TermsUse), array('escape'=>false)));?></li>       
		<li><?php echo ($this->Html->link('Privacy Policy', array('controller'=>'static_pages', 'action'=>'page','slug'=>PrivacyPolicy), array('escape'=>false)));?></li>
	</ul>
</div>