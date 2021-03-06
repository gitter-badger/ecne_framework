<?php
/**
 * Class Email
 * @extends \Classes\Form\Element
 * @author John O'Grady
 * @date 23/06/15
 *
 */

namespace Classes\Form;

class Email extends Element
{
    /**
     * @method construct
     * @access public
     * @param $attributes
     */
    function __construct($attributes, $unique = 'false')
    {
        parent::__construct(Element::TYPE_EMAIL, $attributes, $unique);
    }
}