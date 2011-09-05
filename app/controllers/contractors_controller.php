<?php
class ContractorsController extends AppController {

	var $name = 'Contractors';
	var $components = array('Search.Prg','Uploader.Uploader','String');
	var $helpers = array('Tags.TagCloud');
	
	function beforeFilter(){
		parent::beforeFilter();
		
		$this->Auth->deny('view','index','tags');
	}
	
	function index() {
		if(Configure::read('FGM.private_solution') == 1){
			$this->Contractor->recursive = 2;
		
			$contractors = $this->paginate();
			if(isset($this->params['requested'])) {
				return $contractors;
			}
		
			if (isset($this->passedArgs['by'])) {
				$this->paginate['Tagged'] = array(
					'model' => 'Contractor',
					'tagged',
					'by' => $this->passedArgs['by']
				);
				$contractors = $this->paginate('Tagged');
			
				$counter = 0;
				foreach($contractors as $contractor){
					//Find countries
					$temp_country = $this->Contractor->Country->find('first',array('conditions'=>array('Country.id'=>$contractor['Contractor']['country_id'])));
					$contractors[$counter]['Country'] = $temp_country['Country'];
					$counter++;
				}
			
			} else {
				$this->Contractor->recursive = 2;
				$contractors = $this->paginate();
			}
			$this->set('contractors', $contractors);
			
		}
	}

