<?php
class UsersController extends AppController {

	var $name = 'Users';
	//var $components = array('Auth','String','Session');
	//var $helpers = array('Javascript', 'Time', 'Form');
	var $uses = array('User','Forum.Topic','TwitterKit.TwitterKitUser'); //Taking out User makes the user model become unused
	
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
		
		$this->Auth->allow('login','logout','register','register_with_twitter','more_user_feed_data');
		$this->AjaxHandler->handle('hide_welcome');
	}
	
	/**
	 * Add an email field to be saved along with creation.
	 * @param 
	 * @return 
	 * 
	*/
	/*function beforeFacebookSave(){
		$this->Connect->authUser['User']['email'] = $this->Connect->user('email');
		
		return true; //Must return true or will not save.
	}*/
	
	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
	/*function beforeFacebookLogin($user){
		//Logic to happen before a facebook login
	}*/
	
	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
	/*function afterFacebookLogin(){
		//Logic to happen after successful facebook login.
		$this->redirect('/signup');
	}*/
	
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
		
		//Update the total counts
		/*$this->User->updateTotalInspirations($user['User']['id']);
		$this->User->updateTotalCollections($user['User']['id']);
		$this->User->updateTotalProducts($user['User']['id']);
		$this->User->updateTotalSources($user['User']['id']);*/
		//Update follow related counts
		//$this->User->updateTotalFollowCount($user['User']['id']);
		//$this->User->updateTotalFollowerCount($user['User']['id']);
		
		//Request data for the elements
		/*$userSources = $this->User->Source->userSources($user['User']['id']);
		$this->set(compact('userSources'));
		
		$userProducts = $this->User->Product->userProducts($user['User']['id'],10,'all');
		$this->set(compact('userProducts'));
		
		$userInspirations = $this->User->Inspiration->userInspirations($user['User']['id'],10,'all');
		$this->set(compact('userInspirations'));
		
		$userCollections = $this->User->Collection->userCollections($user['User']['id'],10,'all');
		$this->set(compact('userCollections'));
		
		$userUfos = $this->User->Ufo->userUfos($user['User']['id']);
		$this->set(compact('userUfos'));*/
		
		/*$wantedProductsTemp = $this->User->Ownership->getUserWants('Product',$user['User']['id']);
		$wantedProducts = array();
		//Find the full product details
		if(!empty($wantedProductsTemp)){
			foreach($wantedProductsTemp as $product){
				$wantedProducts[] = $this->User->Product->read(null,$product['Product']['id']);
			}	
		}
		$this->set(compact('wantedProducts'));
		
		$haveProductsTemp = $this->User->Ownership->getUserHaves('Product',$user['User']['id']);
		$haveProducts = array();
		if(!empty($haveProductsTemp)){
			foreach($haveProductsTemp as $product){
				$haveProducts[] = $this->User->Product->read(null,$product['Product']['id']);
			}
		}
		$this->set(compact('haveProducts'));*/
		
		//$user = $this->User->read(null,$user['User']['id']);
		$followers = $this->User->UserFollowing->findFollowers($user['User']['id'],5);
		$user_wants = $this->User->Ownership->getUserWantCount('Product',$user['User']['id']);
		$user_haves = $this->User->Ownership->getUserHaveCount('Product',$user['User']['id']);
		$this->set(compact('user_wants','user_haves','followers'));
		//$this->set('user', $this->User->read(null, $user['User']['id']));
		$this->set('user', $user);
		$this->set('string', $this->String);
	}
	
	/**
	 * Handles registering the user with social services (Twitter, Facebook)
	 * @param 
	 * @return 
	 * 
	*/
	function register(){
		$this->layout = 'clean';
		$this->set("title_for_layout","Register");
		
		//TWITTER OAUTH SETTINGS
		$linkOptions = array();
		if (!empty($this->params['named']['datasource'])) {
			$linkOptions['datasource'] = $this->params['named']['datasource'];
		}
		if (!empty($this->params['named']['authenticate'])) {
			$linkOptions['authenticate'] = $this->params['named']['authenticate'];
		}
		
        $this->set('linkOptions', $linkOptions);
	}
	
	/**
	 * Returns the feed data based on the offset passed for the logged in user
	 * @param offset
	 * @return 
	 * 
	*/
	function more_feed_data($offset=0){
		Configure::write ( 'debug', 0);
		$user_id = $this->Auth->user('id');
		//$user = $this->User->read(null,$user['User']['id']);
		if(!empty($user_id)){
			//Find all of the followed users (with details) for this user
			$following_user_ids = $this->User->getFollowingUserIds($user_id);
			$feed = $this->User->Feed->getUsersFollowingFeedData($following_user_ids,$offset);
			$this->set(compact('feed'));
		}else{
			$feed = null;
			$this->set(compact('feed'));
		}
	}
	
	
	/**
	 * Returns the feed data for a user passed
	 * @param user_id
	 * @param offset
	 * @return 
	 * 
	*/
	function more_user_feed_data($user_id=null,$offset=0){
		Configure::write ( 'debug', 2);
		if(!empty($user_id)){
			$feed = $this->User->Feed->getUserFeedDataDetails($user_id,$offset);
			$this->set(compact('feed'));
		}else{
			$feed = null;
			$this->set(compact('feed'));
		}
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
	 * Redirects the user to the forum login page. /forum/users/login
	 * @param 
	 * @return 
	 * 
	*/
	function login() {
		$this->redirect('/login');
	}
	
	/**
	 * Redirects the user to the forum logout page. /forum/users/logout
	 */
	function logout() {
		$this->redirect('/logout');
	}
	
	/**
	 * Handles showing staff favorites and allows users to find others
	 * @param 
	 * @return 
	 * 
	*/
	function find(){
		
	}
	
	/**
	 * Hides the welcome blurb that lives in the admin_moderate view
	 * @param 
	 * @return 
	 * 
	*/
	function hide_welcome(){
		if($this->RequestHandler->isAjax()) {
			$this->autoLayout = false;
			$this->autoRender = false;
			$response = array('success' => false);
			$this->User->id = $this->Auth->user('id');
			$this->User->saveField('hide_welcome',1);
			$this->AjaxHandler->response(true, 1);
			$this->AjaxHandler->respond();
			return;
		}
	}
	
	/**
	 * Handles registering a user with the OAuth callback from Twitter. 
	 * @param 
	 * @return 
	 * 
	*/
	function register_with_twitter() {
		//$this->layout = "close_popup";
		
		// check params
		if (empty($this->params['url']['oauth_token']) || empty($this->params['url']['oauth_verifier'])) {
			$this->flash(__('Invalid access.', true), ' / ', 5);
			return;
		}
		
		// get token
		$this->Twitter->setTwitterSource('twitter');
		$token = $this->Twitter->getAccessToken();
		
		//debug($this->Twitter->getAnywhereIdentity());
		
		if (is_string($token)) {
			$this->flash(__('Failed to get the access token.', true) . $token, ' / ', 5);
			return;
		}
		
		//create save data
		$data['User'] = array(
			'id' => $token['user_id'],
			'username' => $token['screen_name'],
			'password' => Security::hash($token['oauth_token']),
			'oauth_token' => $token['oauth_token'],
			'oauth_token_secret' => $token['oauth_token_secret'] //Access token
		);

		//Check to make sure the token is legit
		if(!empty($token['screen_name']) && !empty($token['user_id'])){
			//Find out if the user's email address is already in the system
			$userDetails = $this->Twitter->account_verify_credentials();
			//Save the session data so that we can use it in the sign up form.
			$this->Session->write('TwitterUserDetails',$userDetails);
			
			//Redirect to the signup page (This is handled by the popup unload method.)
			//$this->redirect(array('admin'=>false,'plugin'=>'forum','controller'=>'users','action'=>'signup'));
			
		}else{
			$this->flash(__('The Twitter authorization failed. Please try again later.', true), 'default', 'error-message');
			return;
		}
	}
	
	/**
	 * Handles registering a user with the OAuth callback from Twitter. 
	 * @param 
	 * @return 
	 * 
	*/
	function register_with_facebook() {
		
	}
	
	function twitter_logout(){
		$this->Twitter->deleteAuthorizeCookie();
	}
	
	/**
	 * Removes the Facebook auth cookie
	 * @param 
	 * @return 
	 * 
	*/
	function facebook_logout(){
		
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
