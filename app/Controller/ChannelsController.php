<?php
/**
 * channel content controller.
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
 * channel content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */

App::uses('Sanitize', 'Utility');
class ChannelsController extends AppController {



/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Channels';

/**
 * This controller use a model admins
 *
 * @var array
 */
	public $uses 		= array('Channel');
	
	public $helpers 	= array('Html', 'Session','General','Csv');
	var $components = 	array('General',"Upload");
	
	
	public function beforeFilter() {
	
        parent::beforeFilter();
        $this->loadModel('Channel');
		$this->Auth->allow('index','channel_detail','update_channel_play_count','paypal_notify','donation','paypal_cancel','paypal_return','live_channels');
		$streaming_guide_pdf = Configure::read("STREAMING_GUIDE_PDF");
		$this->set('streaming_guide_pdf',$streaming_guide_pdf);
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
           if (isset($this->request->data['Channel']['name']) && $this->request->data['Channel']['name'] != '') {
                $name = trim($this->request->data['Channel']['name']);
                $this->Session->write('AdminSearch.name', $name);
            }
			
           if (isset($this->request->data['Channel']['company']) && $this->request->data['Channel']['company'] != '') {
                $company = trim($this->request->data['Channel']['company']);
                $this->Session->write('AdminSearch.company', $company);
            }
			
           if (isset($this->request->data['Channel']['website']) && $this->request->data['Channel']['website'] != '') {
                $website = trim($this->request->data['Channel']['website']);
                $this->Session->write('AdminSearch.website', $website);
            }
			
		}
		
