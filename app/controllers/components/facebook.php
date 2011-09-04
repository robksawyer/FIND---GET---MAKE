<?php
/*
 * Name : facebook.php
 * Cakephp Component to integrate with Facebook
 * Copyright (C) 2011,	Chilarai Mushahary.
 * Write to me at : chilly5476@gmail.com 
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.	 See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.	 If not, see <http://www.gnu.org/licenses/>.
 *
*/
App::import('Vendor','facebook',array('file'=>'src/facebook.php'));
/* Initialise session, check session and get login/logout url*/

function init() {
	$facebook = new Facebook(array(
		'appId'=> Configure::read('Facebook.appId'),
		'secret' => Configure::read('Facebook.secret'),
		'cookie' => true,
	));
	$session = $facebook->getSession();
	$me = null;
	// Session based API call.
	if($session) {
		try {
			$uid = $facebook->getUser();
			$me = $facebook->api('/me');
			//debug( $facebook->getLoginStatusUrl());
			foreach($_COOKIE as $key => $value){
				setcookie($key, '', time()-42000, '/');
			}
		} catch (FacebookApiException $e) {
			error_log($e);
		}
	}
	$retVar['object'] = $facebook;
	if ($me){
		 $retVar['status'] = 1; // active session
	}else {
		$retVar['status'] = 0; // no session
	}
	return $retVar;
}

function appUrl($perms='offline_access,publish_stream',$canvas=1,$fbconnect=0) {
	$facebook = init();
	if($facebook['status'] == 0) {
		$appId = Configure::read('Facebook.appId');
		$uri = Configure::read('Facebook.appUri');
		$loginUrl = $facebook['object']->getLoginUrl(
			array(
				'canvas' => $canvas,
				'fbconnect' => $fbconnect,
				'req_perms' => $perms
			)
		);
		//echo '<script>top.location="'.$loginUrl.'";</script>';
		return $loginUrl;
	}
}


class FacebookComponent extends Object {
	
	/**
	* uid is the Facebook ID of the connected Facebook user, or null if not connected
	*/
	var $uid = null;
	
	/**
	* me is the Facebook user object for the connected Facebook user
	*/
	var $me = null;
	
	/**
	* hasAccount is true if the connected Facebook user has an account in your application
	*/
	var $hasAccount = false;
	
	/**
	* The authenticated User using Auth
	*/
	var $authUser = null;
	
	/**
	* No Auth, if set to true, syncFacebookUser will NOT be called
	*/
	var $noAuth = false;
	
	/**
	* Error log
	*/
	var $errors = array();
	
	/**
	 * 
	*/
	var $controller = true;
	
	/**
	 * 
	*/
	var $Session;
	
	/**
	* createUser is true you want the component to attempt to create a CakePHP Auth user
	* account by introspection on the Auth component.  If false, you can use $this->hasAccount
	* as a reference to decide what to do with that user. (default true)
	*/
	var $createUser = true;
	
	/**
	* Initialize, load the api, decide if we're logged in
	* Sync the connected Facebook user with your application
	* @param Controller object to attach to
	* @param settings for Connect
	* @return void
	* @access public
	*/
	/*function initialize(&$Controller, $settings = array()){
		$this->Controller = $Controller;
		$this->_set($settings);
		
		$facebook = new Facebook(array(
			'appId'=> Configure::read('Facebook.appId'),
			'secret' => Configure::read('Facebook.secret'),
			'cookie' => true,
		));
		$session = $facebook->getSession();
		$this->me = null;
		// Session based API call.
		if($session) {
			try {
				$this->uid = $facebook->getUser();
				$this->me = $facebook->api('/me');
				//debug( $facebook->getLoginStatusUrl());
				foreach($_COOKIE as $key => $value){
				setcookie($key, '', time()-42000, '/');
				}
			} catch (FacebookApiException $e) {
				error_log($e);
			}
		}
	}*/
	
