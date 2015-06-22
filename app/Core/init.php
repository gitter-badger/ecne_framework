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


/** @var $GLOBALS */
$GLOBALS['config'] = array(
    'mysql' => array(
        /**
         * Supply your DB Type e.g
         * -MYSQL
         * -POSTGRESQL
         * -SQLITE
         * -MARIADB
         */
        'driver' => 'MYSQL',
        'tables' => array(),
        /**
         * hostname of DB - Default is localhost
         * -MYSQL
         */
        'host' => 'localhost',
        /**
         * DB Users credentials
         * - not used for SQLITE
         */
        'username' => '',
        'password' => '',
        /**
         * DataBase to Use
         * -SQLITE- define full path to DB file e.g path/to/database.db
         */
        'db' => '',
    ),
    'session' => array()
);