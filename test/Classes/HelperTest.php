<?php

/**
 * Class HelperTest
 * @extends PHPUnit_Framework_TestCase
 * @author John O'Grady
 * @date 21/06/2015
 */

class HelperTest extends \PHPUnit_Framework_TestCase
{
    public function testReplaceDirSeparatorReturnsBackSlash()
    {
        $result = \Classes\Helper::replaceDirSeparator('/');
        $this->assertEquals("\\", $result, '/');
        $this->assertInternalType('string', $result);
    }
}