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
			echo $this->Html->css('Front/responsive');
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
	<body class="straming-page">
	<?php echo ($this->element('Front/header'))?>
	<?php echo ($this->element('Front/left_menu'))?>
		<!--header-End-->	
	<?php echo $this->fetch('content'); ?>
	<script>
	var SITE_URL  = 	"<?php echo SITE_URL;?>";
	
	
	/* function pageminHeight(){
	var hdHeight = $(".top-header").outerHeight();
	var docHeight = $(document).height();
	$('.right-contant').css('min-height', (docHeight-hdHeight)+10);
	}


	function chatsize(){
		var hdHeight = $(".top-header").outerHeight();
		var chBtsHeight = $(".chat-part-whole .top-btns").outerHeight(true)+10;
		var chFrmHeight = $(".chat-form").outerHeight();
		var totalHeight = $(window).height();
		var docHeight = $(document).height();
		var reHeight = docHeight - (hdHeight+chBtsHeight+chFrmHeight);	
		$('.chat-itms').css('max-height', reHeight);
		//$('.chat-itms').css('min-height', reHeight);
		$('.chat-part').css('height', (docHeight-hdHeight)+10);	
		//console.log(totalHeight);
	} */
	
	
	
	
	function pageminHeight(){
	var hdHeight = $(".top-header").outerHeight();
	var docHeight = $(document).height();
	$('.right-contant').css('min-height', (docHeight-hdHeight));
	}


	function chatsize(){
	 var hdHeight = $(".top-header").outerHeight();
	 var chBtsHeight = $(".chat-part-whole .top-btns").outerHeight(true);
	 var chFrmHeight = $(".chat-form").outerHeight();
	 var totalHeight = $(window).height();
	 var docHeight = $(window).height();
	 var reHeight = docHeight - (hdHeight+chBtsHeight+chFrmHeight); 
	 $('.chat-itms').css('max-height', reHeight);
	 $('.chat-itms').css('min-height', reHeight);
	 $('.chat-part').css('height', (docHeight-hdHeight)+10); 
	 console.log("sds is "+reHeight);
	}
	
	

    $(document).on('ready', function() {
	   $(".close01").click(function(){
		$(".menu-left").toggleClass("shift-menu");
		$(".right-contant").toggleClass("shift-right");
		}); 

		 $("#account_dropdown").click(function(){
        $("#account_open-drop").slideToggle();
    });
		
		 $(".chat-slide a, .close-btn a").click(function(){
		$(".chat-part").toggleClass("shift-chat");
		$(".right-contant").toggleClass("overflow-chat");
		$(".streaming-mid").toggleClass("streaming-mid-full");
		
		}); 
		pageminHeight();
		setTimeout(chatsize, 500);
		//chatsize();	
		$( window ).resize(function() {
			chatsize();
			pageminHeight();
		});
  });
  
  
  </script>
	
	
	</body>
</html>
