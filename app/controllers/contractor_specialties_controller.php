<?php
class ContractorSpecialtiesController extends AppController {

	var $name = 'ContractorSpecialties';

	function index() {
		$this->ContractorSpecialty->recursive = 0;
		$this->set('contractorSpecialties', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid contractor specialty', true));
			$this->redirect(array('action' => 'index','admin'=>false));
		}
		$this->set('contractorSpecialty', $this->ContractorSpecialty->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			
			//Make sure that the specialty doesn't exist already
			$nameCheck = $this->ContractorSpecialty->findByName(ucwords($this->data['ContractorSpecialty']['name']));
			if(empty($nameCheck)){
				$this->ContractorSpecialty->create();
				$this->data['ContractorSpecialty']['name'] = ucwords($this->data['ContractorSpecialty']['name']);
				$this->data['ContractorSpecialty']['slug'] = $this->toSlug($this->data['ContractorSpecialty']['name']);
				if ($this->ContractorSpecialty->save($this->data)) {
					$this->Session->setFlash(__('The contractor specialty has been saved', true));
					$lastId = $this->ContractorSpecialty->getLastInsertId();
					$this->redirect(array('action' => 'add','admin'=>true));
				} else {
					$this->Session->setFlash(__('The contractor specialty could not be saved. Please, try again.', true));
				}
			}else{
				$this->Session->setFlash(__($this->data['ContractorSpecialty']['name'].' is already in the database.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid contractor specialty', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			//Make sure that the specialty doesn't exist already
			$nameCheck = $this->ContractorSpecialty->findByName(ucwords($this->data['ContractorSpecialty']['name']));
			if(empty($nameCheck)){
				$this->data['ContractorSpecialty']['name'] = ucwords($this->data['ContractorSpecialty']['name']);
				$this->data['ContractorSpecialty']['slug'] = $this->toSlug($this->data['ContractorSpecialty']['name']);
				if ($this->ContractorSpecialty->save($this->data)) {
					$this->Session->setFlash(__('The contractor specialty '.$this->data['ContractorSpecialty']['name'].' has been saved', true));
					$lastId = $this->ContractorSpecialty->getLastInsertId();
					$this->redirect(array('action' => 'view','admin'=>false,$lastId));
				} else {
					$this->Session->setFlash(__('The contractor specialty could not be saved. Please, try again.', true));
				}
			}else{
				$this->Session->setFlash(__($this->data['ContractorSpecialty']['name'].' is already in the database.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ContractorSpecialty->read(null, $id);
		}
		$this->set('contractorSpecialty', $this->ContractorSpecialty->read(null, $id));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for contractor specialty', true));
			$this->redirect(array('action'=>'index','admin'=>false));
		}
		if ($this->ContractorSpecialty->delete($id)) {
			$this->Session->setFlash(__('Contractor specialty deleted', true));
			$this->redirect(array('action'=>'index','admin'=>false));
		}
		$this->Session->setFlash(__('Contractor specialty was not deleted', true));
		$this->redirect(array('action' => 'index','admin'=>false));
	}
	
}