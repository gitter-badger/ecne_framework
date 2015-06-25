<?php

/**
 * Created by PhpStorm.
 * User: John
 * Date: 24/06/2015
 * Time: 20:51
 */

require_once dirname(dirname(__DIR__)).'/app/Core/init.php';

class DataBaseTest extends PHPUnit_Framework_TestCase
{

    protected $database;

    public function setUp()
    {
        $this->database = \Classes\DataBase::getInstance();
        $this->database->execute('CREATE TABLE IF NOT EXISTS test (id int(11) not null auto_increment, test varchar(20) not null, primary key(id))');
    }

    public function tearDown()
    {
        $this->database = null;
    }

    public function testDBResultCountIsZeroWhenCreated()
    {
        $this->assertEquals(0, count($this->database->result()));
    }

    public function testDBResultCountIncreasesAfterInsert()
    {
        $this->database = \Classes\DataBase::getInstance()
            ->fromTable('test')
            ->selectColumns(array('*'))
            ->run();
        $countBefore = count($this->database->result());
        $this->database = \Classes\DataBase::getInstance()
            ->fromTable('test')
            ->insert(array(
                'id' => '',
                'test' => date('Y-m-d H:i:s')
            ))
            ->run();
        $this->database = \Classes\DataBase::getInstance()
            ->fromTable('test')
            ->selectColumns(array('*'))
            ->run();
        $countAfter = count($this->database->result());
        $this->assertLessThan($countAfter, $countBefore);
    }
}
