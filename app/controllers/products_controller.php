<?php
class ProductsController extends AppController {

	var $name = 'Products';
	var $helpers = array('Tags.TagCloud');
	var $components = array('Search.Prg','Uploader.Uploader','String');

	var $paginate = array(
		'limit' => 25
	);
	
	var $presetVars = array(
		array('field' => 'name', 'type' => 'value'),
		array('field' => 'product_category_id', 'type' => 'value'),
		array('field' => 'designer', 'type' => 'value'),
		array('field' => 'description', 'type' => 'value'),
		array('field' => 'source_url', 'type' => 'value'),
		array('field' => 'tags', 'type' => 'value')
		/*
			TODO Search tags
		*/
	);
	
	function beforeFilter(){
		parent::beforeFilter();
		
		$this->Uploader->uploadDir = 'media/static/img/products/';
		$this->Uploader->enableUpload = true;
		$this->Uploader->maxFileSize = '75M'; // 75 Megabytes
		$this->Uploader->tempDir = 'media/transfer/img/products/';
		//$this->Uploader->mime('image', 'gif', 'image/gif');
		//$this->Uploader->maxNameLength = 50;
		
		$this->Auth->allow('getProductsForSource','getProductsForInspiration','getTags','getProfileData','getCount');
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
		$this->paginate['conditions'] = $this->Product->parseCriteria($this->passedArgs);
		$this->set('products', $this->paginate());
		$this->set('string', $this->String);
		$productCategories = $this->Product->ProductCategory->find('list',array( 'order' => 'name ASC' ));
		$this->set(compact('productCategories'));
	}
	
	function index($filter = null) {
		
		// query all distinct first letters used in names
		$letters = $this->Product->query('SELECT DISTINCT SUBSTRING(`name`, 1, 1) FROM `products` ORDER BY `name`');
		
		$links = array();
		// push all letters into a non-nested array
		foreach ($letters as $row) {
			array_push($links, current($row[0]));
		}

		$this->paginate['Product'] = array(
										'order' => array(
											'Product.created' => 'desc'
											)
										);

		if($filter == 'number'){
			$filter = '^[0-9]+'; //Find records that start with numbers
			$products = $this->paginate('Product',array(
											   'Product.name REGEXP' => $filter
											));
			
		}else{
			$products = $this->paginate('Product',array(
											   'Product.name LIKE' => $filter.'%'
											));
			
		}
		
		if (isset($this->passedArgs['by'])) {
			$this->paginate = array(
								'Tagged'=>array(
									'tagged',
									'model' => 'Product',
									'by' => $this->passedArgs['by']
									//'recursive' => 2 //Doesn't change anything
								)
							);
			$products = Set::filter($this->paginate('Tagged')); //Remove empty values
			//Build a new array
			foreach($products as $product){
				$clean_products[] = $product;
			}
			if(!empty($clean_products)){
				$products = $clean_products;
			}
			$counter = 0;
			foreach($products as $product){
				$temp_product = $this->Product->read(null,$product['Product']['id']);
				$products[$counter] = $temp_product;
				$counter++;
			}
		}
		
		if(isset($this->params['requested'])) {
			return $products;
		}
		
		$productCategories = $this->Product->ProductCategory->getAll();
		
		$total_count = $this->Product->find('count');
		$this->set(compact('products','filter','links','total_count','productCategories'));
		$this->set('string', $this->String);
	}
	
