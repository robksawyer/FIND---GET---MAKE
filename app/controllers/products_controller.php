<?php
class ProductsController extends AppController {

	var $name = 'Products';
	var $components = array('Search.Prg','Uploader.Uploader','Comments.Comments' => array('userModel' => 'User'),'Email');
	var $helpers = array('Tags.TagCloud');

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
	
	public function beforeFilter(){
		parent::beforeFilter();
		
		//Make certain pages public
		$this->Auth->allowedActions = array('index','view','verifyAddition','clearVerifySessions',
											'getProductsForSource','getProductsForInspiration','userProducts',
											'comments','bookmarklet_product_add','callback_commentsAdd','callback_commentsAfterAdd',
											'send_email_on_comment','send_email_on_product_add_to_storage'
											);
		
		$this->Uploader->uploadDir = 'media/static/img/products/';
		$this->Uploader->enableUpload = true;
		$this->Uploader->maxFileSize = '75M'; // 75 Megabytes
		$this->Uploader->tempDir = 'media/transfer/img/products/';
		//$this->Uploader->mime('image', 'gif', 'image/gif');
		//$this->Uploader->maxNameLength = 50;
		
		if(isset($this->Security)){
			$this->Security->enabled = false;
			$this->Security->validatePost = false;
		}
		
		$this->passedArgs['comment_view_type'] = 'flat';
		
		/* SMTP Options */
		$this->Email->smtpOptions = array(
			'port'=>'25',
			'timeout'=>'30',
			'host' => 's64785.gridserver.com',
			'username'=>'mailer@find-get-make.com',
			'password'=>'fgmmailer',
			'client' => 's64785.gridserver.com'
		);

	    /* Set delivery method */
	    $this->Email->delivery = 'smtp';

		$this->Email->replyTo = '<noreply@'.env('HTTP_HOST').'>'; 
		$this->Email->return = '<noreply@'.env('HTTP_HOST').'>';
	}
	
	/**
	 * This happens before the page is rendered
	 * @param 
	 * @return 
	 * 
	*/
	public function beforeRender(){
		//Check to see if the user has flagged the item
		$user_id = $this->Auth->user('id');
		$model = $this->modelClass;
		$flagged = $this->$model->Flag->hasUserFlagged($user_id,$model,$this->$model->id);
		$staff_favorite = $this->$model->StaffFavorite->hasUserFavorited($user_id,$model,$this->$model->id);
		$this->set(compact('flagged','staff_favorite'));
	}
	
	/**************** AJAX METHODS ************************/
	
	public function comments($id = null) {
		$products = $this->Product->read(null, $id);
		$this->layout = 'ajax'; 
		$this->set(compact('products', 'id'));
	}
	
	/**************** END AJAX METHODS ************************/
	
	/**************** API METHODS ************************/
	
