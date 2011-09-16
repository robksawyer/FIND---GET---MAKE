<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * This is a placeholder class.
 * Create the same file in app/app_controller.php
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @link http://book.cakephp.org/view/957/The-App-Controller
 */

App::import('Lib', 'Facebook.FB');
class AppController extends Controller {
	
	/**
	 * Remove parent models.
	 *
	 * @access public
	 * @var array
	 */
	//var $uses = array(); //WARNING: Enabling this will cancel out all models from being loaded.
	
	/**
	 * Components.
	 *
	 * @access public
	 * @var array
	 */
	var $components = array('Acl','Auth'=>array(
									'userModel'=>'User',
									'authorize'=>'actions',
									'actionPath'=>'controllers/',
									'loginAction'=>array('controller'=>'users','action'=>'login'),
									'loginRedirect'=>array('controller'=>'users','action'=>'moderate'),
									'logoutAction'=>array('controller'=>'users','action'=>'logout'),
									'logoutRedirect'=>array('controller'=>'pages','action'=>'display','home'),
									'authError'=> 'You do not have permission to access the page you just selected.',
									'userScope'=>array('User.banned'=>0,'User.active'=>1),
									'autoRedirect'=>false,
									'allowedActions'=>array(
															'display','key','generateKeycode','users','tags',
															'getProfileData','find','getTags','getCount'
									)
									
								),'Security','RequestHandler','Session','AutoLogin','Cookie',
								'AjaxHandler', 'Forum.Toolbar','TwitterKit.Twitter','Facebook.Connect'
								);

	/**
	 * Helpers.
	 *
	 * @access public
	 * @var array
	 */
	var $helpers = array('Form', 'Html', 'Time','Text','Session','Js' => array('Jquery'),
						'Popup.Popup'=>array('Jquery'),'TwitterKit.Twitter','Facebook',
						'Forum.Cupcake', 'Forum.Decoda' => array(),'String'
						);
	
	/**
	 * Theming
	 * @param 
	 * @return 
	 * @var string
	 * 
	*/
	var $view = 'Theme';
	
	/**
	 * The theme currently used
	 * @param 
	 * @return 
	 * @var string
	 * 
	*/
	var $theme = 'default';
	
	
	var $authUser = null;
	var $facebookUser = null;
	var $twitterUser = null;
	
	/**
	 * Run auto login logic.
	 *
	 * @access public
	 * @param array $user - The logged in User
	 * @return void
	 */
	public function _autoLogin($user) {
		ClassRegistry::init('User')->login($user);
		
		$this->Session->delete('Forum');
		$this->Toolbar->initForum();
	}

	/**
	 * Refreshes the Auth to get new data.
	 *
	 * @access public
	 * @param string $field
	 * @param string $value
	 * @return void
	 */
	public function _refreshAuth($field = '', $value = '') {
		if (!empty($field) && !empty($value)) {
			$this->Session->write($this->Auth->sessionKey .'.'. $field, $value);
		} else {
			if (isset($this->User)) {
				$this->Auth->login($this->User->read(false, $this->Auth->user('id')));
			} else {
				$this->Auth->login(ClassRegistry::init('User')->findById($this->Auth->user('id')));
			}
		}
	}
	
