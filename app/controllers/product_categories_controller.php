<?php
class ProductCategoriesController extends AppController {

	var $name = 'ProductCategories';
	
	//var $components = array();

	function index() {
		$this->ProductCategory->recursive = 1;
		$this->paginate = array(
								'limit' => 50,
								'order' => array(
									'ProductCategory.name' => 'asc'
									)
								);
		$this->set('productCategories', $this->paginate());
	}

	function view($id = null,$filter=null) {
		$this->ProductCategory->recursive = 1;
		if (!$id) {
			$this->Session->setFlash(__('Invalid product category', true));
			$this->redirect(array('action' => 'index','admin'=>false));
		}
		
		//Find the id
		if(!is_numeric($id)){
			$this->ProductCategory->recursive = -1;
			$category = $this->ProductCategory->findBySlug($id);
			if(!empty($category)){
				$id = $category['ProductCategory']['id'];
			}else{
				$this->Session->setFlash(__('Invalid product category', true));
				$this->redirect(array('action' => 'index','admin'=>false));
			}
		}
		
		// query all distinct first letters used in names
		$letters = $this->ProductCategory->Product->query('SELECT DISTINCT SUBSTRING(`name`, 1, 1) FROM `products` WHERE `product_category_id` = '.$id.' ORDER BY `name`');
		
		$links = array();
		// push all letters into a non-nested array
		foreach ($letters as $row) {
			array_push($links, current($row[0]));
		}

		$this->paginate['Product'] = array(
											'order' => array('Product.name' => 'asc'),
											'conditions'=>array('Product.product_category_id'=>$id),
											'contain'=>array('Attachment')
											);

		if($filter == 'number'){
			$filter = '^[0-9]+'; //Find records that start with numbers
			$this->paginate['Product'] = array('conditions'=>array(
													'Product.name REGEXP' => $filter,
													'Product.product_category_id'=>$id
												),
												'contain'=>array('Attachment','User','Tag')
												);
			$products = $this->paginate('Product');
			
		}else{
			$this->paginate['Product'] = array('conditions'=>array(
												'	Product.name LIKE' => $filter.'%',
													'Product.product_category_id'=>$id
												),
												'contain'=>array('Attachment','User','Tag')
												);
			$products = $this->paginate('Product');
			
		}
		$productCategories = $this->ProductCategory->getAll();
		$productCategory = $this->ProductCategory->read(null, $id);
		$total_count = $this->ProductCategory->Product->find('count');
		$this->set(compact('products','filter','links','total_count','productCategory','productCategories'));
		
	}

	function admin_add() {
		if (!empty($this->data)) {
			$nameCheck = $this->ProductCategory->findByName($this->data['ProductCategory']['name']);
			if(empty($nameCheck)){
				$this->ProductCategory->create();
				//$this->data['ProductCategory']['name'] = ucwords($this->data['ProductCategory']['name']);
				$this->data['ProductCategory']['slug'] = $this->toSlug($this->data['ProductCategory']['name']);
				if ($this->ProductCategory->save($this->data)) {
					$this->Session->setFlash(__('The product category has been saved', true));
					$this->redirect(array('action' => 'add','admin'=>true));
				} else {
					$this->Session->setFlash(__('The product category could not be saved. Please, try again.', true));
				}
			}else{
				$this->Session->setFlash(__('The product category '.$this->data['ProductCategory']['name'].' has already been added.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid product category', true));
			$this->redirect(array('action' => 'index','admin'=>false));
		}
		if (!empty($this->data)) {
			if ($this->ProductCategory->save($this->data)) {
				$this->Session->setFlash(__('The product category has been saved', true));
				$this->redirect(array('action' => 'view','admin'=>false,$id));
			} else {
				$this->Session->setFlash(__('The product category could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ProductCategory->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for product category', true));
			$this->redirect(array('action'=>'index','admin'=>false));
		}
		if ($this->ProductCategory->delete($id)) {
			$this->Session->setFlash(__('Product category deleted', true));
			$this->redirect(array('action'=>'index','admin'=>false));
		}
		$this->Session->setFlash(__('Product category was not deleted', true));
		$this->redirect(array('action' => 'index','admin'=>false));
	}
}