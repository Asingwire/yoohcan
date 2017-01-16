<?php
	echo $this->Html->css('CROP/font-awesome.min');
	echo $this->Html->css('CROP/cropper');
	echo $this->Html->css('CROP/main');
	?>
	  <!-- Content -->
  
    <div class="row">

      <div class="col-md-12">

        <!-- <h3 class="page-header">Demo:</h3> -->
		
        <div class="img-container">
           <?php echo $this->Html->image('/uploads/org_profile_image/'.$user_data['User']['profile_image'],array('id'=>'image'));  ?>
        </div>
      </div>
      <div class="col-md-10">
        <!-- <h3 class="page-header">Preview:</h3>
        <div class="docs-preview clearfix">
          <div class="img-preview preview-lg"></div>
          
        </div> -->
		<?php echo $this->Form->create('User',array('url'=>array('controller'=>'users','action'=>'profile_image_croping'),'id'=>'profile_image_croping','class'=>'form-horizontal')); ?>
        <!-- <h3 class="page-header">Data:</h3> -->
        <div class="docs-data">
          <div class="input-group input-group-sm">
			<?php
			echo ($this->Form->input('User.Y', array("type"=>"hidden","div"=>false,"label"=>false,"class"=>"form-control"))); 
			echo ($this->Form->input('User.X', array("type"=>"hidden","div"=>false,"label"=>false,"class"=>"form-control"))); 
			echo ($this->Form->input('User.Width', array("type"=>"hidden","div"=>false,"label"=>false,"class"=>"form-control"))); 
			echo ($this->Form->input('User.Height', array("type"=>"hidden","div"=>false,"label"=>false,"class"=>"form-control"))); 
			echo ($this->Form->input('User.Rotate', array("type"=>"hidden","div"=>false,"label"=>false,"class"=>"form-control"))); 
			echo ($this->Form->input('User.ScaleX', array("type"=>"hidden","div"=>false,"label"=>false,"class"=>"form-control"))); 
			echo ($this->Form->input('User.ScaleY', array("type"=>"hidden","div"=>false,"label"=>false,"class"=>"form-control"))); 
			?>
			
          </div>
          
        </div>
		<input type="button" class="btn btn-default don" value="Crop" id="profile_img_crop"/>
		
		<?php echo $this->Form->end(); ?>
		
      </div>
	  
    </div>
   


 

   

 
  <!-- Scripts -->

  <?php

	echo $this->Html->script('CROP/cropper');
	echo $this->Html->script('CROP/main');
?>