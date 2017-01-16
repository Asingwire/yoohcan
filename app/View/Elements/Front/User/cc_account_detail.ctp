<?php $this->Layout->sessionFlash(); ?>
<?php echo $this->Form->create('UserDetail',array('url'=>array('controller'=>'users','action'=>'cc_account_detail'),'id'=>'account_detail_form','class'=>'form-horizontal')); ?>	
<div class="form-group">
	<div class="col-sm-12">
		<span class="list-group-item active">
			Credit Card Details
		</span>
	</div>
</div>
<div class="form-group">
	<div class="col-sm-12">
		<?php echo ($this->Form->input('UserDetail.card_number', array('placeholder'=>'Card Number',"value"=>$user_data['UserDetail']['card_number'],"maxlength" => 19,"type"=>"text","div"=>false,"label"=>false,"class"=>"form-control"))); 
		?>
	</div>
</div>
<div class="form-group">
	<div class="col-sm-4">
		
		<?php
		echo ($this->Form->input('UserDetail.expire_month', array('placeholder'=>'Expiry Month MM',"value"=>$user_data['UserDetail']['expire_month'],"maxlength" => 2,"type"=>"text","div"=>false,"label"=>false,"class"=>"form-control"))); ?>
	</div>
	<div class="col-sm-4">
		<?php echo ($this->Form->input('UserDetail.expire_year', array('required' => false,'placeholder'=>'Expiry Year YY',"value"=>$user_data['UserDetail']['expire_year'],"maxlength" => 2,"type"=>"text","div"=>false,"label"=>false,"class"=>"form-control"))); ?>
	</div>
	<div class="col-sm-4">
		<?php echo ($this->Form->input('UserDetail.card_cvv', array('required' => false,'placeholder'=>'CVV',"type"=>"text","value"=>$user_data['UserDetail']['card_cvv'],"maxlength" => 3,"div"=>false,"label"=>false,"class"=>"form-control"))); ?>
		<div class="clear"></div>
	</div>
</div>
<div class="form-group">
	<div class="col-sm-12">
		<?php echo ($this->Form->input('UserDetail.card_name', array('options'=>Configure::read('Credit.Card.type'),'required' => false,'placeholder'=>'Name of the card',"div"=>false,"value"=>$user_data['UserDetail']['card_name'],"label"=>false,"class"=>"form-control"))); ?>
	</div>
</div>
<div class="form-group">
		<div class="col-sm-12">

<button type="button" class="btn btn-default can" data-dismiss="modal">CANCEL</button>
<input type="button" class="btn btn-default don" value="SAVE" id="cc_submit"/>

</div>		
</div>	

<div class="loading"  id="loading_cc_img" style="visibility:hidden">
	<?php echo $this->Html->image('ajax-loader.gif', array('title'=>'loading','alt'=>'loading','id'=>'loading-image')) ?>
</div>
<?php echo $this->Form->end(); ?>
			
		
  