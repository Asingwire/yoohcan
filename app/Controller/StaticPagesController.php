<?php
/**
 * StaticPages content controller.
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
 * StaticPages content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */

App::uses('Sanitize', 'Utility');
class StaticPagesController extends AppController {



/**
 * Controller name
 *
 * @var string
 */
	public $name = 'StaticPages';

/**
 * This controller use a model admins
 *
 * @var array
 */
	public $uses 		= array('StaticPage');
	
	public $helpers 	= array('Html', 'Session','General');
	var $components = 	array('General',"Upload");
	
	public function beforeFilter() {
	    parent::beforeFilter();
        $this->Auth->allow('page');
    }
	
	public function admin_add() {
		
		$this->set('title_for_layout','StaticPages');
		
		if(!empty($this->request->data)){
			
			if (!isset($this->request->params['_Token']['key']) || ($this->request->params['_Token']['key'] != $this->request->params['_Token']['key'])) {
				$blackHoleCallback = $this->Security->blackHoleCallback;
				$this->$blackHoleCallback();
            }
			
			//validate user data
			$this->StaticPage->set($this->request->data);
			$this->StaticPage->setValidation('add');
			
			if($this->StaticPage->validates()) {
				
				$slug = $this->stringToSlug($this->request->data['StaticPage']['title']);
				$this->request->data['StaticPage']['slug'] = $slug;
				
				if ($this->StaticPage->save($this->request->data,false)) {	
					$this->Session->setFlash("Record has been added successfully", 'admin_flash_good');
					$this->redirect(array('controller'=>'static_pages', 'action'=>'index'));
				} else {
					$this->Session->setFlash("Record has not been created", 'admin_flash_bad');
				}
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
           if (isset($this->request->data['StaticPage']['title']) && $this->request->data['StaticPage']['title'] != '') {
                $title = trim($this->request->data['StaticPage']['title']);
                $this->Session->write('AdminSearch.title', $title);
				
            }
		}
		
		if ($this->Session->check('AdminSearch')) {
            $keywords 	= 	$this->Session->read('AdminSearch');
			$filters	= 	array('StaticPage.title LIKE' => "%".$this->Session->read('AdminSearch.title')."%");
		}
		
		$this->paginate = array('StaticPage' => array(
                'limit' =>Configure::read('App.PageLimit'),
                'order' => array('StaticPage.title' => 'ASC'),
                'conditions' => $filters,
        ));
		
		$data = $this->paginate('StaticPage');
		
		$this->set(compact('data'));
		$this->set('title_for_layout', __('StaticPage', true));
	}

		
	/*
	@ param : null
	@ return void
	*/
	public function admin_edit($id = null){
	
		$this->set('title_for_layout','StaticPage');
		$this->StaticPage->id 	= 	$id;
		
		/*check conditions allreday conditions for StaticPage update*/
        if (!$this->StaticPage->exists()) {
            throw new NotFoundException(__('Invalid StaticPage'));
        }
		/*form post and check conditions*/
		if ($this->request->is('post') || $this->request->is('put')) {
			
			if (!empty($this->request->data)) {
				
				if (!isset($this->request->params['_Token']['key']) || ($this->request->params['_Token']['key'] != $this->request->params['_Token']['key'])) {
					$blackHoleCallback = $this->Security->blackHoleCallback;
					$this->$blackHoleCallback();
				}
			
				//validate user data
				$this->StaticPage->set($this->request->data['Admin']);
				$this->StaticPage->setValidation('add');
				
				if ($this->StaticPage->validates()) {	
					if ($this->StaticPage->save($this->request->data,false)) {	
					
						$this->Session->setFlash("Record has been added successfully", 'admin_flash_good');
						$this->redirect(array('controller'=>'static_pages', 'action'=>'index'));
				
					}
				}
			}
			
        } else {
			$this->request->data = $this->StaticPage->read(null, $id);
			
		}
	}
	
	/* 
	@ this function are used activated,deactivated and deleted static_pages by admin
	*/
	public function admin_process() {
	
		if (!empty($this->request->data)) {
			if (!isset($this->request->params['_Token']['key']) || ($this->request->params['_Token']['key'] != $this->request->params['_Token']['key'])) {
                $blackHoleCallback = $this->Security->blackHoleCallback;
                $this->$blackHoleCallback();
            }
			
           // $action = Sanitize::escape($this->request->data['User']['pageAction']);
            $action = $this->request->data['StaticPage']['pageAction'];
            foreach ($this->request->data['StaticPage'] AS $value) {
                if ($value != 0) {
                    $ids[] = $value;
                }
            }

			
            if (count($this->request->data) == 0 || $this->request->data['StaticPage'] == null) {
                $this->Session->setFlash('No items selected.', 'admin_flash_bad');
                 $this->redirect(array('controller'=>'static_pages', 'action'=>'index'));
            }
			
            if ($action == "delete") {
				
				$this->StaticPage->deleteAll(array('StaticPage.id'=>$ids));
				
                $this->Session->setFlash('Static Pages have been deleted successfully', 'admin_flash_good');
                $this->redirect(array('controller'=>'static_pages', 'action'=>'index'));
            }
			
            if ($action == "activate") {
			
				$this->StaticPage->updateAll(array('StaticPage.status'=>Configure::read('App.Status.active')),array('StaticPage.id'=>$ids));
               
                $this->Session->setFlash('Static Pages have been activated successfully', 'admin_flash_good');
                $this->redirect(array('controller'=>'static_pages', 'action'=>'index'));
            }
			
            if ($action == "deactivate") {
				
				$this->StaticPage->updateAll(array('StaticPage.status'=>Configure::read('App.Status.inactive')),array('StaticPage.id'=>$ids));
               
                $this->Session->setFlash('Static Pages have been deactivated successfully', 'admin_flash_good');
				$this->redirect(array('controller'=>'static_pages', 'action'=>'index'));
            }
			
        } else {
            $this->redirect(array('controller' => 'static_pages', 'action' => 'index'));
        }
    }
	
	
	public function admin_delete($id = null) {
		
		if (!$id) {
            $this->Session->setFlash(__('Invalid  id', true), 'admin_flash_good');
            $this->redirect(array('action' => 'index'));
        } else {
			
			$this->StaticPage->delete($id);
			
			$this->Session->setFlash('Record has been deleted successfully','admin_flash_good');
			$this->redirect(array('action'=>'index'));
        }
    }
	
	public function page($slug = null) {
		$this->layout = 'lay_dashboard';
		
		App::import('Sanitize');
		
		$slug = $this->params['slug'];
		//$slug = $this->params['named']['slug'];
		$data	=	$this->StaticPage->find('first',array('conditions'=>array('StaticPage.slug'=>$slug)));
		$this->set(compact('data'));
		
    }
	public function admin_ajax_static_page_sorting() {
        if ($this->request->data['sort'] && is_array($this->request->data['sort'])) {
            foreach ($this->request->data['sort'] as $key => $value) {
              	
				$this->request->data['StaticPage']['id'] = $value;
				$this->request->data['StaticPage']['sorting'] = $key;			
				$this->StaticPage->save($this->request->data);		
				
            }
        }
        die(json_encode(array("status" => "success")));
    }
	
	
	function stringToSlug($str) {
		// trim the string
		$str = strtolower(trim($str));
		// replace all non valid characters and spaces with an underscore
		$str = preg_replace('/[^a-z0-9-]/', '-', $str);
		$str = preg_replace('/-+/', "-", $str);
	return $str;
	}
	
}
