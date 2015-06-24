<?php

/**
 * Class Hidden
 * @extends \Classes\Form\Element
 * @author John O'Grady
 * @date 23/06/15
 */

namespace Classes\Form;

class Hidden extends Element
{

    function __construct($attributes, $unique = 'false')
    {
        parent::__construct(Element::TYPE_HIDDEN, $attributes, $unique);
    }
}