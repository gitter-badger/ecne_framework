<?php

/**
* 	Class DateTest
*	@extends \PHPUnit_Framework_TestCase
*	@author John O'Grady
*	@date 22/06/15
*/
class DateTest extends \PHPUnit_Framework_TestCase
{
	public function testGetOrdinal()
	{
		$expected = array(
			'st' => 1,
			'nd' => 2,
			'rd' => 3,
			'th' => 4,
			'th' => 13,
			'st' => 101
		);
		foreach ($expected as $expect => $val) {
			$result = \Classes\Date::getOrdinal($val);
			$this->assertEquals($expect, $result, $val);
			$this->assertInternalType('string', $result);
		}
	}
}