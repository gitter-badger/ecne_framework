<?php
/**
 * File index
 * @author John O'Grady
 * Date: 20/06/2015
 */

use Core\BootStrap as BootStrap;

include_once __DIR__ . '/app/Core/init.php';

$bootstrap = new BootStrap(@$_GET['url']);