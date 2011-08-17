<?php
class Inspiration extends AppModel {
	var $name = 'Inspiration';
	var $displayField = 'name';
	
	var $actsAs = array(
					'Tags.Taggable',
					'Search.Searchable'
					);
	
	var $validate = array(
		'name' => array(
			'rule'=>array('minLength', 1), 
			'message'=>'Name is required' )
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
		'Country' => array(
			'className' => 'Country',
			'foreignKey' => 'country_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	var $hasMany = array(
		'Rating' => array(
			'className' => 'Rating',
			'foreignKey' => 'model_id',
			'conditions' => array('Rating.model' => 'Inspiration'),
			'dependent' => true,
			'exclusive' => true
		),
		'InspirationPhotoTag' => array(
			'className' => 'InspirationPhotoTag',
			'foreignKey' => 'inspiration_id',
			'conditions' => '',
			'dependent' => true,
			'exclusive' => true
		),
		'Feed' => array(
			'className' => 'Feed',
			'foreignKey' => 'model_id',
			'conditions' => array('Feed.model' => 'Inspiration'),
			'dependent' => true,
			'exclusive' => true
		)
	);
	
	var $hasAndBelongsToMany = array(
		'Attachment' => array(
			'className' => 'Attachment',
			'joinTable' => 'attachments_inspirations',
			'foreignKey' => 'inspiration_id',
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
		'Source' => array(
			'className' => 'Source',
			'joinTable' => 'inspirations_sources',
			'foreignKey' => 'inspiration_id',
			'associationForeignKey' => 'source_id',
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
		'Product' => array(
			'className' => 'Product',
			'joinTable' => 'inspirations_products',
			'foreignKey' => 'inspiration_id',
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
	 * Updates the total count in the user table for this particular type of item
	 * @param created 
	 * @return 
	 * 
	*/	
	public function afterSave($created){
		if($created){
			//Update the total count for the user
			$last = $this->read(null,$this->id);
			if(!empty($last['User']['id'])){
				$this->User->updateTotalInspirations($last['User']['id']);
				
				//Add the feed data to the feed
				$this->Feed->addFeedData('Inspiration',$last);
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
	 * Get the most recent inspirations for a specific user
	 *
	 * @param int $user_id The user id of the user you're trying to pull inspirations for.
	 * @param int $limit The number of results to return
	 * @return Array
	 **/
	function userInspirations($user_id=null,$limit=10,$type=null){
		$this->recursive = 2;
		if(empty($type)){
			$items = $this->find('list',
										array(
											'conditions'=>array('Inspiration.user_id' => $user_id),
											'limit' => $limit,
											'order' => array('Inspiration.created DESC')
											)
										);
		}elseif($type=='all'){
			$items = $this->find('all',
										array(
											'conditions'=>array('Inspiration.user_id' => $user_id),
											'limit' => $limit,
											'order' => array('Inspiration.created DESC')
											)
										);
		}
		
		return $items;
	}
	
	/**
	 * Returns the total inspirations for a specific user. This is used on the public profile view page.
	 * @param int user_id The user id you're trying to pull data for
	 * @return 
	 * 
	*/
	function getProfileData($user_id=null,$limit=10){
		$items = $this->find('list',
									array(
										'conditions'=>array('Inspiration.user_id' => $user_id),
										'limit' => $limit,
										'order' => array('Inspiration.created DESC')
										)
									);
		return $items;
	}

}
