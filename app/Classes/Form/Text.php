<?php

/**
 * Class Text
 * @extends \Classes\Form\Element
 * @author John O'Grady
 * @date 23/06/15
 */

namespace Classes\Form;

class Text extends Element
{
    function __construct($attributes, $unique = 'false')
    {
        parent::__construct(Element::TYPE_TEXT, $attributes, $unique);
    }
}