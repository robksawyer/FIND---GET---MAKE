<?php
class FlagsController extends AppController {

	var $name = 'Flags';
	var $components = array('String');
	
	/**
	 * Flags the item
	 * @param 
	 * @return 
	 * 
	*/
	function flag_item(){
		$this->autoRender = false;
		$this->autoLayout = false;
		if(!empty($this->data)){
			//debug($this->data);
			
			$this->data['Flag']['description'] = strip_tags($this->data['Flag']['description']);
			
			if($this->Flag->save($this->data)){
				//Redirect the user back to the previous page.
				if(!empty($this->data['Flag']['redirect'])){
					$this->Session->setFlash(__('Thanks for your feedback.', true));
					$this->redirect($this->data['Flag']['redirect']);
				}else{
					//Send them somewhere else.
				}
			}else{
				$this->Session->setFlash(__('We were unable to save your feedback. This is important to us, so please try again later.', true),'default',array('class'=>'error-message'));
			}
		}
	}
	
	/**
	 * The administration panel to view all of the flagged items. In this area, you can delete, deactivate, reactivate and remove flags from items.
	 * @param 
	 * @return 
	 * 
	*/
	function admin_index(){
		$flags = $this->paginate('Flag');
		$total_count = $this->Flag->getCount();
		$this->set(compact('total_count','flags'));
		$this->set('string', $this->String);
	}
}
