<?php
class Collection extends AppModel {
	var $name = 'Collection';
	var $displayField = 'name';
	var $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty')
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	
	var $actsAs = array(
					'Tags.Taggable',
					'Search.Searchable'
			);
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	
	var $hasMany = array(
		'Rating' => array(
			'className' => 'Rating',
			'foreignKey' => 'model_id',
			'conditions' => array('Rating.model' => 'Collection'),
			'dependent' => true,
			'exclusive' => true
		),
		'Feed' => array(
			'className' => 'Feed',
			'foreignKey' => 'model_id',
			'conditions' => array('Feed.model' => 'Collection'),
			'dependent' => true,
			'exclusive' => true
		),
		'Flag' => array(
			'className' => 'Flag',
			'foreignKey' => 'model_id',
			'conditions' => array('Flag.model' => 'Collection'),
			'dependent' => true,
			'exclusive' => true
		)
	);
	
	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	var $hasAndBelongsToMany = array(
		'Product' => array(
			'className' => 'Product',
			'joinTable' => 'collections_products',
			'foreignKey' => 'collection_id',
			'associationForeignKey' => 'product_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);
	
	/**
	 * Don't show products that aren't active
	 * @param Array queryData Data from the find. 
	 * @return Array
	 * 
	*/
	function beforeFind($queryData){
		$conditions = $queryData['conditions'];
		
		if(!is_array($conditions)) {
			if(!$conditions) {
				$conditions = array();
			}else {
				$conditions = array($conditions);
			}
		}
		
		if(!array_key_exists('active',$conditions) && !isset($conditions[$this->alias.'.active'])) {
			$conditions[$this->alias.'.active'] = 1;
		}
		$queryData['conditions'] = $conditions;
		//$queryData['recursive'] = 2;
		return $queryData;
	}
	
	/**
	 * Updates the total count in the user table for this particular type of item
	 * @param created 
	 * @return 
	 * 
	*/	
	 function afterSave($created){
		if($created){
			//Update the total count for the user
			$last = $this->read(null,$this->id);
			if(!empty($last['User']['id'])){
				$this->User->updateTotalCollections($last['User']['id']);
				//Add the feed data to the feed
				$this->Feed->addFeedData('Collection',$last);
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
		$this->recursive = 1;
		$data = $this->read(null,$model_id);
		for($i=0;$i<count($data['Product']);$i++){
			if(!empty($data['Product'][$i]['id'])){
				$product = $this->Product->read(null,$data['Product'][$i]['id']);
				$data['Product'][$i] = $product;
			}
		}
		
		return $data;
	}
	
	/**
	 * Get the most recent collections for a specific user
	 *
	 * @param int $user_id The user id of the user you're trying to pull inspirations for.
	 * @param int $limit The number of results to return
	 * @return Array
	 **/
	function userCollections($user_id=null,$limit=10,$type=null){
		$this->recursive = 2;
		if(empty($type)){
			$items = $this->find('list',
										array(
											'conditions'=>array('Collection.user_id' => $user_id),
											'limit' => $limit,
											'order' => array('Collection.created DESC')
											)
										);
		}elseif($type=='all'){
			$items = $this->find('all',
										array(
											'conditions'=>array('Collection.user_id' => $user_id),
											'limit' => $limit,
											'order' => array('Collection.created DESC')
											)
										);
		}
		
		return $items;
	}
	
	/**
	 * Returns the total collections for a specific user. This is used on the public profile view page.
	 * @param int user_id The user id you're trying to pull data for
	 * @return 
	 * 
	*/
	function getProfileData($user_id=null,$limit=10){
		$items = $this->find('list',
									array(
										'conditions'=>array('Collection.user_id' => $user_id),
										'limit' => $limit,
										'order' => array('Collection.created DESC')
										)
									);
		return $items;
	}
	
	/**
	 * Update the total product count
	 * @param id The id of the collection you're trying to update.
	 */
	function updateTotalCount($id = null,$removeCount = null){
		if (!$id) {
			$this->Session->setFlash(__('Invalid collection', true));
			$this->redirect(array('action' => 'index','admin'=>false));
		}
		$collection = $this->read(null, $id);
		if(!empty($removeCount)){
			$total_products = count($collection['Product']);
		}else{
			$total_products = count($collection['Product']) - intval($removeCount);
		}
		//$this->data['Collection']['total_products'] = $total_products;
		$this->id = $id;
		$this->saveField('total_products', $total_products);
	}

}
