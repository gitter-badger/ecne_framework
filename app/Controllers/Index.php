<?php
/**
 * Class Index
 * @extends Controller
 * @author John
 * @date: 20/06/2015
 *
 */

namespace Controllers;

use Core\Controller as Controller;

class Index extends Controller
{
    /**
     *  @method default constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     *  @method index
     */
    public function index()
    {
        $this->view->set('title', 'Home Page');
        $this->view->view('index/index')->render();
    }
}   /** End Class Definition **/