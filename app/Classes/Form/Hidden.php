<?php

/**
* 
*/

namespace Classes\Form;

class Hidden extends Element
{
	
	function __construct($attributes, $unique = 'false')
	{
		parent::__construct(Element::TYPE_HIDDEN, $attributes, $unique);
	}
}