	/**
	 * Before any Controller action
	 */
	public function beforeFilter() {
		parent::beforeFilter();
		
		//Facebook API Properties
		$this->Connect->createUser = false;
		
		//set special mobile rules here
		/*if ($this->RequestHandler->isMobile()) {
			$this->RequestHandler->enabled = false
		}*/
		
		if(isset($this->Auth)) {
			// Auth settings
			
			/*$this->Auth->mapActions(
				array(
					'create'=>array('add'),
					'read'=>array('view'),
					'update'=>array('edit'),
					'delete'=>array('delete')
				)
			);*/
			
			//$this->Auth->userModel = 'User';
			
			//Keep banned users from logging in and nonactive users
			/*$this->Auth->userScope = array(
											'User.banned'=>0,
											'User.active'=>1
											);*/
			
			//You have to keep view open for the photo tags to work.
			//$this->Auth->allow('home','display','index','view','find','collage','login','logout','key');
			//$this->Auth->authError = __('You do not have permission to access the page you just selected.', true);
			
			//$referer = $this->referer();
			/*if (empty($referer) || $referer == '/users/login' || $referer == '/admin/users/login' 
				|| $referer == '/login' || $referer == '/users/moderate') {
				$referer = '/';
			}*/
			
			/*if(empty($referer) || $referer == '/login' || $referer == '/users/login' || $referer == '/admin/users/login' || $referer == '/'){
				$login_referer = '/users/moderate';
			}else{
				$login_referer = $referer;
			}*/
			//$this->Auth->autoRedirect = false;
			//$this->Auth->loginRedirect = $login_referer;
			//$this->Auth->logoutRedirect = $referer;
			
			//Custom settings for AutoLogin component
			//http://bakery.cakephp.org/articles/milesj/2009/07/05/autologin-component-an-auth-remember-me-feature
			// AutoLogin settings
			$this->AutoLogin->settings = array(
				'admin'=>false,
				'plugin' => '',
				'controller' => 'users',
				'loginAction' => 'login',
				'logoutAction' => 'logout'
			);
			$this->AutoLogin->cookieName = 'FindGetMake';
			$this->AutoLogin->expires = '+1 month';
			
		}
		
		//Security overrides
		if(isset($this->Security)){
			// Must be disabled or AJAX calls fail
			$this->Security->validatePost = false;
			$this->Security->blackHoleCallback = 'submit_fail';
			if (!$this->RequestHandler->isAjax()) {
				//$this->Security->blackHole($this,'You are not authorized to process this request!');
				$this->Security->blackHole($this,'You are not authorized to process this request!');
			} else {
				if(strpos(env('HTTP_REFERER'), trim(env('HTTP_HOST'), '/')) === false) {
					$this->Security->blackHole($this,'Invalid referrer detected for this request!');
				}
			}
		}
		
		$this->Cookie->key = Configure::read('Security.salt');
		
		// Initialize
		$this->Toolbar->initForum();
		
		/** SET GLOBAL VARIABLES **/
		$facebookUser = $this->Connect->user();
		// get token
		$this->Twitter->setTwitterSource('twitter');
		$token = $this->Twitter->getAccessToken();
		$twitterUser = $this->Session->read('Twitter.Details');
		$authUser = $this->Auth->user();
		
		//debug($Facebook->api("/me/friends"));
		//Check to see about permissions
		$isAdmin = false;
		$isManager = false;
		$isUser = false;
		if(!empty($authUser)){
			if($authUser['User']['group_id']==1){
				$isAdmin = true;
			}else if($authUser['User']['group_id']==2){
				$isManager = true;
			}else{
				$isUser = true;
			}
		}
		$this->set(compact('authUser','facebookUser','twitterUser','isAdmin','isManager','isUser'));
		
		//Redirect the user to the previous page
		$referer = $this->Session->read('Auth.redirect');
		if($referer){
			$this->redirect($referer);
			exit;
		}
		
		//$this->Auth->allow('*');
	}
	
	/**
	 * This is the black hole method called by the Security component if tampering is found.
	 * @param 
	 * @return 
	 * 
	*/
	public function submit_fail(){
		//$this->Session->setFlash(__('Please, do not tamper with the forms.', true),'default',array('class'=>'error-message'));
		//$this->redirect('/');
	}
	
