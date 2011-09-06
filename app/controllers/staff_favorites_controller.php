<?php
class StaffFavoritesController extends AppController {

	var $name = 'StaffFavorites';

	public function beforeFilter(){
		parent::beforeFilter();
		
		//Make certain pages public
		$this->Auth->allowedActions = array('index','view');
		
		$this->AjaxHandler->handle('add','remove');
	}
	
	function index() {
		$this->StaffFavorite->recursive = 0;
		$this->set('staffFavorites', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid staff favorite', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('staffFavorite', $this->StaffFavorite->read(null, $id));
	}

	/**
	 * Adds an item to the staff favorites list.
	 * @param string model The model name of the item
	 * @param int model_id The model id of the item to add  
	 * @return 
	 * 
	*/
	function add($model='',$model_id=null) {
		Configure::write('debug', 0);
		if($this->RequestHandler->isAjax()) {
			$this->autoLayout = false;
			$this->autoRender = false;
			$response = array('success' => false);
			
			//Get the user logged in
			$user = $this->Auth->user();
			if(!$user){
				$this->Session->setFlash(__('You have to login before you can add a staff favorite.', true));
				$this->redirect(array('admin'=>false,'plugin'=>'','controller'=>'users','action' => 'login'));
			}
			
			//Check to see if the record already exists
			$staffFavoriteRecordCheck = $this->StaffFavorite->find('first',array('conditions'=>array(
																						'StaffFavorite.model'=>$model,
																						'StaffFavorite.model_id'=>$model_id,
																						'StaffFavorite.user_id'=>$user['User']['id']
																						)));
			if(empty($staffFavoriteRecordCheck)){
				$this->StaffFavorite->create();
				
				$save_data['StaffFavorite']['model'] = $model;
				$save_data['StaffFavorite']['model_id'] = $model_id;
				$save_data['StaffFavorite']['name'] = Inflector::pluralize(strtolower($model));
				$save_data['StaffFavorite']['user_id'] = $user['User']['id'];
				
				if ($this->StaffFavorite->save($save_data)) {
					//$this->Session->setFlash(__('The staff favorite has been saved', true));
					//The save was successful
					$data = array('model'=>$model,'model_id'=>$model_id,'user_id'=>$user['User']['id']);
					$this->AjaxHandler->response(true, $data);
				} else {
					$this->AjaxHandler->response(false, null);
					//$this->Session->setFlash(__('The staff favorite could not be saved. Please, try again.', true));
				}
				
			}else{
				//$this->Session->setFlash(__('You\'ve already added this item as a staff favorite.', true));
				$data = array('model'=>$model,'model_id'=>$model_id,'user_id'=>$user['User']['id']);
				$this->AjaxHandler->response(true, $data);
			}
			
			//Send the response
			$this->AjaxHandler->respond();
		}
		$users = $this->StaffFavorite->User->find('list');
		$this->set(compact('users'));
	}
	
	/**
	 * Removes an item from the staff favorites
	 * @param string model The model name of the item
	 * @param int model_id The model id of the item to add
	 * @return 
	 * 
	*/
	public function remove($model='',$model_id=null){
		
	}
	
	/**
	 * Returns whether or not the item is favorited
	 * @param string model 
	 * @param int model_id
	 * @return 
	 * 
	*/
	public function isFavorited($model='',$model_id=null){
		return $this->hasItemBeenFavorited($model,$model_id);
	}
	
	/**
	 * Returns the most recent ten staff favorited users
	 * @param 
	 * @return 
	 * 
	*/
	public function getTenUsers(){
		return $this->getTenUsers();
	}
	
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid staff favorite', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->StaffFavorite->save($this->data)) {
				$this->Session->setFlash(__('The staff favorite has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The staff favorite could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->StaffFavorite->read(null, $id);
		}
		$users = $this->StaffFavorite->User->find('list');
		$this->set(compact('users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for staff favorite', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->StaffFavorite->delete($id)) {
			$this->Session->setFlash(__('Staff favorite deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Staff favorite was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}