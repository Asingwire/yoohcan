<?php
/**
 * StaticPage
 *
 * PHP version 5
 *
 * @category Model 
 * 
 */
// App::uses('AuthComponent', 'Controller/Component');
// App::uses('SessionComponent', 'Controller/Component');
App::uses('AppModel', 'Model');
class StaticPage extends AppModel{

	//public $primaryKey = '_id';
	
	/**
	 * Model name
	 * @var string
	 * @access public
	 */
	var $name = 'StaticPage';
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
			'title'=>array(
				'R1'=>array(
					'rule'=>'notEmpty',
					'message' => 'Title is required.'
				),
				'isUnique'	=>	array(
					'rule'	=>	'isUnique',
					'message'	=>	'Title already exists.'
				),
			),
			'description'=>array(
				'R1'=>array(
					'rule'=>'notEmpty',
					'message' => 'Description is required.'
				)
			)
		),
	);
	
	
}