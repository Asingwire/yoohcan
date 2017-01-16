<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html>
<head>
<meta name="viewport" content="width=device-width, user-scalable=no">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="apple-touch-fullscreen" content="YES"/>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="icon" href="favicon.ico" type="image/x-icon">
<meta charset="utf-8" />

<?php echo $this->Html->charset(); ?>
<title>
	<?php echo $title_for_layout; ?>
</title>
<?php
	echo $this->Html->meta('icon');
	echo $this->Html->css('css_eng/style');
	echo $this->Html->css('css_eng/media');
	echo($this->Html->script(array('jquery-2.1.1')));
	echo($this->Html->script(array('login','dropdown')));
	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
?>
<?php   #echo($this->Element('Home/signup'));?>
<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="http://connect.facebook.net/en_US/all.js"></script>
<script type="text/javascript">
  WebFontConfig = {
    google: { families: [ 'Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic:latin' ] }
  };
  (function() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
      '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
  })(); 
</script>
<script type="text/javascript">
var SiteUrl = "<?php echo Configure::read('App.SiteUrl');?>";
</script>
</head>
<?php
$bodyDir = 'ltr';
$langVal = $this->Session->read('Config.language');
if(isset($langVal)){
	if(isset($langVal) && $langVal=='en'){
		$bodyDir = 'ltr';
	}else{
		$bodyDir = 'rtl';
	}
 } 
?>
<body dir="<?php echo $bodyDir;?>">
<div class="login_pop" style="display:none;" >
	<?php   echo($this->Element('Home/login'));?>
</div>
<div class="signup_pop" style="display:none;" >
	<?php   echo($this->Element('Home/signup'));?>
</div>
<script>
$(function(){
	var wheight = $(window).height();
	var footerH = $('.Footer').height();
	var HeaderH = $('.Header').height();
	var both = HeaderH +footerH;
	var fh = wheight - both;
	$(".Middle").css({'min-height':fh+'px'});
});
</script>
<div id="Wraper">
	<div class="Header">
		<?php echo ($this->Element('header_search'));?>
	</div>
	<div class="Middle">
		<table align="center" width="100%">
			<tr>
				<td>
					<section class="content">

                    <div class="error-page">
                        <h2 class="headline text-info"> 404</h2>
                        <div class="error-content">
                            <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>
                            <p>
                                We could not find the page you were looking for.
                            </p>
                        </div><!-- /.error-content -->
                    </div><!-- /.error-page -->

                </section>
				<style>
					.error-page > .headline {
						float: left;
						font-size: 100px;
					}
					.text-info {
						color: #31708f;
					}
				</style>
				
				</td>
			</tr>
		</table>
	</div>
	<div class="Footer">
		<?php echo ($this->Element('footer'));?>
	</div>
	<div class="Clear"></div>
</div>
<div class="facebook_thanks" style="display:none;" >
	<?php   echo($this->Element('Home/facebook_thank'));?>
</div>
<script>
$(function(){
	header_login_popup();
	header_sign_popup();
});
</script>
<?php #echo $this->element('sql_dump'); ?>
</body>
</html>