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
class UsersController extends AppController {



/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Users';

/**
 * This controller use a model admins
 *
 * @var array
 */
	public $uses 		= array('User');
	
	public $helpers 	= array('Html', 'Session','General','Csv');
	var $components = 	array('General',"Upload");
	
	
	public function beforeFilter() {
	
        parent::beforeFilter();
        $this->loadModel('User');
		$this->Auth->allow('index','login','signup','change_password','fbSessionData','twitterOauth','twitterOauthCallback','contact_us','forgot_password','verify','fbLoginData','signupfb','linkedinlogin','register','tlogin','getTwitterData','activate','test_email');
		$streaming_guide_pdf = Configure::read("STREAMING_GUIDE_PDF");
		$this->set('streaming_guide_pdf',$streaming_guide_pdf);
    }

	
	
	/*
	@ param : null
	@ return void
	*/
	
	
	public function admin_add() {
		
		$this->set('title_for_layout','Users');
		
		if(!empty($this->request->data)){
			
			if (!isset($this->request->params['_Token']['key']) || ($this->request->params['_Token']['key'] != $this->request->params['_Token']['key'])) {
				$blackHoleCallback = $this->Security->blackHoleCallback;
				$this->$blackHoleCallback();
            }
			
			$this->request->data['User']['password'] = Security::hash($this->request->data['User']['new_password'], null, true);
			$this->request->data['User']['org_password'] = $this->request->data['User']['new_password'];
			  
			//validate user data
			$this->User->set($this->request->data['User']);
			$this->User->setValidation('add');
			
			
			if ($this->User->validates()) {
				$userdata	=	$this->request->data['User'];
				$this->User->save($userdata,false);
				
				$user_id	=	$this->User->id;
				
				$p_image	=	$this->request->data['User']['image'];
				$background_image	=	$this->request->data['User']['image1'];
				
				if (!empty($p_image) && $p_image['tmp_name'] != '' && $p_image['size'] > 0) {
		
					$allowed	=	array('jpg','jpeg','png');
					$temp 		= 	explode(".", $p_image["name"]);
					$extension 	= 	end($temp);
					$imageName 	= 	'profile_image_'.microtime(true).'.'.$extension;
					$files		=	$p_image;
					
					$result 	= 	$this->Upload->upload($files, WWW_ROOT . PROFILE_IMAGE_FULL_DIR . DS, $imageName,'',$allowed);
					
					if(!empty($this->Upload->result) && empty($this->Upload->errors)) {
						$this->User->id	=	$user_id;
						$this->User->saveField('profile_image',$imageName,false);
					}					
				}
				if (!empty($background_image) && $background_image['tmp_name'] != '' && $background_image['size'] > 0) {
		
					$allowed	=	array('jpg','jpeg','png');
					$temp 		= 	explode(".", $p_image["name"]);
					$extension 	= 	end($temp);
					$imageName 	= 	'background_image_'.microtime(true).'.'.$extension;
					$files		=	$background_image;
					
					$result 	= 	$this->Upload->upload($files, WWW_ROOT . BACKGROUND_IMAGE_FULL_DIR . DS, $imageName,'',$allowed);
					
					if(!empty($this->Upload->result) && empty($this->Upload->errors)) {
						$this->User->id	=	$user_id;
						$this->User->saveField('background_image',$imageName,false);
					}					
				} 	
				
				$this->Session->setFlash("Record has been added successfully", 'admin_flash_good');
				$this->redirect(array('controller'=>'users', 'action'=>'index'));
		
			} else {
				
				$this->Session->setFlash("Record has not been created", 'admin_flash_bad');
			}
		
		}
	}
	
	
	
	/*
	@ param : null
	@ return void
	*/
	
	public function admin_index() {
		
		
		if (!isset($this->params['named']['page'])) {
            $this->Session->delete('AdminSearch');
        }
		
		$filters	=	array();
        if (!empty($this->request->data)) {
			$this->Session->delete('AdminSearch');
           if (isset($this->request->data['User']['nickname']) && $this->request->data['User']['nickname'] != '') {
                $nickname = trim($this->request->data['User']['nickname']);
                $this->Session->write('AdminSearch.nickname', $nickname);
				
            }
			 if (isset($this->request->data['User']['start_date']) && $this->request->data['User']['start_date'] != '') {
                $start_date = trim($this->request->data['User']['start_date']);
                $this->Session->write('AdminSearch.start_date', $start_date);				
            }
			if (isset($this->request->data['User']['end_date']) && $this->request->data['User']['end_date'] != '') {
                $end_date = trim($this->request->data['User']['end_date']);
                $this->Session->write('AdminSearch.end_date', $end_date);				
            }
			if (isset($this->request->data['User']['is_paid']) && $this->request->data['User']['is_paid'] != '') {
                $is_paid = trim($this->request->data['User']['is_paid']);
                $this->Session->write('AdminSearch.is_paid', $is_paid);				
            }
		}
		
		if ($this->Session->check('AdminSearch')) {
            $keywords 	= 	$this->Session->read('AdminSearch');
			foreach($keywords as $key=>$values){
				if($key == 'nickname'){
					$filters[] = array('User.'.$key.' LIKE'=>"%".$values."%");					
				}
				if($key == 'is_paid'){
					$filters[] = array('User.'.$key=>$values);					
				}
				if($key == 'start_date') {
					$filters[] = array('User.created >='=>date('Y-m-d 00:00:00', strtotime($this->Session->read('AdminSearch.start_date'))));
				}
				if($key == 'end_date') {
					$filters[] = array('User.created <='=>date('Y-m-d 24:00:00', strtotime($this->Session->read('AdminSearch.end_date'))));
				}
				
				$this->admin_exportcsv($this->request->data);
			}
		}
		
		$this->paginate = array('User' => array(
			'limit' =>Configure::read('App.PageLimit'),
			'order' => array('User.sorting' => 'ASC'),
			'conditions' => $filters,
        ));
		$data = $this->paginate('User');		
		$this->set(compact('data'));
		$this->set('title_for_layout', __('User', true));
		
	}
	public function admin_exportcsv($data = null) {		
		$filters	=	array();
		$this->request->data = $data;
        if (!empty($this->request->data)) {
			$this->Session->delete('AdminSearch');
           if (isset($this->request->data['User']['username']) && $this->request->data['User']['username'] != '') {
                $username = trim($this->request->data['User']['username']);
                $this->Session->write('AdminSearch.username', $username);
				
            }
			 if (isset($this->request->data['User']['start_date']) && $this->request->data['User']['start_date'] != '') {
                $start_date = trim($this->request->data['User']['start_date']);
                $this->Session->write('AdminSearch.start_date', $start_date);				
            }
           if (isset($this->request->data['User']['end_date']) && $this->request->data['User']['end_date'] != '') {
                $end_date = trim($this->request->data['User']['end_date']);
                $this->Session->write('AdminSearch.end_date', $end_date);				
            }
		}
		
		if ($this->Session->check('AdminSearch')) {
            $keywords 	= 	$this->Session->read('AdminSearch');
			foreach($keywords as $key=>$values){
				if($key == 'username'){
					$filters[] = array('User.'.$key.' LIKE'=>"%".$values."%");					
				}
				if($key == 'start_date') {
				$filters[] = array('User.created >='=>date('Y-m-d 00:00:00', strtotime($this->Session->read('AdminSearch.start_date'))));
				$filters[] = array('User.created <='=>date('Y-m-d 24:00:00', strtotime($this->Session->read('AdminSearch.end_date'))));
				}
			}			
		}
		
		
		$data	=	$this->User->find('all',array('conditions'=>$filters));	
		$totalRecord = count($data);
		$totalRecord = $totalRecord;
		$startDate = date('Y-m-d', strtotime($this->Session->read('AdminSearch.start_date')));
		$endDate = date('Y-m-d', strtotime($this->Session->read('AdminSearch.end_date')));
		$title = array('User Reports From '.$startDate . ' To '. $endDate, '& Total User: '.$totalRecord); 
		if($startDate == '1970-01-01' && $endDate =='1970-01-01' ){
			$title = array('All User Reports & Total User: '.$totalRecord);
		}		
		$this->set(compact('data','title'));
	}
		
