<?php
class UfosController extends AppController {

	var $name = 'Ufos';
	var $helpers = array('Tags.TagCloud');
	var $components = array('Uploader.Uploader','String');
	
	function beforeFilter(){
		parent::beforeFilter();
		
		$this->Auth->allow('getUfosFromUser');
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
	
	
	function index($filter = null) {
		$this->Ufo->recursive = 2;
		
		// query all distinct first letters used in names
		$letters = $this->Ufo->query('SELECT DISTINCT SUBSTRING(`name`, 1, 1) FROM `ufos` ORDER BY `name`');
		
		$links = array();
		// push all letters into a non-nested array
		foreach ($letters as $row) {
			array_push($links, current($row[0]));
		}
		
		//debug($ufos);
		if (isset($this->passedArgs['by'])) {
			$this->paginate = array(
								'Tagged'=>array(
									'model' => 'Ufo',
									'tagged',
									'by' => $this->passedArgs['by'],
									'recursive'=>2 //Removing this throws errors.
								)
							);
			$ufos = $this->paginate('Tagged');
			
			$counter = 0;
			foreach($ufos as $ufo){
				//Find attachments
				if(!empty($ufo['Ufo']['id'])){
					$temp_att = $this->Ufo->read(null,$ufo['Ufo']['id']);
					//debug($temp_att);
					$ufos[$counter]['Attachment'] = $temp_att['Attachment'];

					$counter++;
				}else{
					unset($ufos[$counter]);
				}
			}
		}else{
			$ufos = $this->paginate();
		}
		
		$this->set(compact('ufos','filter','links'));
		$this->set('string', $this->String);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid ufo', true));
			$this->redirect(array('action' => 'index','admin'=>false));
		}
		$this->set('ufo', $this->Ufo->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			
			//Upload the attachments
			$this->uploadAttachments('Ufo');
			//debug($this->data);
			$this->data['Ufo']['attachment_id'] = $this->data['Attachment']['Attachment'][0];
			unset($this->data['Attachment']);
			
			$this->Ufo->create();
			if ($this->Ufo->save($this->data)) {
				$this->Session->setFlash(__('The ufo has been saved', true));
				$id = $this->Ufo->getLastInsertID();
				$this->redirect(array('admin'=>false,'action' => 'view',$id));
			} else {
				$this->Session->setFlash(__('The ufo could not be saved. Please, try again.', true));
			}
		}
		$attachments = $this->Ufo->Attachment->find('list');
		$this->set(compact('attachments'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid ufo', true));
			$this->redirect(array('action' => 'index','admin'=>false));
		}
		if (!empty($this->data)) {
			
			//Upload the attachments
			$this->uploadAttachments('Ufo',$id);
			$this->data['Ufo']['attachment_id'] = $this->data['Attachment']['Attachment'][0];
			unset($this->data['Attachment']);
			
			if ($this->Ufo->save($this->data)) {
				$this->Session->setFlash(__('The ufo has been saved', true));
				$this->redirect(array('admin'=>false,'action' => 'view',$id));
			} else {
				$this->Session->setFlash(__('The ufo could not be saved. Please, try again.', true));
			}
		}
		
		if (empty($this->data)) {
			$this->data = $this->Ufo->read(null, $id);
		}
		$attachments = $this->Ufo->Attachment->find('list');
		$this->set(compact('attachments'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for ufo', true));
			$this->redirect(array('action'=>'index','admin'=>false));
		}
		if ($this->Ufo->delete($id)) {
			$this->Session->setFlash(__('Ufo deleted', true));
			$this->redirect(array('action'=>'index','admin'=>false));
		}
		$this->Session->setFlash(__('Ufo was not deleted', true));
		$this->redirect(array('action' => 'index','admin'=>false));
	}
	
	/**
	 * Retrieves the items from the user id passed
	 * @param id User id
	 * @param limit 
	 */
	function getUfosFromUser($id = null,$limit=25){
		$this->Ufo->recursive = 2;
		if(isset($this->params['requested'])) {
			$ufos = $this->Ufo->userUfos($id,$limit);
			return $ufos;
		}
	}
	
	/**
	 * Finds the tags associated with this model
	 */
	function tags(){
		$this->Ufo->recursive = 2;
		$this->paginate = array(
							'Tagged'=>array(
											'conditions'=>array('Tagged.model'=>'Ufo'),
											'limit' => 25,
											'order' => array('Tag.name ASC')
											));
		
		$tags = $this->paginate('Tagged');
		$this->set(compact('tags'));
	}
}
