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
    /**
     * @method construct
     * @access public
     * @param $attributes
     */
    function __construct($attributes)
    {
        parent::__construct(Element::TYPE_PASSWORD, $attributes);
    }
}