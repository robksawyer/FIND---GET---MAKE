<?php
App::Import('Sanitize');
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
						),
						'User' => array(
							'className' => 'User',
							'foreignKey' => 'attachment_id',
							'conditions' => '',
							'dependent' => false,
							'exclusive' => false
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
			'unique' => true
		),
		'Source' => array(
			'className' => 'Source',
			'joinTable' => 'attachments_sources',
			'foreignKey' => 'attachment_id',
			'associationForeignKey' => 'source_id',
			'unique' => true
		),
		'Client' => array(
			'className' => 'Client',
			'joinTable' => 'attachments_clients',
			'foreignKey' => 'attachment_id',
			'associationForeignKey' => 'client_id',
			'unique' => true
		),
		'Inspiration' => array(
			'className' => 'Inspiration',
			'joinTable' => 'attachments_inspirations',
			'foreignKey' => 'attachment_id',
			'associationForeignKey' => 'inspiration_id',
			'unique' => true
		),
		'Product' => array(
			'className' => 'Product',
			'joinTable' => 'attachments_products',
			'foreignKey' => 'attachment_id',
			'associationForeignKey' => 'product_id',
			'unique' => true
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
	public function beforeFind($queryData){
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
		$queryData['recursive'] = 1;
		return $queryData;
	}
	
	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
	function afterSave($created){
		if($created){
			//Generate and create keycode
			$this->generateKeycode($this->id);
		}
	}
	
	/**
	 * This method handles generating a random keycode for a attachment
	 * @param int id The attachment id
	 * @return 
	 * 
	*/
	public function generateKeycode($id=null){

		$keycode = $this->str_rand(8,'mixed');
		$keycode .= $id;
		
		$this->id = $id;
		$this->saveField('keycode',$keycode);
		//debug($keycode);
		return $keycode;
	}
	
	public function str_rand($length = 8, $output = 'alphanum'){
		// Possible seeds
		$outputs['alpha'] = 'abcdefghijklmnopqrstuvwqyz';
		$outputs['numeric'] = '0123456789';
		$outputs['alphanum'] = 'abcdefghijklmnopqrstuvwqyz0123456789';
		$outputs['hexadec'] = '0123456789abcdef';
		$outputs['mixed'] = 'abcdefghijklmnopqrstuvwqyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_';
		
		// Choose seed
		if (isset($outputs[$output])) {
			$output = $outputs[$output];
		}

		// Seed generator
		list($usec, $sec) = explode(' ', microtime());
		$seed = (float) $sec + ((float) $usec * 100000);
		mt_srand($seed);

		// Generate
		$str = '';
		$output_count = strlen($output);
		for ($i = 0; $length > $i; $i++) {
			$str .= $output{mt_rand(0, $output_count - 1)};
		}

		return $str;
	}
	
	/**
	 * Returns a random set of attachments out of all of the attachments
	 * @param 
	 * @return 
	 * 
	*/
	public function random() {
		$random = $this->find('all',array(
				'conditions' => array(),
				'fields' => array('Attachment.id','Attachment.path_med','Attachment.path_small','Attachment.title'),
				'limit'=>100,
				'order' => 'rand()'
		));
		return $random;
	}
	
	/**
	 * Searches for a local avatar
	 * @param int attachment_id The attachment id to search for
	 * @param int user_id The user's avatar to find
	 * @return 
	 * 
	*/
	public function getAvatar($attachment_id=null,$user_id=null){
		$avatar = $this->find('first',array('conditions'=>array(
																'Attachment.id'=>$attachment_id
																)));
		if(!empty($avatar)) return $avatar; else return false;
	}
}