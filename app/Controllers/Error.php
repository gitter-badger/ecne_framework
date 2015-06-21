<?php

/**
 * Class Error
 * @extends Controller
 * @author John O'Grady
 * @date 20/06/2015
 */

namespace Controllers;
class Error extends Controller
{
    /**
     * @method default constructor
     * @access public
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @method index
     * @access public
     * @throws Exception
     */
    public function index()
    {
        $this->view->view('error/index')->render();
    }
}   /** End Class Definition **/