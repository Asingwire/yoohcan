<?php
	echo $this->Html->css(array('datetimepicker/bootstrap-datetimepicker'));
	echo($this->Html->script(array('datetimepicker/moment','datetimepicker/bootstrap-datetimepicker.min')));
	echo($this->Html->script(array('ui/minified/jquery.ui.core.min','ui/minified/jquery.ui.widget.min.js','ui/minified/jquery.ui.mouse.min.js','ui/minified/jquery.ui.sortable.min.js')));
?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		&nbsp;
		<small>Channel List</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="javascript:void(0)"><i class="fa fa-dashboard"></i> <?php echo $this->Html->link('Home', array('controller' => 'admins', 'action' => 'dashboard', 'plugin' => null)); ?></a></li>
		<li class="active">Channel List</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
			<?php echo($this->Form->create('Channel', array('url'=>array('controller' => 'channels', 'action' => 'index'))));?>
     
				<div class="box-body table-responsive">
					<div class="box box-danger">
						<div class="box-header">
							<h3 class="box-title">Search</h3>
						</div>
						<div class="box-body">
							<div class="row">
							
								<div class="col-xs-3">
									Name 
									<?php echo($this->Form->input('Channel.name', array('placeholder'=>"Name",'label' => false, 'div'=>false,'class'=>'form-control'))); ?>
								</div>
							
								<div class="col-xs-3">
									Company 
									<?php echo($this->Form->input('Channel.company', array('placeholder'=>"Company",'label' => false, 'div'=>false,'class'=>'form-control'))); ?>
								</div>
							
								<div class="col-xs-3">
									Website 
									<?php echo($this->Form->input('Channel.website', array('placeholder'=>"Website",'label' => false, 'div'=>false,'class'=>'form-control'))); ?>
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
			echo ($this->Form->create('Channel', array('name' => 'Channel', 'url' => array('controller' => 'channels', 'action' => 'process'))));
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
								<th style="width:10%;">Channel Image</th>
								<th><?php echo $this->Paginator->sort('name','Name');?></th>
								<th><?php echo $this->Paginator->sort('company','Company');?></th>
								<th><?php echo $this->Paginator->sort('website','website');?></th>
								<th><?php echo $this->Paginator->sort('featured','Featured');?></th>
								<th><?php echo $this->Paginator->sort('created','Created');?></th>
								<th><?php echo $this->Paginator->sort('status','Status');?></th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody id="sortable">
						
						<?php
						
						$imagePath		=	IMAGE_PATH_FOR_TIM_THUMB.'/'.CHANNEL_IMAGE_FULL_DIR.'/';
						
						foreach ($data as $value) {
						
						?>
						    <tr id="sort_<?php echo $value['Channel']['id']; ?>">
								<td>
									<?php  echo($this->Form->checkbox('Channel.id' . $value['Channel']['id'], array("class" => "Chkbox", 'value' => $value['Channel']['id']))); ?>
								</td>
								<td>
									<?php
									
										$image		=	$value['Channel']['image'];
										
										$noImage	=	'avatar5.png';
										if($image &&  file_exists(WWW_ROOT.CHANNEL_IMAGE_FULL_DIR.DS.$image )) {
											echo $this->Html->image(SITE_URL.'/timthumb.php?src='.$imagePath.$image.'&w=100&h=100&a=t',array('class'=>'','alt'=>'Channel Image','width'=>'80','class'=>'imgClass'));
											
										} else {
											echo $this->Html->image('Admin/'.$noImage,array('escape'=>false,'class'=>'','alt'=>'No Image','width'=>'80','class'=>'imgClass'));
										} 
									?>
								</td>
								<td><?php echo ucfirst($value['Channel']['name']);?></td>
								<td><?php echo $value['Channel']['company'];?></td>
								<td><?php echo $value['Channel']['website'];?></td>
								<td>
								<?php 
								$status_label = ($value['Channel']['featured'] == "1")? "label-success" : "label-danger" ;
								$status_html = '<span class="label '.$status_label.'">'.$this->Layout->feature_status($value['Channel']['featured']).'</span>';
								echo ($this->Html->link($status_html, array('controller'=>'channels','action' => 'change_featured_status',$value['Channel']['id']), array('escape'=>false,'title' => $value['Channel']['featured'] == 1 ? 'Unfeatured' : 'Featured','class'=>"striming_feature")));
								?>
								</td>
							
								<td><?php echo date('d-m-Y h:i:s A',strtotime($value['Channel']['created']));?></td>
								<td>									
									<?php 
									$status_label = ($value['Channel']['status'] == "1")? "label-success" : "label-danger" ;
									$status_html = '<span class="label '.$status_label.'">'.$this->Layout->status($value['Channel']['status']).'</span>';
									echo ($this->Html->link($status_html, array('controller'=>'channels','action' => 'status', $value['Channel']['id'], 'token' => $this->params['_Token']['key']), array('escape'=>false,'title' => $value['Channel']['status'] == 1 ? 'Inactive' : 'Active')));
									?>
								</td>
								
								
								<td>
									<?php echo ($this->Admin->getActionImage(
										array(		
											'delete'=>array('controller'=>'channels', 'action'=>'channel_delete','token'=>$this->params['_Token']['key']),
											), $value['Channel']['id'])
											); 
									?> &nbsp;
									<?php echo $this->Html->link($this->Html->image('Admin/view.jpg',array('escape'=>false,'class'=>'','alt'=>'No Image','width'=>'18','class'=>'')), array('controller'=>'channels', 'action'=>'recording',$value['Channel']['id']), array("title"=>"Recorded Streams", "escape"=>false)); ?>
								</td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div><!-- /.box-body -->
			<?php 
			 echo $this->element('Admin/admin_paging', array("paging_model_name" => "Channel", "total_title" => "Channel")); 
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
								<th style="width:10%;">Channel Image</th>
								<th><?php echo $this->Paginator->sort('name','Name');?></th>
								<th><?php echo $this->Paginator->sort('company','Company');?></th>
								<th><?php echo $this->Paginator->sort('website','Website');?></th>
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
				
                <?php echo ($this->Form->submit('Activate', array('name'=>'activate', 'class'=>'btn btn-primary pull-left pullleftbotton', 'type'=>'button', "onclick" => "javascript:return validateChk('Channel', 'activate');"))); ?>
                <?php echo ($this->Form->submit('Deactivate', array('name'=>'deactivate', 'type'=>'button', 'class'=>'btn btn-primary pull-left pullleftbotton',  "onclick" => "javascript:return validateChk('Channel', 'deactivate');")));?>
			     <?php //echo($this->Form->submit('Delete', array('name' => 'delete', 'type' => 'button', 'class' => 'btn btn-primary pull-left pullleftbotton', "onclick" => "javascript:return validateChk('Channel', 'delete');"))); ?>
				 
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

<script>
	$(function() {
		$( "#sortable" ).sortable({
				update: function(event, ui) {
						var sort_data = $(this).sortable("serialize");
						$.post("<?php echo $this->Html->url(array('controller'=>'channels', 'action'=>'ajax_channel_sorting'));?>", sort_data + "&" + '<?php echo Configure::read('csrf_token_name'); ?>=<?php echo $this->CsrfHash->_csrf_set_hash(); ?>', function(data){});	
				}
		});
		$( "#sortable" ).disableSelection();
	});
</script>