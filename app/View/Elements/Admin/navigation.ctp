<?php
$admin_role_id = $this->Session->read('Auth.User.role_id');
?> 
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
	<!-- Sidebar user panel -->
	
	<!-- sidebar menu: : style can be found in sidebar.less -->
	<ul class="sidebar-menu">
		<li class="active">
			<a href="<?php echo Router::url(array('controller'=>'admins','action'=>'dashboard'))?>">
				<i class="fa fa-dashboard"></i> <span>Dashboard</span>
			</a>
		</li>
	
		<li class="active">
			<a href="<?php echo Router::url(array('controller'=>'admins','action'=>'index'))?>">
				<i class="fa fa-user"></i> <span>Admin Management</span>
			</a>
		</li>
		
		<li class="treeview <?php echo($this->params['controller']=='users')?'active':''; ?>">
			<a href="javascript:void(0)">
				<i class="fa fa-users"></i><span>User Management</span>
				<i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<li><a href="<?php echo Router::url(array('controller'=>'users','action'=>'index'))?>"><i class="fa fa-angle-double-right"></i>Listing</a></li>
				
				<li><a href="<?php echo Router::url(array('controller'=>'users','action'=>'add'))?>"><i class="fa fa-angle-double-right"></i>  Add</a></li>
			</ul>
		</li>
		<li class="treeview <?php echo($this->params['controller']=='plans')?'active':''; ?>">
			<a href="javascript:void(0)">
				<i class="fa fa-list"></i><span>Plan Management</span>
				<i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<li><a href="<?php echo Router::url(array('controller'=>'plans','action'=>'index'))?>"><i class="fa fa-angle-double-right"></i>Listing</a></li>
				
				<li><a href="<?php echo Router::url(array('controller'=>'plans','action'=>'add'))?>"><i class="fa fa-angle-double-right"></i>  Add</a></li>
			</ul>
		</li>
		
		<li class="treeview <?php echo($this->params['controller']=='email_templates')?'active':''; ?>">
			<a href="javascript:void(0)">
				<i class="fa fa-mail-forward"></i> <span>Email Template</span>
				<i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<li><a href="<?php echo Router::url(array('controller'=>'email_templates','action'=>'index'))?>"><i class="fa fa-angle-double-right"></i>Listing</a></li>
				
				<!--<li><a href="<?php //echo Router::url(array('controller'=>'email_templates','action'=>'add'))?>"><i class="fa fa-angle-double-right"></i>  Add</a></li>-->
			</ul>
		</li>
		
		<li class="treeview <?php echo($this->params['controller']=='static_pages')?'active':''; ?>">
			<a href="javascript:void(0)">
				<i class="fa fa-list"></i> <span>Static Pages Management</span>
				<i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<li><a href="<?php echo Router::url(array('controller'=>'static_pages','action'=>'index'))?>"><i class="fa fa-angle-double-right"></i>Listing</a></li>
				 <li><a href="<?php echo Router::url(array('controller'=>'static_pages','action'=>'add'))?>"><i class="fa fa-angle-double-right"></i>  Add</a></li>				
			</ul>
		</li>
		<li class="treeview <?php if($this->params['controller']=='streams' && $this->params['action']=='admin_index' || $this->params['action']=='admin_upcoming' || $this->params['action']=='admin_upcoming_view' || $this->params['action']=='admin_detail'  || $this->params['action']=='admin_live'  || $this->params['action']=='admin_live_view' ){ echo 'active'; }else{ echo '';} ?>">
		
			<a href="javascript:void(0)">
				<i class="glyphicon glyphicon-hdd"></i><span>Stream Management</span>
				<i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<li><a href="<?php echo Router::url(array('controller'=>'streams','action'=>'index'))?>"><i class="fa fa-angle-double-right"></i>All Streams</a></li>
				
				<li><a href="<?php echo Router::url(array('controller'=>'streams','action'=>'upcoming'))?>"><i class="fa fa-angle-double-right"></i>  Upcoming Streams</a></li>
				
				<li><a href="<?php echo Router::url(array('controller'=>'streams','action'=>'live'))?>"><i class="fa fa-angle-double-right"></i>  Live Streams</a></li>
				<?php /*<li><a href="<?php //echo Router::url(array('controller'=>'users','action'=>'add'))?>"><i class="fa fa-angle-double-right"></i>  Completed Streaming</a></li> */?>
			</ul>
		</li>
		
		<li class="treeview <?php if($this->params['controller']=='channels' && $this->params['action']=='admin_index' || $this->params['action']=='admin_recording' ){ echo 'active'; }else{ echo '';} ?>">
			<a href="javascript:void(0)">
				<i class="glyphicon glyphicon-list-alt"></i><span>Channel Management</span>
				<i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<li><a href="<?php echo Router::url(array('controller'=>'channels','action'=>'index'))?>"><i class="fa fa-angle-double-right"></i>Listing</a></li>
			</ul>
		</li>
		
		<?php //pr($this->params);die; ?>
		<li class="treeview <?php if($this->params['controller']=='channels' && $this->params['action']=='admin_video_index' || $this->params['action']=='admin_view' ){ echo 'active'; }else{ echo '';} ?>">
			<a href="javascript:void(0)">
				<i class="glyphicon glyphicon-facetime-video"></i><span>Recorded Stream Management</span>
				<i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<li><a href="<?php echo Router::url(array('controller'=>'channels','action'=>'video_index'))?>"><i class="fa fa-angle-double-right"></i>Listing</a></li>
			</ul>
		</li>
		
		<li class="treeview <?php if($this->params['controller']=='channels' && $this->params['action']=='admin_slider_index' || $this->params['action']=='admin_slider_view' || $this->params['action']=='admin_slider_edit' ){ echo 'active'; }else{ echo '';} ?>">
			<a href="javascript:void(0)">
				<i class="glyphicon glyphicon-picture"></i><span>Home Slider Management For Recorded Stream</span>
				<i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<li><a href="<?php echo Router::url(array('controller'=>'channels','action'=>'slider_index'))?>"><i class="fa fa-angle-double-right"></i>Listing</a></li>
			</ul>
		</li>
		<li class="treeview <?php if($this->params['controller']=='streams' && $this->params['action']=='admin_slider_index' || $this->params['action']=='admin_slider_view'){ echo 'active'; }else{ echo '';} ?>">
			<a href="javascript:void(0)">
				<i class="glyphicon glyphicon-picture"></i><span>Home Slider Management For Stream</span>
				<i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<li><a href="<?php echo Router::url(array('controller'=>'streams','action'=>'slider_index'))?>"><i class="fa fa-angle-double-right"></i>Listing</a></li>
			</ul>
		</li>
		
		<li class="treeview <?php echo($this->params['controller']=='transactions')?'active':''; ?>">
			<a href="javascript:void(0)">
				<i class="fa fa-usd"></i> <span>Transaction Management</span>
				<i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<li><a href="<?php echo Router::url(array('controller'=>'transactions','action'=>'index'))?>"><i class="fa fa-angle-double-right"></i>Listing</a></li>
				
			</ul>
		</li>
		<li class="treeview <?php echo($this->params['controller']=='categories')?'active':''; ?>">
			<a href="javascript:void(0)">
				<i class="fa fa-list"></i><span>Category Management</span>
				<i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<li><a href="<?php echo Router::url(array('controller'=>'categories','action'=>'index'))?>"><i class="fa fa-angle-double-right"></i>Listing</a></li>
				
				<li><a href="<?php echo Router::url(array('controller'=>'categories','action'=>'add'))?>"><i class="fa fa-angle-double-right"></i>  Add</a></li>
			</ul>
		</li>
		
		<li class="active">
			<a href="<?php echo Router::url(array('controller'=>'settings','action'=>'index'))?>">
				<i class="fa fa-barcode"></i> <span>Global Setting</span>
			</a>
		</li> 
				
	</ul>
	
</section>