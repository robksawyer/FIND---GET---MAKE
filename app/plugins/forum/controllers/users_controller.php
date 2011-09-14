<?php
/** 
 * Cupcake - Users Controller
 *
 * @author 		Miles Johnson - www.milesj.me
 * @copyright	Copyright 2006-2009, Miles Johnson, Inc.
 * @license 	http://www.opensource.org/licenses/mit-license.php - Licensed under The MIT License
 * @link		www.milesj.me/resources/script/forum-plugin
 */
 
class UsersController extends ForumAppController {

	/**
	 * Models.
	 *
	 * @access public
	 * @var array
	 */
	public $uses = array('Forum.User');

	/**
	 * Components.
	 *
	 * @access public
	 * @var array
	 */
	public $components = array('Auth', 'Forum.AutoLogin', 'Email');
	
	/**
	 * Pagination.
	 *
	 * @access public   
	 * @var array      
	 */ 
	public $paginate = array(  
		'User' => array(
			'order' => 'User.username ASC',
			'limit' => 25,
			'contain' => false
		) 
	);
	
	/**
	 * Before filter.
	 * 
	 * @access public
	 * @return void
	 */
	public function beforeFilter() {
		parent::beforeFilter();
		
		$this->Auth->allow('index', 'forgot', 'login', 'logout', 'listing', 'profile', 'signup');
		
		$this->Auth->loginRedirect = array('plugin'=>'','controller' => 'users', 'action' => 'moderate','admin'=>false);
		$this->Auth->logoutRedirect = '/';
		
		if (isset($this->params['admin'])) {
			$this->Toolbar->verifyAdmin();
			$this->layout = 'admin';
		}
		
		$this->set('menuTab', 'users');
	}
	
	/**
	 * Redirect.
	 *
	 * @access public 
	 */
	public function index() {
		$this->Toolbar->goToPage();
	}
	
