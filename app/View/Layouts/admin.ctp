<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title><?php echo $title_for_layout; ?> | <?php echo Configure::read('Site.title'); ?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=8;FF=3;OtherUA=4" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('font-awesome.min');
		echo $this->Html->css('ionicons.min');
		echo $this->Html->css('admin');
		//echo $this->Html->css('jquery/jquery.alerts');
		echo $this->Html->css('iCheck/minimal/blue');
		echo $this->Html->css('datatables/dataTables.bootstrap');
		echo($this->Html->script(array('jquery-2.1.1')));
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		
	?>
	 <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
<!--[if lt IE 8]>
	
    <link href="/css/bootstrap-ie7.css" rel="stylesheet">
<![endif]-->
	<!--[if lt IE 9]>
		<?php
		echo($this->Html->script(array('Admin/html5shiv')));
		echo($this->Html->script(array('Admin/respond.min')));
	  ?>
    <![endif]--> 
	<!--[if lt IE 8]>
		<?php
		echo($this->Html->script(array('Admin/html5shiv')));
		echo($this->Html->script(array('Admin/respond.min')));
	  ?>
    <![endif]--> 
<script type="text/javascript">
var SiteUrl = "<?php echo Configure::read('App.SiteUrl');?>";
</script>	
 <script type="text/javascript"> 
      jQuery(document).ready( function() {
    	  jQuery('.flash_bad').delay(4000).fadeOut(); 
    	  jQuery('.flash_good').delay(4000).fadeOut();
      });
  </script> 
</head>
<body class="skin-blue">
	
	<!-- header logo: style can be found in header.less -->
        <header class="header">
            <?php echo ($this->Element('Admin/header'));?>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">			
                <?php 
					echo ($this->Element('Admin/navigation'));
				?>
                <!-- /.sidebar -->
            </aside>
			<!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
				<?php  echo $this->Session->flash();?>
				<?php echo $this->fetch('content'); ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
		<!-- add new calendar event modal -->
	<?php #echo $this->fetch('content'); ?>
	<?php #echo $this->element('sql_dump'); ?>
	    <!-- add new calendar event modal -->
		<!-- jQuery 2.0.2 -->
		<?php // echo($this->Html->script(array('Admin/raphael-min')));?>
		<?php  echo($this->Html->script(array('bootstrap.min')));?>
		<?php  echo($this->Html->script(array('Admin/app')));?>
		<?php  echo($this->Html->script(array('plugins/datatables/jquery.dataTables')));?>
		<?php  echo($this->Html->script(array('plugins/datatables/dataTables.bootstrap')));?>
		<?php  echo($this->Html->script(array('checkboxes_operation')));?>
		<?php  //echo($this->Html->script(array('jquery.alerts')));?>
		<?php //echo($this->Html->script(array('jquery.maskedinput.min')));?>
		<?php echo($this->Html->script(array('plugins/ckeditor/ckeditor')));?>
	<?php #echo $this->element('sql_dump'); ?>
</body>
</html>
