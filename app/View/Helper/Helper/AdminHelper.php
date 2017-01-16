<?php
class AdminHelper extends AppHelper {
	/**
     * Other helpers used by this helper
     * @var array
     * @access public
     */
	var $helpers = array('Html', 'Session', 'Form', 'Layout','Text');
	function getActionImage($actions=null,$id=null,$name=null) {
	       //pr($actions);
			$controller = '' ;
			$action = '' ;
			if(!empty($actions)) {
				foreach($actions as $imagetype=>$to_action) {
					if(isset($to_action['controller'])) 
						$controller = $to_action['controller'];
					if(isset($to_action['action'])) 
						$action = $to_action['action'];
					if(isset($to_action['token'])) 
						$token = $to_action['token'];	
					
					if($imagetype=='view') {
						echo ($this->Html->link($this->Html->image('/img/admin/view.jpg',array('class'=>'viewstatusimg1 thickbox','title'=>'View '.$name,'alt'=>'View','width'=>'18','height'=>'18')),array('controller'=>$controller,'action'=>$action,$id), array('escape'=>false)));
					}elseif($imagetype=='changepassword') {
			 			echo ($this->Html->link($this->Html->image('/img/admin/change_password.gif',array('class'=>'viewstatusimg1','title'=>'Change Password '.$name,'alt'=>'change Password','width'=>'18','height'=>'18')),array('controller'=>$controller,'action'=>$action,$id),array('escape'=>false))) ;
					}elseif($imagetype=='edit') {
				echo ($this->Html->link($this->Html->image('/img/admin/edit_icon.jpg',array('class'=>'viewstatusimg1','title'=>'Edit '.$name,'alt'=>'Edit '.$name,'width'=>'18','height'=>'18')),array('controller'=>$controller,'action'=>$action, $id),array('escape'=>false))) ;
					} elseif($imagetype=='delete') {
	       			echo ($this->Html->link($this->Html->image('/img/admin/cross_icon.jpg', array('class'=>'viewstatusimg1', 'title'=>'Delete '.$name,'alt'=>'Delete '.$name,'width'=>'18','height'=>'18')), array('controller'=>$controller,'action'=>$action, $id),array('class'=>'deleteItem', 'escape'=>false)));	
					} elseif($imagetype=='manageimage') {
			 			//echo ($this->Html->link($this->Html->image('portlet_admin_icon.gif',array('class'=>'viewstatusimg1','title'=>'Manage '.$name.'Images','alt'=>'edit','width'=>'20','height'=>'16')),array('controller'=>$controller,'action'=>$action,$id ),array('escape'=>'false'))) ;
					} elseif($imagetype=='default_true') {
			 			echo ($this->Html->link($this->Html->image('default_true.png',array('class'=>'viewstatusimg1','title'=>'edit','alt'=>'edit','width'=>'20','height'=>'16')),array('controller'=>$controller,'action'=>$action,$id ),array('escape'=>false))) ;
					} elseif($imagetype=='default_false') {
			 			echo ($this->Html->link($this->Html->image('default_false.png',array('class'=>'viewstatusimg1','title'=>'edit','alt'=>'edit','width'=>'20','height'=>'16')),array('controller'=>$controller,'action'=>$action,$id ),array('escape'=>false))) ;
					} elseif($imagetype=='active') {
			 			echo ($this->Html->link($this->Html->image('active.png',array('class'=>'viewstatusimg1','title'=>'edit','alt'=>'edit','width'=>'20','height'=>'16')),array('controller'=>$controller,'action'=>$action,$id ),array('escape'=>false))) ;
					} elseif($imagetype=='deactive') {
			 			echo ($this->Html->link($this->Html->image('deactive.png',array('class'=>'viewstatusimg1','title'=>'edit','alt'=>'edit','width'=>'20','height'=>'16')),array('controller'=>$controller,'action'=>$action,$id ),array('escape'=>false))) ;
					}
               elseif($imagetype=='add') {              
			 			echo ($this->Html->link($this->Html->image('/img/admin/add_point.png',array('class'=>'viewstatusimg1','title'=>'Add '.$name,'alt'=>'Add '.$name,'width'=>'18','height'=>'18')),array('controller'=>$controller,'action'=>$action,$id),array('escape'=>false))) ;
					}
               elseif($imagetype=='subtract') {              
			 			echo ($this->Html->link($this->Html->image('/img/admin/delete_point.png',array('class'=>'viewstatusimg1','title'=>'Hold '.$name,'alt'=>'Hold '.$name,'width'=>'18','height'=>'18')),array('controller'=>$controller,'action'=>$action,$id),array('escape'=>false))) ;
					}
               
				}
			}
	}
	//generate tree list 
	function generateTreeList($data = null, $model=null, $controller=null, $level=0){
		$output 		= '';		
		$delimiter 		= "_";
		$delimiters 	= "\n" . str_repeat($delimiter, $level * 2);
		
		foreach($data as $value){		 
		   $output.= '<tr>
			<td align="center" valign="middle" class="Bdrrightbot Padtopbot6">';
		   $output.= $this->Form->checkbox($model.'.id'.$value[$model]['id'], array("class"=>"Chkbox", 'value'=>$value[$model]['id'] ));
			$output.= '</td>		
			<td align="left" valign="middle" class="Bdrrightbot" style="padding-left:19px;">';		  			 
			$output.= $delimiters.strtoupper($value[$model]['name']);
			$output.= '</td>				
			<td align="left" valign="middle" class="Bdrrightbot" style="padding-left:19px;">';
			$output.= date('Y-m-d',strtotime($value[$model]['created']));
			$output.='</td>
			<td align="left" valign="middle" class="Bdrrightbot" style="padding-left:19px;">';
			
			 if(!empty($value[$model]['modified'])){
				$output.= date('Y-m-d',strtotime($value[$model]['modified']));
			 }
			$output.= '</td>
			<td align="left" valign="middle" class="Bdrrightbot" style="padding-left:19px;">
			'.$this->Layout->status($value[$model]['status']).'</td>
			<td align="center" valign="middle" class="Bdrbot ActionIcon">		
			'.$this->Html->link($this->Html->image('/img/admin/edit_icon.jpg',array('class'=>'viewstatusimg1','title'=>'Edit '.$value[$model]['name'],'alt'=>'Edit '.$value[$model]['name'],'width'=>'18','height'=>'18')),array('controller'=>$controller,'action'=>'edit', $value[$model]['id']),array('escape'=>false)).$this->Html->link($this->Html->image('/img/admin/cross_icon.jpg', array('class'=>'viewstatusimg1','title'=>'Delete '.$value[$model]['name'],'alt'=>'Delete '.$value[$model]['name'],'width'=>'18','height'=>'18')), array('controller'=>$controller,'action'=>'delete','token'=>$this->params['_Token']['key'], $value[$model]['id']),array('class'=>'deleteItem', 'escape'=>false)).'
			</td>
			</tr>';
			if(isset($value['children'][0])){
				$output .= $this->generateTreeList($value['children'], $model, $controller, $level+1);			
			}		
		}	  
	 return $output;	
	}
	
