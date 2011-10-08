<?php 
/**
 * This controller helps to manage any ACL related events.
 * 
*/
class ConfigController extends AppController {
	
	var $name = "Config";
	
	var $uses = array('User');
	
	public function beforeFilter(){
		parent::beforeFilter();
		
		//$this->Auth->allow('*'); //Disable this after the permissions have been setup.
	}
	
	public function version(){
		echo "<center style='position: relative; top:50px;'>Version 1.0</center>";
	}
	
	
	/**
	 * Helps to setup the AROS if users already exist
	 * @param 
	 * @return 
	 * 
	*/
	public function admin_setupACLUsers(){
		$this->autoLayout = false;
		$this->autoRender = false;
		$this->User->recursive = -1;
		$aro = new Aro();
		//Here are our user records, ready to be linked up to new ARO records
		$users = $this->User->find('all');
		
		//debug($users);
		//Build the aro data
		$counter = 0;
		foreach($users as $user){
			$aro_users[$counter]['alias'] = $user['User']['username'];
			$aro_users[$counter]['parent_id'] = $user['User']['group_id'];
			$aro_users[$counter]['model'] = 'User';
			$aro_users[$counter]['foreign_key'] = $user['User']['id'];
			$counter++;
		}
		
		//debug($aro_users);
		//Iterate and create AROs (as children)
		foreach($aro_users as $data){
			//Remember to call create() when saving in loops...
			$aro->create();
			//Save data
			$aro->save($data);
		}
		
		debug("Completed! ".count($aro_users)." users were added to the aros table.");
	}
	
	/**
	 * Updates the totals for sources, products, inspirations, collections, etc.
	 * @param int user_id The user id to update
	 * @return 
	 * 
	*/
	public function admin_updateTotalCounts($user_id=null){
		$this->autoLayout = false;
		$this->autoRender = false;
		
		if(!$user_id){
			$this->Session->setFlash(__('You have to enter a user id.', true), 'default', 'error-message');
			$this->redirect('/');
			exit;
		}
		
		//Update the total counts
		$this->User->updateTotalInspirations($user_id);
		$this->User->updateTotalCollections($user_id);
		$this->User->updateTotalProducts($user_id);
		$this->User->updateTotalSources($user_id);
		
		//Update follow related counts
		$this->User->updateTotalFollowCount($user_id);
		$this->User->updateTotalFollowerCount($user_id);
		
		$the_user = $this->User->read(null,$user_id);
		
		//Request data for the elements
		//$userSources = $this->User->Source->userSources($user_id);
		echo "<h3>The user has added ".$the_user['User']['total_sources']." sources.</h3>";
		//$this->set(compact('userSources'));
		
		//$userProducts = $this->User->Product->userProducts($user_id,10,'all');
		echo "<h3>The user has added ".$the_user['User']['total_products']." products.</h3>";
		//$this->set(compact('userProducts'));
		
		//$userInspirations = $this->User->Inspiration->userInspirations($user_id,10,'all');
		echo "<h3>The user has created ".$the_user['User']['total_inspirations']." inspirations.</h3>";
		//$this->set(compact('userInspirations'));
		
		//$userCollections = $this->User->Collection->userCollections($user_id,10,'all');
		echo "<h3>The user has created ".$the_user['User']['total_collections']." collections.</h3>";
		//$this->set(compact('userCollections'));
		
		//$userUfos = $this->User->Ufo->userUfos($user_id);
		echo "<h3>The user has created ".$the_user['User']['total_ufos']." ufos.</h3>";
		//$this->set(compact('userUfos'));
		
		$wantedProducts = $this->User->Ownership->getUserWants('Product',$user_id);
		echo "<h3>The user wants ".count($wantedProducts)." products.</h3>";
		
		$haveProducts = $this->User->Ownership->getUserHaves('Product',$user_id);
		echo "<h3>The user has ".count($haveProducts)." products.</h3>";
		//$this->set(compact('haveProducts'));
		
		//Refresh the logged in user
		$this->_refreshAuth();
	}
	
	/**************** ACL METHODS ************************/
	
	/**
	 * Setup aco->aro permissions
	 * @param 
	 * @return 
	 * 
	*/
	public function admin_setupACLPermissions() {
		$this->autoRender = false;
		$this->autoLayout = false;
		
		$group =& $this->User->Group;
		
		$this->admin_setupACLAdminPermissions($group);
		$this->admin_setupACLManagerPermissions($group);
		$this->admin_setupACLUserPermissions($group);
		
		//we add an exit to avoid an ugly "missing views" error message
		echo "<br/>Permissions have been updated.";
		exit;
	}
	
