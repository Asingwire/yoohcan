
<div class="white-outer">
	<?php  echo ($this->Form->input('id'));?>		
	<?php  echo ($this->Form->input('password1', array('type' => 'password','div'=>false, 'placeholder'=>'Password', 'label'=>'Password',"autocomplete"=>"off", "class" => "input-box-color signfild","maxlength"=>50)));?> 	
	<?php  echo ($this->Form->input('password2', array('type' => 'password','div'=>false, 'placeholder'=>'Confirm Password', 'label'=>'Confirm Password',"autocomplete"=>"off", "class" => "input-box-color signfild","maxlength"=>50)));?> 	
</div>
<?php  echo ($this->Form->submit('Submit', array("div"=>false)));?><span class="forgt-pass"></span>


