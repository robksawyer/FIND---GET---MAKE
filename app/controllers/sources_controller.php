<?php
class SourcesController extends AppController {

	var $name = 'Sources';
	
	var $helpers = array('Tags.TagCloud');
	
	var $components = array('Search.Prg','Uploader.Uploader');

	var $paginate = array(
		'limit' => 25
	);
	
	var $presetVars = array(
		array('field' => 'name', 'type' => 'like'),
		array('field' => 'source_category_id', 'type' => 'value'),
		array('field' => 'description', 'type' => 'like'),
		array('field' => 'url', 'type' => 'like'),
		array('field' => 'tags', 'type' => 'like')
		/*
			TODO Search tags
		*/
	);
	
	function beforeFilter(){
		parent::beforeFilter();
		
		$this->Uploader->uploadDir = 'media/static/img/sources/';
		$this->Uploader->enableUpload = true;
		$this->Uploader->maxFileSize = '75M'; // 75 Megabytes
		$this->Uploader->tempDir = 'media/transfer/img/sources/';
		//$this->Uploader->mime('image', 'gif', 'image/gif');
		//$this->Uploader->maxNameLength = 50;
		
		$this->Auth->allow('getCount','getTags','getProfileData');
	}
	
	/**
	 * This happens before the page is rendered
	 * @param 
	 * @return 
	 * 
	*/
	function beforeRender(){
		//Check to see if the user has flagged the item
		$user_id = $this->Auth->user('id');
		$model = $this->modelClass;
		$flagged = $this->$model->Flag->hasUserFlagged($user_id,$model,$this->$model->id);
		$this->set(compact('flagged'));
	}

	function find() {
		$this->Prg->commonProcess();
		$this->paginate['conditions'] = $this->Source->parseCriteria($this->passedArgs);
		$this->set('sources', $this->paginate());
		$this->set('string', $this->String);
		$sourceCategories = $this->Source->SourceCategory->find('list',array( 'order' => 'name ASC' ));
		$this->set(compact('sourceCategories'));
	}
	
	function index($filter = null){
		$this->Source->recursive = 2;
		
		// query all distinct first letters used in names
		$letters = $this->Source->query('SELECT DISTINCT SUBSTRING(`name`, 1, 1) FROM `sources` ORDER BY `name`');
		
		$links = array();
		// push all letters into a non-nested array
		foreach ($letters as $row) {
			array_push($links, current($row[0]));
		}

		$this->paginate['Source'] = array(
										'order' => array(
											'Source.name' => 'asc'
											)
										);

		if($filter == 'number'){
			$filter = '^[0-9]+'; //Find records that start with numbers
			$sources = $this->paginate('Source',array(
											   'Source.name REGEXP' => $filter
											));
			
		}else{
			$sources = $this->paginate('Source',array(
											   'Source.name LIKE' => $filter.'%'
											));
			
		}

		if (isset($this->passedArgs['by'])) {
			$this->paginate = array(
								'Tagged'=>array(
									'model' => 'Source',
									'tagged',
									'by' => $this->passedArgs['by'],
									'recursive'=>2 //Removing this throws errors.
								)
							);
			$sources = Set::filter($this->paginate('Tagged')); //Remove empty values
			//Build a new array
			foreach($sources as $source){
				$clean_sources[] = $source;
			}
			if(!empty($clean_sources)){
				$sources = $clean_sources;
			}
			
			$counter = 0;
			foreach($sources as $source){
				//Find countries
				$temp_country = $this->Source->Country->find('first',array('conditions'=>array('Country.id'=>$source['Source']['country_id'])));
				$sources[$counter]['Country'] = $temp_country['Country'];
				
				//Find categories
				$temp_cat = $this->Source->SourceCategory->find('first',array('conditions'=>array('SourceCategory.id'=>$source['Source']['source_category_id'])));
				$sources[$counter]['SourceCategory'] = $temp_cat['SourceCategory'];
				
				$counter++;
			}
		}
		
		if(isset($this->params['requested'])) {
			return $sources;
		}
		
		$sourceCategories = $this->Source->SourceCategory->getAll();
		
		//$sources = $this->paginate();
		$total_count = $this->Source->find('count');
		$this->set(compact('total_count','filter','links','sources','sourceCategories'));
		$this->set('string', $this->String);
	}
	
