<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		&nbsp;
		<small>Transaction List</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="javascript:void(0)"><i class="fa fa-dashboard"></i> <?php echo $this->Html->link('Home', array('controller' => 'admins', 'action' => 'dashboard', 'plugin' => null)); ?></a></li>
		<li class="active">Transaction List</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
			<?php echo($this->Form->create('Transaction', array('url'=>array('controller' => 'transactions', 'action' => 'index'))));?>
     
				<div class="box-body table-responsive">
					<div class="box box-danger">
						<div class="box-header">
							<h3 class="box-title">Search</h3>
						</div>
						<div class="box-body">
							<div class="row">
								<div class="col-xs-3">
									User Nickname 
									<?php echo($this->Form->input('nickname', array('placeholder'=>"Nick Name",'label' => false, 'div'=>false,'class'=>'form-control'))); ?>
								</div>
								<div class="col-xs-4">
									<br /><?php echo($this->Form->submit('Search', array('div'=>false, 'class'=>'btn btn-primary pull-left')));?> 
									<span style="margin-left: 20px !important;position: absolute;">
									<?php //echo $this->Html->link('Export',array('controller'=>'categories','action'=>'exportcsv'), array('div'=>false, 'class'=>'btn btn-primary pull-left'));?>
									</span>
								</div>
								
							</div>
						</div><!-- /.box-body -->
					</div>
					
				</div>
			 <?php echo($this->Form->end());?>    
			</div>
		</div>
	</div>
	<!-- top row -->
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
			<?php
			echo ($this->Form->create('Transaction', array('name' => 'Transaction', 'url' => array('controller' => 'transactions', 'action' => 'process'))));
			echo ($this->Form->hidden('pageAction', array('id' => 'pageAction')));
			if (!empty($data)) {
			$this->ExPaginator->options = array('url' => $this->passedArgs);
            $this->Paginator->options(array('url' => $this->passedArgs));
			
			?>  					
			
				<div class="box-body table-responsive">
					<table id="example1" class="table table-bordered table-striped table-mailbox">
						<thead>
							<tr>
								<?php
								/* <th style="width:3%;">
									<input name="chkbox_n" id="chkbox_id" type="checkbox" value="" class="ChkboxAll" >
								</th>  */
								?>
								<th><?php echo $this->Paginator->sort('first_name','User Full Name');?></th>
								<th><?php echo $this->Paginator->sort('nickname','User Nickname');?></th>
								<th><?php echo $this->Paginator->sort('Channel.name','Channel');?></th>
								<th><?php echo $this->Paginator->sort('Stream.title','Stream');?></th>
								<th><?php echo $this->Paginator->sort('RecordingStream.title','Recording');?></th>
								<th><?php echo $this->Paginator->sort('amount','Amount (USD)');?></th>
								<th><?php echo $this->Paginator->sort('created','Transaction Date');?></th>
								<!--<th>Action</th>-->
							</tr>
						</thead>
						<tbody>
						
						<?php
						foreach ($data as $value) {
						
						?>
						   <tr>
								<?php
							/* 	<td>
									<?php  echo($this->Form->checkbox('Transaction.id' . $value['Transaction']['id'], array("class" => "Chkbox", 'value' => $value['Transaction']['id']))); ?>
								</td> */
								?>
								<td><?php echo ucfirst($value['User']['first_name'])." ".ucfirst($value['User']['last_name']);?></td>
								<td><?php echo ucfirst($value['User']['nickname']);?></td>
								<td><?php echo ucfirst($value['Channel']['name']);?></td>
								<td><?php echo ucfirst($value['Stream']['title']);?></td>
								<td><?php echo ucfirst($value['RecordingStream']['title']);?></td>
								<td><?php echo $value['Transaction']['price']. " USD";?></td>
								<td><?php echo date('d-m-Y',strtotime($value['Transaction']['created']));?></td>
								<?php
							/* 	<td>
									<?php echo ($this->Admin->getActionImage(
										array(
											'view' => array('controller' => 'transactions', 'action' => 'view'),
											), $value['Transaction']['id'])
											); 
									?>	
								</td> */
								?>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div><!-- /.box-body -->
			<?php 
			 echo $this->element('Admin/admin_paging', array("paging_model_name" => "Transaction", "total_title" => "Transaction")); 
			}
			?>
			
			<?php if (empty($data)) { ?>
			<div class="box-body table-responsive">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<?php
								/* <th style="width:3%;">
									<input name="chkbox_n" id="chkbox_id" type="checkbox" value="" class="ChkboxAll" >
								</th>  */
								?>
								<th><?php echo $this->Paginator->sort('user_id','User Nickname');?></th>
								<th><?php echo $this->Paginator->sort('amount','Amount (USD)');?></th>
								<th><?php echo $this->Paginator->sort('transaction_date','Transaction Date');?></th>
								<th><?php echo $this->Paginator->sort('transaction_status','Transaction Status');?></th>
								<th><?php echo $this->Paginator->sort('created','Created');?></th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td colspan="6" align="center">No matching records found.</td>
							</tr>
						</tbody>
					</table>
			
			<?php } ?>
			</div><!-- /.box -->
			<?php
	/* 		<?php if (!empty($data)) { ?>
				
                <?php echo ($this->Form->submit('Activate', array('name'=>'activate', 'class'=>'btn btn-primary pull-left pullleftbotton', 'type'=>'button', "onclick" => "javascript:return validateChk('Transaction', 'activate');"))); ?>
                <?php echo ($this->Form->submit('Deactivate', array('name'=>'deactivate', 'type'=>'button', 'class'=>'btn btn-primary pull-left pullleftbotton',  "onclick" => "javascript:return validateChk('Transaction', 'deactivate');")));?>
			     <?php echo($this->Form->submit('Delete', array('name' => 'delete', 'type' => 'button', 'class' => 'btn btn-primary pull-left pullleftbotton', "onclick" => "javascript:return validateChk('Transaction', 'delete');"))); ?>
				 
            <?php } else { ?>
			
				<?php echo $this->Html->link("Add New", array('controller'=>'plans', 'action'=>'add'), array("title"=>"", "escape"=>false ,'class'=>'btn btn-primary pull-left pullleftbotton')); ?>
		
			<?php } ?> */
			?>
			<?php echo ($this->Form->end());	?>
		</div>
        <!--kaha -->
	</div>
	</div>
	<!-- /.row -->
</section><!-- /.content -->
        <!-- Page script -->
<script type="text/javascript">
	$(function() {
		//When unchecking the checkbox
		$("#chkbox_id").on('ifUnchecked', function(event) {
			//Uncheck all checkboxes
			$("input[type='checkbox']", ".table-mailbox").iCheck("uncheck");
		});
		//When checking the checkbox
		$("#chkbox_id").on('ifChecked', function(event) {
			//Check all checkboxes
			$("input[type='checkbox']", ".table-mailbox").iCheck("check");
		});
	 });
</script>