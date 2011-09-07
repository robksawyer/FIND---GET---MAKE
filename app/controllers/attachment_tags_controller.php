<?php
class AttachmentTagsController extends AppController {

	var $name = 'AttachmentTags';
	//var $components = array();
	
	function beforeFilter(){
		parent::beforeFilter();
		
		//$this->Auth->allow('add','edit','delete');
		
	}
	
	function index() {
		$this->AttachmentTag->recursive = 0;
		$this->set('attachmentTags', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid attachment tag', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('attachmentTag', $this->AttachmentTag->read(null, $id));
	}

	function add() {
		//debug($this->data);
		if (!empty($this->data)) {
			$this->AttachmentTag->create();
			if ($this->AttachmentTag->save($this->data)) {
				$this->Session->setFlash(__('The attachment tag has been saved', true));
				$this->redirect(array('controller'=>'attachments','action' => 'photo_tag_view',$this->data['AttachmentTag']['attachment_id']));
			} else {
				$this->Session->setFlash(__('The attachment tag could not be saved. Please, try again.', true));
			}
		}
		$attachments = $this->AttachmentTag->Attachment->find('list');
		$this->set(compact('attachments'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid attachment tag', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->AttachmentTag->save($this->data)) {
				$this->Session->setFlash(__('The attachment tag has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attachment tag could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->AttachmentTag->read(null, $id);
		}
		$attachments = $this->AttachmentTag->Attachment->find('list');
		$this->set(compact('attachments'));
	}

	function delete($id = null,$attachment_id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for attachment tag', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->AttachmentTag->delete($id)) {
			$this->Session->setFlash(__('Attachment tag deleted', true));
			$this->redirect(array('controller'=>'attachments','action'=>'photo_tag_view',$attachment_id));
		}
		$this->Session->setFlash(__('Attachment tag was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->AttachmentTag->recursive = 0;
		$this->set('attachmentTags', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid attachment tag', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('attachmentTag', $this->AttachmentTag->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->AttachmentTag->create();
			if ($this->AttachmentTag->save($this->data)) {
				$this->Session->setFlash(__('The attachment tag has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attachment tag could not be saved. Please, try again.', true));
			}
		}
		$attachments = $this->AttachmentTag->Attachment->find('list');
		$this->set(compact('attachments'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid attachment tag', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->AttachmentTag->save($this->data)) {
				$this->Session->setFlash(__('The attachment tag has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attachment tag could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->AttachmentTag->read(null, $id);
		}
		$attachments = $this->AttachmentTag->Attachment->find('list');
		$this->set(compact('attachments'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for attachment tag', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->AttachmentTag->delete($id)) {
			$this->Session->setFlash(__('Attachment tag deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Attachment tag was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
}