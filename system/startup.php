<?php

use System\engine\Autoloader;
use System\engine\Router;
use System\exceptions\RouteExceptions;
use System\library\db\DBPDO;


//Default configuration
if (is_file(DIR_SYSTEM . 'config/default.php')){
    require_once  DIR_SYSTEM . 'config/default.php';
}

//Composer Autoload
if (is_file(DIR_STORAGE . 'vendor/autoload.php')){
    require_once DIR_STORAGE . 'vendor/autoload.php';
}

//Class autoloading for older PHP versions <= 7.0
$load = new Autoloader();



//Router
try {
    Router::getInstance()->route(); // route = маршрут.
    //Router::getInstance();
} catch (RouteExceptions $e){
    exit ($e->getMessage());
}

//DB
$db = new DBPDO(DB_DRIVER, DB_DBNAME, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_PORT);
$db->dbIsConnection();

require_once 'tests/index.php';

