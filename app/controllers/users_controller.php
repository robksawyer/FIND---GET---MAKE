<?php
class UsersController extends AppController {

	var $name = 'Users';
	
	/**
	 * Models.
	 *
	 * @access public
	 * @var array
	 */
	//var $uses = array('User','Forum.Topic','TwitterKit.TwitterKitUser');
	
	/**
	 * Components.
	 *
	 * @access public
	 * @var array
	 */
	var $components = array('Email','Search.Prg','Uploader.Uploader');
	
	var $paginate = array(
		'User' => array(
			'limit' => 20,
			'order' => 'User.username ASC',
			'contain'=>false
		),
	);
	
	/**
	 * Before filter.
	 * 
	 * @access public
	 * @return void
	 */
	public function beforeFilter() {
		parent::beforeFilter();
		
		$this->Auth->allowedActions = array('more_user_feed_data', 'forgot', 'listing', 'profile','getAvatar',
											'signup','login','logout','register','register_with_twitter','register_with_facebook',
											'twitter_logout','facebook_logout','hide_welcome','staff_favorites'
											);
		
		/*$this->Auth->allow('login','logout','register','register_with_twitter','register_with_facebook',
							'more_user_feed_data', 'forgot', 'listing','twitter_logout','facebook_logout', 
							'profile', 'signup','getAvatar','hide_welcome'
							);*/
		$this->AjaxHandler->handle('hide_welcome');
		
		/*if (isset($this->params['admin'])) {
			$this->Toolbar->verifyAdmin();
			$this->layout = 'admin';
		}*/
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
	
	/**************** BORROWED FROM CUPCAKE ************************/
	/**
	 * Redirect.
	 *
	 * @access public 
	 */
	public function index() {
		$this->Toolbar->goToPage();
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
				
				$this->Session->setFlash(__('Your new password and information has been sent to your email.', true));
				unset($this->data['User']);
			}
		}
		
		//this->Toolbar->pageTitle(__('Forgot Password', true));
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
		
