<?php
/**
 * This controller helps to manage any ACL related events.
 * 
*/
class ChallengeController extends AppController {
	
	var $name = "Challenges";
	
	var $uses = array();
		
	public function beforeFilter(){
		parent::beforeFilter();
		
		$this->Auth->allowedActions('setChallengeSession','findChallenge','admin_hide_challenge');
		
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
		
		$this->AjaxHandler->handle('admin_hide_challenge');
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
		Controller::loadModel('Forum.Topic');
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
	
}