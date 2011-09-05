<?php 
/**
 * This controller helps to manage all user related settings
 * 
*/
class SettingsController extends AppController {
	
	var $name = "Settings";
	
	var $uses = array('User');
	
	/**
	 * Components.
	 *
	 * @access public
	 * @var array
	 */
	var $components = array('Email','Search.Prg','Uploader.Uploader');
	
	public function beforeFilter(){
		parent::beforeFilter();
		
	}
	
	/**
	 * Edit a users profile.
	 *
	 * @access public
	 */
	public function account() {
		$this->User->recursive = 1;
		$this->set('title_for_layout','User Settings');
		$user_id = $this->Auth->user('id');
		$user = $this->User->get($user_id);

		// Form Processing
		if (!empty($this->data)) {
			$this->User->id = $user_id;
			$this->User->set($this->data);
	
			$errors = $this->User->invalidFields();
			if(!empty($this->data['User']['email'])){
				$user_by_email = $this->User->find('first',array('conditions'=>array(
																					'User.email'=>mysql_real_escape_string($this->data['User']['email'])
																					))
																					);
			}
			
			if(!empty($user_by_email)){
				if(intval($user_by_email['User']['id']) != intval($user_id)){
					$fail = 1;
				}else{
					$fail = 0;
				}
			}else{
				$fail = 0;
			}
			if ($this->User->validates() && empty($fail)) {
				if (isset($this->data['User']['newPassword'])) {
					$this->data['User']['password'] = $this->Auth->password($this->data['User']['newPassword']);
				}
				//Cleanup
				if(!empty($this->data['User']['url'])){
					if($this->data['User']['url'] == "http://") $this->data['User']['url'] = '';
					if(!empty($this->data['User']['url'])){
						$this->data['User']['url'] = $this->cleanURL($this->data['User']['url']); //Clean the URL
					}
				}
		
				//if ($this->User->save($this->data)){
				if ($this->User->save($this->data, false, array('email','username'))) {
					$this->Session->setFlash(__('Your profile information has been updated!', true));

					foreach ($this->data['User'] as $field => $value) {
						$this->_refreshAuth($field, $value);
					}
				}
			}else{
				//Reset email
				$this->data['User']['email'] = $user['User']['email'];
				$this->Session->setFlash(__('Your profile information could NOT be updated because this email address is taken.', true),'default', array('class' => 'error-message'));
			}
		}
		
		foreach ($user['User'] as $field => $value) {
			if (empty($this->data['User'][$field])) {
				$this->data['User'][$field] = $value;
			}
		}
		
		//Clear the password fields
		$this->data['User']['oldPassword'] = '';
		$this->data['User']['newPassword'] = '';
		$this->data['User']['confirmPassword'] = '';
		
		//Check for a local avatar details
		if(!empty($user['User']['attachment_id'])){
			$avatar = $this->User->Attachment->getAvatar($user['User']['attachment_id'],$user['User']['id']);
		}else{
			$avatar = false;
		}
		$this->set('avatar',$avatar);
		//$this->Toolbar->pageTitle(__('Edit Profile', true));
	}
	
	/**
	 * Handles all account related settings
	 * @param 
	 * @return 
	 * 
	*/
	public function password(){
		$this->User->recursive = 1;
		$this->set('title_for_layout','User Settings');
		$user_id = $this->Auth->user('id');
		$user = $this->User->get($user_id);

		// Form Processing
		if (!empty($this->data)) {
			$this->User->id = $user_id;
			$this->User->set($this->data);
		
			if (isset($this->data['User']['newPassword'])) {
				$this->data['User']['password'] = $this->Auth->password($this->data['User']['newPassword']);
			}
	
			//if ($this->User->save($this->data)){
			if ($this->User->save($this->data, false, array('password'))) {
				$this->Session->setFlash(__('Your password has been changed!', true));

				foreach ($this->data['User'] as $field => $value) {
					$this->_refreshAuth($field, $value);
				}
			}else{
				$this->Session->setFlash(__('Your password could not be changed. Please try again.', true),'default', array('class' => 'error-message'));
			}
		}
		
		//Clear the password fields
		$this->data['User']['oldPassword'] = '';
		$this->data['User']['newPassword'] = '';
		$this->data['User']['confirmPassword'] = '';
	}
	
