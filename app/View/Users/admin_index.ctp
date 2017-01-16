<?php
	echo $this->Html->css(array('datetimepicker/bootstrap-datetimepicker'));
	echo($this->Html->script(array('datetimepicker/moment','datetimepicker/bootstrap-datetimepicker.min')));
	// echo($this->Html->script(array('ui/minified/jquery.ui.core.min','ui/minified/jquery.ui.widget.min.js','ui/minified/jquery.ui.mouse.min.js','ui/minified/jquery.ui.sortable.min.js')));
?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		&nbsp;
		<small>User List</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="javascript:void(0)"><i class="fa fa-dashboard"></i> <?php echo $this->Html->link('Home', array('controller' => 'admins', 'action' => 'dashboard', 'plugin' => null)); ?></a></li>
		<li class="active">User List</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
			<?php echo($this->Form->create('User', array('url'=>array('controller' => 'users', 'action' => 'index'))));?>
     
				<div class="box-body table-responsive">
					<div class="box box-danger">
						<div class="box-header">
							<h3 class="box-title">Search</h3>
						</div>
						<div class="box-body">
							<div class="row">
							<div class="col-xs-3">
									From
									<?php echo($this->Form->input('User.start_date', array('type'=>'text','placeholder'=>"From",'label' => false, 'div'=>false,'class'=>'form-control'))); ?>
								</div>
								<div class="col-xs-3">
									To
									<?php echo($this->Form->input('User.end_date', array('type'=>'text','placeholder'=>"To",'label' => false, 'div'=>false,'class'=>'form-control'))); ?>
								</div>
								<div class="col-xs-3">
									Nick Name 
									<?php echo($this->Form->input('User.nickname', array('placeholder'=>"Nick Name",'label' => false, 'div'=>false,'class'=>'form-control'))); ?>
								</div>
								<div class="col-xs-3">
									User Type
									<?php echo($this->Form->input('User.is_paid', array('empty'=>'--select--','placeholder'=>"User Type",'options'=>Configure::read("User.Paid.Type"),'label' => false, 'div'=>false,'class'=>'form-control'))); ?>
								</div>
								<div class="col-xs-4">
									<br /><?php echo($this->Form->submit('Search', array('div'=>false, 'class'=>'btn btn-primary pull-left')));?> 
									<span style="margin-left: 20px !important;position: absolute;">
									<?php //echo $this->Html->link('Export',array('controller'=>'users','action'=>'exportcsv'), array('div'=>false, 'class'=>'btn btn-primary pull-left'));?>
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
			echo ($this->Form->create('User', array('name' => 'User', 'url' => array('controller' => 'users', 'action' => 'process'))));
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
								<th style="width:10%;">Profile Image</th>
								<th><?php echo $this->Paginator->sort('nickname','Nick Name');?></th>
								<th><?php echo $this->Paginator->sort('email','Email');?></th>
								<th><?php echo $this->Paginator->sort('is_paid','User Type');?></th>
								<th><?php echo $this->Paginator->sort('created','Created');?></th>
								<th><?php echo $this->Paginator->sort('status','Status');?></th>
								<th><?php echo $this->Paginator->sort('featured','Featured');?></th>
								<th><?php echo $this->Paginator->sort('account_type','Account Type');?></th>
								<th>Action</th>
							</tr>
						</thead>
						  <tbody id="__sortable">
						
						<?php
						
						$imagePath		=	IMAGE_PATH_FOR_TIM_THUMB.'/'.PROFILE_IMAGE_FULL_DIR.'/';
						
						foreach ($data as $value) {
						
						?>
						   <tr id="sort_<?php echo $value['User']['id']; ?>">
								<td>
									<?php  echo($this->Form->checkbox('User.id' . $value['User']['id'], array("class" => "Chkbox", 'value' => $value['User']['id']))); ?>
								</td>
								<td>
									<?php
									
										$image		=	$value['User']['profile_image'];
										
										$noImage	=	'avatar5.png';
										if($image &&  file_exists(WWW_ROOT.PROFILE_IMAGE_FULL_DIR.DS.$image )) {
											echo $this->Html->image(SITE_URL.'/timthumb.php?src='.$imagePath.$image.'&w=60&h=60&a=t',array('class'=>'','alt'=>'Profile Image','width'=>'60','class'=>'imgClass'));
											//echo $this->Image->resize($imagePath.$image, 60, 60,array(),100);
										} else {
											echo $this->Html->image('Admin/'.$noImage,array('escape'=>false,'class'=>'','alt'=>'No Image','width'=>'60','class'=>'imgClass'));
										} 
									?>
								</td>
								<td><?php echo ucfirst($value['User']['nickname']);?></td>
								<td><?php echo $value['User']['email'];?></td>
								<td>
								<?php
									$user_type = "Free";
								if(!empty($value['User']['is_paid']))
								{
									$user_type = "Paid";
								}
								echo $user_type;
								
								?>
								</td>
							
								<td><?php echo date('d-m-Y h:i:s A',strtotime($value['User']['created']));?></td>
								<td>									
									<?php 
									$status_label = ($value['User']['status'] == "1")? "label-success" : "label-danger" ;
									$status_html = '<span class="label '.$status_label.'">'.$this->Layout->status($value['User']['status']).'</span>';
									echo ($this->Html->link($status_html, array('controller'=>'users','action' => 'status', $value['User']['id'], 'token' => $this->params['_Token']['key']), array('escape'=>false,'title' => $value['User']['status'] == 1 ? 'Inactive' : 'Active')));
									?>
								</td>
								<td>
								
								
								
								
					<?php 
					$status_label = ($value['User']['featured'] == "1")? "label-success" : "label-danger" ;
					$status_html = '<span class="label '.$status_label.'">'.$this->Layout->feature_status($value['User']['featured']).'</span>';
					echo ($this->Html->link($status_html, array('controller'=>'users','action' => 'featured',$value['User']['id']), array('escape'=>false,'title' => $value['User']['featured'] == 1 ? 'Unfeatured' : 'Featured','class'=>"striming_feature")));
					?>

									
								</td>		<td>
								
								
								
								
					<?php 
					$status_label = ($value['User']['account_type'] == "1")? "label-success" : "label-danger" ;
					$status_html = '<span class="label '.$status_label.'">'.$this->Layout->account_type_status($value['User']['account_type']).'</span>';
					echo ($this->Html->link($status_html, array('controller'=>'users','action' => 'change_account_type',$value['User']['id']), array('escape'=>false,'title' => $value['User']['account_type'] == 1 ? 'Disable' : 'Enable','class'=>"striming_feature")));
					?>

									
								</td>
								
								<td>
									<?php echo ($this->Admin->getActionImage(
										array(
											'view' => array('controller' => 'users', 'action' => 'view'),
											'edit' => array('controller' => 'users', 'action' => 'edit'),
											'delete'=>array('controller'=>'users', 'action'=>'delete','token'=>$this->params['_Token']['key']),
											'changepassword' => array('controller' => 'users', 'action' => 'change_password')
											), $value['User']['id'])
											); 
									?>
									
									

									
								</td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div><!-- /.box-body -->
			<?php 
			 echo $this->element('Admin/admin_paging', array("paging_model_name" => "User", "total_title" => "User")); 
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
								<th style="width:10%;">Profile Image</th>
								<th><?php echo $this->Paginator->sort('nickname','Nick Name');?></th>
								<th><?php echo $this->Paginator->sort('email','Email');?></th>
								<th><?php echo $this->Paginator->sort('is_paid','User Type');?></th>
								<th><?php echo $this->Paginator->sort('created','Created');?></th>
								<th><?php echo $this->Paginator->sort('status','Status');?></th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td colspan="8" align="center">No matching records found.</td>
							</tr>
						</tbody>
					</table>
			
			<?php } ?>
			</div><!-- /.box -->
			<?php if (!empty($data)) { ?>
				
                <?php echo ($this->Form->submit('Activate', array('name'=>'activate', 'class'=>'btn btn-primary pull-left pullleftbotton', 'type'=>'button', "onclick" => "javascript:return validateChk('User', 'activate');"))); ?>
                <?php echo ($this->Form->submit('Deactivate', array('name'=>'deactivate', 'type'=>'button', 'class'=>'btn btn-primary pull-left pullleftbotton',  "onclick" => "javascript:return validateChk('User', 'deactivate');")));?>
			     <?php echo($this->Form->submit('Delete', array('name' => 'delete', 'type' => 'button', 'class' => 'btn btn-primary pull-left pullleftbotton', "onclick" => "javascript:return validateChk('User', 'delete');"))); ?>
				 
            <?php } else { ?>
			
				<?php echo $this->Html->link("Add New", array('controller'=>'users', 'action'=>'add'), array("title"=>"", "escape"=>false ,'class'=>'btn btn-primary pull-left pullleftbotton')); ?>
		
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
<script type="text/javascript">
    $(function () {
        $('#UserStartDate').datetimepicker({format:"YYYY-MM-DD",});
        $('#UserEndDate').datetimepicker({
			format:"YYYY-MM-DD",
            useCurrent: false //Important! See issue #1075
        });
        $("#UserStartDate").on("dp.change", function (e) {
            $('#UserEndDate').data("DateTimePicker").minDate(e.date);
        });
        $("#UserEndDate").on("dp.change", function (e) {
            $('#UserStartDate').data("DateTimePicker").maxDate(e.date);
        });
    });
</script>


<script>
/* 	$(function() {
		$( "#sortable" ).sortable({
				update: function(event, ui) {
						var sort_data = $(this).sortable("serialize");
						$.post("<?php echo $this->Html->url(array('controller'=>'users', 'action'=>'ajax_user_sorting'));?>", sort_data + "&" + '<?php echo Configure::read('csrf_token_name'); ?>=<?php echo $this->CsrfHash->_csrf_set_hash(); ?>', function(data){});	
				}
		});
		$( "#sortable" ).disableSelection();
	}); */
</script>