		if ($this->Session->check('AdminSearch')) {
            $keywords 	= 	$this->Session->read('AdminSearch');
			foreach($keywords as $key=>$values){
				if($key == 'name'){
					$filters[] = array('Channel.'.$key.' LIKE'=>"%".$values."%");					
				}
				if($key == 'company'){
					$filters[] = array('Channel.'.$key.' LIKE'=>"%".$values."%");				
				}
				if($key == 'website'){
					$filters[] = array('Channel.'.$key.' LIKE'=>"%".$values."%");				
				}
				
				
			}
		}
		$this->loadModel('Channel');		
		$this->paginate = array('Channel' => array(
			'limit' =>Configure::read('App.PageLimit'),
			'order' => array('Channel.sorting' => 'ASC'),
			'conditions' => $filters,
        ));
		$data = $this->paginate('Channel');		
		$this->set(compact('data'));
		$this->set('title_for_layout', __('Channel', true));
		
	}
	
	
	
	public function admin_video_index() {
		
		
		if (!isset($this->params['named']['page'])) {
            $this->Session->delete('AdminSearch');
        }
		$this->loadModel('RecordingStream');
		$filters	=	array();
        if (!empty($this->request->data)) {
			$this->Session->delete('AdminSearch');
           if (isset($this->request->data['RecordingStream']['title']) && $this->request->data['RecordingStream']['title'] != '') {
                $title = trim($this->request->data['RecordingStream']['title']);
                $this->Session->write('AdminSearch.title', $title);
            }
			
           if (isset($this->request->data['RecordingStream']['description']) && $this->request->data['RecordingStream']['description'] != '') {
                $description = trim($this->request->data['RecordingStream']['description']);
                $this->Session->write('AdminSearch.description', $description);
            }
			
           if (isset($this->request->data['Channel']['name']) && $this->request->data['Channel']['name'] != '') {
                $name = trim($this->request->data['Channel']['name']);
                $this->Session->write('AdminSearch.name', $name);
            }
			
		}
		
		if ($this->Session->check('AdminSearch')) {
            $keywords 	= 	$this->Session->read('AdminSearch');
			foreach($keywords as $key=>$values){
				if($key == 'title'){
					$filters[] = array('RecordingStream.'.$key.' LIKE'=>"%".$values."%");					
				}
				if($key == 'description'){
					$filters[] = array('RecordingStream.'.$key.' LIKE'=>"%".$values."%");				
				}
				if($key == 'name'){
					$filters[] = array('Channel.'.$key.' LIKE'=>"%".$values."%");				
				}
				
				
			}
		}
		
		
		
		$this->RecordingStream->bindModel(array(
			'belongsTo'=>array(
				'User'=>array(
					'className'=>'User',
					'foreignKey'=>'user_id',
					'fields'=>array('id','first_name','profile_image')	
				),
				'Channel'=>array(
					'className'=>'Channel',
					'foreignKey'=>'channel_id',
					'fields'=>array('id','name','image')	
				)
			)			
		),false);
		
		
		$this->loadModel('RecordingStream');		
		$this->paginate = array('RecordingStream' => array(
			'limit' =>Configure::read('App.PageLimit'),
			'order' => array('RecordingStream.sorting' => 'ASC'),
			'conditions' => $filters,
        ));
		$data = $this->paginate('RecordingStream');
		//pr($data);die;
		$this->set(compact('data'));
		$this->set('title_for_layout', __('Recorded Stream Listing', true));
		
	}
	public function admin_slider_index() {
		
		
		if (!isset($this->params['named']['page'])) {
            $this->Session->delete('AdminSearch');
        }
		$this->loadModel('RecordingStream');
		$filters	=	array();
        if (!empty($this->request->data)) {
			$this->Session->delete('AdminSearch');
           if (isset($this->request->data['RecordingStream']['title']) && $this->request->data['RecordingStream']['title'] != '') {
                $title = trim($this->request->data['RecordingStream']['title']);
                $this->Session->write('AdminSearch.title', $title);
            }
			
           if (isset($this->request->data['RecordingStream']['description']) && $this->request->data['RecordingStream']['description'] != '') {
                $description = trim($this->request->data['RecordingStream']['description']);
                $this->Session->write('AdminSearch.description', $description);
            }
			
           if (isset($this->request->data['Channel']['name']) && $this->request->data['Channel']['name'] != '') {
                $name = trim($this->request->data['Channel']['name']);
                $this->Session->write('AdminSearch.name', $name);
            }
			
		}
		
		if ($this->Session->check('AdminSearch')) {
            $keywords 	= 	$this->Session->read('AdminSearch');
			foreach($keywords as $key=>$values){
				if($key == 'title'){
					$filters[] = array('RecordingStream.'.$key.' LIKE'=>"%".$values."%");					
				}
				if($key == 'description'){
					$filters[] = array('RecordingStream.'.$key.' LIKE'=>"%".$values."%");				
				}
				if($key == 'name'){
					$filters[] = array('Channel.'.$key.' LIKE'=>"%".$values."%");				
				}
				
				
			}
		}
		
		$filters[] = array('RecordingStream.is_home'=>1);		
		
		
		$this->RecordingStream->bindModel(array(
			'belongsTo'=>array(
				'User'=>array(
					'className'=>'User',
					'foreignKey'=>'user_id',
					'fields'=>array('id','first_name','profile_image')	
				),
				'Channel'=>array(
					'className'=>'Channel',
					'foreignKey'=>'channel_id',
					'fields'=>array('id','name','image')	
				)
			)			
		),false);
		
		$this->loadModel('RecordingStream');		
		$this->paginate = array('RecordingStream' => array(
			'limit' =>Configure::read('App.PageLimit'),
			'order' => array('RecordingStream.sorting' => 'ASC'),
			'conditions' => $filters,
        ));
		$data = $this->paginate('RecordingStream');		
		$this->set(compact('data'));
		$this->set('title_for_layout', __('Home Slider Listing', true));
		
	}
	
	
	public function admin_edit($id = null){
	
		$this->set('title_for_layout','Edit Recorded Stream');
		
		$this->loadModel('RecordingStream');
		$this->RecordingStream->id 	= 	$id;
		
		/*check conditions all ready conditions for users update*/
        if (!$this->RecordingStream->exists()) {
            throw new NotFoundException(__('Invalid Recording Stream'));
        }
		/*form post and check conditions*/
		if ($this->request->is('post') || $this->request->is('put')) {
			
			if (!empty($this->request->data)) {
				
				if (!isset($this->request->params['_Token']['key']) || ($this->request->params['_Token']['key'] != $this->request->params['_Token']['key'])) {
					$blackHoleCallback = $this->Security->blackHoleCallback;
					$this->$blackHoleCallback();
				}
				//validate user data
				$this->RecordingStream->set($this->request->data['RecordingStream']);
				$this->RecordingStream->setValidation('edit');
				if ($this->RecordingStream->validates()) {
					$this->RecordingStream->create();					
				if ($this->RecordingStream->save($this->request->data['RecordingStream'],false)) {					
					$recording_stream_id	=	$id;					
					$p_image	=	$this->request->data['RecordingStream']['recording_stream_image'];
					$old_image	=	$this->request->data['RecordingStream']['image'];
										
					if (!empty($p_image) && $p_image['tmp_name'] != '' && $p_image['size'] > 0) {
			
						$allowed	=	array('jpg','jpeg','png');
						$temp 		= 	explode(".", $p_image["name"]);
						$extension 	= 	end($temp);
						$imageName 	= 	'recording_stream_image_'.microtime(true).'.'.$extension;
						$files		=	$p_image;
						
						$result 	= 	$this->Upload->upload($files, WWW_ROOT . RECORDING_IMAGE_FULL_DIR . DS, $imageName,'',$allowed);
						
						if(!empty($this->Upload->result) && empty($this->Upload->errors)) {
							
							if($old_image &&  file_exists(WWW_ROOT.RECORDING_IMAGE_FULL_DIR.DS.$old_image )) {
								@unlink(WWW_ROOT.RECORDING_IMAGE_FULL_DIR.DS.$old_image);
							}
							
							$this->RecordingStream->id	=	$recording_stream_id;
							$this->RecordingStream->saveField('image',$imageName,false);
						}
						
					}
					
					$this->Session->setFlash("Record has been added successfully", 'admin_flash_good');
					$this->redirect(array('controller'=>'channels', 'action'=>'video_index'));
			
				} 
			} else {
					 $this->Session->setFlash(__('The record could not be saved. Please, try again.', true), 'admin_flash_bad');
                }
			}
        } else {
			$this->request->data = $this->RecordingStream->read(null, $id);		
			
		}
	}
	
	public function admin_slider_edit($id = null){
	
		$this->set('title_for_layout','Edit Slider');		
		$this->loadModel('RecordingStream');
		$this->RecordingStream->id 	= 	$id;
		
		/*check conditions all ready conditions for users update*/
        if (!$this->RecordingStream->exists()) {
            throw new NotFoundException(__('Invalid Recording Stream'));
        }
		/*form post and check conditions*/
		if ($this->request->is('post') || $this->request->is('put')) {
			
			if (!empty($this->request->data)) {
				
				if (!isset($this->request->params['_Token']['key']) || ($this->request->params['_Token']['key'] != $this->request->params['_Token']['key'])) {
					$blackHoleCallback = $this->Security->blackHoleCallback;
					$this->$blackHoleCallback();
				}
				//validate user data
				$this->RecordingStream->set($this->request->data['RecordingStream']);
				$this->RecordingStream->setValidation('edit');
				if ($this->RecordingStream->validates()) {
					$this->RecordingStream->create();					
				if ($this->RecordingStream->save($this->request->data['RecordingStream'],false)) {					
					$recording_stream_id	=	$id;					
					$p_image	=	$this->request->data['RecordingStream']['recording_stream_image'];
					$old_image	=	$this->request->data['RecordingStream']['image'];
										
					if (!empty($p_image) && $p_image['tmp_name'] != '' && $p_image['size'] > 0) {
			
						$allowed	=	array('jpg','jpeg','png');
						$temp 		= 	explode(".", $p_image["name"]);
						$extension 	= 	end($temp);
						$imageName 	= 	'recording_stream_image_'.microtime(true).'.'.$extension;
						$files		=	$p_image;
						
						$result 	= 	$this->Upload->upload($files, WWW_ROOT . RECORDING_IMAGE_FULL_DIR . DS, $imageName,'',$allowed);
						
						if(!empty($this->Upload->result) && empty($this->Upload->errors)) {
							
							if($old_image &&  file_exists(WWW_ROOT.RECORDING_IMAGE_FULL_DIR.DS.$old_image )) {
								@unlink(WWW_ROOT.RECORDING_IMAGE_FULL_DIR.DS.$old_image);
							}
							
							$this->RecordingStream->id	=	$recording_stream_id;
							$this->RecordingStream->saveField('image',$imageName,false);
						}
						
					}
					
					$this->Session->setFlash("Record has been added successfully", 'admin_flash_good');
					$this->redirect(array('controller'=>'channels', 'action'=>'slider_index'));
			
				} 
			} else {
					 $this->Session->setFlash(__('The record could not be saved. Please, try again.', true), 'admin_flash_bad');
                }
			}
        } else {
			$this->request->data = $this->RecordingStream->read(null, $id);		
			
		}
	}
	/*
	@ param : null
	@ return void
	*/
	public function admin_view($id = null){
	
		$this->set('title_for_layout','View Detail');
		
		$this->loadModel('RecordingStream');
		$this->RecordingStream->id = $id;
		$this->set(compact('id'));
		
		/*check conditions allreday conditions for users update*/
        if (!$this->RecordingStream->exists()) {
            throw new NotFoundException(__('Invalid Video'));
        }
		$this->RecordingStream->bindModel(array(
			'belongsTo'=>array(
				'User'=>array(
					'className'=>'User',
					'foreignKey'=>'user_id',
					'fields'=>array('id','first_name','profile_image')	
				),
				'Channel'=>array(
					'className'=>'Channel',
					'foreignKey'=>'channel_id',
					'fields'=>array('id','name','image','play_count')	
				)
			)			
		),false);
		$data = $this->RecordingStream->read(null, $id);
		$this->set(compact('data'));
	}
	
	public function admin_slider_view($id = null){
	
		$this->set('title_for_layout','View Detail');
		
		$this->loadModel('RecordingStream');
		$this->RecordingStream->id = $id;
		$this->set(compact('id'));
		
		/*check conditions allreday conditions for users update*/
        if (!$this->RecordingStream->exists()) {
            throw new NotFoundException(__('Invalid Video'));
        }
		$this->RecordingStream->bindModel(array(
			'belongsTo'=>array(
				'User'=>array(
					'className'=>'User',
					'foreignKey'=>'user_id',
					'fields'=>array('id','first_name','profile_image')	
				),
				'Channel'=>array(
					'className'=>'Channel',
					'foreignKey'=>'channel_id',
					'fields'=>array('id','name','image','play_count')	
				)
			)			
		),false);
		$data = $this->RecordingStream->read(null, $id);
		$this->set(compact('data'));
	}
	
	
	public function admin_recording($id = null) {
		
		
		if (!isset($this->params['named']['page'])) {
            $this->Session->delete('AdminSearch');
        }
		$this->set('id',$id);
		$filters	=	array();
		$filters	=	array('RecordingStream.channel_id'=>$id);
        if (!empty($this->request->data)) {
			$this->Session->delete('AdminSearch');
          
			if (isset($this->request->data['User']['first_name']) && $this->request->data['User']['first_name'] != '') {
                $first_name = trim($this->request->data['User']['first_name']);
                $this->Session->write('AdminSearch.first_name', $first_name);				
            }
			
			if (isset($this->request->data['RecordingStream']['title']) && $this->request->data['RecordingStream']['title'] != '') {
                $title = trim($this->request->data['RecordingStream']['title']);
                $this->Session->write('AdminSearch.title', $title);				
            }
			
			if (isset($this->request->data['RecordingStream']['description']) && $this->request->data['RecordingStream']['description'] != '') {
                $description = trim($this->request->data['RecordingStream']['description']);
                $this->Session->write('AdminSearch.description', $description);				
            }
			
			
		}
		
		if ($this->Session->check('AdminSearch')) {
            $keywords 	= 	$this->Session->read('AdminSearch');
			foreach($keywords as $key=>$values){
				if($key == 'first_name'){
					$filters[] = array('User.'.$key.' LIKE'=>"%".$values."%");					
				}
				if($key == 'title'){
					$filters[] = array('RecordingStream.'.$key.' LIKE'=>"%".$values."%");					
				}
				if($key == 'description'){
					$filters[] = array('RecordingStream.'.$key.' LIKE'=>"%".$values."%");					
				}
			}
		}
		
		$this->loadModel('RecordingStream');
		
		$this->RecordingStream->bindModel(array(
			'belongsTo'=>array(
				'User'=>array(
					'className'=>'User',
					'foreignKey'=>'user_id',
					'fields'=>array('id','first_name','profile_image')	
				)
			)			
		),false);
		
		$this->paginate = array('RecordingStream' => array(
			'limit' =>Configure::read('App.PageLimit'),
			'order' => array('RecordingStream.id' => 'DESC'),
			'conditions' => $filters,
        ));
		$data = $this->paginate('RecordingStream');	
		$this->set(compact('data'));
		$this->set('title_for_layout', __('Recording Stream', true));
		
	}
	
	/*
	@ param : null
	@ return void
	*/
