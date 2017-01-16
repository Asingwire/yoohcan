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
class UserDetail extends AppModel{

	//public $primaryKey = '_id';
	
	/**
	 * Model name
	 * @var string
	 * @access public
	 */
	var $name = 'UserDetail';
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
		'cc_detail' => array(
			'card_name' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Enter card name.'
                )
            ),'card_number' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Enter card number.'
                )
            ),
			'expire_month' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Enter expire month.'
                ),'maxlength' => array(
					'rule'	=> 	array('maxlength', 2),
					'message'	=>	'month has invalid format.'
				)
            ),'expire_year' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Enter expire year.'
                ),'maxlength' => array(
					'rule'	=> 	array('maxlength', 4),
					'message'	=>	'year no has invalid format.'
				)
            ),'card_cvv' => array(
				'notEmpty' => array(
					'rule' => 'notEmpty',
					'message' => 'Enter cvv number.'
				),'maxlength' => array(
					'rule'	=> 	array('maxlength', 4),
					'message'	=>	'CVV no has invalid format.'
				)
			)
        ),'bank_detail' => array(
			'bank_name' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Enter bank name.'
                )
            ),'bank_address' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Enter bank address.'
                )
            ),'paypal_email' => array(
				'notEmpty' => array(
					'rule' => 'notEmpty',
					'message' => 'Paypal email is required.'
				),
				'email' => array(
					'rule' => 'email',
					'message' => 'Enter valid paypal email.'
				),
				'checkWhiteSpace' => array(
					'rule' => array('checkWhiteSpace', 'paypal_email'),
					'message' => 'Paypal email should not have white space at both ends.'
				)
			),'account_number' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Enter account number'
                )/* ,'maxlength' => array(
					'rule'	=> 	array('maxlength', 11),
					'message'	=>	'Account number has invalid format.'
				) */
            ),'account_name' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Enter account holder name.'
                )
            ),'account_address' => array(
				'notEmpty' => array(
					'rule' => 'notEmpty',
					'message' => 'Enter account holder address.'
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