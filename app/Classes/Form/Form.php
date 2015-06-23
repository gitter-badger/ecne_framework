<?php

/**
 * Class Form
 * @author John O'Grady
 * @date 23/06/15
 */

namespace Classes\Form;

class Form
{
    /**
     * @var string
     */
	private $action;
    /**
     * @var string
     */
	private $method;
    /**
     * @var string
     */
	private $formHead;
    /**
     * @var string
     */
	private $title;
    /**
     * @var string
     */
	private $formFoot = '</form>';
    /**
     * @var array
     */
	private $elements = array();

    /**
     * @method construct
     * @access public
     * @param $title
     * @param $action
     * @param $method
     */
    public function __construct($title, $action, $method)
	{
		self::init($title, $action, $method);
	}

    /**
     * @method init
     * @access public
     * @param $title
     * @param $action
     * @param $method
     */
    public function init($title, $action, $method)
	{
		$this->action = $action;
		$this->method = $method;
		$this->title = self::parseTitle($title);
		$this->formHead = '<form action="'.$this->action.'" method="'.$this->method.'">';
		$this->formHead .= '<h'.$this->title[1].'>'.$this->title[0].'</h'.$this->title[1].'>';
	}

    /**
     * @method parseTitle
     * @access public
     * @param $title
     * @return array
     */
    public function parseTitle($title)
	{
		if (preg_match('/|/', $title)) {
			return (explode("|", $title));
		}
	}

    /**
     * @method addElement
     * @access public
     * @param $element
     */
    public function addElement($element)
	{
		array_push($this->elements, $element);
	}

    /**
     * @method getElements
     * @access public
     * @return array
     */
    public function getElements()
	{
		return $this->elements;
	}

    /**
     * @method build
     * @access public
     */
    public function build()
	{
		$this->formHead .= '<input type="hidden" name="token" value="'.\Classes\Token::generate().'" />';
		$form = $this->formHead;
		foreach ($this->elements as $element) {
			$form .= $element->render();
		}
		$form .= $this->formFoot;
		echo $form;
	}
}   /** End Class Definition **/
