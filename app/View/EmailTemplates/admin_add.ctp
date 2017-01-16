<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Dashboard 
		<small>Email Templates Add</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="javascript:void(0)"><i class="fa fa-dashboard"></i> <?php echo $this->Html->link('Home', array('controller' => 'admins', 'action' => 'dashboard', 'plugin' => null)); ?></a></li>
		<li class="active">Email Templates Add</li>
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
				<?php 
				echo($this->Form->create('EmailTemplate', array('url' => array('controller' => 'email_templates', 'action' => 'add'),'class'=>'form-horizontal')));
				echo($this->Form->hidden('token_key', array('value' => $this->params['_Token']['key'])));
				
				?>
					<div class="box-body">
						
						<div class="form-group">
							<div class="col-sm-6">
							<label for="exampleInputPassword1">Title </label>
								<?php echo ($this->Form->input("EmailTemplate.title", array('placeholder'=>'Title',"type"=>"text",'required'=>false,"div"=>false,"label"=>false,"class"=>"form-control"))); ?>
							</div>
						</div>
					
						<div class="form-group">
							<div class="col-sm-6">
							<label for="exampleInputPassword1">Subject </label>
								<?php echo ($this->Form->input("EmailTemplate.subject", array('placeholder'=>'Subject',"type"=>"text",'required'=>false,"div"=>false,"label"=>false,"class"=>"form-control"))); ?>
							</div>
						</div>
					
						<div class="form-group">
							<div class="col-sm-12">
								<label for="exampleInputPassword1">Description
								<?php 
								echo ($this->Form->input("EmailTemplate.description", array('placeholder'=>'description',"type"=>"textarea",'id'=>"editor",'required'=>false,"div"=>false,"label"=>false,"class"=>"form-control"))); ?>
								
							</div>
						</div>
							
						
						<div class="form-group">
							<div class="col-sm-6">
							<label for="exampleInputPassword1">Status </label>
								<?php echo ($this->Form->input("EmailTemplate.status", array('options'=>array('1'=>'Active','0'=>'Inactive'),'required'=>false,"div"=>false,"label"=>false,"class"=>"form-control"))); ?>
							</div>
						</div>
						
					</div><!-- /.box-body -->
					<div class="box-footer">
						<?php echo ($this->Form->submit('Submit', array('class' => 'btn btn-primary'))); ?>
					</div>
				<?php echo($this->Form->end());?>
			</div><!-- /.box -->
		</div>
	</div>
	<!-- /.row -->
</section><!-- /.content -->
 <script type="text/javascript">
	$(function() {
		// Replace the <textarea id="editor1"> with a CKEditor
		// instance, using default configuration.
		CKEDITOR.replace('editor');
	});
</script>