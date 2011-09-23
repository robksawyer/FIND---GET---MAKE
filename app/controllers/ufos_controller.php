<?php
class UfosController extends AppController {

	var $name = 'Ufos';
	var $helpers = array('Tags.TagCloud');
	var $components = array('Uploader.Uploader','Comments.Comments' => array('userModel' => 'User'));
	
	function beforeFilter(){
		parent::beforeFilter();
		
		//Make certain pages public
		$this->Auth->allowedActions = array('index','view','tags',
											'getUfosFromUser','users'
											);
											
		//$this->Auth->allow('getUfosFromUser');
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
		$staff_favorite = $this->$model->StaffFavorite->hasUserFavorited($user_id,$model,$this->$model->id);
		$this->set(compact('flagged','staff_favorite'));
	}
	
	
	function index($filter = null) {
		$this->Ufo->recursive = 1;
		
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
									'recursive'=>1 //Removing this throws errors.
								)
							);
			$ufos = $this->paginate('Tagged');
			$counter = 0;
			foreach($ufos as $ufo){
				//Find attachments
				if(!empty($ufo['Ufo']['id'])){
					$temp_att = $this->Ufo->find('first',array('conditions'=>array('Ufo.id'=>$ufo['Ufo']['id']),
																'contain'=>array('Attachment','User','Tag')
																)
															);
					//debug($temp_att);
					$ufos[$counter] = $temp_att;

					$counter++;
				}else{
					unset($ufos[$counter]);
				}
			}
		}else{
			$ufos = $this->paginate();
		}
		
		$this->set(compact('ufos','filter','links'));
		
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid ufo', true));
			$this->redirect(array('action' => 'index','admin'=>false));
		}
		$ufo = $this->Ufo->read(null, $id);
		$this->set("title_for_layout", "Ufo : ".$ufo['Ufo']['name']);
		$this->set('ufo', $ufo);
	}
	
	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
	function add() {
		if (!empty($this->data)) {
			
			//debug($this->data);
			$this->data['Ufo']['attachment_id'] = $this->data['Attachment']['Attachment'][0];
			unset($this->data['Attachment']);
			
			$this->Ufo->create();
			if ($this->Ufo->save($this->data)) {
				
				$id = $this->Ufo->getLastInsertID();
				//Upload the attachments
				$this->uploadAttachments('Ufo',$id);
				
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
	
	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
	function edit($id = null) {
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
	
	/**
	 * This method handles showing sources added by a certain user
	 * @param int id 
	 * @return 
	 * 
	*/
	public function users($id = null){
		$this->Ufo->recursive = 1;
		
		if (!$id) {
			$this->Session->setFlash(__('Invalid user id', true));
			$this->redirect(array('action' => 'index','admin'=>false));
		}
		//Check to see if the username was passed
		if(is_numeric($id)){
			$user = $this->Ufo->User->read(null,$id);
		}else{
			$user = $this->Ufo->User->find('first',array('conditions'=>array('User.username'=>$id)));
			$id = $user['User']['id'];
		}
		if(empty($user)){
			$this->Session->setFlash(__('Invalid user id', true));
			$this->redirect(array('action' => 'index','admin'=>false));
		}
		
		$this->paginate = array(
								'conditions'=>array(
													'Ufo.user_id' => $id
													),
													'contain'=>array('User','Attachment','Tag')
								);
		$ufos = $this->paginate('Ufo');
		$total_count = $this->Ufo->find('count');
		$this->set(compact('total_count','ufos','user'));
		
	}
	
	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
	function delete($id = null) {
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
		$this->Ufo->recursive = 1;
		if(isset($this->params['requested'])) {
			$ufos = $this->Ufo->userUfos($id,$limit);
			return $ufos;
		}
	}
	
	/**
	 * Finds the tags associated with this model
	 */
	function tags(){
		$this->Ufo->recursive = 1;
		$this->Ufo->Tagged->recursive = 2;
		$this->paginate['conditions']['Tagged.model'] = 'Ufo';
		$this->paginate['fields'] = 'DISTINCT Tag.name,Tag.keyname,Tagged.model';
		$this->paginate['limit'] = 50;
		//debug($this->paginate['count']);
		$tag_count = count($this->Ufo->Tagged->find('tagged',array('conditions'=>array('Tagged.model'=>'Ufo'),'fields'=>'DISTINCT Tag.name')));
		$page_count = $tag_count/50;
		$tags = $this->paginate('Tagged');

		$this->set(compact('tags','tag_count','page_count'));
	}
}