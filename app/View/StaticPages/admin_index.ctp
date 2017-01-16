<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		&nbsp;
		<small>Static Page List</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="javascript:void(0)"><i class="fa fa-dashboard"></i> <?php echo $this->Html->link('Home', array('controller' => 'admins', 'action' => 'dashboard', 'plugin' => null)); ?></a></li>
		<li class="active">Static Page List</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
			<?php echo($this->Form->create('StaticPage', array('url'=>array('controller' => 'static_pages', 'action' => 'index'))));?>
     
				<div class="box-body table-responsive">
					<div class="box box-danger">
						<div class="box-header">
							<h3 class="box-title">Search</h3>
						</div>
						<div class="box-body">
							<div class="row">
								<div class="col-xs-3">
									Static Page Title
									<?php echo($this->Form->input('StaticPage.title', array('placeholder'=>"Static Page Title",'label' => false, 'div'=>false,'class'=>'form-control'))); ?>
								</div>
								<div class="col-xs-4">
									<br><?php echo($this->Form->submit('Search', array('div'=>false, 'class'=>'btn btn-primary pull-left')));?> 
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
			echo ($this->Form->create('StaticPage', array('name' => 'StaticPage', 'url' => array('controller' => 'static_pages', 'action' => 'process'))));
			echo ($this->Form->hidden('pageAction', array('id' => 'pageAction')));
			if (!empty($data)) {
			$this->ExPaginator->options = array('url' => $this->passedArgs);
            $this->Paginator->options(array('url' => $this->passedArgs));
			
			?>  					
			
				<div class="box-body table-responsive">
					<table id="example1" class="table table-bordered table-striped table-mailbox">
						<thead>
							<tr>
								<th style="width:3%;">
									<input name="chkbox_n" id="chkbox_id" type="checkbox" value="" class="ChkboxAll" >
								</th> 
								<th><?php echo $this->Paginator->sort('title','Static Page Title');?></th>
								<th><?php echo $this->Paginator->sort('status','Status');?></th>
								<th><?php echo $this->Paginator->sort('created','Created');?></th>
								<th><?php echo $this->Paginator->sort('modified','Modified');?></th>
							</tr>
						</thead>
						<tbody>
						
					<?php
						foreach ($data as $value) {
						
						?>
						   <tr>
								<td>
									<?php  echo($this->Form->checkbox('StaticPage.id' . $value['StaticPage']['id'], array("class" => "Chkbox", 'value' => $value['StaticPage']['id']))); ?>
								</td>
								<td><?php echo ucfirst($value['StaticPage']['title']);?></td>
								<td>
									<?php echo 	($value['StaticPage']['status']==1)?"Active":"Deactive";?>
								</td>
								<td><?php echo date('d-m-Y h:i:s A',strtotime($value['StaticPage']['created']));?></td>
								<td>
									<?php echo ($this->Admin->getActionImage(
											array('edit' => array('controller' => 'static_pages', 'action' => 'edit'),
												'delete'=>array('controller'=>'static_pages', 'action'=>'delete',
												'token'=>$this->params['_Token']['key']),
											), $value['StaticPage']['id'])
											); 
									?>	
								</td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div><!-- /.box-body -->
			<?php 
			 echo $this->element('Admin/admin_paging', array("paging_model_name" => "StaticPage", "total_title" => "StaticPage")); 
			}
			?>
			
			<?php if (empty($data)) { ?>
			<div class="box-body table-responsive">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th style="width:3%;">
									<input name="chkbox_n" id="chkbox_id" type="checkbox" value="" class="ChkboxAll" >
								</th> 
								<th><?php echo $this->Paginator->sort('title','Static Page Title');?></th>
								<th><?php echo $this->Paginator->sort('status','Status');?></th>
								<th><?php echo $this->Paginator->sort('created','Created');?></th>
								<th><?php echo $this->Paginator->sort('modified','Modified');?></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td colspan="5" align="center">No matching records found.</td>
							</tr>
						</tbody>
					</table>
			
			<?php } ?>
			</div><!-- /.box -->
			<?php if (!empty($data)) { ?>
				
                <?php echo ($this->Form->submit('Activate', array('name'=>'activate', 'class'=>'btn btn-primary pull-left pullleftbotton', 'type'=>'button', "onclick" => "javascript:return validateChk('StaticPage', 'activate');"))); ?>
                <?php echo ($this->Form->submit('Deactivate', array('name'=>'deactivate', 'type'=>'button', 'class'=>'btn btn-primary pull-left pullleftbotton',  "onclick" => "javascript:return validateChk('StaticPage', 'deactivate');")));?>
			     <?php echo($this->Form->submit('Delete', array('name' => 'delete', 'type' => 'button', 'class' => 'btn btn-primary pull-left pullleftbotton', "onclick" => "javascript:return validateChk('StaticPage', 'delete');"))); ?>
				 
            <?php } else { ?>
			
				<?php echo $this->Html->link("Add New", array('controller'=>'static_pages', 'action'=>'add'), array("title"=>"", "escape"=>false ,'class'=>'btn btn-primary pull-left pullleftbotton')); ?>
		
			<?php } ?>
			<?php echo ($this->Form->end());	?>
		</div>
        <!--kaha -->
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
