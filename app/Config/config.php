<?php 
/*******************************************
All variable user define global scope used.
********************************************/
$siteFolder 	=   dirname(dirname(dirname($_SERVER['SCRIPT_NAME'])));
define('SITEDIR', $siteFolder, true);


if($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == '192.168.1.16')
{
	$config['App.SiteUrl'] = 'http://' . $_SERVER['HTTP_HOST'] . $siteFolder . '/';
	
}
else
{
	$config['App.SiteUrl'] = 'http://' . $_SERVER['HTTP_HOST'] . '/';
}
define('SITE_HOST','http://' . $_SERVER['HTTP_HOST']);

$config['Site.title'] 	= 	'Yoohcan';

//Define gloabl site url
define('SITE_URL', $config['App.SiteUrl']);
$config['App.AdminMail']  		= 	"business@yoohcan.com";
$config['App.AdminMailFrom']  	= 	"business@yoohcan.com";
$config['App.MaxFileSize'] 	= 	'20485760';
$config['App.PageLimit']  =	40;

//Global site title
$config['Status'] 		= 	array(1=>'Active',0=>'Deactive');
$config['Plan_Year'] 		= 	array('1'=>'1','2'=>'2','3'=>'3');
$config['Plan_Month'] 		= 	array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9');
$config['User.Paid.Type'] 		= 	array(1=>'Paid',0=>'Free');

$config['VIDEO.PLAY.TYPE'] 		= 	array(0=>'Start Button Play Video',1=>'Auto Play Video');

$config['Stream.Language'] 		= 	array(1=>'English');
//$config['Stream.Encoder.Type'] 		= 	array('other_rtmp'=>'OBS','telestream_wirecast'=>'Telestream Wirecast','x_split'=>'X Split','ffsplit'=>'FFsplit');
$config['Stream.Encoder.Type'] 		= 	array('other_rtmp'=>'OBS','telestream_wirecast'=>'Telestream Wirecast','x_split'=>'X Split');
/* $config['Stream.Broadcast.Location'] 		= 	array('asia_pacific_taiwan'=>'Asia Pacific(Taiwan)','eu_belgium'=>'EU(Belgium)','us_central_iowa'=>'US Central(lowa)','us_east_s_carolina'=>'US East(S.Carolina)'); */

$config['Stream.Broadcast.Location'] 		= 	array('asia_pacific_taiwan'=>'Asia Pacific(Taiwan)','eu_belgium'=>'EU(Belgium)','us_central_iowa'=>'US Central(lowa)','us_east_s_carolina'=>'US East(S.Carolina)');

$config['4K.Broadcast.Location'] 		= 	array('asia_pacific_australia'=>'Asia Pacific(Australia)','asia_pacific_japan'=>'Asia Pacific(Japan)','asia_pacific_s_korea'=>'Asia Pacific(South Korea)','asia_pacific_singapore'=>'Asia Pacific(Singapore)','eu_germany'=>'EU(Germany)','eu_ireland'=>'EU(Ireland)','south_america_brazil'=>'South America(Brazil)','us_east_virginia'=>'US East(Virginia)','us_west_california'=>'US West(California)','us_west_oregon'=>'US West(Oregon)');




//$config['Aspect.Ratio'] = array('3840x2160'=>'3840 x 2160(4K)','1920x1080'=>'1920 x 1080(1080p)','1280x720'=>'1280 x 720(720p)','1024x576'=>'1024 x 576');
//$config['Aspect.Ratio'] = array('1920x1080'=>'1920 x 1080(1080p)','1280x720'=>'1280 x 720(720p)','1024x576'=>'1024 x 576');

$config['csrf_protection'] = TRUE;
$config['csrf_token_name'] = '__token_csrf';
$config['csrf_cookie_name'] = '__token_cookie_csrf';
$config['csrf_expire'] = 7200;

$config['App.Status.active'] 	=	1;
$config['App.Status.inactive'] 	=	0;

$config['App.Accoutn_Type.enable'] 	=	1;
$config['App.Accoutn_Type.disable'] 	=	0;

$config['Credit.Card.type'] = array('Visa'=>'Visa','MasterCard'=>'MasterCard','Discover'=>'Discover','Amex'=>'Amex','JCB'=>'JCB');
define('USER_ROLE', 2);
define('AboutUs', 'about-us');

define('Blog', 'blog');
define('Faq', 'faq');
define('Help', 'help');
define('Press', 'press');
define('Privacy', 'privacy');
define('Terms', 'terms');
define('Cookie', 'cookie');
define('Platforms', 'platforms');
define('Jobs', 'jobs');

//User profile image
define('PDF_FULL_DIR', "uploads/stream_guide"); 
define('BANNER_IMAGE_FULL_DIR', "uploads/banner"); 
define('PROFILE_IMAGE_FULL_DIR', "uploads/profile_images"); 
define('PROFILE_IMAGE_ORG_FULL_DIR', "uploads/org_profile_image"); 
define('CHANNEL_IMAGE_FULL_DIR', "uploads/channel_images"); 
define('RECORDING_IMAGE_FULL_DIR', "uploads/recording_images"); 
define('CATEGORY_IMAGE_FULL_DIR', "uploads/category_images"); 
define('CATEGORY_BACKGROUND_IMAGE_FULL_DIR', "uploads/category_background_images"); 

//User background image
define('BACKGROUND_IMAGE_FULL_DIR', "uploads/background_images"); 


define('TEMP_IMAGE_FULL_DIR', "uploads/temp"); 

define('STREAM_IMAGE_FULL_DIR', "uploads/stream_images"); 

//define('IMAGE_PATH_FOR_TIM_THUMB', SITE_URL.'/');  // for live 
define('IMAGE_PATH_FOR_TIM_THUMB', SITE_URL.'/app/webroot/'); 

define('TWITTER_RETURN_URL', SITE_URL.'/users/getTwitterData');	


define('USER_PROFILE_EXTRA_PICS', "img/uploads/user");

/* Stream states */
define('STARTING', 1);
define('STARTED', 2);
define('STOPPING', 3);
define('STOPPED', 4);
define('RESETTING',5);

define('PAYPAL_SENDBOX_URL', 'https://www.sandbox.paypal.com/cgi-bin/webscr');
define('PAYPAL_MERCHANT_EMAIL', 'manish.shrm1@gmail.com');


?>