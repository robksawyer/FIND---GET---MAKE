<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
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
 * @subpackage    cake.cake.libs.model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Application model for Cake.
 *
 * This is a placeholder class.
 * Create the same file in app/app_model.php
 * Add your application-wide methods to the class, your models will inherit them.
 *
 * @package       cake
 * @subpackage    cake.cake.libs.model
 */
App::import('Sanitize');
class AppModel extends Model {
	
	//Prevents the following Error: Missing database table 'app_models' for model 'AppModel'
	//var $useTable = false; //This will screw up crap.
	
	/**
	 * Table prefix.
	 *
	 * @access public
	 * @var string
	 */
	//public $tablePrefix = 'forum_';
	var $tablePrefix = '';

	/**
	 * Cache queries.
	 *
	 * @access public
	 * @var boolean
	 */
	var $cacheQueries = true;

	/**
	 * Behaviors.
	 *
	 * @access public
	 * @var array
	 */
	var $actsAs = array('Containable');

	/**
	 * No recursion.
	 *
	 * @access public
	 * @var int
	 */
	var $recursive = -1;
	
	/**
	 * Grab a row and defined fields/containables.
	 *
	 * @access public
	 * @param int $id
	 * @param array $fields
	 * @param array|boolean $contain
	 * @return array
	 */
	public function get($id, $fields = array(), $contain = false) {
		if (is_array($id)) {
			$column = $id[0];
			$value = $id[1];
		} else {
			$column = 'id';
			$value = $id;
		}

		if (empty($fields)) {
			$fields = $this->alias .'.*';
		} else {
			foreach ($fields as $row => $field) {
				$fields[$row] = $this->alias .'.'. $field;
			}
		}
		
		return $this->find('first', array(
			'conditions' => array($this->alias .'.'. $column => $value),
			'fields' => $fields,
			'contain' => $contain
		));
	}

	/**
	 * Adds locale functions to errors.
	 *
	 * @param string $field
	 * @param mixed $value
	 * @return string
	 */
	function invalidate($field, $value = true) {
		return parent::invalidate($field, __($value, true));
	}
	
	/**
	 * Validates two inputs against each other.
	 *
	 * @access public
	 * @param array $data
	 * @param string $confirmField
	 * @return boolean
	 */
	public function isMatch($data, $confirmField) {
		$data = array_values($data);
		$var1 = $data[0];
		$var2 = (isset($this->data[$this->name][$confirmField])) ? $this->data[$this->name][$confirmField] : '';

		return ($var1 === $var2);
	}

	/**
	 * Update a row with certain fields.
	 * 
	 * @access public
	 * @param int $id
	 * @param array $data
	 * @return boolean
	 */
	public function update($id, $data) {
		$this->id = $id;
		return $this->save($data, false, array_keys($data));
	}
	
}