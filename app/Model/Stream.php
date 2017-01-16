<?php
/**
 * Country
 *
 * PHP version 5
 *
 * @stream Model 
 * 
 */
// App::uses('AuthComponent', 'Controller/Component');
// App::uses('SessionComponent', 'Controller/Component');
App::uses('AppModel', 'Model');
class Stream extends AppModel{

	//public $primaryKey = '_id';
	
	/**
	 * Model name
	 * @var string
	 * @access public
	 */
	var $name = 'Stream';
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
		'front_add' => array(
			'title' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Title is required.'
                )
            ),'subject' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Subject is required.'
                )
            ),'note' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Note is required.'
                )
            ),'time_zone' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please select.'
                )
            )/* ,'schedule_start_date' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter date'
                )
            ),'schedule_start_time' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter time'
                )
            ) */,
			'schedule_start_date' => array(
                'check1' => array(
                    'rule' => array('emptyStreamStartDate'),
                    'message' => 'Please choose start date or end date.'
                ), 'check2' => array(
                    'rule' => array('invalidDate'),
                    'message' => 'Start date should be less then from end date.'
                )
				, 'check3' => array(
                    'rule' => array('minDiffDate'),
                    'message' => 'Atleast dates difference should be 30mins.'
                ),
				'check4' => array(
                    'rule' => array('dateTimeUniqueStream'),
                    'message' => 'You have already scheduled the stream for these dates.'
                )
            ),
			'stream_encoder_type' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Encoder type is required.'
                )
            ),'stream_broadcast_location' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Stream broadcast location is required.'
                )
            ),'aspect_ratio' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Aspect ratio is required.'
                )
            ),'image' => array(
				'check1' => array(
                    'rule' => array('imageRequire'),
                    'message' => 'Image is required.'
                ),
				'check2' => array(
                    'rule' => array('checkextension'),
                    'message' => 'Please upload only image files.'
                ),
                'check3' => array(
                    'rule' => array('fileSize1'),
                    'message' => 'Image size should be 480x270 or greater.'
                ),
            )
		),'front_edit' => array(
			'title' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Title is required.'
                )
            ),'subject' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Subject is required.'
                )
            ),'note' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Note is required.'
                )
            ),'time_zone' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Timezone is required.'
                )
            ),'date' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Date is required.'
                )
            ),'time' => array(
                'notEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Time is required.'
                )
            ),'image' => array(				
				'check2' => array(
                    'rule' => array('checkextension'),
                    'message' => 'Please upload only image files.'
                ),
                'check3' => array(
                    'rule' => array('fileSize1'),
                    'message' => 'Image size should be 480x270 or greater.'
                ),
            )
		)
	);
	
	
	function emptyStreamStartDate() 
	{
	
		if(!empty($this->data['Stream']['schedule_start_date']) && empty($this->data['Stream']['schedule_end_date']))
		{
			return false;
		}elseif(empty($this->data['Stream']['schedule_start_date']) && !empty($this->data['Stream']['schedule_end_date']))
		{
			return false;
		}else{
			return true;
		}
		
		
	}
	
	
	function dateTimeUniqueStream() 
	{
	
		$hidden_user_id = $this->data['Stream']['hidden_user_id'];		
		//$currentDateTime = date('Y-m-d h:i:s');
		
		
		if(empty($this->data['Stream']['schedule_start_date']) && empty($this->data['Stream']['schedule_end_date'])){		
			return true;
		}	
		
		$sData	=	$this->find('all',array('conditions'=>array(
										'Stream.user_id'=>$hidden_user_id,
										))); 
		$check_flag = true;
		if(!empty($sData)){
			
			foreach($sData as $key => $val){		

				if(strtotime($this->data['Stream']['schedule_start_date']) >= strtotime($val['Stream']['schedule_start_date']) && strtotime($this->data['Stream']['schedule_start_date']) <= strtotime($val['Stream']['schedule_end_date']) ){				
					
					/* echo '1';die; */
					$check_flag = false;
					break;
					
				}elseif(strtotime($this->data['Stream']['schedule_end_date']) >= strtotime($val['Stream']['schedule_start_date']) && strtotime($this->data['Stream']['schedule_end_date']) <= strtotime($val['Stream']['schedule_end_date']) ){
					
					/* echo '2';die; */
					$check_flag = false;
					break;
					
				}
				elseif((strtotime($val['Stream']['schedule_start_date']) >= strtotime($this->data['Stream']['schedule_start_date'])) && (strtotime($val['Stream']['schedule_start_date']) <= strtotime($this->data['Stream']['schedule_end_date'])))
				{
					$check_flag = false;
					break;
				}
				elseif((strtotime($val['Stream']['schedule_end_date']) >= strtotime($this->data['Stream']['schedule_start_date'])) && (strtotime($val['Stream']['schedule_end_date']) <= strtotime($this->data['Stream']['schedule_end_date'])))
				{
					$check_flag = false;
					break;
				}
				
				
				/* elseif(strtotime($this->data['Stream']['schedule_start_date']) <= strtotime($val['Stream']['schedule_start_date']) && strtotime($this->data['Stream']['schedule_start_date']) <= strtotime($val['Stream']['schedule_end_date']) ){				
					
					echo '3';die;
					$check_flag = false;
					break;
					
				}elseif(strtotime($this->data['Stream']['schedule_end_date']) <= strtotime($val['Stream']['schedule_start_date']) && strtotime($this->data['Stream']['schedule_end_date']) <= strtotime($val['Stream']['schedule_end_date']) ){
					
					echo '4';die;
					$check_flag = false;
					break;
					
				} */else{					
					
					$check_flag = true;
					break;
				}
			
			}
		}else{
			$check_flag = true;
		}
	
		return $check_flag ;
	}
	
	
	

	
	
	function imageRequire() 
	{
		$flag = false;
		if($this->data['Stream']['image']['name'])
		{
			$flag = true;
		}
		
		if(!$flag)
		{
			return false;
		}
		else
		{
			return true;
		}	
	}
	
	
	
	function invalidDate() 
	{
		if(!empty($this->data['Stream']['schedule_start_date']) && !empty($this->data['Stream']['schedule_end_date'])){
			if(strtotime($this->data['Stream']['schedule_start_date']) > strtotime($this->data['Stream']['schedule_end_date'])){
				
				return false;
				break;
				
			}else{
			
				return true;
				break;
			}
		}else{
			return true;
			break;
		}
		
	}
	
	
	function minDiffDate() 
	{		
		
		if(!empty($this->data['Stream']['schedule_start_date']) && !empty($this->data['Stream']['schedule_end_date'])){
			$date1 = strtotime($this->data['Stream']['schedule_start_date']);
			$date2 = strtotime($this->data['Stream']['schedule_end_date']);
			
			$diffDate = $date2-$date1;
			//echo $diffDate;die;
			if($diffDate < 1740){
				
				return false;
				break;
				
			}else{
				return true;
				break;
			}
		}else{
			return true;
			break;
		}
	}
	
	
	function checkextension() 
	{
		if (isset($this->data['Stream']['image']) && !empty($this->data['Stream']['image'])) 
		{			
			$files = $this->data['Stream']['image'];
	
				if (!empty($files) && $files['tmp_name'] != '' && $files['size'] > 0) 
				{
					$allowed = array('jpg', 'jpeg', 'gif', 'png', 'JPG', 'JPEG', 'GIF', 'PNG');
					$path_info = pathinfo($files['name']);
					if(!in_array($path_info['extension'],$allowed))
					{
						return false;
					}
					else
					{
						return true;
					}
				}					
		}
		return true;
    }
	
	function fileSize1 ($field){
		
		list($width, $height) = @getimagesize($field['image']['tmp_name']);
		//pr($this->data['Stream']['image']['name']);die;
		if(!empty($this->data['Stream']['image']['name'])){
			if ($height <= 270 || $width <= 480) {		
			   return false;
			} else {
				return true;
			}
		}else{
			return true;
		}
		
	}
	
	function toggleFeaturStatus($id = null)
	{	
		$this->id = $id;
		$featured = $this->field('featured');
		$featured = $featured?0:1;
		return $this->saveField('featured',$featured);
	}	
}