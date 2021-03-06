<?php

/**
 * Class Form
 * @author John O'Grady
 * @date 23/06/15
 */

namespace Classes\Form;

use Classes\Config as Config;
use Classes\Token as Token;

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
    private $title;
    /**
     * @var string
     */
    private $banner;
    /**
     * @var string
     */
    private $token;
    /**
     * @var array
     */
    private $elements = array();
    /**
     * @var string
     */
    private $output;

    /**
     * @method construct
     * @access public
     * @param $title
     * @param $action
     * @param $method
     */
    public function __construct($title, $action, $method)
    {
        $this->init($title, $action, $method);
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
        $this->setTitle($title);
    }

    /**
     * @method setTitle
     * @access public
     * @param $title
     */
    public function setTitle($title)
    {
        if (preg_match('/[a-zA-Z0-9\s]{1,}[|]{1}[1-5]{1}/', $title, $matches)) {
            $title = explode('|', $matches[0]);
            $this->title = $title[1];
            $this->banner = $title[0];
        } else {
            $this->title = '2';
            $this->banner = $title;
        }
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setBanner($banner)
    {
        $this->banner = $banner;
    }

    public function getBanner()
    {
        return $this->banner;
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
     * @method buildFormHeader
     * @access public
     * @return string
     */
    public function buildFormHeader()
    {
        return '<form action="' . $this->action . '"><h' . $this->title . '>' . $this->banner . '</h' . $this->title . '>';
    }

    /**
     * @method buildToken
     * @access public
     * @return string
     */
    public function buildToken()
    {
        $this->token = Token::generate();
        return '<input type="hidden" name="' . Config::get('token/name') . '" value="' . $this->token . '" />';
    }

    public function buildBody()
    {
        $body = '';
        foreach ($this->elements as $element) {
            $body .= $element->render();
        }
        return $body;
    }

    /**
     * @method buildFormFooter
     * @access public
     * @return string
     */
    public function buildFormFooter()
    {
        return '</form>';
    }

    /**
     * @method splash
     * @access public
     * @param $output
     */
    public function splash($output)
    {
        ob_start();
        echo $output;
        $this->output = ob_get_contents();
        ob_end_clean();
        echo $this->output;
    }

    /**
     * @method render
     * @access public
     */
    public function render()
    {
        $this->output = join(" ", array(
            $this->buildFormHeader(),
            $this->buildToken(),
            $this->buildBody(),
            $this->buildFormFooter()
        ));
        $this->splash($this->output);
    }
}