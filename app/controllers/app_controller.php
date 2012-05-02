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
									'autoRedirect'=>true,
									'allowedActions'=>array(
															'display','key','generateKeycode','users','tags',
															'getProfileData','find','getTags','getCount','blackHole'
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
						'Forum.Cupcake', 'Forum.Decoda' => array(),'String','Paginator','Minify'
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
		
		//Cookie settings
		//$this->Cookie->name = 'FindGetMake';
		//$this->Cookie->time =  '+1 month';  // or '1 hour'
		//$this->Cookie->path = '/find_get_make/preferences/';
		//$this->Cookie->domain = 'example.com';
		//$this->Cookie->secure = false;  //i.e. only sent if using secure HTTPS
		//$this->Cookie->key = Configure::read('Security.salt');
		
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
			
			//Custom settings for AutoLogin component
			//http://bakery.cakephp.org/articles/milesj/2009/07/05/autologin-component-an-auth-remember-me-feature
			// AutoLogin settings
			$this->AutoLogin->cookieName = 'FindGetMake';
			$this->AutoLogin->expires = '+1 month';
			$this->AutoLogin->settings = array(
				'controller' => 'Users',
				'loginAction' => 'login',
				'logoutAction' => 'logout'
			);
		}
		
		//Security overrides
		if(isset($this->Security)){
			// Must be disabled or AJAX calls fail
			$this->Security->validatePost = false;
			
			$this->Security->blackHoleCallback = '_blackhole';
			/*if(!$this->RequestHandler->isAjax()) {
				$this->Security->blackHole($this,'You are not authorized to process this request!');
			} else {
				if(strpos(env('HTTP_REFERER'), trim(env('HTTP_HOST'), '/')) === false) {
					$this->Security->blackHole($this,'Invalid referrer detected for this request!');
				}
			}*/
		}
		
		// Initialize
		$this->Toolbar->initForum();
		
		/** SET GLOBAL VARIABLES **/
		//$facebookUser = $this->Connect->user();
		$facebookUser = null;
		
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
		
		$apiToken = 'XXXXXX';
		/*
		 * {"type":"User","id":65955,"id_str":"65955","name":"Rob","username":"robksawyer","display_name":"Rob","profile_image_url":"http:\/\/assets.svpply.com.s3.amazonaws.com\/portraits\/65955.png?u=1317833462","profile_image_small_url":"http:\/\/assets.svpply.com.s3.amazonaws.com\/avatars\/65955.png?u=1317833462","description":null,"url":"","date_created":"2011-08-12 19:56:46","location":null,"twitter_id":1679511,"facebook_id":27402804,"product_grabs_count":2,"product_following_count":2,"user_followers_count":2,"user_following_count":21,"store_following_count":0,"search_following_count":0,"count_sets":0}
		 */ 
		$json_user_data = $this->getJSONUserData($authUser);
		$this->set(compact('authUser','facebookUser','twitterUser','isAdmin','isManager','isUser','apiToken','json_user_data'));
		
		//Redirect the user to the previous page
		/*$referer = $this->Session->read('Auth.redirect');
		if($referer){
			$this->redirect($referer);
			exit;
		}*/
		
		//$this->Auth->allow('*');
	}
	
	/**
	 * Returns a JSON object that contains the user data
	 * @param Array authUser The logged in user
	 * @return 
	 * 
	*/
	public function getJSONUserData($authUser){
		if(empty($authUser['User']['fullname'])){
			$display_name = $authUser['User']['username'];
		}else{
			$display_name = $authUser['User']['fullname'];
		}
		if(empty($authUser['User']['attachment_id'])){
			$profile_image_url = $authUser['User']['profile_image_url'];
			$small_profile_image_url = $authUser['User']['profile_image_url'];
		}else{
			//Get the user image url from attachment id
			//$profile_image_url = $this->Attachment->getProfileImageURL($authUser['User']['attachment_id']); 
			//$small_profile_image_url = $this->Attachment->getSmallProfileImageURL($authUser['User']['attachment_id']);
			/*
				TODO Add the full url to the attachment on add.
			*/
			$profile_image_url = "";
			$small_profile_image_url = "";
		}
		if(!empty($authUser)){
			//Build a json user object for the view
			$json_user_data = array(
				'type'=>'User',
				'id'=>$authUser['User']['id'],
				'id_str'=>'"'.$authUser['User']['id'].'"',
				'name'=>$authUser['User']['fullname'],
				'username'=>$authUser['User']['username'],
				'display_name'=>$display_name,
				'profile_image_url'=>$profile_image_url,
				'profile_image_small_url'=>$small_profile_image_url,
				'about'=>$authUser['User']['about'],
				'url'=>$authUser['User']['url'],
				'date_created'=>$authUser['User']['created'],
				'location'=>$authUser['User']['location'],
				'twitter_id'=>$authUser['User']['twitter_id'],
				'facebook_id'=>$authUser['User']['facebook_id'],
				'products_stored_count'=>$authUser['User']['totalProducts'],
				'user_followers_count'=>$authUser['User']['totalFollowers'],
				'user_following_count'=>$authUser['User']['totalUsersFollowing'],
				'total_collections'=>$authUser['User']['totalCollections'],
				'total_inspirations'=>$authUser['User']['totalInspirations'],
				'total_sources'=>$authUser['User']['totalSources'],
				'total_products_found'=>$authUser['User']['totalProducts']
			);
			$json_user_data = json_encode($json_user_data);
		}else{
			$json_user_data = "";
			$json_user_data = json_encode($json_user_data);
		}
		return $json_user_data;
	}
	
	/**
	* Unified handler for black-holed requests.
	*
	* @param string $error Error type passed automatically.
	*/
	function blackHole($error) {
		switch ($error) {
			case 'secure':
				$this->redirect('https://' . env('SERVER_NAME') . env('REQUEST_URI'));
				break;
			
			case 'login':
				// do something else
				break;
		
			default:
				// do something else
				$this->Session->setFlash(__($error,true),'default',array('class'=>'error-message'));
				//$error = null;
				//$this->redirect($this->Auth->loginAction);
				break;
		}
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
	
	/**
	 * Generates a unique string
	 * @param 
	 * @return 
	 * 
	*/
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
	
	/**
	 * Generates a unique name for files
	 * @param String append: What to append to the front
	 * @param Int id: A unique id to append
	 * @param String ext: The file extension
	 * @return 
	 * 
	*/
	protected function uniqueFilename($append,$id,$ext){
		//$return = uniqid($this->randomPrefix(3)).$id.'.'.$ext;
		$return = strtolower($append).$this->randomPrefix(3).$id.'.'.$ext;
		return $return;	
	}
	
	/**
	 * Generates a random number length 
	 * @param Int length The length you need the random number
	 * @return 
	 * 
	*/
	protected function randomPrefix($length) { 
		$random= "";
		srand((double)microtime()*1000000);
		$data = "012345678934589724592458735";
		for($i = 0; $i < $length; $i++) { 
			$random .= substr($data, (rand()%(strlen($data))), 1); 
		}
		return $random; 
	}
	
	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
	protected function cleanFileName( $str , $ext) {
		$cleaner = array();
		$cleaner[] = array('expression'=>"/[àáäãâª]/",'replace'=>"a");
		$cleaner[] = array('expression'=>"/[èéêë]/",'replace'=>"e");
		$cleaner[] = array('expression'=>"/[ìíîï]/",'replace'=>"i");
		$cleaner[] = array('expression'=>"/[òóõôö]/",'replace'=>"o");
		$cleaner[] = array('expression'=>"/[ùúûü]/",'replace'=>"u");
		$cleaner[] = array('expression'=>"/[ñ]/",'replace'=>"n");
		$cleaner[] = array('expression'=>"/[ç]/",'replace'=>"c");
		
		$str = strtolower($str);
		$str = ereg_replace("[^A-Za-z0-9]", "", $str ); //Strip non-alpha chars
		foreach( $cleaner as $cv ) $str = preg_replace($cv["expression"],$cv["replace"],$str);
		return preg_replace("/[^a-z0-9-]/","_",$str).$ext;
	}
	
	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
	protected function getLetterOfDay($date=null){
		if(!isset($date)){
			$day = date("D");
		}else{
			$day = date("D", strtotime($date));
		}
		$letterOfDay = substr($day,0,1);
		return $letterOfDay;
	}
	
	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
	protected function getDayOfWeek($date=null){
		if(!isset($date)){
			//$day = date("l");
			$day = null;
		}else{
			$day = date("l", strtotime($date));
		}
		return $day;
	}
	
	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
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
	 * @param model_id The id of the current item you're editing
	 */
	
	public function uploadAttachments($model=null,$model_id = null){
		
		if(!empty($model)){
			$controller = Inflector::pluralize(strtolower($model));
		}else{
			$this->log('You did not enter a model.');
		}
	
		//Find all current attachments and save them.
		$item = $this->$model->read(null,$model_id);
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
			$this->saveAttachments($this->data['Attachment']['url'],$model,$model_id,$current_attachments);	
		}else if(!empty($this->data['Attachment']['file']['name'])){
			//Save the local file
			unset($this->data['Attachment']['url']);
			$this->saveAttachments(null,$model,$model_id,$current_attachments);
		}else{
			//debug($current_attachments);
			unset($this->data['Attachment']['title']);
			unset($this->data['Attachment']['source_url']);
			unset($this->data['Attachment']['url']);
			unset($this->data['Attachment']['file']);
			if(!empty($current_attachments)){
				$this->data['Attachment'] = $current_attachments; //Add the current attachments
			}
		}
	}
	
	/**
	 * Save attachments from a URL
	 * @param url: The url of the image you're trying to download
	 * @param model: The current model
	 * @param model_id: The current model id
	 * @param current_attachments: The current attachments for the item
	 * @version 1.0
	 * 			1.1 Updated to check for a image name that already exists
	 * 			1.2 There was a bug overriding the currently saved attachments.
	 * 				- This has been fixed and now the current attachments are passed along and added to the final array.
	 *			1.3 
	 */
	protected function saveAttachments($url = null,$model=null,$model_id=null,$current_attachments = null){
		Configure::write('debug',0);
		if(!empty($model)){
			$controller = Inflector::pluralize(strtolower($model));
		}else{
			CakeLog::write('error','BOOKMARKLET::You did not enter a model.');
		}
		if(empty($this->Attachment)){
			$current_model = $this->$model->Attachment;
		}else{
			$current_model = $this->Attachment;
		}
		//debug($this->data);
		/*[Attachment] => Array
		        (
		            [title] => 
		            [source_url] => 
		            [file] => Array
		                (
		                    [name] => Screen shot 2011-08-12 at 12.57.35 PM.jpg
		                    [type] => image/jpeg
		                    [tmp_name] => /Applications/MAMP/tmp/php/phpOzN1dc
		                    [error] => 0
		                    [size] => 104359
		                )

		        )*/
		
		//Clean the image url passed
		if(!empty($url)){
			/*
				TODO Explode the periods in the name and check to see which is a valid extension. Remove the rest and then use the name.
			*/
			//$this->data['Attachment']['url'] = $this->simplifyFileName(trim($url));
			$this->data['Attachment']['url'] = trim($url);
			$url = $this->data['Attachment']['url'];
			if($url){
				unset($this->data['Attachment']['url']);
				
				//Save a local copy
				//This allows links like http://www.aandgmerch.com/index.php?image=5279 to work
				App::import('Core', 'HttpSocket'); 
				$HttpSocket = new HttpSocket();
				$results = $HttpSocket->get($url);
				$contentsMapping=array(
					"image/gif" => "gif",
					"image/jpeg" => "jpeg",
					"image/pjpeg" => "jpeg",
					"image/x-png" => "png",
					"image/jpg" => "jpg",
					"image/png" => "png",
					"image/tif" => "tif",
					"image/tiff" => "tiff",
					"image/x-tif" => "tif",
					"image/x-tiff" => "tiff"
				);
				$repsonse = $HttpSocket->response;
				$contentType = trim($HttpSocket->response['header']['Content-Type']); //Parse the content-type
				//debug($headers);
				//$contentType = trim($headers[1]);
				$contentType = str_replace(" ","",$contentType); //Remove whitespaces
				$contentType = str_replace("'","",$contentType); //Remove rogue quotes
				$contentType = str_replace('"',"",$contentType); //Remove rogue quotes
				$contentType = preg_replace("/[!<>@&\s0-9_]/","", $contentType);
				if(!empty($contentType)){
					$ext = $contentsMapping["$contentType"];
					if(empty($ext)){
						CakeLog::write('error',"BOOKMARKLET::There was an error finding the image extension.");
						return false;
					}
				}else{
					CakeLog::write('error',"BOOKMARKLET::There was an error finding the content type in the headers: <pre>".$headers."</pre>");
					return false;
				}
				
				$full_path = 'media'.DS.'transfer'.DS.'img'.DS.'temp'.DS;
				$external_path = Router::url(DS.$full_path,true);
				$tmp_image_name = $this->randomPrefix(5).'.'.$ext;
				$file = new File(WWW_ROOT.$full_path.$tmp_image_name,"w", true);
				if($file->writable()){
					$file->write($results);
				}else{
					CakeLog::write('error',"BOOKMARKLET::The file isn't writable.");
					return false;
				}
				$file->close();
				$target_file_path = $external_path.$tmp_image_name;
				
				//Save the file from the url
				$filename = basename($target_file_path);
				//debug($target_file_path);
				$data = $this->Uploader->importRemote($target_file_path,array('name'=>$filename));
				CakeLog::write('debug',"<pre>".var_dump($data)."</pre>");
				if(!empty($data)){
					$file->delete(); //Delete the file because it's no longer needed
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
				}else{
					
					return false;
				}
			
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
			if($data['width'] > $data['height']){
				$small_path = $this->Uploader->resize(array('width' => 132, 'append' => '_small')); // Returns: /files/uploads/fileName_100_small.jpg
				$med_path = $this->Uploader->resize(array('width' => 250, 'append' => '_med'));
			}else{
				$small_path = $this->Uploader->resize(array('height' => 132, 'append' => '_small')); // Returns: /files/uploads/fileName_100_small.jpg
				$med_path = $this->Uploader->resize(array('height' => 250, 'append' => '_med'));
			}
			
			$this->data['Attachment']['file']['title'] = $title;
			$this->data['Attachment']['file']['source_url'] = $source;
			
			//Check to see if the file name exists
			if(empty($ext)) $ext = $this->Uploader->ext($this->data['Attachment']['file']['path']); //Returns just the extension
			//Generate a random key for the file name 
			//$this->data['Attachment']['file']['name'] = $this->cleanFileName($this->data['Attachment']['file']['name'],$ext);
			$this->data['Attachment']['file']['name'] = $this->uniqueFileName($model,$model_id,$ext);
			$withoutExt = preg_replace("/\\.[^.\\s]{3,4}$/", "", $this->data['Attachment']['file']['name']); //Refresh it
			
			/*$aCheck = $current_model->findByName($this->data['Attachment']['file']['name']);
			if(empty($aCheck)){
				$this->data['Attachment']['file']['name'] = $this->cleanFileName($this->data['Attachment']['file']['name']);
			}else{
				$this->data['Attachment']['file']['name'] = $this->cleanFileName($this->data['Attachment']['file']['name']);
				$this->data['Attachment']['file']['name'] = $this->uniqueName($this->data['Attachment']['file']['name']);
			}*/
			
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
			$this->data['Attachment']['model'] = $model;
			$this->data['Attachment']['model_id'] = $model_id;
			unset($this->data['Attachment']['file']);
			
			$current_model->create();
			if($current_model->save($this->data['Attachment'])){
				$this->Session->setFlash(__('The attachment has been saved', true));
				$lastID = $current_model->getLastInsertId();
				unset($this->data['Attachment']);
				if(!empty($current_attachments)){
					$this->data['Attachment'] = $current_attachments; //Add the current attachments
					//$this->data['Attachment']['Attachment'] = array_reverse($this->data['Attachment']['Attachment']);
				}
				$this->data['Attachment'][] = $lastID;
			}else{
				//$this->Session->setFlash(__('The attachment could not be saved. Please, try again.', true));
			}
		
		}else{
			//$this->Session->setFlash(__('The attachment could not be uploaded. Please, try again.', true));
		}
	}
	
	/**
	 * This is the method used to add attachments
	 * @param model: The model to add an attachment to
	 * @param model_id: The model id of the model
	 * @version 1.0
	 */
	public function add_attachment($model_id = null, $model = null){
	
		if(!empty($model)){
			$controller = Inflector::pluralize(strtolower($model));
			$name = strtolower($model);
		}else{
			$this->log('You did not enter a model.');
		}
		
		if (!$model_id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid '.$model, true));
			$this->redirect(array('controller'=>$controller,'action' => 'index'));
		}
		
		//Check to make sure it's a valid item
		$item = $this->$model->read(null, $model_id);
		if(empty($item) && empty($this->data)){
			$this->Session->setFlash(__('Invalid '.$model, true));
			$this->redirect(array('controller'=>$controller,'action' => 'index'));
		}
		
		if (!empty($this->data)) {
			
			//Upload the attachments
			$this->uploadAttachments($model,$model_id);

			//Check for a redirect variable
			if(!empty($this->data[$model]['redirect'])){
				$redirect = $this->data[$model]['redirect'];
				unset($this->data[$model]['redirect']);
			}

			if(!empty($this->data['Attachment'])){
				$model_id = $this->data[$model]['id'];

				if ($this->$model->Attachment->save($this->data)) {
					$this->Session->setFlash(__('The '.$name.' attachments has been saved', true));
					
					if(!empty($redirect)){
						$this->redirect($redirect);
					}else{
						$this->redirect(array('controller'=>$controller,'action' => 'view',$model_id));
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
		$id = $model_id;
		$this->set(compact('controller','id','model','item'));
		$this->set($name, $this->$model->read(null, $model_id));
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