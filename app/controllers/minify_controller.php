<?
class MinifyController extends AppController {
 
	 public $name = 'Minify';
	 public $uses = array();
 
	 /**
	  * In this case, in 7shifts our AppController::beforeFilter() takes advantage of the $Auth component. 
	  * We don't want to use it here so we just over-write the beforeFilter() method with nothing. 
	  */
	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('*');
	}
 
	 /**
	  * Take care of any minifying requests. 
	  *
	  * @access public
	  */
	 public function index(){
 
		  $this->autoRender = false;
		  // We define this to then use in the config.php for PHP Minify
		  define('WEBROOT_URL', $this->webroot);
		  App::import('Vendor', 'min/index');
	 }
 
}
?>