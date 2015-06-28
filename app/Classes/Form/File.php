<?php

/**
 * Class File
 * @author John O'Grady
 * @date 28/06/15
 */


namespace Classes\Form;


class File extends Element
{
    public function __construct($attributes, $unique = 'false')
    {
        parent::__construct(Element::TYPE_FILE, $attributes, $unique);
    }
}