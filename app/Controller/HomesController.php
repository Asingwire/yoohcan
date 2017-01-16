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
class HomesController extends AppController {
/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Homes';

/**
 * This controller use a model admins
 *
 * @var array
 */
	//public $uses 		= array('Restaurant');
	
	//public $helpers 	= array('Html', 'Session','General');
	//var $components = 	array('');
	
	
	public function beforeFilter() {
	    parent::beforeFilter();
        $this->Auth->allow('index','fbLoginData','signupfb','linkedinlogin','register','login','channel_listing','live_stream','new_home','get_home_page_video_stream_detail','get_home_page_featured_stream_detail','popular_channels_detail');
    }
	
	/* 
	@this function are used to landing page dispay 
	@param :void
	@return : void
	*/
	public function index(){	
	
		
		$this->layout = 'front';
		$this->loadModel('Stream');
		$this->loadModel('Channel');
		$this->loadModel('RecordingStream');
		$this->loadModel('ChannelSubscription');
		$this->loadModel('Category');
		
		/* $this->RecordingStream->bindModel(
			array(
				'belongsTo'=>array('Stream')
				),
			false
		); */
		
		
		
		$this->RecordingStream->bindModel(array(
			'belongsTo'=>array(
				'Channel'=>array(
					'className'=>'Channel',
					// 'foreignKey'=>'sender_id',
					'fields'=>array('Channel.name','Channel.image','Channel.id')
				),
				'User'=>array(
					'className'=>'User',
					'fields'=>array('User.profile_image','User.first_name','User.last_name')
				)
			)
		),false);
		
		
		
		
		$this->Stream->bindModel(array(
			'belongsTo'=>array(
				'User'
			)
		),false); 
		
		
		//Home page Main slider start //
		
		$home_page_streams = $this->Stream->find('all',array('conditions'=>array('Stream.status'=>Configure::read('App.Status.active'),'Stream.is_home'=>1),'fields'=>array('Stream.id','Stream.player_id','Stream.title','Stream.subject','Stream.stream_bio','Stream.stream_image','User.profile_image','User.first_name','User.last_name','User.profile_image','Stream.stream_key'),'order'=>array('Stream.sorting'=>'ASC')));
		
		$this->set('home_page_streams',$home_page_streams);
		
		$home_page_stream_detail = $this->Stream->find('first',array('conditions'=>array('Stream.status'=>Configure::read('App.Status.active'),'Stream.is_home'=>1),'fields'=>array('Stream.id','Stream.player_id','Stream.title','Stream.subject','Stream.stream_bio','Stream.stream_image','User.profile_image','User.first_name','User.last_name','User.profile_image','Stream.stream_key'),'order'=>array('Stream.sorting'=>'ASC')));
		$this->set('home_page_stream_detail',$home_page_stream_detail);
		
		
		//Home page Main slider end  //
		
		
		
		
		// home page 4 sliders code start //
		$featured_categories = $this->Category->find('all',array('conditions'=>array('Category.featured'=>1,'Category.status'=>Configure::read('App.Status.active')),'order' => array('Category.sorting' => 'ASC'),'fields'=>array('Category.image','Category.name','Category.id')));
		
		$this->set('featured_categories',$featured_categories);
		
		$popular_channels = $this->Channel->find('all',array('conditions'=>array('Channel.featured'=>1,'Channel.status'=>Configure::read('App.Status.active')),'order' => array('Channel.sorting' => 'ASC'),'fields'=>array('Channel.id','Channel.image','Channel.name')));
		
		$this->set('popular_channels',$popular_channels);
		
		$upcoming_streams = $this->Stream->find('all',array('conditions'=>array('Stream.schedule_start_date >' => date('Y-m-d H:i:s'),'Stream.status'=>Configure::read('App.Status.active'),'Stream.stream_state != '=>STARTED),'fields'=>array('Stream.stream_image','Stream.title','Stream.id')));
		
		$this->set('upcoming_streams',$upcoming_streams);	
		
		
		$live_channels = $this->Stream->find('all',array('conditions'=>array('Stream.status'=>Configure::read('App.Status.active'),'Stream.stream_state'=>STARTED)));
		$this->set('live_channels',$live_channels);
		/* pr($live_channels);
		die; */
		
		
		
		// home page 4 sliders code end //
		
		
	
		$streams = $this->Stream->find('all',array('conditions'=>array('Stream.featured'=>1,'Stream.status'=>Configure::read('App.Status.active')),'fields'=>array('Stream.stream_image','Stream.title','Stream.id'))); 
		
		
		
		
		
		
		/* $channels = $this->Channel->find('all',array('conditions'=>array('Channel.featured'=>1,'Channel.status'=>Configure::read('App.Status.active')),'fields'=>array('Channel.id','Channel.image','Channel.name'))); */
		
		$home_page_videos = $this->RecordingStream->find('all',array('conditions'=>array('RecordingStream.is_home'=>1,'RecordingStream.status'=>Configure::read('App.Status.active')),'order'=>array('RecordingStream.sorting' => 'ASC'))); 
		
	/* 	pr($home_page_videos);
		die;
		 */
		
		/* $this->RecordingStream->bindModel(array(
			'belongsTo'=>array(
				'Channel'=>array(
					'className'=>'Channel',
					// 'foreignKey'=>'sender_id',
					'fields'=>array('Channel.name','Channel.image','Channel.id')
				)
			)
		),false);
		$this->RecordingStream->bindModel(array(
			'belongsTo'=>array(
				'User'=>array(
					'className'=>'User',
					'fields'=>array('User.profile_image','User.first_name','User.last_name')
				)
			)
		),false); */
	
	//$recorded_stream_detail = $this->RecordingStream->find('first',array('conditions'=>array('RecordingStream.is_home'=>1,'RecordingStream.status'=>Configure::read('App.Status.active'))),array('order'=>array('RecordingStream.sorting' => 'ASC'))); 
	
	$recorded_stream_detail = $this->RecordingStream->find('first',array('conditions'=>array('RecordingStream.is_home'=>1,'RecordingStream.status'=>Configure::read('App.Status.active')),'order'=>array('RecordingStream.sorting' => 'ASC'))); 
	
	
	/* pr($home_page_videos);
	pr($recorded_stream_detail);
	die; */
		
	/* 	pr($recorded_stream_detail);
		die; */
		
		$this->Stream->bindModel(array(
	   'hasOne' => array(
				'ChannelFollower' => array(
					'className' => 'ChannelFollower',
					'foreignKey' => 'stream_id',
					'fields' => array('is_follow'), 
					'conditions'=>array('ChannelFollower.user_id'=>$this->Auth->user('id'),'ChannelFollower.recording_stream_id'=>'0'),
				),
			),
			'belongsTo'=>array(
				'Channel'=>array(
					'className'=>'Channel',
					'fields'=>array('Channel.name','Channel.image','Channel.id','Channel.bio')
				),
				'User'=>array(
					'className'=>'User',
					'fields'=>array('User.profile_image','User.first_name','User.last_name')
				)
			)
		),false);
		
		/* $this->Stream->bindModel(array(
	   'hasOne' => array(
				'ChannelFollower' => array(
					'className' => 'ChannelFollower',
					'foreignKey' => 'stream_id',
					'fields' => array('is_follow'), 
					'conditions'=>array('ChannelFollower.user_id'=>$this->Auth->user('id'),'ChannelFollower.recording_stream_id'=>'0'),
				),
			),
			'belongsTo'=>array(
				'Channel'=>array(
					'className'=>'Channel',
					'fields'=>array('Channel.name','Channel.image','Channel.id','Channel.bio')
				)
			)
		),false);
		$this->Stream->bindModel(array(
			'belongsTo'=>array(
				'User'=>array(
					'className'=>'User',
					'fields'=>array('User.profile_image','User.first_name','User.last_name')
				)
			)
		),false); */
		$popular_channels_detail = $this->Channel->find('first',array('conditions'=>array('Channel.featured'=>1,'Channel.status'=>Configure::read('App.Status.active'))),array('order'=>array('Stream.id' => 'DESC')));
		
		$this->set('popular_channels_detail',$popular_channels_detail);
		

		$featured_stream_detail = $this->Stream->find('first',array('conditions'=>array('Stream.featured'=>1,'Stream.status'=>Configure::read('App.Status.active'))),array('order'=>array('Stream.id' => 'DESC')));
		$this->set('featured_stream_detail',$featured_stream_detail);

		$channel_subscribe_check_user = $this->ChannelSubscription->find('count',array('conditions'=>array('ChannelSubscription.user_id'=>$this->Auth->user('id'),'ChannelSubscription.channel_id'=>$featured_stream_detail['Channel']['id'],'ChannelSubscription.stream_id'=>$featured_stream_detail['Stream']['id'])));
		
		$banner_image = Configure::read("HOME_PAGE_BANNER_IMAGE");

		
	
		$this->set('banner_image',$banner_image);		
		$this->set('channel_subscribe_check_user',$channel_subscribe_check_user);		
			
		$this->set('recorded_stream_detail',$recorded_stream_detail);		
		$this->set('streams',$streams);
		//$this->set('channels',$channels);
		/* pr($home_page_videos);
		die; */
		$this->set('home_page_videos',$home_page_videos);
		$this->set('title_for_layout','Home');
	}
	
	
	
	
	
