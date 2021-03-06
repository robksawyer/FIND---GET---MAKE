<?php
class AttachmentsController extends AppController {

	var $name = 'Attachments';
	var $components = array('Uploader.Uploader','String');
	//var $helpers = array('');

	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
	function beforeFilter(){
		parent::beforeFilter();
		
		$this->Uploader->enableUpload = true;
		$this->Uploader->maxFileSize = '75M'; // 75 Megabytes
		//debug($plural_model);
		$this->Uploader->uploadDir = "media/transfer/img/temp/";
		//$this->Uploader->tempDir = "media/transfer/img/temp_transfer/";
		
		//$this->Uploader->mime('image', 'gif', 'image/gif');
		//$this->Uploader->maxNameLength = 50;
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
	
	
	function index() {
		$this->Attachment->recursive = 2;
		$attachments = $this->paginate();
		if(isset($this->params['requested'])) {
			return $attachments;
		}else{
			$this->set('attachments', $this->paginate());
		}
		$this->set('string', $this->String);
	}

	/**
	 * Main view method
	 * @param 
	 * @return 
	 * 
	*/
	function view($id = null) {
		$this->Attachment->recursive = 2;
		if (!$id) {
			$this->Session->setFlash(__('Invalid attachment', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('attachment', $this->Attachment->read(null, $id));
		$this->set('string', $this->String);
	}
	
	/**
	 * This method handles parsing the keycode and showing the proper product
	 * @param string keycode The key to an product
	 * @return 
	 * 
	*/
	function key($keycode=null){
		$this->Attachment->recursive = 2;
		$this->layout = 'client_review';
		if (!$keycode && empty($this->data)) {
			$this->Session->setFlash(__('Invalid keycode', true));
			$this->redirect('/');
		}
		$attachment = $this->Attachment->find('first',array('conditions'=>array('Attachment.keycode'=>$keycode)));
		if(empty($attachment)){
			$this->Session->setFlash(__('Invalid keycode', true));
			$this->redirect('/');
		}
		$this->set(compact('attachment'));
		$this->set('string', $this->String);
	}
	
	function photo_tag_view($id = null) {
		$this->Attachment->recursive = 2;
		if (!$id) {
			$this->Session->setFlash(__('Invalid attachment', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('attachment', $this->Attachment->read(null, $id));
		$this->set('string', $this->String);
	}

	/*function admin_add() {
		if(isset($this->passedArgs['model'])){
			$model = ucwords($this->passedArgs['model']);
			if(isset($this->passedArgs['id'])){
				$id = intval($this->passedArgs['id']);
				
				//Pluralize the model name
				$plural_model = strtolower($model);
				$plural_model = Inflector::pluralize($plural_model);

				//Find the actual record and make sure it's legit.
				$item = $this->Attachment->$model->findById($id);
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
		
		if(!empty($this->data)) {
			//Check to make sure the item exists
			if(!empty($item)){
				
				//Clean the image url
				$this->data['Attachment']['url'] = $this->simplifyFileName($this->data['Attachment']['url']);
				
				//debug($this->data['Attachment']['url']);
				
				//Check to see if the url contains http://. If it does, copy the file to the server,
				//and then upload it via the normal method.
				if(!empty($this->data['Attachment']['url'])){
					//Save the file from the url
					$filename = basename($this->data['Attachment']['url']);
					$new_file_location = TMP.$filename;
					$url = trim($this->data['Attachment']['url']);
					if($url){
						unset($this->data['Attachment']['url']);
						$this->saveURLAttachments($item,$model,$plural_model,$url, $filename);
					}
					//debug($this->data);
				}else if(!empty($this->data['Attachment']['file']['name'])){
					//Save the local file
					unset($this->data['Attachment']['url']);
					//This is the save routine for specific models
					$this->saveAttachments($item, $model, $plural_model);
			
				}else{
					$this->Session->setFlash(__('You didn\'t add any attachments or the filetype is not valid. Try saving the file to your computer and trying again.', true));
					unset($this->data['Attachment']);
				}
			}
			
			//Check for a redirect variable
			if(!empty($this->data['Attachment']['redirect'])){
				$redirect = $this->data['Attachment']['redirect'];
				unset($this->data['Attachment']['redirect']);
			}
			
			if(!empty($model)){
				$this->Attachment->$model->id = $this->data[$model][0];
				//$this->Attachment->create();
				if($this->Attachment->$model->save($this->data)){
					//Generate and save the keycode
					$keycode = $this->generateKeycode($this->Attachment->$model->getLastInsertID(),true);
					$this->Attachment->$model->saveField('keycode',$keycode);
					
					$this->Session->setFlash(__('The attachment has been saved', true));
					$this->redirect(array('action' => 'add','model'=>$model,'admin'=>false,'id'=>$item[$model]['id']));
				}else{
					$this->Session->setFlash(__('The attachment could not be saved. Please, try again.', true));
				}
			}else{
				$this->Attachment->create();
				if($this->Attachment->save($this->data)){
					//Generate and save the keycode
					$keycode = $this->generateKeycode($this->Attachment->getLastInsertID(),true);
					$this->Attachment->saveField('keycode',$keycode);
					
					$this->Session->setFlash(__('The attachment has been saved', true));
					$this->redirect(array('action' => 'add','model'=>$model,'admin'=>false,'id'=>$item[$model]['id']));
				}else{
					$this->Session->setFlash(__('The attachment could not be saved. Please, try again.', true));
				}
			}
			
		}
		
		$contractors = $this->Attachment->Contractor->find('list');
		$inspirations = $this->Attachment->Inspiration->find('list');
		$clients = $this->Attachment->Client->find('list');
		$houses = $this->Attachment->House->find('list');
		$sources = $this->Attachment->Source->find('list');
		$products = $this->Attachment->Product->find('list');
		$this->set(compact('contractors', 'houses', 'sources','model','errors','products','inspirations','clients'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid attachment', true));
			$this->redirect(array('action' => 'index','admin'=>false));
		}
		if (!empty($this->data)) {
			if ($this->Attachment->save($this->data)) {
				$this->Session->setFlash(__('The attachment has been updated', true));
				$this->redirect(array('action' => 'view','admin'=>false,$id));
			} else {
				$this->Session->setFlash(__('The attachment could not be updated. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Attachment->read(null, $id);
		}
		$contractors = $this->Attachment->Contractor->find('list');
		$inspirations = $this->Attachment->Inspiration->find('list');
		$clients = $this->Attachment->Client->find('list');
		$houses = $this->Attachment->House->find('list');
		$sources = $this->Attachment->Source->find('list');
		$products = $this->Attachment->Product->find('list');
		$this->set(compact('contractors', 'houses', 'sources','products','inspirations','clients'));
		$this->set('attachment', $this->Attachment->read(null, $id));
	}*/

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for attachment', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Attachment->delete($id)) {
			$this->Session->setFlash(__('Attachment deleted', true));
			$this->redirect(array('action'=>'index','admin'=>false));
		}
		$this->Session->setFlash(__('Attachment was not deleted', true));
		$this->redirect(array('action' => 'index','admin'=>false));
	}
	
	function collage(){
		$random_paths = $this->random();
		$this->set(compact('random_paths'));
	}
	
	function random() {
		$random = $this->Attachment->find('all',array(
				'conditions' => array(),
				'fields' => array('Attachment.id','Attachment.path_med','Attachment.path_small','Attachment.title'),
				'limit'=>100,
				'order' => 'rand()',
		));
		return $random;
	}
	
	/**
	 * This method handles generating a random keycode for a attachment
	 * @param int id The attachment id
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
		
		$this->Attachment->id = $id;
		$this->Attachment->saveField('keycode',$keycode);
		//debug($keycode);
		if(!empty($bypassRedirect)){
			$this->Session->setFlash(__('The keycode has been generated.', true));
			$this->redirect(array('action'=>'key','admin'=>false,$keycode));
		}
	}
}
