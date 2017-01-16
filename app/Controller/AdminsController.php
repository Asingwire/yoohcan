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
 
class AdminsController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Admins';

/**
 * This controller use a model admins
 *
 * @var array
 */
	public $uses = array('Admin','User');

	
    /*
     *  @function name		:	beforeFilter
     *  @Description        :	Execute first before any action in this controller
     *  @author				:	kanhaiya and shryeas
     */

    public function beforeFilter() {
	
        parent::beforeFilter();
		
		if (in_array($this->params['action'], array('admin_login'))) {
            $this->Security->validatePost = false;
        }
		
        // CSRF Protection
       /*  if (in_array($this->params['action'], array('admin_dashboard'))) {
            $this->Security->validatePost = false;
        } */
       
	}
	
	/* public function admin_index() {
		echo time();die;
	}
 */
	
	public function admin_login() {
		
		if (!empty($this->request->data)) {
			if ($this->Auth->login()) { 
				$this->redirect(array('admin' => true, 'controller' => 'admins', 'action' => 'dashboard'));
			} else {
			
				if ($this->request->is('post')) {
					$this->Session->setFlash(__('Invalid email or password, try again'));
				}
			} 
		}
		
		$this->set('title_for_layout','Welcome admin login');
		$this->layout = 'admin_login';
	}
	
	/**
	 * This controller use a model admins
	 *
	 * @var null
	 * @return void
	 */
	 
	public function admin_dashboard(){
	
		$this->set('title_for_layout','Dashboard');
		
		$userCount	=	$this->User->find('count');
		$this->set('userCount',$userCount);
		
		$this->loadModel('EmailTemplate');
		$emailTemplateCount	=	$this->EmailTemplate->find('count');
		$this->set('emailTemplateCount',$emailTemplateCount);
		
		$this->loadModel('Stream');
		$streamCount	=	$this->Stream->find('count');
		$this->set('streamCount',$streamCount);
		
		$this->loadModel('Channel');
		$channelCount	=	$this->Channel->find('count');
		$this->set('channelCount',$channelCount);
		
		$this->loadModel('RecordingStream');
		$videoCount	=	$this->RecordingStream->find('count');
		$this->set('videoCount',$videoCount);
		
		$this->loadModel('StaticPage');
		$staticPagesCount	=	$this->StaticPage->find('count');
		$this->set('staticPagesCount',$staticPagesCount);
		
		$this->loadModel('Plan');
		$planCount	=	$this->Plan->find('count');
		$this->set('planCount',$planCount);
		
		$this->loadModel('Transaction');
		$transactionCount	=	$this->Transaction->find('count');
		$this->set('transactionCount',$transactionCount);
		
		
		$this->loadModel('Category');
		$CategoryCount	=	$this->Category->find('count');
		$this->set('CategoryCount',$CategoryCount);
				
	}
	/*
	@this function is used to admin log out and all session destory
	*/
    public function admin_logout() {
		
		$this->Session->delete('Auth.Admin');
		$this->Session->destroy();		
		$this->redirect($this->Auth->logout());
    }
	/*
	@ param : null
	@ return void
	*/
	public function admin_change_password() {
		
		$this->set('title_for_layout','Change Password');
		
		if(!empty($this->request->data)){
			if (!isset($this->request->params['_Token']['key']) || ($this->request->params['_Token']['key'] != $this->request->params['_Token']['key'])) {
				$blackHoleCallback = $this->Security->blackHoleCallback;
				$this->$blackHoleCallback();
            }
			//validate user data
			$this->Admin->set($this->request->data);
			$this->Admin->setValidation('change_password');
			
			if ($this->Admin->validates()) {
				
				/******update users info and redirect page action******/
				$this->request->data['Admin']['id']       = $this->Auth->user('id');
				$this->request->data['Admin']['password'] = Security::hash($this->request->data['Admin']['new_password'], null, true);
				
				if ($this->Admin->save($this->request->data)) {
					
					$this->Session->setFlash('The password has been updated successfully', 'admin_flash_good');
					$this->redirect(array('action' => 'dashboard'));
					
				} else {
					$this->Session->setFlash('The password could not be saved. Please, try again.', 'admin_flash_bad');
				} 
			} else{
				$this->Session->setFlash('The password could not be saved. Please, try again.', 'admin_flash_bad');
			}
		}
	}
	
	
	/*
     * List all admins in admin panel
     */

    public function admin_index() {
		
		$this->loadModel('Admin');
		
		 if (!isset($this->params['named']['page'])) {
            $this->Session->delete('AdminSearch');
        }
		
		$filters		=	array('Admin.role_id'=>1);
		$this->paginate = array('Admin' => array(
                'limit' =>Configure::read('App.PageLimit'),
                'order' => array('Admin.id' => 'desc'),
                'conditions' => $filters,
				'recursive'=>2
        ));
		$data = $this->paginate('Admin');
		$this->set(compact('data'));
		$this->set('title_for_layout', __('Admin', true));
		
		
    }
	
	/*
	@ param : null
	@ return void
	*/
	public function admin_edit($id = null){
	
		$this->set('title_for_layout','Admin');
		
		$this->Admin->id = $id;
		$this->set(compact('id'));
		
		/*check conditions allreday conditions for users update*/
        if (!$this->Admin->exists()) {
            throw new NotFoundException(__('Invalid Admin'));
        }
		/*form post and check conditions*/
		if ($this->request->is('post') || $this->request->is('put')) {
			if (!empty($this->request->data)) {
                if (!isset($this->request->params['_Token']['key']) || ($this->request->params['_Token']['key'] != $this->request->params['_Token']['key'])) {
					$blackHoleCallback = $this->Security->blackHoleCallback;
                    $this->$blackHoleCallback();
                }
				
				$this->Admin->set($this->request->data['Admin']);
				$this->Admin->setValidation('update');
				
				if ($this->Admin->save($this->data)) {								
					$this->Session->setFlash("Record has been updated",'admin_flash_good');
					$this->redirect(array('controller'=>'admins', 'action'=>'index'));		
				} else {
					$this->Session->setFlash("Record has not been updated", 'admin_flash_bad');
				}
            }
        }else{			
			$this->request->data = $this->Admin->read(null, $id);			
		}
	}	
}