<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		&nbsp;
		<small>Admin Management</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="javascript:void(0)"><i class="fa fa-dashboard"></i> <?php echo $this->Html->link('Home', array('controller' => 'admins', 'action' => 'dashboard', 'plugin' => null)); ?></a></li>
		<li class="active">Admin Management</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	
	<!-- top row -->
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
			<?php
		
			if (!empty($data)) {
			$this->ExPaginator->options = array('url' => $this->passedArgs);
            $this->Paginator->options(array('url' => $this->passedArgs));
			
			?>  					
			
				<div class="box-body table-responsive">
					<table id="example1" class="table table-bordered table-striped table-mailbox">
						<thead>
							<tr>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Nick Name</th>
								<th>Email</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php
						foreach ($data as $value) {
						//pr($value);
						?>
						   <tr>
								<td><?php echo ucfirst($value['Admin']['first_name']);?></td>
								<td><?php echo ucfirst($value['Admin']['last_name']);?></td>
								<td><?php echo ucfirst($value['Admin']['nickname']);?></td>
								<td><?php echo ucfirst($value['Admin']['email']);?></td>
								<td>
									<?php echo ($this->Admin->getActionImage(
										array(
											'edit' => array('controller' => 'admins', 'action' => 'edit'),
											'changepassword' => array('controller' => 'admins', 'action' => 'change_password')), $value['Admin']['id'])); 
									?>	
								</td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div><!-- /.box-body -->
			<?php 
			 echo $this->element('Admin/admin_paging', array("paging_model_name" => "Admin", "total_title" => "Admin")); 
			}
			?>
			
			<?php if (empty($data)) { ?>
			<div class="box-body table-responsive">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>First Name</th>
								<th>Last Name</th>
								<th>User Name</th>
								<th>Email</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td colspan="4" align="center">No matching records found.</td>
							</tr>
						</tbody>
					</table>
			
			<?php } ?>
			</div><!-- /.box -->
			
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