	/**
	 * Check page title and set for 1.3.
	 */
	public function beforeRender() {
		parent::beforeRender();
		if (isset($this->pageTitle) && !empty($this->pageTitle)) {
			$this->set('title_for_layout', $this->pageTitle);
		}
		
		$this->set('base_url', 'http://'.$_SERVER['SERVER_NAME'].Router::url('/'));
	}
	
	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
	protected function isSlug($id = null){
		$numbers = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", " ");
		$slug = str_replace($numbers, '', $id);
		if(!empty($slug)){
			return true;
		}else{
			return false;
		}
	}
	
	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
	public function toSlug($string) {
		return Inflector::slug(utf8_encode(strtolower($string)), '-');
	}
	
	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
	public function cleanURL($dirtyURL = null){
		$search = array(
							'/^http:\/\//',
							'/^https:\/\//'
							);
		$foundMatch = false;
		for($i=0;$i<count($search);$i++){
			if(preg_match($search[$i], $dirtyURL)) $foundMatch = true;
		}
		if(!$foundMatch){
			$cleanURL = "http://".$dirtyURL;
		}else{
			$cleanURL = $dirtyURL;
		}
		
		return $cleanURL;
	}
	
	protected function uniqueName($str){
		
		$ext_point = strripos($str,"."); // Changed to strripos to avoid issues with ‘.’ Thanks nico.
		if ($ext_point===false) return false;
		$ext = substr($str,$ext_point,strlen($str));
		$str = substr($str,0,$ext_point);
		$return='';
		for ($i=0;$i<7;$i++){
			$return .= chr(rand(97,122));
		}
		$return = "$str-$return-".time().$ext;
		return $return;	
	}
	
	
	protected function cleanFileName( $str ) {
		$cleaner = array();
		$cleaner[] = array('expression'=>"/[àáäãâª]/",'replace'=>"a");
		$cleaner[] = array('expression'=>"/[èéêë]/",'replace'=>"e");
		$cleaner[] = array('expression'=>"/[ìíîï]/",'replace'=>"i");
		$cleaner[] = array('expression'=>"/[òóõôö]/",'replace'=>"o");
		$cleaner[] = array('expression'=>"/[ùúûü]/",'replace'=>"u");
		$cleaner[] = array('expression'=>"/[ñ]/",'replace'=>"n");
		$cleaner[] = array('expression'=>"/[ç]/",'replace'=>"c");
		
		$str = strtolower($str);
		$ext_point = strripos($str,"."); // Changed to strripos to avoid issues with ‘.’ Thanks nico.
		if ($ext_point===false) return false;
		$ext = substr($str,$ext_point,strlen($str));
		$str = substr($str,0,$ext_point);
		foreach( $cleaner as $cv ) $str = preg_replace($cv["expression"],$cv["replace"],$str);
		return preg_replace("/[^a-z0-9-]/","_",$str).$ext;
	}
	
	
	protected function getLetterOfDay($date=null){
		if(!isset($date)){
			$day = date("D");
		}else{
			$day = date("D", strtotime($date));
		}
		$letterOfDay = substr($day,0,1);
		return $letterOfDay;
	}
	
	protected function getDayOfWeek($date=null){
		if(!isset($date)){
			//$day = date("l");
			$day = null;
		}else{
			$day = date("l", strtotime($date));
		}
		return $day;
	}
	
	public function str_rand($length = 8, $output = 'alphanum'){
		// Possible seeds
		$outputs['alpha'] = 'abcdefghijklmnopqrstuvwqyz';
		$outputs['numeric'] = '0123456789';
		$outputs['alphanum'] = 'abcdefghijklmnopqrstuvwqyz0123456789';
		$outputs['hexadec'] = '0123456789abcdef';
		$outputs['mixed'] = 'abcdefghijklmnopqrstuvwqyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_';
		
		// Choose seed
		if (isset($outputs[$output])) {
			$output = $outputs[$output];
		}

		// Seed generator
		list($usec, $sec) = explode(' ', microtime());
		$seed = (float) $sec + ((float) $usec * 100000);
		mt_srand($seed);

		// Generate
		$str = '';
		$output_count = strlen($output);
		for ($i = 0; $length > $i; $i++) {
			$str .= $output{mt_rand(0, $output_count - 1)};
		}

		return $str;
	}
	
	
	/**
	 * Helper method to upload the attachments. 
	 * @param model The current model to attach the attachments to
	 * @param id The id of the current item you're editing
	 */
	
