<?php
/**
 * user content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('AppController', 'Controller');

/**
 * user content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */

App::uses('Sanitize', 'Utility');
class TestsController extends AppController {



/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Tests';

/**
 * This controller use a model admins
 *
 * @var array
 */
	public $uses 		= array('Test');
	
	public $helpers 	= array('Html', 'Session','General','Csv');
	var $components = 	array('General',"Upload");
	
	
	public function beforeFilter() {	
        parent::beforeFilter();
        $this->loadModel('Test');
		$this->Auth->allow('index','autosearch','auto_suggestion_list','sendEmail','get_all_recordings','get_mail_template','send_grid_mail');
    }
	
	
	public function dashboard(){	
		$id = $this->Auth->user('id');
		$this->set('title_for_layout','User');
		$this->set('id',$id);
		
		$this->User->id 	= 	$id;
		
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid User'));
        }
		/*form post and check conditions*/
		if ($this->request->is('post') || $this->request->is('put')) {
			
			if (!empty($this->request->data)) {
				
				if (!isset($this->request->params['_Token']['key']) || ($this->request->params['_Token']['key'] != $this->request->params['_Token']['key'])) {
					$blackHoleCallback = $this->Security->blackHoleCallback;
					$this->$blackHoleCallback();
				}				
				$this->User->set($this->request->data['User']);
				$this->User->setValidation('edit_profile');
				if ($this->User->validates()) {
				
					$this->User->create();
					if ($this->User->save($this->request->data['User'],false)) {
						$this->Session->setFlash("Your profile have been updated successfully.", 'flash_good');					
						 $this->redirect($this->referer());				
					}
				}  else {
				
					$this->Session->setFlash('Some error occur. Please, try again.', 'admin_flash_bad');
					 $this->redirect($this->referer());
				}
				
			}
        } else {			
			$this->request->data = $this->User->find('first',array('conditions'=>array('User.id'=>$id)));			
		}		
		
		
		$userData = parent::getUserData($this->Auth->user('id'));
		$this->set('userData',$userData);
	}
	
	
	public function userpicupload(){
		
	    if(isset($_FILES['uploadfile']['name'])){
			$p_image	=	$_FILES['uploadfile'];
			
			$oldpic= $this->User->find("first",array("conditions"=>array("User.id"=>$this->Auth->User('id')),'fields'=>'User.profile_image'));
			$old_image	=	$oldpic['User']['profile_image'];
		
			if (!empty($p_image) && $p_image['tmp_name'] != '' && $p_image['size'] > 0) {
				list($width, $height, $type, $attr) = getimagesize($p_image['tmp_name']);
				$allowed	=	array('jpg','jpeg','png','gif','JPG','JPEG','PNG','GIF');
				$temp 		= 	explode(".", $p_image["name"]);
				$extension 	= 	end($temp);
				$imageName 	= 	'profile_image_'.microtime(true).'.'.$extension;
				$files		=	$p_image;
				
				$result 	= 	$this->Upload->upload($files, WWW_ROOT . PROFILE_IMAGE_FULL_DIR . DS, $imageName,'',$allowed);
				
				if($width<=150 || $height<=150)
				{
					echo "sizeError|"."Image size should be 150x150.";
					die;
				}
				if(!empty($this->Upload->result) && empty($this->Upload->errors)) 
				{					
					if($old_image &&  file_exists(WWW_ROOT.PROFILE_IMAGE_FULL_DIR.DS.$old_image )) 
					{
						@unlink(WWW_ROOT.PROFILE_IMAGE_FULL_DIR.DS.$old_image);
					}
					$this->User->id	=	$this->Auth->User('id');
					$avataruploaded = $this->User->saveField('profile_image',$imageName,false);
					if ($avataruploaded){	
						echo "success|".$imageName;
					}else{
						echo "failed";
					}
					die;
				}
			}
		}		 
   }
   
   
	public function coverPicUpload(){
		
	    if(isset($_FILES['uploadfile']['name'])){
			$p_image	=	$_FILES['uploadfile'];			
			$oldpic= $this->User->find("first",array("conditions"=>array("User.id"=>$this->Auth->User('id')),'fields'=>'User.background_image'));
			$old_image	=	$oldpic['User']['background_image'];
		
			if (!empty($p_image) && $p_image['tmp_name'] != '' && $p_image['size'] > 0) {
				list($width, $height, $type, $attr) = getimagesize($p_image['tmp_name']);
				$allowed	=	array('jpg','jpeg','png','JPG');
				$temp 		= 	explode(".", $p_image["name"]);
				$extension 	= 	end($temp);
				$imageName 	= 	'prof_cover_img_'.microtime(true).'.'.$extension;
				$files		=	$p_image;
				
				$result 	= 	$this->Upload->upload($files, WWW_ROOT . BACKGROUND_IMAGE_FULL_DIR . DS, $imageName,'',$allowed);
				
				if($width<=800 || $height<=400)
				{
					echo "sizeError|"."Image size should be 800x400.";
					die;
				}
				if(!empty($this->Upload->result) && empty($this->Upload->errors)) {
					
					if($old_image &&  file_exists(WWW_ROOT.BACKGROUND_IMAGE_FULL_DIR.DS.$old_image )) {
						@unlink(WWW_ROOT.BACKGROUND_IMAGE_FULL_DIR.DS.$old_image);
					}
					
					$this->User->id	=	$this->Auth->User('id');
					$avataruploaded = $this->User->saveField('background_image',$imageName,false);
					if ($avataruploaded){	
						echo "success|".$imageName;
					}else{
						echo "failed";
					}
					die;
				}
			}
		}		 
   }
   
   
   public function autosearch()
   {
		$this->layout = 'front';
   }
  

	public function auto_suggestion_list()
	{
		$this->layout = false;
		$this->autoRender = false ;
		if($_POST['query'])
		{
			$this->loadModel('Channel');
			$channel_data = $this->Channel->find('all',array('conditions'=>array('Channel.name LIKE'=>"%".trim($_POST['query'])."%"),'fields'=>array('Channel.name')));
			$result_data= array();
			if(!empty($channel_data))
			{
				$i=1;
				foreach($channel_data as $key=>$value)
				{
					$channel_data['id'] = $i;
					$channel_data['name'] = $value['Channel']['name'];
					$result_data[] = $channel_data;
					$i++;
				}
			}
		}
		echo json_encode ($result_data);
		die;
	}
	
	
	public function sendEmail(){
	
		$to = 'khemit.verma25@gmail.com';
		//$to = 'er.manish.developer@outlook.com';
		//$to = 'dinesh_it7@yahoo.co.in';
		//$to = 'kamalsinghjadoun@yahoo.in';
		$from = 'business@yoohcan.com';
		$subject= 'test mail';
		$template= 'default';
		$message = 'An verification email has been sent over to your email address. Please click over the verification link.<a href="http://google.com" target="_blank" shape="rect">Test</a>An verification email has been sent over to your email address. Please click over the verification link.An verification email has been sent over to your email address. Please click over the verification link.An verification email has been sent over to your email address. Please click over the verification link.An verification email has been sent over to your email address. Please click over the verification link.An verification email has been sent over to your email address. Please click over the verification link.An verification email has been sent over to your email address. Please click over the verification link.An verification email has been sent over to your email address. Please click over the verification link.An verification email has been sent over to your email address. Please click over the verification link.An verification email has been sent over to your email address. Please click over the verification link.An verification email has been sent over to your email address. Please click over the verification link.An verification email has been sent over to your email address. Please click over the verification link.An verification email has been sent over to your email address. Please click over the verification link.An verification email has been sent over to your email address. Please click over the verification link.An verification email has been sent over to your email address. Please click over the verification link.An verification email has been sent over to your email address. Please click over the verification link.An verification email has been sent over to your email address. Please click over the verification link.An verification email has been sent over to your email address. Please click over the verification link.An verification email has been sent over to your email address. Please click over the verification link.An verification email has been sent over to your email address. Please click over the verification link.';
		parent::__sendMailDinesh($to, $subject, $message, $from, $template);
		die("2");				
		
		$to = "er.manish.developer@outlook.com";
		$subject = "Yoohcan Test";
		$txt = "Hello world! Yoohcan Test";
		mail($to,$subject,$txt);
		
		echo 'Mail Send successfully.';die;
	}
	
	public function get_all_recordings()
	{
		
		
		$this->layout = false;
		$this->autoRender = false;
		$this->loadModel('RecordingStream');
		$this->loadModel('Stream');
		$value = $this->Stream->find('first',array('conditions' => array('Stream.id' => 116),'fields'=>array('Stream.id','Stream.stream_key','Stream.user_id','Stream.stream_bio','Stream.channel_id')));
		$recordings_data_array = array();
		
		if(!empty($value))
		{
			
				$ch = curl_init('https://api.cloud.wowza.com/api/v1/transcoders/'.$value['Stream']['stream_key'].'/recordings/');
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(    
				'Content-Type: application/json ;charset=utf-8', 
					'wsc-api-key:'.Configure::read('WOWZA_API_KEY'),
					'wsc-access-key:'.Configure::read('WOWZA_ACCESS_KEY')
					)                                                                       
				); 
				$result = curl_exec($ch);
				curl_close($ch);
				$response_array = json_decode($result,true);
				
				if(!empty($response_array['recordings']))
				{
					foreach($response_array['recordings'] as $k=>$v)
					{ 
						if($v['state'] == 'completed')
						{
							/* $thumb = $value['Stream']['user_id'].'_'.$value['Stream']['stream_key'].'_'.$v['id'].'.jpg';
							$thumbnail = '/var/www/html/app/webroot/uploads/recording_images/'.$thumb;
							$time = '00:00:10';
							exec("/usr/bin/ffmpeg -i ".$v['download_url']." -an -ss " . $time . " -an -r 1 -s qcif -vframes 1 -filter:v scale=280:160 -y $thumbnail 2>&1");
							$check_record_existing = $this->RecordingStream->find('count',array('conditions'=>array('RecordingStream.user_id'=>$value['Stream']['user_id'],'RecordingStream.recording_key'=>$v['id'],'RecordingStream.stream_key'=>$value['Stream']['stream_key']))); */
							
							
							
							
							$thumb = $value['Stream']['user_id'].'_'.$value['Stream']['stream_key'].'_'.$v['id'].'.jpg';
							
								$thumbnail = '/var/www/html/app/webroot/uploads/recording_images/'.$thumb;
								$time = '00:00:02';
								exec("/usr/bin/ffmpeg -i ".$v['download_url']." -an -ss " . $time . " -an -r 1 -s qcif -vframes 1 -filter:v scale=280:160 -y $thumbnail 2>&1");
								
								
								$recordings_data['RecordingStream']['id'] = 107;
								$recordings_data['RecordingStream']['image'] = $thumb;
								$recordings_data_array[] = $recordings_data;
								$recordings_data =array();
						}
					}
				}
			
		}
		if(!empty($recordings_data_array))
		{
			$this->RecordingStream->saveAll($recordings_data_array);
		}
		die;
		
	}
	
	
	
	public function get_mail_template()
	{
		$this->layout = false;
		$email_template = '';
		$email_template .= '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"><html><head><title>Yoohcan</title></head>';
		$email_template .= '<body>{TEMPLATE}</body></html>';
		return $email_template;
	}
	
	public function send_grid_mail($senderid=null,$receiverid=null,$subject=null,$message=null)
	{
		$this->layout = false;
		$senderid = "khemit.verma25@gmail.com";
		$receiverid = "er.manish.developer@outlook.com";
		$subject = "testsstts";
		$message = "hiiii";
		
		require APP.'Vendor/sendgrid/vendor/autoload.php';
		/* $senderid = $_POST["dsender"];
		$receiverid = $_POST["dreceiver"];
		$subject = $_POST["dsubject"];
		$message = $_POST["dmessage"]; */

		$sg_username = "team@yellowwalnut.nl";
		$sg_password = "4$5-.Fgh";

		$sendgrid = new SendGrid($sg_username, $sg_password);

		$mail = new SendGrid\Email();

		$emails = array(
			$receiverid
		);
		foreach ($emails as $recipient) {
			$mail->addTo($recipient);
		}
		$categories = array(
			"SendGrid Category"
		);
		foreach ($categories as $category) {
			$mail->addCategory($category);
		}
		$unique_args = array(
			"Name" => ""
		);
		foreach ($unique_args as $key => $value) {
			$mail->addUniqueArgument($key, $value);
		}
		try {
			$mail->
					setFrom($senderid)->
					setSubject($subject)->
					setHtml($message);
			if ($sendgrid->send($mail)) {
			   // echo "<script type='text/javascript'>alert('Sent mail successfully.')</script>";
			   echo "khemit";
			}
		} catch (Exception $e) {
			echo "Unable to send mail: ", $e->getMessage();
		}
		
		die("hiiii");
	}
	
   
	
}
