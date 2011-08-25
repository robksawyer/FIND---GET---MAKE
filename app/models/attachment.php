<?php
class Attachment extends AppModel {
	var $name = 'Attachment';
	var $displayField = 'name';
	
	var $actsAs = array(
					'Uploader.FileValidation',
					'Uploader.Attachment' => array(
						'file' => array(
							'uploadDir'		=> 'media/static/img/',	// Where to upload to, relative to app webroot
							'dbColumn'		=> 'path',	// The database column name to save the path to
							'maxNameLength' => 50,		// Max file name length
							'overwrite'		=> false	// Overwrite file with same name if it exists
							//'name'		=> '',		// The name to give the file (should be done right before a save)
							/*'transforms' => array(
							                'scale' => array(
												'percent' => .75, 
												'dbColumn' => 'path_med'
												),
							                'resize' => array(
												'width' => 50, 
												'dbColumn' => 'path_small'
												)
							            )*/
						)
					)
			);
			
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	var $hasMany = array(
						'Rating' => array(
								'className' => 'Rating',
								'foreignKey' => 'model_id',
								'conditions' => array('Rating.model' => 'Attachment'),
								'dependent' => false,
								'exclusive' => false
						),
						'AttachmentTag' => array(
								'className' => 'AttachmentTag',
								'foreignKey' => 'attachment_id',
								'conditions' => '',
								'dependent' => false,
								'exclusive' => false
						),
						'InspirationPhotoTag' => array(
								'className' => 'InspirationPhotoTag',
								'foreignKey' => 'attachment_id',
								'conditions' => '',
								'dependent' => false,
								'exclusive' => false
						),
						'Ufo' => array(
								'className' => 'Ufo',
								'foreignKey' => 'attachment_id',
								'conditions' => '',
								'dependent' => false,
								'exclusive' => false
						),
						'Flag' => array(
							'className' => 'Flag',
							'foreignKey' => 'model_id',
							'conditions' => array('Flag.model' => 'Attachment'),
							'dependent' => true,
							'exclusive' => true
						)
					);
	
	var $hasAndBelongsToMany = array(
		'Contractor' => array(
			'className' => 'Contractor',
			'joinTable' => 'attachments_contractors',
			'foreignKey' => 'attachment_id',
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
		'House' => array(
			'className' => 'House',
			'joinTable' => 'attachments_houses',
			'foreignKey' => 'attachment_id',
			'associationForeignKey' => 'house_id',
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
			'joinTable' => 'attachments_sources',
			'foreignKey' => 'attachment_id',
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
		'Client' => array(
			'className' => 'Client',
			'joinTable' => 'attachments_clients',
			'foreignKey' => 'attachment_id',
			'associationForeignKey' => 'client_id',
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
			'joinTable' => 'attachments_inspirations',
			'foreignKey' => 'attachment_id',
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
		),
		'Product' => array(
			'className' => 'Product',
			'joinTable' => 'attachments_products',
			'foreignKey' => 'attachment_id',
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
		return $queryData;
	}
}
