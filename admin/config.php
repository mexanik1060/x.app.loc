<?php


defined('VG_ACCESS') or die ('ERROR_404');

//Server
const HTTP_SERVER = 'http://x.app.loc/admin/';
const HTTPS_SERVER = 'https://x.app.loc/';

define('HTTP_CATALOG', 'http://x.app.loc/');
define('HTTPS_CATALOG', 'https://x.app.loc/');



//DIR_FILES
const DIR_APPLICATION           = 'E:/openserver/domains/x.app.loc/admin/';
const DIR_SYSTEM                = 'E:/openserver/domains/x.app.loc/system/';
const DIR_TEMPLATE              = DIR_APPLICATION  . 'view/template/';
const DIR_LIBRARY               = DIR_SYSTEM . 'library/';
const DIR_CONFIG                = DIR_SYSTEM . 'library/config/';


const DIR_STORAGE               = DIR_SYSTEM . 'storage/';
const DIR_SRC_TWIG              = DIR_SYSTEM . 'storage/vendor/twig/twig/src/';
const DIR_LIB_TWIG              = DIR_SYSTEM . 'storage/vendor/twig/twig/lib/Twig/';
const DIR_CACHE                 = DIR_SYSTEM . 'storage/cache/';


//DB
const DB_DRIVER         = 'mysql';
const DB_HOSTNAME       = 'localhost';
const DB_DBNAME         = 'oses';
const DB_USERNAME       = 'root';
const DB_PASSWORD       = 'root';
const DB_PORT           = '3306';
const DB_CHARSET        = 'utf-8';
