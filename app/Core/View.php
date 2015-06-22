<?php

/**
 * Class View
 * @author John O'Grady
 * @date: 20/06/2015
 */

namespace Core;

use Classes\File as File;
use Classes\Helper as Helper;
use \Exception;

class View
{
    /**
     * @var string
     */
    protected $view;
    /**
     * @var array
     */
    protected $data = array();
    /**
     * @var mixed
     */
    protected $output;

    /**
     * overloaded constructor
     * @access public
     * @param string $view
     */
    public function __construct($view='')
    {
        if ($view) {
            $this->view = $view;
        }
    }

    /**
     * @method set
     * @access public
     * @param $key
     * @param $value
     */
    public function set($key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * @method get
     * @access public
     * @param $key
     * @return null
     */
    public function get($key)
    {
        if (isset($this->data[$key])) {
            return $this->data[$key];
        } else {
            return NULL;
        }
    }

    /**
     * @method getData
     * @access public
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @method view
     * @access public
     * @param $view
     * @return $this
     */
    public function view($view)
    {
        $this->view = $view;
        return $this;
    }

    /**
     * @method render
     * @access public
     * @throws Exception
     */
    public function render()
    {
        if (File::exists(Helper::replaceDirSeparator(VIEWS.$this->view).'.php')) {
            ob_start();
            include Helper::replaceDirSeparator(VIEWS.'header.inc').'.php';
            include Helper::replaceDirSeparator(VIEWS.$this->view).'.php';
            include Helper::replaceDirSeparator(VIEWS.'footer.inc').'.php';
            $this->output = ob_get_contents();
            ob_end_clean();
            echo $this->output;
        } else {
            throw new Exception('View does not exist');
        }
    }
}   /** End Class Definition **/