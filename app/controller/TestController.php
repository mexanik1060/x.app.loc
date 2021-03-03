<?php


namespace App\controller;


class Test
{
    public function __construct(){

        echo '<pre>'.
                '</br> - Я тестовый контроллер по пути: app/controller/Test. 
                 </br>'.
                 '</br>
                         Я нужен для проверки пути обнаружения классав в папке: 
                         app/controller/alias/папка/Классы контроллеров 
                  </br> '.
             '</pre>';
    }
}