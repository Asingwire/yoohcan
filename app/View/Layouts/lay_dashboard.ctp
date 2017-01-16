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
			echo $this->Html->css('Front/lc_switch');
			echo $this->Html->css('Front/bootstrap-select.min');
			echo $this->Html->css('Front/responsive');
			
			echo $this->Html->css('Front/extra');
			echo $this->Html->script('slick');
			echo $this->Html->script('lc_switch');
			echo $this->Html->script('bootstrap-select.min');
			
			
		?> 
		<title><?php echo $title_for_layout; ?> | <?php echo Configure::read('Site.title'); ?></title>
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body class="dashboard_1">
	<?php echo ($this->element('Front/header'))?>
	<!--header-End-->
	<?php echo ($this->element('Front/left_menu'))?>
	<?php echo $this->fetch('content'); ?>
	<script type="text/javascript">

$(document).ready(function() {
    $("body").tooltip({ selector: '[data-toggle=tooltip]' });
});
    $(function () {
        $("[rel='tooltip']").tooltip();
    });
	
	$(document).ready(function () {
	  $("a").tooltip({
		'selector': '',
		'placement': 'right',
		'container':'body'
	  });
	});

	$('.auto-tooltip').tooltip();
</script>
	<script type="text/javascript">
	var SITE_URL 			= 	"<?php echo SITE_URL;?>";
		$(document).on('ready', function() {
		
	   $(".close01").click(function(){
		$(".menu-left").toggleClass("shift-menu");
		$(".right-contant").toggleClass("shift-right");
	}); 
		
	   $("li.setting a").click(function(){
		$(".dashboard-menu").toggleClass("shift-dashmenu");
	}); 

	 $("#account_dropdown").click(function(){
        $("#account_open-drop").slideToggle();
    });
		
	  });
	  </script>
	  
	  
	<script>
	$('.selectpicker').selectpicker({
	  style: 'btn-info',
	  size: 4
	});
	</script>
	<script type="text/javascript">
	$(document).ready(function(e) {
		$('input').lc_switch();

		// triggered each time a field changes status
		$('body').delegate('.lcs_check', 'lcs-statuschange', function() {
			var status = ($(this).is(':checked')) ? 'checked' : 'unchecked';
			console.log('field changed status: '+ status );
		});
		
		
		// triggered each time a field is checked
		$('body').delegate('.lcs_check', 'lcs-on', function() {
			console.log('field is checked');
		});
		
		
		// triggered each time a is unchecked
		$('body').delegate('.lcs_check', 'lcs-off', function() {
			console.log('field is unchecked');
		});
	});
	</script>

	</body>
	
</html>