	public function uploadAttachments($model=null,$id = null){
		
		if(!empty($model)){
			$controller = Inflector::pluralize(strtolower($model));
		}else{
			$this->log('You did not enter a model.');
		}
	
		//Find all current attachments and save them.
		$item = $this->$model->read(null,$id);
		$current_attachments = Set::extract('Attachment.{n}.id',$item);
		if(!empty($current_attachments)){
			$current_attachments = Set::sort($current_attachments,'{n}.{n}','desc');
		}
		
		//Check to see if the url contains http://. If it does, copy the file to the server,
		//and then upload it via the normal method.
		if(!empty($this->data['Attachment']['url']) && !empty($this->data['Attachment']['file']['name'])){
			unset($this->data['Attachment']['url']); //Choose the local file over the url
		}
		if(!empty($this->data['Attachment']['url'])){
			$this->saveAttachments($this->data['Attachment']['url'],$model,$current_attachments);	
		}else if(!empty($this->data['Attachment']['file']['name'])){
			//Save the local file
			unset($this->data['Attachment']['url']);
			$this->saveAttachments(null,$model,$current_attachments);
		}else{
			//debug($current_attachments);
			unset($this->data['Attachment']['title']);
			unset($this->data['Attachment']['source_url']);
			unset($this->data['Attachment']['url']);
			unset($this->data['Attachment']['file']);
			if(!empty($current_attachments)){
				$this->data['Attachment']['Attachment'] = $current_attachments; //Add the current attachments
			}
		}
	}
	
	/**
	 * Save attachments from a URL
	 * @param model: The current model
	 * @param folder: The folder for the final image
	 * @param url: The url of the image you're trying to download
	 * @param filename: The name you want the file renamed to
	 * @version 1.0
	 * 			1.1 Updated to check for a image name that already exists
	 * 			1.2 There was a bug overriding the currently saved attachments.
	 * 				- This has been fixed and now the current attachments are passed along and added to the final array.
	 *			1.3 
	 */
	protected function saveAttachments($url = null,$model=null,$current_attachments = null){
		
		if(!empty($model)){
			$controller = Inflector::pluralize(strtolower($model));
		}else{
			$this->log('You did not enter a model.');
		}
		
		if(empty($this->Attachment)){
			$current_model = $this->$model->Attachment;
		}else{
			$current_model = $this->Attachment;
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
			if ($current_model->validates()) {
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
			$small_path = $this->Uploader->resize(array('width' => 100, 'append' => '_small')); // Returns: /files/uploads/fileName_100_small.jpg
			$med_path = $this->Uploader->resize(array('height' => 300, 'append' => '_med'));
			
			$this->data['Attachment']['file']['title'] = $title;
			$this->data['Attachment']['file']['source_url'] = $source;
			
			//Check to see if the file name exists
			$checker_name = $this->cleanFileName($this->data['Attachment']['file']['name']);
			$aCheck = $current_model->findByName($checker_name);

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
			
			/*
				TODO Figure out how to get the last id of the attachment
			*/
			//Generate and create keycode
			//$keycode = $this->generateKeycode($lastID);
			//$this->$model->Attachment->saveField('keycode',$keycode);
			
			//Save all of the attachments and then attach the id
			$this->data['Attachment'] = $this->data['Attachment']['file'];
			unset($this->data['Attachment']['file']);
			
			$current_model->create();
			if($current_model->save($this->data['Attachment'])){
				$this->Session->setFlash(__('The attachment has been saved', true));
				$lastID = $current_model->getLastInsertId();
				unset($this->data['Attachment']);
				if(!empty($current_attachments)){
					$this->data['Attachment']['Attachment'] = $current_attachments; //Add the current attachments
					//$this->data['Attachment']['Attachment'] = array_reverse($this->data['Attachment']['Attachment']);
				}
				$this->data['Attachment']['Attachment'][] = $lastID;
			}else{
				$this->Session->setFlash(__('The attachment could not be saved. Please, try again.', true));
			}
		
		}else{
			$this->Session->setFlash(__('The attachment could not be uploaded. Please, try again.', true));
		}
	}
	
	/**
	 * This is the method used to add attachments
	 * @param id 
	 * @version 1.0
	 */
	public function add_attachment($id = null, $model = null){
	
		if(!empty($model)){
			$controller = Inflector::pluralize(strtolower($model));
			$name = strtolower($model);
		}else{
			$this->log('You did not enter a model.');
		}
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid '.$item, true));
			$this->redirect(array('controller'=>$controller,'action' => 'index'));
		}
		
		//Check to make sure it's a valid item
		$item = $this->$model->read(null, $id);
		if(empty($item) && empty($this->data)){
			$this->Session->setFlash(__('Invalid '.$item, true));
			$this->redirect(array('controller'=>$controller,'action' => 'index'));
		}
		
		if (!empty($this->data)) {
			
			//Upload the attachments
			$this->uploadAttachments($model,$controller,$id);

			//Check for a redirect variable
			if(!empty($this->data[$model]['redirect'])){
				$redirect = $this->data[$model]['redirect'];
				unset($this->data[$model]['redirect']);
			}

			if(!empty($this->data['Attachment'])){
				$id = $this->data[$model]['id'];

				if ($this->$model->Attachment->save($this->data)) {
					$this->Session->setFlash(__('The '.$name.' attachments has been saved', true));
					
					if(!empty($redirect)){
						$this->redirect($redirect);
					}else{
						$this->redirect(array('controller'=>$controller,'action' => 'view',$id));
					}
					
				} else {
					$this->Session->setFlash(__('The '.$name.' attachments could not be saved. Please, try again.', true));
				}

			}else{
				$this->Session->setFlash(__('You didn\'t add any attachments or the filetype is not valid. Try saving the file to your computer and trying again.', true));
				if(!empty($redirect)){
					$this->redirect($redirect);
				}
			}
		}
		
		$this->set(compact('controller','id','model','item'));
		$this->set($name, $this->$model->read(null, $id));
	}
	
