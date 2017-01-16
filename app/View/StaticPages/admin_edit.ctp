<?php   echo $this->Html->script('jquery.validate'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1> Dashboard <small>Static Page Edit</small> </h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo Router::url(array('controller'=>'admins','action'=>'dashboard'))?>"><i class="fa fa-dashboard"></i> Home </a></li>
		<li class="active">Static Page Edit</li>
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
					echo($this->Form->create('StaticPage', array('url' => array('controller' => 'static_pages', 'action' => 'edit'),'class'=>'form-horizontal','type'=>'file')));
					echo($this->Form->hidden('token_key', array('value' => $this->params['_Token']['key'])));
					echo($this->Form->hidden('id'));
				?>
			
				
				<div class="box-body">
					
					<div class="form-group">
						<div class="col-sm-6">
						<label for=""> Static Page Name </label>
							<?php echo ($this->Form->input('StaticPage.title', array('required' => false,'placeholder'=>'Static Page Title',"type"=>"text","div"=>false,"label"=>false,"class"=>"form-control"))); ?>
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-sm-12">
							<label for="">Static Page Description </label>
							<?php 
								echo ($this->Form->input('StaticPage.description', array('placeholder'=>'Description',"type"=>"textarea",'id'=>"editor",'required'=>false,"div"=>false,"label"=>false,"class"=>"form-control"))); 
							?>
							
						</div>
					</div>
					
				</div><!-- /.box-body -->
				
				
				<div class="box-footer">
					<?php echo $this->Html->link("Back", array('controller'=>'static_pages', 'action'=>'index'), array("title"=>"", "escape"=>false ,'class'=>'btn btn-primary')); ?>
					
					<?php echo ($this->Form->submit('Submit', array('class' => 'btn btn-primary',"div"=>false))); ?>
					
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