	/**
	 * Edit a users profile.
	 *
	 * @access public
	 */
	public function edit() {
		$this->set('title_for_layout','User Settings');
		$user_id = $this->Auth->user('id');
		$user = $this->User->get($user_id);
		
		// Form Processing
		if (!empty($this->data)) {
			$this->User->id = $user_id;
			$this->User->set($this->data);
			
			$errors = $this->User->invalidFields();
			$user_by_email = $this->User->find('first',array('conditions'=>array(
																				'email'=>mysql_real_escape_string($this->data['User']['email'])
																				))
																				);
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
				if($this->data['User']['url'] == "http://") $this->data['User']['url'] = '';
				if(!empty($this->data['User']['url'])){
					$this->data['User']['url'] = $this->cleanURL($this->data['User']['url']); //Clean the URL
				}

				$this->User->id = $user_id;
				
				//if ($this->User->save($this->data)){
				if ($this->User->save($this->data, false, array('email','password','url','about','gender','birthday','location','fullname', $this->User->columnMap['signature'], $this->User->columnMap['locale'], $this->User->columnMap['timezone']))) {
					$this->Session->setFlash(__d('forum', 'Your profile information has been updated!', true));

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
		
		//$this->Toolbar->pageTitle(__d('forum', 'Edit Profile', true));
	}
	
	/**
	 * Forgot credentials.
	 *
	 * @access public
	 */
	public function forgot() {
		$this->set('title_for_layout','Forgot Password');
		$this->layout = 'clean';
		
		if (!empty($this->data)) {
			if ($user = $this->User->forgotRetrieval($this->data)) {
				$this->Toolbar->resetPassword($user);
				
				$this->Session->setFlash(__d('forum', 'Your new password and information has been sent to your email.', true));
				unset($this->data['User']);
			}
		}
		
		//$this->Toolbar->pageTitle(__d('forum', 'Forgot Password', true));
	}
	
	/**
	 * Login.
	 *
	 * @access public
	 */
	public function login() {
		$this->set('title_for_layout','Login');
		$this->layout = 'clean';
		
		$user = $this->Auth->user();
		if($user && empty($this->data)){
			$this->User->login($user);
			$this->Session->delete('Forum');
			$this->redirect($this->Auth->loginRedirect);
		}
		if (!empty($this->data)) {
			$this->User->set($this->data);
			$this->User->action = 'login';
			
			if ($this->User->validates()) {
				if ($user = $this->Auth->user()) {
					$this->User->login($user);
					$this->Session->delete('Forum');
					$this->redirect($this->Auth->loginRedirect);
				}
			}
		}
		
		$this->Toolbar->pageTitle(__d('forum', 'Login', true));
	}
	
	/**
	 * Logout.
	 *
	 * @access public
	 */
	public function logout() {
		$this->Session->delete('Forum');
		$this->Session->destroy();
		$this->redirect($this->Auth->logout());
	}
	
	/**
	 * List of all users.
	 *
	 * @access public
	 */
	public function listing() {
		if (!empty($this->data)) {
			if (!empty($this->data['User']['username'])) {
				$this->paginate['User']['conditions']['User.username LIKE'] = '%'. $this->data['User']['username'] .'%';
			}
		}
		
		$this->Toolbar->pageTitle(__d('forum', 'User List', true));
		$this->set('users', $this->paginate('User'));
	}
	
	/**
	 * User profile.
	 *
	 * @access public
	 * @param int $id
	 */
	public function profile($username=null) {
		//Check to see if the id was passed
		if(is_int($username)){
			$id = $username;
			$user = $this->User->getProfile($id);
		}else{
			$userTemp = $this->User->find('first',array('conditions'=>array('username'=>$username)));
			$id = $userTemp['User']['id'];
			$user = $this->User->getProfile($id);
		}
		
		if (!empty($user)) {
			$this->loadModel('Forum.Topic');
			$this->set('topics', $this->Topic->getLatestByUser($id));
			$this->set('posts', $this->Topic->Post->getLatestByUser($id));
		}
		
		$this->set('title_for_layout','Profile: '.$user['User']['username']);
		//$this->Toolbar->pageTitle(__d('forum', 'User Profile', true), $user['User']['username']);
		$this->set('user', $user);
	}
	
	/**
	 * Report a user.
	 *
	 * @access public
	 * @param int $id
	 */
	public function report($id) {
		$this->loadModel('Forum.Report');
		
		$user = $this->User->get($id, array('id', 'username'));
		$user_id = $this->Auth->user('id');
		
		// Access
		$this->Toolbar->verifyAccess(array('exists' => $user));
		
		// Submit Report
		if (!empty($this->data)) {
			$this->data['Report']['user_id'] = $user_id;
			$this->data['Report']['item_id'] = $id;
			$this->data['Report']['itemType'] = 'user';
			
			if ($this->Report->save($this->data, true, array('item_id', 'itemType', 'user_id', 'comment'))) {
				$this->Session->setFlash(__d('forum', 'You have succesfully reported this user! A moderator will review this topic and take the necessary action.', true));
				unset($this->data['Report']);
			}
		}
		
		$this->Toolbar->pageTitle(__d('forum', 'Report User', true));
		$this->set('id', $id);
		$this->set('user', $user);
	}
	
	/**
	 * Signup.
	 *
	 * @access public
	 */
	public function signup() {
		$this->set('title_for_layout','Sign Up');
		$this->layout = 'clean';
		
		//Check to make sure the user hasn't already linked their account with Twitter
		$twitterUserDetails = $this->Session->read('Twitter.Details');
		$user = $this->User->find('first',array('conditions'=>array('twitter_id'=>$twitterUserDetails['id'])));
		if(!empty($user) && empty($this->data)){
			//Build an array of information to login with
			$user_data['User'] = array(
				'username' => $user['User']['username'],
				'password' => $user['User']['password']
			);
			$this->Auth->login($user_data);
			
			//Redirect to moderate page
			$this->redirect(array('admin'=>false,'plugin'=>'','controller'=>'users','action'=>'moderate'));
		}
		
		if(!empty($twitterUserDetails) && empty($this->data)){
			//Load the data array with Twitter data
			$this->data['User']['fullname'] = $twitterUserDetails['name'];
			$this->data['User']['username'] = $twitterUserDetails['screen_name'];
			$this->data['User']['location'] = $twitterUserDetails['location'];
		}
		
		if (!empty($this->data)) {
			$this->User->create();
			$this->User->set($this->data);
			$this->User->action = 'signup';
			
			if ($this->User->validates()) {
				$this->data['User']['username'] = strip_tags($this->data['User']['username']);
				$this->data['User']['fullname'] = strip_tags($this->data['User']['fullname']);
				$this->data['User']['location'] = strip_tags($this->data['User']['location']);
				$this->data['User']['password'] = $this->Auth->password($this->data['User']['newPassword']);
				$this->data['User'][$this->User->columnMap['locale']] = $this->Toolbar->settings['default_locale'];
				$this->data['User']['slug'] = $this->toSlug($this->data['User']['username']);
				
				if(empty($this->data['User']['twitter_id'])) $this->data['User']['twitter_id'] = 0;
				
				if ($this->User->save($this->data, false, array('username', 'email', 'location','fullname','twitter_id','password','slug', $this->User->columnMap['locale']))) {
					//$this->Session->setFlash(__d('forum', 'You have successfully signed up, you may now login and start your journey.', true));
					// Send email
					$message  = sprintf(__d('forum', 'Thank you for signing up on %s, your information is listed below', true), $this->Toolbar->settings['site_name']) .":\n\n";
					$message .= __d('forum', 'Username', true) .": ". $this->data['User']['username'] ."\n";
					$message .= __d('forum', 'Password', true) .": ". $this->data['User']['newPassword'] ."\n\n";
					$message .= __d('forum', 'Enjoy!', true);
					
					$this->Email->to = $this->data['User']['email'];
					$this->Email->from = $this->Toolbar->settings['site_name'] .' <'. $this->Toolbar->settings['site_email'] .'>';
					$this->Email->subject = $this->Toolbar->settings['site_name'] .' - '. __d('forum', 'Sign Up Confirmation', true);
					$this->Email->send($message);
					
					$this->Auth->login($this->data);
					unset($this->data['User']);
					$this->Session->setFlash(__('You have successfully created an account and may now start your journey.', true));
					$this->redirect(array('plugin'=>'','controller'=>'users','action'=>'moderate','admin'=>false));
					
					//$this->redirect(array('plugin'=>'','controller' => 'users', 'action' => 'login', 'admin' => false));
				}
			}
		}
		
		//$this->Toolbar->pageTitle(__d('forum', 'Sign Up', true));
	}
	
	/**
	 * Admin index!
	 *
	 * @access public
	 * @category Admin
	 */
	public function admin_index() {
		if (!empty($this->data)) {
			if (!empty($this->data['User']['username'])) {
				$this->paginate['User']['conditions']['User.username LIKE'] = '%'. $this->data['User']['username'] .'%';
			}
			
			if (!empty($this->data['User']['id'])) {
				$this->paginate['User']['conditions']['User.id'] = $this->data['User']['id'];
			}
		}

		$this->pageTitle = __d('forum', 'Manage Users', true);
		$this->set('users', $this->paginate('User'));
	}
	
	/**
	 * Edit a user.
	 *
	 * @access public
	 * @category Admin
	 * @param int $id
	 */
	public function admin_edit($id) {
		$user = $this->User->get($id);
		$this->Toolbar->verifyAccess(array('exists' => $user));
		
		// Form Processing
		if (!empty($this->data)) {
			$this->User->id = $id;
			
			if ($this->User->save($this->data, true, array('username', 'email', $this->User->columnMap['totalPosts'], $this->User->columnMap['totalTopics']))) {
				$this->redirect(array('controller' => 'users', 'action' => 'index', 'admin' => true));
			}
		} else {
			$this->data = $user;
		}
		
		$this->pageTitle = __d('forum', 'Edit User', true);
		$this->set('id', $id);
	}
	
	/**
	 * Reset users password.
	 *
	 * @access public
	 * @category Admin
	 * @param int $id
	 */
	public function admin_reset($id) {
		$user = $this->User->get($id);
		$this->Toolbar->verifyAccess(array('exists' => $user));
		
		if (!empty($user)) {
			$this->Toolbar->resetPassword($user, true);
			$this->Session->setFlash(sprintf(__d('forum', 'The password for %s has been reset!', true), '<strong>'. $user['User']['username'] .'</strong>'));
		}
		
		$this->redirect(array('controller' => 'users', 'action' => 'index', 'admin' => true));
	}
	
	/**
	 * Delets a user and all its content.
	 *
	 * @access public
	 * @category Admin
	 * @param int $id
	 */
	public function admin_delete($id) {
		$user = $this->User->get($id);
		$this->Toolbar->verifyAccess(array('exists' => $user));
		
		// Form Processing
		if (!empty($this->data['User']['delete'])) {
			$this->User->delete($id, true);

			$this->Session->setFlash(sprintf(__d('forum', 'The user %s and all of their associations have been deleted!', true), '<strong>'. $user['User']['username'] .'</strong>'));
			$this->redirect(array('controller' => 'users', 'action' => 'index', 'admin' => true));
		}
		
		$this->pageTitle = __d('forum', 'Delete User', true);
		$this->set('id', $id);
		$this->set('user', $user);
	}

}