	/**
	 * This method handles showing sources added by a certain user
	 * @param int id 
	 * @return 
	 * 
	*/
	function users($id = null){
		$this->Source->recursive = 2;
		
		if (!$id) {
			$this->Session->setFlash(__('Invalid user id', true));
			$this->redirect(array('action' => 'index','admin'=>false));
		}
		$user = $this->Source->User->find('first',array('conditions'=>array('User.id'=>$id)));
		if(empty($user)){
			$this->Session->setFlash(__('Invalid user id', true));
			$this->redirect(array('action' => 'index','admin'=>false));
		}
		
		$sourceCategories = $this->Source->SourceCategory->getAll();
		
		$sources = $this->paginate('Source',array(
										   'Source.user_id' => $id
										));
		$total_count = $this->Source->find('count');
		$this->set(compact('total_count','sources','sourceCategories','user'));
		$this->set('string', $this->String);
	}
	
	/**
	 * The main view method
	 * @param 
	 * @return 
	 * 
	*/
	function view($id = null) {
		$this->Source->recursive = 2;
		//$isSlug = $this->isSlug($id);
		if (!$id) {
			$this->Session->setFlash(__('Invalid source', true));
			$this->redirect(array('action' => 'index','admin'=>false));
		}else{
			$source = $this->Source->read(null, $id);
			if(empty($source)){
				$this->Session->setFlash(__('Invalid source', true));
				$this->redirect(array('action' => 'index','admin'=>false));
			}
		}
		
		$contractors = $this->Source->Contractor->find('list');
		$inspirations = $this->Source->Inspiration->find('list');
		$attachments = $this->Source->Attachment->find('list');
		$sourceCategories = $this->Source->SourceCategory->find('list',array( 'order' => 'name ASC' ));
		
		$this->set('tags', $this->Source->Tagged->find('cloud', array('limit' => 10)));
		$this->set('source', $source);
		$this->set(compact('contractors','inspirations','attachments','sourceCategories'));
		$this->set('string', $this->String);
	}
	
	/**
	 * This method handles parsing the keycode and showing the proper source
	 * @param string keycode The key to an source
	 * @return 
	 * 
	*/
	function key($keycode=null){
		$this->Source->recursive = 2;
		$this->layout = 'client_review';
		if (!$keycode && empty($this->data)) {
			$this->Session->setFlash(__('Invalid keycode', true));
			$this->redirect('/');
		}
		
		$source = $this->Source->find('first',array('conditions'=>array('Source.keycode'=>$keycode)));
		if(empty($source)){
			$this->Session->setFlash(__('Invalid keycode', true));
			$this->redirect('/');
		}
		$contractors = $this->Source->Contractor->find('list');
		$inspirations = $this->Source->Inspiration->find('list');
		$attachments = $this->Source->Attachment->find('list');
		$sourceCategories = $this->Source->SourceCategory->find('list',array( 'order' => 'name ASC' ));
		
		$this->set('tags', $this->Source->Tagged->find('cloud', array('limit' => 10)));
		$this->set(compact('source','contractors','inspirations','attachments','sourceCategories'));
		$this->set('string', $this->String);
	}

