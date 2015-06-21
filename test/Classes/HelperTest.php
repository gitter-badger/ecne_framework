<?php

/**
 * Class HelperTest
 * @extends PHPUnit_Framework_TestCase
 * @author John O'Grady
 * Date: 21/06/2015
 */

class HelperTest extends \PHPUnit_Framework_TestCase
{
    public function testReplaceDirSeparatorReturnsBackSlash()
    {
        $this->assertEquals("\\", \Classes\Helper::replaceDirSeparator('/'));
    }
}