	/**
	 * Setup Admin permissions
	 * @param 
	 * @return 
	 * 
	*/
	public function admin_setupACLAdminPermissions($group=null) {
		$this->autoRender = false;
		$this->autoLayout = false;
		
		if(empty($group)) $group =& $this->User->Group;
		
		//Allow admins to everything
		$group->id = 1;
		$this->Acl->allow($group, 'controllers');
		
		//we add an exit to avoid an ugly "missing views" error message
		echo "<br/>Admin permissions have been setup.";
		//exit;
	}
	
	/**
	 * Setup Manager permissions
	 * @param 
	 * @return 
	 * 
	*/
	public function admin_setupACLManagerPermissions($group=null) {
		$this->autoRender = false;
		$this->autoLayout = false;
		
		if(empty($group)) $group =& $this->User->Group;
		
		//allow managers
		$group->id = 2;
		//$group = 'managers';
		$this->Acl->deny($group, 'controllers');
		
		//$this->Acl->allow($group, 'controllers/App');
		$this->Acl->allow($group, 'controllers/Ajaxs');
		$this->Acl->allow($group, 'controllers/Attachments');
		//$this->Acl->allow($group, 'controllers/AttachmentTags'); //Not used
		$this->Acl->deny($group, 'controllers/BetaUsers');
		$this->Acl->allow($group, 'controllers/BetaUsers/add');
		$this->Acl->allow($group, 'controllers/Challenges');
		$this->Acl->allow($group, 'controllers/Clients');
		$this->Acl->allow($group, 'controllers/Collections');
		$this->Acl->allow($group, 'controllers/ContractorSpecialties');
		$this->Acl->allow($group, 'controllers/Contractors');
		$this->Acl->allow($group, 'controllers/Feeds');
		$this->Acl->allow($group, 'controllers/Flags');
		$this->Acl->allow($group, 'controllers/Pages');
		$this->Acl->allow($group, 'controllers/SourceCategories');
		$this->Acl->allow($group, 'controllers/Sources');
		$this->Acl->allow($group, 'controllers/ProductCategories');
		$this->Acl->allow($group, 'controllers/Products');
		$this->Acl->allow($group, 'controllers/Houses');
		$this->Acl->allow($group, 'controllers/InspirationPhotoTags');
		$this->Acl->allow($group, 'controllers/Inspirations');
		$this->Acl->allow($group, 'controllers/Ownerships');
		$this->Acl->allow($group, 'controllers/Users');
		$this->Acl->deny($group, 'controllers/Users/add_attachment');
		$this->Acl->allow($group, 'controllers/Ufos');
		$this->Acl->allow($group, 'controllers/Votes');
		$this->Acl->allow($group, 'controllers/UserFollowings');
		$this->Acl->allow($group, 'controllers/Settings');
		$this->Acl->allow($group, 'controllers/StaffFavorites');
		
		//App controller
		$this->Acl->allow($group, 'controllers/Inspirations/uploadAttachments');
		$this->Acl->allow($group, 'controllers/Inspirations/toSlug');
		$this->Acl->allow($group, 'controllers/Inspirations/cleanURL');
		$this->Acl->allow($group, 'controllers/Collections/uploadAttachments');
		$this->Acl->allow($group, 'controllers/Collections/toSlug');
		$this->Acl->allow($group, 'controllers/Collections/cleanURL');
		$this->Acl->allow($group, 'controllers/Products/toSlug');
		$this->Acl->allow($group, 'controllers/Products/cleanURL');
		$this->Acl->allow($group, 'controllers/Products/uploadAttachments');
		$this->Acl->allow($group, 'controllers/Sources/toSlug');
		$this->Acl->allow($group, 'controllers/Sources/cleanURL');
		$this->Acl->allow($group, 'controllers/Sources/uploadAttachments');
		$this->Acl->allow($group, 'controllers/Ufos/toSlug');
		$this->Acl->allow($group, 'controllers/Ufos/cleanURL');
		$this->Acl->allow($group, 'controllers/Ufos/uploadAttachments');
		
		//Plugins
		$this->Acl->allow($group, 'controllers/Forum');
		$this->Acl->deny($group, 'controllers/Forum/Home/add_attachment');
		$this->Acl->deny($group, 'controllers/Forum/Posts/add_attachment');
		$this->Acl->deny($group, 'controllers/Forum/Categories/add_attachment');
		$this->Acl->deny($group, 'controllers/Forum/Search/add_attachment');
		$this->Acl->deny($group, 'controllers/Forum/Reports/add_attachment');
		$this->Acl->deny($group, 'controllers/Forum/Staff/add_attachment');
		$this->Acl->deny($group, 'controllers/Forum/Topics/add_attachment');
		
		$this->Acl->allow($group, 'controllers/Rating');
		$this->Acl->allow($group, 'controllers/TwitterKit/Oauth');
		
		$this->Acl->deny($group, 'controllers/Config');
		$this->Acl->deny($group, 'controllers/Acl');
		$this->Acl->deny($group, 'controllers/Groups');
		
		//we add an exit to avoid an ugly "missing views" error message
		echo "<br/>Manager permissions have been setup.";
		//exit;
	}
	
	
	/**
	 * Setup User permissions
	 * @param 
	 * @return 
	 * 
	*/
	public function admin_setupACLUserPermissions($group=null) {
		$this->autoRender = false;
		$this->autoLayout = false;
		
		if(empty($group)) $group =& $this->User->Group;
		
		//allow users
		$group->id = 3;
		//$group = 'users';
		
		$this->Acl->deny($group, 'controllers');        
		$this->Acl->allow($group, 'controllers/Ajax');
		//$this->Acl->allow($group, 'controllers/App/add_attachment');
		$this->Acl->allow($group, 'controllers/Attachments/view');
		$this->Acl->allow($group, 'controllers/Attachments/photo_tag_view');
		$this->Acl->allow($group, 'controllers/Attachments/collage');
		$this->Acl->allow($group, 'controllers/Attachments/add_attachment');
		$this->Acl->deny($group, 'controllers/BetaUsers');
		$this->Acl->allow($group, 'controllers/BetaUsers/add');
		$this->Acl->allow($group, 'controllers/Challenges');
		
		$this->Acl->allow($group, 'controllers/Collections/add');
		$this->Acl->deny($group, 'controllers/Collections/add_attachment');
		$this->Acl->allow($group, 'controllers/Collections/edit');
		$this->Acl->allow($group, 'controllers/Collections/view');
		$this->Acl->allow($group, 'controllers/Collections/index');
		$this->Acl->allow($group, 'controllers/Collections/addProducts');
		$this->Acl->allow($group, 'controllers/Collections/removeProduct');
		$this->Acl->allow($group, 'controllers/Collections/userCollections');
		
		$this->Acl->allow($group, 'controllers/ContractorSpecialties/view');
		$this->Acl->allow($group, 'controllers/Feeds/me');
		$this->Acl->allow($group, 'controllers/Feeds/user');
		$this->Acl->allow($group, 'controllers/Feeds/display');
		$this->Acl->allow($group, 'controllers/Feeds/getUsersFollowingFeedDataDetails');
		$this->Acl->allow($group, 'controllers/Feeds/getUsersFollowingFeedCount');
		$this->Acl->allow($group, 'controllers/Feeds/getUserFeed');
		$this->Acl->allow($group, 'controllers/Feeds/getUserFeedCount');
		
		$this->Acl->allow($group, 'controllers/Flags/flag_item');
		
		$this->Acl->allow($group, 'controllers/InspirationPhotoTags/add');
		$this->Acl->allow($group, 'controllers/InspirationPhotoTags/delete');
		$this->Acl->allow($group, 'controllers/Inspirations/add');
		$this->Acl->allow($group, 'controllers/Inspirations/add_attachment');
		$this->Acl->allow($group, 'controllers/Inspirations/edit');
		$this->Acl->allow($group, 'controllers/Inspirations/view');
		$this->Acl->allow($group, 'controllers/Inspirations/index');
		$this->Acl->allow($group, 'controllers/Inspirations/addProducts');
		$this->Acl->allow($group, 'controllers/Inspirations/removeProduct');
		$this->Acl->allow($group, 'controllers/Inspirations/getTags');
		
		$this->Acl->allow($group, 'controllers/Ownerships');
		$this->Acl->allow($group, 'controllers/Pages');
		
		$this->Acl->allow($group, 'controllers/ProductCategories/view');
		$this->Acl->allow($group, 'controllers/Products/add');
		$this->Acl->allow($group, 'controllers/Products/add_attachment');
		$this->Acl->allow($group, 'controllers/Products/edit');
		$this->Acl->allow($group, 'controllers/Products/view');
		$this->Acl->allow($group, 'controllers/Products/index');
		$this->Acl->allow($group, 'controllers/Products/removeAttachment');
		
		$this->Acl->allow($group, 'controllers/SourceCategories/view');
		$this->Acl->allow($group, 'controllers/Sources/add');
		$this->Acl->allow($group, 'controllers/Sources/add_attachment');
		$this->Acl->allow($group, 'controllers/Sources/edit');
		$this->Acl->allow($group, 'controllers/Sources/view');
		$this->Acl->allow($group, 'controllers/Sources/index');
		$this->Acl->allow($group, 'controllers/Sources/removeAttachment');
		$this->Acl->allow($group, 'controllers/Sources/ajax_check_name');
		$this->Acl->allow($group, 'controllers/Sources/cleanAddress');
		
		$this->Acl->allow($group, 'controllers/Ufos/view');
		$this->Acl->allow($group, 'controllers/Ufos/add');
		$this->Acl->allow($group, 'controllers/Ufos/edit');
		$this->Acl->allow($group, 'controllers/Ufos/delete');
		$this->Acl->allow($group, 'controllers/Ufos/getUfosFromUser');
		$this->Acl->allow($group, 'controllers/Ufos/add_attachment');
		
		$this->Acl->allow($group, 'controllers/UserFollowings');
		$this->Acl->deny($group, 'controllers/UserFollowings/add_attachment');
		
		//$this->Acl->deny($group, 'controllers/Users');
		$this->Acl->allow($group, 'controllers/Users/forgot');
		$this->Acl->allow($group, 'controllers/Users/listing');
		$this->Acl->allow($group, 'controllers/Users/report');
		//$this->Acl->allow($group, 'controllers/Users/edit');
		$this->Acl->allow($group, 'controllers/Users/moderate');
		$this->Acl->allow($group, 'controllers/Users/ajax_more_feed_data');
		$this->Acl->allow($group, 'controllers/Users/ajax_more_user_feed_data');
		//$this->Acl->allow($group, 'controllers/Users/add_avatar');
		//$this->Acl->allow($group, 'controllers/Users/upload_avatar');
		//$this->Acl->allow($group, 'controllers/Users/save_avatar');
		//$this->Acl->allow($group, 'controllers/Users/use_gravatar');
		//$this->Acl->allow($group, 'controllers/Users/remove_avatar');
		$this->Acl->allow($group, 'controllers/Users/getAvatar');
		$this->Acl->allow($group, 'controllers/Users/staff_favorites');
		$this->Acl->deny($group, 'controllers/Users/add_attachment');
		
		$this->Acl->deny($group, 'controllers/StaffFavorites');
		
		$this->Acl->allow($group, 'controllers/Votes');
		$this->Acl->deny($group, 'controllers/Votes/add_attachment');
		
		//Plugins
		//$this->Acl->allow($group, 'controllers/Rating');
		$this->Acl->allow($group, 'controllers/Forum/Home/help');
		$this->Acl->allow($group, 'controllers/Forum/Home/rules');
		$this->Acl->allow($group, 'controllers/Forum/Home/index');
		$this->Acl->allow($group, 'controllers/Forum/Posts/add');
		$this->Acl->allow($group, 'controllers/Forum/Posts/edit');
		$this->Acl->allow($group, 'controllers/Forum/Posts/delete');
		$this->Acl->allow($group, 'controllers/Forum/Posts/report');
		$this->Acl->allow($group, 'controllers/Forum/Posts/index');
		$this->Acl->deny($group, 'controllers/Forum/Posts/add_attachment');
		$this->Acl->allow($group, 'controllers/Forum/Topics/add');
		$this->Acl->allow($group, 'controllers/Forum/Topics/edit');
		$this->Acl->allow($group, 'controllers/Forum/Topics/view');
		$this->Acl->allow($group, 'controllers/Forum/Topics/index');
		$this->Acl->allow($group, 'controllers/Forum/Categories/view');
		$this->Acl->allow($group, 'controllers/Forum/Categories/index');
		$this->Acl->allow($group, 'controllers/Forum/Search');
		$this->Acl->allow($group, 'controllers/Settings');
		
		//App controller methods
		$this->Acl->allow($group, 'controllers/Inspirations/uploadAttachments');
		$this->Acl->allow($group, 'controllers/Inspirations/toSlug');
		$this->Acl->allow($group, 'controllers/Inspirations/cleanURL');
		$this->Acl->allow($group, 'controllers/Collections/uploadAttachments');
		$this->Acl->allow($group, 'controllers/Collections/toSlug');
		$this->Acl->allow($group, 'controllers/Collections/cleanURL');
		$this->Acl->allow($group, 'controllers/Products/toSlug');
		$this->Acl->allow($group, 'controllers/Products/cleanURL');
		$this->Acl->allow($group, 'controllers/Products/uploadAttachments');
		$this->Acl->allow($group, 'controllers/Sources/toSlug');
		$this->Acl->allow($group, 'controllers/Sources/cleanURL');
		$this->Acl->allow($group, 'controllers/Sources/uploadAttachments');
		$this->Acl->allow($group, 'controllers/Ufos/toSlug');
		$this->Acl->allow($group, 'controllers/Ufos/cleanURL');
		$this->Acl->allow($group, 'controllers/Ufos/uploadAttachments');
		
		$this->Acl->deny($group, 'controllers/Forum/Home/add_attachment');
		$this->Acl->deny($group, 'controllers/Forum/Posts/add_attachment');
		$this->Acl->deny($group, 'controllers/Forum/Categories/add_attachment');
		$this->Acl->deny($group, 'controllers/Forum/Search/add_attachment');
		$this->Acl->deny($group, 'controllers/Forum/Reports/add_attachment');
		$this->Acl->deny($group, 'controllers/Forum/Staff/add_attachment');
		$this->Acl->deny($group, 'controllers/Forum/Topics/add_attachment');
		
		$this->Acl->allow($group, 'controllers/TwitterKit/Oauth');
		
		$this->Acl->deny($group, 'controllers/Config');
		$this->Acl->deny($group, 'controllers/Acl');
		$this->Acl->deny($group, 'controllers/Clients');
		$this->Acl->deny($group, 'controllers/Houses');
		$this->Acl->deny($group, 'controllers/Contractors');
		$this->Acl->deny($group, 'controllers/ContractorSpecialties');
		$this->Acl->deny($group, 'controllers/Groups');
		
		//we add an exit to avoid an ugly "missing views" error message
		echo "<br/>User permissions have been setup.";
		//exit;
	}
	