	function admin_add() {
		//Add the source to a model
		if(isset($this->passedArgs['model'])){
			$model = ucwords($this->passedArgs['model']);
			if(isset($this->passedArgs['id'])){
				$id = intval($this->passedArgs['id']);
				
				//Pluralize the model name
				$plural_model = strtolower($model);
				$plural_model = Inflector::pluralize($plural_model);

				//Find the actual record and make sure it's legit.
				$item = $this->Source->$model->findById($id);
				if(!empty($item)){
					//Pass along the details
					$this->set(compact('item','model','plural_model'));
				}else{
					$this->Session->setFlash(__('This record does not exist.', true));
					/*
						TODO Redirect the user or set a variable that hides the upload field.
					*/
					$errors['message'] = 'The item was not found in the database';
				}
			}
		}
		
		if (!empty($this->data)) {
			
			$passed_check = $this->verifyAddition('Source');
			
			if($passed_check){
				//Cleanup
				if(!empty($this->data['Source']['url'])){
					$this->data['Source']['url'] = $this->cleanURL($this->data['Source']['url']); //Clean the URL
				}
				$this->data['Source']['slug'] = $this->toSlug($this->data['Source']['name']);
				
				//Cleanup the address
				$this->cleanAddress();
				
				/*
				 * Check to see if a contractor was added. If a name was added, check the 
				 * name against already added contractors. If the name exist, associate the contractor
				 * id to the source. */
				if(Configure::read('FGM.private_solution') == 1){
					if(!empty($this->data['Contractor']['name'])){
						$contractor = $this->Source->Contractor->findByName($this->data['Contractor']['name']);
						if(empty($contractor)){
							$this->Source->Contractor->create();
							//Create a slug for it.
							$this->data['Contractor']['slug'] = $this->toSlug($this->data['Contractor']['name']);
							if($this->Source->Contractor->save($this->data['Contractor'])){
								//$this->Session->setFlash(__('The contractor has been saved', true));
								$contractor_id = $this->Source->Contractor->getLastInsertID();
								$this->data['Contractor'][0] = $contractor_id; //Add the contractor
							}else{
								$this->Session->setFlash(__('The contractor could not be saved. Please, try again.', true));
							}
						}else{
							//debug($contractor);
							unset($this->data['Contractor']['name']);
							$this->data['Contractor'][0] = $contractor['Contractor']['id'];
						}
					}else{
						unset($this->data['Contractor']);
					}
				}else{
					//Do nothing
				}
				
				//Check for a redirect variable
				if(!empty($this->data['Product']['redirect'])){
					$redirect = $this->data['Product']['redirect'];
					unset($this->data['Product']['redirect']);
				}
				
				//Upload the attachments
				$this->uploadAttachments('Source');
				
				$this->Source->create();
				if ($this->Source->save($this->data)) {
					$this->clearVerifySessions();
					$this->Session->setFlash(__('The source has been saved', true));
					
					$id = $this->Source->getLastInsertID();
					//Generate and create keycode
					$this->generateKeycode($id,true);
				
					if(!empty($redirect)){
						$this->redirect($redirect);
					}else{
						$this->redirect(array('action' => 'view','admin'=>false,$id));
					}
					
				} else {
					$this->clearVerifySessions();
					$this->Session->setFlash(__('The source could not be saved. Please, try again.', true),'default', array('class' => 'error-message'));
					if(!empty($redirect)){
						$this->redirect($redirect);
					}
				}
			}else{
				$this->Session->setFlash(__('The source '.$this->data['Source']['name']. ' already exists. Are you sure you want to add this?', true),'default', array('class' => 'error-message'));
				if(!empty($redirect)){
					$this->redirect($redirect);
				}
			}
			
			//debug($this->data);
		}else{
			$this->set('errors', $this->Source->invalidFields());
		}
		//$images = $this->Source->Image->find('list');
		$countries = $this->Source->Country->find('list');
		$contractors = $this->Source->Contractor->find('list',array( 'order' => 'name ASC' ));
		$sourceCategories = $this->Source->SourceCategory->find('list',array( 'order' => 'name ASC' ));
		$tags = $this->Source->Tagged->find('cloud', array('limit' => 10));
		$this->set(compact('contractors', 'images','countries','tags','sourceCategories'));
	}
	
	
	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid source', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			//Cleanup
			if(!empty($this->data['Source']['url'])){
				$this->data['Source']['url'] = $this->cleanURL($this->data['Source']['url']); //Clean the URL
			}
			$this->data['Source']['slug'] = $this->toSlug($this->data['Source']['name']);
			
			//Cleanup the address
			$this->cleanAddress();
			
			//Upload the attachments
			$this->uploadAttachments('Source',$id);
			
			//Update the inspiration photo tag name
			$this->Source->InspirationPhotoTag->updateName($id,'Source',$this->data['Source']['name']);
			
