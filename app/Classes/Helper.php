<?php

/**
 * Class Helper
 */

namespace Classes;
class Helper
{
    /**
     * @method replaceDirSeparator
     * @access public
     * @param $dir
     * @return mixed
     */
    public static function replaceDirSeparator($dir)
    {
        if (preg_match('|/|', $dir)) {
            return preg_replace('|/|','\\',$dir);
        } else {
            return $dir;
        }
    }
}