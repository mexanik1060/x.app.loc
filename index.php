<?php


define('VG_ACCESS', true);

// Version
define('VERSION', '1.0.3.0');
header('Content-Type:text/html; charset=utf-8');
session_start();


//Config
if (is_file('config.php')){
    require_once 'config.php';

}
// Install
if (!defined('DIR_APPLICATION')) {
    header('Location: install/index.php');
    exit;
}
//Для теста -------------------------------------//
$adress_str = $_SERVER['REQUEST_URI'];
echo '<pre>' . 'Ссылка \'REQUEST_URI\'' .'--'. $adress_str . '</br>' . '</pre>';
//-----------------------------------------------//


// Startup
require_once(DIR_SYSTEM . 'startup.php');











