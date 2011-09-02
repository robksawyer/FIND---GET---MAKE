<?php
/**
 * Number Helper class file.
 *
 * PHP versions 4 and 5
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @link		  http://www.jaygilford.com/php/number-to-text-converting-php-class/ - Started from this code.
 * @author		  Rob Sawyer - Conversion and updates only
 * @package		  cake
 * @subpackage	  cake.cake.libs.view.helpers
 * @since		  CakePHP(tm) v 0.10.0.1076
 * @license		  MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Number to Text Helper class for easy use of number data.
 *
 * Manipulation of number data.
 * 
 * Examples
 * $n2s = new num2string('123456');
 * echo $n2s;
 * 
 * echo $n2s->parse('87654321');
 *
 * @package		  cake
 * @subpackage	  cake.cake.libs.view.helpers
 * @link http://book.cakephp.org/view/1470/Time
 */
class NumberToTextHelper extends AppHelper {
	
	private $_original = 0;
	private $_parsed_number_text = '';
	private $_single_nums = array(1 => 'One', 2 => 'Two', 3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six', 7 => 'Seven', 8 => 'Eight', 9 => 'Nine');
	private $_teen_nums = array(0 => 'Ten', 1 => 'Eleven', 2 => 'Twelve', 3 => 'Thirteen', 4 => 'Fourteen', 5 => 'Fifteen', 6 => 'Sixteen', 7 => 'Seventeen', 8 => 'Eighteen', 9 => 'Nineteen');
	private $_tens_nums = array(2 => 'Twenty', 3 => 'Thirty', 4 => 'Forty', 5 => 'Fifty', 6 => 'Sixty', 7 => 'Seventy', 8 => 'Eighty', 9 => 'Ninety');
	private $_chunks_nums = array(1 => 'Thousand', 2 => 'Million', 3 => 'Billion', 4 => 'Trillion', 5 => 'Quadrillion', 6 => 'Quintrillion', 7 => 'Sextillion', 8 => 'Septillion', 9 => 'Octillion', 9 => 'Nonillion', 9 => 'Decillion');

	function __construct($options = null) {
		parent::__construct($options);
		
		//$this->_original = trim($number);
		//$this->parse();
	}

	public function parse($new_number = NULL) {
		if($new_number !== NULL) {
			$this->_original = trim($new_number);
		}
		if($this->_original == 0) return 'Zero';

		$num = str_split($this->_original, 1);
		krsort($num);
		$chunks = array_chunk($num, 3);
		krsort($chunks);

		$final_num = array();
		foreach ($chunks as $k => $v) {
			ksort($v);
			$temp = trim($this->_parse_num(implode('', $v)));
			if($temp != '') {
				$final_num[$k] = $temp;
				if (isset($this->_chunks_nums[$k]) && $this->_chunks_nums[$k] != '') {
					$final_num[$k] .= ' '.$this->_chunks_nums[$k];
				}
			}
		}
		$this->_parsed_number_text = implode(', ', $final_num);
		return $this->_parsed_number_text;
	}

	public function __toString() {
		return $this->_parsed_number_text;
	}

	private function _parse_num($num) {
		$temp = array();
		if (isset($num[2])) {
			if (isset($this->_single_nums[$num[2]])) {
				$temp['h'] = $this->_single_nums[$num[2]].' Hundred';
			}
		}

		if (isset($num[1])) {
			if ($num[1] == 1) {
				$temp['t'] = $this->_teen_nums[$num[0]];
			} else {
				if (isset($this->_tens_nums[$num[1]])) {
					$temp['t'] = $this->_tens_nums[$num[1]];
				}
			}
		}

		if (!isset($num[1]) || $num[1] != 1) {
			if (isset($this->_single_nums[$num[0]])) {
				if (isset($temp['t'])) {
					$temp['t'] .= ' '.$this->_single_nums[$num[0]];
				} else {
					$temp['u'] = $this->_single_nums[$num[0]];
				}
			}
		}
		return implode(' and ', $temp);
	}
}