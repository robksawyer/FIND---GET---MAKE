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

class AppController extends Controller {
	
	var $components = array('Auth','Forum.AutoLogin','Session',
							'Cookie','RequestHandler','AjaxHandler', 
							'Forum.Toolbar','String',
							'TwitterKit.Twitter',
							'Facebook.Connect'
							);
	var $helpers = array('Form', 'Html', 'Time','Session',
						'Js' => array('Jquery'),
						'Forum.Cupcake', 'Forum.Decoda' => array(),
						'Popup.Popup'=>array('Jquery'),
						'TwitterKit.Twitter','Facebook.Facebook'
						);
	
	var $view = 'Theme';
	var $theme = 'default';
	
	var $uses = array('Forum.Topic');
	
	/**
	 * Before any Controller action
	 */
	public function beforeFilter() {
		
		//Keep banned users from logging in and nonactive users
		$this->Auth->userScope = array(
										'User.banned'=>0,
										'User.active'=>1
										);
		
		//You have to keep view open for the photo tags to work.
		$this->Auth->allow('home','display','index','view','find','collage','login','logout','key');
		$this->Auth->loginRedirect = array('plugin'=>'','controller' => 'users', 'action' => 'moderate','admin'=>true);
		$this->Auth->loginAction = '/login';
		$this->Auth->logoutAction = '/logout';
		//$this->Auth->logoutRedirect = '/';
		$this->Auth->autoRedirect = false;
		
		$this->AjaxHandler->handle('admin_hide_challenge');
		
		//Custom settings for AutoLogin component
		//http://bakery.cakephp.org/articles/milesj/2009/07/05/autologin-component-an-auth-remember-me-feature
		$this->AutoLogin->cookieName = 'TheSource';
		$this->AutoLogin->expires = '+1 month';

		// AutoLogin settings
		$this->AutoLogin->settings = array(
			'plugin' => 'forum',
			'controller' => 'users',
			'loginAction' => 'login',
			'logoutAction' => 'logout',
			'admin'=>false
		);
		
		/*
			TODO Set up a check to see if the user has hidden the challenge.
			* This'll involve adding a new database field that will log this. Or, you 
			* could use the deactivated Session key.
		*/
		$resetChallengeSession = false; //Show the challenge if it has been removed
		if($resetChallengeSession){
			$this->Session->write('Challenge.deactivated',false);
		}
		
		//Set the challenge Session. Note: The method is inside of app_controller.php
		$cTitle = $this->Session->read('Challenge.title');
		$checkTitle = $this->setChallengeSession();
		$cSlug = $this->Session->read('Challenge.slug');
		$deactivated = $this->Session->read('Challenge.deactivated');
		$this->set('challenge_deactivated',$deactivated);
		if(empty($cTitle) || empty($cSlug) || $checkTitle != $cTitle){
			if(empty($deactivated)){
				$this->set('challenge',$this->setChallengeSession());
			}
		}
		
		//FACEBOOK OAUTH SETTINGS
		$this->Connect->createUser = false;
		$facebookUser = $this->Connect->user();
		
		/** SET GLOBAL VARIABLES **/
		$this->set('facebookUser', $facebookUser);
		$this->set('authUser', $this->Auth->user());
		$this->set('string', $this->String);
	}
	
	/**
	 * This method sets up the challenge Session variables.
	 * @param 
	 * @return 
	 * 
	*/
	public function setChallengeSession(){
		$challenge = $this->findChallenge();
		if(!empty($challenge)){
			$this->Session->write('Challenge.title',$challenge['Topic']['title']);
			$this->Session->write('Challenge.slug',$challenge['Topic']['slug']);
			return $challenge;
		}else{
			//$this->Session->setFlash(__('The challenge could not be found.', true));
			return null;
		}
	}
	
	/**
	 * Finds the latest challenge topic in the forum.
	 * @param 
	 * @return 
	 * 
	*/
	public function findChallenge(){
		//ClassRegistry::init('Topic');
		$latestTopic = $this->Topic->findLatestTopic(2);
		return $latestTopic;
	}
	
