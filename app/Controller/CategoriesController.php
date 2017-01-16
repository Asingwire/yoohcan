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
class CategoriesController extends AppController {



/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Categories';

/**
 * This controller use a model admins
 *
 * @var array
 */
	public $uses 		= array('Category');
	
	public $helpers 	= array('Html', 'Session','General','Csv');
	var $components = 	array('General',"Upload");
	
	
	public function beforeFilter() {
	
        parent::beforeFilter();
        $this->loadModel('Category');
		$this->Auth->allow('index','category_detail','category_detail_ajax_tab');
    }

	
	
	/*
	@ param : null
	@ return void
	*/
	
	
	public function admin_add() 
	{		
		$this->set('title_for_layout','Category');	
		if(!empty($this->request->data))
		{			
			if (!isset($this->request->params['_Token']['key']) || ($this->request->params['_Token']['key'] != $this->request->params['_Token']['key'])) 
			{
				$blackHoleCallback = $this->Security->blackHoleCallback;
				$this->$blackHoleCallback();
            }
			
			//validate category data
			$this->Category->set($this->request->data['Category']);
			$this->Category->setValidation('add');
			if ($this->Category->validates()) 
			{
				$category_data	=	$this->request->data['Category'];
				$this->Category->save($category_data,false);
				$category_id	=	$this->Category->id;
				
				$p_image	=	$this->request->data['Category']['cat_image'];				
				if (!empty($p_image) && $p_image['tmp_name'] != '' && $p_image['size'] > 0) {
		
					$allowed	=	array('jpg','jpeg','png');
					$temp 		= 	explode(".", $p_image["name"]);
					$extension 	= 	end($temp);
					$imageName 	= 	'category_image_'.microtime(true).'.'.$extension;
					$files		=	$p_image;
					
					$result 	= 	$this->Upload->upload($files, WWW_ROOT . CATEGORY_IMAGE_FULL_DIR . DS, $imageName,'',$allowed);
					
					if(!empty($this->Upload->result) && empty($this->Upload->errors)) {
						$this->Category->id	=	$category_id;
						$this->Category->saveField('image',$imageName,false);
					}
				}
				
				$p_back_image	=	$this->request->data['Category']['cat_back_image'];				
				if (!empty($p_back_image) && $p_back_image['tmp_name'] != '' && $p_back_image['size'] > 0) {
		
					$allowed	=	array('jpg','jpeg','png');
					$temp 		= 	explode(".", $p_back_image["name"]);
					$extension 	= 	end($temp);
					$backgroundImageName 	= 	'category_background_image_'.microtime(true).'.'.$extension;
					$background_files		=	$p_back_image;
					
					$result 	= 	$this->Upload->upload($background_files, WWW_ROOT . CATEGORY_BACKGROUND_IMAGE_FULL_DIR . DS, $backgroundImageName,'',$allowed);
					
					if(!empty($this->Upload->result) && empty($this->Upload->errors)) {
						$this->Category->id	=	$category_id;
						$this->Category->saveField('background_image',$backgroundImageName,false);
					}
				}
				
				
				
				$this->Session->setFlash("Record has been added successfully", 'admin_flash_good');
				$this->redirect(array('controller'=>'categories', 'action'=>'index'));
			} 
			else 
			{				
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
        if (!empty($this->request->data)) 
		{
			$this->Session->delete('AdminSearch');
           if (isset($this->request->data['Category']['name']) && $this->request->data['Category']['name'] != '') {
                $name = trim($this->request->data['Category']['name']);
                $this->Session->write('AdminSearch.name', $name);
				
            }
		}
		
		if ($this->Session->check('AdminSearch')) 
		{
            $keywords 	= 	$this->Session->read('AdminSearch');
			foreach($keywords as $key=>$values){
				if($key == 'name')
				{
					$filters[] = array('Category.'.$key.' LIKE'=>"%".$values."%");					
				}
			}
			
		}
		
		$this->paginate = array('Category' => array(
			'limit' =>Configure::read('App.PageLimit'),
			'order' => array('Category.sorting' => 'ASC'),
			'conditions' => $filters,
        ));		
		
		$data = $this->paginate('Category');		
		$this->set(compact('data'));
		$this->set('title_for_layout', __('Category', true));
		
	}
	
	/*
	@ param : null
	@ return void
	*/
	public function admin_edit($id = null)
	{	
		$this->set('title_for_layout','Category');	
		$this->Category->id 	= 	$id;
		
		/*check conditions allreday conditions for categories update*/
        if (!$this->Category->exists()) 
		{
            throw new NotFoundException(__('Invalid Category'));
        }
		/*form post and check conditions*/
		if ($this->request->is('post') || $this->request->is('put')) 
		{			
			if (!empty($this->request->data)) 
			{				
				if (!isset($this->request->params['_Token']['key']) || ($this->request->params['_Token']['key'] != $this->request->params['_Token']['key'])) 
				{
					$blackHoleCallback = $this->Security->blackHoleCallback;
					$this->$blackHoleCallback();
				}
				
				//validate categories data
				$this->Category->set($this->request->data['Category']);
				$this->Category->setValidation('edit');
				if ($this->Category->validates()) 
				{
					$this->Category->create();
					if ($this->Category->save($this->request->data['Category'],false)) 
					{	
					
						
						$p_image	=	$this->request->data['Category']['cat_image'];
						$old_image	=	$this->request->data['Category']['image'];
						
						
						if (!empty($p_image) && $p_image['tmp_name'] != '' && $p_image['size'] > 0) {				
							$allowed	=	array('jpg','jpeg','png');
							$temp 		= 	explode(".", $p_image["name"]);
							$extension 	= 	end($temp);
							$imageName 	= 	'category_image_'.microtime(true).'.'.$extension;
							$files		=	$p_image;							
							$result 	= 	$this->Upload->upload($files, WWW_ROOT . CATEGORY_IMAGE_FULL_DIR . DS, $imageName,'',$allowed);
							
							if(!empty($this->Upload->result) && empty($this->Upload->errors)) {								
								if($old_image &&  file_exists(WWW_ROOT.CATEGORY_IMAGE_FULL_DIR.DS.$old_image )) {
									@unlink(WWW_ROOT.CATEGORY_IMAGE_FULL_DIR.DS.$old_image);
								}								
								$this->Category->id	=	$id;
								$this->Category->saveField('image',$imageName,false);
							}							
						}
						
						
						$p_background_image	=	$this->request->data['Category']['cat_back_image'];
						$old_background_image	=	$this->request->data['Category']['background_image'];
						
						
						if (!empty($p_background_image) && $p_background_image['tmp_name'] != '' && $p_background_image['size'] > 0) {				
							$allowed	=	array('jpg','jpeg','png');
							$temp 		= 	explode(".", $p_background_image["name"]);
							$extension 	= 	end($temp);
							$backgroundImageName 	= 	'category_background_image_'.microtime(true).'.'.$extension;
							$files		=	$p_background_image;							
							$result 	= 	$this->Upload->upload($files, WWW_ROOT . CATEGORY_BACKGROUND_IMAGE_FULL_DIR . DS, $backgroundImageName,'',$allowed);
							
							if(!empty($this->Upload->result) && empty($this->Upload->errors)) {								
								if($old_background_image &&  file_exists(WWW_ROOT.CATEGORY_BACKGROUND_IMAGE_FULL_DIR.DS.$old_background_image )) {
									@unlink(WWW_ROOT.CATEGORY_BACKGROUND_IMAGE_FULL_DIR.DS.$old_background_image);
								}								
								$this->Category->id	=	$id;
								$this->Category->saveField('background_image',$backgroundImageName,false);
							}							
						}
						
						
						$this->Session->setFlash("Record has been added successfully", 'admin_flash_good');
						$this->redirect(array('controller'=>'categories', 'action'=>'index'));
					} 
				} 
			}
			else 
			{
				 $this->Session->setFlash(__('The Category could not be saved. Please, try again.', true), 'admin_flash_bad');
			}	
        } 
		else 
		{
			$this->request->data = $this->Category->read(null, $id);			
		}
	}
	
		
	/*
	@ param : null
	@ return void
	*/
	public function admin_view($id = null){
	
		$this->set('title_for_layout','Category');
		
		$this->Category->id = $id;
		$this->set(compact('id'));
		
		/*check conditions allreday conditions for categories update*/
        if (!$this->Category->exists()) 
		{
            throw new NotFoundException(__('Invalid Category'));
        }		
		$data = $this->Category->read(null, $id);
		$this->set(compact('data'));
	}
	
	/* 
	@ this function are used activated,deactivated and deleted categories by admin
	*/
	public function admin_process() 
	{	
		if (!empty($this->request->data)) 
		{
			if (!isset($this->request->params['_Token']['key']) || ($this->request->params['_Token']['key'] != $this->request->params['_Token']['key'])) 
			{
                $blackHoleCallback = $this->Security->blackHoleCallback;
                $this->$blackHoleCallback();
            }
            $action = $this->request->data['Category']['pageAction'];
            foreach ($this->request->data['Category'] AS $value) 
			{
                if ($value != 0) 
				{
                    $ids[] = $value;
                }
            }
            if (count($this->request->data) == 0 || $this->request->data['Category'] == null) 
			{
                $this->Session->setFlash('No items selected.', 'admin_flash_bad');
                 $this->redirect(array('controller'=>'categories', 'action'=>'index'));
            }

            if ($action == "delete") 
			{	

				$categoryImages	=	$this->Category->find('all',array('fields'=>array('id','image','background_image'),'conditions'=>array('Category.id'=>$ids)));	
				if(!empty($categoryImages)) {
					 
					foreach ($categoryImages as $img) {
						$image		=	$img['Category']['image'];
						if($image &&  file_exists(WWW_ROOT.CATEGORY_IMAGE_FULL_DIR.DS.$image )) {
							@unlink(WWW_ROOT.CATEGORY_IMAGE_FULL_DIR.DS.$image);
						}
						$background_image		=	$img['Category']['background_image'];
						if($background_image &&  file_exists(WWW_ROOT.CATEGORY_BACKGROUND_IMAGE_FULL_DIR.DS.$background_image )) {
							@unlink(WWW_ROOT.CATEGORY_BACKGROUND_IMAGE_FULL_DIR.DS.$background_image);
						}
						
					}
				}
				$this->Category->deleteAll(array('Category.id'=>$ids));				
                $this->Session->setFlash('Categorys have been deleted successfully', 'admin_flash_good');
                $this->redirect(array('controller'=>'categories', 'action'=>'index'));
            }
			
            if ($action == "activate") 
			{				
				$this->Category->updateAll(array('status'=>Configure::read('App.Status.active')),array('Category.id'=>$ids));               
                $this->Session->setFlash('Categorys have been activated successfully', 'admin_flash_good');
                $this->redirect(array('controller'=>'categories', 'action'=>'index'));
            }
			
            if ($action == "deactivate") 
			{			
				$this->Category->updateAll(array('status'=>Configure::read('App.Status.inactive')),array('Category.id'=>$ids));				
                $this->Session->setFlash('Categorys have been deactivated successfully', 'admin_flash_good');
				$this->redirect(array('controller'=>'categories', 'action'=>'index'));
            }
			
        } 
		else 
		{
            $this->redirect(array('controller' => 'categories', 'action' => 'index'));
        }
    }
	
	
	public function admin_delete($id = null) 
	{
		$this->layout = false;
		if (!$id) 
		{
            $this->Session->setFlash(__('Invalid  id', true), 'admin_flash_good');
            $this->redirect(array('action' => 'index'));
        } 
		else 
		{	
			$categoryImage	=	$this->Category->find('first',array('fields'=>array('Category.id','Category.image','Category.background_image'),'conditions'=>array('Category.id'=>$id)));
			
			if(!empty($categoryImage['Category']['image']) &&  file_exists(WWW_ROOT.CATEGORY_IMAGE_FULL_DIR.DS.$categoryImage['Category']['image'] ) )
			{
				@unlink(WWW_ROOT.CATEGORY_IMAGE_FULL_DIR.DS.$categoryImage['Category']['image']);
			}
			if(!empty($categoryImage['Category']['background_image']) &&  file_exists(WWW_ROOT.CATEGORY_BACKGROUND_IMAGE_FULL_DIR.DS.$categoryImage['Category']['background_image'] ) )
			{
				@unlink(WWW_ROOT.CATEGORY_BACKGROUND_IMAGE_FULL_DIR.DS.$categoryImage['Category']['background_image']);
			}
			if ($this->Category->deleteAll(array('Category.id' => $id))) 
			{
                $this->Session->setFlash('Record has been deleted successfully','admin_flash_good');
                $this->redirect($this->referer());
            }
        }
    }
	
	
	
	public function admin_change_featured_status($id = null) {
		
		$get_featured_detail = $this->Category->find('first',array('conditions'=>array('Category.id'=>$id),'fields'=>array('Category.id','Category.featured')));
	
		if($get_featured_detail['Category']['featured'] == 1)
		{
			$this->Category->id = $get_featured_detail['Category']['id'];
			$this->Category->saveField('featured',0);
			 $this->Session->setFlash(__('Admin\'s category featured has been changed'), 'admin_flash_good');
				$this->redirect($this->referer());
		}
		else
		{
			$this->Category->id = $get_featured_detail['Category']['id'];
			$this->Category->saveField('featured',1);
			$this->Session->setFlash(__('Admin\'s category unfeatured was not changed', 'admin_flash_error'));
			$this->redirect($this->referer());
		}
    }
	
	
	
	public function index()
	{
		$this->layout = "front";
		$this->set('title_for_layout','Categories');
		$this->paginate = array('Category' => array(
			'limit' =>Configure::read('App.PageLimit'),
			'order' => array('Category.sorting' => 'ASC'),
			'conditions' => array('Category.status'=>Configure::read('App.Status.active'))
		));
		$category_listing = $this->paginate('Category');
		$this->set('category_listing',$category_listing);
	}
	
	
	
	public function category_detail($id = null)
	{
		
		$this->layout = "lay_channel_detail";
		$this->set('title_for_layout','Category Detail');
		$this->loadModel('Channel');
		$this->loadModel('Stream');
		$this->loadModel('RecordingStream');
		$categoryData = $this->Category->find('first',array('conditions'=>array('Category.id'=>$id)));
		$streams = array();
		$videos = array();
		$channel_ids_array = array();
		$stream_ids_array = array();
		$get_channel_ids_data = $this->Channel->find('all',array('conditions'=>array('Channel.status'=>Configure::read('App.Status.active'),'Channel.category_id'=>$id),'fields'=>array('Channel.id')));
		
		if(!empty($get_channel_ids_data))
		{
				
			foreach($get_channel_ids_data as $channel_key=>$channel_value)
			{
				$channel_ids_array[] = $channel_value['Channel']['id'];
			}
			
			$streams = $this->Stream->find('all',array('conditions'=>array('Stream.status'=>Configure::read('App.Status.active'),'Stream.channel_id'=>$channel_ids_array),'fields'=>array('Stream.stream_image','Stream.title','Stream.id','Stream.channel_id')));
			
			if(!empty($streams))
			{
				foreach($streams as $stream_key=>$stream_value)
				{
					$stream_ids_array[] = $stream_value['Stream']['id'];
				}
			}
			
			$videos = $this->RecordingStream->find('all',array('conditions'=>array('RecordingStream.status'=>Configure::read('App.Status.active'),'RecordingStream.stream_id'=>$stream_ids_array),'fields'=>array('RecordingStream.image','RecordingStream.title','RecordingStream.id','RecordingStream.stream_id')));
			
		}
		$this->set(compact('categoryData','streams','id','videos'));
	}
	
	
	
	public function category_detail_ajax_tab($id = null)
	{
		
		$this->layout = false;
		$this->autoRender = false;
		
		if ($this->RequestHandler->isAjax()) {
			
			$this->loadModel('Channel');
			$this->loadModel('Stream');
			$this->loadModel('RecordingStream');
			$categoryData = $this->Category->find('first',array('conditions'=>array('Category.id'=>$id)));
			$streams = array();
			$videos = array();
			$channel_ids_array = array();
			$stream_ids_array = array();
			$get_channel_ids_data = $this->Channel->find('all',array('conditions'=>array('Channel.status'=>Configure::read('App.Status.active'),'Channel.category_id'=>$id),'fields'=>array('Channel.id')));
			if(!empty($get_channel_ids_data))
			{
					
				foreach($get_channel_ids_data as $channel_key=>$channel_value)
				{
					$channel_ids_array[] = $channel_value['Channel']['id'];
				}
				
				$streams = $this->Stream->find('all',array('conditions'=>array('Stream.status'=>Configure::read('App.Status.active'),'Stream.channel_id'=>$channel_ids_array),'fields'=>array('Stream.stream_image','Stream.title','Stream.id','Stream.channel_id')));
				
				if(!empty($streams))
				{
					foreach($streams as $stream_key=>$stream_value)
					{
						$stream_ids_array[] = $stream_value['Stream']['id'];
					}
				}
				
				$videos = $this->RecordingStream->find('all',array('conditions'=>array('RecordingStream.status'=>Configure::read('App.Status.active'),'RecordingStream.stream_id'=>$stream_ids_array),'fields'=>array('RecordingStream.image','RecordingStream.title','RecordingStream.id')));
				
			}
			$this->set(compact('categoryData','streams','id','videos'));
			$this->render('/Elements/Front/Category/ele_stream_videos');
		}	
	}
	public function admin_ajax_categories_sorting() { 
        if ($this->request->data['sort'] && is_array($this->request->data['sort'])) {
            foreach ($this->request->data['sort'] as $key => $value) {
              	
				$this->request->data['Category']['id'] = $value;
				$this->request->data['Category']['sorting'] = $key;			
				$this->Category->save($this->request->data);		
				
            }
        }
        die(json_encode(array("status" => "success")));
    }
	
	
	
	
}