	protected function admin_build_acl() {
		if (!Configure::read('debug')) {
			return $this->_stop();
		}
		$log = array();

		$aco =& $this->Acl->Aco;
		$root = $aco->node('controllers');
		if (!$root) {
			$aco->create(array('parent_id' => null, 'model' => null, 'alias' => 'controllers'));
			$root = $aco->save();
			$root['Aco']['id'] = $aco->id; 
			$log[] = 'Created Aco node for controllers';
		} else {
			$root = $root[0];
		}   

		App::import('Core', 'File');
		$Controllers = App::objects('controller');
		$appIndex = array_search('App', $Controllers);
		if ($appIndex !== false ) {
			unset($Controllers[$appIndex]);
		}
		$baseMethods = get_class_methods('Controller');
		$baseMethods[] = 'build_acl';

		$Plugins = $this->_getPluginControllerNames();
		$Controllers = array_merge($Controllers, $Plugins);

		// look at each controller in app/controllers
		foreach ($Controllers as $ctrlName) {
			$methods = $this->_getClassMethods($this->_getPluginControllerPath($ctrlName));

			// Do all Plugins First
			if ($this->_isPlugin($ctrlName)){
				$pluginNode = $aco->node('controllers/'.$this->_getPluginName($ctrlName));
				if (!$pluginNode) {
					$aco->create(array('parent_id' => $root['Aco']['id'], 'model' => null, 'alias' => $this->_getPluginName($ctrlName)));
					$pluginNode = $aco->save();
					$pluginNode['Aco']['id'] = $aco->id;
					$log[] = 'Created Aco node for ' . $this->_getPluginName($ctrlName) . ' Plugin';
				}
			}
			// find / make controller node
			$controllerNode = $aco->node('controllers/'.$ctrlName);
			if (!$controllerNode) {
				if ($this->_isPlugin($ctrlName)){
					$pluginNode = $aco->node('controllers/' . $this->_getPluginName($ctrlName));
					$aco->create(array('parent_id' => $pluginNode['0']['Aco']['id'], 'model' => null, 'alias' => $this->_getPluginControllerName($ctrlName)));
					$controllerNode = $aco->save();
					$controllerNode['Aco']['id'] = $aco->id;
					$log[] = 'Created Aco node for ' . $this->_getPluginControllerName($ctrlName) . ' ' . $this->_getPluginName($ctrlName) . ' Plugin Controller';
				} else {
					$aco->create(array('parent_id' => $root['Aco']['id'], 'model' => null, 'alias' => $ctrlName));
					$controllerNode = $aco->save();
					$controllerNode['Aco']['id'] = $aco->id;
					$log[] = 'Created Aco node for ' . $ctrlName;
				}
			} else {
				$controllerNode = $controllerNode[0];
			}

			//clean the methods. to remove those in Controller and private actions.
			foreach ($methods as $k => $method) {
				if (strpos($method, '_', 0) === 0) {
					unset($methods[$k]);
					continue;
				}
				if (in_array($method, $baseMethods)) {
					unset($methods[$k]);
					continue;
				}
				$methodNode = $aco->node('controllers/'.$ctrlName.'/'.$method);
				if (!$methodNode) {
					$aco->create(array('parent_id' => $controllerNode['Aco']['id'], 'model' => null, 'alias' => $method));
					$methodNode = $aco->save();
					$log[] = 'Created Aco node for '. $method;
				}
			}
		}
		if(count($log)>0) {
			debug($log);
		}
	}