	/**
	 * Hides the challenge header.
	 **/ 
	public function admin_hide_challenge(){
		Configure::write('debug', 0); //it will avoid any extra output
		if ($this->RequestHandler->isAjax()) {
			$this->autoLayout = false;
			$this->autoRender = false;
			
			$this->Session->delete('Challenge.title');
			$this->Session->delete('Challenge.slug');
			$this->Session->write('Challenge.deactivated',1);
			//$this->redirect($this->referer());
			$this->AjaxHandler->response(true,'deactivated');
			$this->AjaxHandler->respond();
			return;
		}
	}
	
	public function _autoLogin($user) {
		// $user contains the Auth session
	}
	
	public function isSlug($id = null){
		$numbers = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", " ");
		$slug = str_replace($numbers, '', $id);
		if(!empty($slug)){
			return true;
		}else{
			return false;
		}
	}
	
	public function toSlug($string) {
		return Inflector::slug(utf8_encode(strtolower($string)), '-');
	}
	
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
	
	public function uniqueName($str){
		
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
	
	
	public function cleanFileName( $str ) {
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
	
	
	public function getLetterOfDay($date=null){
		if(!isset($date)){
			$day = date("D");
		}else{
			$day = date("D", strtotime($date));
		}
		$letterOfDay = substr($day,0,1);
		return $letterOfDay;
	}
	
	public function getDayOfWeek($date=null){
		if(!isset($date)){
			//$day = date("l");
			$day = null;
		}else{
			$day = date("l", strtotime($date));
		}
		return $day;
	}
	
	/**
	 * This method verifies the multiple items with the same name don't get added.
	 * If an item with the same name is found. A session is set with a check count and the
	 * name. The user is then prompted to verify that they actually want to add the record.
	 * @param $model The current model
	 * @return Boolean
	 */ 
	public function verifyAddition($model = null){
		$checker = $this->Session->read('Check.count');
		$name = $this->Session->read('Check.name');
		$passed_check = true;
		if(empty($checker)){
			$check_item = $this->$model->findByName($this->data[$model]['name']);
			if(!empty($check_item)){
				$passed_check = false;
				$this->Session->write('Check.count', '1');
				$this->Session->write('Check.name', $this->data[$model]['name']);
			}else{
				$passed_check = true;
			}
		}else if($this->data[$model]['name'] != $name){
			$check_item = $this->$model->findByName($this->data[$model]['name']);
			if(!empty($check_item)){
				$passed_check = false;
				$this->Session->write('Check.count', '1');
				$this->Session->write('Check.name', $this->data[$model]['name']);
			}else{
				$passed_check = true;
			}
		}
		
		return $passed_check;
	}
	
	/**
	 * Clears the sessions set by the verifyAddition method.
	 */
	public function clearVerifySessions(){
		$this->Session->delete('Check.count');
		$this->Session->delete('Check.name');
	}
	
	/**
	 * Helper method to upload the attachments
	 * @param model The current model to attach the attachments to
	 * @param id The id of the current item you're editing
	 */
	
	public function uploadAttachments($model=null,$id = null){
		
		if(!empty($model)){
			$controller = Inflector::pluralize(strtolower($model));
		}else{
			$this->cakeError('You did not enter a model.');
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
	 * 			1.2 There was a bug overriding the currently saved attachments. T
	 * 			This has been fixed and now the current attachments are passed along and added to the final array.
	 */
	public function saveAttachments($url = null,$model=null,$current_attachments = null){
		
		if(!empty($model)){
			$plural_model = Inflector::pluralize(strtolower($model));
		}else{
			$this->cakeError('You did not enter a model.');
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
			$new_path = 'media/static/img/'.$plural_model.DS.$this->data['Attachment']['file']['name'];
			$new_small_path = 'media/filter/img/sml/'.$plural_model.DS.$withoutExt.'_small.'.$ext;
			$new_med_path = 'media/filter/img/med/'.$plural_model.DS.$withoutExt.'_med.'.$ext;
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
			$this->cakeError('You did not enter a model.');
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
	 * This method handles generating a random keycode for a attachment
	 * @param int id The attachment id
	 * @return 
	 * 
	*/
	function generateKeycode($id=null){
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid attachment', true));
			$this->redirect('/');
		}
		
		$keycode = $this->String->str_rand(8,'mixed');
		$keycode .= $id;
		
		return $keycode;
	}
	
	/**
	 * @param url: The URL to clean
	 */
	public function simplifyFileName($url = null){
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
