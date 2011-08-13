<?php
/**
 * 
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