	protected function _getClassMethods($ctrlName = null) {
		App::import('Controller', $ctrlName);
		if (strlen(strstr($ctrlName, '.')) > 0) {
			// plugin's controller
			$num = strpos($ctrlName, '.');
			$ctrlName = substr($ctrlName, $num+1);
		}
		$ctrlclass = $ctrlName . 'Controller';
		$methods = get_class_methods($ctrlclass);

		// Add scaffold defaults if scaffolds are being used
		$properties = get_class_vars($ctrlclass);
		if (array_key_exists('scaffold',$properties)) {
			if($properties['scaffold'] == 'admin') {
				$methods = array_merge($methods, array('admin_add', 'admin_edit', 'admin_index', 'admin_view', 'admin_delete'));
			} else {
				$methods = array_merge($methods, array('add', 'edit', 'index', 'view', 'delete'));
			}
		}
		return $methods;
	}

	protected function _isPlugin($ctrlName = null) {
		$arr = String::tokenize($ctrlName, '/');
		if (count($arr) > 1) {
			return true;
		} else {
			return false;
		}
	}

	protected function _getPluginControllerPath($ctrlName = null) {
		$arr = String::tokenize($ctrlName, '/');
		if (count($arr) == 2) {
			return $arr[0] . '.' . $arr[1];
		} else {
			return $arr[0];
		}
	}

