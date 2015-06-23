<?php

/**
* 
*/

namespace Classes\Form;

class Submit extends Element
{
	function __construct($attributes)
	{
		parent::__construct(Element::TYPE_SUBMIT, $attributes);
	}
}