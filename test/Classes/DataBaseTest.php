<?php

/**
 * Created by PhpStorm.
 * User: John
 * Date: 24/06/2015
 * Time: 20:51
 */

use Classes\Helper;

require_once dirname(dirname(__DIR__)).Helper::replaceDirSeparator('/app/Core/init.php');

class DataBaseTest extends PHPUnit_Framework_TestCase
{

    protected $database;

    public function setUp()
    {
        $this->database = \Classes\DataBase::getInstance();
    }

    public function testDBResultCountIsZeroWhenCreated()
    {
        $this->assertEquals(0, count($this->database->result()));
    }
}
