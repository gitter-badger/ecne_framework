<?php

/**
 *  Class \Classes\Validation
 * @author John O'Grady
 * @date 22/06/15
 */

namespace Classes;

use Classes\Form\Form as Form;

class Validation
{
    /**
     * @var bool
     */
    private $passed = false;
    /**
     * @var array
     */
    private $errors = array();
    /**
     * @var array
     */
    private $rules = array(
        'min',
        'max',
        'contains',
        'email',
        'eql'
    );

    public function __construct()
    {
    }

    /**
     * @method check
     * @access public
     * @param \Classes\Form\Form $form
     * @return $this
     */
    public function check(Form $form)
    {
        if (\Classes\Input::secure()) {
            foreach ($form->getElements() as $element) {
                if ($element->isUnique() !== 'false' && preg_match('/|/', $element->isUnique())) {
                    $criteria = explode('|', $element->isUnique());
                    $check = \Classes\DataBase::getInstance()
                        ->selectColumns(array('id'))
                        ->fromTable($criteria[1])
                        ->whereEquals(array($criteria[0], \Classes\Input::cleanUserInput(\Classes\Input::get($element->getAttributesArray()['name']))))
                        ->run()
                        ->result();
                    if (count($check)) {
                        $this->addError($element->getAttributesArray()['name'], \Classes\Input::cleanUserInput(\Classes\Input::get($element->getAttribute('name'))) . " already exists");
                        $element->setShortMessage(\Classes\Input::cleanUserInput(\Classes\Input::get($element->getAttribute('name'))) . " already exists");
                    }
                }
                foreach ($element->getAttributesArray() as $attr => $value) {
                    if (!in_array($attr, $this->rules)) {
                        continue;
                    }
                    switch ($attr) {
                        case 'min':
                            if (strlen(\Classes\Input::get($element->getAttributesArray()['name'])) < intval($value)) {
                                $this->addError($element->getAttributesArray()['name'], "Too small");
                                $element->setShortMessage("Must be greather than {$value} characters");
                            }
                            break;
                        case 'max':
                            if (strlen(\Classes\Input::get($element->getAttributesArray()['name'])) > intval($value)) {
                                $this->addError($element->getAttributesArray()['name'], "Too big");
                                $element->setShortMessage("Must be less than {$value} characters");
                            }
                            break;
                        case 'eql':
                            if (!(\Classes\Input::get($element->getAttributesArray()['name']) == \Classes\Input::get($value))) {
                                $this->addError($element->getAttributesArray()['name'], "Not equal");
                                if ($element->getAttributesArray()['type'] == 'password') {
                                    $element->setShortMessage('Passwords do not match');
                                } else if ($element->getAttributesArray()['type'] == 'email') {
                                    $element->setShortMessage('Emails do not match');
                                }
                            }
                            break;
                        default:
                            break;
                    }
                }
            }
        } else {
            $this->addError('global-warning', "Error in request");
            \Classes\Session::flash('global-warning', 'Error in request');
        }
        if (count($this->errors)) {
            $this->passed = false;
        } else {
            $this->passed = true;
        }
    }

    /**
     * @method addError
     * @access private
     * @param $error
     */
    private function addError($name, $error)
    {
        $this->errors[$name] = $error;
    }

    /**
     * @method errors
     * @access public
     * @return array
     */
    public function errors()
    {
        return $this->errors;
    }

    /**
     * @method passed
     * @access public
     * @return bool
     */
    public function passed()
    {
        return $this->passed;
    }
}   /** End Class Definition **/