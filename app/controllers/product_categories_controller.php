<?php
class ProductCategoriesController extends AppController {

	var $name = 'ProductCategories';
	
	var $components = array('String');

	function index() {
		$this->ProductCategory->recursive = 2;
		$this->paginate = array(
								'limit' => 50,
								'order' => array(
									'ProductCategory.name' => 'asc'
									)
								);
		$this->set('productCategories', $this->paginate());
	}

	function view($id = null,$filter=null) {
		$this->ProductCategory->recursive = 2;
		if (!$id) {
			$this->Session->setFlash(__('Invalid product category', true));
			$this->redirect(array('action' => 'index','admin'=>false));
		}
		
		// query all distinct first letters used in names
		$letters = $this->ProductCategory->Product->query('SELECT DISTINCT SUBSTRING(`name`, 1, 1) FROM `products` ORDER BY `name`');
		
		$links = array();
		// push all letters into a non-nested array
		foreach ($letters as $row) {
			array_push($links, current($row[0]));
		}

		$this->paginate['Product'] = array(
										'order' => array(
											'Product.name' => 'asc'
											)
										);

		if($filter == 'number'){
			$filter = '^[0-9]+'; //Find records that start with numbers
			$products = $this->paginate('Product',array(
											   'Product.name REGEXP' => $filter
											));
			
		}else{
			$products = $this->paginate('Product',array(
											   'Product.name LIKE' => $filter.'%'
											));
			
		}
		
		/*$this->paginate = array(
				'Product'=>array(
					'limit' => 25,
					'order' => array('Product.name'=>'asc'),
					'conditions'=>array('Product.product_category_id'=>$id)
				)
			);*/
			
		//$this->set('products', $this->paginate('Product'));
		
		//Tagging
		/*if (isset($this->passedArgs['by'])) {
			$this->paginate = array(
								'Tagged'=>array(
									'tagged',
									'model' => 'Product',
									'by' => $this->passedArgs['by']
									//'recursive' => 2 //Doesn't change anything
								)
							);
			$products = Set::filter($this->paginate('Tagged')); //Remove empty values
			//Build a new array
			foreach($products as $product){
				$clean_products[] = $product;
			}
			if(!empty($clean_products)){
				$products = $clean_products;
			}
			$counter = 0;
			foreach($products as $product){
				//Find categories
				$temp_cat = $this->ProductCategory->find('first',array('conditions'=>array('ProductCategory.id'=>$product['Product']['product_category_id'])));
				$products[$counter]['ProductCategory'] = $temp_cat['ProductCategory'];
				
				//Find sources
				$temp_source = $this->ProductCategory->Product->Source->find('first',array('conditions'=>array('Source.id'=>$product['Product']['source_id'])));
				$products[$counter]['Source'] = $temp_source['Source'];
				$counter++;
			}
		}*/
		
		$productCategories = $this->ProductCategory->getAll();
		$productCategory = $this->ProductCategory->read(null, $id);
		$this->set('productCategory', $productCategory);
		$total_count = $this->ProductCategory->Product->find('count');
		$this->set(compact('filter','links','total_count','productCategories'));
		
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