	/**
	 * This method handles adding a product to the system using the bookmarklet tool
	 * 
	 * Example string: http://find-get-make.com/b/fgmpk_5eeeca1a0b2ed4c29df34327bf8e0ffe?c=1&p=2&i=http://fpoimg.com/500x550&r=http://find-get-make.local/pages/bookmarklet&t=FIND | GET | MAKE : Bookmarklet&l=http://find-get-make.local/pages/bookmarklet
	 * var call = "http://find-get-make.com/b/";
	 * call += this.selection["public_key"]; //Check to make sure the key is valid
	 * call += "?";
	 * call += "c=" + encodeURIComponent(this.selection["category"]) + "&";
	 * call += "p=" + encodeURIComponent(this.selection["price"]) + "&";
	 * call += "i=" + encodeURIComponent(this.selection["image"]) + "&";
	 * call += "r=" + encodeURIComponent(this.selection["baseUrl"]) + "&";
	 * call += "t=" + encodeURIComponent(this.selection["pageTitle"]) + "&";
	 * call += "l=" + encodeURIComponent(this.selection["referringUrl"]);
	 * 
	 * @param 
	 * @return 
	 * 
	 * Routing::prefix makes this http://site.com/b/
	 * 
	*/
	public function bookmarklet_product_add($pk = null){
		Configure::write('debug',2);
		$this->autoRender = false;
		$this->autoLayout = false;
		//$this->layout = 'ajax';
		
		//Check to make sure that params were passed
		if (!empty($this->params['url'])) {
			//Verify that the public key is a valid one.
			$user = $this->Product->User->verifyPublicKey($pk);
			if(!empty($user)){
				$categoryId = $this->params['url']['c'];
				$priceKey = $this->params['url']['p'];
				$image = $this->params['url']['i'];
				$baseURL = $this->params['url']['r'];
				$pageTitle = $this->params['url']['t'];
				$referringUrl = $this->params['url']['l'];
				$tags = $this->params['url']['g'];
				//debug($urlString);
				/*Array
				(
				    [scheme] => http
				    [host] => shop.acontinuouslean.com
				    [path] => /collections/all
				)*/
				$baseUrlString = parse_url(trim($baseURL));
				$urlString = parse_url(trim($referringUrl));
				$baseSourceUrl = $baseUrlString['scheme']."://".$baseUrlString['host'];
				$sourceName = $this->getStoreNameFromURL($baseUrlString['host']);
				$source = $this->Product->Source->find('first',array('conditions'=>array(
																					'OR'=>array(
																						array('Source.url'=>"$baseSourceUrl"),
																						array('Source.url'=>"$baseSourceUrl/"),
																						array('Source.name'=>"$sourceName")
																					)
																					)));
				
				//Fill up a data array to be saved
				if(!empty($source)){
					$this->data['Product']['source_id'] = $source['Source']['id']; //Add the source to the product
				}else{
					//Do some post processing and add the source
					$sourceCategoryValues = array(1,6,9,12,13,47,49,48); //Actual category values in the database
					$sourceData['Source']['name'] = $sourceName; //Build a name from the url
					$sourceData['Source']['url'] = $baseSourceUrl;
					$sourceData['Source']['user_id'] = $user['User']['id'];
					$sourceData['Source']['source_category_id'] = $sourceCategoryValues[$categoryId];
					$this->data['Source']['slug'] = $this->toSlug($this->data['Source']['name']);
					
					$this->Product->Source->create();
					if($this->Product->Source->save($sourceData['Source'])){
						//Success
						CakeLog::write('events','BOOKMARKLET::The source '.$sourceName.' was added via the bookmarklet.');
						$source_id = $this->Product->Source->getLastInsertID();
						//Generate and create keycode
						$keycode = $this->str_rand(8,'mixed');
						$keycode .= $source_id;

						$this->Product->Source->id = $source_id;
						$this->Product->Source->saveField('keycode',$keycode);
					
						$this->data['Product']['source_id'] = $source_id;
					}else{
						CakeLog::write('error_events','BOOKMARKLET::There was an error adding the source named '.$sourceName.' from '.$baseURL.'.');
					}
				}
				
				//Check to make sure that the product doesn't already exist
				$productCheck = $this->Product->find('first',array('conditions'=>array('Product.purchase_url'=>$baseURL)));
				
				//Don't add the product if it already exists
				if(empty($productCheck)){
					/*
						TODO Parse pageTitle i.e., 'Amazon.com:' etc.
					*/
					$this->data['Product']['name'] = $pageTitle;
					$this->data['Product']['tags'] = $tags;
					//this.array_price = new Array("$1-20", "$20-50", "$50-100", "$100-200", "$200-500", "$500-5000", "$5000+");
					$priceValues = array("$1-20", "$20-50", "$50-100", "$100-200", "$200-500", "$500-5000", "$5000+"); 
					$this->data['Product']['price'] = $priceValues[$priceKey];
					/*
					this.array_category = [
						{"id":1,"label":"Accessory"},
						{"id":5,"label":"Furniture"},
						{"id":7,"label":"Lighting"},
						{"id":15,"label":"Textile"},
						{"id":16,"label":"Wallcovering or Finish"},
						{"id":5,"label":"Rug or Mat"},
						{"id":2,"label":"Art or Antique"},
						{"id":43,"label":"Other"}
					];
					*/
					$productCategoryValues = array(1,5,7,15,16,5,2,43); //Actual category values in the database
					$this->data['Product']['product_category_id'] = $productCategoryValues[$categoryId];
					$this->data['Product']['source_url'] = $baseSourceUrl;
					$this->data['Product']['purchase_url'] = $baseURL;
					$this->data['Product']['bookmarklet_add'] = 1; //Because it was added with the bookmarklet
					$this->data['Product']['user_id'] = $user['User']['id'];
					$this->data['Attachment']['url'] = $image;

					//Cleanup
					if(!empty($this->data['Product']['source_url'])){
						$this->data['Product']['source_url'] = $this->cleanURL($this->data['Product']['source_url']); //Clean the URL
					}
					if(!empty($this->data['Product']['purchase_url'])){
						$this->data['Product']['purchase_url'] = $this->cleanURL($this->data['Product']['purchase_url']); //Clean the URL
					}
					$this->data['Product']['slug'] = $this->toSlug($this->data['Product']['name']);

					if(!empty($this->data['Attachment'])){

						$this->Product->create();
						if ($this->Product->save($this->data)) {

							$id = $this->Product->getLastInsertID();
							//Upload the attachments
							$this->uploadAttachments('Product',$id);
							
							//Add the product to the user's storage
							$this->Product->Storage->addItem($user['User']['id'],$id,'Product');

							//Generate and create keycode
							$this->generateKeycode($id,true);
							return true;
						} else {
							CakeLog::write('error_events','BOOKMARKLET::There was an error adding the product named '.$pageTitle.' from '.$baseURL.'.');
							return false;
						}
					}else{
						return false;
					}
				}else{
					//The product exists already add it to the user's storage
					$this->Product->Storage->addItem($user['User']['id'],$productCheck['Product']['id'],'Product');
					//Send an email if the user has allowed this
					$this->send_email_on_product_add_to_storage('Product',$productCheck['Product']['id']);
				}
				
			}
		}
	}
	
