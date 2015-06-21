<?php
/**
 * File init
 * @author John O'Grady
 * @date 21/06/2015
 */

/**
 * @note include autoloader file
 */
include_once dirname(dirname(__DIR__)).'/vendor/autoload.php';

define('ROOT', dirname(dirname(__DIR__)));
define('VIEWS', dirname(dirname(__DIR__)).'\app\views\\');
define('URL', 'http://localhost/');