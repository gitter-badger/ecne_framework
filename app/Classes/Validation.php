<?php

/**
 *  Class \Classes\Validation
 *  @author John O'Grady
 *  @date 22/06/15
 */

namespace Classes;

class Validation
{
    /**
     * @var bool
     */
	private $_passed = false;

    /**
     * @var array
     */
	private $_errors = array();

	/**
     * @method check
     * @access public
	 * @param $source
	 * @param array $items
	 * @return $this
	 */
	public function check($source, $items = array())
	{
		foreach ($items as $item => $rules) {
			foreach ($rules as $rule => $rule_value) {
				$value = $source[$item];
				$item = strip_tags($item);
				if ($rule === 'required' && empty($value)) {
					$this->addError("{$rules['name']} is required");
				} elseif(!empty($value)) {
					switch($rule) {
						case 'min':
							if (strlen(trim($value)) < $rule_value) {
								$this->addError("{$rules['name']} must be a minimum of {$rule_value} characters...");
							}
							break;
						case 'max':
							if (strlen(trim($value)) > $rule_value) {
								$this->addError("{$rules['name']} must be a maximum of {$rule_value} characters...");
							}
							break;
						case 'matches':
							if ($value != $source[$rule_value]) {
								$this->addError("{$rules['name']} must match {$items[$rule_value]['name']}");
							}
							break;
						case 'unique':
							break;
						default:
							break;
					}
				}
			}
		}
		if (empty($this->_errors)) {
			$this->_passed = true;
		}
		return $this;
	}

    /**
     * @method addError
     * @access private
     * @param $error
     */
	private function addError($error)
	{
		$this->_errors[] = $error;
	}

	/**
     * @method errors
     * @access public
	 * @return array
	 */
	public function errors()
	{
		return $this->_errors;
	}

    /**
     * @method passed
     * @access public
     * @return bool
     */
	public function passed()
	{
		return $this->_passed;
	}
}   /** End Class Definition **/