	/**
	 * DEPRECATED: This has been moved into each item's controller
	 * This method handles generating a random keycode for a attachment
	 * @param int id The attachment id
	 * @return 
	 * 
	*/
	/*function generateKeycode($id=null){
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid attachment', true));
			$this->redirect('/');
		}
		
		$keycode = $this->String->str_rand(8,'mixed');
		$keycode .= $id;
		
		return $keycode;
	}*/
	
	/**
	 * @param url: The URL to clean
	 */
	protected function simplifyFileName($url = null){
		//Check to make sure that a period exists, three or four spaces from the end of the string.
		//If it does, move along, if it doesn't try to find the period and remove everything after it.
		//debug($this->data);
		$ext = $this->Uploader->ext($url);
	
		//Clean the extension
		//$this->Uploader->checkMimeType($ext,$type);
		$mime = $this->Uploader->mimeType($url);
		if(empty($mime)){
			//The image data isn't valid
			//Try to clean the path
			//$new_ext = preg_replace();
			$ext_data = explode('&',$ext);
			$new_ext = $ext_data[0]; //Use the first item because that should be the extension
			$ext_junk = str_replace($new_ext,'',$ext);
			$url = str_replace($ext_junk,'',$url); //Remove the junk
			//Check the mime again
			$mime = $this->Uploader->mimeType($url);
			
			if(empty($mime)){
				
				$ext_data = explode('?',$ext);
				$new_ext = $ext_data[0]; //Use the first item because that should be the extension
				$ext_junk = str_replace($new_ext,'',$ext);
				$url = str_replace($ext_junk,'',$url); //Remove the junk
				//Check the mime again
				$mime = $this->Uploader->mimeType($url);
				
				//Check again
				if(empty($mime)){
					$this->Session->setFlash(__('This is not a valid image file. Try saving the file to your hard drive and then uploading.', true));
					$url = '';
				}
			}
		}
		
		return $url;
	}
	
}