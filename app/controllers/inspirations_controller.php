<?php
class InspirationsController extends AppController {

	var $name = 'Inspirations';
	var $helpers = array('Tags.TagCloud');
	var $components = array('Search.Prg',
							'Uploader.Uploader',
							'String',
							'RequestHandler'
							//'Comments.Comments' => array('userModelClass' => 'Users.User')
							);
	
	var $paginate = array(
		'limit' => 25,
		'order' => 'Inspiration.created DESC'
	);
							
	function beforeFilter(){
		parent::beforeFilter();
		
		//$this->passedArgs['comment_view_type'] = 'flat';
		
		$this->Uploader->uploadDir = 'media/static/img/inspirations/';
		$this->Uploader->enableUpload = true;
		$this->Uploader->maxFileSize = '75M'; // 75 Megabytes
		$this->Uploader->tempDir = 'media/transfer/img/inspirations/';
		//$this->Uploader->mime('image', 'gif', 'image/gif');
		//$this->Uploader->maxNameLength = 50;
		$this->Auth->allow('userInspirations','getProfileData');
		$this->Auth->deny('view');
	}
	
	function index($filter = null) {
		$this->Inspiration->recursive = 2;
		
		// query all distinct first letters used in names
		$letters = $this->Inspiration->query('SELECT DISTINCT SUBSTRING(`name`, 1, 1) FROM `inspirations` ORDER BY `name`');
		
		$links = array();
		// push all letters into a non-nested array
		foreach ($letters as $row) {
			array_push($links, current($row[0]));
		}

		$this->paginate['Inspiration'] = array(
										'order' => array(
											'Inspiration.created' => 'desc'
											)
										);

		if($filter == 'number'){
			$filter = '^[0-9]+'; //Find records that start with numbers
			$inspirations = $this->paginate('Inspiration',array(
											   'Inspiration.name REGEXP' => $filter
											));
			
		}else{
			$inspirations = $this->paginate('Inspiration',array(
											   'Inspiration.name LIKE' => $filter.'%'
											));
			
		}
		
		//debug($inspirations);
		if (isset($this->passedArgs['by'])) {
			$this->paginate = array(
								'Tagged'=>array(
									'tagged',
									'model' => 'Inspiration',
									'by' => $this->passedArgs['by'],
									'recursive'=>2
									//'recursive' => 2 //Doesn't change anything
								)
							);
			$inspirations = Set::filter($this->paginate('Tagged')); //Remove empty values
			//debug($inspirations);
			//Build a new array
			if(!empty($inspirations)){
				foreach($inspirations as $inspiration){
					$clean_inspirations[] = $inspiration;
				}
				
				if(!empty($clean_inspirations)){
					$inspirations = $clean_inspirations;
				}

				$counter = 0;
				foreach($inspirations as $inspiration){
					//Find attachments
					if(!empty($inspiration['Inspiration']['id'])){
						$temp_att = $this->Inspiration->read(null,$inspiration['Inspiration']['id']);
						//debug($temp_att);
						$inspirations[$counter]['Attachment'] = $temp_att['Attachment'];

						$counter++;
					}else{
						unset($inspirations[$counter]);
					}
				}
			}
		}
		
		$total_count = $this->Inspiration->find('count');
		$this->set(compact('inspirations','filter','total_count','links'));
		$this->set('string', $this->String);
	}
	
	/**
	 * This method handles only showing inspirations added by a certain user.
	 * @param int id The user id targetting 
	 * @return 
	 * 
	*/
	function users($id = null) {
		$this->Inspiration->recursive = 2;
		if (!$id) {
			$this->Session->setFlash(__('Invalid user id', true));
			$this->redirect(array('action' => 'index','admin'=>false));
		}
		$user = $this->Inspiration->User->find('first',array('conditions'=>array('User.id'=>$id)));
		if(empty($user)){
			$this->Session->setFlash(__('Invalid user id', true));
			$this->redirect(array('action' => 'index','admin'=>false));
		}
		
		$inspirations = $this->paginate('Inspiration',array(
										   'Inspiration.user_id' => $id
										));
										
		$total_count = $this->Inspiration->find('count');
		$this->set(compact('inspirations','total_count','user'));
		$this->set('string', $this->String);
	}
	
