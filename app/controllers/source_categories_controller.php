<?php
class SourceCategoriesController extends AppController {

	var $name = 'SourceCategories';
	//var $components = array();
	
	public function beforeFilter(){
		parent::beforeFilter();
		
		$this->Auth->allowedActions = array('view');
	}

	function index() {
		$this->SourceCategory->recursive = 1;
		$this->paginate = array(
								'limit' => 50,
								'order' => array(
									'SourceCategory.name' => 'asc'
									)
								);
		
		$this->set('sourceCategories', $this->paginate());
	}

	function view($id = null,$filter=null) {
		$this->SourceCategory->recursive = 1;
		if (!$id) {
			$this->Session->setFlash(__('Invalid source category', true));
			$this->redirect(array('action' => 'index','admin'=>false));
		}
		//Find the id
		if(!is_numeric($id)){
			$this->SourceCategory->recursive = -1;
			$category = $this->SourceCategory->findBySlug($id);
			if(!empty($category)){
				$id = $category['SourceCategory']['id'];
			}else{
				$this->Session->setFlash(__('Invalid source category', true));
				$this->redirect(array('action' => 'index','admin'=>false));
			}
		}
		// query all distinct first letters used in names
		$letters = $this->SourceCategory->Source->query('SELECT DISTINCT SUBSTRING(`name`, 1, 1) FROM `sources` WHERE `source_category_id` = '.$id.' ORDER BY `name`');

		$links = array();
		// push all letters into a non-nested array
		foreach ($letters as $row) {
			array_push($links, current($row[0]));
		}

		$this->paginate['Source'] = array(
										'conditions'=>array(
											'Source.source_category_id'=>$id
										),
										'order' => array(
											'Source.name' => 'asc'
											),
										'contain'=>array('Country')
										);

		if($filter == 'number'){
			$filter = '^[0-9]+'; //Find records that start with numbers
			$this->paginate['Source'] = array(
											'conditions'=>array(
												'Source.name REGEXP' => $filter,
												'Source.source_category_id'=>$id
											),
											'order' => array(
												'Source.name' => 'asc'
											),
											'contain'=>array('Country')
											);
			$sources = $this->paginate('Source');
			
		}else{
			$this->paginate['Source'] = array(
											'conditions'=>array(
												'Source.name LIKE' => $filter.'%',
												'Source.source_category_id'=>$id
											),
											'order' => array(
												'Source.name' => 'asc'
											),
											'contain'=>array('Country')
											);
			$sources = $this->paginate('Source');
			
		}
	
		$sourceCategories = $this->SourceCategory->getAll();
		//$this->set('sourceCategory', $this->SourceCategory->read(null, $id));
		$total_count = $this->SourceCategory->Source->find('count');
		$this->set(compact('sources','filter','links','total_count','sourceCategories'));
		
	}

	function admin_add() {
		if (!empty($this->data)) {
			
			//Make sure that the specialty doesn't exist already
			$nameCheck = $this->SourceCategory->findByName(ucwords($this->data['SourceCategory']['name']));
			if(empty($nameCheck)){
				$this->SourceCategory->create();
				$this->data['SourceCategory']['name'] = ucwords($this->data['SourceCategory']['name']);
				$this->data['SourceCategory']['slug'] = $this->toSlug($this->data['SourceCategory']['name']);
				if ($this->SourceCategory->save($this->data)) {
					$this->Session->setFlash(__('The source category has been saved', true));
					$lastId = $this->SourceCategory->getLastInsertId();
					$this->redirect(array('action' => 'add','admin'=>true));
				} else {
					$this->Session->setFlash(__('The source category could not be saved. Please, try again.', true));
				}
			}else{
				$this->Session->setFlash(__($this->data['SourceCategory']['name'].' is already in the database.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid source category', true));
			$this->redirect(array('action' => 'index','admin'=>false));
		}
		if (!empty($this->data)) {
			//Make sure that the specialty doesn't exist already
			$nameCheck = $this->SourceCategory->findByName(ucwords($this->data['SourceCategory']['name']));
			if(empty($nameCheck)){
				$this->data['SourceCategory']['name'] = ucwords($this->data['SourceCategory']['name']);
				$this->data['SourceCategory']['slug'] = $this->toSlug($this->data['SourceCategory']['name']);
				if ($this->SourceCategory->save($this->data)) {
					$this->Session->setFlash(__('The source category '.$this->data['SourceCategory']['name'].' has been saved', true));
					$lastId = $this->SourceCategory->getLastInsertId();
					$this->redirect(array('action' => 'view',$lastId));
				} else {
					$this->Session->setFlash(__('The source category could not be saved. Please, try again.', true));
				}
			}else{
				$this->Session->setFlash(__($this->data['SourceCategory']['name'].' is already in the database.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->SourceCategory->read(null, $id);
		}
		
		$this->set('sourceCategory', $this->SourceCategory->read(null, $id));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for source category', true));
			$this->redirect(array('action'=>'index','admin'=>false));
		}
		if ($this->SourceCategory->delete($id)) {
			$this->Session->setFlash(__('Source category deleted', true));
			$this->redirect(array('action'=>'index','admin'=>false));
		}
		$this->Session->setFlash(__('Source category was not deleted', true));
		$this->redirect(array('action' => 'index','admin'=>false));
	}
}