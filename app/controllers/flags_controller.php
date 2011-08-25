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
		
		//Get the flag count for each item.
		$counter = 0;
		foreach($flags as $flag){
			$flags[$counter]['Flag']['count'] = $this->Flag->getItemCount($flag['Flag']['model'],$flag['Flag']['model_id']);
			$counter++; 
		}
		
		$total_count = $this->Flag->getCount();
		$this->set(compact('total_count','flags'));
		$this->set('string', $this->String);
	}
	
	/**
	 * Deletes a flag
	 * @param int id The item id
	 * @return 
	 * 
	*/
	function delete($id=null){
		
	}
	
	
	
	/**
	 * Finds the flagged item and deactivates it.
	 * @param int id The flag id
	 * @return 
	 * 
	*/
	function admin_deactivate_flagged_item($id=null){
		//Find the item based on the flag id and deactivate it.
		$item = $this->Flag->findById($id);
		
		if(!empty($item)){
			$this->Flag->$item['Flag']['model']->id = $item['Flag']['model_id'];
			$this->Flag->$item['Flag']['model']->set(array(
												'active'=>0 //Set the active field to 0, to not show the item.
												));
			//Save the item and then delete the flag
			if($this->Flag->$item['Flag']['model']->save()){
				//Set a session flash message and redirect.
				$this->Session->setFlash("The item has been deactivated!");
				
				//Delete the flag
				if($this->Flag->delete($id)){
					$this->redirect('/admin/flags');
				}else{
					$this->Session->setFlash("There was a problem deleting the flag. The item has been deactivated, though.");
					$this->redirect('/admin/flags');
				}
				exit();
			}
		}
	}
	
	
	/**
	 * Very destructive and may not be used. Finds the flagged item and deletes it.
	 * @param int id The flag id
	 * @return 
	 * 
	*/
	/*function deleteFlaggedItem($id=null){
		//Find the item based on the flag id and delete it.
	}*/
	
	
	
}