	/**
	 * Handles all account related settings
	 * @param 
	 * @return 
	 * 
	*/
	public function profile(){
		$this->User->recursive = 1;
		$this->set('title_for_layout','User Settings');
		$user_id = $this->Auth->user('id');
		$user = $this->User->get($user_id);

		// Form Processing
		if (!empty($this->data)) {
			$this->User->id = $user_id;
			$this->User->set($this->data);
	
			$errors = $this->User->invalidFields();
			if(!empty($this->data['User']['email'])){
				$user_by_email = $this->User->find('first',array('conditions'=>array(
																					'User.email'=>mysql_real_escape_string($this->data['User']['email'])
																					))
																					);
			}
			
			if(!empty($user_by_email)){
				if(intval($user_by_email['User']['id']) != intval($user_id)){
					$fail = 1;
				}else{
					$fail = 0;
				}
			}else{
				$fail = 0;
			}
			if ($this->User->validates() && empty($fail)) {

				//Cleanup
				if(!empty($this->data['User']['url'])){
					if($this->data['User']['url'] == "http://") $this->data['User']['url'] = '';
					if(!empty($this->data['User']['url'])){
						$this->data['User']['url'] = $this->cleanURL($this->data['User']['url']); //Clean the URL
					}
				}
		
				$this->User->id = $user_id;
				
				//if ($this->User->save($this->data)){
				if ($this->User->save($this->data, false, array('url','about','gender','location','fullname'))) {
					$this->Session->setFlash(__('Your profile information has been updated!', true));

					foreach ($this->data['User'] as $field => $value) {
						$this->_refreshAuth($field, $value);
					}
				}
			}else{
				//Reset email
				$this->data['User']['email'] = $user['User']['email'];
				$this->Session->setFlash(__('Your profile information could NOT be updated. Please try again later.', true),'default', array('class' => 'error-message'));
			}
		}
		
		foreach ($user['User'] as $field => $value) {
			if (empty($this->data['User'][$field])) {
				$this->data['User'][$field] = $value;
			}
		}
		
		
		//Check for a local avatar details
		if(!empty($user['User']['attachment_id'])){
			$avatar = $this->User->Attachment->getAvatar($user['User']['attachment_id'],$user['User']['id']);
		}else{
			$avatar = false;
		}
		$this->set('avatar',$avatar);
		//$this->Toolbar->pageTitle(__('Edit Profile', true));
	}
	
	/**
	 * Handles all forum related settings
	 * @param 
	 * @return 
	 * 
	*/
	public function forum(){
		$this->User->recursive = 1;
		$this->set('title_for_layout','User Settings');
		$user_id = $this->Auth->user('id');
		$user = $this->User->get($user_id);

		// Form Processing
		if (!empty($this->data)) {
			$this->User->id = $user_id;
			$this->User->set($this->data);
			
			//if ($this->User->save($this->data)){
			if ($this->User->save($this->data, false, array($this->User->columnMap['signature'], $this->User->columnMap['locale'], $this->User->columnMap['timezone']))) {
				$this->Session->setFlash(__('Your profile information has been updated!', true));

				foreach ($this->data['User'] as $field => $value) {
					$this->_refreshAuth($field, $value);
				}
			} else{
				$this->Session->setFlash(__('Your profile information could NOT be updated.', true),'default', array('class' => 'error-message'));
			}
		}
		
		foreach ($user['User'] as $field => $value) {
			if (empty($this->data['User'][$field])) {
				$this->data['User'][$field] = $value;
			}
		}
	}
	
