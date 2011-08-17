<?php
class HousesController extends AppController {

	var $name = 'Houses';
	var $components = array('Search.Prg','Uploader.Uploader','String');
	var $helpers = array('Tags.TagCloud');
	
	function beforeFilter(){
		parent::beforeFilter();
		
		$this->Auth->deny('view','index','tags');
	}
	
	function index() {
		if(Configure::read('FGM.private_solution') == 1){
			$this->House->recursive = 2;

			$houses = $this->paginate();
			if(isset($this->params['requested'])) {
				return $houses;
			}

			if (isset($this->passedArgs['by'])) {
				$this->paginate['Tagged'] = array(
					'model' => 'House',
					'tagged',
					'by' => $this->passedArgs['by']
				);
				$houses = $this->paginate('Tagged');

				$counter = 0;
				foreach($houses as $house){
					//Find clients
					$temp_client = $this->House->Client->find('first',array('conditions'=>array('Client.id'=>$house['House']['client_id'])));
					$houses[$counter]['Client'] = $temp_client['Client']; 

					//Find countries
					$temp_country = $this->House->Country->find('first',array('conditions'=>array('Country.id'=>$house['House']['country_id'])));
					$houses[$counter]['Country'] = $temp_country['Country'];
					$counter++;
				}

				//debug($houses);
			} else {
				$this->House->recursive = 2;
				$houses = $this->paginate();
			}

			$this->set('houses', $houses);
			$this->set('string', $this->String);
		}else{
			$this->Session->setFlash(__('You have to upgrade to access this.', true));
			$this->redirect(array('controller'=>'pages','plugin'=>'','action'=>'display','admin'=>false,'upgrade'));
		}
	}

	function view($id = null) {
		if(Configure::read('FGM.private_solution') == 1){
			$this->House->recursive = 2;
			if (!$id) {
				$this->Session->setFlash(__('Invalid house', true));
				$this->redirect(array('action' => 'index','admin'=>false));
			}
			$this->set('house', $this->House->read(null, $id));
			$this->set('string', $this->String);
		}
	}

	function admin_add($client_id = null) {
		if(Configure::read('FGM.private_solution') == 1){
			if (!empty($this->data)) {
	
				//Clean the image url
				$this->data['Attachment']['url'] = $this->simplifyFileName($this->data['Attachment']['url']);
			
				//Upload the attachments
				$this->uploadAttachments('House');
			
				$this->House->create();
				if ($this->House->save($this->data)) {
					$this->Session->setFlash(__('The house has been saved', true));
					$this->redirect(array('action' => 'index','admin'=>false));
				} else {
					$this->Session->setFlash(__('The house could not be saved. Please, try again.', true));
				}
			}
		
			//Check to see if a client id was passed
			if (!$client_id) {
				$this->Session->setFlash(__('Invalid client', true));
				$this->redirect(array('action' => 'index','admin'=>false));
			}else{
				//Check to make sure the id is valid
				$client = $this->House->Client->findById($client_id);
				if(empty($client)){
					$this->Session->setFlash(__('Invalid client', true));
					$this->redirect(array('action' => 'index','admin'=>false));
				}
			}
		
			$clients = $this->House->Client->find('list');
			$countries = $this->House->Country->find('list');
			$attachments = $this->House->Attachment->find('list');
			$tags = $this->House->Tagged->find('cloud', array('limit' => 10));
		
			$this->set(compact('clients', 'countries', 'attachments', 'tags','client_id'));
		}
	}

	function admin_edit($id = null) {
		if(Configure::read('FGM.private_solution') == 1){
			if (!$id && empty($this->data)) {
				$this->Session->setFlash(__('Invalid house', true));
				$this->redirect(array('action' => 'index'));
			}
		
			if (!empty($this->data)) {
			
				//Upload the attachments
				$this->uploadAttachments('House',$id);
			
				if ($this->House->save($this->data)) {
					$this->Session->setFlash(__('The house has been updated', true));
					$this->redirect(array('action' => 'view',$id));
				} else {
					$this->Session->setFlash(__('The house could not be updated. Please, try again.', true));
				}
			}
			if (empty($this->data)) {
				$this->data = $this->House->read(null, $id);
			}
			$clients = $this->House->Client->find('list');
			$countries = $this->House->Country->find('list');
			$attachments = $this->House->Attachment->find('list');
			$tags = $this->House->Tagged->find('cloud', array('limit' => 10));
			$this->set('house', $this->House->read(null, $id));
			$this->set(compact('clients', 'countries', 'attachments', 'tags'));
		}
	}

	function admin_delete($id = null) {
		if(Configure::read('FGM.private_solution') == 1){
			if (!$id) {
				$this->Session->setFlash(__('Invalid id for house', true));
				$this->redirect(array('action'=>'index','admin'=>false));
			}
			if ($this->House->delete($id)) {
				$this->Session->setFlash(__('House deleted', true));
				$this->redirect(array('action'=>'index'));
			}
			$this->Session->setFlash(__('House was not deleted', true));
			$this->redirect(array('action' => 'index','admin'=>false));
		}
	}
	
	/**
	 * Finds the tags associated with this model
	 */
	function tags(){
		if(Configure::read('FGM.private_solution') == 1){
			$this->House->recursive = 2;
			$this->paginate = array(
								'Tagged'=>array(
												'conditions'=>array('Tagged.model'=>'House'),
												'limit' => 25,
												'order' => array('Tag.name ASC')
												));
		
			$tags = $this->paginate('Tagged');
			$this->set(compact('tags'));
		}
	}
}
