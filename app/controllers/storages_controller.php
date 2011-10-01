<?php
class StoragesController extends AppController {

	var $name = 'Storages';
	
	var $components = array('Email');
	
	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
	public function beforeFilter(){
		parent::beforeFilter();
		
		//Make certain pages public
		$this->Auth->allowedActions = array('ajax_toggle','isStoring');
											
		//$this->Auth->allow('getLikes','getDislikes','getUserLikes','getUserDislikes');
		$this->AjaxHandler->handle('ajax_toggle');
		
		/* SMTP Options */
		$this->Email->smtpOptions = array(
			'port'=>'25',
			'timeout'=>'30',
			'host' => 's64785.gridserver.com',
			'username'=>'mailer@find-get-make.com',
			'password'=>'fgmmailer',
			'client' => 's64785.gridserver.com'
		);

	    /* Set delivery method */
	    $this->Email->delivery = 'smtp';
		
		$this->Email->replyTo = '<noreply@'.env('HTTP_HOST').'>'; 
		$this->Email->return = '<noreply@'.env('HTTP_HOST').'>';
	}
	
	/**************** AJAX METHODS ************************/
	
	/**
	 * Toggles whether or not a user has an item in their storage
	 * @param string model The item type to target
	 * @param int model_id The item id to target
	 * @return 
	 * 
	*/
	public function ajax_toggle($model="Product",$model_id){
		$this->Storage->recursive = -1;
		Configure::write('debug', 0);

		if($this->RequestHandler->isAjax()) {
			$this->autoLayout = false;
			$this->autoRender = false;
			$response = array('success' => false);
			//Only allow the user to like or dislike a single item
			
			//Get the logged in user
			$user_id = $this->Auth->user('id');
			if(!$user_id){
				$this->Session->setFlash(__('You have to login before you can store items.', true));
				$this->redirect(array('controller'=>'users','action' => 'login'));
			}
			
			//Check to see if the item is already being stored. If it is, remove it, otherwise add it.
			$storageCheck = $this->Storage->getItem($model,$model_id);
			if(!empty($storageCheck)){
				//Remove the item
				if($this->Storage->delete($storageCheck['Storage']['id'])){
					//Delete successful
					$storageCheck['Storage']['deleted'] = true;
					$this->AjaxHandler->response(true, $storageCheck);
				}else{
					$this->AjaxHandler->response(false, 'There was a problem adding this item to your storage. Please, try again.', 0);
				}
			}else{
				//Add the item
				$this->data['Storage']['model'] = $model;
				$this->data['Storage']['model_id'] = $model_id;
				$this->data['Storage']['user_id'] = $user_id;
				$this->data['Storage']['name'] = Inflector::pluralize(strtolower($model));
				$this->Storage->create();
				if($this->Storage->save($this->data)){
					//Save successful
					$this->AjaxHandler->response(true, $this->data);
				}else{
					$this->AjaxHandler->response(false, 'There was a problem adding this item to your storage. Please, try again.', 0);
				}
			}
		}
		
		$this->AjaxHandler->respond();
		return;
	}
	
	/**************** END AJAX METHODS ************************/
	
	/**
	 * Check to see if the user is storing the item in their storage bin
	 * @param string model
	 * @param int model_id
	 * @return 
	 * 
	*/
	public function isStoring($model="Product",$model_id=null){
		if (!empty($this->params['requested'])) {
			//Check to see if the user is storing this item
			$user_id = $this->Auth->user('id');
			$user = $this->Storage->User->find('first',array('conditions'=>array('User.id'=>$user_id),'contain'=>array('Storage')));
			if(!empty($user['Storage'])){
				if($user['Storage'][0]['model'] == $model && $user['Storage'][0]['model_id'] == $model_id){
					//The user is storing this item.
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		} else {
			//
		}
	}
}
