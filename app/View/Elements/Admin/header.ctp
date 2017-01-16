<?php echo $this->Html->link($this->Html->image('Front/logo.png',array('escape'=>false,'class'=>'logo','style'=>"background-color:#000;width:175px;height:30px;margin-top:12px;",'title'=>'Yoohcan')), array('controller' => 'admins', 'action' => 'dashboard', 'plugin' => null),array('class'=>'logo','escape'=>false,'title'=>'Yoohcan','style'=>'background-color:#000;')); ?>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top" role="navigation" style="background-color:#000;">
<!-- Sidebar toggle button-->
<a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
	<span class="sr-only">Toggle navigation</span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
</a>
<div class="navbar-right">
	<ul class="nav navbar-nav">
		<!-- User Account: style can be found in dropdown.less -->
		<li class="dropdown user user-menu">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<i class="glyphicon glyphicon-user"></i>
				<span>Welcome	
					 <i class="caret"></i></span>
			</a>
			<ul class="dropdown-menu">
				<!-- User image -->
				<li class="user-header bg-light-blue">
					<?php echo $this->Html->image('Admin/avatar5.png',array('escape'=>false,'class'=>'img-circle')); ?>
					<p>
						<?php 
						echo $this->Html->link(ucfirst(strtolower($this->Session->read('Auth.Admin.nickname'))), array('controller' => 'admins', 'action' => 'dashboard', 'plugin' => null)); ?>
					</p>
				</li>
				<!-- Menu Footer-->
				<li class="user-footer">
					<div class="pull-left">
						<?php 
							$admin_role_id = $this->Session->read('Auth.User.role_id'); 
							if($admin_role_id == 1) {
								echo $this->Html->link("Change Password", array('controller' => 'admins', 'action' => 'change_password', 'plugin' => null), array("class" => "btn btn-default btn-flat"));
							} else {
								echo $this->Html->link("Change Password", array('controller' => 'admins', 'action' => 'change_password', 'plugin' => null), array("class" => "btn btn-default btn-flat"));
							}
						?>
					</div>
					<div class="pull-right">
						<?php echo $this->Html->link("logout", array('controller' => 'admins', 'action' => 'logout', 'plugin' => null), array("class" => "btn btn-default btn-flat")); ?>
					</div>
				</li>
			</ul>
		</li>
	</ul>
</div>
</nav>