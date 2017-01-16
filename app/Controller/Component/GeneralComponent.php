<?php
class GeneralComponent extends Component {

	function createSlug($string = null){
			 $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
			return strtolower($slug);
	}
	
	public function execuate_function_in_backend($function_name,$parameter1='',$parameter2='',$parameter3='') {
		
		$file	=	ROOT.'/app/webroot/process.php';
		
		//$cmd = exec("/usr/bin/php ".$file." ".$function_name." ".$parameter1." ".$parameter2." ".$parameter3." 2>&1",$output); // for LIVE server
		
		//$cmd = exec("C:\php\php ".$file." ".$function_name." ".$parameter1." ".$parameter2." ".$parameter3." 2>&1",$output); // for 67 server
		
		$cmd = exec("D://xampp/php/php ".$file." ".$function_name." ".$parameter1." ".$parameter2." ".$parameter3." 2>&1",$output); // for local 97 server
		
		//pr($output);die;
		
	}
	
}