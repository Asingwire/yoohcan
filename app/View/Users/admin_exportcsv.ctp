<?php
$line = array(
	'User Name',
	'Email',
	'Profile Name',
	'Profile Information',
	'Country',
	'City',
	'Description',
	'Website Url'
);

$this->CSV->addRow($title); 
$this->CSV->addRow($line); 
if(!empty($data)&& isset($data)) {
	foreach($data as $key => $value) {
		$line = array(
			$value['User']['username'],
			$value['User']['email'],
			$value['User']['profile_name'],
			$value['User']['profile_information'],
			$value['User']['country'],
			$value['User']['city'],
			$value['User']['description'],
			$value['User']['website_url'],
		);		
		$this->CSV->addRow($line);
	}
}else{
	$line = array('No Record Found');		
	$this->CSV->addRow($line);
}
 $filename='UserReport';
 echo  $this->CSV->render($filename);
 exit();
?>