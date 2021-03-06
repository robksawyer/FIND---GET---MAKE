<?php
class Source extends AppModel {
	var $name = 'Source';
	var $displayField = 'name';
	
	var $validate = array(
		'name' => array(
			'rule'=>array('minLength', 1), 
			'message'=>'Name is required' )
	);
	
	var $actsAs = array(
					'Tags.Taggable',
					'Search.Searchable'
			);
	
	var $filterArgs = array(
				array('name' => 'name', 'type' => 'like'),
				array('name' => 'source_category_id', 'type' => 'value'),
				array('name' => 'description', 'type' => 'like'),
				array('name' => 'url', 'type' => 'like'),
				array('name' => 'tags', 'type' => 'subquery', 'method' => 'findByTags', 'field' => 'Source.id'),
				array('name' => 'search', 'type' => 'like', 'field' => 'Source.description')
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
		'SourceCategory' => array(
			'className' => 'SourceCategory',
			'foreignKey' => 'source_category_id',
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
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'source_id',
			'dependent' => true,
			'exclusive' => true
		),
		'Rating' => array(
			'className' => 'Rating',
			'foreignKey' => 'model_id',
			'conditions' => array('Rating.model' => 'Source'),
			'dependent' => true,
			'exclusive' => true
		),
		'InspirationPhotoTag' => array(
			'className' => 'InspirationPhotoTag',
			'foreignKey' => 'model_id',
			'conditions' => array('InspirationPhotoTag.model' => 'Source'),
			'dependent' => true,
			'exclusive' => true
		),
		'Feed' => array(
			'className' => 'Feed',
			'foreignKey' => 'model_id',
			'conditions' => array('Feed.model' => 'Source'),
			'dependent' => true,
			'exclusive' => true
		),
		'Flag' => array(
			'className' => 'Flag',
			'foreignKey' => 'model_id',
			'conditions' => array('Flag.model' => 'Source'),
			'dependent' => true,
			'exclusive' => true
		)
	);

	var $hasAndBelongsToMany = array(
		'Attachment' => array(
			'className' => 'Attachment',
			'joinTable' => 'attachments_sources',
			'foreignKey' => 'source_id',
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
		'Contractor' => array(
			'className' => 'Contractor',
			'joinTable' => 'contractors_sources',
			'foreignKey' => 'source_id',
			'associationForeignKey' => 'contractor_id',
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
			'joinTable' => 'inspirations_sources',
			'foreignKey' => 'source_id',
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
		return $queryData;
	}
	
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
				$this->User->updateTotalSources($last['User']['id']);
				
				//Add the feed data to the feed
				$this->Feed->addFeedData('Source',$last);
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
	 * Get the most recent sources for a specific user
	 *
	 * @param int $user_id The user id of the user you're trying to pull sources for.
	 * @param int $limit The number of results to return
	 * @return Array
	 **/
	public function userSources($user_id=null,$limit=10,$type=null){
		$this->recursive = 1;
		if(empty($type)){
			$sources = $this->find('list',
										array(
											'conditions'=>array('Source.user_id' => $user_id),
											'limit' => $limit,
											'order' => array('Source.created DESC')
											)
										);
		}elseif($type=='all'){
			$sources = $this->find('all',
										array(
											'conditions'=>array('Source.user_id' => $user_id),
											'limit' => $limit,
											'order' => array('Source.created DESC')
											)
										);
		}
		
		return $sources;
	}
	
	/**
	 * Get all of the sources in the system
	 * @param 
	 **/
	function getList(){
		$sources = $this->find('list',array( 'order' => 'name ASC' ));
		return $sources;
	}
	
	/**
	 * Get the total # of sources added in the system for a particular user
	 * @param int user_id
	 **/
	function getCount($user_id=null){
		$count = $this->find('count',array( 'conditions' => array('Source.user_id'=>$user_id)));
		return $count;
	}
	
	/**
	 * Returns the total sources for a specific user. This is used on the public profile view page.
	 * @param int user_id The user id you're trying to pull data for
	 * @return 
	 * 
	*/
	function getProfileData($user_id=null,$limit=10){
		$items = $this->find('list',
									array(
										'conditions'=>array('Source.user_id' => $user_id),
										'limit' => $limit,
										'order' => array('Source.created DESC')
										)
									);
		return $items;
	}
	
	/*
		TODO Get the tagging DISTINCT working for pagintation. The following are failed attempts
	*/
	/**
	 * This fixes the pagination problem when searching for DISTINCT items
	 */ 
	/*public function paginateCount($conditions = null, $recursive = 0, $extra = array()) {
		$parameters = compact('conditions', 'recursive');

		if (isset($extra['group'])) {
			$parameters['fields'] = $extra['group'];

			if (is_string($parameters['fields'])) {
				// pagination with single GROUP BY field
				if (substr($parameters['fields'], 0, 9) != 'DISTINCT ') {
					$parameters['fields'] = 'DISTINCT ' . $parameters['fields'];
				}
				unset($extra['group']);
				$count = $this->find('count', array_merge($parameters, $extra));
			} else {
				// resort to inefficient method for multiple GROUP BY fields
				$count = $this->find('count', array_merge($parameters, $extra));
				$count = $this->getAffectedRows();
			}
		} else {
			// regular pagination
			$count = $this->find('count', array_merge($parameters, $extra));
		}
		return $count;
	}*/
	
	/*function paginateCount($conditions = null, $recursive = 0, $extra = array()) {
		$parameters = compact('conditions');
		$this->recursive = $recursive;
		$count = $this->find('count', array_merge($parameters, $extra));
		if (isset($extra['group'])) {
			$count = $this->getAffectedRows();
		}
		return $count;
	}*/
	
	/*function paginateCount($conditions = null, $recursive = 0, $extra = array()){
		$count = $this->find('count', array(
			'fields' => 'DISTINCT Tag.name',
			'conditions' => $conditions
		));
		return $count;
	}*/
	
}