		//$this->Toolbar->pageTitle(__('Login', true));
	}
	
	/**
	 * Logout.
	 *
	 * @access public
	 */
	public function logout() {
		$this->Session->delete('Forum');
		if($this->Session->check('TwitterUserDetails')){
			$this->Session->delete('TwitterUserDetails');
		}
		if($this->Session->check('Challenge')){
			$this->Session->delete('Challenge');
		}
		if($this->Session->check('User')) {
			$this->Session->delete('User');
		}
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
		
		$this->Toolbar->pageTitle(__('User List', true));
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
		if(intval($username)>0){
			$id = intval($username);
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
			
			//Check for a local avatar details
			if(!empty($user['User']['attachment_id'])){
				$avatar = $this->User->Attachment->getAvatar($user['User']['attachment_id'],$user['User']['id']);
			}else{
				$avatar = false;
			}
			$this->set('avatar',$avatar);
			
		}
		
		$this->set('title_for_layout','Profile: '.$user['User']['username']);
		//$this->Toolbar->pageTitle(__('User Profile', true), $user['User']['username']);
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
				$this->Session->setFlash(__('You have succesfully reported this user! A moderator will review this topic and take the necessary action.', true));
				unset($this->data['Report']);
			}
		}
		
		$this->Toolbar->pageTitle(__('Report User', true));
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
		$twitterUserDetails = $this->Session->read('TwitterUserDetails');
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
					//$this->Session->setFlash(__('You have successfully signed up, you may now login and start your journey.', true));
					// Send email
					$message  = sprintf(__('Thank you for signing up on %s, your information is listed below', true), $this->Toolbar->settings['site_name']) .":\n\n";
					$message .= __('Username', true) .": ". $this->data['User']['username'] ."\n";
					$message .= __('Password', true) .": ". $this->data['User']['newPassword'] ."\n\n";
					$message .= __('Enjoy!', true);
					
					$this->Email->to = $this->data['User']['email'];
					$this->Email->from = $this->Toolbar->settings['site_name'] .' <'. $this->Toolbar->settings['site_email'] .'>';
					$this->Email->subject = $this->Toolbar->settings['site_name'] .' - '. __('Sign Up Confirmation', true);
					$this->Email->send($message);
					
					$this->Auth->login($this->data);
					unset($this->data['User']);
					$this->Session->setFlash(__('You have successfully created an account and may now start your journey.', true));
					$this->redirect(array('plugin'=>'','controller'=>'users','action'=>'moderate','admin'=>false));
					
					//$this->redirect(array('plugin'=>'','controller' => 'users', 'action' => 'login', 'admin' => false));
				}
			}
		}
		
		//$this->Toolbar->pageTitle(__('Sign Up', true));
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

		$this->pageTitle = __('Manage Users', true);
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
		
		$this->pageTitle = __('Edit User', true);
		$this->set('id', $id);
	}
	
	/**
	 * Reset users password.
	 *
	 * @access public
	 * @category Admin
	 * @param int $id
	 */
	public function reset($id) {
		$user = $this->User->get($id);
		$this->Toolbar->verifyAccess(array('exists' => $user));
		
		if (!empty($user)) {
			$this->Toolbar->resetPassword($user, true);
			$this->Session->setFlash(sprintf(__('The password for %s has been reset!', true), '<strong>'. $user['User']['username'] .'</strong>'));
		}
		
		$this->redirect(array('controller' => 'users', 'action' => 'index', 'admin' => false));
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

			$this->Session->setFlash(sprintf(__('The user %s and all of their associations have been deleted!', true), '<strong>'. $user['User']['username'] .'</strong>'));
			$this->redirect(array('controller' => 'users', 'action' => 'index', 'admin' => true));
		}
		
		$this->pageTitle = __('Delete User', true);
		$this->set('id', $id);
		$this->set('user', $user);
	}
	/**************** END BORROWED FROM CUPCAKE ************************/
	
	/**
	 * Handles registering the user with social services (Twitter, Facebook)
	 * @param 
	 * @return 
	 * 
	*/
	public function register(){
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
	 * Handles registering a user with the OAuth callback from Twitter. 
	 * @param 
	 * @return 
	 * 
	*/
	public function register_with_twitter() {
		Controller::loadModel('TwitterKit.TwitterKitUser');
		
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
	public function register_with_facebook() {
		
	}
	
	public function twitter_logout(){
		$this->Twitter->deleteAuthorizeCookie();
	}
	
	/**
	 * Removes the Facebook auth cookie
	 * @param 
	 * @return 
	 * 
	*/
	public function facebook_logout(){
		
	}
	
	/**
	 *  User moderation panel
	 *
	 * @access public
	 * @category Admin
	 * @param int $id
	 */
	public function moderate() {
		$this->User->recursive = 2;
		$user = $this->Auth->user();

		if (!$user['User']['id']) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		
		$user = $this->User->getProfile($user['User']['id']);

		if (!empty($user)) {
			//$this->loadModel('Forum.Topic');
			Controller::loadModel('Topic');
			$this->set('topics', $this->Topic->getLatestByUser($user['User']['id']));
			$this->set('posts', $this->Topic->Post->getLatestByUser($user['User']['id']));
		}
		
		//Check for a local avatar details
		if(!empty($user['User']['attachment_id'])){
			$avatar = $this->User->Attachment->getAvatar($user['User']['attachment_id'],$user['User']['id']);
		}else{
			$avatar = false;
		}
		$this->set('avatar',$avatar);
		
		//$user = $this->User->read(null,$user['User']['id']);
		$this->User->UserFollowing->recursive = 1;
		$followers = $this->User->UserFollowing->findFollowers($user['User']['id'],5);
		$this->User->Ownership->recursive = 1;
		$user_wants = $this->User->Ownership->getUserWantCount('Product',$user['User']['id']);
		$user_haves = $this->User->Ownership->getUserHaveCount('Product',$user['User']['id']);
		$this->set(compact('user_wants','user_haves','followers'));
		//$this->set('user', $this->User->read(null, $user['User']['id']));
		$this->set('user', $user);
		$this->set('string', $this->String);
	}
	
	
	/**
	 *  User moderation panel
	 *
	 * @access public
	 * @category Admin
	 * @param int $id
	 */
	public function admin_moderate() {
		$this->User->recursive = 2;
		$user = $this->Auth->user();
	
		if (!$user['User']['id']) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		
		$user = $this->User->getProfile($user['User']['id']);

		if (!empty($user)) {
			//$this->loadModel('Forum.Topic');
			Controller::loadModel('Topic');
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
		
		//Check for a local avatar details
		if(!empty($user['User']['attachment_id'])){
			$avatar = $this->User->Attachment->getAvatar($user['User']['attachment_id'],$user['User']['id']);
		}else{
			$avatar = false;
		}
		$this->set('avatar',$avatar);
		
		//$user = $this->User->read(null,$user['User']['id']);
		$this->User->UserFollowing->recursive = 1;
		$followers = $this->User->UserFollowing->findFollowers($user['User']['id'],5);
		$this->User->Ownership->recursive = 1;
		$user_wants = $this->User->Ownership->getUserWantCount('Product',$user['User']['id']);
		$user_haves = $this->User->Ownership->getUserHaveCount('Product',$user['User']['id']);
		$this->set(compact('user_wants','user_haves','followers'));
		//$this->set('user', $this->User->read(null, $user['User']['id']));
		$this->set('user', $user);
		$this->set('string', $this->String);
	}
	
	
	/**
	 * Returns the feed data based on the offset passed for the logged in user
	 * @param offset
	 * @return 
	 * 
	*/
	public function more_feed_data($offset=0){
		Configure::write ( 'debug', 0);
		$this->autoLayout = true;
		$this->autoRender = true;
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
	public function more_user_feed_data($user_id=null,$offset=0){
		Configure::write ( 'debug', 0);
		$this->autoLayout = true;
		$this->autoRender = true;
		//$this->render('more_user_feed_data', 'ajax');
		if(!empty($user_id)){
			$feed = $this->User->Feed->getUserFeedDataDetails($user_id,$offset);
			$this->set(compact('feed'));
		}else{
			$feed = null;
			$this->set(compact('feed'));
		}
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
	public function hide_welcome(){
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
	
	/**
	 * Finds the current staff favorites
	 * @param 
	 * @return Array An array of the users liked by the staff.
	 * 
	*/
	public function staff_favorites(){
		return $this->User->getStaffFavorites();
	}
	
	/**
	 * Set a user as a staff favorite.
	 * @param 
	 * @return 
	 * 
	*/
	public function admin_set_staff_favorite(){
		
	}
	
	/**
	 * Removes a user from the staff favorite list
	 * @param 
	 * @return 
	 * 
	*/
	public function admin_remove_staff_favorite(){
		
	}
	
}
