<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Dashboard 
		<small>Transaction Detail</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="javascript:void(0)"><i class="fa fa-dashboard"></i> <?php echo $this->Html->link('Home', array('controller' => 'admins', 'action' => 'dashboard', 'plugin' => null)); ?></a></li>
		<li class="active">Transaction Detail</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<!-- top row -->
	<div class="row">
		<div class="col-md-12">
			<!-- general form elements -->
			<div class="box box-primary">
				<!-- form start -->
					<div class="box-body">
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">User Nickname</label>
								<?php echo ucfirst($data['User']['nickname']); ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">User First Name</label>
								<?php echo ucfirst($data['User']['last_name']); ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">User Last Name</label>
								<?php echo ucfirst($data['User']['last_name']); ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">Amount (USD)</label>
								<?php echo $data['Transaction']['amount']; ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">Transaction Date</label>
								<?php echo date('d-m-Y',strtotime($data['Transaction']['transaction_date']));; ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">Transaction Status</label>
								<?php echo 	($data['Transaction']['transaction_status']==1)?"pending":"success";?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">Created</label>
								<?php echo date('d-m-Y h:i:s A',strtotime($data['Transaction']['created'])); ?>
							</div>
						</div>
					</div><!-- /.box-body -->
					<div class="box-footer">
						<?php echo $this->Html->link("Back", array('controller'=>'transactions', 'action'=>'index'), array("title"=>"", "escape"=>false ,'class'=>'btn btn-primary')); ?>
					</div>
			</div><!-- /.box -->
		</div>
	</div>
	<!-- /.row -->
</section><!-- /.content -->