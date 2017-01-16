<?php
/**
 * Layout Helper
 *
 * PHP version 5
 *
 * @category Helper
 * @package  Croogo
 * @version  1.0
 * @author   Fahad Ibnay Heylaal <contact@fahad19.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.croogo.org
 */
class LayoutHelper extends AppHelper {
/**
 * Other helpers used by this helper
 *
 * @var array
 * @access public
 */
    var $helpers = array(
        'Html',
        'Form',
        'Session',
        'Javascript',
    );
/**
 * Current Node
 *
 * @var array
 * @access public
 */
    var $node = null;
/**
 * Hook helpers
 *
 * @var array
 * @access public
 */
    var $hooks = array();
/**
 * Constructor
 *
 * @param array $options options
 * @access public
 */
    function __construct($options = array()) {
        //$this->View =& ClassRegistry::getObject('view');
       // $this->__loadHooks();

        return parent::__construct($options);
    }
/**
 * Load hooks as helpers
 *
 * @return void
 */
 	function status($value) {
		$output = '';
        if ($value == 1) {
           $output = 'Active';
        } else if ($value == 0) {
           $output = 'Inactive';
        } else if ($value == 2) {
           $output = 'Awarded';
        } else if ($value == 3) {
           $output = 'Completed';
        } else if ($value == 4) {
           $output = 'Failed Or Disputed';
        } else if ($value == 5) {
           $output = 'Close';
        }
        return $output;
    } 	

	
	
	function feature_status($value) {
		$output = '';
        if ($value == 1) {
           $output = 'Featured';
        } else if ($value == 0) {
           $output = 'Unfeatured';
        } 
        return $output;
    }
	function ishome_status($value) {
		$output = '';
        if ($value == 1) {
           $output = 'Yes';
        } else if ($value == 0) {
           $output = 'No';
        } 
        return $output;
    }
	
	function isvideo_status($value) {
		$output = '';
        if ($value == 1) {
           $output = 'Video Auto Play';
        } else if ($value == 0) {
           $output = 'Start Button Show';
        } 
        return $output;
    }
	function account_type_status($value) {
		$output = '';
        if ($value == 1) {
           $output = 'Enable';
        } else if ($value == 0) {
           $output = 'Disable';
        } 
        return $output;
    }
	
	/**
 * Show flash message
 *
 * @return void
 */
    function sessionFlash() {
        $messages = $this->Session->read('Message');
        if( is_array($messages) ) {
            foreach(array_keys($messages) AS $key) {
					echo  $this->Session->flash($key);
            }
        }
    }
	
	
	function get_live_channels_images($stream_key)
	{
		$ch = curl_init('https://api.cloud.wowza.com/api/v1/live_streams/'.$stream_key.'/thumbnail_url/');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(      
			'Content-Type: application/json ;charset=utf-8', 
			'wsc-api-key:'.Configure::read('WOWZA_API_KEY'),
			'wsc-access-key:'.Configure::read('WOWZA_ACCESS_KEY')
			)                                                                       
		); 
		$result = curl_exec($ch);
		curl_close($ch);
		$stream_image_response_array = json_decode($result,true);
		return $stream_image_response_array;
	
	}
	
 
 }