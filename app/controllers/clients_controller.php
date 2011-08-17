<?php
class ClientsController extends AppController {

	var $name = 'Clients';
	var $components = array('Search.Prg','Uploader.Uploader','String');
	var $helpers = array('Tags.TagCloud');
	
	function beforeFilter(){
		parent::beforeFilter();
		
		$this->Auth->deny('view','index','tags');
	}
	
	function index() {
		if(Configure::read('FGM.private_solution') == 1){
			$this->Client->recursive = 2;
		
			$clients = $this->paginate();
		
			if(isset($this->params['requested'])) {
				return $clients;
			}
		
			if (isset($this->passedArgs['by'])) {
				$this->paginate['Tagged'] = array(
					'model' => 'Client',
					'tagged',
					'by' => $this->passedArgs['by']
				);
				$clients = $this->paginate('Tagged');

				$counter = 0;
				foreach($clients as $client){
					//Find countries
					$temp_country = $this->Client->Country->find('first',array('conditions'=>array('Country.id'=>$client['Client']['country_id'])));
					$clients[$counter]['Country'] = $temp_country['Country'];
					$counter++;
				}
			}
		
			$this->set('clients', $clients);
			$this->set('string', $this->String);
		}else{
			$this->Session->setFlash(__('You have to upgrade to access this.', true));
			$this->redirect(array('controller'=>'pages','plugin'=>'','action'=>'display','admin'=>false,'upgrade'));
		}
	}

	function view($id = null) {
		if(Configure::read('FGM.private_solution') == 1){
			$this->Client->recursive = 2;
			if (!$id) {
				$this->Session->setFlash(__('Invalid client', true));
				$this->redirect(array('action' => 'index','admin'=>false));
			}
			$this->set('client', $this->Client->read(null, $id));
			$this->set('string', $this->String);
		}
	}

	function admin_add() {
		if(Configure::read('FGM.private_solution') == 1){
			if (!empty($this->data)) {
				//Make sure that the client doesn't already exist
				$passed_check = $this->verifyAddition('Client');
			
				if($passed_check){
					//Cleanup
					if(!empty($this->data['Client']['url'])){
						$this->data['Client']['url'] = $this->cleanURL($this->data['Client']['url']); //Clean the URL
					}
					$this->data['Client']['slug'] = $this->toSlug($this->data['Client']['name']);
			
					//Upload the attachments
					$this->uploadAttachments('Client');
			
					$this->Client->create();
					if ($this->Client->save($this->data)) {
						$this->clearVerifySessions();
						$this->Session->setFlash(__('The client has been saved.', true));
						$this->redirect(array('action' => 'index','admin'=>false));
					} else {
						$this->clearVerifySessions();
						$this->Session->setFlash(__('The client could not be saved. Please, try again.', true));
					}
				}else{
					$this->Session->setFlash(__('The client '.$this->data['Client']['name']. ' already exists. Are you sure you want to add this client?', true));
				}
			}
			$countries = $this->Client->Country->find('list');
			$attachments = $this->Client->Attachment->find('list');
			$tags = $this->Client->Tagged->find('cloud', array('limit' => 10));
			$this->set(compact('countries', 'attachments', 'tags'));
		}
	}

	function admin_edit($id = null) {
		if(Configure::read('FGM.private_solution') == 1){
			if (!$id && empty($this->data)) {
				$this->Session->setFlash(__('Invalid client', true));
				$this->redirect(array('action' => 'index','admin'=>false));
			}
			if (!empty($this->data)) {
			
				//Cleanup
				if(!empty($this->data['Client']['url'])){
					$this->data['Client']['url'] = $this->cleanURL($this->data['Client']['url']); //Clean the URL
				}
				$this->data['Client']['slug'] = $this->toSlug($this->data['Client']['name']);
			
				//Upload the attachments
				$this->uploadAttachments('Client',$id);
			
				if ($this->Client->save($this->data)) {
					$this->Session->setFlash(__('The client has been updated', true));
					$this->redirect(array('action' => 'view','admin'=>false,$id));
				} else {
					$this->Session->setFlash(__('The client could not be updated. Please, try again.', true));
				}
			}
			if (empty($this->data)) {
				$this->data = $this->Client->read(null, $id);
			}
			$countries = $this->Client->Country->find('list');
			$attachments = $this->Client->Attachment->find('list');
			$tags = $this->Client->Tagged->find('cloud', array('limit' => 10));
			$this->set('client', $this->Client->read(null, $id));
			$this->set(compact('countries', 'attachments', 'tags'));
		}
	}

	function admin_delete($id = null) {
		if(Configure::read('FGM.private_solution') == 1){
			if (!$id) {
				$this->Session->setFlash(__('Invalid id for client', true));
				$this->redirect(array('action'=>'index','admin'=>false));
			}
			if ($this->Client->delete($id)) {
				$this->Session->setFlash(__('Client deleted', true));
				$this->redirect(array('action'=>'index','admin'=>false));
			}
			$this->Session->setFlash(__('Client was not deleted', true));
			$this->redirect(array('action' => 'index','admin'=>false));
		}
	}
	
	/**
	 * Finds the tags associated with this model
	 */
	function tags(){
		if(Configure::read('FGM.private_solution') == 1){
			$this->Client->recursive = 2;
			$this->paginate = array(
								'Tagged'=>array(
												'conditions'=>array('Tagged.model'=>'Client'),
												'limit' => 25,
												'order' => array('Tag.name ASC')
												));
		
			$tags = $this->paginate('Tagged');
			$this->set(compact('tags'));
		}
	}
}
