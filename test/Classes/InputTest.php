<?php

/**
* 	Class InputTest
*/

class InputTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * 	@method testGetReturnsEmptyWhenNullIndex
	 */
	public function testGetReturnsEmptyWhenNullIndex()
	{
        $result = \Classes\Input::get('foo');
		$this->assertEquals('', $result);
		$this->assertInternalType('string', $result);
	}

    /**
     * @method testExistsReturnsBoolean
     */
    public function testExistsReturnsBoolean()
    {
        $result = \Classes\Input::exists('foo');
        $this->assertEquals(false, $result);
        $this->assertInternalType('bool', $result);
    }

    public function testSecureReturnsFalse()
    {
        $result = \Classes\Input::secure();
        $this->assertFalse($result);
        $this->assertInternalType('bool', $result);
    }
}