	/**
	 * Handles all account related settings
	 * @param 
	 * @return 
	 * 
	*/
	public function notifications(){
		$this->User->recursive = 1;
		$this->set('title_for_layout','User Settings');
		$user_id = $this->Auth->user('id');
		$user = $this->User->get($user_id);
		
		// Form Processing
		if (!empty($this->data)) {
			$this->User->id = $user_id;
			$this->User->set($this->data);
			
			//if ($this->User->save($this->data)){
			if($this->User->save()) {
				$this->Session->setFlash(__('Your profile information has been updated!', true));

				foreach ($this->data['User'] as $field => $value) {
					$this->_refreshAuth($field, $value);
				}
			} else{
				$this->Session->setFlash(__('Your profile information could NOT be updated.', true),'default', array('class' => 'error-message'));
			}
		}
		
	}
	
	/**
	 * Handles all account related settings
	 * @param 
	 * @return 
	 * 
	*/
	public function applications(){
		$this->User->recursive = 1;
		$this->set('title_for_layout','User Settings');
		$user_id = $this->Auth->user('id');
		$user = $this->User->get($user_id);
		
		//Add form processing
	}
	
	/**
	 * This is the method used to add an avatar image to a user's profile
	 * @param int user_id
	 * @param  
	 * @version 1.0
	 */
	public function add_avatar($user_id = null){
		
		if (!$user_id && empty($this->data)) {
			$this->Session->setFlash(__('There was an error uploading the image. There was a problem with your user id.', true));
			$this->redirect('/account/settings');
		}
		
		//Check to make sure it's a valid item
		$user = $this->User->read(null, $user_id);
		if(empty($user) && empty($this->data)){
			$this->Session->setFlash(__('There was an error uploading the image.', true));
			$this->redirect('/account/settings');
		}
		
		if (!empty($this->data)) {
			//Delete any old avatars
			$this->remove_avatar($user['User']['attachment_id']);
			
			//Upload the attachments
			$attachmentData = $this->upload_avatar('User',$user_id);
			
			if(!empty($attachmentData)){
				
				$this->data['Attachment'] = $attachmentData; //Add the attachment data to the main data stream
				$this->User->Attachment->create();
				if($this->User->Attachment->save($this->data['Attachment'])){
					$this->Session->setFlash(__('The attachment has been saved', true));
					$lastID = $this->User->Attachment->getLastInsertId();
					unset($this->data['Attachment']);
					
					$this->User->set(array(
										'attachment_id' => $lastID
										)
									);
					if ($this->User->save()) {
						$this->Session->setFlash(__('The avatar has been saved', true));

						if(!empty($redirect)){
							$this->redirect($redirect);
						}else{
							$this->redirect('/account/settings');
						}

					} else {
						$this->Session->setFlash(__('The avatar could not be saved. Please, try again.', true));
						$this->redirect('/account/settings');
					}
				}else{
					$this->Session->setFlash(__('The avatar could not be saved. Please, try again.', true));
					$this->redirect('/account/settings');
				}

			}else{
				$this->Session->setFlash(__('You didn\'t add an image, or the filetype is not valid. Try saving the file to your computer and trying again.', true));
				$this->redirect('/account/settings');
			}
		}
		
		$this->set('user', $this->User->read(null, $user));
	}
	
	/**
	 * Helper method to upload the avatar. 
	 * @param model The current model to attach the attachments to
	 * @param id The id of the current item you're editing
	 * @return array attachmentData The details of the attachment added
	 */
	
	public function upload_avatar($model=null,$id = null){
		
		if(!empty($model)){
			$controller = Inflector::pluralize(strtolower($model));
		}else{
			$this->log('You did not enter a model.');
		}
		
		//Check to see if the url contains http://. If it does, copy the file to the server,
		//and then upload it via the normal method.
		if(!empty($this->data['Attachment']['url']) && !empty($this->data['Attachment']['file']['name'])){
			unset($this->data['Attachment']['url']); //Choose the local file over the url
		}
		if(!empty($this->data['Attachment']['url'])){
			$attachmentData = $this->save_avatar($this->data['Attachment']['url'],$model);
			return $attachmentData;
		}else if(!empty($this->data['Attachment']['file']['name'])){
			//Save the local file
			unset($this->data['Attachment']['url']);
			$attachmentData = $this->save_avatar(null,$model);
			return $attachmentData;
		}else{
			unset($this->data['Attachment']['title']);
			unset($this->data['Attachment']['source_url']);
			unset($this->data['Attachment']['url']);
			unset($this->data['Attachment']['file']);
		}
	}
	