	function fbLoginData(){	
			
		$data = $this->User->find('first',array('conditions'=>array('OR'=>array('User.email'=>$_POST['email'], 'User.fb_id'=>$_POST['id']))));
		
		if(empty($data))
		{
			$fb_data = array();
			$fb_data['User']['role_id'] = '1';
			$fb_data['User']['email'] = (isset($_POST['email']))? $_POST['email']:"";
			$fb_data['User']['fb_id'] = (isset($_POST['id']))? $_POST['id']:"";
			$fb_data['User']['first_name'] = (isset($_POST['first_name']))? $_POST['first_name']:"";
			$fb_data['User']['last_name'] = (isset($_POST['last_name']))? $_POST['last_name']:"";
			$fb_data['User']['nickname'] = (isset($_POST['first_name']))? $_POST['first_name']:"";
			
			$this->Session->write('FacebookData', $fb_data);
			echo "1";die;
		}else
		{
			if(!empty($data['User']))
			{	
				
				$userData = array();
				$userData['User']['id'] = $data['User']['id'];
				$userData['User']['modified'] = date('Y-m-d H:i:s');
				$userData['User']['last_login'] = date("Y-m-d H:i:s",strtotime('now'));									
				$this->User->save($userData);
				$this->Session->write('Facebook.User', $userData['User']);
				$this->Session->write('Auth.FrontUser', $data['User']);
				$this->Auth->_loggedIn = true;	 	
				echo "1";die;
			}
			
		}
	
	
	}
	
