<div class="col-lg-12">
	<div class="panel panel-default">
		<div class="panel-heading"> Update Site Setting </div>
		<div class="panel-body">
			<?php  echo $this->Form->create('Setting',array('url' => array('controller' => 'settings', 'action' => 'index'),'type'=>'file',"role"=>"form"));?>
			<?php //echo ($this->element('Admin/Setting/form'));?>
			<?php
				$half = round((count($this->data))/2);
				$first_half = $second_half = array();
				foreach($this->data as $key=>$value){
					if($key < $half){
						$first_half[] = $value;
					}else{
						$second_half[] = $value;
					}
				}
				$ctr = 0;
			?>
			<div class="col-lg-6">
				<?php foreach($first_half as $elements): ?>
					<?php $type = isset($elements['Setting']['type']) ? $elements['Setting']['type'] : "text"; ?>
					<?php //$after = isset($elements['Setting']['description']) ? $elements['Setting']['description'] : null; ?>
					<?php
						$element_option = array('value'=>$elements['Setting']['value'],'type'=>$type,'div' => array("class"=>"form-group"), 'label' => $elements['Setting']['label'], "class" => "form-control");
						if($type == "radio"){
							$options = json_decode($elements['Setting']['options']);
							if(is_object($options)){ $options = (array)$options; }
							$element_option['options'] = (array)$options;
							
							$element_option['class'] = null;
						}elseif($type == "select"){
							$options = json_decode($elements['Setting']['options']);
							if(is_object($options)){ $options = (array)$options; }
							$element_option['options'] = (array)$options;
						}
					?>
					<?php echo ($this->Form->input($ctr.'.Setting.'.$elements['Setting']['name'],$element_option)); ?>
					<?php echo ($this->Form->input($ctr.'.Setting.id',array('value'=>$elements['Setting']['id']))); ?>
				<?php $ctr++; endforeach; ?>
			</div>
				
			<div class="col-lg-6">
				<?php foreach($second_half as $elements): ?>
					<?php $type = isset($elements['Setting']['type']) ? $elements['Setting']['type'] : "text"; ?>
					<?php //$after = isset($elements['Setting']['description']) ? $elements['Setting']['description'] : null; ?>
					
					<?php 
					$delete_img_btn = "";					
					$delete_pdf_btn = "";
					$view_img_btn = "";
					$view_pdf_btn = "";
					if($elements['Setting']['name'] == "home_page_banner_image" && !empty($elements['Setting']['value'])){
					
					$delete_img_btn =  $this->Html->link("<i class='glyphicon glyphicon-remove-circle banner_delete_btn'></i>", array('controller'=>'settings', 'action'=>'delete_banner'), array("title"=>"banner image delete",'alt'=>'banner image delete',"escape"=>false ,'class'=>'banner_delete_btn_icon')); 
					
					 $view_img_btn = 	"<a href='javascript:;' style='margin:0 9px 0 6px' alt='edit' title='edit' data-toggle='modal' data-target='#banner_view'><i class='glyphicon glyphicon-film'></i></a>";
					
				
					
					}
					
					if($elements['Setting']['name'] == "streaming_guide_pdf" && !empty($elements['Setting']['value'])){
					
					$delete_pdf_btn =  $this->Html->link("<i class='glyphicon glyphicon-remove-circle banner_delete_btn'></i>", array('controller'=>'settings', 'action'=>'delete_pdf'), array("title"=>"guide pdf delete",'alt'=>'guide pdf delete',"escape"=>false ,'class'=>'banner_delete_btn_icon')); 
					
					$view_pdf_btn =  $this->Html->link("<i class='glyphicon  glyphicon-download-alt'></i>",SITE_URL.'uploads/stream_guide/'.$streaming_guide_pdf, array("title"=>"guide pdf download",'alt'=>'guide pdf download','target'=>'blank',"escape"=>false ,'style'=>'margin:0 9px 0 6px')); 
		
					}
					?>
					<?php
						$element_option = array('value'=>$elements['Setting']['value'],'type'=>$type,'div' => array("class"=>"form-group"), 'label' =>$elements['Setting']['label'].' '.$delete_img_btn.'  '.$view_img_btn.' '.$delete_pdf_btn.'  '.$view_pdf_btn, "class" => "form-control");
						if($type == "radio"){
							$options = json_decode($elements['Setting']['options']);
							if(is_object($options)){ $options = (array)$options; }
							$element_option['options'] = (array)$options;
							
							$element_option['class'] = null;
						}elseif($type == "select"){
							$options = json_decode($elements['Setting']['options']);
							if(is_object($options)){ $options = (array)$options; }
							$element_option['options'] = (array)$options;
						}
					?>
					
					<?php echo ($this->Form->input($ctr.'.Setting.'.$elements['Setting']['name'],$element_option)); ?>
					<?php echo ($this->Form->input($ctr.'.Setting.id',array('value'=>$elements['Setting']['id']))); ?>
				<?php $ctr++; endforeach; ?>
			</div>
			<div style="clear:both;"><br/></div>
			<div class="col-lg-12"> 
				<?php echo ($this->Form->submit('Update', array('class' => 'btn btn-sm btn-primary', 'id' => 'SubmitBtn', "div" => false))); ?>
			</div>
			
			<?php echo ($this->Form->end()); ?>	
		</div>
	</div>
</div>

<div id="banner_view" class="modal fade " role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
	
	
	
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Home Page Banner Image</h4>
      </div>
      <div class="modal-body">
        <p>
		<?php
			$bannerPath = IMAGE_PATH_FOR_TIM_THUMB.BANNER_IMAGE_FULL_DIR."/";
			$image		=	Configure::read("HOME_PAGE_BANNER_IMAGE");
							
			$noImage	=	'avatar5.png';
			if($image &&  file_exists(WWW_ROOT.BANNER_IMAGE_FULL_DIR.DS.$image )) {
				echo $this->Html->image(SITE_URL.'/timthumb.php?src='.$bannerPath.$image.'&w=550&h=450&a=t',array('class'=>'','alt'=>'Profile Image','class'=>'imgClass'));
			}
			?>
			</p>
      </div>
    
    </div>

  </div>
</div>