<?php
App::Import('Sanitize');
class Product extends AppModel {
	var $name = 'Product';
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
			)
		)
	);
	
	var $actsAs = array(
					'Comments.Commentable',
					'Tags.Taggable',
					'Search.Searchable'
			);
	
	var $filterArgs = array(
				array('name' => 'name', 'type' => 'like'),
				array('name' => 'product_category_id', 'type' => 'value'),
				array('name' => 'designer', 'type' => 'like'),
				array('name' => 'description', 'type' => 'like'),
				array('name' => 'source_url', 'type' => 'like'),
				array('name' => 'tags', 'type' => 'subquery', 'method' => 'findByTags', 'field' => 'Source.id'),
				array('name' => 'search', 'type' => 'like', 'field' => 'Product.description')
				/*
				array('name' => 'range_start', 'type' => 'expression', 'method' => 'makeRangeStartCondition', 'field' => 'Project.start BETWEEN ? AND ?'),
				array('name' => 'range_due', 'type' => 'expression', 'method' => 'makeRangeDueCondition', 'field' => 'Project.due BETWEEN ? AND ?')*/
			);
					
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	
	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ProductCategory' => array(
			'className' => 'ProductCategory',
			'foreignKey' => 'product_category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Source' => array(
			'className' => 'Source',
			'foreignKey' => 'source_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	var $hasMany = array(
		'Rating' => array(
			'className' => 'Rating',
			'foreignKey' => 'model_id',
			'conditions' => array('Rating.model' => 'Product'),
			'dependent' => true,
			'exclusive' => true
		),
		'InspirationPhotoTag' => array(
			'className' => 'InspirationPhotoTag',
			'foreignKey' => 'model_id',
			'conditions' => array('InspirationPhotoTag.model' => 'Product'),
			'dependent' => true,
			'exclusive' => true
		),
		'Vote' => array(
			'className' => 'Vote',
			'foreignKey' => 'model_id',
			'conditions' => array('Vote.model' => 'Product'),
			'dependent' => true,
			'exclusive' => true
		),
		'Ownership' => array(
			'className' => 'Ownership',
			'foreignKey' => 'model_id',
			'conditions' => array('Ownership.model' => 'Product'),
			'dependent' => true,
			'exclusive' => true
		),
		'Feed' => array(
			'className' => 'Feed',
			'foreignKey' => 'model_id',
			'conditions' => array('Feed.model' => 'Product'),
			'dependent' => true,
			'exclusive' => true
		),
		'Flag' => array(
			'className' => 'Flag',
			'foreignKey' => 'model_id',
			'conditions' => array('Flag.model' => 'Product'),
			'dependent' => true,
			'exclusive' => true
		),
		'StaffFavorite' => array(
			'className' => 'StaffFavorite',
			'foreignKey' => 'model_id',
			'conditions' => array('StaffFavorite.model' => 'Product'),
			'dependent' => true,
			'exclusive' => true
		)
	);

	var $hasAndBelongsToMany = array(
		'Collection' => array(
			'className' => 'Collection',
			'joinTable' => 'collections_products',
			'foreignKey' => 'product_id',
			'associationForeignKey' => 'collection_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
		'Attachment' => array(
			'className' => 'Attachment',
			'joinTable' => 'attachments_products',
			'foreignKey' => 'product_id',
			'associationForeignKey' => 'attachment_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
		'Inspiration' => array(
			'className' => 'Inspiration',
			'joinTable' => 'inspirations_products',
			'foreignKey' => 'product_id',
			'associationForeignKey' => 'inspiration_id',
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
	 * Sanitize all data saved
	 * @param 
	 * @return 
	 * 
	*/
	var $cleanData = true;
	
	/**
	 * Runs before every save event in the system
	 * @param 
	 * @return 
	 * 
	*/
	public function beforeSave(){
		//Sanitize the data added to the database
		if (!empty($this->data) && $this->cleanData === true) {
			$this->data = Sanitize::clean($this->data, array('escape' => false,'remove_html' => true));
		}
		return true;
	}
	
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
		//$queryData['recursive'] = 1;
		return $queryData;
	}
	
	/**
	 * Updates the total count in the user table for this particular type of item
	 * @param created 
	 * @return 
	 * 
	*/	
	public function afterSave($created){
		$this->recursive = 1;
		if($created){
			//Update the total count for the user
			$last = $this->read(null,$this->id);
			if(!empty($last['User']['id'])){
				$this->User->updateTotalProducts($last['User']['id']);
				
				//Add the feed data to the feed
				$this->Feed->addFeedData('Product',$last);
			}
		}
	}
	
	/**
	 * @param 
	 * @return 
	 * 
	*/
	public function findByTags($data = array()) {
		$this->Tagged->Behaviors->attach('Containable', array('autoFields' => false));
		$this->Tagged->Behaviors->attach('Search.Searchable');
		$query = $this->Tagged->getQuery('all', array(
			'conditions' => array('Tag.name'  => $data['tags']),
			'fields' => array('foreign_key'),
			'contain' => array('Tag')
		));
		return $query;
	}
	
	/**
	 * Get the most recent products for a specific user
	 *
	 * @param int $user_id The user id of the user you're trying to pull products for.
	 * @param int $limit The number of results to return
	 * @return Array
	 **/
	function userProducts($user_id=null,$limit=10,$type=null){
		$this->recursive = 1;
		if(empty($type)){
			$items = $this->find('list',
										array(
											'conditions'=>array('Product.user_id' => $user_id),
											'limit' => $limit,
											'order' => array('Product.created DESC')
											)
										);
		}elseif($type=='all'){
			$items = $this->find('all',
										array(
											'conditions'=>array('Product.user_id' => $user_id),
											'limit' => $limit,
											'order' => array('Product.created DESC')
											)
										);
		}
		return $items;
	}
	
	/**
	 * Get all of the products in the system
	 * @param 
	 * @return 
	 * 
	*/
	function getAll(){
		$products = $this->find('all',
						array(
							'order' => array('Product.created DESC'),
							'recursive' => 1,
							'contain'=>array('User','Attachment')
							)
						);
		return $products;
	}
	
	/**
	 * Get all of the data needed for the product selector
	 * @param 
	 * @return 
	 * 
	*/
	function getProductSelectorData(){
		$this->recursive = 1;
		$products = $this->find('all',
						array(
							'order' => array('Product.created DESC'),
							'contain'=>array('Attachment')
							//'limit'=>25
							)
						);
		return $products;
	}
	
	
	
	/**
	 * Get all of the products in the system in list form
	 * @param 
	 * @return 
	 * 
	*/
	function getList(){
		$products = $this->find('list',array(
											'order' => array('Product.created DESC'),
											'recursive'=>1
											)
										);
		return $products;
	}
	
	/** 
	 * Returns all of the product categories in the system
	 * @param 
	 */
	function getCategories(){
		$this->ProductCategory->recursive = 1;
		$categories = $this->ProductCategory->getList();
		return $categories;
	}
	
	/**
	 * Returns the total products for a specific user. This is used on the public profile view page.
	 * @param int user_id The user id you're trying to pull data for
	 * @return 
	 * 
	*/
	function getProfileData($user_id=null,$limit=10){
		$this->recursive = 1;
		$items = $this->find('list',
									array(
										'conditions'=>array('Product.user_id' => $user_id),
										'limit' => $limit,
										'order' => array('Product.created DESC')
										)
									);
		return $items;
	}
	
	/**
	 * Get the total # of products added in the system for a particular user
	 * @param int user_id
	 **/
	function getCount($user_id=null){
		$this->recursive = 1;
		$count = $this->find('count',array( 'conditions' => array('Product.user_id'=>$user_id)));
		return $count;
	}
	
	/**
	 * Returns the needed feed data for a specific record
	 * @param int model_id
	 * @return 
	 * 
	*/
	public function getFeedData($model_id=null){
		$this->recursive = 1;
		$data = $this->find('first',array(
										'conditions'=>array('Product.id'=>$model_id),
										'contain'=>array('Attachment',
														'Source',
														'ProductCategory',
														'User','Tag',
														'Ownership','Vote'
														)
										)
									);
		return $data;
	}
	
	/**
	 * Returns the necessary data for the key action
	 * @param int keycode The keycode of the item to fetch
	 * @return 
	 * 
	*/
	function getKeyData($keycode=null){
		$data = $this->find('first',array(
										'conditions'=>array('Product.keycode'=>$keycode),
										'recursive' => 1,
										'contain'=>array('Attachment',
														'Source',
														'ProductCategory',
														'User','Tag',
														'Ownership','Vote','Inspiration','Collection'
														)
										)
									);
		//debug($data);
		return $data;
	}
	
	/**
	 * Returns the necessary data for the view actions
	 * @param int id The id of the source item that you're trying to locate
	 * @return 
	 * 
	*/
	function getViewData($id=null){
		$data = $this->find('first',array(
										'conditions'=>array('Product.id'=>$id),
										'recursive' => 1,
										'contain'=>array('Attachment',
														'Source',
														'ProductCategory',
														'User','Tag',
														'Ownership','Vote','Inspiration','Collection'
														)
										)
									);
		//debug($data);
		return $data;
	}
	
	/**
	 * Returns three products with attachments. 
	 * @param int user_id The user id to return products for
	 * @return 
	 * 
	*/
	function getThreeFromUser($user_id=null){
		$data = $this->find('all',array(
										'conditions'=>array('Product.user_id'=>$user_id),
										'recursive' => 1,
										'contain'=>array('Attachment'),
										'limit'=>3,
										'order'=>array('Product.created'=>'desc')
										)
									);
		//debug($data);
		return $data;
	}
}