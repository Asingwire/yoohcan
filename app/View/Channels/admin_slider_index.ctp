<?php
	echo($this->Html->script(array('ui/minified/jquery.ui.core.min','ui/minified/jquery.ui.widget.min.js','ui/minified/jquery.ui.mouse.min.js','ui/minified/jquery.ui.sortable.min.js')));
?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		&nbsp;
		<small>Home Slider Listing</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="javascript:void(0)"><i class="fa fa-dashboard"></i> <?php echo $this->Html->link('Home', array('controller' => 'admins', 'action' => 'dashboard', 'plugin' => null)); ?></a></li>
		<li class="active">Home Slider Listing</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
			<?php echo($this->Form->create('RecordingStream', array('url'=>array('controller' => 'channels', 'action' => 'slider_index'))));?>
     
				<div class="box-body table-responsive">
					<div class="box box-danger">
						<div class="box-header">
							<h3 class="box-title">Search</h3>
						</div>
						<div class="box-body">
							<div class="row">
							
								<div class="col-xs-3">
									Title 
									<?php echo($this->Form->input('RecordingStream.title', array('placeholder'=>"Title",'label' => false, 'div'=>false,'class'=>'form-control'))); ?>
								</div>
							
								<div class="col-xs-3">
									Description 
									<?php echo($this->Form->input('RecordingStream.description', array('placeholder'=>"Description",'label' => false, 'div'=>false,'class'=>'form-control'))); ?>
								</div>
							
								<div class="col-xs-3">
									Channel Name
									<?php echo($this->Form->input('Channel.name', array('placeholder'=>"Channel Name",'label' => false, 'div'=>false,'class'=>'form-control'))); ?>
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
			echo ($this->Form->create('RecordingStream', array('name' => 'RecordingStream', 'url' => array('controller' => 'channels', 'action' => 'video_process'))));
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
									S.No
								</th> 
								<th style="width:10%;">Image</th>
								<th><?php echo $this->Paginator->sort('title','Title');?></th>
								<th style="width:30%;"><?php echo $this->Paginator->sort('description','Description');?></th>
								<th><?php echo $this->Paginator->sort('Channel.name','Channel Name');?></th>
								<th><?php echo $this->Paginator->sort('is_home','Is Home');?></th>
								<th><?php echo $this->Paginator->sort('video_play_button_type','Video Play Status');?></th>
								<th><?php echo $this->Paginator->sort('created','Created');?></th>
								<th><?php echo $this->Paginator->sort('status','Status');?></th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody id="sortable">
						
						<?php						
						$imagePath		=	IMAGE_PATH_FOR_TIM_THUMB.'/'.RECORDING_IMAGE_FULL_DIR.'/';
						$s_no = 1;
						foreach ($data as $value) {						
						?>
						    <tr id="sort_<?php echo $value['RecordingStream']['id']; ?>">
								<td>
									<?php  echo $s_no; ?>
								</td>
								<td>
									<?php									
										$image		=	$value['RecordingStream']['image'];										
										$noImage	=	'avatar5.png';
										if($image &&  file_exists(WWW_ROOT.RECORDING_IMAGE_FULL_DIR.DS.$image )) {
											echo $this->Html->image(SITE_URL.'/timthumb.php?src='.$imagePath.$image.'&w=100&h=100&a=t',array('class'=>'','alt'=>'Home Slider Image','width'=>'80','class'=>'imgClass'));
											
										} else {
											echo $this->Html->image('Admin/'.$noImage,array('escape'=>false,'class'=>'','alt'=>'No Image','width'=>'60','class'=>'imgClass'));
										} 
									?>
								</td>
								<td><?php echo ucfirst($value['RecordingStream']['title']);?></td>
								<td><?php echo $value['RecordingStream']['description'];?></td>
								<td><?php echo $value['Channel']['name'];?></td>
								
								<td>
								<?php 
								$status_label = ($value['RecordingStream']['is_home'] == "1")? "label-success" : "label-danger" ;
								$status_html = '<span class="label '.$status_label.'">'.$this->Layout->ishome_status($value['RecordingStream']['is_home']).'</span>';
								echo ($this->Html->link($status_html, array('controller'=>'channels','action' => 'change_ishome_status',$value['RecordingStream']['id']), array('escape'=>false,'title' => $value['RecordingStream']['is_home'] == 1 ? 'Home Video' : 'Click for make home video','class'=>"striming_feature")));
								?>
								</td>
								
								
								<td>								
								<?php 
								$status_label = ($value['RecordingStream']['video_play_button_type'] == "1")? "label-success" : "label-primary" ;
								$status_html = '<span class="label '.$status_label.'">'.$this->Layout->isvideo_status($value['RecordingStream']['video_play_button_type']).'</span>';
								echo ($this->Html->link($status_html, array('controller'=>'channels','action' => 'change_video_button_status',$value['RecordingStream']['id']), array('escape'=>false,'title' => $value['RecordingStream']['video_play_button_type'] == 1 ? 'Auto Play Button' : 'Start Button on video','class'=>"striming_feature")));
								?>								
								</td>
							
								<td><?php echo date('d-m-Y h:i:s A',strtotime($value['RecordingStream']['created']));?></td>
								<td>									
									<?php 
									$status_label = ($value['RecordingStream']['status'] == "1")? "label-success" : "label-danger" ;
									$status_html = '<span class="label '.$status_label.'">'.$this->Layout->status($value['RecordingStream']['status']).'</span>';
									echo ($this->Html->link($status_html, array('controller'=>'channels','action' => 'video_status', $value['RecordingStream']['id'], 'token' => $this->params['_Token']['key']), array('escape'=>false,'title' => $value['RecordingStream']['status'] == 1 ? 'Inactive' : 'Active')));
									?>
								</td>
								
								<td>
									<?php echo $this->Html->link("Edit", array('controller'=>'channels', 'action'=>'slider_edit',$value['RecordingStream']['id']), array("title"=>"", "escape"=>false ,'class'=>'btn btn-primary')); ?>
									
									<?php echo $this->Html->link("View", array('controller'=>'channels', 'action'=>'slider_view',$value['RecordingStream']['id']), array("title"=>"", "escape"=>false ,'class'=>'btn btn-primary')); ?>
								</td>
								
							</tr>
						<?php 
						$s_no++;
						} ?>
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
									S.No
									<?php /* <input type="checkbox" id="check-all"/> */ ?>
								</th> 
								<th style="width:10%;">Image</th>
								<th><?php echo $this->Paginator->sort('title','Title');?></th>
								<th><?php echo $this->Paginator->sort('description','Description');?></th>
								<th><?php echo $this->Paginator->sort('name','Channel Name');?></th>
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
				
                <?php //echo ($this->Form->submit('Activate', array('name'=>'activate', 'class'=>'btn btn-primary pull-left pullleftbotton', 'type'=>'button', "onclick" => "javascript:return validateChk('RecordingStream', 'activate');"))); ?>
                <?php //echo ($this->Form->submit('Deactivate', array('name'=>'deactivate', 'type'=>'button', 'class'=>'btn btn-primary pull-left pullleftbotton',  "onclick" => "javascript:return validateChk('RecordingStream', 'deactivate');")));?>
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

<script>
	$(function() {
		$( "#sortable" ).sortable({
				update: function(event, ui) {
						var sort_data = $(this).sortable("serialize");
						$.post("<?php echo $this->Html->url(array('controller'=>'channels', 'action'=>'ajax_channel_slider_sorting'));?>", sort_data + "&" + '<?php echo Configure::read('csrf_token_name'); ?>=<?php echo $this->CsrfHash->_csrf_set_hash(); ?>', function(data){});	
				}
		});
		$( "#sortable" ).disableSelection();
	});
</script>
