<?php $this->Layout->sessionFlash(); ?>
<?php echo $this->Form->create('Channel',array('url'=>array('controller'=>'channels','action'=>'setting'),'id'=>'channel_setting_form','class'=>'form-horizontal')); ?>

	<div class="form-group">
		<div class="col-sm-12">
			<?php echo ($this->Form->input('Channel.name', array('maxlength' => 55,'required' => false,'placeholder'=>'Channel Name',"type"=>"text","div"=>false,"label"=>'Channel Name<span class="red_star_mendatry">*</span>',"class"=>"form-control"))); ?>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-12">
			<?php echo ($this->Form->input('Channel.category_id', array('empty'=>'-Select Category-','required' => false,"div"=>false,"label"=>'Category<span class="red_star_mendatry">*</span>',"class"=>"form-control"))); ?>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-12">
			<?php echo ($this->Form->input('Channel.company', array('maxlength' => 50,'required' => false,'placeholder'=>'Company',"type"=>"text","div"=>false,"label"=>'Company Name<span class="red_star_mendatry">*</span>',"class"=>"form-control"))); ?>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-12">
			<?php echo ($this->Form->input('Channel.website', array('required' => false,'placeholder'=>'Website',"type"=>"text","div"=>false,"label"=>'Website',"class"=>"form-control"))); ?>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-12">
			<?php echo ($this->Form->input('Channel.bio', array('required' => false,'placeholder'=>'Biography',"type"=>"textarea","div"=>false,"label"=>'Biography',"class"=>"form-control"))); ?>
		</div>
	</div>

        <div class="modal-footer md-footer">
        <button type="button" class="btn btn-default can" data-dismiss="modal">CANCEL</button>
          <button type="button" id="channel_setting_submit" class="btn btn-default don">DONE</button>
        </div>
	
<div class="loading_bank_channel" id="loading_bank_channel" style="visibility:hidden">
	
	<?php echo $this->Html->image('ajax-loader.gif', array('id'=>'loading-bank-image')) ?>
</div>	
		
<?php echo $this->Form->end(); ?>
	