	/*
	@ param : null
	@ return void
	*/
	public function admin_edit($id = null){
	
		$this->set('title_for_layout','User');
		
		$this->User->id 	= 	$id;
		
		/*check conditions allreday conditions for users update*/
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
				//validate user data
				$this->User->set($this->request->data['User']);
				$this->User->setValidation('edit');
				if ($this->User->validates()) {
					$this->User->create();
				if ($this->User->save($this->request->data['User'],false)) {	
					
					$user_id	=	$id;
					
					$p_image	=	$this->request->data['User']['image'];
					$old_image	=	$this->request->data['User']['profile_image'];
					
					$background_image	=	$this->request->data['User']['image1'];
					$old_background_image	=	$this->request->data['User']['background_image'];
				
					if (!empty($p_image) && $p_image['tmp_name'] != '' && $p_image['size'] > 0) {
			
						$allowed	=	array('jpg','jpeg','png');
						$temp 		= 	explode(".", $p_image["name"]);
						$extension 	= 	end($temp);
						$imageName 	= 	'profile_image_'.microtime(true).'.'.$extension;
						$files		=	$p_image;
						
						$result 	= 	$this->Upload->upload($files, WWW_ROOT . PROFILE_IMAGE_FULL_DIR . DS, $imageName,'',$allowed);
						
						if(!empty($this->Upload->result) && empty($this->Upload->errors)) {
							
							if($old_image &&  file_exists(WWW_ROOT.PROFILE_IMAGE_FULL_DIR.DS.$old_image )) {
								@unlink(WWW_ROOT.PROFILE_IMAGE_FULL_DIR.DS.$old_image);
							}
							
							$this->User->id	=	$user_id;
							$this->User->saveField('profile_image',$imageName,false);
						}
						
					}
					
					if (!empty($background_image) && $background_image['tmp_name'] != '' && $background_image['size'] > 0) {
			
						$allowed	=	array('jpg','jpeg','png');
						$temp 		= 	explode(".", $background_image["name"]);
						$extension 	= 	end($temp);
						$imageName 	= 	'background_image_'.microtime(true).'.'.$extension;
						$files		=	$background_image;
						
						$result 	= 	$this->Upload->upload($files, WWW_ROOT . BACKGROUND_IMAGE_FULL_DIR . DS, $imageName,'',$allowed);
						
						if(!empty($this->Upload->result) && empty($this->Upload->errors)) {
							
							if($old_background_image &&  file_exists(WWW_ROOT.BACKGROUND_IMAGE_FULL_DIR.DS.$old_background_image )) {
								@unlink(WWW_ROOT.BACKGROUND_IMAGE_FULL_DIR.DS.$old_background_image);
							}
							
							$this->User->id	=	$user_id;
							$this->User->saveField('background_image',$imageName,false);
						}
						
					}					
					
					$this->Session->setFlash("Record has been added successfully", 'admin_flash_good');
					$this->redirect(array('controller'=>'users', 'action'=>'index'));
			
				} 
			} else {
					 $this->Session->setFlash(__('The User could not be saved. Please, try again.', true), 'admin_flash_bad');
                }
			}
        } else {
			$this->request->data = $this->User->read(null, $id);			
		}
	}
	
		
	/*
	@ param : null
	@ return void
	*/
	public function admin_view($id = null){
	
		$this->set('title_for_layout','User');
		
		$this->User->id = $id;
		$this->set(compact('id'));
		
		/*check conditions allreday conditions for users update*/
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid User'));
        }
		
		$data = $this->User->read(null, $id);
		$this->set(compact('data'));
	}
	
	/* 
	@ this function are used activated,deactivated and deleted users by admin
	*/
	public function admin_process() {
	
		if (!empty($this->request->data)) {
			if (!isset($this->request->params['_Token']['key']) || ($this->request->params['_Token']['key'] != $this->request->params['_Token']['key'])) {
                $blackHoleCallback = $this->Security->blackHoleCallback;
                $this->$blackHoleCallback();
            }
			
           // $action = Sanitize::escape($this->request->data['User']['pageAction']);
            $action = $this->request->data['User']['pageAction'];
            foreach ($this->request->data['User'] AS $value) {
                if ($value != 0) {
                    $ids[] = $value;
                }
            }

			
            if (count($this->request->data) == 0 || $this->request->data['User'] == null) {
                $this->Session->setFlash('No items selected.', 'admin_flash_bad');
                 $this->redirect(array('controller'=>'users', 'action'=>'index'));
            }

            if ($action == "delete") {
				
				
				$profileImages	=	$this->User->find('all',array('fields'=>array('id','profile_image','background_image'),'conditions'=>array('User.id'=>$ids)));
				
				if(!empty($profileImages)) {
					 
					foreach ($profileImages AS $img) {
						$image		=	$img['User']['profile_image'];
						$background_image		=	$img['User']['background_image'];
						if($image &&  file_exists(WWW_ROOT.PROFILE_IMAGE_FULL_DIR.DS.$image )) {
							@unlink(WWW_ROOT.PROFILE_IMAGE_FULL_DIR.DS.$image);
						}
						if($background_image &&  file_exists(WWW_ROOT.BACKGROUND_IMAGE_FULL_DIR.DS.$background_image )) {
							@unlink(WWW_ROOT.BACKGROUND_IMAGE_FULL_DIR.DS.$background_image);
						}
					}
				}
				$this->User->deleteAll(array('User.id'=>$ids));
                $this->Session->setFlash('Users have been deleted successfully', 'admin_flash_good');
                $this->redirect(array('controller'=>'users', 'action'=>'index'));
            }
			
            if ($action == "activate") {
				
				$this->User->updateAll(array('status'=>Configure::read('App.Status.active')),array('User.id'=>$ids));
               
                $this->Session->setFlash('Users have been activated successfully', 'admin_flash_good');
                $this->redirect(array('controller'=>'users', 'action'=>'index'));
            }
			
            if ($action == "deactivate") {
			
				$this->User->updateAll(array('status'=>Configure::read('App.Status.inactive')),array('User.id'=>$ids));
				
                $this->Session->setFlash('Users have been deactivated successfully', 'admin_flash_good');
				$this->redirect(array('controller'=>'users', 'action'=>'index'));
            }
			
        } else {
            $this->redirect(array('controller' => 'users', 'action' => 'index'));
        }
		
    }
	
	
	public function admin_delete($id = null) {
		$this->layout = false;
		if (!$id) {
            $this->Session->setFlash(__('Invalid  id', true), 'admin_flash_good');
            $this->redirect(array('action' => 'index'));
        } else {
			
			 $profileImage	=	$this->User->find('first',array('fields'=>array('User.id','User.profile_image','User.background_image'),'conditions'=>array('User.id'=>$id)));
		
			if(!empty($profileImage['User']['profile_image']) &&  file_exists(WWW_ROOT.PROFILE_IMAGE_FULL_DIR.DS.$profileImage['User']['profile_image'] ) )
			{
				@unlink(WWW_ROOT.PROFILE_IMAGE_FULL_DIR.DS.$profileImage['User']['profile_image']);
			}
			if(!empty($profileImage['User']['background_image']) &&  file_exists(WWW_ROOT.BACKGROUND_IMAGE_FULL_DIR.DS.$profileImage['User']['background_image'] ))
			{
				@unlink(WWW_ROOT.BACKGROUND_IMAGE_FULL_DIR.DS.$profileImage['User']['background_image']);
			}
			
			
			/* // remove the entries from reference table start //
			
			$this->loadModel('Channel');
			$this->loadModel('ChannelFollower');
			$this->loadModel('ChannelSubscription');
			$this->loadModel('Message');
			$this->loadModel('Transaction');
			$this->loadModel('UserDetail');
			$this->loadModel('UserNotification');
			$this->loadModel('RecordingStream');
			$this->loadModel('Stream');
			
			
			$this->ChannelFollower->deleteAll(array('ChannelFollower.user_id' => $id));
			$this->ChannelSubscription->deleteAll(array('ChannelSubscription.user_id' => $id));
			$this->Message->deleteAll(array('Message.sender_id' => $id));
			$this->Transaction->deleteAll(array('Transaction.user_id' => $id));
			$this->UserDetail->deleteAll(array('UserDetail.user_id' => $id));
			$this->UserNotification->deleteAll(array('UserNotification.user_id' => $id));
			
			
			// remove channel start //
			$Channel = $this->Channel->find('first',array('conditions'=>array('Channel.user_id'=>$id)));
			if(!empty($Channel))
			{
				if($Channel['Channel']['image'] &&  file_exists(WWW_ROOT.CHANNEL_IMAGE_FULL_DIR.DS.$Channel['Channel']['image'] )) 
				{
					@unlink(WWW_ROOT.CHANNEL_IMAGE_FULL_DIR.DS.$Channel['Channel']['image']);
				}
				$this->Channel->deleteAll(array('Channel.user_id' => $id));
			}
			// remove channel end //
			
			// remove recordings start //
		
			$RecordingStream = $this->RecordingStream->find('all',array('conditions'=>array('RecordingStream.user_id'=>$id)));
			if(!empty($RecordingStream))
			{
				foreach($RecordingStream as $recording_key=>$recording_value)
				{
				
					if($recording_value['RecordingStream']['image'] &&  file_exists(WWW_ROOT.RECORDING_IMAGE_FULL_DIR.DS.$recording_value['RecordingStream']['image'] )) 
					{
						@unlink(WWW_ROOT.RECORDING_IMAGE_FULL_DIR.DS.$recording_value['RecordingStream']['image']);
					}
					
					$ch = curl_init('https://api.cloud.wowza.com/api/v1/recordings/'.$recording_value['RecordingStream']['recording_key'].'/');
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    
					curl_setopt($ch, CURLOPT_HTTPHEADER, array(    
					'Content-Type: application/json ;charset=utf-8', 
						'wsc-api-key:'.Configure::read('WOWZA_API_KEY'),
						'wsc-access-key:'.Configure::read('WOWZA_ACCESS_KEY')
						)                                                                       
					); 
					$result = curl_exec($ch);
					curl_close($ch);
					
				}
				$this->RecordingStream->deleteAll(array('RecordingStream.user_id' => $id));
				
			}
			
			// remove recordings end //
			
			
			// remove streams start //
			$Stream = $this->Stream->find('all',array('conditions'=>array('Stream.user_id'=>$id)));
			if(!empty($Stream))
			{
				foreach($Stream as $stream_key=>$stream_value)
				{
				
					if($stream_value['Stream']['stream_image'] &&  file_exists(WWW_ROOT.STREAM_IMAGE_FULL_DIR.DS.$stream_value['Stream']['stream_image'] )) 
					{
						@unlink(WWW_ROOT.STREAM_IMAGE_FULL_DIR.DS.$stream_value['Stream']['stream_image']);
					}
					
					if(!empty($stream_value['Stream']['stream_key']))
					{
						$ch = curl_init('https://api.cloud.wowza.com/api/v1/live_streams/'.$stream_value['Stream']['stream_key'].'/');
						curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    
						curl_setopt($ch, CURLOPT_HTTPHEADER, array(    
						'Content-Type: application/json ;charset=utf-8', 
							'wsc-api-key:'.Configure::read('WOWZA_API_KEY'),
							'wsc-access-key:'.Configure::read('WOWZA_ACCESS_KEY')
							)                                                                       
						); 
						$result = curl_exec($ch);
						curl_close($ch);
					}
					if(!empty($stream_value['Stream']['schedule_id']))
					{
						$ch = curl_init('https://api.cloud.wowza.com/api/v1/schedules/'.$stream_value['Stream']['schedule_id'].'/');
						curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    
						curl_setopt($ch, CURLOPT_HTTPHEADER, array(    
						'Content-Type: application/json ;charset=utf-8', 
							'wsc-api-key:'.Configure::read('WOWZA_API_KEY'),
							'wsc-access-key:'.Configure::read('WOWZA_ACCESS_KEY')
							)                                                                       
						); 
						$result = curl_exec($ch);
						curl_close($ch);
					}
					
				}
				$this->Stream->deleteAll(array('Stream.user_id' => $id));
				
			}
			
			// remove streams end // 
			
			
			// remove the entries from reference table end // */
			
			
			
			
            if ($this->User->deleteAll(array('User.id' => $id))) {
			
				
                $this->Session->setFlash('Record has been deleted successfully','admin_flash_good');
                $this->redirect($this->referer());
            }
        }
		
    }
	
	
	/*
	@ param : null
	@ return void
	*/
	public function admin_change_password($id = null) {
		
		$this->set('title_for_layout','Change Password');
		
		if(!empty($this->request->data)){
			if (!isset($this->request->params['_Token']['key']) || ($this->request->params['_Token']['key'] != $this->request->params['_Token']['key'])) {
				$blackHoleCallback = $this->Security->blackHoleCallback;
				$this->$blackHoleCallback();
            }
			//validate user data
			$this->User->set($this->request->data);
			$this->User->setValidation('change_password');
			//pr($this->request->data);die;
			if ($this->User->validates()) {				
				/******update users info and redirect page action******/
				$this->request->data['User']['id']       = $id;
				$this->request->data['User']['password'] = Security::hash($this->request->data['User']['new_password'], null, true);
				
			
				if ($this->User->save($this->request->data)) {					
					$this->Session->setFlash('The password has been updated successfully', 'admin_flash_good');
					$this->redirect(array('action' => 'index'));
					
				} else {
					$this->Session->setFlash('The password could not be saved. Please, try again.', 'admin_flash_bad');
				} 
			} else{
				$this->Session->setFlash('The password could not be saved. Please, try again.', 'admin_flash_bad');
			}
		}
		$this->set('id',$id);
		
	}
	
	 public function admin_status($id = null) {
        if ($this->Session->check('Auth.User.id') && $this->Session->read('Auth.User.role_id') == Configure::read('App.SubAdmin.role')) { die('iiififififi');
            $this->Session->setFlash(__('You are not authorizatized for this action'), 'admin_flash_error');
            $this->redirect(array('controller' => 'admins', 'action' => 'dashboard'));
        }
        $this->User->id = $id;
		
		
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
       
        $this->loadModel('User'); 
        if ($this->User->toggleStatus($id)) { 
            $this->Session->setFlash(__('Admin\'s status has been changed'), 'admin_flash_good');
		    $this->redirect($this->referer());
        }
        $this->Session->setFlash(__('Admin\'s status was not changed', 'admin_flash_error'));
        $this->redirect($this->referer());
    }
	
	public function admin_change_account_type($id = null) {	
		
		$get_featured_detail = $this->User->find('first',array('conditions'=>array('User.id'=>$id),'fields'=>array('User.id','User.account_type')));
	
		if($get_featured_detail['User']['account_type'] == 1)
		{
			$this->User->id = $get_featured_detail['User']['id'];
			$this->User->saveField('account_type',0);
			$this->Session->setFlash(__('Admin\'s user account type was not changed', 'admin_flash_error'));
			$this->redirect($this->referer());
		}
		else
		{
			$this->User->id = $get_featured_detail['User']['id'];
			$this->User->saveField('account_type',1);
			$this->Session->setFlash(__('Admin\'s user account type has been changed'), 'admin_flash_good');
			
			$this->redirect($this->referer());
		}
    }


	
	
	
	
	
	
	
	
	/**
     * 
     *   @function name	:	generatePassword
	*	@Param			:	length, strength
	*	@Description	:	For generate the password 
    */ 
	 private function generatePassword($length = 9, $strength = 0) {
        $vowels = 'aeuy';
        $consonants = 'bdghjmnpqrstvz';
        if ($strength & 1) {
            $consonants .= 'BDGHJLMNPQRSTVWXZ';
        }
        if ($strength & 2) {
            $vowels .= "AEUY";
        }
        if ($strength & 4) {
            $consonants .= '23456789';
        }
        if ($strength & 8) {
            $consonants .= '@#$%';
        }

        $password = '';
        $alt = time() % 2;
        for ($i = 0; $i < $length; $i++) {
            if ($alt == 1) {
                $password .= $consonants[(rand() % strlen($consonants))];
                $alt = 0;
            } else {
                $password .= $vowels[(rand() % strlen($vowels))];
                $alt = 1;
            }
        }
        return $password;
    }
	public function admin_featured($id = null) {	
		
		$get_featured_detail = $this->User->find('first',array('conditions'=>array('User.id'=>$id),'fields'=>array('User.id','User.featured')));
	
		if($get_featured_detail['User']['featured'] == 1)
		{
			$this->User->id = $get_featured_detail['User']['id'];
			$this->User->saveField('featured',0);
			 $this->Session->setFlash(__('Admin\'s user featured has been changed'), 'admin_flash_good');
				$this->redirect($this->referer());
		}
		else
		{
			$this->User->id = $get_featured_detail['User']['id'];
			$this->User->saveField('featured',1);
			$this->Session->setFlash(__('Admin\'s user unfeatured was not changed', 'admin_flash_error'));
			$this->redirect($this->referer());
		}
    }
	
	
		
	public function register() 
	{
		$check_registration_status = false;
		if ($this->RequestHandler->isAjax()) {
			$this->autoRender = true;
			$this->layout = 'ajax';
		} 
		
		if ($this->request->is('post')) 
		{	
			unset($this->request->data['User']['id']);
			$this->User->set($this->request->data);
			$this->User->setValidation('front_registration');
			
			$verification_code = substr(md5(uniqid()), 0, 20);
			$this->request->data['User']['verification_code'] = $verification_code;
			
			if($this->User->validates()) 
			{
				
				$this->request->data['User']['first_name'] = ucwords($this->request->data['User']['first_name']);
				$this->request->data['User']['last_name'] = ucwords($this->request->data['User']['last_name']);		
				
				$this->request->data['User']['role_id'] = 1;
				$email = $this->request->data['User']['email'];
				$first_name = $this->request->data['User']['first_name'];
				$password = $this->request->data['User']['password_new'];
				
				
				$this->request->data['User']['password'] = Security::hash($password, null, true);
				$this->request->data['User']['original_password'] = $password;
				/* $this->User->create(); */						
				$this->request->data['User']['first_name'] = ucwords($this->request->data['User']['first_name']);
				$this->request->data['User']['last_name'] = ucwords($this->request->data['User']['last_name']);
				// $this->request->data['User']['status'] = Configure::read('App.Status.active');
				if($this->User->save($this->request->data)) {
				
					$check_registration_status = true;
					$this->loadModel('EmailTemplate');
					/* start send email confirmation link to user */
					$UserRegistration = $this->EmailTemplate->find('first', array('conditions' => array('EmailTemplate.slug' => 'user_registration')));
					
					$subject = $UserRegistration['EmailTemplate']['subject'];							
					$activationCode = $this->request->data['User']['verification_code'];						
					$activation_url = Router::url(array( 'controller' => 'users', 'action' => 'activate', base64_encode($email), $verification_code, ), true);			
					//$activation_link = '<a href="'.$activation_url.'">'.$activation_url.'</a>';
					$activation_link	=' <a href="'.$activation_url.'" target="_blank" shape="rect">Activation Link</a>';
					//$activation_link	= $activation_url;
					
					
					$get_mail_template = parent::get_mail_template();
					$get_mail_template = str_replace('{TEMPLATE}',$UserRegistration['EmailTemplate']['description'],$get_mail_template);
					
					
					$mail_message = str_replace(array('{name}','{email}','{activation_link}','{password}'), array($first_name,$email,$activation_link,$password), $get_mail_template);
					
					$to = $this->request->data["User"]["email"];
					$from = Configure::read('SITE_EMAIL');
						$template= 'default';
					
						$ajax_email = "true";
						$email_status = "flash_good";
						$message = "An verification email has been sent over to your email address. Please click over the verification link.";
					// pr($mail_message);die;
					
					//if (parent::__sendMail($to, $subject, $mail_message, $from, $template)){
					if (parent::send_grid_mail($from,$to,$subject,$mail_message)){
						
						$ajax_email = "true";
						$email_status = "flash_popup_good";
						$message = "An verification email has been sent over to your email address. Please click over the verification link.";
						
					}else{
						$ajax_email = "false";
						$email_status = "flash_warning";
						$message = "An verification email can not be sent over to your email address. We will notify you lately.";
					}
					if ($this->RequestHandler->isAjax()) {
						$this->Session->setFlash($message, 'flash_popup_good');
					}else{
						$this->Session->setFlash($message, 'flash_error');
					}
				}else{
					$this->Session->setFlash('Registration cannot be done.Please try again.', 'flash_error');
				}				
			}else{
			
				$this->Session->setFlash('Registration cannot be done.Please try again.', 'flash_popup_error');
			
			}
		}
		$this->set('check_registration_status',$check_registration_status);
		$this->render('/Elements/Front/User/sign_up');
		$this->set("loginRedirect",$this->Auth->loginRedirect); 
		
	}
	public function login() { 
		if ($this->RequestHandler->isAjax()) {
			$this->autoRender = true;
			$this->layout = "ajax";
			if(!empty($this->request->data))
			{
				$chk_user_login = $this->User->find('first',array('conditions'=>array('User.email'=>$this->request->data['User']['email'],'User.password'=>Security::hash($this->request->data['User']['password_new'], null, true),'User.status'=>Configure::read('App.Status.active'),'User.account_type'=>Configure::read('App.Accoutn_Type.disable'))));
				if(!empty($chk_user_login))
				{
					$this->Session->setFlash('Your account is not activate.', 'flash_popup_error');
				}
				else
				{
					
					$chk_user_login = $this->User->find('first',array('conditions'=>array('User.email'=>$this->request->data['User']['email'],'User.password'=>Security::hash($this->request->data['User']['password_new'], null, true),'User.status'=>Configure::read('App.Status.active'),'User.account_type'=>Configure::read('App.Accoutn_Type.enable'))));
					if(!empty($chk_user_login))
					{
						$this->Session->write('Auth.User', $chk_user_login['User']);
						echo "<script>window.location.href = '".SITE_URL."users/dashboard'</script>";		
					}
					else
					{
						$this->Session->setFlash('Invalid email or password. Please try again.', 'flash_popup_error');
					}
				}
				
			}
		}
		$this->render('/Elements/Front/User/login');
    }
	public function logout() {
        $this->Session->delete('Auth.User');
		$this->Session->destroy();
	    $this->redirect(array('controller' => 'homes', 'action' => 'index'));
    }

	
	
	public function general_info_edit(){
	
			
	 	 if ($this->RequestHandler->isAjax()) {
			$this->autoRender = false;
			$this->layout = 'ajax';
		}  
					
		if ($this->request->data) 
		{		
			$this->User->set($this->request->data);
			$this->User->setValidation('general_info');
			
			if($this->User->validates()) 
			{ 
				if(isset($this->request->data['User']['password_new']) && !empty($this->request->data['User']['password_new'])){
				
					$password = $this->request->data['User']['password_new'];
					$this->request->data['User']['password'] = Security::hash($password, null, true);
					$this->request->data['User']['original_password'] = $password;
				
				}
			
			
			
				if($this->User->save($this->request->data)) {
				
					
					
					$this->Session->setFlash(__('User information updated successfully.'), 'flash_success');
					echo "<script>window.location.href = '".SITE_URL."users/dashboard'</script>";						
				}else{
					$this->Session->setFlash('User information cannot be saved.Please try again.', 'flash_error');
				}	
			}else{
			
			$this->Session->setFlash('User information cannot be saved.Please try again.', 'flash_popup_error');
			}			
		}else{	
			$user_id = $this->Session->read('Auth.User.id');
			$exist = $this->User->find('first',array('conditions'=>array('User.id'=>$user_id)));
			$this->request->data = $exist;
		}
		$this->render('/Elements/Front/User/general_info_edit');
		
	}
	
	
	
	
	public function linkedinlogin(){
	
		
	
		 $baseURL = SITE_URL.'/users/linkedinlogin';
		$callbackURL = SITE_URL.'/users/linkedinlogin';	

		$linkedinApiKey = Configure::read("LINKDIN_APP_ID");
		$linkedinApiSecret = Configure::read("LINKDIN_APP_SECRET_KEY");

		$linkedinScope = 'r_basicprofile r_emailaddress';
		
		require APP.'Vendor/linkedin/oauth_client.php';
		require APP.'Vendor/linkedin/http.php';
			if (isset($_GET["oauth_problem"]) && $_GET["oauth_problem"] <> "") {
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
		
		
		$client->scope = $linkedinScope;
		if (($success = $client->Initialize())) {
			if (($success = $client->Process())) {
				if (strlen($client->authorization_error)) {
					$client->error = $client->authorization_error;
					$success = false;
				} elseif (strlen($client->access_token)) {
					$success = $client->CallAPI(
					'http://api.linkedin.com/v1/people/~:(id,email-address,first-name,last-name,location,picture-urls::(original),public-profile-url,formatted-name,phone-numbers,num-connections)', 
					'GET', array(
						'format'=>'json'
					), array('FailOnAccessError'=>true), $user);
					
					
				}
			}
			
			$success = $client->Finalize($success);
		}
		
		if ($client->exit) exit;
		if(isset($user->pictureUrls->values[0]) && !empty($user->pictureUrls->values[0])){				
			$linkedin_id = $user->id;
			$image = file_get_contents($user->pictureUrls->values[0]);
			$dir = WWW_ROOT . PROFILE_IMAGE_FULL_DIR . DS.$linkedin_id.'.jpg';
			file_put_contents($dir,$image);
			$linkedin_image = $linkedin_id.'.jpg';
		}else{
			$linkedin_image = "";
		}
		
		if ($success && !empty($user->id)) {	
			
			$linkedin_register_user = $this->User->find('first',array('conditions'=>array('User.linkedin_id'=>$user->id)));
			if(isset($linkedin_register_user) && !empty($linkedin_register_user)){
			
				$this->Session->write('Auth.User',$linkedin_register_user['User']);
				$this->Session->setFlash(__('Login Successfully.'), 'flash_success');	
				$this->redirect(array('controller'=>'users','action'=>'dashboard'));
			
			}else{
			
				$linkedin_user_detail['User']['linkedin_id'] = $user->id;				
				$linkedin_user_detail['User']['email'] = $user->emailAddress;				
				$linkedin_user_detail['User']['nickname'] = $user->firstName;				
				$linkedin_user_detail['User']['first_name'] = $user->firstName;				
				$linkedin_user_detail['User']['last_name'] = $user->lastName;				
				$linkedin_user_detail['User']['linkedin_verified_status'] = 1;
				$linkedin_user_detail['User']['profile_image'] = (isset($linkedin_image))? $linkedin_image:"";					
				$linkedin_user_detail['User']['role_id'] = '1';
				if($this->User->save($linkedin_user_detail))
				{	
					$user_id = $this->User->id;
					$register_user = $this->User->find('first',array('conditions'=>array('User.id'=>$user_id)));
					$this->Session->write('Auth.User',$register_user['User']);	
					$this->Auth->_loggedIn = true;	
					$this->redirect(array('controller'=>'users','action'=>'dashboard'));				
					$this->Session->setFlash(__('Login Successfully.'), 'flash_success');	
				}
				else
				{
					$this->Session->setFlash(__('Error. Please, try again.'), 'flash_error');
				}				
			}
		}else{
			
			 $this->Session->setFlash(__('Error. Please, try again.'), 'flash_error');
		} 
	}
	
	public function linkedin_verification(){
		
		$baseURL = SITE_URL.'/users/linkedin_verification';
		$callbackURL = SITE_URL.'/users/linkedin_verification';	
	
		$linkedinApiKey = Configure::read("LINKDIN_APP_ID");
		$linkedinApiSecret = Configure::read("LINKDIN_APP_SECRET_KEY");
		
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
			if ($success) 
			{
				
				$userId = $this->Auth->user('id'); 
				$this->User->id = $userId; 
				$this->request->data['User']['linkedin_id']= $user->id;;
				$this->request->data['User']['linkedin_verified_status']= 1;
				if($this->User->save($this->request->data))
				{
					$this->Session->setFlash(__('Your LinkedIn account verified successfully.'), 'flash_success');	
					$this->redirect(array('controller'=>'users', 'action'=>'dashboard'));		
				}
				else
				{
					$this->Session->setFlash('LinkedIn account not verified.Please try again', 'flash_error');
					$this->redirect(array('controller'=>'users', 'action'=>'dashboard'));		
				}
				
			
			
			} else { 
				 
				 $this->Session->setFlash('Error. Please, try again.', 'flash_error');
				 $this->redirect(array('controller'=>'users', 'action'=>'dashboard'));		
			}
	
	}
	
	
	
	function forgot_password()	{
	
		if ($this->RequestHandler->isAjax()) {
			$this->autoRender = true;
			$this->layout = "ajax";
		}
		if($this->Auth->user())
		{
			$this->redirect(array('controller'=>'users', 'action' => 'update_profile'));
		}
	
		if(!empty($this->request->data))
		{
			
			$this->User->set($this->request->data);
			$this->User->setValidation('forgot_password');
			if($this->User->validates($this->request->data))
			{
				
				$userDetail	= $this->User->find("first", array('conditions' => array('User.email' => $this->request->data["User"]["email"] ,'User.status' => 1)));
				if(!empty($userDetail))
				{
					$this->User->id	=	$userDetail['User']['id'];
					$verification_code = substr(md5(uniqid()), 0, 20);
					$this->request->data['User']['verification_code'] = $verification_code;
					$this->request->data['User']['id'] = $userDetail['User']['id'];
				
					if($this->User->save($this->request->data))
					{ 
					
						
					
					
						$activation_url = Router::url(array( 'controller' => 'users', 'action' => 'change_password', base64_encode($userDetail['User']['email']), $verification_code ), true);
						$this->loadModel('EmailTemplate');
						$forgetPassMail = $this->EmailTemplate->find('first', array('conditions' => array('EmailTemplate.slug' => 'forgot_password')));
						
						
						$subject = $forgetPassMail['EmailTemplate']['subject'];
						$activation_link	=' <a href="'.$activation_url.'" target="_blank" shape="rect">Change Password</a>';
						//$activation_link	= $activation_url;
							
						//$mail_message = str_replace(array('{NAME}', "{ACTIVATION_LINK}"), array($userDetail['User']['first_name'], $activation_link), $forgetPassMail['EmailTemplate']['description']);
						$to = $userDetail['User']['email'];
						$from = Configure::read('SITE_EMAIL');
						//$template='default';
						//$this->set('message', $mail_message);						 
						//$template='default';	
						
						$get_mail_template = parent::get_mail_template();
						$get_mail_template = str_replace('{TEMPLATE}',$forgetPassMail['EmailTemplate']['description'],$get_mail_template);
						$mail_message = str_replace(array('{NAME}', "{ACTIVATION_LINK}"), array($userDetail['User']['first_name'], $activation_link), $get_mail_template);
						
						
						parent::send_grid_mail($from,$to,$subject,$mail_message);
						/* echo $from;
						echo $to;
						echo $subject;
						
						
						die("hiiii"); */
						//parent::__sendMail($to, $subject, $mail_message, $from, $template);	
						$this->Session->setFlash(__('A link has been emailed to you.'), 'flash_popup_good');
						if (!$this->RequestHandler->isAjax()) {
							$this->redirect(array('controller'=>'users', 'action' => 'forgot_password'));			
						}
					}
					else
					{
						$this->Session->setFlash(__('email address is not registered with yoohcan !!', 'flash_popup_error'));
					}
					
				}
				else
				{
					$this->Session->setFlash(__('email address is not registered', true), 'flash_popup_error');
				
				}
			}
		}else{
			
			$this->Session->setFlash('Invalid email or password. Please try again', 'flash_popup_error');
			
		}
		// $this->layout = 'dashboard';
		$this->render('/Elements/Front/User/forget');
	}
	
	    function change_password($email = null, $verification_code = null) {
		if ($this->Auth->user()) {
            $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
        }

      	$email = base64_decode($email);
        $userDetail = $this->User->find("first", array('conditions' => array('User.email' => $email)));
		if ($this->User->hasAny(array('User.email' => $email,'User.verification_code' => $verification_code))) {
            if (!empty($this->request->data)) {
                $this->User->set($this->request->data);
                $this->User->setValidation('reset_password');
                if ($this->User->validates($this->request->data)) {
					$this->request->data['User']['id'] = $userDetail['User']['id'];
                    $this->request->data['User']['password'] = Security::hash($this->request->data['User']['password2'], null, true);
                    $this->request->data['User']['original_password'] = $this->request->data['User']['password2'];
                    $verification_code = substr(md5(time()), 0, 20);
                    $this->request->data['User']['verification_code'] = $verification_code;

                    unset($this->request->data['User']['email']);
                    if ($this->User->saveAll($this->request->data)) {                      
					
						$this->Session->setFlash(__('Please login to continue.', true), 'flash_success');
						$this->request->data['User']['email'] = $email;
						 
                    }
                } else {
                    $this->Session->setFlash(__('Please check the errors listed below.', true), 'flash_error');
                    $this->request->data['User']['email'] = $email;
                }
            } else {
               $this->request->data['User']['email'] = $email;
            }
        } else {
        	   $this->Session->setFlash(__('Please use the latest password reset link.', true), 'flash_error');
			   $this->redirect(array('controller' => 'homes', 'action' => 'index'));
        }

		$title_for_layout = "Change Password";
        $this->set(compact('email', 'verification_code','title_for_layout'));
		
		
    }
	
	
	function activate($email = null, $verification_code = null) 
	{
		$verfied = true;
	
        $this->layout = 'front';
        if ($email == null || $verification_code == null) {
            $this->Session->setFlash(__('Error_Message', true), 'admin_flash_bad');
            $this->redirect(array('controller' => 'home', 'action' => 'home'));
        }
        $email = base64_decode($email);

		if ($this->User->hasAny(array('User.email' => $email,'User.verification_code' => $verification_code,'OR'=>array('User.status' => 0)))) { 
			$user = $this->User->find('first',array('conditions'=>array('User.email'=>$email, 'User.verification_code'=>$verification_code)));			
			$this->User->id = $user['User']['id'];
			$update_data['User']['modified'] = date('Y-m-d H-i-s');
			$update_data['User']['status'] =  1;
			$verification_code = substr(md5(time()), 0, 20);
			$update_data['User']['verification_code'] =  $verification_code;
			$this->User->save($update_data);				
			$this->Session->write('Auth.User', $user['User']);
			$this->Session->setFlash(__('Congratulations! Your account has been activated.'), 'flash_success');
			$this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
			
        } else { 
			$this->Session->setFlash(__('Your account has been alreday activated.'), 'flash_error');
			$this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
	    }	
		
		$this->set("verfied",$verfied);
    }
	
	public function dashboard(){
		$this->layout = 'lay_dashboard';
		$id = $this->Auth->User('id');
		
		$this->User->bindModel(array('hasOne'=>array('UserDetail'=>array('fields' => array('id','bank_name','user_id','paypal_email','card_number','card_name','expire_month','expire_year','card_cvv','account_number','bank_address','account_name','account_address')))),false);
		
		$this->User->bindModel(array('hasOne'=>array('UserNotification'=>array('fields' => array('id','email_brodcast_start','email_brodcast_video','email_notification','push_notification','block_messages','archive_broadcast','friend_comment','disable_comment_post','delete_chat')))),false);
		
		
		$user_detail = $this->User->find('first', array('conditions' => array('User.id' => $id)));
		// pr($user_detail['UserNotification']);die;
		$this->request->data = $user_detail;
		$streaming_guide_pdf = Configure::read("STREAMING_GUIDE_PDF");
		$this->set('streaming_guide_pdf',$streaming_guide_pdf);
		$this->set('user_data',$user_detail);
		$this->set('title_for_layout','Dashboard');
	}
	public function cc_account_detail(){
	
	 	 if ($this->RequestHandler->isAjax()) {
			$this->autoRender = false;
			$this->layout = 'ajax';
		}  
		$this->loadModel('UserDetail');
		if ($this->request->data) 
		{			
			unset($this->request->data['UserDetail']['id']);
			$this->UserDetail->set($this->request->data);
			$this->UserDetail->setValidation('cc_detail');
			
			if($this->UserDetail->validates()) 
			{
				$user_id = $this->Session->read('Auth.User.id');
			
				$exist = $this->UserDetail->find('first',array('conditions'=>array('UserDetail.user_id'=>$user_id)));
				if(isset($exist) && !empty($exist)){				
					$this->request->data['UserDetail']['id'] = $exist['UserDetail']['id'];
				}
				$this->request->data['UserDetail']['user_id'] = $user_id;
				
				if($this->UserDetail->save($this->request->data)) {
					
					$this->Session->setFlash(__('Credit card detail saved successfully.'), 'flash_success');
					echo "<script>window.location.href = '".SITE_URL."users/dashboard'</script>";						
				}else{
					$this->Session->setFlash('Credit card info cannot be saved.Please try again', 'flash_error');
				}	
			}else{
			
			$this->Session->setFlash('Credit card info cannot be saved.Please try again', 'flash_popup_error');
			}
			
		}
		$this->set('user_data',$this->request->data);
		$this->render('/Elements/Front/User/cc_account_detail');
		 // $this->redirect(array('controller' => 'homes', 'action' => 'index'));

	}
	public function bank_account_detail(){
	
	 	 if ($this->RequestHandler->isAjax()) {
			$this->autoRender = false;
			$this->layout = 'ajax';
		}  
		$this->loadModel('UserDetail');
		if ($this->request->data) 
		{	
		
			unset($this->request->data['UserDetail']['id']);
			$this->UserDetail->set($this->request->data);
			$this->UserDetail->setValidation('bank_detail');
			
			if($this->UserDetail->validates()) 
			{	
				$user_id = $this->Session->read('Auth.User.id');
			
				$exist = $this->UserDetail->find('first',array('conditions'=>array('UserDetail.user_id'=>$user_id)));
				if(isset($exist) && !empty($exist)){				
					$this->request->data['UserDetail']['id'] = $exist['UserDetail']['id'];
				}
				$this->request->data['UserDetail']['user_id'] = $user_id;
				
				
				if($this->UserDetail->save($this->request->data)) {
					
					$this->Session->setFlash(__('Bank account detail saved successfully.'), 'flash_success');
					echo "<script>window.location.href = '".SITE_URL."users/dashboard'</script>";					
				}else{
					$this->Session->setFlash('Bank account cannot be saved.Please try again', 'flash_error');
				}	
			}else{			
				$this->Session->setFlash('Bank account cannot be saved.Please try again', 'flash_popup_error');
			}
			
		}
		$this->set('user_data',$this->request->data);
		$this->render('/Elements/Front/User/bank_account_detail');
	}
	
	public function image_delete(){
		$oldpic= $this->User->find("first",array("conditions"=>array("User.id"=>$this->Auth->User('id')),'fields'=>'User.profile_image'));
		$old_image	=	$oldpic['User']['profile_image'];
		if($old_image &&  file_exists(WWW_ROOT.PROFILE_IMAGE_FULL_DIR.DS.$old_image )) 
		{
			@unlink(WWW_ROOT.PROFILE_IMAGE_FULL_DIR.DS.$old_image);
		}

		$this->User->id	=	$this->Auth->User('id');
		$avataruploaded = $this->User->saveField('profile_image',NULL);
		$this->Session->setFlash("Your profile have been updated successfully.", 'flash_good');					
		$this->redirect($this->referer());				

	
	
	}
	
	
	
	
	
	public function dashboard_back(){		
		$this->layout = 'lay_dashboard';
		$id = $this->Session->read('Auth.User.id');
		$this->set('title_for_layout','Dashboard');
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
				} else {
				
					$this->Session->setFlash('Some error occur. Please, try again.', 'admin_flash_bad');
					 $this->redirect($this->referer());
				}
				
			}
        } else {			
			$this->request->data = $this->User->find('first',array('conditions'=>array('User.id'=>$id)));			
		}		
		
		
		$userData = parent::getUserData($this->Auth->user('id'));
		$this->set('userData',$userData);
		
		//Plan List
		$this->loadModel('Plan');
		$planList = $this->Plan->getPlanList();
		$this->set('planList',$planList);
	}
	
	public function profile_image_croping(){
	
		if ($this->RequestHandler->isAjax()) {
			$this->autoRender = false;
			$this->layout = 'ajax';
		} 
		
		$id = $this->Session->read('Auth.User.id');
		$existhin_user = $this->User->find('first',array('fields'=>array('id','profile_image'),'conditions'=>array('User.id'=>$id)));
		$imageName = $existhin_user['User']['profile_image'];
		$allowed	=	array('jpg','jpeg','png','gif','JPG','JPEG','PNG','GIF');
		$this->render('/Elements/Front/User/image_crop');
		
		if (isset($this->request->data) && !empty($this->request->data)) 
		{
			$targ_w = 356;			
			$targ_h = 200;
			$jpeg_quality = 1000;			
			$src = SITE_URL.'app/webroot/uploads/org_profile_image/'.$imageName;			
			
			$img_r = imagecreatefromjpeg($src);
			$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
			$crop_img = imagecopyresampled($dst_r,$img_r,0,0,$this->request->data['User']['X'],$this->request->data['User']['Y'],$targ_w,$targ_h,$this->request->data['User']['Width'],$this->request->data['User']['Height']);			
			$file = imagejpeg($dst_r,WWW_ROOT . PROFILE_IMAGE_FULL_DIR.DS.$imageName,$jpeg_quality);			
			die('dd');
		}		
	}

	
	
	public function userpicupload(){
	
		$_FILES['uploadfile']['name'] = $_FILES['data']['name']['User']['profile_image'];
		$_FILES['uploadfile']['type'] = $_FILES['data']['type']['User']['profile_image'];
		$_FILES['uploadfile']['tmp_name'] = $_FILES['data']['tmp_name']['User']['profile_image'];
		$_FILES['uploadfile']['error'] = $_FILES['data']['error']['User']['profile_image'];
		$_FILES['uploadfile']['size'] = $_FILES['data']['size']['User']['profile_image'];
		 
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
				$source = WWW_ROOT . PROFILE_IMAGE_FULL_DIR . DS.$imageName;
				$destination = WWW_ROOT . PROFILE_IMAGE_ORG_FULL_DIR . DS.$imageName;
				$result 	= 	$this->Upload->upload($files, WWW_ROOT . PROFILE_IMAGE_FULL_DIR . DS, $imageName,'',$allowed);
				copy($source, $destination);
				//$result1 	= 	$this->Upload->upload($files, WWW_ROOT . PROFILE_IMAGE_ORG_FULL_DIR . DS, $imageName,'',$allowed);
				
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
						@unlink(WWW_ROOT.PROFILE_IMAGE_ORG_FULL_DIR.DS.$old_image);
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
   
   public function channelpicupload(){
		$this->loadModel('Channel');
	    if(isset($_FILES['uploadfile']['name'])){
			$p_image = $_FILES['uploadfile'];			
			$oldpic= $this->Channel->find("first",array("conditions"=>array("Channel.user_id"=>$this->Auth->User('id'))));
			
			$old_image	=	$oldpic['Channel']['image'];
			$old_image_id	=	$oldpic['Channel']['id'];
		
			if (!empty($p_image) && $p_image['tmp_name'] != '' && $p_image['size'] > 0) {
				list($width, $height, $type, $attr) = getimagesize($p_image['tmp_name']);
				$allowed	=	array('jpg','jpeg','png','gif','JPG','JPEG','PNG','GIF');
				$temp 		= 	explode(".", $p_image["name"]);
				$extension 	= 	end($temp);
				$imageName 	= 	'profile_image_'.microtime(true).'.'.$extension;
				$files		=	$p_image;
				
				$result 	= 	$this->Upload->upload($files, WWW_ROOT . CHANNEL_IMAGE_FULL_DIR . DS, $imageName,'',$allowed);
				
				if($width<=150 || $height<=150)
				{
					echo "sizeError|"."Image size should be 150x150.";
					die;
				}
				if(!empty($this->Upload->result) && empty($this->Upload->errors)) 
				{					
					if($old_image &&  file_exists(WWW_ROOT.CHANNEL_IMAGE_FULL_DIR.DS.$old_image )) 
					{
						@unlink(WWW_ROOT.CHANNEL_IMAGE_FULL_DIR.DS.$old_image);
					}
					
					$this->request->data['Channel']['image'] = $imageName;
					$this->request->data['Channel']['user_id'] = $this->Auth->User('id');
					$this->request->data['Channel']['id'] = $old_image_id;
					
					$avataruploaded = $this->Channel->save($this->request->data);
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
	
	
	public function profileimage($userId = null){
		if(empty($userId)){
			$userId = $this->Auth->user('id'); 
		}
		$this->User->id = $userId; 
        if (!$this->User->exists()) {  throw new NotFoundException(__('Invalid User')); }
		$profile_data = $this->User->read(null, $this->User->id);
		
		if ($this->RequestHandler->isAjax()) {
			$this->autoRender = false;
			$this->layout = "ajax";
		}
		
		if(!empty($_FILES)){
			if($_FILES['user_image']['size'] <  6291456){
			
				$path_info = pathinfo($_FILES['user_image']['name']);
				/* $_FILES['user_image']['name'] = $path_info['filename']."_".time().".".$path_info['extension']; */
				$_FILES['user_image']['name'] = microtime(true) . "." . $path_info['extension'];
				
				$res3 = $this->Upload->upload($_FILES['user_image'], WWW_ROOT . USER_PROFILE_EXTRA_PICS . DS ."original". DS, '', '', array('png', 'jpg', 'jpeg', 'gif'));
				
				if (!empty($this->Upload->result)){	
					$old_image =  $profile_data['User']['profile_image'];
					if(!empty($old_profile_image)){
						@unlink(WWW_ROOT . USER_PROFILE_EXTRA_PICS . DS ."original". DS. $old_profile_image);
					}			
					$this->request->data['User']['id'] =  $profile_data['User']['id'];
					$this->request->data['User']['profile_image'] = $this->Upload->result;
					$this->User->saveAll($this->request->data);
				}
			}
		}
		$SiteUrl = Configure::read('App.SiteUrl');
		/* 
		if(@getimagesize('http://de7cm9ymbpban.cloudfront.net/'.'uploads/user/160X160/'.$this->request->data['User']['profile_image'])){
			$user_image = 'http://de7cm9ymbpban.cloudfront.net/'.'uploads/user/160X160/'.$this->request->data['User']['profile_image'];
		}else{
			$user_image =  $SiteUrl.'/medias/no_image/160/160';
		}
		
		echo $user_image; */
		echo'done';
   	
        exit(); 
	}
	public function fbSessionData(){ 
	
		$data = $this->User->find('first',array('conditions'=>array('User.fb_id'=>$_POST['id'])));
		
		/* if(isset($data['User']['account_type']) && $data['User']['account_type'] == '0'){	
			$this->Session->setFlash(__('Your account has been disabled.Please contact to administrator'), 'flash_info');			
			echo "0";die;
		} */ 
		// pr($_POST['picture']);die;
		if(isset($_POST['picture']) && !empty($_POST['picture'])){		
			$fid = $_POST['id'];
			$image = file_get_contents('https://graph.facebook.com/'.$fid.'/picture?type=large');
			$dir = WWW_ROOT . PROFILE_IMAGE_FULL_DIR . DS.$fid.'.jpg';
			file_put_contents($dir,$image);			
			$fb_image = $fid.'.jpg';
		}else{
			$fb_image = "";
		} 
		
		
		if(empty($data))
		{		
			if(isset($_POST['email']) && !empty($_POST['email'])){
			
			
			$all_ready_register_email = $this->User->find('first',array('conditions'=>array('User.email'=>$_POST['email'])));
			if(isset($all_ready_register_email) && !empty($all_ready_register_email)){
				if(empty($all_ready_register_email['User']['profile_image'])){				
					$fb_data['User']['profile_image'] = (isset($fb_image))? $fb_image:"";
				}
				$fb_data['User']['id'] = $all_ready_register_email['User']['id'];
				$fb_data['User']['fb_id'] = (isset($_POST['id']))? $_POST['id']:"";
				$fb_data['User']['facebook_verified_status'] = 1;
				$this->User->save($fb_data);
				$user_id = $this->User->id;
				$user_data = $this->User->find('first',array('conditions'=>array('User.id'=>$user_id)));

				$this->Session->write('Auth.User', $user_data['User']);	
				$this->Auth->_loggedIn = true;	
				$this->Session->setFlash(__('Login Successfully.'), 'flash_success');	
				$this->redirect(array('controller'=>'users', 'action'=>'dashboard'));
			
			}else{
			
			$fb_data = array();
			$fb_data['User']['email'] = (isset($_POST['email']))? $_POST['email']:"";
			$fb_data['User']['fb_id'] = (isset($_POST['id']))? $_POST['id']:"";
			$fb_data['User']['nickname'] = (isset($_POST['first_name']))? $_POST['first_name']:"";
			$fb_data['User']['first_name'] = (isset($_POST['first_name']))? $_POST['first_name']:"";
			$fb_data['User']['last_name'] = (isset($_POST['last_name']))? $_POST['last_name']:"";
			$fb_data['User']['profile_image'] = (isset($fb_image))? $fb_image:"";
			$fb_data['User']['facebook_verified_status'] = 1;			
			
			$this->User->save($fb_data);
			$user_id = $this->User->id;
			$user_data = $this->User->find('first',array('conditions'=>array('User.id'=>$user_id)));
			
			$this->Session->write('Auth.User', $user_data['User']);	
			$this->Auth->_loggedIn = true;	
			$this->Session->setFlash(__('Login Successfully.'), 'flash_success');	
			$this->redirect(array('controller'=>'users', 'action'=>'dashboard'));
			
			}
			
			
			
			}else{
			
			
			$fb_data = array();
			// $fb_data['User']['email'] = (isset($_POST['email']))? $_POST['email']:"";
			$fb_data['User']['fb_id'] = (isset($_POST['id']))? $_POST['id']:"";
			$fb_data['User']['nickname'] = (isset($_POST['first_name']))? $_POST['first_name']:"";
			$fb_data['User']['first_name'] = (isset($_POST['first_name']))? $_POST['first_name']:"";
			$fb_data['User']['last_name'] = (isset($_POST['last_name']))? $_POST['last_name']:"";
			$fb_data['User']['profile_image'] = (isset($fb_image))? $fb_image:"";
			$fb_data['User']['facebook_verified_status'] = 1;			
			
			$this->User->save($fb_data);
			$user_id = $this->User->id;
			$user_data = $this->User->find('first',array('conditions'=>array('User.id'=>$user_id)));
			
			$this->Session->write('Auth.User', $user_data['User']);	
			$this->Auth->_loggedIn = true;	
			$this->Session->setFlash(__('Login Successfully.'), 'flash_success');	
			$this->redirect(array('controller'=>'users', 'action'=>'dashboard'));
			
			}
		
		
			
		}else{
		
			if(isset($data['User']['fb_id']) && !empty($data['User']['fb_id'])){
				$fb_data = array();
				$fb_data['User']['id'] = $data['User']['id'];
				if(empty($data['User']['profile_image'])){				
					$fb_data['User']['profile_image'] = (isset($fb_image))? $fb_image:"";
				}
				
				$fb_data['User']['facebook_verified_status'] = 1;
				$fb_data['User']['account_type'] = 1;
				$this->User->save($fb_data);		
				$this->Session->write('Auth.User', $data['User']);
				$this->Session->setFlash('Login Successfully.', 'flash_success');
				$this->Auth->_loggedIn = true;	 	
				echo "1";die;
			
			}else{

				$fb_data = array();
				$fb_data['User']['id'] = $data['User']['id'];
				
				if(empty($data['User']['profile_image'])){				
					$fb_data['User']['profile_image'] = (isset($fb_image))? $fb_image:"";
				}
				$fb_data['User']['fb_id'] = (isset($_POST['id']))? $_POST['id']:"";				
				$fb_data['User']['facebook_verified_status'] = 1;				
				$this->User->save($fb_data);		
				$this->Session->write('Auth.User', $fb_data['User']);			
				$this->Session->setFlash('Login Successfully.', 'flash_success');	
				$this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
			
			}
		
		}
	}
	
	
	public function fbSessionData_old(){ 
	
		$data = $this->User->find('first',array('conditions'=>array('User.fb_id'=>$_POST['id'])));
		
		/* if(isset($data['User']['account_type']) && $data['User']['account_type'] == '0'){	
			$this->Session->setFlash(__('Your account has been disabled.Please contact to administrator'), 'flash_info');			
			echo "0";die;
		} */ 
		$fid = $_POST['id'];
		$image = file_get_contents('https://graph.facebook.com/'.$fid.'/picture?type=large');
		$dir = WWW_ROOT . PROFILE_IMAGE_FULL_DIR . DS.$fid.'.jpg';
		file_put_contents($dir,$image);
		
		$fb_image = $fid.'.jpg';
		
		if(empty($data))
		{		
			$all_ready_register_email = $this->User->find('first',array('conditions'=>array('User.email'=>$_POST['email'])));
			if(isset($all_ready_register_email) && !empty($all_ready_register_email)){
				if(empty($all_ready_register_email['User']['profile_image'])){				
					$fb_data['User']['profile_image'] = (isset($fb_image))? $fb_image:"";
				}
				$fb_data['User']['id'] = $all_ready_register_email['User']['id'];
				$fb_data['User']['fb_id'] = (isset($_POST['id']))? $_POST['id']:"";
				$fb_data['User']['facebook_verified_status'] = 1;
				$this->User->save($fb_data);
				$user_id = $this->User->id;
				$user_data = $this->User->find('first',array('conditions'=>array('User.id'=>$user_id)));

				$this->Session->write('Auth.User', $user_data['User']);	
				$this->Auth->_loggedIn = true;	
				$this->Session->setFlash(__('Login Successfully.'), 'flash_success');	
				$this->redirect(array('controller'=>'users', 'action'=>'dashboard'));
			
			}else{
			
			$fb_data = array();
			$fb_data['User']['email'] = (isset($_POST['email']))? $_POST['email']:"";
			$fb_data['User']['fb_id'] = (isset($_POST['id']))? $_POST['id']:"";
			$fb_data['User']['nickname'] = (isset($_POST['first_name']))? $_POST['first_name']:"";
			$fb_data['User']['first_name'] = (isset($_POST['first_name']))? $_POST['first_name']:"";
			$fb_data['User']['last_name'] = (isset($_POST['last_name']))? $_POST['last_name']:"";
			$fb_data['User']['profile_image'] = (isset($fb_image))? $fb_image:"";
			$fb_data['User']['facebook_verified_status'] = 1;			
			
			$this->User->save($fb_data);
			$user_id = $this->User->id;
			$user_data = $this->User->find('first',array('conditions'=>array('User.id'=>$user_id)));
			
			$this->Session->write('Auth.User', $user_data['User']);	
			$this->Auth->_loggedIn = true;	
			$this->Session->setFlash(__('Login Successfully.'), 'flash_success');	
			$this->redirect(array('controller'=>'users', 'action'=>'dashboard'));
			
			}
		}else{
		
			if(isset($data['User']['fb_id']) && !empty($data['User']['fb_id'])){
				$fb_data = array();
				$fb_data['User']['id'] = $data['User']['id'];
				if(empty($data['User']['profile_image'])){				
					$fb_data['User']['profile_image'] = (isset($fb_image))? $fb_image:"";
				}
				
				$fb_data['User']['facebook_verified_status'] = 1;
				$fb_data['User']['account_type'] = 1;
				$this->User->save($fb_data);		
				$this->Session->write('Auth.User', $data['User']);
				$this->Session->setFlash('Login Successfully.', 'flash_success');
				$this->Auth->_loggedIn = true;	 	
				echo "1";die;
			
			}else{

				$fb_data = array();
				$fb_data['User']['id'] = $data['User']['id'];
				
				if(empty($data['User']['profile_image'])){				
					$fb_data['User']['profile_image'] = (isset($fb_image))? $fb_image:"";
				}
				$fb_data['User']['fb_id'] = (isset($_POST['id']))? $_POST['id']:"";				
				$fb_data['User']['facebook_verified_status'] = 1;				
				$this->User->save($fb_data);		
				$this->Session->write('Auth.User', $fb_data['User']);			
				$this->Session->setFlash('Login Successfully.', 'flash_success');	
				$this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
			
			}
		
		}
	}
	
	public function fbVerificationData(){
	
		$this->autoRender = false;
		$this->layout = false;
		
		$userId = $this->Auth->user('id'); 
		$this->User->id = $userId; 
        if (!$this->User->exists()) {
	
			throw new NotFoundException(__('Invalid User'));
		}
		if(!empty($_POST))
		{
			$this->request->data['User']['fb_id']= $_POST['id'];
			$this->request->data['User']['facebook_verified_status']= 1;
			if($this->User->save($this->request->data))
			{
				$this->Session->setFlash(__('Your facebook account verified successfully.'), 'flash_success');	
				echo "1";die;
			}
			else
			{
				$this->Session->setFlash('Your facebook account not verified.Please try again', 'flash_error');
				echo "0";die;
			}
		}
		else
		{
			$this->Session->setFlash('Account not verified.Please try again', 'flash_error');
			echo "0";die;
		}
		
	}
	
	
	
	function tlogin(){ 
		$this->Session->write('Twitter.referer', $this->referer());
		
		$this->layout = false;
		App::import('Vendor', 'twitter', array('file' => 'twitter'.DS.'twitteroauth.php'));

		$twitteroauth = new TwitterOAuth(Configure::read('TWITTER_CONSUMER_KEY'), Configure::read('TWITTER_CONSUMER_SECRET_KEY'));
		// Requesting authentication tokens, the parameter is the URL we will be redirected to
		$request_token = $twitteroauth->getRequestToken(TWITTER_RETURN_URL);
		
		// Saving them into the session
		$this->Session->write('oauth_token',$request_token['oauth_token']);
		$this->Session->write('oauth_token_secret', $request_token['oauth_token_secret']);
		// If everything goes well..
		if ($twitteroauth->http_code == 200) {
		// Let's generate the URL and redirect
		$url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']);
			//header('Location: ' . $url);
			$this->redirect($url);
		}else{
		// It's a bad idea to kill the script, but we've got to know when there's an error.
		die('Something wrong happened.');
		}
	}
	
	
	
	function getTwitterData()
	{  
			App::import('Vendor', 'twitter', array('file' => 'twitter'.DS.'twitteroauth.php'));
			if (!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])) {
			// We've got everything we need]
			// echo $_SESSION['oauth_token']."      ".$_SESSION['oauth_token_secret']; 
			$twitteroauth = new TwitterOAuth(Configure::read('TWITTER_CONSUMER_KEY'), Configure::read('TWITTER_CONSUMER_SECRET_KEY'), $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
			
		// Let's request the access token
			$access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']);
			// Save it in a session var
			$_SESSION['access_token'] = $access_token;
			// Let's get the user's info
			$user_info = $twitteroauth->get('account/verify_credentials');
			
			$size = '';	
			if(isset($user_info->profile_image_url) && !empty($user_info->profile_image_url)){
			
			$url = $user_info->profile_image_url;
			$proimg =  str_replace('_normal', $size, $url);
			
			$twitter_id = $user_info->id;
			$image = file_get_contents($proimg);
			$dir = WWW_ROOT . PROFILE_IMAGE_FULL_DIR . DS.$twitter_id.'.jpg';
			file_put_contents($dir,$image);
			$twitter_image = $twitter_id.'.jpg';
			
			}else{
			
			$twitter_image = "";
			}	
			
			
			$this->Session->write('TwitterUser', $user_info);
			
			if($this->Session->check('Auth.User.id'))
			{
				$userId = $this->Auth->user('id');
				$this->User->id = $userId; 
				$this->request->data['User']['twitter_id']= $user_info->id;
				$this->request->data['User']['twitter_verified_status']= 1;
				$this->request->data['User']['account_type']= 1;
				$this->request->data['User']['status']= 1;				
				if($this->User->save($this->request->data))
				{
					$this->Session->setFlash(__('Your twitter account verified successfully.'), 'flash_success');	
					$this->redirect(array('controller'=>'users', 'action'=>'dashboard'));
				}
				else
				{
					$this->Session->setFlash('Your twitter account not verified.Please try again', 'flash_error');
					$this->redirect(array('controller'=>'users', 'action'=>'dashboard'));
				}
			}
			else
			{
				$data = $this->User->find('first',array('conditions'=>array('User.twitter_id'=>$user_info->id)));
				
				/* if(isset($data['User']['account_type']) && $data['User']['account_type'] == '0'){

					$this->Session->setFlash(__('Your account has been disabled.Please contact to administrator'), 'flash_info');	
					$this->redirect(array('controller' => 'homes', 'action' => 'index'));

				} */
				
				if(!empty($data['User']))
				{
				
					if(empty($data['User']['profile_image'])){				
						$userData['User']['profile_image'] = (isset($twitter_image))? $twitter_image:"";
						$userData['User']['id'] = $data['User']['id'];						
						$this->User->save($userData);
					}
					$this->Session->write('Auth.User',$data['User']);	
					$this->Auth->_loggedIn = true;	
					$this->Session->setFlash(__('Login Successfully.'), 'flash_success');	
					$this->redirect(array('controller'=>'users', 'action'=>'dashboard'));
				}else{
					$userData = array();
					if(empty($data['User']['profile_image'])){				
						$userData['User']['profile_image'] = (isset($twitter_image))? $twitter_image:"";
					}
					$userData['User']['twitter_id'] = $user_info->id;			
					$userData['User']['role_id'] = $user_info->id;
					$userData['User']['first_name'] = $user_info->name;
					$userData['User']['nickname'] = $user_info->screen_name;
					$userData['User']['twitter_verified_status'] = 1;
					$userData['User']['modified'] = date('Y-m-d H:i:s');
					$this->User->save($userData);
					
					$user_id = $this->User->id;
					$user_data = $this->User->find('first',array('conditions'=>array('User.id'=>$user_id)));
					$this->Session->write('Auth.User',$user_data['User']);	
					$this->Auth->_loggedIn = true;	
					$this->Session->setFlash(__('Login Successfully.'), 'flash_success');	
					$this->redirect(array('controller'=>'users', 'action'=>'dashboard'));				
				}
			}
		}else{
		  $this->redirect(array('controller'=>'users', 'action'=>'tlogin'));
		}
	}
	
	
	
	
	
	
	
	function twitter_verification(){ 
		$this->Session->write('Twitter.referer', $this->referer());
		
		$this->layout = false;
		App::import('Vendor', 'twitter', array('file' => 'twitter'.DS.'twitteroauth.php'));

		$twitteroauth = new TwitterOAuth(Configure::read('TWITTER_CONSUMER_KEY'), Configure::read('TWITTER_CONSUMER_SECRET_KEY'));
		// Requesting authentication tokens, the parameter is the URL we will be redirected to
		$request_token = $twitteroauth->getRequestToken(TWITTER_RETURN_URL);
		
		// Saving them into the session
		$this->Session->write('oauth_token',$request_token['oauth_token']);
		$this->Session->write('oauth_token_secret', $request_token['oauth_token_secret']);
		// If everything goes well..
		if ($twitteroauth->http_code == 200) {
		// Let's generate the URL and redirect
		$url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']);
			//header('Location: ' . $url);
			$this->redirect($url);
		}else{
		// It's a bad idea to kill the script, but we've got to know when there's an error.
		die('Something wrong happened.');
		}
	}
	
	
	
	function getTwitterVrifiData()
	{  
			App::import('Vendor', 'twitter', array('file' => 'twitter'.DS.'twitteroauth.php'));
			if (!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])) {
			// We've got everything we need]
			// echo $_SESSION['oauth_token']."      ".$_SESSION['oauth_token_secret']; 
			$twitteroauth = new TwitterOAuth(Configure::read('TWITTER_CONSUMER_KEY'), Configure::read('TWITTER_CONSUMER_SECRET_KEY'), $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
			
		// Let's request the access token
			$access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']);
			// Save it in a session var
			$_SESSION['access_token'] = $access_token;
			// Let's get the user's info
			$user_info = $twitteroauth->get('account/verify_credentials');
			pr($user_info);die;
			$this->Session->write('TwitterUser', $user_info);
			$data = $this->User->find('first',array('conditions'=>array('User.twitter_id'=>$user_info->id)));		
			if(!empty($data['User']))
			{
				$this->Session->write('Auth.User',$data['User']);	
				$this->Auth->_loggedIn = true;	
				$this->Session->setFlash(__('Account already verified.Please verify with another acount.'), 'flash_success');	
				$this->redirect(array('controller'=>'users', 'action'=>'dashboard'));
			}else{
				$userData = array();
				$userData['User']['twitter_id'] = $user_info->id;			
				$userData['User']['role_id'] = $user_info->id;
				$userData['User']['first_name'] = $user_info->name;
				$userData['User']['nickname'] = $user_info->screen_name;
				$userData['User']['modified'] = date('Y-m-d H:i:s');
				$this->User->save($userData);
				
				$user_id = $this->User->id;
				$user_data = $this->User->find('first',array('conditions'=>array('User.id'=>$user_id)));
				$this->Session->write('Auth.User',$user_data['User']);	
				$this->Auth->_loggedIn = true;	
				$this->Session->setFlash(__('Twitter verified successfully.'), 'flash_success');	
				$this->redirect(array('controller'=>'users', 'action'=>'dashboard'));				
			}
		}else{
		  $this->redirect(array('controller'=>'users', 'action'=>'tlogin'));
		}
	}

	
	
	public function user_messages()
	{
		$this->layout = "dashboard";
		$this->set('title_for_layout','Messages');
		
	}
	
	public function notification(){
		if ($this->RequestHandler->isAjax()) {
			$this->autoRender = false;
			$this->layout = 'ajax';
		}  
		$this->loadModel('UserNotification');

		$user_id = $this->Session->read('Auth.User.id');

		$exist = $this->UserNotification->find('first',array('conditions'=>array('UserNotification.user_id'=>$user_id)));
		if(isset($exist) && !empty($exist)){				
			$this->request->data['UserNotification']['id'] = $exist['UserNotification']['id'];
		}	
		if ($this->request->is('post')) 
		{	
			if($this->request->data['checked_val'] == "unchecked"){
				$value = 0;
			}else{
				$value = 1;
			}
			$this->request->data['UserNotification'][$this->request->data['name_val']] = $value; 
			$this->request->data['UserNotification']['user_id'] = $user_id;
			$this->UserNotification->save($this->request->data); 

		}
	}
	
	function messages(){
		$this->layout = "lay_dashboard";
		$this->set('title_for_layout','Messages');
	
	}
	
	function statistics(){
		$this->layout = "lay_dashboard";
		$this->set('title_for_layout','Statistics');
	
	}
	function verfied_account($type = null,$verfied_status = null){
		if($verfied_status == "1"){
			$verfied = '0';
		}else{
			$verfied = '1';
		}
		$user_id = $this->Session->read('Auth.User.id');
		$data = $this->User->find('first',array('conditions'=>array('User.id'=>$user_id)));
		$this->request->data['User']['id'] = $data['User']['id']; 
		
		if($type == 'linkedin' && !empty($data['User']['linkedin_id'])){
			
			$this->request->data['User']['linkedin_verifi'] = $verfied;
			$this->User->save($this->request->data);
			$this->Session->setFlash(__('Linkdin verified status change successfully.'), 'flash_success');	
			$this->redirect(array('controller'=>'users', 'action'=>'dashboard'));
		}elseif($type == 'linkedin' && empty($data['User']['linkedin_id'])){
			$this->Session->setFlash(__('Linkdin verified status not change.'), 'flash_error');	
			$this->redirect(array('controller'=>'users', 'action'=>'dashboard'));
		}
		
		if($type == 'facebook' && !empty($data['User']['facebook_id'])){
			$this->request->data['User']['facebook_verifi'] = $verfied;
			$this->User->save($this->request->data);
			$this->Session->setFlash(__('Facebook verified status change successfully.'), 'flash_success');	
			$this->redirect(array('controller'=>'users', 'action'=>'dashboard'));
		}elseif($type == "facebook" && empty($data['User']['facebook_id'])){
			$this->Session->setFlash(__('Facebook verified status not change.'), 'flash_error');	
			$this->redirect(array('controller'=>'users', 'action'=>'dashboard'));
		}
		
		if($type == 'twitter' && !empty($data['User']['twitter_id'])){
			$this->request->data['User']['twitter_verifi'] = $verfied;
			$this->User->save($this->request->data);
			$this->Session->setFlash(__('Twitter verified status change successfully.'), 'flash_success');	
			$this->redirect(array('controller'=>'users', 'action'=>'dashboard'));
		}elseif($type == 'twitter' && empty($data['User']['twitter_id'])){
			$this->Session->setFlash(__('Twitter verified status not change.'), 'flash_error');	
			$this->redirect(array('controller'=>'users', 'action'=>'dashboard'));
		}
		
	
	}
	public function account_disable(){

		$user_id = $this->Session->read('Auth.User.id');
		$data = $this->User->find('first',array('conditions'=>array('User.id'=>$user_id)));
		$this->request->data['User']['id'] = $data['User']['id']; 
		$this->request->data['User']['account_type'] = '0';
		$this->User->save($this->request->data);

		$this->Session->delete('Auth.User');
		$this->Session->destroy();
		$this->Session->setFlash(__('Your account has been disabled. Please contact administrator. Thank you.'), 'flash_info');	
		$this->redirect(array('controller' => 'homes', 'action' => 'index'));
			
		


	
	}
	public function admin_ajax_user_sorting() { 
        if ($this->request->data['sort'] && is_array($this->request->data['sort'])) {
            foreach ($this->request->data['sort'] as $key => $value) {
              	
				$this->request->data['User']['id'] = $value;
				$this->request->data['User']['sorting'] = $key;			
				$this->User->save($this->request->data);		
				
            }
        }
        die(json_encode(array("status" => "success")));
    }
	
	
	
	public function test_email()
	{

		//$this->request->data['User']['email'] = "khemit.verma25@gmail.com";
		//$this->request->data['User']['email'] = "kamalsinghjadoun@yahoo.in";
		$this->request->data['User']['email'] = "er.manish.developer@outlook.com";
		$first_name = "khemit";
		$password = "123456";
		$verification_code = substr(md5(uniqid()), 0, 20);
		$this->request->data['User']['verification_code'] = $verification_code;
		
		$email = $this->request->data['User']['email'];
		$check_registration_status = true;
		$this->loadModel('EmailTemplate');
		/* start send email confirmation link to user */
		$UserRegistration = $this->EmailTemplate->find('first', array('conditions' => array('EmailTemplate.slug' => 'user_registration')));
		
		$subject = $UserRegistration['EmailTemplate']['subject'];							
		$activationCode = '123456';						
		$activation_url = Router::url(array( 'controller' => 'users', 'action' => 'activate', base64_encode($email), $verification_code, ), true);			
		//$activation_link = '<a href="'.$activation_url.'">'.$activation_url.'</a>';
		$activation_link	=' <a href="'.$activation_url.'" target="_blank" shape="rect">Activation Link</a>';
		//$activation_link	= $activation_url;
		
		
		$get_mail_template = parent::get_mail_template();
		$get_mail_template = str_replace('{TEMPLATE}',$UserRegistration['EmailTemplate']['description'],$get_mail_template);
		
		
		$mail_message = str_replace(array('{name}','{email}','{activation_link}','{password}'), array($first_name,$email,$activation_link,$password), $get_mail_template);
		
		$to = $this->request->data["User"]["email"];
		$from = 'business@yoohcan.com';
			$template= 'default';
		
			$ajax_email = "true";
			$email_status = "flash_good";
			$message = "An verification email has been sent over to your email address. Please click over the verification link.";
		// pr($mail_message);die;
		
		//if (parent::__sendMail($to, $subject, $mail_message, $from, $template)){
		parent::send_grid_mail($from,$to,$subject,$mail_message);
		die("1");
	}
	
}