	/**
	 * This method handles showing only the user's products
	 * @param int id The user id
	 * @return 
	 * 
	*/
	function users($id=null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user id', true));
			$this->redirect(array('action' => 'index','admin'=>false));
		}
		$user = $this->Product->User->find('first',array('conditions'=>array('User.id'=>$id)));
		if(empty($user)){
			$this->Session->setFlash(__('Invalid user id', true));
			$this->redirect(array('action' => 'index','admin'=>false));
		}
		$productCategories = $this->Product->ProductCategory->getAll();
		$products = $this->paginate('Product',array(
										   'Product.user_id' => $id
										));
		$total_count = $this->Product->find('count',array('conditions'=>array('Product.user_id'=>$id)));
		$this->set(compact('products','total_count','productCategories','user'));
		$this->set('string', $this->String);
	}
	
	/**
	 * Main view method
	 * @param int id The product id
	 * @return 
	 * 
	*/
	function view($id = null) {
		$this->Product->recursive = 2;
		if (!$id) {
			$this->Session->setFlash(__('Invalid product', true));
			$this->redirect(array('action' => 'index','admin'=>false));
		}else{
			$product = $this->Product->read(null,$id);
			if(empty($product)){
				$this->Session->setFlash(__('Invalid product', true));
				$this->redirect(array('action' => 'index','admin'=>false));
			}
			$this->set('product', $product);
			$this->set('string', $this->String);
		}
		
		/*$products = $this->Product->getAll();
		$productList = $this->Product->getList();
		$this->set('products','productList');*/
	}
	
	/**
	 * This method handles parsing the keycode and showing the proper product
	 * @param string keycode The key to an product
	 * @return 
	 * 
	*/
	function key($keycode=null){
		$this->Product->recursive = 2;
		$this->layout = 'client_review';
		if (!$keycode && empty($this->data)) {
			$this->Session->setFlash(__('Invalid keycode', true));
			$this->redirect('/');
		}
		$product = $this->Product->find('first',array('conditions'=>array('Product.keycode'=>$keycode)));
		if(empty($product)){
			$this->Session->setFlash(__('Invalid keycode', true));
			$this->redirect('/');
		}
		$this->set(compact('product'));
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
				$item = $this->Product->$model->findById($id);
				if(!empty($item)){
					//Pass along the details
					$this->set(compact('item','model','plural_model'));
				}else{
					$this->Session->setFlash(__('This record does not exist.', true));
					//TODO:Redirect the user or set a variable that hides the upload field.
					$errors['message'] = 'The item was not found in the database';
				}
			}
		}
		
		if (!empty($this->data)) {
			//Cleanup
			if(!empty($this->data['Product']['source_url'])){
				$this->data['Product']['source_url'] = $this->cleanURL($this->data['Product']['source_url']); //Clean the URL
			}
			if(!empty($this->data['Product']['purchase_url'])){
				$this->data['Product']['purchase_url'] = $this->cleanURL($this->data['Product']['purchase_url']); //Clean the URL
			}
			$this->data['Product']['slug'] = $this->toSlug($this->data['Product']['name']);
			
			//Check for a redirect variable
			if(!empty($this->data['Product']['redirect'])){
				$redirect = $this->data['Product']['redirect'];
				unset($this->data['Product']['redirect']);
			}
			
			//Upload the attachments
			$this->uploadAttachments('Product');
			
			if(!empty($this->data['Attachment'])){
				$this->Product->create();
				if ($this->Product->save($this->data)) {
					$this->Session->setFlash(__('The product has been saved', true));
					$id = $this->Product->getLastInsertID();
					//Generate and create keycode
					$this->generateKeycode($id,true);
					
					if(!empty($redirect)){
						$this->redirect($redirect);
					}else{
						$this->redirect(array('action' => 'view','admin'=>false,$id));
					}
				} else {
					$this->Session->setFlash(__('The product could not be saved. Please, try again.', true));
				}
			}else{
				$this->Session->setFlash(__('You didn\'t add any attachments or the filetype is not valid. Try saving the file to your computer and trying again.', true),'default',array('class'=>'error-message'));
				if(!empty($redirect)){
					$this->redirect($redirect);
				}
			}
			
		}
		$productCategories = $this->Product->ProductCategory->find('list',array( 'order' => 'name ASC' ));
		$sources = $this->Product->Source->find('list',array( 'order' => 'name ASC' ));
		$tags = $this->Product->Tagged->find('cloud', array('limit' => 10));
		$collections = $this->Product->Collection->find('list',array( 'order' => 'name ASC' ));
		$attachments = $this->Product->Attachment->find('list');
		$this->set('string', $this->String);
		$this->set(compact('sources', 'collections', 'attachments','tags','productCategories'));
	}
	
	function getProductsForSource($id = null){
		if (isset($this->params['requested'])) {  
			$products = $this->Product->Source->find('all',array( 'order' => 'name ASC' ));
			return $products;
		}
	}
	
	function getProductsForInspiration($id = null){
		if (isset($this->params['requested'])) {  
			$products = $this->Product->Inspiration->find('all',array( 'order' => 'name ASC' ));
			return $products;
		}
	}
	
	/*function getProductsCategories(){
		if (isset($this->params['requested'])) {  
			$productCategories = $this->Product->ProductCategory->find('list',array( 'order' => 'name ASC' ));
			return $productCategories;
		}
	}
	
	function getSources(){
		if (isset($this->params['requested'])) {  
			$sources = $this->Product->Source->find('list',array( 'order' => 'name ASC' ));
			return $sources;
		}
	}*/

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid product', true));
			$this->redirect(array('action' => 'index','admin'=>false));
		}
		if (!empty($this->data)) {
			//Cleanup
			if(!empty($this->data['Product']['source_url'])){
				$this->data['Product']['source_url'] = $this->cleanURL($this->data['Product']['source_url']); //Clean the URL
			}
			if(!empty($this->data['Product']['purchase_url'])){
				$this->data['Product']['purchase_url'] = $this->cleanURL($this->data['Product']['purchase_url']); //Clean the URL
			}
			$this->data['Product']['slug'] = $this->toSlug($this->data['Product']['name']);
			
			//Upload the attachments
			$this->uploadAttachments('Product',$id);
			
			//Update the inspiration photo tag name
			$this->Product->InspirationPhotoTag->updateName($id,'Product',$this->data['Product']['name']);
			
			if ($this->Product->saveAll($this->data)) {
				$this->Session->setFlash(__('The product has been updated', true));
				$this->redirect(array('action' => 'view','admin'=>false,$id));
			} else {
				$this->Session->setFlash(__('The product could not be updated. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Product->read(null, $id);
		}
		
		$productCategories = $this->Product->ProductCategory->find('list',array( 'order' => 'name ASC' ));
		$sources = $this->Product->Source->find('list',array( 'order' => 'name ASC' ));
		$collections = $this->Product->Collection->find('list',array( 'order' => 'name ASC' ));
		$attachments = $this->Product->Attachment->find('list');
		$tags = $this->Product->Tagged->find('cloud', array('limit' => 10));
		$this->set('product', $this->Product->read(null, $id));
		$this->set('string', $this->String);
		$this->set(compact('sources', 'collections', 'attachments','tags','productCategories'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for product', true));
			$this->redirect(array('action'=>'index','admin'=>false));
		}
		
		$this->data = $this->Product->read(null,$id);
		
		//Delete associated attachments
		if(!empty($this->data['Attachment'])){
			//Get all attachment ids
			foreach($this->data['Attachment'] as $attachment){
				$attachment_ids[] = $attachment['id'];
			}
			
			//Delete all of the attachments
			$this->Product->Attachment->deleteAll(array('Attachment.id'=>$attachment_ids));
		}
		
		if ($this->Product->delete($id)) {
			$this->Session->setFlash(__('Product deleted', true));
			$this->redirect(array('action'=>'index','admin'=>false));
		}
		$this->Session->setFlash(__('Product was not deleted', true));
		$this->redirect(array('action' => 'index','admin'=>false));
	}
	
	/** 
	 * This is a helper method that removes a attachment from the product.
	 * @param id The inspiration id targetting.
	 * @param product_id The product id to remove.
	 */
	function removeAttachment($id=null,$attachment_id=null){
		$this->Product->recursive = 1;
		$this->autoLayout = false;
		$this->autoRender = false;
		
		if (!$id) {
			$this->Session->setFlash(__('This attachement doesn\'t exist.', true));
			//$this->redirect(array('action'=>'index','admin'=>false));
		}
	
		$this->data = $this->Product->read(null, $id);
		
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
		
		if ($this->Product->save($this->data)) {
			//Delete the attachment from the system
			$this->Product->Attachment->delete($attachment_id);
			
			$this->Session->setFlash(__('The product has been updated', true));
			$this->redirect(array('action' => 'view','admin'=>false,$id));
		} else {
			$this->Session->setFlash(__('The product could not be updated. Please, try again.', true));
		}
	}
	
	/**
	 * Retrieves the items from the user id passed
	 * @param id User id
	 */
	function userProducts($id = null,$limit=25){
		$this->Product->recursive = 2;
		if(isset($this->params['requested'])) {
			$products = $this->Product->userProducts($id,$limit,'all');
			return $products;
		}
	}
	
	
	/**
	 * Finds the tags associated with this model
	 */
	function tags($filter=null){
		$this->Product->recursive = 2;
		
		// query all distinct first letters used in names
		$letters = $this->Product->query('SELECT DISTINCT SUBSTRING(`name`, 1, 1) FROM `products` ORDER BY `name`');
		
		$links = array();
		// push all letters into a non-nested array
		foreach ($letters as $row) {
			array_push($links, current($row[0]));
		}

		$this->paginate['Product'] = array(
										'order' => array(
											'Product.name' => 'asc'
											)
										);

		if($filter == 'number'){
			$filter = '^[0-9]+'; //Find records that start with numbers
			$products = $this->paginate('Product',array(
											   'Product.name REGEXP' => $filter
											));
			
		}else{
			$products = $this->paginate('Product',array(
											   'Product.name LIKE' => $filter.'%'
											));
			
		}
		
		$this->paginate = array(
							'Tagged'=>array(
											'conditions'=>array('Tagged.model'=>'Product'),
											'fields' => array('DISTINCT Tag.name,Tag.keyname'),
											'limit' => 75,
											'order' => array('Tag.name ASC')
											));
		
		$tags = $this->paginate('Tagged');
		$this->set(compact('tags'));
		$productCategories = $this->Product->ProductCategory->getAll();
		$total_count = $this->Product->find('count');
		$this->set(compact('products','filter','links','total_count','productCategories'));
		$this->set('string', $this->String);
	}
	
	/**
	 * Returns all of the tags associated with this Model. This is used by the add_tag element.
	 */
	function getTags(){
		if(isset($this->params['requested'])) {
			$temp_tags = $this->Product->Tagged->Tag->find('list');
			foreach($temp_tags as $tag){
				$tags[] = $tag;
			}
			//debug($tags);
			return $tags;
		}
	}
	
	/**
	 * Returns the total products for a specific user
	 * @param int user_id The user id you're trying to pull data for
	 * @return 
	 * 
	*/
	function getProfileData($user_id=null){
		return $this->Product->getProfileData($user_id);
	}
	
	/**
	 * Get the total # of products added in the system for a particular user
	 * @param int user_id
	 * @return int The total number of products added by the user
	**/
	function getCount($user_id=null){
		return $this->Product->getCount($user_id);
	}
	
	/**
	 * This method handles generating a random keycode for a product
	 * @param int id The product id
	 * @param bypassRedirect Bypasses the redirect if true
	 * @return 
	 * 
	*/
	function generateKeycode($id=null,$bypassRedirect=false){
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid product', true));
			$this->redirect('/');
		}
		
		$keycode = $this->String->str_rand(8,'mixed');
		$keycode .= $id;
		
		$this->Product->id = $id;
		$this->Product->saveField('keycode',$keycode);
		//debug($keycode);
		if(empty($bypassRedirect)){
			$this->Session->setFlash(__('The keycode has been generated.', true));
			$this->redirect(array('action'=>'key','admin'=>false,$keycode));
		}
	}
}
