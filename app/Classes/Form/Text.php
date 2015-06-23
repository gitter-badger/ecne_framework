<?php

/**
* 
*/

namespace Classes\Form;

class Text extends Element
{	
	function __construct($attributes, $unique = 'false')
	{
		parent::__construct(Element::TYPE_TEXT, $attributes, $unique);
	}
}