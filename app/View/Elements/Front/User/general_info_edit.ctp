<?php $this->Layout->sessionFlash(); ?>
<?php echo $this->Form->create('User',array('url'=>array('controller'=>'users','action'=>'general_info_edit'),'id'=>'general_info_form','class'=>'form-horizontal')); ?>	
	<div class="form-group">
		<div class="col-sm-12">
		<?php echo($this->Form->hidden('User.id')); ?>
			<?php echo ($this->Form->input('User.nickname', array('required' => false,'placeholder'=>'Nick Name',"type"=>"text","div"=>false,"label"=>'Nick Name<span class="red_star_mendatry">*</span>',"class"=>"form-control"))); ?>			
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-12">
		<?php echo($this->Form->hidden('User.id')); ?>
			<?php echo ($this->Form->input('User.first_name', array('required' => false,'placeholder'=>'First Name',"type"=>"text","div"=>false,"label"=>'First Name<span class="red_star_mendatry">*</span>',"class"=>"form-control"))); ?>			
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-12">
			<?php echo ($this->Form->input('User.last_name', array('required' => false,'placeholder'=>'Last Name',"type"=>"text","div"=>false,"label"=>'Last Name<span class="red_star_mendatry">*</span>',"class"=>"form-control"))); ?>		
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-12">
			<?php echo ($this->Form->input('User.email', array('required' => false,'placeholder'=>'Email',"type"=>"text","div"=>false,"label"=>'Email Address',"class"=>"form-control"))); ?>		
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-12">
			<?php  echo ($this->Form->input('User.password_new', array('type'=>'password','placeholder'=>'Password','div'=>false,'label'=>'Password',"autocomplete"=>"off","maxlength"=>30,"class"=>"form-control")));?>
				
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-12">
			<?php  echo ($this->Form->input('User.confirm_password', array('type'=>'password','placeholder'=>'Confirm Password','div'=>false, 'label'=>'Confirm Password',"autocomplete"=>"off","maxlength"=>30,"class"=>"form-control")));?>		
		</div>
	</div>

        <div class="modal-footer md-footer">
        <button type="button" class="btn btn-default can" data-dismiss="modal">CANCEL</button>
          <button type="button" id="general_info_submit" class="btn btn-default don">DONE</button>
        </div>
		
			<style>


.loading_stream {
		background-color: #fff;
		display: block;
		height: 100%;
		left: 0;
		opacity: 0.7;
		position: fixed;
		text-align: center;
		top: 207px;
		width: 100%;
		z-index: 99;
}

#loading-bank-image {
	left: 281px;
	position: absolute;
	right: 96px;
	top: 192px;
	z-index: 100;
}

</style>
<div class="loading_stream" id="loading_stream_img" style="visibility:hidden">
	<img id="loading-bank-image" src="../img/ajax-loader.gif">
</div>	
		
		
		
<?php echo $this->Form->end(); ?>
	