<?php
class OwnershipsController extends AppController {

	var $name = 'Ownerships';
	
	public function beforeFilter(){
		parent::beforeFilter();
		
		//Make certain pages public
		$this->Auth->allowedActions = array('getHaveCount','getWantCount','getHadCount',
											'getType','getHaveUsers','getWantUsers',
											'getHadUsers','haves','wants'
											);
											
		$this->AjaxHandler->handle('ajax_set_ownership');
		
	}
	
	/**************** AJAX METHODS ************************/
	
	/**
	 * Sets the ownership status of an item
	 * @param string model The model that to set the ownership for
	 * @return 
	 * 
	*/
	public function ajax_set_ownership($model=null,$model_id=null){
		Configure::write('debug', 0);
		if(!empty($this->data)) {
			$ownership_types = array('had_it','want_it','have_it');
			$niceNames = array('had','want','have');
			$total_who_have = 0;
			$total_who_want = 0;
			$total_who_had = 0;
				
			if($this->RequestHandler->isAjax()) {
				$this->autoLayout = false;
				$this->autoRender = false;
				$response = array('success' => false);
				
				//The data is not passed into the method via AJAX call. Get the data from the data array 
				if(empty($model)) $model = $this->data['Ownership']['model']; 
				if(empty($model_id)) $model_id = $this->data['Ownership']['model_id']; 
				$controller = Inflector::pluralize(strtolower($model));
				$user_id = $this->Auth->user('id');
				
				//Double check to make sure the user is still logged in.
				if($user_id){
					$data = $this->Ownership->getFirst($user_id,$model,$model_id);
					
					//Make sure the user only has one want it, had it, or have it.
					if(!empty($data)){
						//Update an existing ownership for this user
						$this->Ownership->read(null,$data['Ownership']['id']);
						
						foreach($ownership_types as $type){
							if($this->data['Ownership']['ownership'] == $type){
								$this->Ownership->set(array(
															'name' => $controller,
															'model' => $model,
															'model_id' => $model_id,
															$type => 1
															)
														);
							}else{
								$this->Ownership->set(array(
															$type => 0
															)
														);
							}
						}
						
						if($this->Ownership->save()){
							//The save was successful
						}else{
							$this->AjaxHandler->response(false, 'There was a problem saving your request. Please, try again.', 0);
							$this->AjaxHandler->respond();
							return;
						}

					}else{
						//Create a new ownership for this user
						$this->Ownership->create();
						$this->Ownership->set(array(
													'user_id' => $user_id,
													'model' => $model,
													'model_id' => $model_id,
													'name' => $controller
													)
												);
					
						foreach($ownership_types as $type){
							if($this->data['Ownership']['ownership'] == $type){
								$this->Ownership->set($type, 1);
							}else{
								$this->Ownership->set($type,0);
							}
						}
						if($this->Ownership->save()){
							//The save was successful
						}else{
							$this->AjaxHandler->response(false, 'There was a problem saving your request. Please, try again.', 0);
							$this->AjaxHandler->respond();
							return;
						}
					}
					
					//Return the type of ownership that was updated
					$type_niceName = '';
					for($i=0;$i<count($ownership_types);$i++){
						if($ownership_types[$i]==$this->data['Ownership']['ownership']){
							$type_niceName = $niceNames[$i];
						}
					}
					//Return the total counts for each type
					$total_who_have = $this->getHaveCount($model,$model_id);
					$total_who_want = $this->getWantCount($model,$model_id);
					$total_who_had = $this->getHadCount($model,$model_id);

					$return_data = array(
										'total_who_have'=>$total_who_have,
										'total_who_want'=>$total_who_want,
										'total_who_had'=>$total_who_had,
										'ownership_type'=>$type_niceName
										);
									
					//return json_encode($return_data);
					$this->AjaxHandler->response(true, $return_data);
					$this->AjaxHandler->respond();
					
					if(!empty($this->data['Ownership']['id'])){
						$last = $this->Ownership->read(null,$this->data['Ownership']['id']);
					}else{
						$last = $this->Ownership->read(null,$this->Ownership->getLastInsertID());
					}
					$this->Ownership->Feed->addFeedData('Ownership',$last);
					
					return;
				}
			}else{
				if(empty($user_id)){
					$this->Session->setFlash(__('You are not logged in.', true));
					$this->redirect(array('controller'=>'users','action' => 'login'));
					$this->AjaxHandler->response(false, 'Your session has ended. Please log back in.', 0);
					$this->AjaxHandler->respond();
					return;
				}
			}
		}
	}
	
