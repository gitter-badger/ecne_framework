<?php

/**
 * Class HelperTest
 * @extends PHPUnit_Framework_TestCase
 * @author John O'Grady
 * @date 21/06/2015
 */

require_once dirname(dirname(__DIR__)).'/app/Core/init.php';

class HelperTest extends \PHPUnit_Framework_TestCase
{
    public function testReplaceDirSeparatorReturnsBackSlash()
    {
        $result = \Classes\Helper::replaceDirSeparator('/');
        $this->assertEquals("\\", $result, '/');
        $this->assertInternalType('string', $result);
    }

    public function testReturnDoubleQuotesReturnsDoubleQuotes()
    {
        $result = \Classes\Helper::returnDoubleQuotes('test');
        $this->assertEquals('"test"', $result, 'test');
        $this->assertInternalType('string', $result);
    }
}