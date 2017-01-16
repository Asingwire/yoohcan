<?php
/**
 * Country
 *
 * PHP version 5
 *
 * @category Model 
 * 
 */
 
class EmailTemplate extends AppModel{
	/**
	 * Model name
	 * @var string
	 * @access public
	 */
	var $name = 'EmailTemplate';
	/**
	 * Behaviors used by the Model
	 *
	 * @var array
	 * @access public
	 */
    /* var $actsAs = array(        
        'Multivalidatable'
    );	 */
	
	var $actsAs = array(
        'Multivalidatable'
    );
	
	
	/**
     * Custom validation rulesets
     */	
	 
	 
	var $validationSets = array(
		'add'=>	array(		
			'title'=>array(
				'R1'=>array(
							'rule'=>'notEmpty',
							'message' => 'Title is required.'
				),
				'maxLength'=>array(
					  'rule'=>array('maxLength', 50),
					  'message'=>'Title can not be more than 50 characters long'
                ),
				'isUnique'	=>	array(
					'rule'	=>	'isUnique',
					'message'	=>	'Title already exists.'
				),
			),
			'subject'=>array(
				'R1'=>array(
							'rule'=>'notEmpty',
							'message' => 'Subject is required.'
				),
				'maxLength'=>array(
					  'rule'=>array('maxLength', 255),
					  'message'=>'Subject can not be more than 255 characters long'
                )
			),
			'description'=>array(
				'R1'=>array(
							'rule'=>'notEmpty',
							'message' => 'Description is required.'
				)
			)
		),
		'update'=>	array(		
			'title'=>array(
				'R1'=>array(
							'rule'=>'notEmpty',
							'message' => 'Title is required.'
				),
				'maxLength'=>array(
					  'rule'=>array('maxLength', 50),
					  'message'=>'Title can not be more than 50 characters long'
                ),
			),
			'subject'=>array(
				'R1'=>array(
							'rule'=>'notEmpty',
							'message' => 'Subject is required.'
				),
				'maxLength'=>array(
					  'rule'=>array('maxLength', 255),
					  'message'=>'Subject can not be more than 255 characters long'
                )
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