	public function signupfb() {
		
		$this->set("title_for_layout", __("front", true)); 		
			
		$fbData = $this->Session->read('FacebookData');
		
		echo'<pre>';print_r($this->request->data);die;
		
		$this->set('fbData',$fbData);
		if(!empty($this->request->data)){
			
			if (!isset($this->request->params['_Token']['key']) || ($this->request->params['_Token']['key'] != $this->request->params['_Token']['key'])) {
				$blackHoleCallback = $this->Security->blackHoleCallback;
				$this->$blackHoleCallback();
            }
			
			//$this->request->data['User']['new_password'] = '123456';
			$this->request->data['User']['password'] = Security::hash($this->request->data['User']['new_password'], null, true);
			$this->request->data['User']['org_password'] = $this->request->data['User']['new_password'];
			$this->request->data['User']['fb_id'] = $fbData['User']['fb_id'];
			  
			//Validate User Data
			$this->User->set($this->request->data['User']);
			$this->User->setValidation('signupfb');			
			if ($this->User->validates()) {			
				//For university & stream				
				
				$this->request->data['User']['status'] = 1;
				/* $activationKey = substr(md5(uniqid()), 0, 20);				
				$this->request->data['User']['activation_key'] = $activationKey; */
				$fb_data	=	$this->request->data;
				$fb_data['User']['profile_image'] = (isset($fb_data['User']['fb_id']))? "http://graph.facebook.com/".$fb_data['User']['fb_id']."/picture?type=large":"";
				if(!empty($fb_data['User']['profile_image'])){
				$fb_data['User']['profile_image_type'] = 1;
				}
				$fb_data['User']['role_id'] = 1;
				$fb_data['User']['last_login'] = date("Y-m-d H:i:s",strtotime('now'));
				$fb_data['User']['is_online'] = 1;
				if(!empty($fb_data['User']['email'])){
					$this->loadModel('User');
					$data = $this->User->find('first',array('conditions'=>
													array(
														'OR'=>array('User.email'=>$fb_data['User']['email'], 'User.fb_id'=>$fb_data['User']['fb_id'])
														)
												));
					if(empty($data['User'])){
						if($this->User->save($fb_data)){
							$data['User']['id']	=	$this->User->id;
							$fb_data['User']['id']	=	$this->User->id;
						
							$this->Session->write('Facebook.User', $fb_data['User']);
							//$this->Session->write('Auth.FrontUser', $fb_data['User']);
							//$this->Auth->_loggedIn = true;						
						}
						$responseArray['status']	=	'true2';
					}
					else
					{
						/*************** LOGIN CODE ***************/
						if(!empty($data['User'])){
							$userData = array();
							$userData['User']['id'] = $data['User']['id'];
							$userData['User']['fb_id'] = $fb_data['User']['fb_id'];
							$userData['User']['is_online'] = 1;
							$userData['User']['modified'] = date('Y-m-d H:i:s');						
							$this->User->save($userData);
							$this->Session->write('Facebook.User', $fb_data['User']);							 	
						}
						$responseArray['status']	=	'true2';
					}
				}
			} else {
				$errors = $this->User->invalidFields();
				$responseArray['status']	=	'false';
				$responseArray['error']		=	$errors;				
			}			
			echo json_encode($responseArray);exit;			
		}elseif($this->Session->read('Auth.FrontUser.id') !=''){
			$this->redirect(array('controller' => 'users','action' => 'dashboard'));
		}			
    }
	
	
	
