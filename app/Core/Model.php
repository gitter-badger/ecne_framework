<?php

/**
 * Class Model
 * @author John O'Grady
 * @date 21/06/2015
 */

namespace Core;

class Model
{
    /**
     * @var DataBase
     */
    protected $database;

    /**
     * @method default constructor
     * @access public
     */
    function __construct()
    {
        $this->database = DataBase::getInstance();
    }
}