	/**
	* Startup, decide if we're logged in
	* Sync the connected Facebook user with your application
	* @param Controller object to attach to
	* @param settings for Connect
	* @return void
	* @access public
	*/
	function startup(&$Controller) {
		$this->Session = $Controller->Session;
	}
	
	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/	
	function getAccessToken() {
		$facebook = init();
		if($facebook['status'] == 1){
			$accessToken = $facebook['object']->getAccessToken();
		}else {
			$accessToken = false;
		}
		return $accessToken;
	}

	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
	function getFriends() {
		$facebook = init();
		if($facebook['status'] == 1){
			$path['object'] = 'https://graph.facebook.com/me/friends?access_token='.$facebook['object']->getAccessToken();
			$path['status'] = 1;
		} else {
			$path['object'] = appUrl();
			$path['status'] = 0;	
		}
		return $path;
	}	
	
	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
	function getMyDetails() {
		$facebook = init();
		if($facebook['status'] == 1){
			$path['object'] = 'https://graph.facebook.com/me?access_token='.$facebook['object']->getAccessToken();
			$path['status'] = 1;
		} else {
			$path['object'] = appUrl();
			$path['status'] = 0;
		}
		
		return $path;
	}
	
	/**
	* Read the logged in user
	* @param field key to return (xpath without leading slash)
	* @param mixed return
	*/
	function user($field = null){
		if(isset($this->uid)){
			$this->uid = $this->uid;
			if($this->Controller->Session->read('FB.Me') == null){
				$this->Controller->Session->write('FB.Me', $this->FB->api('/me'));
			}
			$this->me = $this->Controller->Session->read('FB.Me');
		} 
		else {
			$this->Controller->Session->delete('FB');
		}
		if(!$this->me){
			return null;
		}

		if($field){
			$retval = Set::extract("/$field", $this->me);
			return empty($retval) ? null : $retval[0];
		}

		return $this->me;
	}
		
	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
	function getProfilePicture($id=null) {
		$facebook = init();
		if($id==null) {
			$id = 'me';
		}else{
			$id = $id;
		}
		if($facebook['status'] == 1){
			$path['object'] = 'https://graph.facebook.com/'.$id.'/picture?access_token='.$facebook['object']->getAccessToken();
			$path['status'] = 1;
		}else {
			$path['object'] = appUrl();
			$path['status'] = 0;
		}
		
		return $path;
	}
	
	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
	function getAppRequests() {
		$facebook = init();
		if($facebook['status'] == 1){
			$path['object'] = 'https://graph.facebook.com/me/apprequests?access_token='.$facebook['object']->getAccessToken();
			$path['status'] = 1;
		} else {
			$path['object'] = appUrl();
			$path['status'] = 0;
		}
		
		return $path;
	}
	
	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
	function getAlbums() {
		$facebook = init();
		if($facebook['status'] == 1){
			$path['object'] = 'https://graph.facebook.com/me/albums?access_token='.$facebook['object']->getAccessToken();
			$path['status'] = 1;
		} else {
			$path['object'] = appUrl();
			$path['status'] = 0;
		}
	
		return $path;
	}
	
	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
	function postWall($heading,$subheading=NULL,$appLink,$appName,$description,$pictureLink=NULL) {
		$facebook = init();
		if($facebook['status'] == 1){					
			$attachment = array(
				'message' => $heading,
				'caption' => $subheading,
				'link' => $appLink, 
				'name' => $appName,
				'description' => $description,
				'picture' => $pictureLink,
				'privacy' => array('value' => 'EVERYONE'),
				'actions' => '',
				'cb' => ''
			);
			$path['object'] = NULL;
			$path['status'] = 1;
			$facebook['object']->api('/me/feed', 'post', $attachment);
		} else {
			$path['object'] = appUrl();
			$path['status'] = 0;
		}
	 
		return $path;
	}
	
	/**
	 * 
	 * @param 
	 * @return 
	 * 
	*/
	function appRequest($message,$page=null,$data=null) {
		$facebook = init();
		if($page==null) {
			$requestedPage = Configure::read('Facebook.canvasPage');
		} else {
			$requestedPage = Configure::read('Facebook.canvasPage').$page;
		}
		
		if($facebook['status'] == 1){	
			 $app_id = Configure::read('Facebook.appId');
			 $requestedPage = $requestedPage;
			 $message = $message;
			 $requests_url = "http://www.facebook.com/dialog/apprequests?app_id=" 
				. $app_id . "&redirect_uri=" . urlencode($requestedPage)
				. "&message=" . $message
				. "&data=" . $data;
			 
			 $path['object'] = $requests_url;
			 $path['status'] = 1;

		} else {
			$path['object'] = appUrl();
			$path['status'] = 0;
		}
		return $path;
	}
	
}
?>
