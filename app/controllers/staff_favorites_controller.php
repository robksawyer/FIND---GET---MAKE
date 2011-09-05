<?php
class StaffFavoritesController extends AppController {

	var $name = 'StaffFavorites';

	public function beforeFilter(){
		parent::beforeFilter();
		
		//Make certain pages public
		$this->Auth->allowedActions = array('index','view');
	}
	
	function index() {
		$this->StaffFavorite->recursive = 0;
		$this->set('staffFavorites', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid staff favorite', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('staffFavorite', $this->StaffFavorite->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->StaffFavorite->create();
			if ($this->StaffFavorite->save($this->data)) {
				$this->Session->setFlash(__('The staff favorite has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The staff favorite could not be saved. Please, try again.', true));
			}
		}
		$users = $this->StaffFavorite->User->find('list');
		$this->set(compact('users'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid staff favorite', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->StaffFavorite->save($this->data)) {
				$this->Session->setFlash(__('The staff favorite has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The staff favorite could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->StaffFavorite->read(null, $id);
		}
		$users = $this->StaffFavorite->User->find('list');
		$this->set(compact('users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for staff favorite', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->StaffFavorite->delete($id)) {
			$this->Session->setFlash(__('Staff favorite deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Staff favorite was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}