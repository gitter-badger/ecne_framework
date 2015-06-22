<?php

/**
 * Class Controller
 * @author John O'Grady
 * @date 20/06/2015
 */

namespace Core;
class Controller
{
    /**
     * @var View
     */
    protected $view;
    /**
     * @var Model
     */
    protected $model;

    /**
     *  default constructor
     */
    public function __construct()
    {
        $this->view = new View();
    }

    /**
     * @method index
     * @access public
     */
    public function index()
    {
        echo "this is the controller class default index method...";
    }

    /**
     * @method model
     * @access public
     * @param $model
     * @param array $params
     */
    public function model($model, $params = array())
    {
        if (\Classes\File::model($model)) {
            $sModel = $model.'Model';
            $this->model = new $sModel(join(',', $params));
        }
    }
}   /** End Class Definition */