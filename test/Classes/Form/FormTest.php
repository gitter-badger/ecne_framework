<?php

/**
 *  Class FormTest
 * @author John O'Grady
 * @date 24/06/2015
 */
class FormTest extends PHPUnit_Framework_TestCase
{
    protected $form;

    /**
     * @method setUp
     */
    public function setUp()
    {
        $this->form = new \Classes\Form\Form('Test Title|3', '', 'POST');
    }

    public function testElementCountIsZeroWhenCreatingForm()
    {
        $this->assertEquals(0, count($this->form->getElements()));
    }

    public function testAddElementIncreasesElementCount()
    {
        $this->form->addElement(new \Classes\Form\Text(array('required'=>'required')));
        $this->assertEquals(1, count($this->form->getElements()));
    }

    public function testSetTitleSetsTitleToNumber()
    {
        $this->form->setTitle('This is a test title|3');
        $this->assertEquals(3, $this->form->getTitle());
        $this->assertInternalType('string', $this->form->getTitle());
    }

    public function testSetTitleSetsBannerToString()
    {
        $this->form->setTitle('This is a test title|3');
        $this->assertInternalType('string', $this->form->getBanner());
    }
}