/* 
	@ this function are used activated,deactivated and deleted channels by admin
	*/
	public function admin_process() {
	
		if (!empty($this->request->data)) {
			if (!isset($this->request->params['_Token']['key']) || ($this->request->params['_Token']['key'] != $this->request->params['_Token']['key'])) {
                $blackHoleCallback = $this->Security->blackHoleCallback;
                $this->$blackHoleCallback();
            }
			
          
            $action = $this->request->data['Channel']['pageAction'];
            foreach ($this->request->data['Channel'] AS $value) {
                if ($value != 0) {
                    $ids[] = $value;
                }
            }

			
            if (count($this->request->data) == 0 || $this->request->data['Channel'] == null) {
                $this->Session->setFlash('No items selected.', 'admin_flash_bad');
                 $this->redirect(array('controller'=>'channels', 'action'=>'index'));
            }

            /* if ($action == "delete") {
				
				
				$profileImages	=	$this->Channel->find('all',array('fields'=>array('id','profile_image','background_image'),'conditions'=>array('Channel.id'=>$ids)));
				
				if(!empty($profileImages)) {
					 
					foreach ($profileImages AS $img) {
						$image		=	$img['Channel']['profile_image'];
						$background_image		=	$img['Channel']['background_image'];
						if($image &&  file_exists(WWW_ROOT.PROFILE_IMAGE_FULL_DIR.DS.$image )) {
							@unlink(WWW_ROOT.PROFILE_IMAGE_FULL_DIR.DS.$image);
						}
						if($background_image &&  file_exists(WWW_ROOT.BACKGROUND_IMAGE_FULL_DIR.DS.$background_image )) {
							@unlink(WWW_ROOT.BACKGROUND_IMAGE_FULL_DIR.DS.$background_image);
						}
					}
				}
				$this->Channel->deleteAll(array('Channel.id'=>$ids));
                $this->Session->setFlash('channels have been deleted successfully', 'admin_flash_good');
                $this->redirect(array('controller'=>'channels', 'action'=>'index'));
            } */
			
            if ($action == "activate") {
				
				$this->Channel->updateAll(array('status'=>Configure::read('App.Status.active')),array('Channel.id'=>$ids));
               
                $this->Session->setFlash('Channels have been activated successfully', 'admin_flash_good');
                $this->redirect(array('controller'=>'channels', 'action'=>'index'));
            }
			
            if ($action == "deactivate") {
			
				$this->Channel->updateAll(array('status'=>Configure::read('App.Status.inactive')),array('Channel.id'=>$ids));
				
                $this->Session->setFlash('Channels have been deactivated successfully', 'admin_flash_good');
				$this->redirect(array('controller'=>'channels', 'action'=>'index'));
            }
			
        } else {
            $this->redirect(array('controller' => 'channels', 'action' => 'index'));
        }
    }
	
	public function admin_video_process() {
	
		if (!empty($this->request->data)) {
			if (!isset($this->request->params['_Token']['key']) || ($this->request->params['_Token']['key'] != $this->request->params['_Token']['key'])) {
                $blackHoleCallback = $this->Security->blackHoleCallback;
                $this->$blackHoleCallback();
            }
			
			$this->loadModel('RecordingStream');
            $action = $this->request->data['RecordingStream']['pageAction'];
            foreach ($this->request->data['RecordingStream'] AS $value) {
                if ($value != 0) {
                    $ids[] = $value;
                }
            }

			
            if (count($this->request->data) == 0 || $this->request->data['RecordingStream'] == null) {
                $this->Session->setFlash('No items selected.', 'admin_flash_bad');
                 $this->redirect(array('controller'=>'channels', 'action'=>'video_index'));
            }

            if ($action == "activate") {
				
				$this->RecordingStream->updateAll(array('status'=>Configure::read('App.Status.active')),array('RecordingStream.id'=>$ids));
               
                $this->Session->setFlash('Recorded stream have been activated successfully', 'admin_flash_good');
                $this->redirect(array('controller'=>'channels', 'action'=>'video_index'));
            }
			
            if ($action == "deactivate") {
			
				$this->RecordingStream->updateAll(array('status'=>Configure::read('App.Status.inactive')),array('RecordingStream.id'=>$ids));
				
                $this->Session->setFlash('Recorded stream have been deactivated successfully', 'admin_flash_good');
				$this->redirect(array('controller'=>'channels', 'action'=>'video_index'));
            }
			if ($action == "delete") {
				$this->loadModel('RecordingStream');
				$this->loadModel('Message');
				$RecordingStream = $this->RecordingStream->find('all',array('conditions'=>array('RecordingStream.id'=>$ids)));
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
					$this->RecordingStream->deleteAll(array('RecordingStream.id' => $ids));
					$this->Message->deleteAll(array('RecordingStream.recording_stream_id' => $ids));
					$this->Session->setFlash('Recorded stream have been deleted successfully', 'admin_flash_good');
					$this->redirect(array('controller'=>'channels', 'action'=>'video_index'));
					
				}
				
				
            }
			
        } else {
            $this->redirect(array('controller' => 'channels', 'action' => 'video_index'));
        }
    }
	
	
	
	
	
	public function admin_delete_recording($id = null) {
		$this->layout = false;
		if (!$id) {
            $this->Session->setFlash(__('Invalid  id', true), 'admin_flash_bad');
            $this->redirect(array('controller'=>'channels','action' => 'video_index'));
        } else {
			$this->loadModel('RecordingStream');
			$this->loadModel('Message');
			$RecordingStream = $this->RecordingStream->find('first',array('conditions'=>array('RecordingStream.id'=>$id)));
			if(!empty($RecordingStream))
			{
				
				
				if($RecordingStream['RecordingStream']['image'] &&  file_exists(WWW_ROOT.RECORDING_IMAGE_FULL_DIR.DS.$RecordingStream['RecordingStream']['image'] )) 
				{
					@unlink(WWW_ROOT.RECORDING_IMAGE_FULL_DIR.DS.$RecordingStream['RecordingStream']['image']);
				}
				
				$ch = curl_init('https://api.cloud.wowza.com/api/v1/recordings/'.$RecordingStream['RecordingStream']['recording_key'].'/');
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
				$this->RecordingStream->deleteAll(array('RecordingStream.id' => $id));
				$this->Message->deleteAll(array('Message.recording_stream_id' => $id));
				$this->Session->setFlash('Recorded stream have been deleted successfully', 'admin_flash_good');
				$this->redirect(array('controller'=>'channels', 'action'=>'video_index'));
			}
			
		}
	}	
	
	
	public function admin_recording_process() {
	
		if (!empty($this->request->data)) {
			if (!isset($this->request->params['_Token']['key']) || ($this->request->params['_Token']['key'] != $this->request->params['_Token']['key'])) {
                $blackHoleCallback = $this->Security->blackHoleCallback;
                $this->$blackHoleCallback();
            }
			
          $this->loadModel('RecordingStream');
            $action = $this->request->data['RecordingStream']['pageAction'];
            foreach ($this->request->data['RecordingStream'] AS $value) {
                if ($value != 0) {
                    $ids[] = $value;
                }
            }

			
            if (count($this->request->data) == 0 || $this->request->data['RecordingStream'] == null) {
                $this->Session->setFlash('No items selected.', 'admin_flash_bad');
                 $this->redirect($this->referer());
            }

            
			
            if ($action == "activate") {
				
				$this->RecordingStream->updateAll(array('status'=>Configure::read('App.Status.active')),array('RecordingStream.id'=>$ids));
               
                $this->Session->setFlash('Recording streams have been activated successfully', 'admin_flash_good');
                 $this->redirect($this->referer());
            }
			
            if ($action == "deactivate") {
			
				$this->RecordingStream->updateAll(array('status'=>Configure::read('App.Status.inactive')),array('RecordingStream.id'=>$ids));
				
                $this->Session->setFlash('Recording streams have been deactivated successfully', 'admin_flash_good');
				 $this->redirect($this->referer());
            }
			
        } else {
            $this->redirect($this->referer());
        }
    }
	
	public function admin_channel_delete($id = null) {
		$this->layout = false;
		// $this->autoRender = false;
		$this->loadModel('Stream');
		$this->loadModel('RecordingStream');
		$this->loadModel('Message');
		$this->loadModel('ChannelFollower');
		$this->loadModel('ChannelSubscription');
		$get_channel_detail = $this->Channel->find('first',array('conditions'=>array('Channel.id'=>$id)));
		if(!empty($get_channel_detail))
		{
			if($get_channel_detail['Channel']['image'] &&  file_exists(WWW_ROOT.CHANNEL_IMAGE_FULL_DIR.DS.$get_channel_detail['Channel']['image'])) 
			{
				@unlink(WWW_ROOT.CHANNEL_IMAGE_FULL_DIR.DS.$get_channel_detail['Channel']['image']);
			}
		
		
		$get_stream_detail = $this->Stream->find('all',array('conditions'=>array('Stream.channel_id'=>$id)));		
		if(!empty($get_stream_detail))
		{	
			foreach($get_stream_detail as $stream_key=>$streaming_value){ 
				if($streaming_value['Stream']['stream_image'] &&  file_exists(WWW_ROOT.STREAM_IMAGE_FULL_DIR.DS.$streaming_value['Stream']['stream_image'] )) 
				{
					@unlink(WWW_ROOT.STREAM_IMAGE_FULL_DIR.DS.$streaming_value['Stream']['stream_image']);
				}
				if(!empty($streaming_value['Stream']['stream_key']))
				{
					$ch = curl_init('https://api.cloud.wowza.com/api/v1/live_streams/'.$streaming_value['Stream']['stream_key'].'/');
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
				if(!empty($streaming_value['Stream']['schedule_id']))
				{
					$ch = curl_init('https://api.cloud.wowza.com/api/v1/schedules/'.$streaming_value['Stream']['schedule_id'].'/');
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
				$this->Stream->deleteAll(array('Stream.id' => $streaming_value['Stream']['id']));
				$this->Message->deleteAll(array('Message.stream_id' => $streaming_value['Stream']['id']));
			
			}
		
		}
			
			$this->ChannelFollower->deleteAll(array('ChannelFollower.channel_id' => $id));
			$this->ChannelSubscription->deleteAll(array('ChannelSubscription.channel_id' => $id));
			$this->Channel->deleteAll(array('Channel.id' => $id));
			
			$RecordingStream = $this->RecordingStream->find('all',array('conditions'=>array('RecordingStream.channel_id'=>$id)));	
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
				$this->RecordingStream->deleteAll(array('RecordingStream.channel_id' => $id));
			
				
			}
			
		}
			$this->Session->setFlash('Channel has been deleted successfully', 'admin_flash_good');
			$this->redirect($this->referer());			
	}
	
	
	public function index()
	{
		$this->layout = "front";
		$this->set('title_for_layout','CHANNELS');
		$this->loadModel('Stream');
		
		if(!empty($this->request->data))
		{
			
			$keyword = trim($this->request->data['Channel']['keyword']);
			$filters = array();
			$stream_channel_ids_array =array();
			$stream_data = $this->Stream->find('all',array('conditions'=>array('Stream.title LIKE'=>"%".trim($keyword)."%"),'fields'=>array('Stream.channel_id')));
			if(!empty($stream_data))
			{
				foreach($stream_data as $key=>$value)
				{
					$stream_channel_ids_array[] = $value['Stream']['channel_id'];
				}
			}
			
			$filters[] = array('OR'=>array('Channel.name LIKE'=>"%".trim($keyword)."%",'Channel.id'=>$stream_channel_ids_array));
		
			$this->paginate = array('Channel' => array(
				'limit' =>Configure::read('App.PageLimit'),
				'order' => array('Channel.sorting' => 'ASC'),
				'conditions' => $filters,
				'group'=>array('Channel.id')
			));
			$channel_listing = $this->paginate('Channel');
		}
		else
		{	
			
			
			$this->paginate = array('Channel' => array(
				'limit' =>Configure::read('App.PageLimit'),
				'order' => array('Channel.sorting' => 'ASC'),
				'conditions' => array('Channel.name IS NOT NULL','Channel.image IS NOT NULL','Channel.status'=>Configure::read('App.Status.active'))
			));
			$channel_listing = $this->paginate('Channel');
		}
		$this->Stream->bindModel(array('belongsTo'=>array('Channel'=>array('fields'=>array('Channel.name')))),false);
		
		$live_channels = $this->Stream->find('all',array('conditions'=>array('Stream.status'=>Configure::read('App.Status.active'),'Stream.stream_state'=>STARTED)));
		/* pr($live_channels);
		die; */
		$this->set('live_channels',$live_channels);
		
		$this->set('channel_listing',$channel_listing);
	}
	
	
	
	
	public function channel_detail($id = null)
	{
		
		$this->layout = "lay_channel_detail";
		$this->set('title_for_layout','Channel Detail');
		
		$this->loadModel('Channel');
		$this->loadModel('Stream');
		$this->loadModel('User');
		$this->loadModel('RecordingStream');
		$this->loadModel('ChannelFollower');
		$this->loadModel('ChannelSubscription');
		
		$this->User->bindModel(array(
			'hasOne'=>array(
				'UserDetail'=>array(
					'className'=>'UserDetail',
					'foreignKey'=>'user_id',
					'fields'=>array('id','user_id','paypal_email')	
				)
			)			
		),false);
		
		
		$this->Channel->bindModel(array(
			'belongsTo'=>array(
				'User'=>array(
					'className'=>'User',
					'foreignKey'=>'user_id',
					'fields'=>array('id','first_name','profile_image')	
				)
			),
			'hasMany'=>array(
				'RecordingStream'=>array(
					'className'=>'RecordingStream',
					'foreignKey'=>'channel_id',
					'fields'=>array('id','title','image')	
				)
			)	
		),false);
		
		
		
		
		$channelData = $this->Channel->find('first',array('conditions'=>array('Channel.id'=>$id),'recursive'=>2));
		
		$channelCountFollowData = $this->ChannelFollower->find('count',array('conditions'=>array('ChannelFollower.user_id'=>$this->Auth->user('id'),'ChannelFollower.channel_id'=>$id,'ChannelFollower.is_follow'=>1)));
		
		$channelCountSubscriptionData = $this->ChannelSubscription->find('count',array('conditions'=>array('ChannelSubscription.user_id'=>$this->Auth->user('id'),'ChannelSubscription.channel_id'=>$id)));
		
		
		$live_channels = $this->Stream->find('all',array('conditions'=>array('Stream.channel_id'=>$id,'Stream.status'=>Configure::read('App.Status.active'),'Stream.stream_state'=>STARTED)));
		/* pr($live_channels);
		die; */
		$this->set('live_channels',$live_channels);
		
		
		
		
		$this->set(compact('channelData','channelCountFollowData','channelCountSubscriptionData'));
	}
	
	public function channel_manager()
	{	
		$this->layout = 'lay_dashboard';
		$this->set('title_for_layout','Channel Manager');
		$id = $this->Auth->User('id');
		$this->User->bindModel(array('hasOne'=>array('Channel'=>array('fields' => array('id','name','image','website','company','bio')))),false);
		$this->User->bindModel(array('hasMany'=>array('RecordingStream'=>array('fields' => array('id','title','created','image'),'order'=>array('created'=>'desc')))),false);
		$user_detail = $this->User->find('first', array('conditions' => array('User.id' => $id)));
		
		$this->set('user_detail',$user_detail);
		
		
		
		
	}
	
	public function setting(){
	
			
	 	 if ($this->RequestHandler->isAjax()) {
			$this->autoRender = false;
			$this->layout = 'ajax';
		}  
		
		$user_id = $this->Session->read('Auth.User.id');
		$this->loadModel('Channel');
		// get the categories list start //
		$this->loadModel('Category');
		$categories = $this->Category->find('list',array('Conditions'=>array('Catgory.status'=>Configure::read('App.Status.active')),'order'=>array('Category.name'=>'ASC')));
		$this->set('categories',$categories);
		// get the categories list end //

		$exist = $this->Channel->find('first',array('conditions'=>array('Channel.user_id'=>$user_id)));
		if ($this->request->data) 
		{			;
			unset($this->request->data['Channel']['id']);
			$this->Channel->set($this->request->data);
			$this->Channel->setValidation('channel_add');
			
			if($this->Channel->validates()) 
			{ 
				
				if(isset($exist) && !empty($exist)){				
					$this->request->data['Channel']['id'] = $exist['Channel']['id'];
				}
				$this->request->data['Channel']['user_id'] = $user_id;
				
				if($this->Channel->save($this->request->data)) {
					
					$this->Session->setFlash(__('Channel info updated successfully.'), 'flash_success');
					echo "<script>window.location.href = '".SITE_URL."channels/channel_manager'</script>";						
				}else{
					$this->Session->setFlash('Channel info not updated.Please try again.', 'flash_error');
				}	
			}else{
			
			$this->Session->setFlash('Channel info not updated.Please try again.', 'flash_popup_error');
			}
			
			
			
		}else{
		
		$this->request->data = $exist;
		}
		// pr($exist);die;
		// $this->set('channel_data',$this->request->data);
		$this->render('/Elements/Front/Streams/channel_detail');
		
	}



	public function edit_recording($id = null){
	
			
	 	 if ($this->RequestHandler->isAjax()) {
			$this->autoRender = false;
			$this->layout = 'ajax';
		}  
		$this->loadModel('RecordingStream');
		
				
		if ($this->request->data) 
		{		
			$this->RecordingStream->set($this->request->data);
			$this->RecordingStream->setValidation('edit');
			
			if($this->RecordingStream->validates()) 
			{ 
				if($this->RecordingStream->save($this->request->data)) {
					
					$this->Session->setFlash(__('Recorded stream updated successfully.'), 'flash_success');
					echo "<script>window.location.href = '".SITE_URL."channels/channel_manager'</script>";						
				}else{
					$this->Session->setFlash('Recorded stream cannot be saved.Please try again', 'flash_error');
				}	
			}else{
			
			$this->Session->setFlash('Recorded stream cannot be saved.Please try again', 'flash_popup_error');
			}			
		}else{	
			$data = $this->RecordingStream->read(null,$id);		
			$this->request->data = $data;
		}
		$this->render('/Elements/Front/Streams/recording_detail');
		
	}
	public function channelpicupload(){ 
		$this->loadModel('Channel');
	    if(isset($_FILES['uploadfile']['name'])){
			$p_image = $_FILES['uploadfile'];			
			$oldpic= $this->Channel->find("first",array("conditions"=>array("Channel.user_id"=>$this->Auth->User('id'))));
			
			
		
			if (!empty($p_image) && $p_image['tmp_name'] != '' && $p_image['size'] > 0) {
				list($width, $height, $type, $attr) = getimagesize($p_image['tmp_name']);
				$allowed	=	array('jpg','jpeg','png','gif','JPG','JPEG','PNG','GIF');
				$temp 		= 	explode(".", $p_image["name"]);
				$extension 	= 	end($temp);
				$imageName 	= 	'channel_banner_'.microtime(true).'.'.$extension;
				$files		=	$p_image;
				
				$result 	= 	$this->Upload->upload($files, WWW_ROOT . CHANNEL_IMAGE_FULL_DIR . DS, $imageName,'',$allowed);
				
				if($width<1230 || $height<320)
				{
					echo "sizeError|"."Image size should be 1230x320 or greater.";
					die;
				}
				if(!empty($this->Upload->result) && empty($this->Upload->errors)) 
				{	
					if(!empty($oldpic['Channel']['id'])){
						if(!empty($oldpic['Channel']['image'])){
							$old_image	=	$oldpic['Channel']['image'];
							if(file_exists(WWW_ROOT.CHANNEL_IMAGE_FULL_DIR.DS.$old_image )) {
								@unlink(WWW_ROOT.CHANNEL_IMAGE_FULL_DIR.DS.$old_image);
							}
						}
						$old_image_id	=	$oldpic['Channel']['id'];	
						$this->request->data['Channel']['id'] = $old_image_id;
					}
					
					$this->request->data['Channel']['image'] = $imageName;
					$this->request->data['Channel']['user_id'] = $this->Auth->User('id');
					
					
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
	
	
	public function admin_change_featured_status($id = null) {
		
		$get_featured_detail = $this->Channel->find('first',array('conditions'=>array('Channel.id'=>$id),'fields'=>array('Channel.id','Channel.featured')));
	
		if($get_featured_detail['Channel']['featured'] == 1)
		{
			$this->Channel->id = $get_featured_detail['Channel']['id'];
			$this->Channel->saveField('featured',0);
			 $this->Session->setFlash(__('Admin\'s channel featured has been changed'), 'admin_flash_good');
				$this->redirect($this->referer());
		}
		else
		{
			$this->Channel->id = $get_featured_detail['Channel']['id'];
			$this->Channel->saveField('featured',1);
			$this->Session->setFlash(__('Admin\'s channel unfeatured was not changed', 'admin_flash_error'));
			$this->redirect($this->referer());
		}
    }
	public function admin_change_ishome_status($id = null) {
		
		$this->loadModel('RecordingStream');
		$get_ishome_detail = $this->RecordingStream->find('first',array('conditions'=>array('RecordingStream.id'=>$id),'fields'=>array('RecordingStream.id','RecordingStream.is_home')));
	
	
		if($get_ishome_detail['RecordingStream']['is_home'] == 1)
		{
			$this->RecordingStream->id = $get_ishome_detail['RecordingStream']['id'];
			$this->RecordingStream->saveField('is_home',0);
			 $this->Session->setFlash(__('Recorded stream does not show on home page'), 'admin_flash_good');
				$this->redirect($this->referer());
		}
		else
		{
			$this->RecordingStream->id = $get_ishome_detail['RecordingStream']['id'];
			$this->RecordingStream->saveField('is_home',1);
			$this->Session->setFlash(__('Recorded stream show on home page'), 'admin_flash_good');
			$this->redirect($this->referer());
		}
    }
	
	public function admin_change_video_button_status($id = null) {
		
		$this->loadModel('RecordingStream');
		$get_video_button_detail = $this->RecordingStream->find('first',array('conditions'=>array('RecordingStream.id'=>$id),'fields'=>array('RecordingStream.id','RecordingStream.video_play_button_type')));
	
	
		if($get_video_button_detail['RecordingStream']['video_play_button_type'] == 1)
		{
			$this->RecordingStream->id = $get_video_button_detail['RecordingStream']['id'];
			$this->RecordingStream->saveField('video_play_button_type',0);
			$this->Session->setFlash(__('Slider video show start button'), 'admin_flash_good');
			$this->redirect($this->referer());
		}
		else
		{
			$this->RecordingStream->id = $get_video_button_detail['RecordingStream']['id'];
			$this->RecordingStream->saveField('video_play_button_type',1);
			$this->Session->setFlash(__('Slider video auto play'), 'admin_flash_good');
			$this->redirect($this->referer());
		}
    }
	
	
	 public function admin_status($id = null) {
        if ($this->Session->check('Auth.User.id') && $this->Session->read('Auth.User.role_id') == Configure::read('App.SubAdmin.role')) { die('iiififififi');
            $this->Session->setFlash(__('You are not authorizatized for this action'), 'admin_flash_error');
            $this->redirect(array('controller' => 'admins', 'action' => 'dashboard'));
        }
        $this->Channel->id = $id;
		
		
        if (!$this->Channel->exists()) {
            throw new NotFoundException(__('Invalid Channel'));
        }
       
        $this->loadModel('Channel'); 
        if ($this->Channel->toggleStatus($id)) { 
            $this->Session->setFlash(__('Channel status has been changed'), 'admin_flash_good');
		    $this->redirect($this->referer());
        }
        $this->Session->setFlash(__('Channel status was not changed', 'admin_flash_error'));
        $this->redirect($this->referer());
    }
	 public function admin_video_status($id = null) {
        if ($this->Session->check('Auth.User.id') && $this->Session->read('Auth.User.role_id') == Configure::read('App.SubAdmin.role')) { die('iiififififi');
            $this->Session->setFlash(__('You are not authorizatized for this action'), 'admin_flash_error');
            $this->redirect(array('controller' => 'admins', 'action' => 'dashboard'));
        }
		$this->loadModel('RecordingStream');
        $this->RecordingStream->id = $id;
		
		
        if (!$this->RecordingStream->exists()) {
            throw new NotFoundException(__('Invalid Recorded stream'));
        }
       
        $this->loadModel('RecordingStream'); 
        if ($this->RecordingStream->toggleStatus($id)) { 
            $this->Session->setFlash(__('Recorded stream status has been changed'), 'admin_flash_good');
		    $this->redirect($this->referer());
        }
        $this->Session->setFlash(__('Recorded stream status was not changed', 'admin_flash_error'));
        $this->redirect($this->referer());
    }
	
	public function my_channel()
	{	
		$this->layout = 'lay_stream_detail';
		$this->set('title_for_layout','My Channel');
		$user_id = $this->Auth->User('id');
		$this->loadModel('Channel');
		$this->loadModel('Stream');
		$this->loadModel('RecordingStream');
		$channel_detail = $this->Channel->find('first',array('conditions'=>array('Channel.user_id'=>$user_id)));
		$latest_live_stream = $this->Stream->find('first',array('conditions'=>array('Stream.user_id'=>$user_id,'Stream.stream_state'=>STARTED), 'order' => array('Stream.created' => 'desc')));
		
		//$latest_recorded_stream = $this->RecordingStream->find('first',array('conditions'=>array('RecordingStream.user_id'=>$user_id),'order'=>array('RecordingStream.id'=>'DESC')));
		//$this->set('latest_recorded_stream',$latest_recorded_stream);
		
		$related_recorded_stream = $this->RecordingStream->find('all',array('conditions'=>array('RecordingStream.user_id'=>$user_id),'order'=>array('RecordingStream.id'=>'DESC')));
		$this->set('channel_detail',$channel_detail);
		$this->set('latest_live_stream',$latest_live_stream);
		$this->set('related_recorded_stream',$related_recorded_stream);
		//pr($latest_recorded_stream);
		
	}
	
	
	public function update_channel_play_count()
	{
		$this->layout = false;
		$this->autoRender = false;
		if(!empty($_POST) && !empty($_POST['channel_id']))
		{
			if($this->Channel->updateAll(
				array('Channel.play_count' => 'Channel.play_count + 1'),
				array('Channel.id' => $_POST['channel_id'])
			))
			{
				echo "1";die;
			}
			else
			{	
				echo "0";die;
			}
		}
		
	}
	
	public function subscribe()
	{
		$this->autoRender = false;
		$this->layout = 'ajax';
		if(!empty($_POST))
		{	
			if(!empty($_POST) && !empty($_POST['channel_id']))
			{
				$this->loadModel('ChannelSubscription');
				$this->request->data['ChannelSubscription']['user_id'] = $this->Auth->User('id');
				$this->request->data['ChannelSubscription']['channel_id'] = $_POST['channel_id'];
				// $this->request->data['ChannelSubscription']['stream_id'] = $_POST['stream_id'];
				if($this->ChannelSubscription->save($this->request->data))
				{
				
					if($this->Channel->updateAll(
						array('Channel.subscribe_count' => 'Channel.subscribe_count + 1'),
						array('Channel.id' => $_POST['channel_id'])
					))
					
					$channelCountSubscriptionData = $this->Channel->find('first',array('conditions'=>array('Channel.id'=>$_POST['channel_id'])));
					$return_value['count'] = $channelCountSubscriptionData['Channel']['subscribe_count'];
					
					$response = array('key'=>'success','count'=>$return_value['count']);
					echo json_encode($response);
					die;	
					
					
					// echo "1";die;
				}
				else
				{			
					
					$response = array('key'=>'failed','count'=>$return_value['count']);
					echo json_encode($response);
					die;	
				}
			}
		}
	}
	
	public function subscribe_backup()
	{
		$this->autoRender = false;
		$this->layout = 'ajax';
		if(!empty($_POST))
		{	
			if(!empty($_POST) && !empty($_POST['channel_id']))
			{
				$this->loadModel('ChannelSubscription');
				$this->request->data['ChannelSubscription']['user_id'] =$this->Auth->User('id');
				$this->request->data['ChannelSubscription']['channel_id'] = $_POST['channel_id'];
				// $this->request->data['ChannelSubscription']['stream_id'] = $_POST['stream_id'];
				if($this->ChannelSubscription->save($this->request->data))
				{
				
					if($this->Channel->updateAll(
						array('Channel.subscribe_count' => 'Channel.subscribe_count + 1'),
						array('Channel.id' => $_POST['channel_id'])
					))
				
				
					//$this->Session->setFlash('Channel Subscribe Successfully.', 'flash_success');
					echo "1";die;
				}
				else
				{
					
					//$this->Session->setFlash('Please try again later', 'flash_error');
					echo "0";die;
				}
			}
		}
	}
	
	
	
	public function unsubscribe()
	{
		$this->autoRender = false;
		$this->layout = 'ajax';
		if(!empty($_POST))
		{
			if(!empty($_POST) && !empty($_POST['channel_id']))
			{
				$this->loadModel('ChannelSubscription');
			
				
				$channel_subscription_detail = $this->ChannelSubscription->find('first',array('conditions'=>array('ChannelSubscription.user_id'=>$this->Auth->User('id'),'ChannelSubscription.channel_id'=>$_POST['channel_id'])));
					// pr($channel_subscription_detail);die;
				if($this->ChannelSubscription->delete($channel_subscription_detail['ChannelSubscription']['id']))
				{
				
					if($this->Channel->updateAll(
						array('Channel.subscribe_count' => 'Channel.subscribe_count - 1'),
						array('Channel.id' => $_POST['channel_id'])
					))
			
					$channelCountSubscriptionData = $this->Channel->find('first',array('conditions'=>array('Channel.id'=>$_POST['channel_id'])));
					$return_value = $channelCountSubscriptionData['Channel']['subscribe_count'];
					
					$response = array('key'=>'success','count'=>$return_value);
					echo json_encode($response);
					die;	
				}
				else
				{
					
					$response = array('key'=>'failed','count'=>$return_value['count']);
					echo json_encode($response);
					die;
				}
			}
		}
	}
	
	public function unsubscribe_backup()
	{
		$this->autoRender = false;
		$this->layout = 'ajax';
		if(!empty($_POST))
		{
			if(!empty($_POST) && !empty($_POST['channel_id']))
			{
				$this->loadModel('ChannelSubscription');
				
				$channel_subscription_detail = $this->ChannelSubscription->find('first',array('conditions'=>array('ChannelSubscription.user_id'=>$this->Auth->User('id'),'ChannelSubscription.channel_id'=>$_POST['channel_id'],'ChannelSubscription.stream_id'=>$_POST['stream_id'])));
				
				if($this->ChannelSubscription->delete($channel_subscription_detail['ChannelSubscription']['id']))
				{
				
					if($this->Channel->updateAll(
						array('Channel.subscribe_count' => 'Channel.subscribe_count - 1'),
						array('Channel.id' => $_POST['channel_id'])
					))
				
				
					//$this->Session->setFlash('Channel Subscribe Successfully.', 'flash_success');
					echo "1";die;
				}
				else
				{
					
					//$this->Session->setFlash('Please try again later', 'flash_error');
					echo "0";die;
				}
			}
		}
	}
	
	
	
	public function donation($id)
	{
		
		$this->User->bindModel(array(
			'hasOne'=>array(
				'UserDetail'=>array(
					'className'=>'UserDetail',
					'foreignKey'=>'user_id',
					'fields'=>array('id','user_id','paypal_email')	
				)
			)			
		),false);
		
		
		$this->Channel->bindModel(array(
			'belongsTo'=>array(
				'User'=>array(
					'className'=>'User',
					'foreignKey'=>'user_id',
					'fields'=>array('id','first_name','profile_image')	
				)
			)
		),false);
		
		
		
		
		$channelData = $this->Channel->find('first',array('conditions'=>array('Channel.id'=>$id),'recursive'=>2));
		/* pr($channelData);
		die; */
		$this->set('channelData',$channelData);
		/* if(empty($channelData['User']['UserDetail']['paypal_email']))
		{
			$this->Session->setFlash('Merchant email is empty.Please try again later', 'flash_popup_error');
			$this->redirect(array('controller'=>'channels','action'=>'channel_detail',$id));
		} */
	}
	
	
	
	
	public function paypal_notify()
	{
		$this->layout = false;
	// CONFIG: Enable debug mode. This means we'll log requests into 'ipn.log' in the same directory.
		// Especially useful if you encounter network errors or other intermittent problems with IPN (validation).
		// Set this to 0 once you go live or don't require logging.
		define("DEBUG", 1);
		// Set to 0 once you're ready to go live
		define("USE_SANDBOX", 1);
		define("LOG_FILE", "./ipn.log");
		// Read POST data
		// reading posted data directly from $_POST causes serialization
		// issues with array data in POST. Reading raw POST data from input stream instead.
		$raw_post_data = file_get_contents('php://input');
		$raw_post_array = explode('&', $raw_post_data);
		$myPost = array();
		foreach ($raw_post_array as $keyval) {
			$keyval = explode ('=', $keyval);
			if (count($keyval) == 2)
				$myPost[$keyval[0]] = urldecode($keyval[1]);
		}
		// read the post from PayPal system and add 'cmd'
		$req = 'cmd=_notify-validate';
		if(function_exists('get_magic_quotes_gpc')) {
			$get_magic_quotes_exists = true;
		}
		foreach ($myPost as $key => $value) {
			if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
				$value = urlencode(stripslashes($value));
			} else {
				$value = urlencode($value);
			}
			$req .= "&$key=$value";
		}
		// Post IPN data back to PayPal to validate the IPN data is genuine
		// Without this step anyone can fake IPN data
		if(USE_SANDBOX == true) {
			$paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
		} else {
			$paypal_url = "https://www.paypal.com/cgi-bin/webscr";
		}
		$ch = curl_init($paypal_url);
		if ($ch == FALSE) {
			return FALSE;
		}
		curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
		if(DEBUG == true) {
			curl_setopt($ch, CURLOPT_HEADER, 1);
			curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
		}
		// CONFIG: Optional proxy configuration
		//curl_setopt($ch, CURLOPT_PROXY, $proxy);
		//curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
		// Set TCP timeout to 30 seconds
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
		// CONFIG: Please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set the directory path
		// of the certificate as shown below. Ensure the file is readable by the webserver.
		// This is mandatory for some environments.
		//$cert = __DIR__ . "./cacert.pem";
		//curl_setopt($ch, CURLOPT_CAINFO, $cert);
		$res = curl_exec($ch);
		if (curl_errno($ch) != 0) // cURL error
			{
			if(DEBUG == true) {	
				/* error_log(date('[Y-m-d H:i e] '). "Can't connect to PayPal to validate IPN message: " . curl_error($ch) . PHP_EOL, 3, LOG_FILE); */
			}
			curl_close($ch);
			exit;
		} else {
				// Log the entire HTTP response if debug is switched on.
				if(DEBUG == true) {
					/* error_log(date('[Y-m-d H:i e] '). "HTTP request of validation request:". curl_getinfo($ch, CURLINFO_HEADER_OUT) ." for IPN payload: $req" . PHP_EOL, 3, LOG_FILE);
					error_log(date('[Y-m-d H:i e] '). "HTTP response of validation request: $res" . PHP_EOL, 3, LOG_FILE); */
				}
				curl_close($ch);
		}
		// Inspect IPN validation result and act accordingly
		// Split response headers and payload, a better way for strcmp
		$tokens = explode("\r\n\r\n", trim($res));
		$res = trim(end($tokens));
		if (strcmp ($res, "VERIFIED") == 0) {
			
			if(!empty($_POST)){
			
				$this->loadModel('ChannelTransaction');
				$check_existing_transaction_entry = $this->ChannelTransaction->find('count',array('conditions'=>array('ChannelTransaction.txn_id'=>$_POST['txn_id'])));
				if(!empty($_POST['payment_status']) && $_POST['payment_status']=='Completed' && $check_existing_transaction_entry == '0'){
				
					$transactionData['ChannelTransaction']['user_id'] = $_POST['custom'];
					$transactionData['ChannelTransaction']['channel_id'] = $_POST['item_number'];
					$transactionData['ChannelTransaction']['txn_id'] = $_POST['txn_id'];
					$transactionData['ChannelTransaction']['price'] = $_POST['mc_gross'];
					$transactionData['ChannelTransaction']['created'] = date('Y-m-d H:i:s');
					$this->ChannelTransaction->save($transactionData);
					die;
				}
			}
			if(DEBUG == true) {
				error_log(date('[Y-m-d H:i e] '). "Verified IPN: $req ". PHP_EOL, 3, LOG_FILE);
			}
		
		}else if (strcmp ($res, "INVALID") == 0) {
			// log for manual investigation
			// Add business logic here which deals with invalid IPN messages
			if(DEBUG == true) {
				error_log(date('[Y-m-d H:i e] '). "Invalid IPN: $req" . PHP_EOL, 3, LOG_FILE);
			}
		}
	}	
	
	
	public function paypal_cancel($id)
	{
		$this->layout = false;
		$this->Session->setFlash('Your transaction is cancel.', 'flash_popup_error');
		
		$this->redirect(array('controller'=>'channels','action'=>'channel_detail',$id));
	
		
	}


	public function paypal_return($id)
	{
		$this->layout = false;
		/* 
		$_POST['payment_status'] = 'Completed';
		$_POST['custom'] = 120;
		$_POST['item_number'] = 9;
		$_POST['txn_id'] = '444193457A7191314';
		$_POST['mc_gross'] = '1.00'; */
		if(!empty($_POST)){
			/* $this->loadModel('ChannelTransaction');
			$check_existing_transaction_entry = $this->ChannelTransaction->find('count',array('conditions'=>array('ChannelTransaction.txn_id'=>$_POST['txn_id']))); */
			//if(!empty($_POST['payment_status']) && $_POST['payment_status']=='Completed' && $check_existing_transaction_entry == '0'){
			if($_POST['payment_status']=='Completed'){
			
				/* $transactionData['ChannelTransaction']['user_id'] = $_POST['custom'];
				$transactionData['ChannelTransaction']['channel_id'] = $_POST['item_number'];
				$transactionData['ChannelTransaction']['txn_id'] = $_POST['txn_id'];
				$transactionData['ChannelTransaction']['price'] = $_POST['mc_gross'];
				$transactionData['ChannelTransaction']['created'] = date('Y-m-d H:i:s');
				$this->ChannelTransaction->save($transactionData); */
				$this->Session->setFlash('Your transaction is successful.', 'flash_success');
				$this->redirect(array('controller'=>'channels','action'=>'channel_detail',$id));
			
			}
			else
			{
				$this->Session->setFlash('Your transaction is failed.Please try again later.', 'flash_popup_error');
				$this->redirect(array('controller'=>'channels','action'=>'channel_detail',$id));
			}	
		}
		else
		{
			$this->Session->setFlash('Your transaction is failed.Please try again later.', 'flash_popup_error');
			$this->redirect(array('controller'=>'channels','action'=>'channel_detail',$id));
		}	
		
		
	}


	public function live_channels()
	{
		$this->layout = "front";
		$this->set('title_for_layout','LIVE CHANNELS');
		
		$this->loadModel('Stream');
		$live_channels = $this->Stream->find('all',array('conditions'=>array('Stream.status'=>Configure::read('App.Status.active'),'Stream.stream_state'=>STARTED)));
		$this->set('live_channels',$live_channels);
	}

	
	public function delete($id)
	{
		
		if (!$id) {
			$this->Session->setFlash(__('Invalid  id', true), 'flash_popup_error');
			$this->redirect(array('controller'=>'channels','action' => 'channel_manager'));
		} else {
			
			$this->loadModel('RecordingStream');
			$this->loadModel('Message');
			$RecordingStream = $this->RecordingStream->find('first',array('conditions'=>array('RecordingStream.id'=>$id)));			
			if(!empty($RecordingStream))
			{
				
				
				if($RecordingStream['RecordingStream']['image'] &&  file_exists(WWW_ROOT.RECORDING_IMAGE_FULL_DIR.DS.$RecordingStream['RecordingStream']['image'] )) 
				{
					@unlink(WWW_ROOT.RECORDING_IMAGE_FULL_DIR.DS.$RecordingStream['RecordingStream']['image']);
				}
				
				$ch = curl_init('https://api.cloud.wowza.com/api/v1/recordings/'.$RecordingStream['RecordingStream']['recording_key'].'/');
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
				$this->RecordingStream->deleteAll(array('RecordingStream.id' => $id));
				$this->Message->deleteAll(array('Message.recording_stream_id' => $id));
				$this->Session->setFlash('Recorded Stream has been deleted successfully', 'flash_success');
				$this->redirect($this->referer());
				
			}
		}
	}
public function admin_ajax_channel_sorting() { 
        if ($this->request->data['sort'] && is_array($this->request->data['sort'])) {
            foreach ($this->request->data['sort'] as $key => $value) {
              	
				$this->request->data['Channel']['id'] = $value;
				$this->request->data['Channel']['sorting'] = $key;			
				$this->Channel->save($this->request->data);		
				
            }
        }
        die(json_encode(array("status" => "success")));
    }
	
	
	public function admin_ajax_channel_video_sorting() { 
        if ($this->request->data['sort'] && is_array($this->request->data['sort'])) {
			$this->loadModel('RecordingStream');
            foreach ($this->request->data['sort'] as $key => $value) {
              	
				$this->request->data['RecordingStream']['id'] = $value;
				$this->request->data['RecordingStream']['sorting'] = $key;				
				$this->RecordingStream->save($this->request->data);		
				
            }
        }
        die(json_encode(array("status" => "success")));
    }
	
	public function admin_ajax_channel_slider_sorting() { 
        if ($this->request->data['sort'] && is_array($this->request->data['sort'])) {
			$this->loadModel('RecordingStream');
            foreach ($this->request->data['sort'] as $key => $value) {
              	
				$this->request->data['RecordingStream']['id'] = $value;
				$this->request->data['RecordingStream']['sorting'] = $key;			
				$this->RecordingStream->save($this->request->data);		
				
            }
        }
        die(json_encode(array("status" => "success")));
    }
}
