<?php

/**
 * 
 */

namespace Classes\Form;

class Element
{
	const TYPE_TEXT = 'text';
	const TYPE_EMAIL = 'email';
	const TYPE_PASSWORD = 'password';
	const TYPE_SUBMIT = 'submit';
	const TYPE_HIDDEN = 'hidden';

	/**
	 * @var string
	 */
	private $type;

	/**
	 * @var array
	 */
	private $attributes = array();
	/**
	 * @var string
	 */
	private $shortMessage;
	/**
	 * @var string
	 */
	private $isUnique = '';

	public function __construct($type, $attributes, $unique = 'false')
	{
		$this->type = $type;
		$this->setAttribute('type', $this->type);
		$this->isUnique = $unique;
		foreach ($attributes as $key => $val) {
			$this->setAttribute($key, $val);
		}
	}

	public function setAttribute($field, $value)
	{
		$this->attributes[$field] = $value;
	}

	public function getAttribute($key)
	{
		if (isset($this->attributes[$key])) {
			return $this->attributes[$key];
		}
	}

	public function getAttributesArray()
	{
		return $this->attributes;
	}

	public function getAttributes()
	{
		$attributes=array();
		foreach ($this->attributes as $key => $val) {
			array_push($attributes, $key.'='.\Classes\Helper::returnDoubleQuotes($val));
		}
		return join(" ", $attributes);
	}

	public function hasAttribute($key)
	{
		return (isset($this->attributes[$key])) ? true : false;
	}

	public function addClass($class)
	{
		if ($this->hasAttribute('class')) {
			$this->attributes['class'] .= ' '.$class;
		} else {
			$this->attributes['class'] = $class;
		}
	}

	public function hasClass($class)
	{
		if ($this->hasAttribute('class')) {
			if (preg_match("/{$class}/", $this->getAttribute('class'))) {
				return true;
			}
		}
		return false;
	}

	public function setShortMessage($message)
	{
		$this->shortMessage = $message;
	}

	public function isUnique()
	{
		return $this->isUnique;
	}

	public function render()
	{
		$additionalClasses = array();
		$additional = '';
		if ($this->hasClass('form-error')) {
			$additional = '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>';
			array_push($additionalClasses, 'has-error');
			array_push($additionalClasses, 'has-feedback');
			$this->setAttribute('data-placement', 'left');
			$this->setAttribute('data-toggle', 'tooltip');
			$this->setAttribute('title', $this->shortMessage);
			$this->addClass('what');
		}
		return '<div class="form-group '.join(" ", $additionalClasses).'"><input '.$this->getAttributes().' />'.$additional.'</div>';
	}

}
