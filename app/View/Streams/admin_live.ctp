<?php

	echo($this->Html->script(array('ui/minified/jquery.ui.core.min','ui/minified/jquery.ui.widget.min.js','ui/minified/jquery.ui.mouse.min.js','ui/minified/jquery.ui.sortable.min.js')));
?>
<style>
	.glyphicon { margin-right:5px; }
	.thumbnail
	{
		margin-bottom: 20px;
		padding: 0px;
		-webkit-border-radius: 0px;
		-moz-border-radius: 0px;
		border-radius: 0px;
	}

	.item.list-group-item
	{
		float: none;
		width: 100%;
		background-color: #fff;
		margin-bottom: 10px;
	}
	.item.list-group-item:nth-of-type(odd):hover,.item.list-group-item:hover
	{
		background: #428bca;
	}

	.item.list-group-item .list-group-image
	{
		margin-right: 10px;
	}
	.item.list-group-item .thumbnail
	{
		margin-bottom: 0px;
	}
	.item.list-group-item .caption
	{
		padding: 9px 9px 0px 9px;
	}
	.item.list-group-item:nth-of-type(odd)
	{
		background: #eeeeee;
	}

	.item.list-group-item:before, .item.list-group-item:after
	{
		display: table;
		content: " ";
	}

	.item.list-group-item img
	{
		float: left;
	}
	.item.list-group-item:after
	{
		clear: both;
	}
	.list-group-item-text
	{
		margin: 0 0 11px;
	}
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		&nbsp;
		<small> List</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="javascript:void(0)"><i class="fa fa-dashboard"></i> <?php echo $this->Html->link('Home', array('controller' => 'admins', 'action' => 'dashboard', 'plugin' => null)); ?></a></li>
		<li class="active">Upcoming Streaming List</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
			<?php echo($this->Form->create('Stream', array('url'=>array('controller' => 'streams', 'action' => 'upcoming'))));?>
     
				<div class="box-body table-responsive">
					<div class="box box-danger">
						<div class="box-header">
							<h3 class="box-title">Search</h3>
						</div>
						<div class="box-body">
							<div class="row">
							
								<div class="col-xs-3">
									Stream Title 
									<?php echo($this->Form->input('Stream.title', array('placeholder'=>"Stream Title",'label' => false, 'div'=>false,'class'=>'form-control'))); ?>
								</div>
								<div class="col-xs-3">
									User Nickname 
									<?php echo($this->Form->input('Stream.user_id', array('placeholder'=>"User Nickname",'label' => false, 'div'=>false,'class'=>'form-control','options'=>$user_list,'empty'=>'--select--'))); ?>
									
									<?php echo($this->Form->input('Stream.grid_list_type', array('type'=>'hidden','value'=>'grid','label'=>false))); ?>
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
			echo ($this->Form->create('Stream', array('name' => 'Stream', 'url' => array('controller' => 'streams', 'action' => 'process'))));
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
								<th style="width:10%;">Stream Image</th>
								<th><?php echo $this->Paginator->sort('title','Title');?></th>								
								<th><?php echo $this->Paginator->sort('user','User');?></th>
								<th><?php echo $this->Paginator->sort('featured','Featured');?></th>
								<th><?php echo $this->Paginator->sort('is_home','Is Home');?></th>	
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
						    <tr id="sort_<?php echo $value['Stream']['id']; ?>">
								<td>
									<?php  echo($this->Form->checkbox('Stream.id' . $value['Stream']['id'], array("class" => "Chkbox", 'value' => $value['Stream']['id']))); ?>
								</td>
								<td>
									<?php
						$streamPath		=	IMAGE_PATH_FOR_TIM_THUMB.'/'.STREAM_IMAGE_FULL_DIR.'/';
						$stream_image		=	$value['Stream']['stream_image'];
						if($stream_image &&  file_exists(WWW_ROOT.STREAM_IMAGE_FULL_DIR.DS.$stream_image )) {
							echo $this->Html->image(SITE_URL.'/timthumb.php?src='.$streamPath.$stream_image.'&w=100&h=100&a=t',array('class'=>'','alt'=>'Profile Image','width'=>'80','class'=>'imgClass'));
							//echo $this->Image->resize($imagePath.$image, 60, 60,array(),100);
						}
						?>
								</td>
								<td><?php echo ucfirst($value['Stream']['title']);?></td>
								<td><?php echo $value['User']['nickname'];?></td>
								<td>
								<?php 
								$status_label = ($value['Stream']['featured'] == "1")? "label-success" : "label-danger" ;
								$status_html = '<span class="label '.$status_label.'">'.$this->Layout->feature_status($value['Stream']['featured']).'</span>';
								echo ($this->Html->link($status_html, array('controller'=>'streams','action' => 'change_featured_status',$value['Stream']['id']), array('escape'=>false,'title' => $value['Stream']['featured'] == 1 ? 'Unfeatured' : 'Featured','class'=>"striming_feature")));
								?>
								</td>
								<td>
								<?php 
								$status_label = ($value['Stream']['is_home'] == "1")? "label-success" : "label-danger" ;
								$status_html = '<span class="label '.$status_label.'">'.$this->Layout->ishome_status($value['Stream']['is_home']).'</span>';
								echo ($this->Html->link($status_html, array('controller'=>'streams','action' => 'change_ishome_status',$value['Stream']['id']), array('escape'=>false,'title' => $value['Stream']['is_home'] == 1 ? 'Home Video' : 'Click for make home video','class'=>"striming_feature")));
								?>
								</td>
								<td><?php echo date('d-m-Y h:i:s A',strtotime($value['Stream']['created']));?></td>
								<td>
																
									<?php 
									$status_label = ($value['Stream']['status'] == "1")? "label-success" : "label-danger" ;
									$status_html = '<span class="label '.$status_label.'">'.$this->Layout->status($value['Stream']['status']).'</span>';
									echo ($this->Html->link($status_html, array('controller'=>'streams','action' => 'status', $value['Stream']['id'], 'token' => $this->params['_Token']['key']), array('escape'=>false,'title' => $value['Stream']['status'] == 1 ? 'Inactive' : 'Active')));
									?>
								
								</td>
							
								<td><?php echo ($this->Admin->getActionImage(
										array(
											'view' => array('controller' => 'streams', 'action' => 'live_view'),											
											'delete'=>array('controller'=>'streams', 'action'=>'delete','token'=>$this->params['_Token']['key']),
											), $value['Stream']['id'])
											); 
									?></td>
								
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div><!-- /.box-body -->
			<?php 
			 echo $this->element('Admin/admin_paging', array("paging_model_name" => "Stream", "total_title" => "Stream")); 
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
								<th style="width:10%;">Stream Image</th>
								<th><?php echo $this->Paginator->sort('title','Title');?></th>								
								<th><?php echo $this->Paginator->sort('user','User');?></th>
								<th><?php echo $this->Paginator->sort('featured','Featured');?></th>
								<th><?php echo $this->Paginator->sort('is_home','Is Home');?></th>	
								<th><?php echo $this->Paginator->sort('created','Created');?></th>
								<th><?php echo $this->Paginator->sort('status','Status');?></th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td colspan="9" align="center">No matching records found.</td>
							</tr>
						</tbody>
					</table>
			
			<?php } ?>
			</div><!-- /.box -->
			<?php if (!empty($data)) { ?>
				
                <?php echo ($this->Form->submit('Activate', array('name'=>'activate', 'class'=>'btn btn-primary pull-left pullleftbotton', 'type'=>'button', "onclick" => "javascript:return validateChk('Stream', 'activate');"))); ?>
                <?php echo ($this->Form->submit('Deactivate', array('name'=>'deactivate', 'type'=>'button', 'class'=>'btn btn-primary pull-left pullleftbotton',  "onclick" => "javascript:return validateChk('Stream', 'deactivate');")));?>
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
	
	
		$('.delete_stream').on('click',function(){	
		
			data_id = $(this).attr('data-id');
			$.ajax({
				url: '<?php echo $this->Html->url(array('controller'=>'streams','action'=>'delete'))?>/'+$(this).attr('data-id'),										
				success: function(response){
					if(response == '1')
					{
						$("#stream_container_"+data_id).remove();
					}
				}
			});
		});
	
	
	
		$('.stream_feature').click(function(){	

				data_id = $(this).attr('data-id');
				$.ajax({
					url: '<?php echo $this->Html->url(array('controller'=>'streams','action'=>'featured'))?>/'+$(this).attr('data-id'),										
					success: function(response){
						if(response == '0')
						{
							$("#featured"+data_id).html('Unfeatured');
						}
						else
						{
								$("#featured"+data_id).html('Featured')
						}
						
					}
				});
		}); 
		
	
		
		
		
		
		
		$("#chkbox_id").on('ifUnchecked', function(event) {
			//Uncheck all checkboxes
			$("input[type='checkbox']", ".table-mailbox").iCheck("uncheck");
		});
		//When checking the checkbox
		$("#chkbox_id").on('ifChecked', function(event) {
			//Check all checkboxes
			$("input[type='checkbox']", ".table-mailbox").iCheck("check");
		});
		
		$('#list').click(function(event){
			event.preventDefault();
			$('#products .item').addClass('list-group-item');
			$('#StreamGridListType').attr('value','list');
			
		});
		
		
		
		$('#grid').click(function(event){
			event.preventDefault();
			$('#products .item').removeClass('list-group-item');
			$('#products .item').addClass('grid-group-item');
			$('#StreamGridListType').attr('value','grid');
		});
		
		<?php
		if(!empty($grid_list_type))
		{
			if($grid_list_type == 'grid')
			{
		?>
				
				$('#products .item').removeClass('list-group-item');
				$('#products .item').addClass('grid-group-item');
				
		<?php	
			}
			else
			{
		?>
				
				$('#products .item').addClass('list-group-item');
		<?php
			}
		}
		?>
		
		
	 });
</script>
<script>
	$(function() {
		$( "#sortable" ).sortable({
				update: function(event, ui) {
						var sort_data = $(this).sortable("serialize");
						$.post("<?php echo $this->Html->url(array('controller'=>'streams', 'action'=>'ajax_stream_sorting'));?>", sort_data + "&" + '<?php echo Configure::read('csrf_token_name'); ?>=<?php echo $this->CsrfHash->_csrf_set_hash(); ?>', function(data){});	
				}
		});
		$( "#sortable" ).disableSelection();
	});
</script>