	/**
	 * Save the avatar from a URL or local file
	 * @param model: The current model
	 * @param folder: The folder for the final image
	 * @param url: The url of the image you're trying to download
	 * @param filename: The name you want the file renamed to
	 * @return array attachmentData The details of the last inserted attachment
	 * @version 1.0
	 * 			1.1 Updated to check for a image name that already exists
	 * 			1.2 There was a bug overriding the currently saved attachments.
	 * 				- This has been fixed and now the current attachments are passed along and added to the final array.
	 * 			1.3 Returns an array of data instead of adding it to the main $this->data stream
	 */
	public function save_avatar($url = null,$model=null){
		
		if(!empty($model)){
			$controller = Inflector::pluralize(strtolower($model));
		}else{
			$this->log('You did not enter a model.');
		}
		
		//Clean the image url passed
		if(!empty($url)){
			$this->data['Attachment']['url'] = $this->simplifyFileName(trim($url));
			$url = $this->data['Attachment']['url'];

			if($url){
				unset($this->data['Attachment']['url']);
				//Save the file from the url
				$filename = basename($url);
				$data = $this->Uploader->importRemote($url,array('name'=>$filename));
				//debug($data);
				/* EXAMPLE
				[path] => /media/static/img/inspirations/01tubopyramid_rect5402.jpg
			    [type] => image/jpeg
			    [ext] => jpg
			    [group] => image
			    [name] => 01tubopyramid_rect5402.jpg
			    [uploaded] => 2011-07-09 03:23:35
			    [filesize] => 108 KB
			    [width] => 359
			    [height] => 540*/
			
				$this->data['Attachment']['file'] = $data;

			}else{
				$this->Session->setFlash(__('This is not a valid image file path. Please, try again.', true));
			}
		}else{
			//Upload all files and get the image record id 
			if ($this->User->Attachment->validates()) {
				$data = $this->Uploader->uploadAll();
				//debug($data);
				if(!empty($data)){
					$this->data['Attachment']['file'] = $data['Attachment.file'];
					unset($data['Attachment.file']);
					$data = $this->data['Attachment']['file'];
				}
			}
		}
	
		//Move and transform the files
		if (!empty($data)) {
			
			//Save the title
			if(!empty($this->data['Attachment']['title'])){
				$title = $this->data['Attachment']['title'];
				unset($this->data['Attachment']['title']);
			}else{
				$title = '';
				unset($this->data['Attachment']['title']);
			}

			//Save the source url
			if(!empty($this->data['Attachment']['source_url'])){
				$source = $this->data['Attachment']['source_url'];
				unset($this->data['Attachment']['source_url']);
			}else{
				$source = '';
				unset($this->data['Attachment']['source_url']);
			}
			
			//Make some other sizes
			$small_path = $this->Uploader->resize(array('width'=>100, 'height'=>100,'append'=>'_small')); // Returns: /files/uploads/fileName_100_small.jpg
			$med_path = $this->Uploader->resize(array('height'=>300, 'append'=>'_med'));
			
			$this->data['Attachment']['file']['title'] = $title;
			$this->data['Attachment']['file']['source_url'] = $source;
			
			//Check to see if the file name exists
			$checker_name = $this->cleanFileName($this->data['Attachment']['file']['name']);
			$aCheck = $this->User->Attachment->findByName($checker_name);
			
			/*if(empty($aCheck)){
				$this->data['Attachment']['file']['name'] = $this->cleanFileName($this->data['Attachment']['file']['name']);
			}else{
				$this->data['Attachment']['file']['name'] = $this->cleanFileName($this->data['Attachment']['file']['name']);
				$this->data['Attachment']['file']['name'] = $this->uniqueName($this->data['Attachment']['file']['name']);
			}*/
			
			$ext = $this->Uploader->ext($this->data['Attachment']['file']['path']); //Returns just the extension
			$withoutExt = preg_replace("/\\.[^.\\s]{3,4}$/", "", $this->data['Attachment']['file']['name']);
			
			//FIX: The move method ads a forward slash
			$new_path = 'media/static/img/'.$controller.DS.$this->data['Attachment']['file']['name'];
			$new_small_path = 'media/filter/img/sml/'.$controller.DS.$withoutExt.'_small.'.$ext;
			$new_med_path = 'media/filter/img/med/'.$controller.DS.$withoutExt.'_med.'.$ext;
			$data['path'] = substr($data['path'],1); //Remove the forward slash
			$small_path = substr($small_path,1);
			$med_path = substr($med_path,1);
			
			//Note: Make sure you use the original path, because the new path has a new file name
			$this->Uploader->move($data['path'], $new_path);
			$this->Uploader->move($small_path, $new_small_path);
			$this->Uploader->move($med_path, $new_med_path);
			
			$new_path = '/'.$new_path;
			$new_small_path = '/'.$new_small_path;
			$new_med_path = '/'.$new_med_path;
			
			$this->data['Attachment']['file']['path'] = $new_path;
			$this->data['Attachment']['file']['path_small'] = $new_small_path;
			$this->data['Attachment']['file']['path_med'] = $new_med_path;
			
			$user_id = $this->data[$model]['user_id'];
			$this->data['Attachment']['file']['user_id'] = $user_id;
			
			//Save all of the attachments and then attach the id
			$attachmentData = $this->data['Attachment']['file'];
			unset($this->data['Attachment']['file']);
			
			return $attachmentData;
		
		}else{
			return false;
		}
	}
	
