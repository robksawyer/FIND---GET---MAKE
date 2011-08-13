<?php 
class AppError extends ErrorHandler {
 
	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
	function __construct($method, $messages) {
		Configure::write('debug', 1);
		parent::__construct($method, $messages);
	}
 
	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
	function _outputMessage($template) {
		$this->controller->render($template);
		$this->controller->afterFilter();

		App::import('Core', 'Email');

		$email = new EmailComponent;

		$email->from = 'THE SOURCE <robksawyer@gmail.com>';
		$email->to = 'Rob Sawyer <robksawyer@gmail.com>';
		$email->sendAs = 'html';
		$email->subject = 'Error in my CakePHP app';

		$email->send($this->controller->output);
	}
	
	/**
	 * 
	 * @param params
	 * @return 
	 * 
	*/
	function cannotWriteFile($params) {
		$this->controller->set('file', $params['file']);  
		$this->_outputMessage('cannot_write_file');
	}
	
	/**
	 * 
	 * @param params['message'] The message that is shown for the error.
	 * @return 
	 * 
	*/
	function basic($params) {
		if(empty($params['message'])) $params['message'] = 'There is an error in the code at this point.';
		$this->controller->set('message', $params['message']);  
		$this->_outputMessage('basic');
	}
}
?>