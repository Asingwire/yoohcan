<?php
/**
 * Static content controller.
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
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */

App::uses('Sanitize', 'Utility');
class EmailTemplatesController extends AppController {



/**
 * Controller name
 *
 * @var string
 */
	public $name = 'EmailTemplates';

/**
 * This controller use a model admins
 *
 * @var array
 */
	public $uses = array('EmailTemplate');
	
	
	public $component  =array('General');
	/*
	@ param : null
	@ return void
	*/
	
	
	public function admin_add() {
		$this->set('title_for_layout','Email Templates');
		
		if(!empty($this->request->data)){
			if (!isset($this->request->params['_Token']['key']) || ($this->request->params['_Token']['key'] != $this->request->params['_Token']['key'])) {
				$blackHoleCallback = $this->Security->blackHoleCallback;
				$this->$blackHoleCallback();
            }
			
			//validate user data
			$this->EmailTemplate->set($this->request->data['EmailTemplate']);
			$this->EmailTemplate->setValidation('add');
			
			$this->request->data['EmailTemplate']['slug']	=	$this->createSlug($this->request->data['EmailTemplate']['title']);
			
			if ($this->EmailTemplate->saveAll($this->request->data,array('validate'=>'first'))) {						
				$this->Session->setFlash("Record has been added successfully", 'admin_flash_good');
				$this->redirect(array('controller'=>'email_templates', 'action'=>'index'));
		
			} else {
				$this->Session->setFlash("Record has not been created", 'admin_flash_bad');
			}
		
		}
	}
	
	
	function createSlug($string = null){
		$slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
		return strtolower($slug);
	
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
           if (isset($this->request->data['EmailTemplate']['title']) && $this->request->data['EmailTemplate']['title'] != '') {
                $title = trim($this->request->data['EmailTemplate']['title']);
                $this->Session->write('AdminSearch.title', $title);
				
            }
		}
		
		if ($this->Session->check('AdminSearch')) {
            $keywords 	= 	$this->Session->read('AdminSearch');
			$filters	= 	array('EmailTemplate.title LIKE' => "%".$this->Session->read('AdminSearch.title')."%");
		}
		
		$this->paginate = array('EmailTemplate' => array(
                'limit' =>Configure::read('App.PageLimit'),
                'order' => array('EmailTemplate.sorting' => 'ASC'),
                'conditions' => $filters,
				'recursive'=>2
        ));
		
		
		$data = $this->paginate('EmailTemplate');
		
		
		$this->set(compact('data'));
		$this->set('title_for_layout', __('EmailTemplate', true));
	}

	
		
	/*
	@ param : null
	@ return void
	*/
	public function admin_edit($id = null){
	
		$this->set('title_for_layout','EmailTemplate');
		
		$this->EmailTemplate->id = $id;
		$this->set(compact('id'));
		
		/*check conditions allreday conditions for users update*/
        if (!$this->EmailTemplate->exists()) {
            throw new NotFoundException(__('Invalid EmailTemplate'));
        }
		/*form post and check conditions*/
		if ($this->request->is('post') || $this->request->is('put')) {
			if (!empty($this->request->data)) {
                if (!isset($this->request->params['_Token']['key']) || ($this->request->params['_Token']['key'] != $this->request->params['_Token']['key'])) {
					$blackHoleCallback = $this->Security->blackHoleCallback;
                    $this->$blackHoleCallback();
                }
				
				$this->EmailTemplate->set($this->request->data['EmailTemplate']);
				$this->EmailTemplate->setValidation('update');
				
				if ($this->EmailTemplate->save($this->data)) {								
					$this->Session->setFlash("Record has been updated",'admin_flash_good');
					$this->redirect(array('controller'=>'email_templates', 'action'=>'index'));		
				} else {
					$this->Session->setFlash("Record has not been updated", 'admin_flash_bad');
				}
            }
        }else{
			
			$this->request->data = $this->EmailTemplate->read(null, $id);
			
		}
	}
	 /* 
	@ this function are used deactivate and delte by admin user
	*/
	public function admin_process() {
	
		if (!empty($this->request->data)) {
			if (!isset($this->request->params['_Token']['key']) || ($this->request->params['_Token']['key'] != $this->request->params['_Token']['key'])) {
                $blackHoleCallback = $this->Security->blackHoleCallback;
                $this->$blackHoleCallback();
            }
           // $action = Sanitize::escape($this->request->data['EmailTemplate']['pageAction']);
            $action = $this->request->data['EmailTemplate']['pageAction'];
            foreach ($this->request->data['EmailTemplate'] AS $value) {
                if ($value != 0) {
                    $ids[] = $value;
                }
            }

			
            if (count($this->request->data) == 0 || $this->request->data['EmailTemplate'] == null) {
                $this->Session->setFlash('No items selected.', 'admin_flash_bad');
                 $this->redirect(array('controller'=>'email_templates', 'action'=>'index'));
            }

            if ($action == "delete") {
				
				foreach ($ids AS $id) {
					 $this->EmailTemplate->delete($id);
				}
				/* $this->EmailTemplate->deleteAll(array('EmailTemplate.id' => $ids)); */
                $this->Session->setFlash('Email templates have been deleted successfully', 'admin_flash_good');
                $this->redirect(array('controller'=>'email_templates', 'action'=>'index'));
            }
            if ($action == "activate") {
			
				foreach ($ids AS $id) {
					 $this->EmailTemplate->id	=	$id;
					 $this->EmailTemplate->saveField('status',Configure::read('App.Status.active'));
				}
               /*  $this->EmailTemplate->updateAll(array('EmailTemplate.status' => Configure::read('App.Status.active')), array('EmailTemplate.id' => $ids)); */
                $this->Session->setFlash('Email templates have been activated successfully', 'admin_flash_good');
                $this->redirect(array('controller'=>'email_templates', 'action'=>'index'));
            }
            if ($action == "deactivate") {
			
				foreach ($ids AS $id) {
					 $this->EmailTemplate->id	=	$id;
					 $this->EmailTemplate->saveField('status',Configure::read('App.Status.inactive'));
				}
				/*   $this->EmailTemplate->updateAll(array('status' => Configure::read('App.Status.inactive')), array('id' => $ids));*/
		
                $this->Session->setFlash('Email templates have been deactivated successfully', 'admin_flash_good');
				$this->redirect(array('controller'=>'email_templates', 'action'=>'index'));
            }
        }else{
            $this->redirect(array('controller' => 'email_templates', 'action' => 'index'));
        }
    }
	
	public function admin_delete($id = null) {
		if (!$id) {
            $this->Session->setFlash(__('Invalid  id', true), 'admin_flash_good');
            $this->redirect(array('action' => 'index'));
        } else {
			
            $this->EmailTemplate->delete($id);
			$this->Session->setFlash('Record has been deleted successfully','admin_flash_good');
			$this->redirect(array('action'=>'index'));
        }
    }
	public function admin_ajax_email_template_sorting() { 
        if ($this->request->data['sort'] && is_array($this->request->data['sort'])) {
            foreach ($this->request->data['sort'] as $key => $value) {
              	
				$this->request->data['EmailTemplate']['id'] = $value;
				$this->request->data['EmailTemplate']['sorting'] = $key;			
				$this->EmailTemplate->save($this->request->data);		
				
            }
        }
        die(json_encode(array("status" => "success")));
    }

}
