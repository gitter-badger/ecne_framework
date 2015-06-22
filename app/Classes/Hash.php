<?php

/**
 * Class \Classes\Hash
 * @author John O'Grady
 * @date 22/06/15
 */

namespace Classes;
class Hash
{
    /**
     * @method make
     * @access public
     * @param $string
     * @param string $salt
     * @return string
     */
	public static function make($string, $salt = '')
    {
		return hash('sha256', $string . $salt);
	}

    /**
     * @method salt
     * @access public
     * @param $length
     * @return string
     */
	public static function salt($length)
    {
		return mcrypt_create_iv($length);
	}

    /**
     * @method unique
     * @access public
     * @return string
     */
	public static function unique()
	{
		return self::make(uniqid());
	}
}