	/**
	 * Removes the protocol and domain from a URL and returns a nice string that can be used as a name for a source 
	 * @param 
	 * @return 
	 * 
	*/
	protected function getStoreNameFromURL($url=""){
		$nameClean = explode(".",$url);
		if(!empty($nameClean)){
			if($nameClean[0] != "www"){
				$name = $nameClean[0].".".$nameClean[1];
			}else{
				$name = $nameClean[1];
			}
			return ucfirst($name);
		}else{
			return false;
		}
	}
	
	/**************** API METHODS ************************/
	
	public function find() {
		$this->Prg->commonProcess();
		$this->paginate['conditions'] = $this->Product->parseCriteria($this->passedArgs);
		$this->paginate['contain'] = array('ProductCategory');
		if(!empty($this->passedArgs)){
			$products = $this->paginate();
		}
		$this->data['Product'] = $this->passedArgs; //Automatically fill in the form with previous search data
		
		$productCategories = $this->Product->ProductCategory->getList();
		$this->set(compact('productCategories','products'));
	}
	
	public function index($filter = null) {
		$this->Product->recursive = 1;
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
			$this->paginate['Tagged'] = array(
												'model' => 'Product',
												'tagged',
												'by' => $this->passedArgs['by'],
												'recursive'=>2 //Removing this throws errors.
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
		
	}
	
	/**
	 * Main view method
	 * @param int id The product id
	 * @return 
	 * 
	*/
	public function view($id = null) {
		$this->Product->recursive = 1;
		if (!$id) {
			$this->Session->setFlash(__('Invalid product', true));
			$this->redirect(array('action' => 'index','admin'=>false));
		}else{
			//$product = $this->Product->read(null,$id);
			$product = $this->Product->getViewData($id);
			if(empty($product)){
				$this->Session->setFlash(__('Invalid product', true));
				$this->redirect(array('action' => 'index','admin'=>false));
			}
			$this->set("title_for_layout", "Product : ".$product['Product']['name']);
			$this->set(compact('product'));
		}
		
		$relatedProducts = $this->Product->getProductsFromSource($product['Product']['source_id'],$product['Product']['id'],3); //Find three other products from the source
		$otherProducts = $this->Product->getOtherProductsForUser($product['Product']['user_id'],$product['Product']['id'],6);
		$usersStoring = $this->Product->Storage->getUsersStoring($product['Product']['user_id'],$product['Product']['id'],'Product',50);
		$this->set(compact('relatedProducts','otherProducts','usersStoring'));
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
	public function key($keycode=null){
		$this->Product->recursive = 1;
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
		
	}
	
	
	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
	public function add() {
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
			
			if(!empty($this->data['Attachment'])){
				
				$this->Product->create();
				if ($this->Product->save($this->data)) {
					$this->Session->setFlash(__('The product has been saved', true));
					$id = $this->Product->getLastInsertID();
					
					//Generate and create keycode
					$this->generateKeycode($id,true);
					
					//Upload the attachments
					$this->uploadAttachments('Product',$id);
					
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
		
		$this->set(compact('sources', 'collections', 'attachments','tags','productCategories'));
	}
	
	
	public function getProductsForSource($id = null){
		if (isset($this->params['requested'])) {  
			$products = $this->Product->Source->find('all',array( 'order' => 'name ASC' ));
			return $products;
		}
	}
	
	public function getProductsForInspiration($id = null){
		if (isset($this->params['requested'])) {  
			$products = $this->Product->Inspiration->find('all',array( 'order' => 'name ASC' ));
			return $products;
		}
	}
	
	/*public function getProductsCategories(){
		if (isset($this->params['requested'])) {  
			$productCategories = $this->Product->ProductCategory->find('list',array( 'order' => 'name ASC' ));
			return $productCategories;
		}
	}
	
	public function getSources(){
		if (isset($this->params['requested'])) {  
			$sources = $this->Product->Source->find('list',array( 'order' => 'name ASC' ));
			return $sources;
		}
	}*/
	
	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
	public function edit($id = null) {
		$this->Product->recursive = 1;
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
		
		$this->set(compact('sources', 'collections', 'attachments','tags','productCategories'));
	}
	
	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
	public function delete($id = null) {
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
	public function removeAttachment($id=null,$attachment_id=null){
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
	 * This method handles showing only the user's products
	 * @param int id The user id
	 * @return 
	 * 
	*/
	public function users($id=null) {
		$this->Product->recursive = 1;
		if (!$id) {
			$this->Session->setFlash(__('Invalid user id', true));
			$this->redirect(array('action' => 'index','admin'=>false));
		}
		//Check to see if the username was passed
		if(is_numeric($id)){
			$user = $this->Product->User->find('first',array('conditions'=>array('User.id'=>$id)));
		}else{
			$user = $this->Product->User->find('first',array('conditions'=>array('User.username'=>$id)));
			$id = $user['User']['id'];
		}
		if(empty($user)){
			$this->Session->setFlash(__('Invalid user id', true));
			$this->redirect(array('action' => 'index','admin'=>false));
		}
		$productCategories = $this->Product->ProductCategory->getAll();
		$this->paginate = array('conditions'=>array('Product.user_id' => $id),
								'order' => array(
									'Product.created' => 'desc'
									)
								);
		$products = $this->paginate('Product');
		$total_count = $this->Product->find('count',array('conditions'=>array('Product.user_id'=>$id)));
		$this->set(compact('products','total_count','productCategories','user'));
		
	}
	
	/**
	 * Retrieves the items from the user id passed
	 * @param id User id
	 */
	public function userProducts($id = null,$limit=25){
		$this->Product->recursive = 1;
		if(isset($this->params['requested'])) {
			$products = $this->Product->userProducts($id,$limit,'all');
			return $products;
		}
	}
	
	
	/**
	 * Finds the tags associated with this model
	 */
	public function tags($filter=null){
		$this->Product->recursive = 1;
		
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
	
		$this->Product->Tagged->recursive = 2;
		$this->paginate['conditions']['Tagged.model'] = 'Product';
		$this->paginate['fields'] = 'DISTINCT Tag.name,Tag.keyname,Tagged.model';
		$this->paginate['limit'] = 50;
		//debug($this->paginate['count']);
		$tag_count = count($this->Product->Tagged->find('tagged',array('conditions'=>array('Tagged.model'=>'Product'),'fields'=>'DISTINCT Tag.name')));
		$page_count = $tag_count/50;
		$tags = $this->paginate('Tagged');

		$this->set(compact('tags','tag_count','page_count'));
		$productCategories = $this->Product->ProductCategory->getAll();
		$total_count = $this->Product->find('count');
		$this->set(compact('products','filter','links','total_count','productCategories'));
		
	}
	
	/**
	 * Returns all of the tags associated with this Model. This is used by the add_tag element.
	 */
	public function getTags(){
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
	public function getProfileData($user_id=null){
		return $this->Product->getProfileData($user_id);
	}
	
	/**
	 * Get the total # of products added in the system for a particular user
	 * @param int user_id
	 * @return int The total number of products added by the user
	**/
	public function getCount($user_id=null){
		return $this->Product->getCount($user_id);
	}
	
	/**
	 * This method handles generating a random keycode for a product
	 * @param int id The product id
	 * @param bypassRedirect Bypasses the redirect if true
	 * @return 
	 * 
	*/
	public function generateKeycode($id=null,$bypassRedirect=false){
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid product', true));
			$this->redirect('/');
		}
		
		$keycode = $this->str_rand(8,'mixed');
		$keycode .= $id;
		
		$this->Product->id = $id;
		$this->Product->saveField('keycode',$keycode);
		//debug($keycode);
		if(empty($bypassRedirect)){
			$this->Session->setFlash(__('The keycode has been generated.', true));
			$this->redirect(array('action'=>'key','admin'=>false,$keycode));
		}
	}
	
	/**
	 * This method verifies the multiple items with the same name don't get added.
	 * If an item with the same name is found. A session is set with a check count and the
	 * name. The user is then prompted to verify that they actually want to add the record.
	 * @param $model The current model
	 * @return Boolean
	 */ 
	public function verifyAddition($model = null){
		$checker = $this->Session->read('Check.count');
		$name = $this->Session->read('Check.name');
		$passed_check = true;
		if(empty($checker)){
			$check_item = $this->$model->findByName($this->data[$model]['name']);
			if(!empty($check_item)){
				$passed_check = false;
				$this->Session->write('Check.count', '1');
				$this->Session->write('Check.name', $this->data[$model]['name']);
			}else{
				$passed_check = true;
			}
		}else if($this->data[$model]['name'] != $name){
			$check_item = $this->$model->findByName($this->data[$model]['name']);
			if(!empty($check_item)){
				$passed_check = false;
				$this->Session->write('Check.count', '1');
				$this->Session->write('Check.name', $this->data[$model]['name']);
			}else{
				$passed_check = true;
			}
		}
		
		return $passed_check;
	}
	
	/**
	 * Clears the sessions set by the verifyAddition method.
	 */
	public function clearVerifySessions(){
		$this->Session->delete('Check.count');
		$this->Session->delete('Check.name');
	}
	
	/**
	 * Fired before a comment is saved, but when it's added.
	 * @param 
	 * @return 
	 * 
	*/
	public function callback_commentsAdd($modelId, $commentId, $displayType, $data = array()) {
	    if (!empty($this->data)) {
			//Check the comment to see if @someone was added. If so, send the user a message.
			///perform some validation and field manipulations here. all value need to store into the $data.
			//$data['Comment']['author_name'] = $this->Auth->user('username');
			//$data['Comment']['author_email'] = $this->Auth->user('email');

			/*$valid = true;
			if (empty($this->data['Comment']['author_name'])) {
 				$valid = false;
			}
			if (!$valid) {
				$this->Session->setFlash(__('Please enter necessery information', true));
				return;
			}*/
	    }
	    return $this->Comments->callback_add($modelId, $commentId, $displayType, $data);
	}
	
	/**
	 * Called after a comment is successfully saved.
	 * @param array options
	 * @return 
	 * Array(
	 *   [userId] => 2
	 *   [modelId] => 210
	 *   [modelName] => Product
	 *   [defaultTitle] => 
	 *   [data] => Array(
	 * 				[Comment] => Array(
	 *					[body] => Cool chair
	 * 			)
	 *   )
	 *   [permalink] => 
	 *   [commentId] => 4e897001-2f08-4b92-a950-1390482fe47e
	 * )
	 * 
	*/
	public function callback_commentsAfterAdd($options) {
		//Send an email when someone comments on the product
		$this->send_email_on_comment($options['modelName'],$options['modelId'],$options['data']);
	}
	
	/******************************** NOTIFICATIONS *******************************************/
	
	/**
	 * Sends an email when someone adds an item that has already been added. This will notify the original user that added the product.
	 * @param String model The model that was liked
	 * @param Int model_id The model id that was liked
	 * @return 
	 * 
	*/
	protected function send_email_on_comment($model='Product',$model_id=null,$data){
		Configure::write('debug', 0);
		$user = $this->Auth->user();
		//Find the product that the user wanted or has
		$item = $this->Product->find('first',array('conditions'=>array('Product.id'=>$model_id),'contain'=>array('User','Attachment','Storage')));
		if(!empty($item)){
			$model_lower = strtolower($model);
			if($item['User']['email_on_comment'] == 1){
				//You don't want to receive comments from yourself on products that you've added.
				if($user['User']['id'] != $item['Product']['user_id']){
					$site_name = $this->Toolbar->settings['site_name'];
				
					//When auth user follows a user, send an email to the user 
					$this->Email->to = $user['User']['email'];
					$this->Email->from = $site_name .' <'. $this->Toolbar->settings['site_email'] .'>';
				
					if(!empty($user['User']['fullname'])){
						$this->Email->subject = $site_name.' - '.__($user['User']['fullname'].' just commented on a product that you found.', true);
					}else{
						$this->Email->subject = $site_name.' - '.__($user['User']['username'].' just commented on a product that you found.', true);
					}
					$this->Email->template = 'email_on_comment'; // note no '.ctp'

					//Send as 'html', 'text' or 'both' (default is 'text')
					$this->Email->sendAs = 'html'; // because we like to send pretty mail
				
					$recent_products = $this->Product->getThreeFromUser($user['User']['id']);
					/* Check for SMTP errors. */
				    $smtp_errors = $this->Email->smtpError;
				
					//debug($smtp_errors);
					//Set view variables as normal
					$this->set(compact('user','site_name','recent_products','item','smtp_errors','data'));
				
					// uncomment this to debug EmailComponent instead of sending  
					//$this->Email->delivery = 'debug';
				
					//Do not pass any args to send()
					if($this->Email->send()){
						CakeLog::write('activity','Email on '.$model_lower.' - '.$user['User']['username']. ' commented on '. $item[$model]['name']);
					}
				}
			}
		}
	}
	
	/**
	 * Sends an email when someone adds an item that has already been added. This will notify the original user that added the product.
	 * @param String model The model that was liked
	 * @param Int model_id The model id that was liked
	 * @return 
	 * 
	*/
	protected function send_email_on_product_add_to_storage($model=null,$model_id=null){
		Configure::write('debug', 0);
		//Find the product that the user wanted or has
		$item = $this->Product->$model->find('first',array('conditions'=>array($model.'.id'=>$model_id),'contain'=>array('User','Attachment')));
		if(!empty($item)){
			$model_lower = strtolower($model);
			if($item['User']['email_on_storage_add'] == 1){
				$user = $this->Auth->user();
				
				$site_name = $this->Toolbar->settings['site_name'];
				
				//When auth user follows a user, send an email to the user 
				$this->Email->to = $user['User']['email'];
				$this->Email->from = $site_name .' <'. $this->Toolbar->settings['site_email'] .'>';
				
				if(!empty($user['User']['fullname'])){
					$this->Email->subject = $site_name.' - '.__($user['User']['fullname'].' just found a product that you added.', true);
				}else{
					$this->Email->subject = $site_name.' - '.__($user['User']['username'].' just found a product that you added.', true);
				}
				$this->Email->template = 'email_on_storage_add'; // note no '.ctp'

				//Send as 'html', 'text' or 'both' (default is 'text')
				$this->Email->sendAs = 'html'; // because we like to send pretty mail
				
				$recent_products = $this->Product->getThreeFromUser($user['User']['id']);
				/* Check for SMTP errors. */
			    $smtp_errors = $this->Email->smtpError;
				
				//debug($smtp_errors);
				//Set view variables as normal
				$this->set(compact('user','site_name','recent_products','item','smtp_errors'));
				
				// uncomment this to debug EmailComponent instead of sending  
				//$this->Email->delivery = 'debug';
				
				//Do not pass any args to send()
				if($this->Email->send()){
					CakeLog::write('activity','Email on '.$model_lower.' - '.$user['User']['username']. ' added '. $item[$model]['name']. ' to storage.');
				}
			}
		}
	}
	
	/******************************** NOTIFICATIONS *******************************************/
}