	/**
	 * The main view method
	 * @param int id
	 * @return 
	 * 
	*/
	function view($id = null) {
		$this->Inspiration->recursive = 2;
		if (!$id) {
			$this->Session->setFlash(__('Invalid inspiration', true));
			$this->redirect(array('action' => 'index','admin'=>false));
		}
		
		$this->set('inspiration', $this->Inspiration->read(null, $id));
		$countries = $this->Inspiration->Country->find('list');
		$sources = $this->Inspiration->Source->find('list');
		$products = $this->Inspiration->Product->getList();
		$productsAll = $this->Inspiration->Product->getAll();
		//$productList = $this->Inspiration->Product->getList();

		$this->set(compact('sources','products','countries','productsAll'));
		$this->set('string', $this->String);
	}

	/**
	 * This method handles parsing the keycode and showing the proper inspiration
	 * @param string keycode The key to an inspiration
	 * @return 
	 * 
	*/
	function key($keycode=null){
		$this->Inspiration->recursive = 2;
		$this->layout = 'client_review';
		if (!$keycode && empty($this->data)) {
			$this->Session->setFlash(__('Invalid keycode', true));
			$this->redirect('/');
		}
		$inspiration = $this->Inspiration->find('first',array('conditions'=>array('Inspiration.keycode'=>$keycode)));
		if(empty($inspiration)){
			$this->Session->setFlash(__('Invalid keycode', true));
			$this->redirect('/');
		}
		$countries = $this->Inspiration->Country->find('list');
		$sources = $this->Inspiration->Source->find('list');
		$products = $this->Inspiration->Product->getList();
		$productsAll = $this->Inspiration->Product->getAll();
		//$productList = $this->Inspiration->Product->getList();
		
		$this->set(compact('inspiration','sources','products','countries','productsAll'));
		$this->set('string', $this->String);
	}
	
	function admin_add() {
		if (!empty($this->data)) {
			
			if(!empty($this->data['Inspiration']['url'])){
				$this->data['Inspiration']['url'] = $this->cleanURL($this->data['Inspiration']['url']); //Clean the URL
			}
			
			//Upload the attachments
			$this->uploadAttachments('Inspiration');
			
			$this->Inspiration->create();
			if ($this->Inspiration->save($this->data)) {
				$this->Session->setFlash(__('The inspiration has been saved', true));
				$id = $this->Inspiration->getLastInsertID();
				//Generate and create keycode
				$this->generateKeycode($id,true);
				$this->redirect(array('action' => 'view','admin'=>false,$id));
			} else {
				$this->Session->setFlash(__('The inspiration could not be saved. Please, try again.', true));
			}
		}
		$countries = $this->Inspiration->Country->find('list');
		$attachments = $this->Inspiration->Attachment->find('list');
		$sources = $this->Inspiration->Source->find('list',array('order' => 'name ASC'));
		$products = $this->Inspiration->Product->find('list');
		$this->set(compact('attachments', 'sources','products','countries'));
	}
	
	/** 
	 * This is a helper method that makes it easy to add multiple products to an inspiration image.
	 * @param id The id of the current inspiration.
	 */
	function admin_addProducts($id=null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid inspiration', true),'default',array('class'=>'error-message'));
			//$this->redirect(array('action' => 'index','admin'=>false));
		}
		
		if (!empty($this->data)) {
			//Save the input data
			$data = $this->data;
			
			//Add the attachments to the current inspiration image.
			$this->data = $this->Inspiration->read(null,$id);
			
			$currentProducts = array();
			//Check to make sure the user selected a product
			if(!empty($data['Product'])){
				//Load the array with product ids that are currently attached to the inspiration
				if(!empty($this->data['Product'])){
					foreach($this->data['Product'] as $product){
						$currentProducts[] = $product['id'];
					}
				}
				
				foreach($data['Product']['Product'] as $product){
					//Check to make sure that the product doesn't already exist in the inspiration.	
					if(!empty($currentProducts)){
						if(!in_array($product,$currentProducts)){
							$currentProducts[] = $product;	
						}
					}else{
						$currentProducts[] = $product;
					}
				}

				unset($this->data['Product']);
				if(!empty($currentProducts)) $this->data['Product']['Product'] = $currentProducts;
				//On every save the array gets flipped. Keep the order the same by reversing the array.
				$this->data['Product']['Product'] = array_reverse($this->data['Product']['Product']);
				
				/*
					BUG: For some reason on each save the attachments get flipped.
					FIX: Reverse the array before saving.
					
					This is important because the tags are on the first image in the attachment array. 
				*/
				$this->data['Attachment'] = array_reverse($this->data['Attachment']);
				
				if ($this->Inspiration->save($this->data)) {
					$this->Session->setFlash(__('The inspiration has been updated', true));
					$this->redirect(array('action' => 'view','admin'=>false,$id));
				} else {
					$this->Session->setFlash(__('The inspiration could not be updated. Please, try again.', true),'default', array('class'=>'error-message'));
				}
			}else{
				$this->Session->setFlash(__('You didn\'t select any products.', true),'default', array('class'=>'error-message'));
				$this->redirect(array('action' => 'view','admin'=>false,$id));
			}
			
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid inspiration', true));
			$this->redirect(array('action' => 'index','admin'=>false));
		}
		
