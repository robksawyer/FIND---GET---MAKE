<?php
class VotesController extends AppController {

	var $name = 'Votes';
	
	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
	public function beforeFilter(){
		parent::beforeFilter();
		
		//Make certain pages public
		$this->Auth->allowedActions = array('getLikes','getDislikes',
											'getUserLikes','getUserDislikes'
											);
											
		//$this->Auth->allow('getLikes','getDislikes','getUserLikes','getUserDislikes');
		$this->AjaxHandler->handle('vote_up','vote_down','remove_vote');
	}
	
	/**
	 * This method handles showing the user's likes for all models
	 * @param int user_id The user id 
	 * @return 
	 * 
	*/
	public function likes($user_id=null){
		if (!$user_id) {
			$this->Session->setFlash(__('Invalid user id', true));
			$this->redirect('/');
		}
		$user = $this->Vote->User->find('first',array('conditions'=>array('User.id'=>$user_id)));
		if(empty($user)){
			$this->Session->setFlash(__('Invalid user id', true));
			$this->redirect('/');
		}
										
		$products = array();	
		$product_ids = array();
		foreach($user['Vote'] as $vote){
			//Find likes only
			if($vote['model'] == 'Product' && $vote['likes']==1){
				$product_ids[] = $vote['model_id'];
			}
		}
		
		$products = $this->paginate('Product',array(
									   'Product.id' => $product_ids
									));
									
		$this->set(compact('user','products'));
	}
	
	
	/**
	 * This method handles showing the user's dislikes for all models
	 * @param int user_id The user id 
	 * @return 
	 * 
	*/
	public function dislikes($user_id=null){
		if (!$user_id) {
			$this->Session->setFlash(__('Invalid user id', true));
			$this->redirect('/');
		}
		$user = $this->Vote->User->find('first',array('conditions'=>array('User.id'=>$user_id)));
		if(empty($user)){
			$this->Session->setFlash(__('Invalid user id', true));
			$this->redirect('/');
		}
		
		$products = array();	
		$product_ids = array();
		foreach($user['Vote'] as $vote){
			//Find dislikes only
			if($vote['model'] == 'Product' && $vote['dislikes']==1){
				$product_ids[] = $vote['model_id'];
			}
		}
		
		$products = $this->paginate('Product',array(
									   'Product.id' => $product_ids
									));
									
		$this->set(compact('user','products'));
	}
	
	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
	public function vote_up($model,$model_id){
		$this->Vote->recursive = -1;
		Configure::write('debug', 0);
		if($this->RequestHandler->isAjax()) {
			$this->autoLayout = false;
			$this->autoRender = false;
			$response = array('success' => false);

			//Only allow the user to like or dislike a single item
			
			//Get the logged in user
			$user_id = $this->Auth->user('id');
			if(!$user_id){
				$this->Session->setFlash(__('You have to login before you can vote on items.', true));
				$this->redirect(array('controller'=>'users','action' => 'login'));
			}
			
			//See if the user has already voted on this $view
			$votes = $this->Vote->find('first',array('conditions'=>array(
																		'user_id'=>$user_id,
																		'model'=>$model,
																		'model_id'=>$model_id
																		)));
			if(empty($votes)){
				$this->Vote->create();
				$this->Vote->set('model_id',$model_id);
				$this->Vote->set('model',$model);
				$this->Vote->set('name',strtolower($model));
				$this->Vote->set('user_id', $user_id);
				$this->Vote->set('likes', 1);
				$this->Vote->set('dislikes', 0);
				
				if($this->Vote->save()){
					$lastInsertId = $this->Vote->getLastInsertID();
					
					//Update the feed with the latest liked item.
					$this->Vote->updateFeed($lastInsertId);
					
					$types = $this->setLikesDislikes($model,$model_id,'up');
					$this->AjaxHandler->response(true, $types);
				}else{
					$this->AjaxHandler->response(false, 'There was a problem setting the vote. Please, try again.', 0);
				}
			}else{
				//The vote already exists
				
				$this->Vote->id = $votes['Vote']['id'];
				$lastInsertId = $votes['Vote']['id'];
				//$this->Vote->saveField('model_id',$model_id);
				//$this->Vote->saveField('user_id', $user_id);
				$this->Vote->saveField('likes', 1);
				$this->Vote->saveField('dislikes', 0);
				
				//Update the feed with the latest liked item.
				$this->Vote->updateFeed($votes['Vote']['id']);
				
				$types = $this->setLikesDislikes($model,$model_id,'up');
				$this->AjaxHandler->response(true, $types);
			}
			
			$this->AjaxHandler->respond();
			
			//Update the user's totalLikes
			$this->Vote->User->updateTotalLikesDislikes($model,$user_id);
			
			return;
		}
	}
	
	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
	public function vote_down($model,$model_id){
		$this->Vote->recursive = -1;
		Configure::write('debug', 0);
		if($this->RequestHandler->isAjax()) {
			$this->autoLayout = false;
			$this->autoRender = false;
			$response = array('success' => false);
			//Only allow the user to like or dislike a single item
			
			//Get the logged in user
			$user_id = $this->Auth->user('id');
			if(!$user_id){
				$this->Session->setFlash(__('You have to login before you can vote on items.', true));
				$this->redirect(array('controller'=>'users','action' => 'login'));
			}
			
			//See if the user has already voted on this $view
			$votes = $this->Vote->find('first',array('conditions'=>array(
																		'user_id'=>$user_id,
																		'model_id'=>$model_id,
																		'model'=>$model
																		)));
			if(empty($votes)){
				$this->Vote->create();
				$this->Vote->set('model_id',$model_id);
				$this->Vote->set('model',$model);
				$this->Vote->set('name',strtolower($model));
				$this->Vote->set('user_id', $user_id);
				$this->Vote->set('likes', 0);
				$this->Vote->set('dislikes', 1);
				if($this->Vote->save()){
					//The save completed
					$lastInsertId = $this->Vote->getLastInserID();
					$types = $this->setLikesDislikes($model,$model_id,'down');
					
					//Update the feed with the latest liked item.
					$this->Vote->updateFeed($lastInsertId);
					
					$this->AjaxHandler->response(true, $types);
				}else{
					$this->AjaxHandler->response(false, 'There was a problem setting the vote. Please, try again.', 0);
				}
			}else{
				//The vote already exists
				
				$this->Vote->id = $votes['Vote']['id'];
				$lastInsertId = $votes['Vote']['id'];
				//$this->Vote->set('model_id',$id);
				//$this->Vote->set('model',$model);
				//$this->Vote->set('name',strtolower($model));
				//$this->Vote->set('user_id', $user_id);
				$this->Vote->saveField('likes', 0);
				$this->Vote->saveField('dislikes', 1);
				
				$types = $this->setLikesDislikes($model,$model_id,'down');
				
				//Update the feed with the latest liked item.
				$this->Vote->updateFeed($votes['Vote']['id']);
				
				$this->AjaxHandler->response(true, $types);
			}
			
			$this->AjaxHandler->respond();
			
			//Update the user's totalDisLikes
			$this->Vote->User->updateTotalLikesDislikes($model,$user_id);
			
			return;
		}
	}
	
	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
	public function remove_vote($model,$model_id){
		$this->Vote->recursive = -1;
		Configure::write('debug', 0);

		if($this->RequestHandler->isAjax()) {
			$this->autoLayout = false;
			$this->autoRender = false;
			$response = array('success' => false);
			//Only allow the user to like or dislike a single item
			
			//Get the logged in user
			$user_id = $this->Auth->user('id');
			if(!$user_id){
				$this->Session->setFlash(__('You have to login before you can vote on items.', true));
				$this->redirect(array('controller'=>'users','action' => 'login'));
			}
			
			//See if the user has already voted on this $view
			$votes = $this->Vote->find('first',array('conditions'=>array(
																		'user_id'=>$user_id,
																		'model_id'=>$model_id,
																		'model'=>$model
																		)));
			if(empty($votes)){
				$this->Vote->create();
				$this->Vote->set('model_id',$model_id);
				$this->Vote->set('model',$model);
				$this->Vote->set('name',strtolower($model));
				$this->Vote->set('user_id', $user_id);
				$this->Vote->set('likes', 0);
				$this->Vote->set('dislikes', 0);
				if($this->Vote->save()){
					$types = $this->setLikesDislikes($model,$model_id,'removed');
					$this->AjaxHandler->response(true, $types);
				}else{
					$this->AjaxHandler->response(false, 'There was a problem setting the vote. Please, try again.', 0);
				}
			}else{
				$this->Vote->id = $votes['Vote']['id'];
				//$this->Vote->saveField('model_id',$id);
				//$this->Vote->saveField('model',$model);
				$this->Vote->saveField('name',strtolower($model));
				//$this->Vote->saveField('user_id', $user_id);
				$this->Vote->saveField('likes', 0);
				$this->Vote->saveField('dislikes', 0);
				
				$types = $this->setLikesDislikes($model,$model_id,'removed');
				$this->AjaxHandler->response(true, $types);
			}
			
			$this->AjaxHandler->respond();
			return;
		}
	}
	
	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
	public function setLikesDislikes($model=null,$model_id=null,$kind=null){
		//Count the likes and dislikes
		$likes = $this->Vote->getLikes($model,$model_id);
		$dislikes = $this->Vote->getDislikes($model,$model_id);
		
		$user_likes = $this->Vote->getUserLikes($model,$model_id,$this->Auth->user('id'));
		$user_dislikes = $this->Vote->getUserDislikes($model,$model_id,$this->Auth->user('id'));
		
		//$this->set(compact('likes','dislikes'));
		$types = array ('likes'=>$likes,
						'dislikes'=>$dislikes,
						'type'=>$kind,
						'user_likes'=>$user_likes,
						'user_dislikes'=>$user_dislikes,
						'id'=>$model_id
						);
		//return json_encode($types);
		return $types;
	}
	
	/*
		TODO Move the following methods into the model
	*/
	public function getLikes($model,$model_id){
		return $this->Vote->getLikes($model,$model_id);
	}
	
	public function getDislikes($model,$model_id){
		return $this->Vote->getDislikes($model,$model_id);
	}
	
	public function getUserLikes($model,$model_id){
		$user_id = $this->Auth->user('id');
		return $this->Vote->getUserLikes($model,$model_id,$user_id);
	}
	
	public function getUserDislikes($model,$model_id){
		$user_id = $this->Auth->user('id');
		return $this->Vote->getUserDislikes($model,$model_id,$user_id);
	}
	
	/**
	 * Returns a count of all of the user's likes
	 * @param 
	 * @return 
	 * 
	*/
	public function getAllUserLikes($model=null){
		$user_id = $this->Auth->user('id');
		return $this->Vote->getAllUserLikes($model,$user_id);
	}
	
	/**
	 * Returns a count of all of the user's dislikes
	 * @param 
	 * @return 
	 * 
	*/
	public function getAllUserDislikes($model=null){
		$user_id = $this->Auth->user('id');
		return $this->Vote->getAllUserDislikes($model,$user_id);
	}
	
	
}
?>