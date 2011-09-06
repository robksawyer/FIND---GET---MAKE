<?php
class StaffFavorite extends AppModel {
	var $name = 'StaffFavorite';
	var $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	
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
						),
						'Source' => array(
							'className' => 'Source',
							'foreignKey' => 'model_id',
							'fields' => '',
							'order' => ''
						),
						'Inspiration' => array(
							'className' => 'Inspiration',
							'foreignKey' => 'model_id',
							'fields' => '',
							'order' => ''
						),
						'Collection' => array(
							'className' => 'Collection',
							'foreignKey' => 'model_id',
							'fields' => '',
							'order' => ''
						),
						'Ufo' => array(
							'className' => 'Ufo',
							'foreignKey' => 'model_id',
							'fields' => '',
							'order' => ''
						)
					);
						
	var $hasMany = array(
		'Feed' => array(
			'className' => 'Feed',
			'foreignKey' => 'model_id',
			'conditions' => array('Feed.model' => 'StaffFavorite'),
			'dependent' => true,
			'exclusive' => true
		)
	);
	
	/**
	 * Update the feed with the latest staff favorites
	 * @param 
	 * @return 
	 * 
	*/
	public function updateFeed($id=null){
		$this->recursive = 1;
		if($id){			
			$last = $this->read(null,$id);
			if(!empty($last['StaffFavorite']['user_id'])){
				//Check to see if the model id exists
				if(!empty($last['StaffFavorite']['model_id'])){
					//Add the feed data to the feed
					$this->Feed->addFeedData('StaffFavorite',$last);
				}else {
					//Disliked item
					$this->Feed->removeFeedData('StaffFavorite',$last);
				}
			}
		}
	}
	
	/**
	 * Returns the latest ten staff favorited item
	 * @param 
	 * @return 
	 * 
	*/
	public function getTenUsers(){
		$this->recursive = -1;
		$data = $this->find('list',array(
										'conditions'=>array(
											'StaffFavorite.model'=>'User'
										),
										'fields'=>'StaffFavorite.model_id',
										'limit'=>10,
										'order'=>array('StaffFavorite.created'=>'desc')
										));
		$data = array_values($data);
		$users = $this->User->find('all',array(
									'conditions'=>array(
										'User.id'=>$data
									),
									'contain'=>array('Product'=>array(
																	'limit'=>3,
																	'Attachment'
																)
													))
									);
		
		return $users;
	}
	
	/**
	 * Check to see if the item has been favorited by a certain user
	 * @param int user_id
	 * @param string model
	 * @param int model_id
	 * @return 
	 * 
	*/
	public function hasItemBeenFavorited($model='',$model_id=null){
		$this->recursive = -1;
		//debug($model . " : ". $model_id);
		$check = $this->find('count',array('conditions'=>array(
												'StaffFavorite.model'=>$model,
												'StaffFavorite.model_id'=>$model_id,
												)
											));
		return $check;
	}
	
	/**
	 * Check to see if the item has been favorited by a certain user
	 * @param int user_id
	 * @param string model
	 * @param int model_id
	 * @return 
	 * 
	*/
	public function hasUserFavorited($user_id=null,$model='',$model_id=null){
		$this->recursive = -1;
		$check = $this->find('first',array(
			'conditions'=>array(
					'StaffFavorite.user_id'=>$user_id,
					'StaffFavorite.model'=>$model,
					'StaffFavorite.model_id'=>$model_id,
					)
		));
		return $check;
	}
	
}