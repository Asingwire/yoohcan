<?php

App::uses('FormAuthenticate', 'Controller/Component/Auth');

class AdminAuthenticate extends FormAuthenticate {

    public function authenticate(CakeRequest $request, CakeResponse $response) {
		
		App::import('Model', 'Admin');
		
		$adminModel 	= 	new Admin ();
		$email 			= 	$request->data['Admin']['email'];
        $password 		= 	$request->data['Admin']['password'];
       
		$role_id	=	array(1);
		
        $user = $adminModel->find('first', array(
            'conditions' => array(
                'role_id' => $role_id,
                'email' => $email,
                'password' =>  Security::hash($password, null, true)
            )
        ));
		
        if ($user) {
			
            $data 			= 	$user['Admin'] ; // Get only useful info
            $data['type'] 	= 	'admin'; // Save user type
			
            return $data ;
        }

        return null ;

    }

};