<?php
class CollectionsController extends AppController {

	var $name = 'Collections';
	var $helpers = array('Tags.TagCloud');
	var $components = array('Search.Prg','String');
	
	var $paginate = array(
		'limit' => 25
	);
	
	var $presetVars = array(
		array('field' => 'name', 'type' => 'value'),
		array('field' => 'description', 'type' => 'value')
	);
	
	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
	function beforeFilter(){
		parent::beforeFilter();
		
		/*$this->Uploader->uploadDir = 'media/static/img/products/';
		$this->Uploader->enableUpload = true;
		$this->Uploader->maxFileSize = '75M'; // 75 Megabytes
		$this->Uploader->tempDir = 'media/transfer/img/products/';*/
		//$this->Uploader->mime('image', 'gif', 'image/gif');
		//$this->Uploader->maxNameLength = 50;
		
		$this->Auth->allow('userCollections');
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
		$this->paginate['conditions'] = $this->Collection->parseCriteria($this->passedArgs);
		$this->set('collections', $this->paginate());
	}
	
	function index($filter=null) {
		$this->Collection->recursive = 2;
		
		// query all distinct first letters used in names
		$letters = $this->Collection->query('SELECT DISTINCT SUBSTRING(`name`, 1, 1) FROM `collections` ORDER BY `name`');
		
		$links = array();
		// push all letters into a non-nested array
		foreach ($letters as $row) {
			array_push($links, current($row[0]));
		}

		$this->paginate['Collection'] = array(
										'order' => array(
											'Collection.name' => 'asc'
											)
										);

		if($filter == 'number'){
			$filter = '^[0-9]+'; //Find records that start with numbers
			$collections = $this->paginate('Collection',array(
											   'Collection.name REGEXP' => $filter
											));
			
		}else{
			$collections = $this->paginate('Collection',array(
											   'Collection.name LIKE' => $filter.'%'
											));
			
		}
		
		if(isset($this->passedArgs['by'])) {
			$this->paginate = array(
								'Tagged'=>array(
									'tagged',
									'model' => 'Collection',
									'by' => $this->passedArgs['by']
									//'recursive' => 2 //Doesn't change anything
								)
							);
			$collections = Set::filter($this->paginate('Tagged')); //Remove empty values
			//Build a new array
			foreach($collections as $collection){
				$clean_collections[] = $collection;
			}
			if(!empty($clean_collections)){
				$collections = $clean_collections;
			}
			$counter = 0;
			foreach($collections as $collection){
				$temp_collection = $this->Collection->read(null,$collection['Collection']['id']);
				$collections[$counter] = $temp_collection;
				$counter++;
			}
		}

		$this->set(compact('collections','filter','links'));
		//$this->set('collections', $this->paginate());
		$this->set('string', $this->String);
	}

	/**
	 * Main view method
	 * @param 
	 * @return 
	 * 
	*/
	function view($id = null) {
		$this->Collection->recursive = 2;
		if (!$id) {
			$this->Session->setFlash(__('Invalid collection', true));
			$this->redirect(array('action' => 'index','admin'=>false));
		}
		
		//Update the collection count
		$this->Collection->updateTotalCount($id);
		
		$productCategoryList = $this->Collection->Product->getCategories();
		//Initialize the Source model because it's not a part of the collection. 
		//This is used in the add form that's in the element.
		$sourceList = ClassRegistry::init('Source')->getList(); 
		
		$productList = $this->Collection->Product->getList();
		$products = $this->Collection->Product->getAll();
		
		$this->set(compact('productCategoryList','sourceList','products','productList'));
		$this->set('collection', $this->Collection->read(null, $id));
		$this->set('string', $this->String);
		
	}
	
	/**
	 * This method handles parsing the keycode and showing the proper collection
	 * @param string keycode The key to an collection
	 * @return 
	 * 
	*/
	function key($keycode=null){
		$this->Collection->recursive = 2;
		$this->layout = 'client_review';
		if (!$keycode && empty($this->data)) {
			$this->Session->setFlash(__('Invalid keycode', true));
			$this->redirect('/');
		}
		
		$collection = $this->Collection->find('first',array('conditions'=>array('Collection.keycode'=>$keycode)));
		if(empty($collection)){
			$this->Session->setFlash(__('Invalid keycode', true));
			$this->redirect('/');
		}
		//Update the collection count
		$this->Collection->updateTotalCount($collection['Collection']['id']);
		
		$productCategoryList = $this->Collection->Product->getCategories();
		//Initialize the Source model because it's not a part of the collection. 
		//This is used in the add form that's in the element.
		$sourceList = ClassRegistry::init('Source')->getList(); 
		
		$productList = $this->Collection->Product->getList();
		$products = $this->Collection->Product->getAll();
		
		$this->set(compact('collection','productCategoryList','sourceList','products','productList'));
		$this->set('string', $this->String);
	}
	

