<?php


namespace System\engine;


use JetBrains\PhpStorm\NoReturn;
use System\exceptions\RouteExceptions;

abstract class Controller
{
    protected $page;
    protected $errors;

    protected $controller;
    protected $inputMethod;
    protected $outputMethod;
    protected $parameters;

    public function route()
    {
        $controller = str_replace('/', '\\', $this->controller);
        //динамическое подключение контроллеров
        try {
            //Проверка обработки содежимого классов
            $object = new \ReflectionMethod($controller, 'request');

            //Обновляем свойства класса
            $args = [
                'parameters' => $this->parameters,
                'inputMethod' => $this->inputMethod,
                'outputMethod' => $this->outputMethod
            ];

            $object->invoke(new $controller, $args);

        } catch (\ReflectionException $e) {
            throw new RouteExceptions($e->getMessage());

        }


    }

    public function request($args)
    {
        //Принимаем массив аргументов
        $this->parameters = $args['parameters'];

        $inputData = $args['inputMethod'];
        $outputData = $args['outputMethod'];

        $this->$inputData();
        $this->page = $this->$outputData(); // Придет готовая страница

        if($this->errors){
            $this->writeLog();
        }
        $this->getPage();
    }

    /**
     * Шаблонизатор, мне нужен TWIG
     *
     * @param string $path
     * @param array $parameters
     */
    protected function render($path = '', $parameters = [])
    {

    }

    #[NoReturn] protected function getPage(): void
    {
        exit($this->page);
    }


}