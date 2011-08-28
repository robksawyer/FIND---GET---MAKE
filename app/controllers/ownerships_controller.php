<?php
class OwnershipsController extends AppController {

	var $name = 'Ownerships';
	
	function beforeFilter(){
		parent::beforeFilter();
		
		//Make certain pages public
		$this->Auth->allowedActions = array('getHaveCount','getWantCount','getHadCount','getType','getHaveUsers','getWantUsers','getHadUsers');
		//$this->Auth->allow('getHaveCount','getWantCount','getHadCount','getType','getHaveUsers','getWantUsers','getHadUsers');
		$this->AjaxHandler->handle('admin_set_ownership');
	}
	
	
	/**
	 * This method handles showing all of the items that the user owns
	 * @param int user_id The user id 
	 * @return 
	 * 
	*/
	function haves($user_id=null){
		if (!$user_id) {
			$this->Session->setFlash(__('Invalid user id', true));
			$this->redirect('/');
		}
		$user = $this->Ownership->User->find('first',array('conditions'=>array('User.id'=>$user_id)));
		if(empty($user)){
			$this->Session->setFlash(__('Invalid user id', true));
			$this->redirect('/');
		}
										
		$products = array();	
		$product_ids = array();
		foreach($user['Ownership'] as $inspiration){
			//Find likes only
			if($inspiration['model'] == 'Product' && $inspiration['have_it']==1){
				$product_ids[] = $inspiration['model_id'];
			}
		}
		
		$products = $this->paginate('Product',array(
									   'Product.id' => $product_ids
									));
									
		$this->set(compact('user','products'));
	}
	
	
	/**
	 * This method handles showing the items that the user wants
	 * @param int user_id The user id 
	 * @return 
	 * 
	*/
	function wants($user_id=null){
		if (!$user_id) {
			$this->Session->setFlash(__('Invalid user id', true));
			$this->redirect('/');
		}
		$user = $this->Ownership->User->find('first',array('conditions'=>array('User.id'=>$user_id)));
		if(empty($user)){
			$this->Session->setFlash(__('Invalid user id', true));
			$this->redirect('/');
		}
		
		$products = array();	
		$product_ids = array();
		foreach($user['Ownership'] as $inspiration){
			//Find dislikes only
			if($inspiration['model'] == 'Product' && $inspiration['want_it']==1){
				$product_ids[] = $inspiration['model_id'];
			}
		}
		
		$products = $this->paginate('Product',array(
									   'Product.id' => $product_ids
									));
									
		$this->set(compact('user','products'));
	}
	
	// =================
	// = Set Ownership =
	// =================
	/**
	 * 
	 * @param string model The model that to set the ownership for
	 * @return 
	 * 
	*/
	function admin_set_ownership($model=null,$model_id=null){
		Configure::write('debug', 0);
		if(!empty($this->data)) {
			$ownership_types = array('had_it','want_it','have_it');
			$niceNames = array('had','want','have');
			$total_who_have = 0;
			$total_who_want = 0;
			$total_who_had = 0;

			$user_id = $this->Auth->user('id');
				
			if($this->RequestHandler->isAjax()) {
				$this->autoLayout = false;
				$this->autoRender = false;
				$response = array('success' => false);
				
				//The data is not passed into the method via AJAX call. Get the data from the data array 
				//debug($model);
				//debug($model_id);
				if(empty($model)) $model = $this->data['Ownership']['model']; 
				if(empty($model_id)) $model_id = $this->data['Ownership']['model_id']; 
				//debug($this->data);
				//Double check to make sure the user is still logged in.
				if($user_id){
					$data = $this->Ownership->getFirst($user_id,$model,$model_id);
					//debug($data);
					//Make sure the user only has one want it, had it, or have it.
					if(!empty($data)){
						//Update an existing ownership for this user
						$this->Ownership->read(null,$data['Ownership']['id']);
						$this->Ownership->id = $data['Ownership']['id'];
						foreach($ownership_types as $type){
							if($this->data['Ownership']['ownership'] == $type){
								$this->Ownership->saveField('name',strtolower($model));
								$this->Ownership->saveField('model',$model);
								$this->Ownership->saveField('model_id',$model_id);
								$this->Ownership->saveField($type,1);
							}else{
								$this->Ownership->saveField('name',strtolower($model));
								$this->Ownership->saveField('model',$model);
								$this->Ownership->saveField('model_id',$model_id);
								$this->Ownership->saveField($type,0);
							}
						}
						//$this->Ownership->read(null,$data['Ownership']['id']);
						//debug($this->data);
					}else{
						//Create a new ownership for this user
						$this->Ownership->create();
						$this->Ownership->set('user_id',$user_id);
						$this->Ownership->set('model',$model);
						$this->Ownership->set('model_id',$model_id);
						$this->Ownership->set('name',strtolower($model));
					
						foreach($ownership_types as $type){
							if($this->data['Ownership']['ownership'] == $type){
								$this->Ownership->set($type, 1);
							}else{
								$this->Ownership->set($type,0);
							}
						}
						if($this->Ownership->save()){
							//$this->Ownership->read(null,$this->Ownership->getLastInsertID());
						}else{
							$this->AjaxHandler->response(false, 'There was a problem saving your request. Please, try again.', 0);
						}
					
						//debug($this->data);
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
					return;
				}
			}else{
				if(empty($user_id)){
					$this->Session->setFlash(__('You are not logged in.', true));
					$this->redirect(array('controller'=>'users','action' => 'login'));
				}
			}
		}
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
	function getHaveCount($model=null,$model_id=null){
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
	function getWantCount($model=null,$model_id=null){
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
	function getHadCount($model=null,$model_id=null){
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
	function getHaveUsers($model=null,$model_id=null){
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
	function getWantUsers($model=null,$model_id=null){
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
	function getHadUsers($model=null,$model_id=null){
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
	function getType($user_id=null,$model=null,$model_id=null){
		return $this->Ownership->getOwnershipType($user_id,$model,$model_id);
	}
	
}
?>