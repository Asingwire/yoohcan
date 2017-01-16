<?php echo $this->Html->docType('html5'); ?> 
<!DOCTYPE html>
<html class="bg-black">
    <head>
		<?php echo $this->Html->charset(); ?>
		<?php
			echo $this->Html->meta('icon');
			echo $this->fetch('meta');
			echo $this->Html->css('bootstrap.min');
			echo $this->Html->css('font-awesome.min');
			echo $this->Html->css('admin');
			echo $this->Html->css('main');
			echo $this->fetch('css');
			//echo $this->Html->script('libs/jquery-1.10.2.min');
			//echo $this->Html->script('libs/bootstrap.min');
			echo $this->fetch('script');
		?>
        <meta charset="UTF-8">
        <title><?php echo $title_for_layout; ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <!-- font Awesome -->
        <!-- Theme style -->
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">
		<div class="form-box" id="login-box">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
        </div>
		<?php  echo($this->Html->script(array('bootstrap.min')));?>
	</body>
</html>
