<?php
class InspirationPhotoTagsController extends AppController {

	var $name = 'InspirationPhotoTags';
	var $components = array('String','RequestHandler');
	
	function beforeFilter(){
		parent::beforeFilter();
		
		//$this->Auth->allow('add','edit','delete');
		$this->AjaxHandler->handle('admin_add','admin_delete');
	}
	
	function index() {
		$this->InspirationPhotoTag->recursive = 0;
		$this->set('inspirationPhotoTags', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid inspiration photo tag', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('inspirationPhotoTag', $this->InspirationPhotoTag->read(null, $id));
	}
	
	function admin_index() {
		$this->InspirationPhotoTag->recursive = 0;
		$this->set('inspirationPhotoTags', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid inspiration photo tag', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('inspirationPhotoTag', $this->InspirationPhotoTag->read(null, $id));
	}

	function add($id=null) {
		Configure::write('debug', 0); //it will avoid any extra output
		
		if (!empty($this->data)) {
			/*
				TODO Figure out how to sort out the product and the source.
				* Add the the model to the new inspiration_photo_tags.model field.
				* Add the item (product, source) id to the inspiration_photo_tags.model_id field.
			*/
			
			//Parse the value field and create the model name and id for the database save.
			$model_id_array = preg_split('/_/',$this->data['InspirationPhotoTag']['name']);

			//Find the item name by the id
			$model = ucFirst($model_id_array[0]);
			$model_id = intval($model_id_array[1]);
			$item_name = $model_id_array[2];
			
			ClassRegistry::init($model);
			
			//$item_name = 
			$this->data['InspirationPhotoTag']['name'] = $item_name;
			$this->data['InspirationPhotoTag']['model'] = $model;
			$this->data['InspirationPhotoTag']['model_id'] = $model_id;
			
			if ($this->RequestHandler->isAjax()) {
				$this->autoLayout = false;
				$this->autoRender = false;
				$response = array('success' => false);
			
				$this->InspirationPhotoTag->create();
				if ($this->InspirationPhotoTag->save($this->data)) {
					$photoTagId = $this->InspirationPhotoTag->getLastInsertID();
					//Get the photo tag details that was added.
					$photoTag = $this->InspirationPhotoTag->read(null,$photoTagId);
					$inspiration = $this->InspirationPhotoTag->Inspiration->findById($id);
					
					$this->AjaxHandler->response(true, $photoTag['InspirationPhotoTag']);
				}else{
					$this->AjaxHandler->response(false, 'There was a problem creating the tag. Please, try again.', 0);
				}
				
				$this->AjaxHandler->respond();
				return;
			}else{
				$this->InspirationPhotoTag->create();
				if ($this->InspirationPhotoTag->save($this->data)) {
					$this->Session->setFlash(__('The inspiration photo tag has been saved', true));
					$this->redirect(array('controller'=>'inspirations','action' => 'view',$this->data['InspirationPhotoTag']['inspiration_id'],'admin'=>false));
				} else {
					$this->Session->setFlash(__('The inspiration photo tag could not be saved. Please, try again.', true),'default',array('class'=>'error-message'));
				}
				
				$inspirations = $this->InspirationPhotoTag->Inspiration->find('list');
				$this->set(compact('inspirations'));
			}
		}
		
	}

	function delete($id = null,$inspiration_id = null) {
		Configure::write('debug', 0); //it will avoid any extra output
		
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for inspiration photo tag', true));
			$this->redirect(array('controller'=>'inspirations','action'=>'view',$inspiration_id,'admin'=>false));
		}
		
		if ($this->RequestHandler->isAjax()) {
			$this->autoLayout = false;
			$this->autoRender = false;
			$response = array('success' => false);
			
			if ($this->InspirationPhotoTag->delete($id)) {
				$this->AjaxHandler->response(true, $id);
			}else{
				$this->AjaxHandler->response(false, 'There was a problem deleting the tag. Please, try again.', 0);
			}
			
			$this->AjaxHandler->respond();
			return;
		}else{
			if ($this->InspirationPhotoTag->delete($id)) {
				$this->Session->setFlash(__('Inspiration photo tag deleted', true));
				$this->redirect(array('controller'=>'inspirations','action'=>'view',$inspiration_id,'admin'=>false));
			}
			$this->Session->setFlash(__('Inspiration photo tag was not deleted', true));
			$this->redirect(array('controller'=>'inspirations','action'=>'view',$inspiration_id,'admin'=>false));
		}
		
	}
}