	function AdminGenerateTreeList($data = null, $model=null, $controller=null, $level=0){
		$output 		= '';		
		$delimiter 		= "_";
		$delimiters 	= "\n" . str_repeat($delimiter, $level * 2);
		foreach($data as $value){
		   $output.= '<tr>
			<td align="center" valign="middle" class="Bdrrightbot Padtopbot6">';
				if($value['AdminCategory']['type']!='OTHER' ){
					$output.= $this->Form->checkbox($model.'.id'.$value[$model]['id'], array("class"=>"Chkbox", 'value'=>$value[$model]['id'] ));
				}else{
					echo "&nbsp;&nbsp;<br><br><br><br>";
				}
			$output.= '</td>		
			<td align="left" valign="middle" class="Bdrrightbot">';		  			 
			$output.= $delimiters.strtoupper($value[$model]['name']);
			$output.= '</td>
			<td align="left" valign="middle" class="Bdrrightbot" style="padding-left:15px;">';		  			 
			$output.= $delimiters.$value[$model]['type'];
			$output.= '</td>			
			<td align="left" valign="middle" class="Bdrrightbot" style="padding-left:19px;">';
			$output.= $value[$model]['order'];
			$output.= '</td>			
			<td align="left" valign="middle" class="Bdrrightbot" style="padding-left:19px;">';
			$output.= date('Y-m-d',strtotime($value[$model]['created']));
			$output.='</td>
			<td align="left" valign="middle" class="Bdrrightbot" style="padding-left:19px;">';
			
			 if(!empty($value[$model]['modified'])){
				$output.= date('Y-m-d',strtotime($value[$model]['modified']));
			 }
			$output.= '</td>
			<td align="left" valign="middle" class="Bdrrightbot" style="padding-left:19px;">
			'.$this->Layout->status($value[$model]['status']).'</td>
			<td align="center" valign="middle" class="Bdrbot ActionIcon">	';
			
			if($value['AdminCategory']['type']!='OTHER' ):
				$output.= $this->Html->link(
						$this->Html->image('/img/admin/edit_icon.jpg',array('class'=>'viewstatusimg1','title'=>'Edit '.$value[$model]['name'],'alt'=>'Edit '.$value[$model]['name'],'width'=>'18','height'=>'18')
										),
										array('controller'=>$controller,'action'=>'edit', $value[$model]['id']),
										array('escape'=>false)).
										$this->Html->link($this->Html->image('/img/admin/cross_icon.jpg', 
										array('class'=>'viewstatusimg1','title'=>'Delete '.$value[$model]['name'],'alt'=>'Delete '.$value[$model]['name'],'width'=>'18','height'=>'18')), 
										array('controller'=>$controller,'action'=>'delete','token'=>$this->params['_Token']['key'], $value[$model]['id']),
										array('class'=>'deleteItem', 'escape'=>false)) ;
										
			endif;
			$output.= '</td>
			</tr>';
			if(isset($value['children'][0])){
				$output .= $this->AdminGenerateTreeList($value['children'], $model, $controller, $level+1);			
			}		
		}	  
	 return $output;	
	}
	
}