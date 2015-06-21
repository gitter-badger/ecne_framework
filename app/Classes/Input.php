<?php

/**
 * Class Input
 */

namespace Classes;
class Input
{
    /**
     * @method exists
     * @access public
     * @param $key
     * @return bool
     */
    public static function exists($key)
    {
        return (isset($_GET[$key]) || isset($_POST[$key])) ? true : false;
    }

    /**
     * @method get
     * @access public
     * @param $key
     * @return string
     */
    public static function get($key)
    {
        if (isset($_GET[$key])) {
            return $_GET[$key];
        } else if (isset($_POST[$key])) {
            return $_POST[$key];
        } else {
            return '';
        }
    }

    /**
     * @method clean
     * @access public
     * @param $string
     * @return mixed
     */
    public static function clean($string)
    {
       return strip_tags(htmlspecialchars(preg_replace("/[^a-zA-Z0-9-_\/]/", '', $string)));
    }
} /** End Class Definition **/