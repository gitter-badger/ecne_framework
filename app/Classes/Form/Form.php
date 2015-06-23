<?php

namespace Classes\Form;

class Form
{
	private $action;
	private $method;

	private $formHead;
	private $formTitle;
	private $formFoot = '</form>';

	private $elements = array();

	public function __construct($title, $action, $method)
	{
		self::init($title, $action, $method);
	}

	public function init($title, $action, $method)
	{
		$this->action = $action;
		$this->method = $method;
		$this->title = self::parseTitle($title);
		$this->formHead = '<form action="'.$this->action.'" method="'.$this->method.'">';
		$this->formHead .= '<h'.$this->title[1].'>'.$this->title[0].'</h'.$this->title[1].'>';
	}

	public function parseTitle($title)
	{
		if (preg_match('/|/', $title)) {
			return (explode("|", $title));
		}
	}

	public function addElement($element)
	{
		array_push($this->elements, $element);
	}

	public function getElements()
	{
		return $this->elements;
	}

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
}
