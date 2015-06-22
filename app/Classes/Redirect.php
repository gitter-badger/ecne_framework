<?php

/**
 * Class Redirect
 */

namespace Classes;

class Redirect
{
    /**
     * @method to
     * @access public
     * @param null $location
     */
    public static function to($location = null)
    {
        if ($location) {
            header('Location:' . $location);
            exit();
        }
    }
}   /** End Class Definition **/