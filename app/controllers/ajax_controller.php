<?php
/**
 * This controller handles all of the ajax requests in the app.
 * @param 
 * @return 
 * 
*/
class AjaxController extends AppController{
	
	var $name = 'Ajax';
	
	var $uses = array();
	
	public function beforeFilter(){
		parent::beforeFilter();
		
		$this->AjaxHandler->handle('*');
	}
	
}