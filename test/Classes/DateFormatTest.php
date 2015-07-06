<?php

/**
 * Created by PhpStorm.
 * User: John
 * Date: 06/07/2015
 * Time: 21:56
 */
class DateFormatTest extends \PHPUnit_Framework_TestCase
{
    public function testDateFormatIsCorrect()
    {
        $result = \Classes\DateFormat::get()->date('2000-01-01')->format('Y-m-d H:i:s')->run();
        $this->assertEquals('2000-01-01 00:00:00', $result);
    }
}