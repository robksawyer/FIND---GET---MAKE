<?php
class FlagsController extends AppController {

	var $name = 'Flags';
	var $components = array('String');
	
	var $paginate = array(
						'limit'=>50,
						'order'=>array(
										'Flag.created'=>'desc'
										)
						//'group'=>array('Flag.model')
									);
	
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
		
		//Get the flag count for each item and add that to the item array [Flag]['count']
		$counter = 0;
		foreach($flags as $flag){
			$flags[$counter]['Flag']['count'] = $this->Flag->getItemCount($flag['Flag']['model'],$flag['Flag']['model_id']);
			$counter++; 
		}
		$total_count = $this->Flag->getCount();
		
		//debug($flags);
		//Group like flagged items ex. The same item that has been flagged 
		$flags = Set::sort($flags,'{n}.Flag.model_id','desc');
		$flags = Set::sort($flags,'{n}.Flag.model','desc');
		
		$this->set(compact('total_count','flags'));
		
	}
	
	/**
	 * Process the checkbox selections on the admin_index page
	 * @param 
	 * @return 
	 * 
	*/
	function admin_process(){
		$this->autoRender = false;
		if(!empty($this->data)){
			//debug($this->data);
			//Get all of the flag ids in an array
			foreach($this->data['Flag']['id'] as $id => $value){
				if($value==1){
					$ids[]=$id;
				}
			}
			
			//debug($ids);
			//debug($this->data['Flag']['actions']);
			
			/**
			 * Action list:
			 * 0 = Delete Flags
			 * 1 = Deactivate Items
			 * 2 = ??
			 */
			switch($this->data['Flag']['actions']){
				case 0:
						if($this->Flag->deleteAll(array('Flag.id'=>$ids))){
							$this->Session->setFlash(__('The flag or flags were deleted successfully.', true));
							$this->redirect(array('action'=>'index'));
						}
				  		break;
				case 1:
						/*
							Traverse the selected items and update the models that need to be deactivated.
						*/
						foreach($ids as $id){
							$flag = $this->Flag->read(null,$id);
							$this->Flag->$flag['Flag']['model']->id = $flag['Flag']['model_id'];
							$this->Flag->$flag['Flag']['model']->saveField('active',0); //Update the item record and deactivate it
						}
						//Delete the flags now
						if($this->Flag->deleteAll(array('Flag.id'=>$ids))){
							$this->Session->setFlash(__('The item(s) were deactivated successfully.', true));
							$this->redirect(array('action'=>'index'));
						}
						break;
				default:
					$this->Session->setFlash(__('Something went wrong, please try again.', true));
					$this->redirect(array('action'=>'index'));
			}
		}
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