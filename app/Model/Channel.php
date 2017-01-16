<?php
/**
 * Country
 *
 * PHP version 5
 *
 * @category Model 
 * 
 */
// App::uses('AuthComponent', 'Controller/Component');
// App::uses('SessionComponent', 'Controller/Component');
App::uses('AppModel', 'Model');
class Channel extends AppModel{

	//public $primaryKey = '_id';
	
	/**
	 * Model name
	 * @var string
	 * @access public
	 */
	var $name = 'Channel';
	/**
	 * Behaviors used by the Model
	 *
	 * @var array
	 * @access public
	 */
   
	var $actsAs = array(
       'Multivalidatable'
    );
	
			
	var $validationSets = array(
			'channel_add' => array(
				'name' => array(
					'notEmpty' => array(
						'rule' => 'notEmpty',
						'message' => 'Channel name is required.'
					)
				),'company' => array(
					'notEmpty' => array(
						'rule' => 'notEmpty',
						'message' => 'Company name is required.'
					)
				),
				'website' => array(
					'rule' => '/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i',
					'allowEmpty' => true,
					'message'	=> 'Please enter the valid url.'
				)/* ,'bio' => array(
					'notEmpty' => array(
						'rule' => 'notEmpty',
						'message' => 'Enter biography'
					)
				) */,
				'category_id' => array(
					'notEmpty' => array(
						'rule' => 'notEmpty',
						'message' => 'Category is required.'
					)
				)
			)
	);
	
	
	function toggleStatus($id = null)
	{
		$this->id = $id;
		$status = $this->field('status');
		$status = $status?0:1;
		return $this->saveField('status',$status);
	}
	
	
	
}