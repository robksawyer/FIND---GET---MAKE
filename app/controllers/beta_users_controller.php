<?php
class BetaUsersController extends AppController {

	var $name = 'BetaUsers';
	
	function beforeFilter(){
		parent::beforeFilter();
		
		$this->Auth->allow('add');
	}
	
	function admin_index() {
		$this->BetaUser->recursive = 0;
		$this->set('betaUsers', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid beta user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('betaUser', $this->BetaUser->read(null, $id));
	}

	function add() {
		$this->layout = 'signup';
		$this->set("title_for_layout","Launching Soon");
		if (!empty($this->data)) {
			$this->BetaUser->create();
			if ($this->BetaUser->save($this->data)) {
				$this->Session->setFlash(__('Thanks for your interest! We\'ll notify you when the site is live.', true));
				$this->redirect(array('action' => 'add'));
			} else {
				$this->Session->setFlash(__('Your information could not be saved. Please, try again later.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid beta user', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->BetaUser->save($this->data)) {
				$this->Session->setFlash(__('The beta user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The beta user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->BetaUser->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for beta user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->BetaUser->delete($id)) {
			$this->Session->setFlash(__('Beta user deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Beta user was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
