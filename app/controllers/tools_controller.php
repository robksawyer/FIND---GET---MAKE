<?php
class ToolsController extends AppController {

	var $name = 'Tools';

	var $uses = array('Tool','User');
	/**
	 * Components.
	 *
	 * @access public
	 * @var array
	 */
	//var $components = array('Email','Search.Prg','Uploader.Uploader');
	
	//var $helpers = array('');
	
	public function beforeFilter(){
		parent::beforeFilter();
		
		//Make certain pages public
		$this->Auth->allowedActions = array('bookmarklet');
		
	}
	
	
	/**
	 * Main bookmarklet view page
	 * @param 
	 * @return 
	 * 
	*/
	public function bookmarklet(){
		$user_bookmarklet_path = $this->generateUserBookmarklet();
		
		$this->set(compact('user_bookmarklet_path'));
	}
	
	/**
	 * This method handles generating a bookmarklet file for the auth user
	 * @param 
	 * @return String The name of the generated file.
	 * 
	*/
	public function generateUserBookmarklet(){
		$user = $this->Auth->user();
		if(empty($user['User']['public_key'])){
			$user['User']['public_key'] = $this->User->generateAndSavePublicKey($user);
		}
		$bookmarklet_template_path = App::themePath('default').'webroot'.DS.'js'.DS.'bookmarklet'.DS.'fgm_bookmarklet_template.js';
		$bookmarklet_template = new File($bookmarklet_template_path, false);
		if(!empty($bookmarklet_template)){
			$bookmarklet_template->open();
			if($bookmarklet_template->readable()){
				//debug($bookmarklet_template->read());
				$variables = array(
					'REPLACE_BASE_URL' => Router::url('/',true), //Get the absolute url
					'REPLACE_USERNAME' => $user['User']['username'],
					'REPLACE_PUBLIC_KEY' => 'fgmpk_'.$user['User']['public_key']
				);
				$user_bookmarklet_path = App::themePath('default').'webroot'.DS.'js'.DS.'bookmarklet'.DS.'fgm_bookmarklet_'.$user['User']['public_key'].'.js';
	
				$fileData = $bookmarklet_template->read();
				$bookmarklet_template->close();
				$updatedFileData = $this->replaceBookmarkletTemplateVariables($fileData,$variables);
				$user_bookmarklet_file = new File($user_bookmarklet_path, true);
				$user_bookmarklet_file->write($updatedFileData);
				$user_bookmarklet_file->close();
			}
		}
		
		return Router::url(DS.'theme'.DS.$this->theme.DS.'js'.DS.'bookmarklet'.DS.'fgm_bookmarklet_'.$user['User']['public_key'].'.js',true);
	}
	
	
	/**
	 * Replace the following variables in the template:
	 * REPLACE_BASE_URL = The url to target for additions
	 * REPLACE_USERNAME = The username to build for
	 * REPLACE_PUBLIC_KEY = The user's public key
	 * @param String fileData
	 * @param Array variables
	 * @return 
	 * 
	*/
	protected function replaceBookmarkletTemplateVariables($fileData,$variables = array()){
		$default = array(
			'REPLACE_BASE_URL' => '',
			'REPLACE_USERNAME' => '',
			'REPLACE_PUBLIC_KEY' => ''
		);
		$replacementVars = array_merge($default,$variables);
		$fileData = str_replace('REPLACE_BASE_URL','"'.$replacementVars['REPLACE_BASE_URL'].'"',$fileData);
		$fileData = str_replace('REPLACE_USERNAME','"'.$replacementVars['REPLACE_USERNAME'].'"',$fileData);
		$fileData = str_replace('REPLACE_PUBLIC_KEY','"'.$replacementVars['REPLACE_PUBLIC_KEY'].'"',$fileData);
		return $fileData;
	}
}