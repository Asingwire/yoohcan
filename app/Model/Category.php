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
class Category extends AppModel{

	//public $primaryKey = '_id';
	
	/**
	 * Model name
	 * @var string
	 * @access public
	 */
	var $name = 'Category';
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
		'add'=>	array(
			'name'=>array(
				'R1'=>array(
					'rule'=>'notEmpty',
					'message' => 'Category Name is required.'
				)
			),			
		),
		'edit'=>	array(
			'name'=>array(
				'R1'=>array(
					'rule'=>'notEmpty',
					'message' => 'Category Name is required.'
				)
			),			
		),
	);
}