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
                         Я нужен для проверки пути обнаружения класса в папке: 
                         '. is_dir($_SERVER['DOCUMENT_ROOT']).' - Классы контроллеров - App
                  </br> '.
            '</pre>';
    }
    public function hello()
    {
        $template = $this->render(false, ['name'=>'Я страница сайта - метод: hello']);
        exit($template);
    }

    public function inputData()
    {
        $template = $this->render(false, ['name'=>'Я страница сайта - метод: inputData']);
        exit($template);
    }

    public function outputData ()
    {

    }

}