	public function linkedinlogin(){

		$baseURL = 'http://192.168.1.16/yoohcan/homes/linkedinlogin';
		$callbackURL = 'http://192.168.1.16/yoohcan/homes/linkedinlogin';
		/* $linkedinApiKey = '5d38y24r25iq';
		$linkedinApiSecret = 'dKUOYhsdvZzGHb3y'; */
		
		$linkedinApiKey = '752hiffk25vb0g';
		$linkedinApiSecret = 'W3ePNfntHZmUtJom';
		
		$linkedinScope = 'r_basicprofile r_emailaddress';
		
		require APP.'Vendor/linkedin/oauth_client.php';
		require APP.'Vendor/linkedin/http.php';
			if (isset($_GET["oauth_problem"]) && $_GET["oauth_problem"] <> "") {
			// in case if user cancel the login. redirect back to home page.
				$_SESSION["err_msg"] = $_GET["oauth_problem"];
				 $this->Session->setFlash(__('Error. Please, try again.'), 'default', array('class' => 'message bad'));
				exit;
			}
			$client = new oauth_client_class;

			$client->debug = false;
			$client->debug_http = true;
			$client->redirect_uri = $callbackURL;

			$client->client_id = $linkedinApiKey;
			$application_line = __LINE__;
			$client->client_secret = $linkedinApiSecret;

			if (strlen($client->client_id) == 0 || strlen($client->client_secret) == 0)
			die('Please go to LinkedIn Apps page https://www.linkedin.com/secure/developer?newapp= , '.
			'create an application, and in the line '.$application_line.
			' set the client_id to Consumer key and client_secret with Consumer secret. '.
			'The Callback URL must be '.$client->redirect_uri).' Make sure you enable the '.
			'necessary permissions to execute the API calls your application needs.';

			/* API permissions
			*/
			$client->scope = $linkedinScope;
			if (($success = $client->Initialize())) {
			if (($success = $client->Process())) {
			if (strlen($client->authorization_error)) {
			$client->error = $client->authorization_error;
			$success = false;
			} elseif (strlen($client->access_token)) {
			$success = $client->CallAPI(
					'http://api.linkedin.com/v1/people/~:(id,email-address,first-name,last-name,location,picture-url,public-profile-url,formatted-name,phone-numbers,num-connections)', 
					'GET', array(
						'format'=>'json'
					), array('FailOnAccessError'=>true), $user);
			}
			}
			$success = $client->Finalize($success);
			}
			if ($client->exit) exit;
			if ($success) {
			$user_id = 	$this->Session->read('Auth.User.id');
			//$user_id = $db->checkUser($user);
				// echo'<pre>';print_r($user);die;
				$user_data = $this->User->find('first',array('conditions'=>array('User.id != '=>$this->Session->read('Auth.User.id'),'User.linkdin_id'=>$user->id),'fields'=>array('User.linkdin_id')));
				if(!empty($user_data) && !empty($user_data['User']['linkdin_id']))
				{
					$this->Session->setFlash(__('Account already verified.Please verify with another acount.'), 'default', array('class' => 'message bad'));
					$this->redirect(array('controller'=>'users','action'=>'dashboard',$user_id ));
				}
			/* print_r($user_data);
			die("hiii"); */
				$this->request->data['User']['id'] =  $this->Session->read('Auth.User.id');
				$this->request->data['User']['role_id'] =  '1';
				$this->request->data['User']['linkdin_id'] =  $user->id;
				$this->request->data['User']['first_name'] =  $user->firstName;
				$this->request->data['User']['last_name'] =  $user->lastName;
				$this->request->data['User']['email'] =  $user->emailAddress;
				
				
				$this->User->set($this->request->data);
				if($this->User->save($this->request->data))
				//if(true)
				{
					$this->Session->setFlash(__('Linkdin verified sccessfully'));	
					$this->redirect(array('controller'=>'homes','action'=>'dashboard',$user_id ));
				
				}
				else
				{
					 $this->Session->setFlash(__('Error. Please, try again.'), 'default', array('class' => 'message bad'));
				}
				
			
			} else { 
				 $this->Session->setFlash(__('Error. Please, try again.'), 'default', array('class' => 'message bad'));
			}
	
	}
	
