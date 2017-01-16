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
class User extends AppModel{

	//public $primaryKey = '_id';
	
	/**
	 * Model name
	 * @var string
	 * @access public
	 */
	var $name = 'User';
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
		
	 /* USED in FRONT REGISTRATION ADDED BY KAILASH*/
		'front_registration' => array(
			'first_name' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'First name is required.'
                )/* ,
				'between' => array(
					'rule' => array('between', 1, 20),
					'message' => 'First name should be between 1 to 20 characters'
				), 
				'characters' => array(
					'rule' => array('custom', '/^[a-z0-9 ]*$/i'),
					'allowEmpty' => true,
					'message'  => 'Please enter valid first name'
				) ,*/
            ),
			'last_name' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Last name is required.'
                )/* ,
				'between' => array(
					'rule' => array('between', 1, 20),
					'message' => 'Last name should be between 1 to 20 characters'
				), 
				'characters' => array(
					'rule' => array('custom', '/^[a-z0-9 ]*$/i'),
					'message'  => 'Please enter valid last name'
				) */
            ),'nickname' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Nickname is required.'
                )/* ,
				'between' => array(
					'rule' => array('between', 1, 20),
					'message' => 'Last name should be between 1 to 20 characters'
				), 
				'characters' => array(
					'rule' => array('custom', '/^[a-z0-9 ]*$/i'),
					'message'  => 'Please enter valid last name'
				) */
            ),
			'email' => array(
				'notEmpty' => array(
					'rule' => 'notEmpty',
					'message' => 'Email address is required.'
				),
				'isUnique' => array(
					'rule' => 'isUnique',
					'message' => 'Email address already exists.'
				),
				'email' => array(
					'rule' => 'email',
					'message' => 'Please enter valid email address.'
				),
				'maxlength' => array(
					'rule'	=> 	array('maxlength', 50),
					'message'	=>	'Phone no long from 50 character.'
				),
				'checkWhiteSpace' => array(
					'rule' => array('checkWhiteSpace', 'email'),
					'message' => 'Email address should not have white space at both ends.'
				)
			),
			'password_new' => array(   
		        'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Password is required.'
                ),
				'between' => array(
					'rule' => array('between', 6, 15),
					'message' => 'Password must be of at least 6 characters, should not exceed 15 characters.'
				),
            ),'confirm_password'=>array(
				'identicalFieldValues' => array(
                    'rule' => array('identicalFieldValues', 'password_new'),
                    'message' => 'Password and  confirm password does not match.'
                ),
                'R1' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Confirm password is required.'
                )			
			),
			
			 'accept_policy' => array(
                'notEmpty' => array(
                    'rule'     => array('comparison', '!=', 0),
                    'required' => true,
                    'message'  => 'Please check this box if you want to proceed.'
                )
			),
        ),
		'general_info'=>	array(
			'nickname'=>array(
				'notEmpty' => array(
					'rule' 		=> 'notEmpty',
					'message' 	=>	'Nickname is required.'
				),
				'isUnique'	=>	array(
					'rule'	=>	'isUnique',
					'message'	=>	'Nickname already exists.'
				)
			),
			'first_name'=>array(
				'notEmpty' => array(
					'rule' 		=> 'notEmpty',
					'message' 	=>	'First name is required.'
				)
			),
			'last_name'=>array(
				'notEmpty' => array(
					'rule' 		=> 'notEmpty',
					'message' 	=>	'Last name is required.'
				)
			),
			'email'=>array(				
				'isUnique'	=>	array(
					'rule'	=>	'isUnique',
					'message'	=>	'Email address already exists.'
				)
			),
			'password_new' => array( 
				'between' => array(
					'rule' => array('between',6, 15),
					'message' => 'Password must be of at least 6 characters, should not exceed 15 characters',
					'allowEmpty' => true
				), 
            ),'confirm_password'=>array(
				'identicalFieldValues' => array(
                    'rule' => array('identicalFieldValues', 'password_new'),
                    'message' => 'Password and  confirm password does not match.'
                )			
			)	
		),	
		'add'=>	array(
			'nickname'=>array(
				'notEmpty' => array(
					'rule' 		=> 'notEmpty',
					'message' 	=>	'Nickname is required.'
				),
				'isUnique'	=>	array(
					'rule'	=>	'isUnique',
					'message'	=>	'Nickname already exists.'
				)
			),
			'first_name'=>array(
				'notEmpty' => array(
					'rule' 		=> 'notEmpty',
					'message' 	=>	'First name is required.'
				)
			),
			'last_name'=>array(
				'notEmpty' => array(
					'rule' 		=> 'notEmpty',
					'message' 	=>	'Last name is required.'
				)
			),
			'nickname'=>array(
				'notEmpty' => array(
					'rule' 		=> 'notEmpty',
					'message' 	=>	'Nickname is required.'
				),
				'isUnique'	=>	array(
					'rule'	=>	'isUnique',
					'message'	=>	'Nickname already exists.'
				)
			),
			'email'=>array(
				'notEmpty' => array(
					'rule' 		=> 'notEmpty',
					'message' 	=>	'Email address is required.'
				),
				'isUnique'	=>	array(
					'rule'	=>	'isUnique',
					'message'	=>	'Email already exists.'
				),
				'email'	=>	array(
					'rule'	=>	'email',
					'message'	=>	'Please enter a valid email address.'
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
			),
			'confirm_password'=>array(
				'identicalFieldValues' => array(
                    'rule' => array('identicalFieldValues', 'new_password'),
                    'message' => 'Do`not match confirm password.'
                ),
                'R1' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Confirm password is required.'
                )
			   				
			),					
		),
		'edit'=>	array(
			'first_name'=>array(
				'notEmpty' => array(
					'rule' 		=> 'notEmpty',
					'message' 	=>	'First name is required.'
				)
			),
			'last_name'=>array(
				'notEmpty' => array(
					'rule' 		=> 'notEmpty',
					'message' 	=>	'Last name is required.'
				)
			),
			'nickname'=>array(
				'notEmpty' => array(
					'rule' 		=> 'notEmpty',
					'message' 	=>	'Nickname is required.'
				),
				'isUnique'	=>	array(
					'rule'	=>	'isUnique',
					'message'	=>	'Nickname already exists.'
				)
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
			),
			'email'=>array(
				'notEmpty' => array(
					'rule' 		=> 'notEmpty',
					'message' 	=>	'Email Address is required.'
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
			'confirm_password'=>array(
				'identicalFieldValues' => array(
                    'rule' => array('identicalFieldValues', 'new_password'),
                    'message' => 'Do not match confirm password.'
                ),
                'R1' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Confirm password is required.'
                )
				
			   				
			),					
		),
		'edit_profile'=>	array(
			'first_name'=>array(
				'notEmpty' => array(
					'rule' 		=> 'notEmpty',
					'message' 	=>	'First name is required.'
				)
			),
			'last_name'=>array(
				'notEmpty' => array(
					'rule' 		=> 'notEmpty',
					'message' 	=>	'Last name is required.'
				)
			),
			
			/* 'email'=>array(
				'notEmpty' => array(
					'rule' 		=> 'notEmpty',
					'message' 	=>	'Email Address is required'
				),
				'isUnique'	=>	array(
					'rule'	=>	'isUnique',
					'message'	=>	'Email already exists.'
				),
				'email'	=>	array(
					'rule'	=>	'email',
					'message'	=>	'Please provide a valid email address.'
				),
			), */				
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
					'message' => 'Password and confirm password doest not match.'
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
			
		),'forgot_password' => array(            
            'email' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Email address is required.'
                ),
				'checkWhiteSpaces' => array(
                    'rule' => array('checkWhiteSpace', 'email'),
                    'message' => 'No white spaces on left and right side of string.'
                ),
                'email' => array(
                    'rule' => 'email',
                    'message' => 'Please enter valid email address.'
                ),
            )
        ),		
		'reset_password'	=>	array(
            'email' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Email addrsess is required.'
                ),
                'email' => array(
                    'rule' => 'email',
                    'message' => 'Please enter valid email address.'
                ),
                'checkWhiteSpace' => array(
                    'rule' => array('checkWhiteSpace', 'email'),
                    'message' => 'email should not have white space at both ends.'
                )
            ),
			
			'password1' => array(   
		        'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Password is required.'
                ),
				'between' => array(
					'rule' => array('between', 6, 15),
					'message' => 'Password must be of at least 6 characters, should not exceed 15 character.'
				),			
				
            ),
			'password2'=>array(
					'identicalFieldValues' => array(
						'rule' => array('identicalFieldValues', 'password1'),
						'message' => 'Passwords does not match.'
					),					
					'R2'=>array(
						'rule'=>'notEmpty',
						'message' => 'Confirm password is required.'
					)
			)
		)
	);
	
	function validatePassword($data){
		if(preg_match('/((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/',$data[key($data)])){
			return true;   
		}
		return false;   
	}
	
	function fileSize1 ($field){
		list($width, $height) = @getimagesize($field['image']['tmp_name']);
		if ($height <= 1500 && $width <= 1500) {
		   return true;
        }else if($height > 1000 && $width < 100){
			return true;
		}else{
			return false;
		}
	}
	
	
	function checkEmptyImage($field){
        if(empty($field['image']['tmp_name'])){
            return false;
        }else{
            return true;
        }
    }
	
	function checkUniqueWesiteEdit($field){
	
		$id = $this->data['User']['id'];	
		$count	=	$this->find('count',array('conditions'=>array(
										'User.website_url'=>$this->data['User']['website_url'],
										'User.id !='=>$id
										))); 
	
		if($count == 0){
			return true;
		}else{
			return false;
		}
    }
	function checkUniqueWesite($field){
		$count	=	$this->find('count',array('conditions'=>array(
										'User.website_url'=>$this->data['User']['website_url']
										))); 
	
		if($count == 0){
			return true;
		}else{
			return false;
		}
    }
	
	public function checkOldPassword( $field = array(), $password = null ) {	
		$userId =  $this->data['User']['id'];
		$count	=	$this->find('count',array('conditions'=>array(
											'User.password'=>Security::hash($this->data[$this->name][$password], null, true),
											'User.id'=>$userId
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
	function checkEmail($data = null, $field=null){
	    if(!empty($field)){
		   if(!empty($this->data[$this->name][$field])){				
				if($this->hasAny(array('User.email' => $this->data[$this->name][$field]))){
					return true;
				}elseif($this->hasAny(array('User.username' => $this->data[$this->name][$field]))){
					return true;
				}
				else{
				   return false;
				}
		   }
		}
	}
	
	function toggleStatus($id = null)
	{
		$this->id = $id;
		$status = $this->field('status');
		$status = $status?0:1;
		return $this->saveField('status',$status);
	}
	function toggleFeaturStatus($id = null)
	{	
		$this->id = $id;
		$featured = $this->field('featured');
		$featured = $featured?0:1;
		return $this->saveField('featured',$featured);
	}	
	
	
}