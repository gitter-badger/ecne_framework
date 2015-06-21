<?php

/**
 * Created by PhpStorm.
 * User: John
 * Date: 21/06/2015
 * Time: 15:00
 */

class HelperTest extends \PHPUnit_Framework_TestCase
{

    public function testReplaceDirSeparatorReturnsBackSlash()
    {
        $this->assertEquals("\\", \Classes\Helper::replaceDirSeparator('/'));
    }
}