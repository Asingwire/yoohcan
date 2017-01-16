<?php $this->Layout->sessionFlash(); ?>
<?php echo $this->Form->create('UserDetail',array('url'=>array('controller'=>'users','action'=>'bank_account_detail'),'id'=>'bank_account_detail_form','class'=>'form-horizontal')); ?>	
<div class="form-group">
	<div class="col-sm-12">
		<span class="list-group-item active">
			Bank Details
		</span>
	</div>
</div>
<div class="form-group">
	<div class="col-sm-12">
		<?php echo ($this->Form->input('UserDetail.bank_name', array('placeholder'=>'Bank Name',"value"=>$user_data['UserDetail']['bank_name'],"type"=>"text","div"=>false,"label"=>false,"class"=>"form-control"))); 
		?>
	</div>
</div>
<div class="form-group">
	<div class="col-sm-12">
		<?php echo ($this->Form->input('UserDetail.bank_address', array('placeholder'=>'Bank Address',"value"=>$user_data['UserDetail']['bank_address'],"type"=>"text","div"=>false,"label"=>false,"class"=>"form-control"))); 
		?>
	</div>
</div>
<div class="form-group">
	<div class="col-sm-12">
		<?php echo ($this->Form->input('UserDetail.account_number', array('placeholder'=>'Account Number',"value"=>$user_data['UserDetail']['account_number'],"type"=>"text","div"=>false,"label"=>false,"class"=>"form-control"))); 
		?>
	</div>
</div>
<div class="form-group">
	<div class="col-sm-12">
		<?php echo ($this->Form->input('UserDetail.account_name', array('placeholder'=>'Account Holder Name',"value"=>$user_data['UserDetail']['account_name'],"type"=>"text","div"=>false,"label"=>false,"class"=>"form-control"))); 
		?>
	</div>
</div>
<div class="form-group">
	<div class="col-sm-12">
		<?php echo ($this->Form->input('UserDetail.account_address', array('placeholder'=>'Account Holder Address',"value"=>$user_data['UserDetail']['account_address'],"type"=>"text","div"=>false,"label"=>false,"class"=>"form-control"))); 
		?>
	</div>
</div>
<div class="form-group">
	<div class="col-sm-12">
		<span class="list-group-item active">
			Paypal Detail
		</span>
	</div>
</div>
<div class="form-group">
	<div class="col-sm-12">
		<?php echo ($this->Form->input('UserDetail.paypal_email', array('placeholder'=>'Paypal Email',"value"=>$user_data['UserDetail']['paypal_email'],"type"=>"text","div"=>false,"label"=>false,"class"=>"form-control"))); 
		?>
	</div>
</div>

<div class="form-group">
		<div class="col-sm-12">

<button type="button" class="btn btn-default can" data-dismiss="modal">CANCEL</button>
<input type="button" class="btn btn-default don" value="SAVE" id="bank_submit"/>



</div>		
</div>	

<div class="loading_bank" id="loading_bank_img" style="visibility:hidden">
	<?php echo $this->Html->image('ajax-loader.gif', array('id'=>'loading-bank-image')) ?>
</div>
<?php echo $this->Form->end(); ?>
			
		
  