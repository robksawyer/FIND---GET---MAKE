<?php
/**
 * Votes are named like/dislike in the system
 */
class Vote extends AppModel {
	var $name = 'Vote';

	var $validate = array('user_id' => array('rule' => array('maxLength', 36),
										   'required' => true),
						'model_id' => array('rule' => array('maxLength', 36),
											'required' => true),
						'model' => array('rule' => 'alphaNumeric',
										 'required' => true));
										
	var $belongsTo = array(
						'User' => array(
							'className' => 'User',
							'foreignKey' => 'user_id',
							'conditions' => '',
							'fields' => '',
							'order' => ''
						),
						'Product' => array(
							'className' => 'Product',
							'foreignKey' => 'model_id',
							'fields' => '',
							'order' => ''
						)
						);
	var $hasMany = array(
		'Feed' => array(
			'className' => 'Feed',
			'foreignKey' => 'model_id',
			'conditions' => array('Feed.model' => 'Vote'),
			'dependent' => true,
			'exclusive' => true
		)
	);
	
	/**
	 * Updates the total count in the user table for this particular type of item
	 * @param created 
	 * @return 
	 * 
	*/	
	/*function afterSave($created){
		if($created){
			//Update the total count for the user
			$last = $this->read(null,$this->id);
			if(!empty($last['User']['id']) && $last['Vote']['likes'] == 1){
				//Add the feed data to the feed
				$this->Feed->addFeedData('Vote',$last);
			}
		}
	}*/
	
	/**
	 * Update the feed with the latest liked item
	 * @param 
	 * @return 
	 * 
	*/
	public function updateFeed($id=null){
		$this->recursive = 1;
		if($id){			
			$last = $this->read(null,$id);
			if(!empty($last['Vote']['user_id'])){
				//Check to see if it was a like or dislike
				if($last['Vote']['likes'] == 1){
					//Add the feed data to the feed
					$this->Feed->addFeedData('Vote',$last);
				}else if($last['Vote']['dislikes'] == 1){
					//Disliked item
					$this->Feed->removeFeedData('Vote',$last);
				}
			}
		}
	}
	
	/**
	 * Returns the needed feed data for a specific record
	 * @param int model_id
	 * @return 
	 * 
	*/
	public function getFeedData($model_id=null){
		$this->recursive = 2;
		$this->User->recursive = -1;
		$data = $this->read(null,$model_id);	
		
		return $data;
	}
	
	/**
	 * This method returns the total number of likes in the system for a specific item
	 * @param model
	 * @param model_id
	 * @return $count The number of likes
	 * 
	*/
	function getLikes($model=null,$model_id=null){
		$count = $this->find('count',array('conditions'=>array(
													'likes'=>'1',
													'model'=>$model,
													'model_id'=>$model_id
													)));
		return $count;
	}
	
	/**
	 * This method returns the total number of dislikes in the system for a specific item
	 * @param model
	 * @param model_id
	 * @return $count The number of dislikes
	 * 
	*/
	function getDislikes($model=null,$model_id=null){
		$count = $this->find('count',array('conditions'=>array(
													'dislikes'=>'1',
													'model'=>$model,
													'model_id'=>$model_id
													)));
		return $count;
	}
	
	/**
	 * This method returns the total number of likes made by the user for a specific item
	 * @param model
	 * @param model_id
	 * @param user_id
	 * @return $count The number of dislikes
	 * 
	*/
	function getUserLikes($model=null,$model_id=null,$user_id=null){
		$count = $this->find('count',array('conditions'=>array(
													'likes'=>'1',
													'Vote.user_id'=>$user_id,
													'model'=>$model,
													'model_id'=>$model_id
													)));
		return $count;
	}
	
	/**
	 * This method returns the total number of dislikes made by the user for a specific item
	 * @param model
	 * @param model_id
	 * @param user_id
	 * @return $count The number of dislikes
	 * 
	*/
	function getUserDislikes($model=null,$model_id=null,$user_id=null){
		$count = $this->find('count',array('conditions'=>array(
													'dislikes'=>'1',
													'Vote.user_id'=>$user_id,
													'model'=>$model,
													'model_id'=>$model_id
													)));
		return $count;
	}
	
	/**
	 * This method returns the total number of likes made by the user
	 * @param model
	 * @param user_id
	 * @return $count The number of dislikes
	 * 
	*/
	function getAllUserLikes($model=null,$user_id=null){
		$count = $this->find('count',array('conditions'=>array(
													'likes'=>'1',
													'Vote.user_id'=>$user_id,
													'model'=>$model
													)));
		return $count;
	}
	
	/**
	 * This method returns the total number of dislikes made by the user
	 * @param model
	 * @param user_id
	 * @return $count The number of dislikes
	 * 
	*/
	function getAllUserDislikes($model=null,$user_id=null){
		$count = $this->find('count',array('conditions'=>array(
													'dislikes'=>'1',
													'Vote.user_id'=>$user_id,
													'model'=>$model
													)));
		return $count;
	}
	
}
?>