	public function new_home(){
	
	
			$this->layout = 'front';
		$this->loadModel('Stream');
		$this->loadModel('Channel');
		$this->loadModel('RecordingStream');
		
		$this->RecordingStream->bindModel(
			array(
				'belongsTo'=>array('Stream')
				),
			false
		);
		
		$streams = $this->Stream->find('all',array('conditions'=>array('Stream.featured'=>1,'Stream.status'=>Configure::read('App.Status.active')),'fields'=>array('Stream.stream_image','Stream.title','Stream.id')));
		
		$channels = $this->Channel->find('all',array('conditions'=>array('Channel.featured'=>1,'Channel.status'=>Configure::read('App.Status.active')),'fields'=>array('Channel.id','Channel.image','Channel.name')));
		
		$home_page_videos = $this->RecordingStream->find('all',array('order'=>array('RecordingStream.id' => 'DESC')));
		
		
		$this->RecordingStream->bindModel(array(
			'belongsTo'=>array(
				'Channel'=>array(
					'className'=>'Channel',
					// 'foreignKey'=>'sender_id',
					'fields'=>array('Channel.name','Channel.image')
				)
			)
		),false);
		$this->RecordingStream->bindModel(array(
			'belongsTo'=>array(
				'User'=>array(
					'className'=>'User',
					'fields'=>array('User.profile_image','User.first_name','User.last_name')
				)
			)
		),false);
	
		$recorded_stream_detail = $this->RecordingStream->find('first',array('order'=>array('RecordingStream.id' => 'DESC')));
	
		$this->set('recorded_stream_detail',$recorded_stream_detail);
		
		
		$this->set('streams',$streams);
		$this->set('channels',$channels);
		/* pr($home_page_videos);
		die; */
		$this->set('home_page_videos',$home_page_videos);
	
	
	
	
	}
	
	public function live_stream() {  
		if ($this->RequestHandler->isAjax()) {
			$this->autoRender = true;
			$this->layout = "ajax";
			
			
			$this->loadModel('RecordingStream');
			if(!empty($this->request->data))
			{

				$this->RecordingStream->bindModel(array(
					'belongsTo'=>array(
						'Channel'=>array(
							'className'=>'Channel',
							'fields'=>array('Channel.name','Channel.image')
						)
					)
				),false);
				$this->RecordingStream->bindModel(array(
					'belongsTo'=>array(
						'User'=>array(
							'className'=>'User',
							'fields'=>array('User.profile_image','User.first_name','User.last_name')
						)
					)
				),false);
			
				$recorded_stream_detail = $this->RecordingStream->find('first',array('conditions'=>array('RecordingStream.id'=>$this->request->data['id']),'order'=>array('RecordingStream.id' => 'DESC')));
				$this->set('recorded_stream_detail',$recorded_stream_detail);
			}
		}
		$this->render('/Elements/Front/Streams/live_stream');
    }
	
