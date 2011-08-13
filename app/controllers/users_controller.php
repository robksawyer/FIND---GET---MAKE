<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $components = array('Auth','AutoLogin','String','Session');
	var $helpers = array('Javascript', 'Time', 'Form');
	var $uses = array('Forum.Topic');
	
	var $paginate = array(
		'User' => array(
			'limit' => 20,
			'order' => array(
				'User.full_name' => 'asc',
			),
		),
	);
	
	/**
	 * Before any Controller action
	 */
	function beforeFilter() {
		parent::beforeFilter();
		
		$this->Auth->allow('login','logout');
	}
	
	/**
	 * A column map allowing you to define the name of certain user columns.
	 *
	 * @access public
	 * @var array
	 */
	/*var $columnMap = array(
		'status'		=> 'status',
		'signature'		=> 'signature',
		'locale'		=> 'locale', // Must allow 3 characters: eng
		'timezone'		=> 'timezone', // Must allow 5 digits: -10.5
		'totalPosts'	=> 'totalPosts',
		'totalTopics'	=> 'totalTopics',
		'currentLogin'	=> 'currentLogin',
		'lastLogin'		=> 'lastLogin'
	);*/
	
	/**
	 *  User moderation panel
	 *
	 * @access public
	 * @category Admin
	 * @param int $id
	 */
	function admin_moderate() {
		$this->User->recursive = 2;
		$user = $this->Auth->user();
		if (!$user['User']['id']) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		
		$user = $this->User->getProfile($user['User']['id']);
		if (!empty($user)) {
			//$this->loadModel('Forum.Topic');
			$this->set('topics', $this->Topic->getLatestByUser($user['User']['id']));
			$this->set('posts', $this->Topic->Post->getLatestByUser($user['User']['id']));
		}
		
		
		//Request data for the elements
		$userSources = $this->User->Source->userSources($user['User']['id']);
		$this->set(compact('userSources'));
		
		$userProducts = $this->User->Product->userProducts($user['User']['id'],10,'all');
		$this->set(compact('userProducts'));
		
		$userInspirations = $this->User->Inspiration->userInspirations($user['User']['id'],10,'all');
		$this->set(compact('userInspirations'));
		
		$userUfos = $this->User->Ufo->userUfos($user['User']['id']);
		$this->set(compact('userUfos'));
		
		$wantedProductsTemp = $this->User->Ownership->getUserWants('Product',$user['User']['id']);
		//Find the full product details
		if(!empty($wantedProductsTemp)){
			foreach($wantedProductsTemp as $product){
				$wantedProducts[] = $this->User->Product->read(null,$product['Product']['id']);
			}
			$this->set(compact('wantedProducts'));
		}
		$haveProductsTemp = $this->User->Ownership->getUserHaves('Product',$user['User']['id']);
		if(!empty($haveProductsTemp)){
			foreach($haveProductsTemp as $product){
				$haveProducts[] = $this->User->Product->read(null,$product['Product']['id']);
			}
			$this->set(compact('haveProducts'));
		}
		
		
		//$this->set('user', $this->User->read(null, $user['User']['id']));
		$this->set('user', $user);
		$this->set('string', $this->String);
	}

	
	/**
	 * Update items in the database after the user logs in. 
	 */
	/*function afterFilter() {
		# Update User last_access datetime
		if ($this->Auth->user()) {
			$this->User->id = $this->Auth->user('id');
			$this->User->saveField('lastLogin', date('Y-m-d H:i:s'));
		}
	}*/
	
	/**
	 *  The AuthComponent provides the needed functionality
	 *  for login, so you can leave this function blank.
	 */
	function login() {
		// redirect user if already logged in
		if($this->Auth->user()) {
			$this->data = $this->User->read(null,$this->Auth->user('id'));
			if (!empty($this->data) && !empty($this->data['User']['remember_me'])) {
				$cookie = array();
				$cookie['username'] = $this->data['User']['username'];
				$cookie['password'] = $this->data['User']['password'];
				$this->User->id = $this->Auth->user('id');
				$this->User->saveField('remember_me', 1);
				$this->Cookie->write('Auth.User', $cookie, true, '+1 month');
				//unset($this->data['User']['remember_me']);
			}
			$this->redirect($this->Auth->redirect());
		}
		
		//-- code inside this function will execute only when autoRedirect was set to false (i.e. in a beforeFilter).
		if(!empty($this->data)) {
			// set the form data to enable validation
			$this->User->set($this->data);
			$this->User->action = 'login';
			// see if the data validates
			if($this->User->validates()) {
				// check user is valid
				//$result = $this->User->check_user_data($this->data); //This method is in the model
				
				if($user = $this->Auth->user()) {
					$this->User->login($user);
					
					// save to session
					$this->Session->write('User',$result);
					$this->Session->write('Competition.deactivated',false);
					$this->Session->delete('Forum');
					
					//Build and set the cookie
					if(!empty($this->data['User']['remember_me'])){
						$cookie = array();
						$cookie['username'] = $this->data['User']['username'];
						$cookie['password'] = $this->data['User']['password'];
						$this->User->id = $this->Auth->user('id');
						$this->User->saveField('remember_me', 1);
						$this->Cookie->write('Auth.User', $cookie, true, '+1 month');
					}
					
					$this->Session->setFlash(__('You have successfully logged in',true));
					//$this->redirect($this->Auth->redirect());
					$this->redirect('/admin/users/moderate');
				} else {
					$this->Session->setFlash(__('Either your Username of Password is incorrect',true),'default','error-message');
				}
			}
		}
	}
	
	/**
	 * Logs out a User
	 */
	function logout() {
		if($this->Session->check('Competition')){
			$this->Session->delete('Competition');
		}
		if($this->Session->check('Forum')){
			$this->Session->delete('Forum');
		}
		if($this->Session->check('User')) {
			$this->Session->delete('User');
		}
		$this->Session->destroy();
		$this->Session->setFlash(__('You have successfully logged out.',true));
		$this->redirect($this->Auth->logout());
	}
	
	/*
	function admin_index() {
		$this->User->recursive = 2;
		$countries = $this->User->Country->find('list');
		$this->set(compact('countries'));
		$this->set('users', $this->paginate());
		$this->set('string', $this->String);
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
		$this->set('string', $this->String);
	}*/

	/*function admin_add() {
		//Delete any previous sessions
		$currentSession = $this->Session->read('User');
		if($currentSession) $this->Session->del('User');
		
		if(!empty($this->data)) {
			
			// set the form data to enable validation
			$this->User->set( $this->data );
			// see if the data validates
			if($this->User->validates()) {
				if($this->Auth->password($this->data['User']['password_confirm']) == $this->data['User']['password']){
					
					//Cleanup
					if(!empty($this->data['User']['url'])){
						$this->data['User']['url'] = $this->cleanURL($this->data['User']['url']); //Clean the URL
					}
					$this->data['User']['slug'] = $this->toSlug($this->data['User']['fullname']);

					$name_array = $this->String->split_full_name($this->data['User']['fullname']);
					$this->data['User']['fname'] = $name_array['fname'];
					$this->data['User']['lname'] = $name_array['lname'];
					$this->data['User']['suffix'] = $name_array['suffix'];
					$this->data['User']['salutation'] = $name_array['salutation'];
					$this->data['User']['initials'] = $name_array['initials'];

					unset($this->data['User']['password_confirm']);
					unset($this->data['User']['fullname']);
				
					$this->User->create();
					if ($this->User->save($this->data)) {
						$user = $this->User->id;

						// send signup email containing password to the user 
						//$assigned_password = 'password';
						//$this->data['User']['password'] = $assigned_password;
						//Send an email to the user and thank them for signing up
						//$sendEmail = true;
						//if($sendEmail){
						//	if($this->_sendNewUserMail( $user['User']['id'],$password )){
						//		$this->redirect(array('controller'=>'brands','action'=>'add',$user['User']['id']));
						//	}
						//}

						$this->Auth->login($this->data);
						$this->Session->setFlash(__('Your account has been created.', true));
						$this->redirect(array('controller'=>'users','action'=>'moderate','admin'=>true));
					} else {
						$this->Session->setFlash(__('You account could not be created, try again.', true));
					}
				}else{
					$this->Session->setFlash(__('The passwords entered, do NOT match.', true));
				}
			}else{
				$errors = $this->User->invalidFields(); // contains validationErrors array
				$this->Session->setFlash(__('User validation failed.', true));
			}
		}
		$countries = $this->User->Country->find('list');
		$this->set(compact('countries'));
	}*/
	
	/**
	* Send the user an email on signup
	*/
	function _sendNewUserMail($id,$password) {
		$user = $this->User->read(null,$id);
		if($user){
			
			$this->set('password', $password);
			
			// Set data for the "view" of the Email
			$this->set('activate_url','http://'.env('SERVER_NAME').'/users/activate/'.$user['User']['id'].'/' .$this->getActivationHash($id));
			$this->set('username', $this->data['User']['name']);
			
			$this->Email->to = $user['User']['email_address'];
			$this->Email->bcc = array('robksawyer+thesource@gmail.com');  
			$this->Email->subject = 'Welcome to THE SOURCE, '.$user['User']['name'];
			$this->Email->replyTo = 'noreply@'.env('SERVER_NAME');
			$this->Email->from = 'THE SOURCE <robksawyer+thesource@gmail.com>';
			$this->Email->template = 'welcome_message'; // note no '.ctp'
			//Send as 'html', 'text' or 'both' (default is 'text')
			$this->Email->sendAs = 'both'; // because we like to send pretty mail
			//Set view variables as normal
			$this->set('user', $user);
			
			//Do not pass any args to send()
			if($this->Email->send()){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
		
	}
	
	/**
	 * Activates a user account from an incoming link
	 *
	 *	 @param Int $user_id User.id to activate
	 *	 @param String $in_hash Incoming Activation Hash from the email
	*/
	function activate($user_id = null, $in_hash = null) {
		$this->User->id = $user_id;
		if ($this->User->exists() && ($in_hash == $this->getActivationHash($user_id))){
			// Update the active flag in the database
			$this->User->saveField('status','active');

			// Let the user know they can now log in!
			$this->Session->setFlash('Your brand submissions have been activated.');
			$this->redirect('/');
		}
		// Activation failed, render ‘/views/user/activate.ctp’ which should tell the user.
	}
	
	/**
	* Creates an activation hash for the current user.
	*
	*	@param Void
	*	@return String activation hash.
	*/
	function getActivationHash($id=null){
		 if (!isset($id)) {
			return false;
		 }
		$this->User->id = $id;
		$user = $this->User->read();
		return substr(Security::hash(Configure::read('Security.salt') . $user['User']['created'] . date('Ymd')), 0, 8);
	}

	/*function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
		$countries = $this->User->Country->find('list');
		$this->set(compact('countries'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}*/
}
