<?php 
/**
 * This controller helps to manage any ACL related events.
 * 
*/
class ConfigController extends AppController {
	
	var $name = "Config";
	
	var $uses = array('User');
	
	function version(){
		echo "<center style='position: relative; top:50px;'>Version 1.0</center>";
		exit();
	}
	
	/**************** ACL METHODS ************************/
	
	/**
	 * Helps to setup the AROS if users already exist
	 * @param 
	 * @return 
	 * 
	*/
	function setupACLUsers(){
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
			$aro_users[$counter]['parent_id'] = 3; //Add the users to the default users ACL group
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
	
	function setupACLPermissions() {
		$group =& $this->User->Group;
		//Allow admins to everything
		$group->id = 1;     
		$this->Acl->allow($group, 'controllers');

		//allow managers to posts and widgets
		$group->id = 2;
		$this->Acl->deny($group, 'controllers');
		$this->Acl->allow($group, 'controllers/Pages');
		$this->Acl->allow($group, 'controllers/Collections');
		$this->Acl->allow($group, 'controllers/Inspirations');
		$this->Acl->allow($group, 'controllers/Flags');
		$this->Acl->allow($group, 'controllers/Ufos');
		$this->Acl->allow($group, 'controllers/Feeds');
		$this->Acl->allow($group, 'controllers/Sources');
		$this->Acl->allow($group, 'controllers/Votes');
		$this->Acl->allow($group, 'controllers/Ownerships');
		$this->Acl->allow($group, 'controllers/Products');
		$this->Acl->allow($group, 'controllers/Attachments');
		$this->Acl->allow($group, 'controllers/AttachmentTags');
		$this->Acl->allow($group, 'controllers/Clients');
		$this->Acl->allow($group, 'controllers/Houses');
		$this->Acl->allow($group, 'controllers/ContractorSpecialties');
		$this->Acl->allow($group, 'controllers/Contractors');
		$this->Acl->allow($group, 'controllers/InspirationPhotoTags');
		$this->Acl->allow($group, 'controllers/ProductCategories');
		$this->Acl->allow($group, 'controllers/SourceCategories');
		$this->Acl->allow($group, 'controllers/UserFollowings');
		$this->Acl->allow($group, 'controllers/Tags');
		$this->Acl->allow($group, 'controllers/Forum');
		$this->Acl->allow($group, 'controllers/Popup');
		$this->Acl->allow($group, 'controllers/Rating');
		$this->Acl->allow($group, 'controllers/Twitter Kit');
		

		//allow users to only add and edit on posts and widgets
		$group->id = 3;
		$this->Acl->deny($group, 'controllers');        
		$this->Acl->allow($group, 'controllers/Pages');
		$this->Acl->allow($group, 'controllers/Sources/add');
		$this->Acl->allow($group, 'controllers/Sources/edit');  
		$this->Acl->allow($group, 'controllers/Products/add');
		$this->Acl->allow($group, 'controllers/Products/edit');      
		$this->Acl->allow($group, 'controllers/Inspirations/add');
		$this->Acl->allow($group, 'controllers/Inspirations/edit');
		$this->Acl->allow($group, 'controllers/Collections/add');
		$this->Acl->allow($group, 'controllers/Collections/edit');
		$this->Acl->allow($group, 'controllers/Votes');
		$this->Acl->allow($group, 'controllers/Ownerships/admin_set_ownership');
		$this->Acl->allow($group, 'controllers/Ownerships/haves');
		$this->Acl->allow($group, 'controllers/Ownerships/wants');
		$this->Acl->allow($group, 'controllers/InspirationPhotoTags/add');
		$this->Acl->allow($group, 'controllers/InspirationPhotoTags/delete');
		$this->Acl->allow($group, 'controllers/UserFollowings');
		$this->Acl->allow($group, 'controllers/Tags');
		$this->Acl->allow($group, 'controllers/Popup');
		$this->Acl->allow($group, 'controllers/Rating');
		$this->Acl->allow($group, 'controllers/Twitter Kit');
		$this->Acl->allow($group, 'controllers/Forum/Home/help');
		$this->Acl->allow($group, 'controllers/Forum/Home/rules');
		$this->Acl->allow($group, 'controllers/Forum/Posts/add');
		$this->Acl->allow($group, 'controllers/Forum/Posts/edit');
		$this->Acl->allow($group, 'controllers/Forum/Topics/add');
		$this->Acl->allow($group, 'controllers/Forum/Topics/edit');
		$this->Acl->allow($group, 'controllers/Forum/Search');
		
		//we add an exit to avoid an ugly "missing views" error message
		echo "Group permissions have been setup.";
		exit;
	}
	
	
	
	function build_acl() {
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

	function _getClassMethods($ctrlName = null) {
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

	function _isPlugin($ctrlName = null) {
		$arr = String::tokenize($ctrlName, '/');
		if (count($arr) > 1) {
			return true;
		} else {
			return false;
		}
	}

	function _getPluginControllerPath($ctrlName = null) {
		$arr = String::tokenize($ctrlName, '/');
		if (count($arr) == 2) {
			return $arr[0] . '.' . $arr[1];
		} else {
			return $arr[0];
		}
	}

	function _getPluginName($ctrlName = null) {
		$arr = String::tokenize($ctrlName, '/');
		if (count($arr) == 2) {
			return $arr[0];
		} else {
			return false;
		}
	}

	function _getPluginControllerName($ctrlName = null) {
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
	function _getPluginControllerNames() {
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
?>