<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Dashboard 
		<small>Category Detail</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="javascript:void(0)"><i class="fa fa-dashboard"></i> <?php echo $this->Html->link('Home', array('controller' => 'admins', 'action' => 'dashboard', 'plugin' => null)); ?></a></li>
		<li class="active">Category Detail</li>
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
							<label class="width30Percent">Plan Name</label>
								<?php echo ucfirst($data['Plan']['name']); ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">Plan Description</label>
								<?php echo $data['Plan']['description']; ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">Plan Price (USD)</label>
								<?php echo $data['Plan']['price']; ?>
							</div>
						</div>						
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">Year</label>
								<span class="label label-info"><?php if(isset($data['Plan']['year']) && !empty($data['Plan']['year'])){ echo $data['Plan']['year'].'-Year'; } ?></span>
							
							
								
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">Month</label>
								<span class="label label-info"><?php  if(isset($data['Plan']['month']) && !empty($data['Plan']['month'])){ echo $data['Plan']['month'].'- Month '; }  ?></span>
							
							
								
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">Created</label>
								<?php echo date('d-m-Y h:i:s A',strtotime($data['Plan']['created'])); ?>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">Modified</label>
								<?php echo date('d-m-Y h:i:s A',strtotime($data['Plan']['modified'])); ?>
							</div>
						</div>
					</div><!-- /.box-body -->
					<div class="box-footer">
						<?php echo $this->Html->link("Back", array('controller'=>'plans', 'action'=>'index'), array("title"=>"", "escape"=>false ,'class'=>'btn btn-primary')); ?>
					</div>
			</div><!-- /.box -->
		</div>
	</div>
	<!-- /.row -->
</section><!-- /.content -->