	function view($id = null) {
		if(Configure::read('FGM.private_solution') == 1){
			if (!$id) {
				$this->Session->setFlash(__('Invalid contractor', true));
				$this->redirect(array('action' => 'index','admin'=>false));
			}
			$countries = $this->Contractor->Country->find('list');
			$contractorSpecialties = $this->Contractor->ContractorSpecialty->find('list');
			$tags = $this->Contractor->Tag->find('list');
			$tags_cloud = $this->Contractor->Tagged->find('cloud', array('limit' => 10));
			$this->set('contractor', $this->Contractor->read(null, $id));
			$this->set(compact('countries', 'tags', 'sources','tags_cloud','contractorSpecialties'));
			
		}else{
			$this->Session->setFlash(__('You have to upgrade to access this.', true));
			$this->redirect(array('controller'=>'pages','plugin'=>'','action'=>'display','admin'=>false,'upgrade'));
		}
	}
	
	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
	function add() {
		if(Configure::read('FGM.private_solution') == 1){
			//Check to make sure a model and id was passed
			if(isset($this->passedArgs['model'])){
				$model = ucwords($this->passedArgs['model']);
				if(isset($this->passedArgs['id'])){
					$id = intval($this->passedArgs['id']);
				
					//Pluralize the model name
					$plural_model = strtolower($model);
					$plural_model = Inflector::pluralize($plural_model);

					//Find the actual record and make sure it's legit.
					$item = $this->Contractor->$model->findById($id);
					if(!empty($item)){
						//Pass along the details
						$this->set(compact('item','plural_model'));
					}else{
						$this->Session->setFlash(__('This record does not exist.', true));
						//TODO:Redirect the user or set a variable that hides the upload field.
						$errors['message'] = 'The item was not found in the database';
					}
				}
			}
		
			if (!empty($this->data)) {
			
				//Make sure that the client doesn't already exist
				$passed_check = $this->verifyAddition('Contractor');
			
				if($passed_check){
				
					//Upload the attachments
					$this->uploadAttachments('Contractor');
				
					$this->Contractor->create();
					if ($this->Contractor->save($this->data)) {
						$this->clearVerifySessions();
						$this->Session->setFlash(__('The contractor has been saved', true));
						$this->redirect(array('action' => 'index','admin'=>false));
					} else {
						$this->clearVerifySessions();
						$this->Session->setFlash(__('The contractor could not be saved. Please, try again.', true));
					}
				}else{
					$this->Session->setFlash(__('The contractor '.$this->data['Contractor']['name']. ' already exists. Are you sure you want to add this?', true));
				}
			}
			$countries = $this->Contractor->Country->find('list');
			//$tags = $this->Contractor->Tag->find('list');
			$tags = $this->Contractor->Tagged->find('cloud', array('limit' => 10));
			$contractorSpecialties = $this->Contractor->ContractorSpecialty->find('list');
			$sources = $this->Contractor->Source->find('list');
			$this->set(compact('countries', 'tags', 'sources','contractorSpecialties'));
		}
	}
	
	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
	function admin_add() {
		if(Configure::read('FGM.private_solution') == 1){
			//Check to make sure a model and id was passed
			if(isset($this->passedArgs['model'])){
				$model = ucwords($this->passedArgs['model']);
				if(isset($this->passedArgs['id'])){
					$id = intval($this->passedArgs['id']);
				
					//Pluralize the model name
					$plural_model = strtolower($model);
					$plural_model = Inflector::pluralize($plural_model);

					//Find the actual record and make sure it's legit.
					$item = $this->Contractor->$model->findById($id);
					if(!empty($item)){
						//Pass along the details
						$this->set(compact('item','plural_model'));
					}else{
						$this->Session->setFlash(__('This record does not exist.', true));
						//TODO:Redirect the user or set a variable that hides the upload field.
						$errors['message'] = 'The item was not found in the database';
					}
				}
			}
		
			if (!empty($this->data)) {
			
				//Make sure that the client doesn't already exist
				$passed_check = $this->verifyAddition('Contractor');
			
				if($passed_check){
				
					//Upload the attachments
					$this->uploadAttachments('Contractor');
				
					$this->Contractor->create();
					if ($this->Contractor->save($this->data)) {
						$this->clearVerifySessions();
						$this->Session->setFlash(__('The contractor has been saved', true));
						$this->redirect(array('action' => 'index','admin'=>false));
					} else {
						$this->clearVerifySessions();
						$this->Session->setFlash(__('The contractor could not be saved. Please, try again.', true));
					}
				}else{
					$this->Session->setFlash(__('The contractor '.$this->data['Contractor']['name']. ' already exists. Are you sure you want to add this?', true));
				}
			}
			$countries = $this->Contractor->Country->find('list');
			//$tags = $this->Contractor->Tag->find('list');
			$tags = $this->Contractor->Tagged->find('cloud', array('limit' => 10));
			$contractorSpecialties = $this->Contractor->ContractorSpecialty->find('list');
			$sources = $this->Contractor->Source->find('list');
			$this->set(compact('countries', 'tags', 'sources','contractorSpecialties'));
		}
	}
	
	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
	function edit($id = null) {
		if(Configure::read('FGM.private_solution') == 1){
			if (!$id && empty($this->data)) {
				$this->Session->setFlash(__('Invalid contractor', true));
				$this->redirect(array('action' => 'index','admin'=>false));
			}
			if (!empty($this->data)) {
				//Cleanup
				if(!empty($this->data['Contractor']['url'])){
					$this->data['Contractor']['url'] = $this->cleanURL($this->data['Contractor']['url']); //Clean the URL
				}
				$this->data['Contractor']['slug'] = $this->toSlug($this->data['Contractor']['name']);
			
				//Upload the attachments
				$this->uploadAttachments('Contractor',$id);
			
				if ($this->Contractor->saveAll($this->data)) {
					$this->Session->setFlash(__('The contractor has been updated', true));
					$this->redirect(array('action' => 'view','admin'=>false,$id));
				} else {
					$this->Session->setFlash(__('The contractor could not be updated. Please, try again.', true));
				}
			}
			if (empty($this->data)) {
				$this->data = $this->Contractor->read(null, $id);
			}
			$countries = $this->Contractor->Country->find('list');
			$tags = $this->Contractor->Tag->find('list');
			$contractorSpecialties = $this->Contractor->ContractorSpecialty->find('list');
			$tags_cloud = $this->Contractor->Tagged->find('cloud', array('limit' => 10));
			$sources = $this->Contractor->Source->find('list');
			$this->set('contractor', $this->Contractor->read(null, $id));
			$this->set(compact('countries', 'tags', 'sources','tags_cloud','contractorSpecialties'));
		}
	}
	
	
	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
	function admin_edit($id = null) {
		if(Configure::read('FGM.private_solution') == 1){
			if (!$id && empty($this->data)) {
				$this->Session->setFlash(__('Invalid contractor', true));
				$this->redirect(array('action' => 'index','admin'=>false));
			}
			if (!empty($this->data)) {
				//Cleanup
				if(!empty($this->data['Contractor']['url'])){
					$this->data['Contractor']['url'] = $this->cleanURL($this->data['Contractor']['url']); //Clean the URL
				}
				$this->data['Contractor']['slug'] = $this->toSlug($this->data['Contractor']['name']);
			
				//Upload the attachments
				$this->uploadAttachments('Contractor',$id);
			
				if ($this->Contractor->saveAll($this->data)) {
					$this->Session->setFlash(__('The contractor has been updated', true));
					$this->redirect(array('action' => 'view','admin'=>false,$id));
				} else {
					$this->Session->setFlash(__('The contractor could not be updated. Please, try again.', true));
				}
			}
			if (empty($this->data)) {
				$this->data = $this->Contractor->read(null, $id);
			}
			$countries = $this->Contractor->Country->find('list');
			$tags = $this->Contractor->Tag->find('list');
			$contractorSpecialties = $this->Contractor->ContractorSpecialty->find('list');
			$tags_cloud = $this->Contractor->Tagged->find('cloud', array('limit' => 10));
			$sources = $this->Contractor->Source->find('list');
			$this->set('contractor', $this->Contractor->read(null, $id));
			$this->set(compact('countries', 'tags', 'sources','tags_cloud','contractorSpecialties'));
		}
	}

	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
	function delete($id = null) {
		if(Configure::read('FGM.private_solution') == 1){
			if (!$id) {
				$this->Session->setFlash(__('Invalid id for contractor', true));
				$this->redirect(array('action'=>'index','admin'=>false));
			}
			if ($this->Contractor->delete($id)) {
				$this->Session->setFlash(__('Contractor deleted', true));
				$this->redirect(array('action'=>'index'));
			}
			$this->Session->setFlash(__('Contractor was not deleted', true));
			$this->redirect(array('action' => 'index','admin'=>false));
		}
	}
	
	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
	function admin_delete($id = null) {
		if(Configure::read('FGM.private_solution') == 1){
			if (!$id) {
				$this->Session->setFlash(__('Invalid id for contractor', true));
				$this->redirect(array('action'=>'index','admin'=>false));
			}
			if ($this->Contractor->delete($id)) {
				$this->Session->setFlash(__('Contractor deleted', true));
				$this->redirect(array('action'=>'index'));
			}
			$this->Session->setFlash(__('Contractor was not deleted', true));
			$this->redirect(array('action' => 'index','admin'=>false));
		}
	}
	
	/**
	 * Finds the tags associated with this model
	 */
	function tags(){
		if(Configure::read('FGM.private_solution') == 1){
			$this->Contractor->recursive = 2;
			$this->paginate = array(
								'Tagged'=>array(
												'conditions'=>array('Tagged.model'=>'Contractor'),
												'fields' => array('DISTINCT Tag.name'),
												'limit' => 25,
												'order' => array('Tag.name ASC')
												));
		
			$tags = $this->paginate('Tagged');
			$this->set(compact('tags'));
		}
	}
	
}