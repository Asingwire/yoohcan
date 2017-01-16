<div class="clearfix"></div>
<div class="main-ftr">
	<div class="row">
	<div class="col-xs-12">
		<ul class="ftr-links">
		
		<?php  
		//$data = $this->General->getStaticPages();
		//pr($data);die;
		
		
		?>
		
		<?php $staticPageData =  $this->General->getStaticPages(); ?>
			<?php /*<li><?php echo $this->Html->link('About',array('controller'=>'static_pages', 'action'=>'page','slug'=>AboutUs), array('escape'=>false));?>&nbsp;-&nbsp;</li>
			<li><?php echo $this->Html->link('Blog',array('controller'=>'static_pages', 'action'=>'page','slug'=>Blog), array('escape'=>false));?>&nbsp;-&nbsp;</li>
			<li><?php echo $this->Html->link('FAQ',array('controller'=>'static_pages', 'action'=>'page','slug'=>Faq), array('escape'=>false));?>&nbsp;-&nbsp;</li>
			<li><?php echo $this->Html->link('Platforms',array('controller'=>'static_pages', 'action'=>'page','slug'=>Platforms), array('escape'=>false));?>&nbsp;-&nbsp;</li>
			<li><?php echo $this->Html->link('Jobs',array('controller'=>'static_pages', 'action'=>'page','slug'=>Jobs), array('escape'=>false));?>&nbsp;-&nbsp;</li>
			<li><?php echo $this->Html->link('Help',array('controller'=>'static_pages', 'action'=>'page','slug'=>Help), array('escape'=>false));?>&nbsp;-&nbsp;</li>
			<li><?php echo $this->Html->link('Terms',array('controller'=>'static_pages', 'action'=>'page','slug'=>Terms), array('escape'=>false));?>&nbsp;-&nbsp;</li>
			<li><?php echo $this->Html->link('Privacy Policy',array('controller'=>'static_pages', 'action'=>'page','slug'=>Privacy), array('escape'=>false));?>&nbsp;-&nbsp;</li>
			<li><?php echo $this->Html->link('Cookie Policy',array('controller'=>'static_pages', 'action'=>'page','slug'=>Cookie), array('escape'=>false));?></a></li>
			*/ ?>
			
			
			<?php
				if(!empty($staticPageData)){
					$dataCnt = count($staticPageData);					
					$i = 0;			
					foreach($staticPageData as $key => $val){
			?>
						<li><?php echo $this->Html->link($val['StaticPage']['title'],array('controller'=>'static_pages', 'action'=>'page','slug'=>$val['StaticPage']['slug']), array('escape'=>false));?><?php if($i != $dataCnt - 1){ ?> &nbsp;-&nbsp; <?php } ?></li>
			<?php 
					$i++;
					}
				}
			?>
			
		</ul>
		<p class="ftr-copyright">© Copyright <?php echo date('Y'); ?> | Kabelweg 57 | 1014BA | Amsterdam | +31 (0)88 939 2550 | <a href="mailto:info@yoohcan.com">info@yoohcan.com</a></p>
	</div>
	</div>
</div>