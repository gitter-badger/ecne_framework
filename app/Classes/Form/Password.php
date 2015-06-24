<?php

/**
 * Class Password
 * @extends \Classes\Form\Element
 * @author John O'Grady
 * @date 23/06/15
 */

namespace Classes\Form;

class Password extends Element
{
    function __construct($attributes, $unique = 'false')
    {
        parent::__construct(Element::TYPE_PASSWORD, $attributes, $unique);
    }
}