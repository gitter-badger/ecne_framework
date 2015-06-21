<?php

/**
 * Class ConfigTest
 * @extends PHPUnit_Framework_TestCase
 * @author John O'Grady
 * @date 21/06/2015
 */

class ConfigTest extends \PHPUnit_Framework_TestCase
{
    public function testGetReturnsFalseOnNotExist()
    {
        $this->assertEquals(false, \Classes\Config::get('no/path'));
    }
}