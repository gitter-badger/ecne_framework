<?php

/**
 * Class Submit
 * @extends \Classes\Form\Element
 * @author John O'Grady
 * @date 23/06/15
 */
namespace Classes\Form;

class Submit extends Element
{
    function __construct($attributes)
    {
        parent::__construct(Element::TYPE_SUBMIT, $attributes);
    }
}