		if (!empty($this->data)) {
			
			//Upload the attachments
			$this->uploadAttachments('Inspiration',$id);
			
			
			if ($this->Inspiration->save($this->data)) {
				$this->Session->setFlash(__('The inspiration has been updated', true));
				$this->redirect(array('action' => 'view','admin'=>false,$id));
			} else {
				$this->Session->setFlash(__('The inspiration could not be updated. Please, try again.', true));
			}
		}
		
		if (empty($this->data)) {
			$this->data = $this->Inspiration->read(null, $id);
		}
		$countries = $this->Inspiration->Country->find('list');
		$attachments = $this->Inspiration->Attachment->find('list');
		$sources = $this->Inspiration->Source->find('list',array('order' => 'name ASC'));
		$products = $this->Inspiration->Product->find('list',array('order' => 'name ASC'));
		$this->set('inspiration', $this->Inspiration->read(null, $id));
		$this->set(compact('attachments', 'sources','products','countries'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for inspiration', true));
			$this->redirect(array('action'=>'index','admin'=>false));
		}
		if ($this->Inspiration->delete($id)) {
			$this->Session->setFlash(__('Inspiration deleted', true));
			$this->redirect(array('action'=>'index','admin'=>false));
		}
		$this->Session->setFlash(__('Inspiration was not deleted', true));
		$this->redirect(array('action' => 'index','admin'=>false));
	}
	
	/**
	 * Get a list of all of the products
	 */
	/*function getList(){
		$products = $this->Inspiration->Product->find('list');
		if(isset($this->params['requested'])) {
			return $products;
		}
		$this->set(compact('products'));
	}*/
	
	/**
	 * Retrieves the items from the user id passed
	 * @param id User id
	 */
	/*function getInspirationsFromUser($id = null){
		$this->Inspiration->recursive = 2;
		if(isset($this->params['requested'])) {
			$inspirations = $this->Inspiration->find('all',
											array(
												'conditions'=>array('Inspiration.user_id' => $id),
												'limit' => 25,
												'order' => array('Inspiration.created DESC')
											)
										);
			return $inspirations;
		}
	}*/
	
	/** 
	 * This is a helper method that removes a product from the inspiration.
	 * @param id The inspiration id targetting.
	 * @param product_id The product id to remove.
	 */
	function removeProduct($id=null,$product_id=null){
		$this->Inspiration->recursive = 1;
		$this->autoLayout = false;
		$this->autoRender = false;
		
		if (!$id) {
			$this->Session->setFlash(__('This product doesn\'t exist.', true));
			//$this->redirect(array('action'=>'index','admin'=>false));
		}
	
		$this->data = $this->Inspiration->read(null, $id);
		
		//Save the input data
		$data = $this->data;
		
		//Load the array with product ids that are currently attached to the inspiration
		foreach($this->data['Product'] as $product){
			$currentProducts[] = $product['id'];
		}
		unset($this->data['Product']);
		$this->data['Product']['Product'] = $currentProducts;
		
		
		//Remove the product id from the inspiration
		for($i=0;$i<count($this->data['Product']['Product']);$i++){
			//Find the id and remove it.
			if($this->data['Product']['Product'][$i] == $product_id){
				unset($this->data['Product']['Product'][$i]);
			}
		}
		
		//Remove the inspiration photo tag for this product
		//Find the inspiration photo tag
		$photo_tag = $this->Inspiration->InspirationPhotoTag->find('first',array(
																'conditions'=>array(
																					'model'=>'Product',
																					'model_id'=>$product_id
																					))
														);
		
		if(!empty($photo_tag)){
			$this->Inspiration->InspirationPhotoTag->delete($photo_tag['InspirationPhotoTag']['id']);
		}
		
		$this->data['Product']['Product'] = array_merge(array(),$this->data['Product']['Product']);
		//On every save the array gets flipped. Keep the order the same by reversing the array.
		$this->data['Product']['Product'] = array_reverse($this->data['Product']['Product']);
		
		/*
			BUG: For some reason on each save the attachments get flipped.
			FIX: Reverse the array before saving.
			
			This is important because the tags are on the first image in the attachment array. 
		*/
		$this->data['Attachment'] = array_reverse($this->data['Attachment']);
		if ($this->Inspiration->save($this->data)) {
			$this->Session->setFlash(__('The inspiration has been updated', true));
			$this->redirect(array('action' => 'view','admin'=>false,$id));
		} else {
			$this->Session->setFlash(__('The inspiration could not be updated. Please, try again.', true));
		}
	}
	
