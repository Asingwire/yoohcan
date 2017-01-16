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
class Admin extends AppModel{

	//public $primaryKey = '_id';
	
	/**
	 * Model name
	 * @var string
	 * @access public
	 */
	var $name = 'Admin';
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
			'first_name'=>array(
				'notEmpty'=>array(
					'rule'=>'notEmpty',
					'message' => 'First name is required.'
				)
			),		
			'last_name'=>array(
				'notEmpty'=>array(
					'rule'=>'notEmpty',
					'message' => 'Last name is required.'
				)
			),		
			'username'=>array(
				'R1'=>array(
					'rule'=>'notEmpty',
					'message' => 'Username is required.'
				)
			),
			'email'=>array(
				'notEmpty' => array(
					'rule' 		=> 'notEmpty',
					'message' 	=>	'Email is required'
				),
				'isUnique'	=>	array(
					'rule'	=>	'isUnique',
					'message'	=>	'Email already exists.'
				),
				'email'	=>	array(
					'rule'	=>	'email',
					'message'	=>	'Please provide a valid email address.'
				),
			),
			'new_password'=>array(
				'R1'=>array(
					'rule'=>'notEmpty',
					'message' => 'Password is required.'
				), 
				'R3'=>array(
					'rule'=>array('minLength', 6),
					'message'=>'Password must be at least 6 characters long.' 
				),
				'R4'=>array(
					'rule'=>array('maxLength', 20),
					'message'=>'Password must be at least 20 characters long.' 
				),
				/* 'R5'=>array(
					'rule'=>'((?=.*[A-Z])(?=.*[a-z]))',
					'message'=>'Your password must contain at least 1 capital letter and 1 small letter!'
				) */
			   				
			)
		),
		'update'=>	array(		
			'first_name'=>array(
				'R1'=>array(
							'rule'=>'notEmpty',
							'message' => 'First Name is required.'
				)
			),
			'last_name'=>array(
				'R1'=>array(
							'rule'=>'notEmpty',
							'message' => 'Last Name is required.'
				)
			),
			'email'=>array(
				'R1'=>array(
							'rule'=>'notEmpty',
							'message' => 'Email Name is required.'
				),
				'isUnique'	=>	array(
					'rule'	=>	'isUnique',
					'message'	=>	'Email already exists.'
				),
				'email'	=>	array(
					'rule'	=>	'email',
					'message'	=>	'Please provide a valid email address.'
				),
			)
		),
		'change_password'=>	array(
			'old_password'=>array(
			   'R1'=>array(
					'rule'=>'notEmpty',
					'message' => 'Old password is required.'
				),
				'checkOldPassword' => array(
					'rule' => array('checkOldPassword', 'old_password'),
					'message' => 'Old password is wrong.'
				),	
			),
			'new_password'=>array(
				'R1'=>array(
					'rule'=>'notEmpty',
					'message' => 'New password is required.'
				), 
				'R3'=>array(
					'rule'=>array('minLength', 6),
					'message'=>'Password must be at least 6 characters long.' 
				),
				'R4'=>array(
					'rule'=>array('maxLength', 20),
					'message'=>'Password must be at least 20 characters long.' 
				),
				/* 'R5'=>array(
					'rule'=>'((?=.*[A-Z])(?=.*[a-z]))',
					'message'=>'Your password must contain at least 1 capital letter and 1 small letter!'
				)  */	
			),
			 'confirm_password'=>array(
				'identicalFieldValues' => array(
					'rule' => array('identicalFieldValues', 'new_password' ),
					'message' => 'Password and confirm password mismatch.'
				),
				'R1'=>array(
				   'rule'=>'notEmpty',
				   'message' => 'Confirm password is required.'
				),
				/* 'R3'=>array(
					'rule'=>array('minLength', 6),
					'message'=>'Passwords must be at least 6 characters long.' 
				),
				'R4'=>array(
					'rule'=>array('maxLength', 20),
					'message'=>'Passwords must be at least 20 characters long.' 
				), */				
			),
			
		),
	);
	
	
	public function checkOldPassword( $field = array(), $password = null ) {	
		$userId =  AuthComponent::user('id');
		$count	=	$this->find('count',array('conditions'=>array(
											'Admin.password'=>Security::hash($this->data[$this->name][$password], null, true),
											'Admin.id'=>$userId
											)));
		if($count == 1){
			return true;
		}else{
			return false;
		} 
    }
	public function identicalFieldValues( $field=array(), $compare_field=null ){
    	
        foreach( $field as $key => $value ){
            $v1 = $value;
            $v2 = $this->data[$this->name][$compare_field ];  
                   
            if($v1 !== $v2) {
                return false;
            } else {
                continue;
            }
        }
        return true;
    }
	
}