<?php
/**
 * 
 */
class Ownership extends AppModel {
	var $name = 'Ownership';
  
	var $validate = array('user_id' => array('rule' => array('maxLength', 36),
										   'required' => true),
						'model_id' => array('rule' => array('maxLength', 36),
											'required' => true),
						'model' => array('rule' => 'alphaNumeric',
										 'required' => true));
										
	var $belongsTo = array(	'User' => array(
								'className' => 'User',
								'foreignKey' => 'user_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
							),
							'Product' => array(
								'className' => 'Product',
								'foreignKey' => 'model_id',
								'fields' => '',
								'order' => ''
							)
							);

	var $hasMany = array(
		'Feed' => array(
			'className' => 'Feed',
			'foreignKey' => 'model_id',
			'conditions' => array('Feed.model' => 'Ownership'),
			'dependent' => true,
			'exclusive' => true
		)
	);
	
	/**
	 * Updates the total count in the user table for this particular type of item
	 * @param created 
	 * @return 
	 * 
	*/	
	public function afterSave($created){
		if($created){
			//Update the total count for the user
			$last = $this->read(null,$this->id);
			if(!empty($last['User']['id'])){
				
				//Add the feed data to the feed
				$this->Feed->addFeedData('Ownership',$last);
			}
		}
	}
	
	/**
	 * Returns the needed feed data for a specific record
	 * @param int model_id
	 * @return 
	 * 
	*/
	public function getFeedData($model_id=null){
		$this->recursive = 0;
		$data = $this->read(null,$model_id);
		if(!empty($data['Product']['id'])){
			$product = $this->Product->read(null,$data['Product']['id']);
			$data['Product'] = $product;
		}
		return $data;
	}
	
	/**
	 * 
	 * @param user_id
	 * @param model
	 * @param model_id
	 * @return 
	 * 
	*/
	function getFirst($user_id=null,$model=null,$model_id=null){
		$data = $this->find('first',array('conditions'=>array(
															"model_id"=>$model_id,
															'Ownership.user_id'=>$user_id,
															'model'=>$model
															)
														));
		return $data;
	}
	
	
	// =================================
	// = Returns only the total counts =
	// =================================
	
	/**
	 * This method returns the total number of people who have a particular item.
	 * @param model
	 * @param model_id
	 * @return data
	 * 
	*/
	function getHaveCount($model=null,$model_id=null){
		$data = $this->find('count',array('conditions'=>array(
															'have_it'=>1,
															"model_id"=>$model_id,
															"model"=>$model
															)));
		//debug($data);
		return $data;
	}
	/**
	 * This method returns the total number of people who want a particular item.
	 * @param model
	 * @param model_id
	 * @return data
	 * 
	*/
	function getWantCount($model=null,$model_id=null){
		$data = $this->find('count',array('conditions'=>array(
															'want_it'=>1,
															"model_id"=>$model_id,
															"model"=>$model
															)));
		//debug($data);
		return $data;
	}
	/**
	 * This method returns the total number of people who had a particular item.
	 * @param model
	 * @param model_id
	 * @return data
	 * 
	*/
	function getHadCount($model=null,$model_id=null){
		$data = $this->find('count',array('conditions'=>array(
															'had_it'=>1,
															"model_id"=>$model_id,
															"model"=>$model
															)));
		return $data;
	}
	
	
	// =============================
	// = Returns entire User array =
	// =============================
	/**
	 * This method returns the details of people who have a particular item.
	 * @param model
	 * @param model_id
	 * @return data
	 * 
	*/
	function getHaveUsers($model=null,$model_id=null){
		$data = $this->find('all',array('conditions'=>array(
															'have_it'=>1,
															"model_id"=>$model_id,
															'model'=>$model
															)));
		return $this->_parseOwnershipInfo($data);
	}
	
	/**
	 * This method returns the details of people who want a particular item.
	 * @param model
	 * @param model_id
	 * @return data
	 * 
	*/
	function getWantUsers($model=null,$model_id=null){
		$data = $this->find('all',array('conditions'=>array(
															'want_it'=>1,
															"model_id"=>$model_id,
															'model'=>$model
															)));
		return $this->_parseOwnershipInfo($data);
	}
	
	/**
	 * This method returns the details of people who had a particular item.
	 * @param model
	 * @param model_id
	 * @return data
	 * 
	*/
	function getHadUsers($model=null,$model_id=null){
		$data = $this->find('all',array('conditions'=>array(
															'had_it'=>1,
															"model_id"=>$model_id,
															'model'=>$model
															)));
		return $this->_parseOwnershipInfo($data);
	}
	
	
	/**
	 * This method returns the wants of a particular user
	 * @param string model The model to target
	 * @param int user_id The user id to target
	 * @return data
	 * 
	*/
	function getUserWants($model=null,$user_id=null){
		$data = $this->find('all',array('conditions'=>array(
															'want_it'=>1,
															"Ownership.user_id"=>$user_id,
															'model'=>$model
															)));
		return $data;
	}
	
	/**
	 * This method returns the haves of a particular user
	 * @param string model The model to target
	 * @param int user_id The user id to target
	 * @return data
	 * 
	*/
	function getUserHaves($model=null,$user_id=null){
		$data = $this->find('all',array('conditions'=>array(
															'have_it'=>1,
															"Ownership.user_id"=>$user_id,
															'model'=>$model
															)));
		return $data;
	}
	
	/**
	 * Parses the user id from the Ownership table and returns more of the user's info
	 * @param data
	 * @return userData
	 * 
	*/
	function _parseOwnershipInfo($data=null){
		//$this->User->recursive = -1; //Just find the user data. Set this higher to get more info
		$userData = array();
		if(!empty($data)){
			foreach($data as $user){
				//Find the user data from the user_id
				$the_user = $this->User->read(null,$user['Ownership']['user_id']);
				if(!empty($the_user)) $userData[] = $the_user;
			}
		}
		
		return $userData;
	}
	
	/**
	 * Parse the owner array and return the ownership type
	 * Example:
	 * return have it
	 * return want it
	 * return had it
	 * @param int user_id
	 * @param string model
	 * @param int model_id
	 * @return String type
	 * 
	*/
	function getOwnershipType($user_id=null,$model=null,$model_id=null){
		$data = $this->find('first',array(
										'conditions'=>array(
											'Ownership.user_id'=>$user_id,
											"model"=>$model,
											"model_id"=>$model_id
											)));
														
		if($data['Ownership']['have_it']){
			return 'have_it';
		}else if($data['Ownership']['want_it']){
			return 'want_it';
		}else if($data['Ownership']['had_it']){
			return 'had_it';
		}else{
			return null;
		}
	}
}
?>