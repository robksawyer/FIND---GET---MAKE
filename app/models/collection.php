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