	/**************** END AJAX METHODS ************************/
	
	/**
	 * This method handles showing all of the items that the user owns
	 * @param int user_id The user id 
	 * @return 
	 * 
	*/
	public function haves($user_id=null){
		if (!$user_id) {
			$this->Session->setFlash(__('Invalid user id', true));
			$this->redirect('/');
		}
		$products = array();	
		$product_ids = array();
		$user = $this->Ownership->User->read(null,$user_id);
		
		$this->Ownership->recursive = 1;
		$this->paginate = array(
								'conditions'=>array(
													'Ownership.user_id'=>$user_id,
													'Ownership.have_it'=>1,
													'Ownership.model'=>'Product'
													),
								'contain'=>array('Product'=>array('Attachment','Tag','User'))
								);
		$products = $this->paginate('Ownership');
		$this->set(compact('user','products'));
	}
	
	
	/**
	 * This method handles showing the items that the user wants
	 * @param int user_id The user id 
	 * @return 
	 * 
	*/
	public function wants($user_id=null){
		if (!$user_id) {
			$this->Session->setFlash(__('Invalid user id', true));
			$this->redirect('/');
		}

		$products = array();	
		$product_ids = array();
		$user = $this->Ownership->User->read(null,$user_id);
		
		$this->paginate = array(
								'conditions'=>array(
													'Ownership.user_id'=>$user_id,
													'Ownership.want_it'=>1,
													'Ownership.model'=>'Product'
													),
								'contain'=>array('Product'=>array('Attachment','Tag','User'))
								);
		$products = $this->paginate('Ownership');
									
		$this->set(compact('user','products'));
	}
	

	
	// =================================
	// = Returns only the total counts =
	// =================================
	/**
	 * 
	 * @param model
	 * @param model_id
	 * @return 
	 * 
	*/
	public function getHaveCount($model=null,$model_id=null){
		$count = $this->Ownership->getHaveCount($model,$model_id);
		return $count;
	}
	
	/**
	 * 
	 * @param model
	 * @param model_id
	 * @return 
	 * 
	*/
	public function getWantCount($model=null,$model_id=null){
		$count = $this->Ownership->getWantCount($model,$model_id);
		return $count;
	}
	
	/**
	 * 
	 * @param model
	 * @param model_id
	 * @return 
	 * 
	*/
	public function getHadCount($model=null,$model_id=null){
		$count = $this->Ownership->getHadCount($model,$model_id);
		return $count;
	}
	
	// =============================
	// = Returns entire User array =
	// =============================
	/**
	 * 
	 * @param model
	 * @param model_id
	 * @return 
	 * 
	*/
	public function getHaveUsers($model=null,$model_id=null){
		$data = $this->Ownership->getHaveUsers($model,$model_id);
		return $data;
	}
	
	/**
	 * 
	 * @param model
	 * @param model_id
	 * @return 
	 * 
	*/
	public function getWantUsers($model=null,$model_id=null){
		$data = $this->Ownership->getWantUsers($model,$model_id);
		return $data;
	}
	
	/**
	 * 
	 * @param model
	 * @param model_id
	 * @return 
	 * 
	*/
	public function getHadUsers($model=null,$model_id=null){
		$data = $this->Ownership->getHadUsers($model,$model_id);
		return $data;
	}
	
	/**
	 * Returns the ownership type
	 * @param user_id
	 * @param model
	 * @param model_id
	 * @return 
	 * 
	*/
	public function getType($user_id=null,$model=null,$model_id=null){
		return $this->Ownership->getOwnershipType($user_id,$model,$model_id);
	}
	
}