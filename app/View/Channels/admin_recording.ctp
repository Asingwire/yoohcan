<?php
	echo $this->Html->css(array('datetimepicker/bootstrap-datetimepicker'));
	echo($this->Html->script(array('datetimepicker/moment','datetimepicker/bootstrap-datetimepicker.min')));
?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		&nbsp;
		<small>Recording Stream List</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="javascript:void(0)"><i class="fa fa-dashboard"></i> <?php echo $this->Html->link('Home', array('controller' => 'admins', 'action' => 'dashboard', 'plugin' => null)); ?></a></li>
		<li class="active">Recording Stream List</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
			<?php echo($this->Form->create('RecordingStream', array('url'=>array('controller' => 'channels', 'action' => 'recording',$id))));?>
				<div class="box-body table-responsive">
					<div class="box box-danger">
						<div class="box-header">
							<h3 class="box-title">Search</h3>
						</div>
						<div class="box-body">
							<div class="row">
								<div class="col-xs-3">
									Name 
									<?php echo($this->Form->input('User.first_name', array('placeholder'=>"Name",'label' => false, 'div'=>false,'class'=>'form-control'))); ?>
								</div>
								<div class="col-xs-3">
									Title
									<?php echo($this->Form->input('RecordingStream.title', array('placeholder'=>"Title",'label' => false, 'div'=>false,'class'=>'form-control'))); ?>
								</div>
								<div class="col-xs-3">
									Description
									<?php echo($this->Form->input('RecordingStream.description', array('placeholder'=>"Description",'label' => false, 'div'=>false,'class'=>'form-control'))); ?>
								</div>
								<div class="col-xs-4">
									<br /><?php echo($this->Form->submit('Search', array('div'=>false, 'class'=>'btn btn-primary pull-left')));?> 
									<span style="margin-left: 20px !important;position: absolute;">
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
			echo ($this->Form->create('RecordingStream', array('name' => 'RecordingStream', 'url' => array('controller' => 'channels', 'action' => 'recording_process'))));
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
								<th style="width:7%;">User Image</th>
								<th><?php echo $this->Paginator->sort('first_name','Name');?></th>
								<th><?php echo $this->Paginator->sort('title','Title');?></th>
								<th><?php echo $this->Paginator->sort('Description','description');?></th>
								<th ><?php echo $this->Paginator->sort('stream_key','Stream Key');?></th>
								<th><?php echo $this->Paginator->sort('recording_key','Recording Key');?></th>
								<th ><?php echo $this->Paginator->sort('download_url','Download Url');?></th>
								<th><?php echo $this->Paginator->sort('created','Created');?></th>
								<th><?php echo $this->Paginator->sort('status','Status');?></th>
								
							</tr>
						</thead>
						<tbody>
						
						<?php
						
						$imagePath		=	IMAGE_PATH_FOR_TIM_THUMB.'/'.PROFILE_IMAGE_FULL_DIR.'/';
						
						foreach ($data as $value) {
						
						?>
						   <tr>
								<td>
									<?php  echo($this->Form->checkbox('RecordingStream.id' . $value['RecordingStream']['id'], array("class" => "Chkbox", 'value' => $value['RecordingStream']['id']))); ?>
								</td>
								<td>
									<?php
									
										$image		=	$value['User']['profile_image'];
										
										$noImage	=	'avatar5.png';
										if($image &&  file_exists(WWW_ROOT.PROFILE_IMAGE_FULL_DIR.DS.$image )) {
											echo $this->Html->image(SITE_URL.'/timthumb.php?src='.$imagePath.$image.'&w=60&h=60&a=t',array('class'=>'','alt'=>'User Image','width'=>'60','class'=>'imgClass'));
											
										} else {
											echo $this->Html->image('Admin/'.$noImage,array('escape'=>false,'class'=>'','alt'=>'No Image','width'=>'60','class'=>'imgClass'));
										} 
									?>
								</td>
								<td><?php echo ucfirst($value['User']['first_name']);?></td>
								<td><?php echo $value['RecordingStream']['title'];?></td>
								<td><?php echo $value['RecordingStream']['description'];?></td>
								<td><?php echo $value['RecordingStream']['stream_key'];?></td>
								<td><?php echo $value['RecordingStream']['recording_key'];?></td>
								<td><?php echo $value['RecordingStream']['download_url'];?></td>
							
								<td><?php echo date('d-m-Y h:i:s A',strtotime($value['RecordingStream']['created']));?></td>
								<td>									
									<?php 
									$status_label = ($value['RecordingStream']['status'] == "1")? "label-success" : "label-danger" ;
									$status_html = '<span class="label '.$status_label.'">'.$this->Layout->status($value['RecordingStream']['status']).'</span>';
									echo ($this->Html->link($status_html, array('controller'=>'channels','action' => 'status', $value['RecordingStream']['id'], 'token' => $this->params['_Token']['key']), array('escape'=>false,'title' => $value['RecordingStream']['status'] == 1 ? 'Inactive' : 'Active')));
									?>
								</td>
								
								
								
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div><!-- /.box-body -->
			<?php 
			 echo $this->element('Admin/admin_paging', array("paging_model_name" => "RecordingStream", "total_title" => "RecordingStream")); 
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
								<th style="width:10%;">User Image</th>
								<th><?php echo $this->Paginator->sort('first_name','Name');?></th>
								<th><?php echo $this->Paginator->sort('title','Title');?></th>
								<th><?php echo $this->Paginator->sort('Description','description');?></th>
								<th ><?php echo $this->Paginator->sort('stream_key','Stream Key');?></th>
								<th><?php echo $this->Paginator->sort('recording_key','Recording Key');?></th>
								<th ><?php echo $this->Paginator->sort('download_url','Download Url');?></th>
								<th><?php echo $this->Paginator->sort('created','Created');?></th>
								<th><?php echo $this->Paginator->sort('status','Status');?></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td colspan="10" align="center">No matching records found.</td>
							</tr>
						</tbody>
					</table>
			
			<?php } ?>
			<div class="box-footer">
						<?php echo $this->Html->link("Back", array('controller'=>'channels', 'action'=>'index'), array("title"=>"", "escape"=>false ,'class'=>'btn btn-primary')); ?>
					</div>
			</div><!-- /.box -->
			<?php if (!empty($data)) { ?>
				
                <?php echo ($this->Form->submit('Activate', array('name'=>'activate', 'class'=>'btn btn-primary pull-left pullleftbotton', 'type'=>'button', "onclick" => "javascript:return validateChk('RecordingStream', 'activate');"))); ?>
                <?php echo ($this->Form->submit('Deactivate', array('name'=>'deactivate', 'type'=>'button', 'class'=>'btn btn-primary pull-left pullleftbotton',  "onclick" => "javascript:return validateChk('RecordingStream', 'deactivate');")));?>
			     <?php //echo($this->Form->submit('Delete', array('name' => 'delete', 'type' => 'button', 'class' => 'btn btn-primary pull-left pullleftbotton', "onclick" => "javascript:return validateChk('RecordingStream', 'delete');"))); ?>
				 
            <?php }  ?>
			
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
        $('#ChannelStartDate').datetimepicker({format:"YYYY-MM-DD",});
        $('#ChannelEndDate').datetimepicker({
			format:"YYYY-MM-DD",
            useCurrent: false //Important! See issue #1075
        });
        $("#ChannelStartDate").on("dp.change", function (e) {
            $('#ChannelEndDate').data("DateTimePicker").minDate(e.date);
        });
        $("#ChannelEndDate").on("dp.change", function (e) {
            $('#ChannelStartDate').data("DateTimePicker").maxDate(e.date);
        });
    });
</script>