	/**
	 * Removes a user's avatar
	 * @param int attachment_id The avatar to remove
	 * @return 
	 * 
	*/
	public function use_gravatar($attachment_id=null){
		$this->autoLayout = false;
		$this->autoRender = false;
		if(!$attachment_id){
			$this->Session->setFlash(__('There was an error and your gravatar hasn\'t been activated. Please contact support.', true),'default',array('class'=>'error-message'));
			$this->log('There was an error and your gravatar hasn\'t been activated. Please contact support.');
			$this->redirect('/account/settings');
		}
		$removed = $this->remove_avatar($attachment_id);
		if($removed){
			$this->Session->setFlash(__('You are now using your gravatar.', true));
			$this->redirect('/account/settings');
		}else{
			$this->Session->setFlash(__('There was an error and your gravatar hasn\'t been activated. Please contact support.', true),'default',array('class'=>'error-message'));
			$this->log('There was an error and your gravatar hasn\'t been activated. Please contact support.');
			$this->redirect('/account/settings');
		}
	}
	
	/**
	 * Removes a user's avatar
	 * @param int attachment_id The avatar to remove
	 * @return 
	 * 
	*/
	public function remove_avatar($attachment_id=null){
		if(!$attachment_id){
			return false;
		}
		$attachment = $this->User->Attachment->read(null,$attachment_id);
		$this->Uploader->delete($attachment['Attachment']['path_small']);
		$this->Uploader->delete($attachment['Attachment']['path_med']);
		$this->Uploader->delete($attachment['Attachment']['path']);
		if($this->User->Attachment->delete($attachment_id)){
			return true;
		}else{
			return false;
		}
	}
	
	/**
	 * Returns the avatar details, if there is one.
	 * @param 
	 * @return 
	 * 
	*/
	public function getAvatar($user_id=null){
		if(!$user_id){
			return false;
		}
		$user = $this->User->read(null,$user_id);
		//Check for a local avatar details
		if(!empty($user['User']['attachment_id'])){
			$avatar = $this->User->Attachment->getAvatar($user['User']['attachment_id'],$user['User']['id']);
		}else{
			$avatar = false;
		}
		if(!empty($this->params['requested'])) {
			return $avatar;
		} else {
			$this->set(compact('avatar'));
		}
	}	
}