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
		$this->assertEquals('', \Classes\Input::get(''));
	}
}