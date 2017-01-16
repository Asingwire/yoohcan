<?php
/**
 * Settings Controller
 *
 * PHP version 5.4
 *
 */
/* require APP.'/vendor/aws/autoload.php';
use Aws\S3\S3Client;  
  */
class SettingsController extends AppController {
	/**
     * Settings name
     *
     * @var string
     * @access public
     */
	var	$name	=	'Settings';
	
	var	$uses	=	array('Setting');
	var $components = 	array("Upload");
	var $helpers = array('Html');
	/*
	* beforeFilter
	* @return void
	*/
    public function beforeFilter() {
		parent::beforeFilter();
		
    }
	
	
	/**
	* edit existing user
	*/
    public function admin_index() {
        if ($this->request->is('post') || $this->request->is('put')) {
			
			
			if(!empty($this->request->data)) {

				/* if (!isset($this->request->params['data']['_Token']['key']) || ($this->request->params['data']['_Token']['key'] != $this->request->params['_Token']['key'])) {
					$blackHoleCallback = $this->Security->blackHoleCallback;
					$this->$blackHoleCallback();
				}
 */
				unset($this->request->data['Setting']);
				unset($this->request->data['_Token']);
				$this->Setting->set($this->request->data);
				$this->Setting->setValidation('admin');
				$not_empty = false;
				
				foreach($this->request->data as $key=>$setting){ 
					foreach($setting as $key1=>$value1){						
						if(isset($setting['Setting']['home_page_banner_image'])){
							if($setting['Setting']['home_page_banner_image']['size'] != 0 && $setting['Setting']['home_page_banner_image']['error'] != 0){
								$not_empty = true;
								$this->Setting->invalidate("$key.Setting.home_page_banner_image", 'Please select valid image');
							}
						}else{
							if(empty($value1)){
								$not_empty = true;
								$this->Setting->invalidate("$key.Setting.$key1", 'Value cannot be empty');
							}
						}
					}
				}
				
				
				if ($not_empty == false){
					unset($this->request->data['_Token']); 
							
					foreach($this->request->data as $settings){ 
						$this->Setting->id = $settings['Setting']['id'];
						
						unset($settings['Setting']['id']);
						
						if(!empty($settings['Setting']['home_page_banner_image']['name']) && isset($settings['Setting']['home_page_banner_image']['name']) || !empty($settings['Setting']['streaming_guide_pdf']['name']) && isset($settings['Setting']['streaming_guide_pdf']['name'])){
						
							
							if(isset($settings['Setting']['home_page_banner_image']['name'])){
								$allowed = array('jpg', 'jpeg', 'gif', 'png', 'JPG', 'JPEG', 'GIF', 'PNG');
								$path_info_image = pathinfo($settings['Setting']['home_page_banner_image']['name']);
								$settings['Setting']['home_page_banner_image']['name'];
								
								if(!in_array($path_info_image['extension'],$allowed)){
						
									$this->Session->setFlash(__('Only JPG, PNG or GIF files are allowed.',true), 'admin_flash_bad');
									$this->redirect($this->referer());

								}
							}
								
								
							//Code for Image			
							if(!empty($settings['Setting']['home_page_banner_image']['name']) && isset($settings['Setting']['home_page_banner_image']['name']) && $settings['Setting']['home_page_banner_image']['size'] > 8388608){

								$this->Session->setFlash(__('Image size should not be greater than 8 MB.',true), 'admin_flash_bad');
								$this->redirect($this->referer());

							}
							
							if(!empty($settings['Setting']['home_page_banner_image']['name']) && isset($settings['Setting']['home_page_banner_image']['name'])){
						
								$banner = array('size' => array(3500,2500), 'type' => 'resizecrop');						
								$path_info = pathinfo($settings['Setting']['home_page_banner_image']['name']);						
								$settings['Setting']['home_page_banner_image']['name'] = microtime(true) . "." . $path_info['extension'];							
								$res1 = $this->Upload->upload($settings['Setting']['home_page_banner_image'], WWW_ROOT . BANNER_IMAGE_FULL_DIR . DS, '',$banner, array('png', 'jpg', 'jpeg', 'gif'));
								
								if (!empty($this->Upload->result)) {
									$old_image = $this->Setting->find('first', array('conditions' => array('name' => 'home_page_banner_image')));
									// pr($old_image['Setting']);die;
									$uploaded_image = $this->Upload->result;
									$unlink = $old_image['Setting']['value'];	
									
									if($unlink &&  file_exists(WWW_ROOT.BANNER_IMAGE_FULL_DIR.DS.$unlink )) {
										@unlink(WWW_ROOT.BANNER_IMAGE_FULL_DIR.DS.$unlink);
									}
								
									$this->Setting->saveField("value",$uploaded_image);
									
								}
							
							}
							
							
							//Code for PDF			
							if(isset($settings['Setting']['streaming_guide_pdf']['name'])){
								$allowed = array('pdf','PDF');
								$path_info_pdf = pathinfo($settings['Setting']['streaming_guide_pdf']['name']);
								$settings['Setting']['streaming_guide_pdf']['name'];
								
								if(!in_array($path_info_pdf['extension'],$allowed)){
						
									$this->Session->setFlash(__('Please upload only PDF file.',true), 'admin_flash_bad');
									$this->redirect($this->referer());

								}	
							}
								
								
							
							if(!empty($settings['Setting']['streaming_guide_pdf']['name']) && isset($settings['Setting']['streaming_guide_pdf']['name']) && $settings['Setting']['streaming_guide_pdf']['size'] > 15728640){

								$this->Session->setFlash(__('PDF should be less than 15 MB.',true), 'admin_flash_bad');
								$this->redirect($this->referer());

							}
						
						
							

							if(!empty($settings['Setting']['streaming_guide_pdf']['name']) && isset($settings['Setting']['streaming_guide_pdf']['name'])){
						
								//$banner = array('size' => array(3500,2500), 'type' => 'resizecrop');						
								$path_info = pathinfo($settings['Setting']['streaming_guide_pdf']['name']);		
								
								$settings['Setting']['streaming_guide_pdf']['name'] = microtime(true) . "." . $path_info['extension'];							
								$res1 = $this->Upload->upload($settings['Setting']['streaming_guide_pdf'], WWW_ROOT . PDF_FULL_DIR . DS, '','', array('pdf'));

								if (!empty($this->Upload->result)) {
									$old_pdf = $this->Setting->find('first', array('conditions' => array('name' => 'streaming_guide_pdf')));
									

									$uploaded_pdf = $this->Upload->result;
									$unlink = $old_pdf['Setting']['value'];	
									if($unlink &&  file_exists(WWW_ROOT.PDF_FULL_DIR.DS.$unlink )) {
									
										@unlink(WWW_ROOT.PDF_FULL_DIR.DS.$unlink);
									
									}
									
									$this->Setting->saveField("value",$uploaded_pdf);
									
								}
							}
						}else{ 
							unset($settings['Setting']['home_page_banner_image']);
							unset($settings['Setting']['streaming_guide_pdf']);
							foreach($settings['Setting'] as $field=>$value){
								$this->Setting->saveField("value",$value);
							} 
						}	 
						
						
						
					} 
					$this->Session->setFlash(__('The Settings has been updated .',true), 'admin_flash_good');
					$this->redirect($this->referer());
				}else {
					$data = $this->Setting->find('all', array('fields'=>array('*'),  'conditions' => array('NOT' => array('Setting.name' => array('front_video', 'banner_speed', 'featured_staff_speed')))));
					for($i=0; $i<count($data); $i++){
						$this->request->data[$i]['Setting']['id'] = $data[$i]['Setting']['id'];
						$this->request->data[$i]['Setting']['name'] = $data[$i]['Setting']['name'];
						if($data[$i]['Setting']['name'] == "home_page_banner_image"){
							$this->request->data[$i]['Setting']['value'] = null;
						}else{
							$this->request->data[$i]['Setting']['value'] = $this->request->data[$i]['Setting'][$data[$i]['Setting']['name']];
						}
						
						$this->request->data[$i]['Setting']['type'] = $data[$i]['Setting']['type'];
						$this->request->data[$i]['Setting']['label'] = $data[$i]['Setting']['label'];
						$this->request->data[$i]['Setting']['description'] = $data[$i]['Setting']['description'];
						$this->request->data[$i]['Setting']['options'] = $data[$i]['Setting']['options'];
					}
					unset($this->request->data['_Token']);
					
					$this->Session->setFlash(__('The Settings could not be updated. Please, correct errors.', true), 'admin_flash_bad');
				}
			}	
        }else{	
			$this->request->data = $this->Setting->find('all');
		}
		$streaming_guide_pdf = Configure::read("STREAMING_GUIDE_PDF");
		$this->set('streaming_guide_pdf',$streaming_guide_pdf);
		 
    }
	
	
	public function admin_delete_banner()
	{
		$name = "home_page_banner_image";	
		if (!$name) {
			$this->Session->setFlash(__('Invalid  id', true), 'flash_popup_error');
			$this->redirect(array('controller'=>'settings','action' => 'index'));
		} else {
			
		
			$BannerImg = $this->Setting->find('first',array('conditions'=>array('Setting.name'=>$name)));
			
			if(!empty($BannerImg))
			{			
				
				if($BannerImg['Setting']['name'] &&  file_exists(WWW_ROOT.BANNER_IMAGE_FULL_DIR.DS.$BannerImg['Setting']['name'])) 
				{
					@unlink(WWW_ROOT.BANNER_IMAGE_FULL_DIR.DS.$BannerImg['Setting']['name']);
				}
				$BannerImg['Setting']['value'] = "";
				
				if ($this->Setting->save($BannerImg,false)) {
					$this->Session->setFlash('Banner image have been deleted successfully', 'flash_success');
					$this->redirect($this->referer());

				}				
			
				
				
			}
		}
	}
	
	public function admin_delete_pdf()
	{
		$name = "streaming_guide_pdf";	
		if (!$name) {
			$this->Session->setFlash(__('Invalid  id', true), 'flash_popup_error');
			$this->redirect(array('controller'=>'settings','action' => 'index'));
		} else {
			
		
			$pdf = $this->Setting->find('first',array('conditions'=>array('Setting.name'=>$name)));
		
			if(!empty($pdf))
			{			
				
				if($pdf['Setting']['name'] &&  file_exists(WWW_ROOT.PDF_FULL_DIR.DS.$pdf['Setting']['name'])) 
				{
					@unlink(WWW_ROOT.PDF_FULL_DIR.DS.$pdf['Setting']['name']);
				}
				$pdf['Setting']['value'] = "";
				
				if ($this->Setting->save($pdf,false)) {
					$this->Session->setFlash('Streaming guide pdf have been deleted successfully', 'flash_success');
					$this->redirect($this->referer());

				}				
			
				
				
			}
		}
	}
	
	
	
	
	
	
	 
	
	
}