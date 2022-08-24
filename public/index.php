<?php


use App\core\Router;

/*
 * Dirs
 */
define('ROOT', dirname(__DIR__));
define('APP', dirname(__DIR__) . '/app');

const CONTROLLER_NAMESPACE = "App\mvc\controllers\\";
const DEFAULT_LAYOUT = APP . "/mvc/views/layout/main_layout.php";
const SITE_NAME = "Framework My";

require_once ROOT . "/vendor/autoload.php";
require_once APP . "/dum.php";
require_once APP . "/routes/main.php";


Router::start();
