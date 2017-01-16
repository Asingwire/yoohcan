<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Dashboard 
		<small>Stream Detail</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="javascript:void(0)"><i class="fa fa-dashboard"></i> <?php echo $this->Html->link('Home', array('controller' => 'admins', 'action' => 'dashboard', 'plugin' => null)); ?></a></li>
		<li class="active">Stream Detail</li>
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
							<label class="width30Percent">User First Name</label>
								<?php echo ucfirst($data['User']['first_name']); ?>
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
							<label class="width30Percent">User Nickname</label>
								<?php echo ucfirst($data['User']['nickname']); ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">Title</label>
								<?php echo ucfirst($data['Stream']['title']); ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">Subject</label>
								<?php echo $data['Stream']['subject']; ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">Stream Bio</label>
								<?php echo $data['Stream']['stream_bio']; ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">Notes</label>
								<?php echo $data['Stream']['notes']; ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">Facebook Link</label>
								<?php echo $data['Stream']['facebook_link']; ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">Linkdin Link</label>
								<?php echo $data['Stream']['linkdin_link']; ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">Twitter Link</label>
								<?php echo $data['Stream']['twitter_link']; ?>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">Created</label>
								<?php echo date('d-m-Y h:i:s A',strtotime($data['Stream']['created'])); ?>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-6 width100Percent">
							<label class="width30Percent">Modified</label>
								<?php echo date('d-m-Y h:i:s A',strtotime($data['Stream']['modified'])); ?>
							</div>
						</div>
					</div><!-- /.box-body -->
					<div class="box-footer">
						<?php echo $this->Html->link("Back", array('controller'=>'streams', 'action'=>'live'), array("title"=>"", "escape"=>false ,'class'=>'btn btn-primary')); ?>
					</div>
			</div><!-- /.box -->
		</div>
	</div>
	<!-- /.row -->
</section><!-- /.content -->