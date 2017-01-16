<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">		
		<?php echo $this->Html->charset(); ?>
		<script type="text/javascript">
			var SiteUrl = "<?php echo Configure::read('App.SiteUrl');?>";
		</script>		
		<?php			
			echo $this->Html->script('jquery.min');
			echo $this->Html->script('bootstrap');
			echo $this->Html->css('Front/bootstrap.min');
			echo $this->Html->css('Front/slick');
			echo $this->Html->css('Front/style');
			echo $this->Html->css('Front/extra');
			echo $this->Html->script('slick');
			
			
		?> 
		<title><?php echo $title_for_layout; ?> | <?php echo Configure::read('Site.title'); ?></title>
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body class="dashboard">
	<?php echo ($this->element('Front/header'))?>
	<?php echo ($this->element('Front/left_menu'))?>
		<!--header-End-->	
	<?php echo $this->fetch('content'); ?>

	</body>
</html>