	protected function _getPluginName($ctrlName = null) {
		$arr = String::tokenize($ctrlName, '/');
		if (count($arr) == 2) {
			return $arr[0];
		} else {
			return false;
		}
	}

	protected function _getPluginControllerName($ctrlName = null) {
		$arr = String::tokenize($ctrlName, '/');
		if (count($arr) == 2) {
			return $arr[1];
		} else {
			return false;
		}
	}

	/**
	 * Get the names of the plugin controllers ...
	 * 
	 * This function will get an array of the plugin controller names, and
	 * also makes sure the controllers are available for us to get the 
	 * method names by doing an App::import for each plugin controller.
	 *
	 * @return array of plugin names.
	 *
	 */
	protected function _getPluginControllerNames() {
		App::import('Core', 'File', 'Folder');
		$paths = Configure::getInstance();
		$folder =& new Folder();
		$folder->cd(APP . 'plugins');

		// Get the list of plugins
		$Plugins = $folder->read();
		$Plugins = $Plugins[0];
		$arr = array();

		// Loop through the plugins
		foreach($Plugins as $pluginName) {
			// Change directory to the plugin
			$didCD = $folder->cd(APP . 'plugins'. DS . $pluginName . DS . 'controllers');
			// Get a list of the files that have a file name that ends
			// with controller.php
			$files = $folder->findRecursive('.*_controller\.php');

			// Loop through the controllers we found in the plugins directory
			foreach($files as $fileName) {
				// Get the base file name
				$file = basename($fileName);

				// Get the controller name
				$file = Inflector::camelize(substr($file, 0, strlen($file)-strlen('_controller.php')));
				if (!preg_match('/^'. Inflector::humanize($pluginName). 'App/', $file)) {
					if (!App::import('Controller', $pluginName.'.'.$file)) {
						debug('Error importing '.$file.' for plugin '.$pluginName);
					} else {
						/// Now prepend the Plugin name ...
						// This is required to allow us to fetch the method names.
						$arr[] = Inflector::humanize($pluginName) . "/" . $file;
					}
				}
			}
		}
		return $arr;
	}
	/**************** END ACL ************************/
	
}