	function admin_add() {
		if (!empty($this->data)) {
			$this->Collection->create();
			if ($this->Collection->save($this->data)) {
				$this->Session->setFlash(__('The collection has been saved', true));
				$id = $this->Collection->getLastInsertID();
				//Generate and create keycode
				$this->generateKeycode($id,true);
				$this->redirect(array('action' => 'view','admin'=>false,$id));
			} else {
				$this->Session->setFlash(__('The collection could not be saved. Please, try again.', true));
			}
		}
		
		$products = $this->Collection->Product->find('list',array('order' => 'name ASC'));
		$tags = $this->Collection->Tagged->find('cloud', array('limit' => 10));
		$this->set(compact('products','tags'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid collection', true));
			$this->redirect(array('action' => 'index','admin'=>false));
		}
		if (!empty($this->data)) {
			//Update the total products count
			$total_products = count($this->data['Product']['Product']);
			$this->data['Collection']['total_products'] = $total_products;
			if ($this->Collection->save($this->data)) {
				$this->Session->setFlash(__('The collection has been updated', true));
				$this->redirect(array('action' => 'view','admin'=>false,$id));
			} else {
				$this->Session->setFlash(__('The collection could not be updated. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Collection->read(null, $id);
		}
		$this->set('collection', $this->Collection->read(null, $id));
		$tags = $this->Collection->Tagged->find('cloud', array('limit' => 10));
		$products = $this->Collection->Product->find('list',array('order' => 'name ASC'));
		$this->set(compact('products','tags'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for collection', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Collection->delete($id)) {
			$this->Session->setFlash(__('Collection deleted', true));
			$this->redirect(array('action'=>'index','admin'=>false));
		}
		$this->Session->setFlash(__('Collection was not deleted', true));
		$this->redirect(array('action' => 'index','admin'=>false));
	}
	
	/** 
	 * This is a helper method that makes it easy to add multiple products to an collection image.
	 * @param id The id of the current collection.
	 */
	function admin_addProducts($id=null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid collection', true),'default',array('class'=>'error-message'));
			//$this->redirect(array('action' => 'index','admin'=>false));
		}
		
		if (!empty($this->data)) {
			//Save the input data
			$data = $this->data;
			
			//Add the attachments to the current collection image.
			$this->data = $this->Collection->read(null,$id);
			
			$currentProducts = array();
			//Check to make sure the user selected a product
			if(!empty($data['Product'])){
				//Load the array with product ids that are currently attached to the collection
				if(!empty($this->data['Product'])){
					foreach($this->data['Product'] as $product){
						$currentProducts[] = $product['id'];
					}
				}
				
				foreach($data['Product']['Product'] as $product){
					//Check to make sure that the product doesn't already exist in the collection.	
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
				
				if ($this->Collection->save($this->data)) {
					$this->Session->setFlash(__('The collection has been updated', true));
					$this->redirect(array('action' => 'view','admin'=>false,$id));
				} else {
					$this->Session->setFlash(__('The collection could not be updated. Please, try again.', true),'default', array('class'=>'error-message'));
				}
			}else{
				$this->Session->setFlash(__('You didn\'t select any products.', true),'default', array('class'=>'error-message'));
				$this->redirect(array('action' => 'view','admin'=>false,$id));
			}
			
		}
	}
	
	/**
	 * This method handles only showing collections added by a certain user.
	 * @param int id The user id targetting 
	 * @return 
	 * 
	*/
	function users($id = null) {
		$this->Collection->recursive = 2;
		if (!$id) {
			$this->Session->setFlash(__('Invalid user id', true));
			$this->redirect(array('action' => 'index','admin'=>false));
		}
		
		$user = $this->Collection->User->find('first',array('conditions'=>array('User.id'=>$id)));
		if(empty($user)){
			$this->Session->setFlash(__('Invalid user id', true));
			$this->redirect(array('action' => 'index','admin'=>false));
		}
		
		$collections = $this->paginate('Collection',array(
										   'Collection.user_id' => $id
										));
										
		$total_count = $this->Collection->find('count');
		$this->set(compact('collections','total_count','user','links'));
		$this->set('string', $this->String);
	}
	
	/** 
	 * This is a helper method that removes a product from the collection.
	 * @param id The collection id targeting.
	 * @param product_id The product id to remove.
	 */
	function removeProduct($id=null,$product_id=null){
		$this->Collection->recursive = 1;
		$this->autoLayout = false;
		$this->autoRender = false;
		
		if (!$id) {
			$this->Session->setFlash(__('This product doesn\'t exist.', true));
			//$this->redirect(array('action'=>'index','admin'=>false));
		}
		
		if(empty($this->data)) {
			$this->data = $this->Collection->read(null, $id);
			
			//Save the input data
			$data = $this->data;
			
			//Load the array with product ids that are currently attached to the collection
			foreach($this->data['Product'] as $product){
				$currentProducts[] = $product['id'];
			}
			unset($this->data['Product']);
			$this->data['Product']['Product'] = $currentProducts;
			for($i=0;$i<count($this->data['Product']['Product']);$i++){
				if($this->data['Product']['Product'][$i] == $product_id){
					unset($this->data['Product']['Product'][$i]);
				}
			}
			$this->data['Product']['Product'] = array_merge(array(),$this->data['Product']['Product']);
			
			//On every save the array gets flipped. Keep the order the same by reversing the array.
			$this->data['Product']['Product'] = array_reverse($this->data['Product']['Product']);
			
			if ($this->Collection->save($this->data)) {
				$this->Session->setFlash(__('The collection has been updated', true));
				$this->redirect(array('action' => 'view','admin'=>false,$id));
			} else {
				$this->Session->setFlash(__('The collection could not be updated. Please, try again.', true));
			}
		}
	}
	
	/**
	 * Finds the tags associated with this model
	 */
	function tags($filter=null){
		$this->Collection->recursive = 2;
		
		// query all distinct first letters used in names
		$letters = $this->Collection->query('SELECT DISTINCT SUBSTRING(`name`, 1, 1) FROM `collections` ORDER BY `name`');
		
		$links = array();
		// push all letters into a non-nested array
		foreach ($letters as $row) {
			array_push($links, current($row[0]));
		}

		$this->paginate['Collection'] = array(
										'order' => array(
											'Collection.name' => 'asc'
											)
										);

		if($filter == 'number'){
			$filter = '^[0-9]+'; //Find records that start with numbers
			$collections = $this->paginate('Collection',array(
											   'Collection.name REGEXP' => $filter
											));
			
		}else{
			$collections = $this->paginate('Collection',array(
											   'Collection.name LIKE' => $filter.'%'
											));
			
		}
		
		$this->paginate = array(
							'Tagged'=>array(
											'conditions'=>array('Tagged.model'=>'Collection'),
											'fields' => array('DISTINCT Tag.name,Tag.keyname'),
											'limit' => 75,
											'order' => array('Tag.name ASC')
											));
		
		$tags = $this->paginate('Tagged');
		$this->set(compact('tags'));
		$total_count = $this->Collection->find('count');
		$this->set(compact('collections','filter','links','total_count'));
		$this->set('string', $this->String);
	}
	
	/**
	 * This method handles generating a random keycode for a collection
	 * @param int id The collection id
	 * @param bypassRedirect Bypasses the redirect if true
	 * @return 
	 * 
	*/
	function generateKeycode($id=null,$bypassRedirect = false){
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid collection', true));
			$this->redirect('/');
		}
		
		$keycode = $this->String->str_rand(8,'mixed');
		$keycode .= $id;
		
		$this->Collection->id = $id;
		$this->Collection->saveField('keycode',$keycode);
		//debug($keycode);
		if(empty($bypassRedirect)){
			$this->Session->setFlash(__('The keycode has been generated.', true));
			$this->redirect(array('action'=>'key','admin'=>false,$keycode));
		}
	}
	
	/**
	 * Returns the total collections for a specific user
	 * @param int user_id The user id you're trying to pull data for
	 * @return 
	 * 
	*/
	function getProfileData($user_id=null){
		return $this->Collection->getProfileData($user_id);
	}
	
	/**
	 * Retrieves the items from the user id passed
	 * @param id User id
	 */
	function userCollections($id = null,$limit=25){
		$this->Collection->recursive = 2;
		if(isset($this->params['requested'])) {
			$collections = $this->Collection->userCollections($id,$limit,'all');
			return $collections;
		}
	}
	
}
