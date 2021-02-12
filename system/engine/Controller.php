<?php


namespace System\engine;


use System\exceptions\RouteExceptions;

abstract class Controller
{
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
                'parameters' => '$this->parameters',
                'inputMethod' => '$this->inputMethod',
                'outputMethod' => '$this->outputMethod'
            ];

            $object->invoke(new $controller, $args);

        } catch (\ReflectionException $e) {
            throw new RouteExceptions($e);

        }


    }

    public function request($args)
    {
        
    }


}