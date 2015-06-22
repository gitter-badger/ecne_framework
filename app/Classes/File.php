<?php

/**
 * Class File
 */

namespace Classes;

class File
{
    public function __construct()
    {

    }
    /**
     * @method exists
     * @access public
     * @param $file
     * @return bool
     */
    public static function exists($file)
    {
        return (file_exists($file)) ? true : false;
    }

    /**
     * @method controller
     * @access public
     * @param $controller
     * @return bool
     */
    public static function controller($controller)
    {
        if (self::exists(ROOT.'/app/Controllers/'.$controller.'.php')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @method model
     * @access public
     * @param $model
     * @return bool
     */
    public static function model($model)
    {
        if (self::exists(ROOT.'/app/models/'.$model.'Model.php')) {
            return true;
        } else {
            return false;
        }
    }
}   /** End Class Definition **/