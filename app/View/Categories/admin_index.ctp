<?php
	echo($this->Html->script(array('ui/minified/jquery.ui.core.min','ui/minified/jquery.ui.widget.min.js','ui/minified/jquery.ui.mouse.min.js','ui/minified/jquery.ui.sortable.min.js')));
?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		&nbsp;
		<small>Category List</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="javascript:void(0)"><i class="fa fa-dashboard"></i> <?php echo $this->Html->link('Home', array('controller' => 'admins', 'action' => 'dashboard', 'plugin' => null)); ?></a></li>
		<li class="active">Category List</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
			<?php echo($this->Form->create('Category', array('url'=>array('controller' => 'categories', 'action' => 'index'))));?>
     
				<div class="box-body table-responsive">
					<div class="box box-danger">
						<div class="box-header">
							<h3 class="box-title">Search</h3>
						</div>
						<div class="box-body">
							<div class="row">
							
								<div class="col-xs-3">
									Category Name 
									<?php echo($this->Form->input('Category.name', array('placeholder'=>"Category Name",'label' => false, 'div'=>false,'class'=>'form-control'))); ?>
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
			echo ($this->Form->create('Category', array('name' => 'Category', 'url' => array('controller' => 'categories', 'action' => 'process'))));
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
									<?php /* <input type="checkbox" id="check-all"/> */ ?>
								</th> 
								<th><?php echo $this->Paginator->sort('image','Image');?></th>
								<th><?php echo $this->Paginator->sort('name','Name');?></th>
								<th><?php echo $this->Paginator->sort('featured','Featured');?></th>
								<th><?php echo $this->Paginator->sort('created','Created');?></th>
								<th><?php echo $this->Paginator->sort('status','Status');?></th>
								<th>Action</th>
							</tr>
						</thead>
						 <tbody id="sortable">
						
						<?php
						$imagePath		=	IMAGE_PATH_FOR_TIM_THUMB.'/'.CATEGORY_IMAGE_FULL_DIR.'/';
						foreach ($data as $value) {
						
						?>
						   <tr id="sort_<?php echo $value['Category']['id']; ?>">
								<td>
									<?php  echo($this->Form->checkbox('Category.id' . $value['Category']['id'], array("class" => "Chkbox", 'value' => $value['Category']['id']))); ?>
								</td>
								<td>
									<?php
									
										$image		=	$value['Category']['image'];
										
										$noImage	=	'avatar5.png';
										if($image &&  file_exists(WWW_ROOT.CATEGORY_IMAGE_FULL_DIR.DS.$image )) {
											echo $this->Html->image(SITE_URL.'/timthumb.php?src='.$imagePath.$image.'&w=60&h=60&a=t',array('class'=>'','alt'=>'Category Image','width'=>'60','class'=>'imgClass'));
											//echo $this->Image->resize($imagePath.$image, 60, 60,array(),100);
										} else {
											echo $this->Html->image('Admin/'.$noImage,array('escape'=>false,'class'=>'','alt'=>'No Image','width'=>'60','class'=>'imgClass'));
										} 
									?>
								</td>
								<td><?php echo ucfirst($value['Category']['name']);?></td>
								<td>
								<?php 
								$status_label = ($value['Category']['featured'] == "1")? "label-success" : "label-danger" ;
								$status_html = '<span class="label '.$status_label.'">'.$this->Layout->feature_status($value['Category']['featured']).'</span>';
								echo ($this->Html->link($status_html, array('controller'=>'categories','action' => 'change_featured_status',$value['Category']['id']), array('escape'=>false,'title' => $value['Category']['featured'] == 1 ? 'Unfeatured' : 'Featured','class'=>"striming_feature")));
								?>
								</td>
								<td><?php echo date('d-m-Y h:i:s A',strtotime($value['Category']['created']));?></td>
								<td>
									<?php echo 	($value['Category']['status']==1)?"Active":"Deactive";?>
								</td>
								
								<td>
									<?php echo ($this->Admin->getActionImage(
										array(
											'view' => array('controller' => 'categories', 'action' => 'view'),
											'edit' => array('controller' => 'categories', 'action' => 'edit'),
											'delete'=>array('controller'=>'categories', 'action'=>'delete','token'=>$this->params['_Token']['key'])
											), $value['Category']['id'])
											); 
									?>	
								</td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div><!-- /.box-body -->
			<?php 
			 echo $this->element('Admin/admin_paging', array("paging_model_name" => "Category", "total_title" => "Category")); 
			}
			?>
			
			<?php if (empty($data)) { ?>
			<div class="box-body table-responsive">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th style="width:3%;">
									<input name="chkbox_n" id="chkbox_id" type="checkbox" value="" class="ChkboxAll" >
									<?php /* <input type="checkbox" id="check-all"/> */ ?>
								</th> 
								<th><?php echo $this->Paginator->sort('image','Image');?></th>
								<th><?php echo $this->Paginator->sort('name','Name');?></th>
								<th><?php echo $this->Paginator->sort('created','Created');?></th>
								<th><?php echo $this->Paginator->sort('status','Status');?></th>
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
			<?php if (!empty($data)) { ?>
				
                <?php echo ($this->Form->submit('Activate', array('name'=>'activate', 'class'=>'btn btn-primary pull-left pullleftbotton', 'type'=>'button', "onclick" => "javascript:return validateChk('Category', 'activate');"))); ?>
                <?php echo ($this->Form->submit('Deactivate', array('name'=>'deactivate', 'type'=>'button', 'class'=>'btn btn-primary pull-left pullleftbotton',  "onclick" => "javascript:return validateChk('Category', 'deactivate');")));?>
			     <?php echo($this->Form->submit('Delete', array('name' => 'delete', 'type' => 'button', 'class' => 'btn btn-primary pull-left pullleftbotton', "onclick" => "javascript:return validateChk('Category', 'delete');"))); ?>
				 
            <?php } else { ?>
			
				<?php echo $this->Html->link("Add New", array('controller'=>'categories', 'action'=>'add'), array("title"=>"", "escape"=>false ,'class'=>'btn btn-primary pull-left pullleftbotton')); ?>
		
			<?php } ?>
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

<script>
	$(function() {
		$( "#sortable" ).sortable({
				update: function(event, ui) {
						var sort_data = $(this).sortable("serialize");
						$.post("<?php echo $this->Html->url(array('controller'=>'categories', 'action'=>'ajax_categories_sorting'));?>", sort_data + "&" + '<?php echo Configure::read('csrf_token_name'); ?>=<?php echo $this->CsrfHash->_csrf_set_hash(); ?>', function(data){});	
				}
		});
		$( "#sortable" ).disableSelection();
	});
</script>