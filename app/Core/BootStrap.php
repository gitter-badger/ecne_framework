<?php

/**
 * Class BootStrap
 * @author John O'Grady
 * @date 20/06/2015
 */

namespace Core;

use Classes\Input as Input;
use Classes\File as File;

class BootStrap
{
    /**
     * @var string
     */
    private $url;
    /**
     * @var array
     */
    private $urlSplit;
    /**
     * @var Controller
     */
    private $controller;

    /**
     * @method construct
     * @access public
     * @param string $url
     */
    public function __construct($url='')
    {
        $this->url = $url;
        if ($this->url) {
            $this->route($this->url);
        } else {
            $this->route('');
        }
    }

    /**
     * @method route
     * @access public
     * @param string $url
     */
    public function route($url='')
    {
        if ($url) {
            $this->url = Input::clean($url);
            $this->urlSplit = explode('/', $this->url);
        }
        if (isset($this->urlSplit[0])) {
            if (File::controller($this->urlSplit[0])) {
                $this->controller = "Controllers\\".ucfirst($this->urlSplit[0]);
                $this->controller = new $this->controller;
                if (isset($this->urlSplit[1]) && method_exists($this->controller, $this->urlSplit[1])) {
                    if(isset($this->urlSplit[2])) {
                        $this->controller->{$this->urlSplit[1]}($this->urlSplit[2]);
                    } else {
                        $this->controller->{$this->urlSplit[1]}();
                    }
                } else {
                    $this->controller->index();
                }
            } else {
                $this->controller = new \Controllers\Error();
                $this->controller->index();
            }
        } else {
            $this->controller = new \Controllers\Index();
            $this->controller->index();
        }
    }
}   /** End Class Definition **/