	/**
	 * Finds the tags associated with this model
	 */
	function tags($filter=null){
		/*
			TODO The paginator is not updating based on the DISTINCT value entered. Fix this.
		*/
		$this->Inspiration->recursive = 2;
		
		// query all distinct first letters used in names
		$letters = $this->Inspiration->query('SELECT DISTINCT SUBSTRING(`name`, 1, 1) FROM `inspirations` ORDER BY `name`');
		
		$links = array();
		// push all letters into a non-nested array
		foreach ($letters as $row) {
			array_push($links, current($row[0]));
		}

		$this->paginate['Inspiration'] = array(
										'order' => array(
											'Inspiration.created' => 'desc'
											)
										);

		if($filter == 'number'){
			$filter = '^[0-9]+'; //Find records that start with numbers
			$inspirations = $this->paginate('Inspiration',array(
											   'Inspiration.name REGEXP' => $filter
											));
			
		}else{
			$inspirations = $this->paginate('Inspiration',array(
											   'Inspiration.name LIKE' => $filter.'%'
											));
			
		}
		
		$this->paginate = array(
							'Tagged'=>array(
											'conditions'=>array(
												'Tagged.model'=>'Inspiration'
												),
											'fields'=>'DISTINCT Tag.name,Tag.keyname',
											'limit' => 75,
											'order' => array('Tag.name ASC')
											));
		
		$tags = $this->paginate('Tagged');
		$this->set(compact('tags'));
		$total_count = $this->Inspiration->find('count');
		$this->set(compact('total_count','filter','links','inspirations'));
		$this->set('string', $this->String);
	}
	
	/**
	 * Returns all of the tags associated with this Model. This is used by the add_tag element.
	 */
	function getTags(){
		if(isset($this->params['requested'])) {
			$temp_tags = $this->Inspiration->Tagged->Tag->find('list');
			foreach($temp_tags as $tag){
				$tags[] = $tag;
			}
			//debug($tags);
			return $tags;
		}
	}
	
	/**
	 * Retrieves the items from the user id passed
	 * @param id User id
	 */
	function userInspirations($id = null,$limit=25){
		$this->Inspiration->recursive = 2;
		if(isset($this->params['requested'])) {
			$inspirations = $this->Inspiration->userInspirations($id,$limit,'all');
			return $inspirations;
		}
	}
	
	/**
	 * Returns the total inspirations for a specific user
	 * @param int user_id The user id you're trying to pull data for
	 * @return 
	 * 
	*/
	function getProfileData($user_id=null){
		return $this->Inspiration->getProfileData($user_id);
	}
	
	/**
	 * This method handles generating a random keycode for an inspiration
	 * @param int id The inspiration id
	 * @param bypassRedirect Bypasses the redirect if true
	 * @return 
	 * 
	*/
	function generateKeycode($id=null,$bypassRedirect=false){
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid inspiration', true));
			$this->redirect('/');
		}
		//$inspiration = $this->Inspiration->read(null,$id);
		$keycode = $this->String->str_rand(8,'mixed');
		$keycode .= $id;
		
		$this->Inspiration->id = $id;
		$this->Inspiration->saveField('keycode',$keycode);
		//debug($keycode);
		if(empty($bypassRedirect)){
			$this->Session->setFlash(__('The keycode has been generated.', true));
			$this->redirect(array('action'=>'key','admin'=>false,$keycode));
		}
	}
	
}
