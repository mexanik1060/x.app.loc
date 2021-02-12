<?php


namespace App\controller;


use System\engine\Controller;

class IndexController extends Controller
{
    public function __construct(){

        echo '<pre>'.
            '</br> - Я тестовый index контроллер по пути: app/controller/IndexController.php. 
                 </br>'.
            '</br>
                         Я нужен для проверки пути обнаружения классав в папке: 
                         '. is_dir($_SERVER['DOCUMENT_ROOT']).'Классы контроллеров 
                  </br> '.
            '</pre>';
    }

}