			if($this->Source->saveAll($this->data)) {
				$this->Session->setFlash(__('The source has been updated', true));
				$this->redirect(array('action' => 'view','admin'=>false,$id));
			} else {
				$this->Session->setFlash(__('The source could not be updated. Please, try again.', true),'default', array('class' => 'error-message'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Source->read(null, $id);
		}
		//$images = $this->Source->Image->find('list');
		$this->Source->id = $id;
		$countries = $this->Source->Country->find('list');
		$contractors = $this->Source->Contractor->find('list',array( 'order' => 'name ASC' ));
		$sourceCategories = $this->Source->SourceCategory->find('list',array( 'order' => 'name ASC' ));
		//$images = $this->Source->Image->find('list');
		$tags = $this->Source->Tag->find('list');
		$tags_cloud = $this->Source->Tagged->find('cloud', array('limit' => 10));
		$this->set('source', $this->Source->read(null, $id));
		$this->set(compact('contractors','countries','tags','tags_cloud','sourceCategories'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for source', true));
			$this->redirect(array('action'=>'index','admin'=>false));
		}
		
		$this->data = $this->Source->read(null,$id);
		
		//Delete associated attachments
		if(!empty($this->data['Attachment'])){
			//Get all attachment ids
			foreach($this->data['Attachment'] as $attachment){
				$attachment_ids[] = $attachment['id'];
			}
			
			//Delete all of the attachments
			$this->Source->Attachment->deleteAll(array('Attachment.id'=>$attachment_ids));
		}
		
		
		
		if ($this->Source->delete($id)) {
			$this->Session->setFlash(__('Source deleted', true));
			$this->redirect(array('action'=>'index','admin'=>false));
		}
		$this->Session->setFlash(__('Source was not deleted', true),'default', array('class' => 'error-message'));
		$this->redirect(array('action' => 'index','admin'=>false));
	}
	
	/** 
	 * This is a helper method that removes a product from the source.
	 * @param id The source id targetting.
	 * @param product_id The product id to remove.
	 */
	function removeProduct($id=null,$product_id=null){
		//$this->Source->recursive = 1;
		//$this->autoLayout = false;
		//$this->autoRender = false;
		
		if (!$id && !$product_id) {
			$this->Session->setFlash(__('This source id or product id doesn\'t exist.', true));
			$this->redirect(array('action'=>'view',$id,'admin'=>false));
		}
		
		$this->Source->id = $id;
		if ($this->Source->Product->delete($product_id)) {
			$this->Session->setFlash(__('The source\'s product has been deleted.', true));
			$this->redirect(array('action' => 'view','admin'=>false,$id));
		} else {
			$this->Session->setFlash(__('The source\'s product could not be deleted. Please, try again.', true),'default', array('class' => 'error-message'));
		}
	}
	
	/** 
	 * This is a helper method that removes a attachment from the source.
	 * @param id The inspiration id targetting.
	 * @param product_id The product id to remove.
	 */
	function removeAttachment($id=null,$attachment_id=null){
		$this->Source->recursive = 1;
		$this->autoLayout = false;
		$this->autoRender = false;
		
		if (!$id) {
			$this->Session->setFlash(__('This attachement doesn\'t exist.', true));
			//$this->redirect(array('action'=>'index','admin'=>false));
		}
	
		$this->data = $this->Source->read(null, $id);
		
		//Save the input data
		$data = $this->data;
		
		//Load the array with product ids that are currently attached to the inspiration
		foreach($this->data['Attachment'] as $attachment){
			$currentAttachments[] = $attachment['id'];
		}
		unset($this->data['Attachment']);
		$this->data['Attachment']['Attachment'] = $currentAttachments;
		
		//Remove the attachment id from the inspiration
		for($i=0;$i<count($this->data['Attachment']['Attachment']);$i++){
			//Find the id and remove it.
			if($this->data['Attachment']['Attachment'][$i] == $attachment_id){
				unset($this->data['Attachment']['Attachment'][$i]);
			}
		}
		//debug($this->data['Attachment']);
		$this->data['Attachment']['Attachment'] = array_merge(array(),$this->data['Attachment']['Attachment']);
		//On every save the array gets flipped. Keep the order the same by reversing the array.
		$this->data['Attachment']['Attachment'] = array_reverse($this->data['Attachment']['Attachment']);
		
		/*
			BUG: For some reason on each save the attachments get flipped.
			FIX: Reverse the array before saving.
			
			This is important because the tags are on the first image in the attachment array. 
		*/
		$this->data['Attachment'] = array_reverse($this->data['Attachment']);
		
		if ($this->Source->save($this->data)) {
			//Delete the attachment from the system
			$this->Source->Attachment->delete($attachment_id);
			
			$this->Session->setFlash(__('The source has been updated', true));
			$this->redirect(array('action' => 'view','admin'=>false,$id));
		} else {
			$this->Session->setFlash(__('The source could not be updated. Please, try again.', true));
		}
	}
	
	/**
	 * Cleans up a URL
	 * @param 
	 * @return 
	 * 
	*/
	function cleanAddress(){
		$this->data['Source']['address1'] = ucwords(strtolower($this->data['Source']['address1']));
		$this->data['Source']['address2'] = ucwords(strtolower($this->data['Source']['address2']));
		$this->data['Source']['city'] = ucwords(strtolower($this->data['Source']['city']));
		$this->data['Source']['state'] = ucwords($this->data['Source']['state']);
	}
	
	/**
	 * Finds the tags associated with this model
	 */
	function tags($filter=null){
		/*
			TODO The paginator is not updating based on the DISTINCT value entered. Fix this.
		*/
		$this->Source->recursive = 2;
		
		// query all distinct first letters used in names
		$letters = $this->Source->query('SELECT DISTINCT SUBSTRING(`name`, 1, 1) FROM `sources` ORDER BY `name`');
		
		$links = array();
		// push all letters into a non-nested array
		foreach ($letters as $row) {
			array_push($links, current($row[0]));
		}

		$this->paginate['Source'] = array(
										'order' => array(
											'Source.created' => 'desc'
											)
										);

		if($filter == 'number'){
			$filter = '^[0-9]+'; //Find records that start with numbers
			$sources = $this->paginate('Source',array(
											   'Source.name REGEXP' => $filter
											));
			
		}else{
			$sources = $this->paginate('Source',array(
											   'Source.name LIKE' => $filter.'%'
											));
			
		}
		
		$this->paginate = array(
							'Tagged'=>array(
											'conditions'=>array(
												'Tagged.model'=>'Source'
												),
											'fields'=>'DISTINCT Tag.name,Tag.keyname',
											'limit' => 75,
											'order' => array('Tag.name ASC')
											));
		
		$tags = $this->paginate('Tagged');
		$this->set(compact('tags'));
		$sourceCategories = $this->Source->SourceCategory->getAll();
		$total_count = $this->Source->find('count');
		$this->set(compact('total_count','filter','links','sources','sourceCategories'));
		$this->set('string', $this->String);
	}
	
	/**
	 * This method is used to check the name input field before submission.
	 * @param 
	 */ 
	function ajax_check_name() {
		$this->layout = 'ajax';

		if (!empty($this->data)) {
			if ($this->data['Source']['name'] == '') {
				$this->set('value', 0);
			} else {
				$u = $this->Source->findByName($this->data['Source']['name']);
				if (empty($u)) {
					$this->set('value', 1);
				} else {
					$this->set('value', 0);
				}
			}
		} else {
			$this->set('value', 0);
		}
	}
	
	/**
	 * Returns all of the tags associated with this Model. This is used by the add_tag element.
	 */
	function getTags(){
		if(isset($this->params['requested'])) {
			$temp_tags = $this->Source->Tagged->Tag->find('list');
			foreach($temp_tags as $tag){
				$tags[] = $tag;
			}
			//debug($tags);
			return $tags;
		}
	}
	
	/**
	 * Returns the total sources for a specific user
	 * @param int user_id The user id you're trying to pull data for
	 * @return 
	 * 
	*/
	function getProfileData($user_id=null){
		return $this->Source->getProfileData($user_id);
	}
	
	/**
	 * Get the total # of sources added in the system for a particular user
	 * @param int user_id
	 * @return int The total number of sources added by the user
	**/
	function getCount($user_id=null){
		return $this->Source->getCount($user_id);
	}
	
	/**
	 * This method handles generating a random keycode for a source
	 * @param int id The product id
	 * @param bypassRedirect Bypasses the redirect if true
	 * @return 
	 * 
	*/
	function generateKeycode($id=null,$bypassRedirect=false){
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid source', true));
			$this->redirect('/');
		}
		
		$keycode = $this->String->str_rand(8,'mixed');
		$keycode .= $id;
		
		$this->Source->id = $id;
		$this->Source->saveField('keycode',$keycode);
		//debug($keycode);
		if(empty($bypassRedirect)){
			$this->Session->setFlash(__('The keycode has been generated.', true));
			$this->redirect(array('action'=>'key','admin'=>false,$keycode));
		}
	}
}