	public function get_home_page_video_stream_detail() {  
		if ($this->RequestHandler->isAjax()) {
			$this->autoRender = true;
			$this->layout = "ajax";
			
			
			if($_POST['type'] == 'stream')
			{
				$this->loadModel('Stream');
				$this->Stream->bindModel(array(
					'belongsTo'=>array(
						'User'
					)
				),false); 
				$home_page_stream_detail = $this->Stream->find('first',array('conditions'=>array('Stream.status'=>Configure::read('App.Status.active'),'Stream.id'=>$_POST['id']),'fields'=>array('Stream.id','Stream.player_id','Stream.title','Stream.subject','Stream.stream_bio','Stream.stream_image','User.profile_image','User.first_name','User.last_name','User.profile_image')));
				$this->set('home_page_stream_detail',$home_page_stream_detail);
			}
			elseif($_POST['type'] == 'video')
			{
				$this->loadModel('RecordingStream');
				
				$this->RecordingStream->bindModel(array(
					'belongsTo'=>array(
						'Channel'=>array(
							'className'=>'Channel',
							'fields'=>array('Channel.name','Channel.image')
						)
					)
				),false);
				$this->RecordingStream->bindModel(array(
					'belongsTo'=>array(
						'User'=>array(
							'className'=>'User',
							'fields'=>array('User.profile_image','User.first_name','User.last_name')
						)
					)
				),false);
			
				$recorded_stream_detail = $this->RecordingStream->find('first',array('conditions'=>array('RecordingStream.id'=>$this->request->data['id']),'order'=>array('RecordingStream.id' => 'DESC')));
				
				// pr($recorded_stream_detail);die;
				
				$this->set('recorded_stream_detail',$recorded_stream_detail);
				
				
				
				
			}
		$this->set('type',$_POST['type']);	
		$this->render('/Elements/Front/Streams/home_page_video_stream');
		}
    }
	public function popular_channels_detail() {  
		if ($this->RequestHandler->isAjax()) {
			$this->autoRender = true;
			$this->layout = "ajax";
			
			
			$this->loadModel('Channel');
			$this->loadModel('RecordingStream');
			if(!empty($this->request->data))
			{	
			 	$popular_channels_detail = $this->Channel->find('first',array('conditions'=>array('Channel.id'=>$this->request->data['id'],'Channel.featured'=>1,'Channel.status'=>Configure::read('App.Status.active')),'fields'=>array('Channel.id','Channel.image','Channel.name','Channel.bio','Channel.created')));
				
				$this->set('popular_channels_detail',$popular_channels_detail); 
				
				
				$home_page_recordinstream_detail = $this->RecordingStream->find('first',array('conditions'=>array('RecordingStream.status'=>Configure::read('App.Status.active'),'RecordingStream.is_home'=>1,'RecordingStream.channel_id'=>$this->request->data['id']),'fields'=>array('RecordingStream.id','RecordingStream.title','RecordingStream.stream_key','RecordingStream.download_url','RecordingStream.video_play_button_type','RecordingStream.channel_id'),'order'=>array('RecordingStream.created'=>'ASC')));
				$this->set('home_page_recordinstream_detail',$home_page_recordinstream_detail);
				
			}
		}
		$this->render('/Elements/Front/Channel/home_page_popular_channel');
    }
	

	/* public function get_home_page_featured_stream_detail() {  
		if ($this->RequestHandler->isAjax()) {
			$this->autoRender = true;
			$this->layout = "ajax";
		
			$this->loadModel('Stream');
			$this->loadModel('ChannelSubscription');
			if(!empty($this->request->data))
			{	

				$this->Stream->bindModel(array(
					'hasOne' => array(
						'ChannelFollower' => array(
							'className' => 'ChannelFollower',
							'foreignKey' => 'stream_id',
							'fields' => array('is_follow'), 
							'conditions'=>array('ChannelFollower.user_id'=>$this->Auth->user('id'),'ChannelFollower.recording_stream_id'=>'0'),
						),
					),
					'belongsTo'=>array(
						'Channel'=>array(
							'className'=>'Channel',
							'fields'=>array('Channel.name','Channel.image','Channel.id','Channel.bio')
						)
					)
				),false);
				$this->Stream->bindModel(array(
					'belongsTo'=>array(
						'User'=>array(
							'className'=>'User',
							'fields'=>array('User.profile_image','User.first_name','User.last_name')
						)
					)
				),false);
			
				$featured_stream_detail = $this->Stream->find('first',array('conditions'=>array('Stream.id'=>$this->request->data['id']),'order'=>array('Stream.id' => 'DESC')));
				
				$channel_subscribe_check_user = $this->ChannelSubscription->find('count',array('conditions'=>array('ChannelSubscription.user_id'=>$this->Auth->user('id'),'ChannelSubscription.channel_id'=>$featured_stream_detail['Channel']['id'],'ChannelSubscription.stream_id'=>$featured_stream_detail['Stream']['id'])));
			
				$this->set('featured_stream_detail',$featured_stream_detail);
				$this->set('channel_subscribe_check_user',$channel_subscribe_check_user);
			}
		}
		$this->render('/Elements/Front/Streams/featured_streams_details');
    } */
	
	
	
	
}
