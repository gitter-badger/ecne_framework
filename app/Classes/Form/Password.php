<?php

/**
* 
*/

namespace Classes\Form;

class Password extends Element
{
	
	function __construct($attributes, $unique = 'false')
	{
		parent::__construct(Element::TYPE_PASSWORD, $attributes, $unique);
	}
}