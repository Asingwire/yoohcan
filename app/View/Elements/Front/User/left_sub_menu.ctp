<div class="col-md-2 left_nav_bar">
	<div class="right_menu_bar">
		<p>MENU</p>
		<ul class="inner_menu_01">
			<?php 
			
			/* $sum_menu_array = array('Account Settings'=>array('redirection'=>array('controller'=>'users','action'=>'dashboard'),'title'=>'Account Settings'),'Channel Manager'=>array('redirection'=>array('controller'=>'channels','action'=>'channel_manager'),'title'=>'Channel Manager'),'Streaming List'=>array('redirection'=>array('controller'=>'streams','action'=>'index'),'title'=>'Streaming List'),'Messages'=>array('redirection'=>array('controller'=>'users','action'=>'messages'),'title'=>'Messages'),'Statistics'=>array('redirection'=>array('controller'=>'users','action'=>'statistics'),'title'=>'Statistics')); */
			
			$sum_menu_array = array('My Account'=>array('redirection'=>array('controller'=>'users','action'=>'dashboard'),'title'=>'My Account'),'My Channel'=>array('redirection'=>array('controller'=>'channels','action'=>'channel_manager'),'title'=>'My Channel'),'My Streams'=>array('redirection'=>array('controller'=>'streams','action'=>'index'),'title'=>'My Streams'));
			foreach($sum_menu_array as $menu_name=>$menu_redirection)
			{
				///pr($menu_redirection['redirection']);
				/* echo $menu_redirection['redirection']['controller'];
				echo $menu_redirection['redirection']['action']; */
				$class = '';
				if($this->request->params['controller'] == $menu_redirection['redirection']['controller'] && $this->request->params['action'] ==$menu_redirection['redirection']['action'])
				{
					$class = 'active';
				}
				/* if($this->request->params['controller'] == $menu_redirection['redirection']['controller'] && $this->request->params['redirection']['action'] == $menu_redirection['action'])
				{
					$class = 'active';
				} */
				echo '<li class="'.$class.'">'.$this->Html->link($menu_name,$menu_redirection['redirection'],array('escape'=>false,'title'=>$menu_redirection['title'],'alt'=>$menu_redirection['title'])).'</li>';
			}
			?>
			
			<li><?php echo $this->Html->link('Start Streaming', 'javascript:;', array("onclick"=>"openModal();currentSlide(1)","title"=>"My Streams", "escape"=>false)); ?></li>
			<?php /*<li><a href="#">Security & Privacy</a></li> */ ?>
			<?php /*<li><a href="<?php $this->Html->url(array('controller'=>'streams','action'=>'settings')) ?>">Streaming Settings</a></li> */ ?>
		</ul>
	</div>
	
	
	
		<div class="right_menu_bar" style="background: #000 none repeat scroll 0 0;border-radius: 5px;margin-top: 20px;text-align: center;">		
		<div style="margin-top:10px;">
		<p style="color: #fff;">New Streamer?</p>
		<p style="color: #fff;">Follow these steps:</p>
		</div>
		<div style="border-bottom: 1px solid;"></div>
		<ul class="inner_menu_011 setup_popup" >			
			<?php 
			/* 
			<li><?php echo ($this->Html->link('1. Setup My Account','#', array('rel'=>SITE_URL.'/uploads/static/st1.jpg','title'=>'Setup My Account','escape'=>false)));?></li>
			<li><?php echo ($this->Html->link('2. Create My Channel','#', array('rel'=>SITE_URL.'/uploads/static/st2.jpg','title'=>'Create My Channel','escape'=>false)));?></li>
			<li><?php echo ($this->Html->link('3. Add My Stream','#', array('rel'=>SITE_URL.'/uploads/static/st3.jpg','title'=>'Add My Stream','escape'=>false)));?></li>
			<li><?php echo ($this->Html->link('4. Connect My Stream','#', array('rel'=>SITE_URL.'/uploads/static/st4.jpg','title'=>'Connect My Stream','escape'=>false)));?></li>
			<li><?php echo ($this->Html->link('5. Start Streaming','#', array('rel'=>SITE_URL.'/uploads/static/st5.jpg','title'=>'Start Streaming','escape'=>false)));?></li>
			 */ ?>
			 
			<li><?php echo ($this->Html->link('1. Setup My Account',array('controller'=>'users','action'=>'dashboard'), array('title'=>'Setup My Account','escape'=>false)));?></li>
			<li><?php echo ($this->Html->link('2. Create My Channel',array('controller'=>'channels','action'=>'channel_manager'), array('title'=>'Create My Channel','escape'=>false)));?></li>
			<li><?php echo ($this->Html->link('3. Add My Stream',array('controller'=>'streams','action'=>'add'), array('title'=>'Add My Stream','escape'=>false)));?></li>
			<li><?php echo $this->Html->link('4. Connect My Stream', 'javascript:;', array("onclick"=>"openModal();currentSlide(1)","title"=>"Connect My Stream", "escape"=>false)); ?></li>
			<li><?php echo ($this->Html->link('5. Start Streaming',array('controller'=>'streams','action'=>'index'), array('title'=>'Start Streaming','escape'=>false)));?></li>

			
			<div style="margin-top:10px;">			
				
				<?php echo $this->Html->link($this->Html->image('Front/btn_launch.png', array('alt'=>'Launch Tutorial','title'=>'Launch Tutorial')), 'javascript:;', array("onclick"=>"openModal();currentSlide(1)","title"=>"", "escape"=>false)); ?>
				
							
				<?php if(isset($streaming_guide_pdf) && !empty($streaming_guide_pdf)){
				
				echo $this->Html->link($this->Html->image('Front/btn_download.png'),SITE_URL.'uploads/stream_guide/'.$streaming_guide_pdf,array('escape'=>false,'title'=>'Download Streaming Guide','alt'=>'Download Streaming Guide','target'=>'blank'));
				}?>
			
			
			
				
			</div>			
		</ul>
	</div>
<?php echo $this->Element('/Front/User/image_slider'); ?>
</div>


 <div class="modal fade" id="link_img" role="dialog">
    <div class="modal-dialog md-width">
      <!-- Modal content-->
      <div class="modal-content md-content">
        <div class="modal-header md-header">   		
           <h4 class="modal-title" id="myModalLabel"></h4>
		   <div class="delete_btn"><button type="button" class="close" style="right:1px" data-dismiss="modal">×</button></div>
        </div>
		
		<div id="profile_image_data" class="modal-body md-body">
			<img src="" class="imagepreview">
		</div>
		</div>      
    </div>
 </div>
<script>
 $(document).ready(function(){ 
	var $modal = $('#link_img');
	$('.submenu li a').on('click', function(){	
	$("#myModalLabel").html($(this).attr('data-original-title'));
	$('.imagepreview').attr('src', $(this).attr('rel'));	
	$modal.modal('show');
	});
	
});
</script>