<?php

App::uses('ExceptionRenderer', 'Error');
class AppExceptionRenderer extends ExceptionRenderer {

	/*-------------------------------------------------------------------------*/
	/* -- Exceptions
	/*-------------------------------------------------------------------------*/
	
	public function setErrors($error) {
		$params = $this->controller->request->params; 
		$message = $error->getMessage();
		$url = $this->controller->request->here();
		$code = ($error->getCode() > 500 && $error->getCode() < 506) ? $error->getCode() : 500;
		$this->controller->response->statusCode($code);
		$this->controller->set(array(
			'name' => $message,
			'message' => h($url),
			'error' => $error,
		));
		if(isset($params['admin'])){
			$this->controller->render('/Errors/admin_error','admin_login');
		}else{
			echo "asdsadsadsa"; die;
			$this->controller->render('/Errors/error','error');
		}
	}
	
	
	public function notFound($error) {
		$this->controller->beforeFilter();
		$this->controller->set('title_for_layout', 'Not Found');
		$this->setErrors($error);
		$this->controller->response->send();
	}
	public function badRequest($error) { 
		$this->controller->beforeFilter();
		$this->controller->set('title_for_layout', 'Not Found');
		$this->setErrors($error);
		$this->controller->response->send();
	}
	public function forbidden($error) { 
		$this->controller->beforeFilter();
		$this->controller->set('title_for_layout', 'Not Found');
		$this->setErrors($error);
		$this->controller->response->send();
	}
	public function methodNotAllowed($error) { 
		$this->controller->beforeFilter();
		$this->controller->set('title_for_layout', 'Not Found');
		$this->setErrors($error);
		$this->controller->response->send();
	}
	public function internalError($error) {  
		$this->controller->beforeFilter();
		$this->controller->set('title_for_layout', 'Not Found');
		$this->setErrors($error);
		$this->controller->response->send();
	}
	public function notImplemented($error) {
		$this->controller->beforeFilter();
		$this->controller->set('title_for_layout', 'Not Found');
		$this->setErrors($error);
		$this->controller->response->send();
	}

	/*-------------------------------------------------------------------------*/
	/* -- Other
	/*-------------------------------------------------------------------------*/

	public function missingController($error) {
		$this->notFound($error);
	}
	public function missingAction($error) {
		$this->notFound($error);
	}
	public function missingView($error) {
		$this->notFound($error);
	}
	public function missingLayout($error) {
		$this->internalError($error);
	}
	public function missingHelper($error) {
		$this->internalError($error);
	}
	public function missingBehavior($error) {
		$this->internalError($error);
	}
	public function missingComponent($error) {
		$this->internalError($error);
	}
	public function missingTask($error) {
		$this->internalError($error);
	}
	public function missingShell($error) {
		$this->internalError($error);
	}
	public function missingShellMethod($error) {
		$this->internalError($error);
	}
	public function missingDatabase($error) {
		$this->internalError($error);
	}
	public function missingConnection($error) {
		$this->internalError($error);
	}
	public function missingTable($error) {
		$this->internalError($error);
	}
	public function privateAction($error) {
		$this->internalError($error);
	}

	/*-------------------------------------------------------------------------*/
	/*-------------------------------------------------------------------------*/
}