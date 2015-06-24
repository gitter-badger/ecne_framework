<?php

/**
 * Created by PhpStorm.
 * User: John
 * Date: 24/06/2015
 * Time: 20:51
 */
class DataBaseTest extends PHPUnit_Framework_TestCase
{

    protected $database;

    public function setUp()
    {
        $this->database = \Classes\DataBase::getInstance();
    }
}
