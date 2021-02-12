<?php


namespace System\settings;


class Settings
{
    static private $_instance;

    //Глобальные настройки:
    //Свойства маршрутов
    private array $routes =
        [
            'admin' =>  //Административная часть  http://x.app.loc/admin/controller/nameController/id/1 http://x.app.loc/admin/controller/goods/getGoods/sale
                [
                    'alias' => 'admin',
                    'path' => 'admin/controller/',
                    'hrUrl' => false,
                    'routes' => [
                        //'users' => 'user/getAddUser/saleAdd',
                    ],
                ],
            'settings' =>
                [
                    'path' => 'system/settings/',
                ],
            'plugins' =>
                [
                    'path' => 'system/library/plugins/',
                    'hrUrl' => false,
                    'dir' => false,
                ],
            'user' =>  //Пользовательская часть
                [
                    'path' => 'app/controller/',
                    'hrUrl' => true,
                    'routes' => [
                        //'папка' => 'alias/ходные данные/выходные двнные в шаблон'
                        //'personnel' => 'Test',

                    ],
                ],
            'default' => [  // index
                'controller' => 'IndexController',
                'inputMethod' => 'inputData', #Входные данные
                'outputMethod' => 'outputData' #Выходные данные в пользовательскую часть

            ],
        ];

    private array $templateArr = [
        'text' => ['name', 'phone', 'address'],
        'textarea' => ['content', 'keywords'],

    ];
    private string $lalala = 'lalala';


    public function __construct()
    {
    }

    public function __clone()
    {
    }

    public static function get($property)
    {
        return self::instance()->$property;
    }

    //Шаблон проэктирования Синголтон
    public static function instance()
    {
        if (self::$_instance instanceof self) {
            return self::$_instance;
        }
        return self::$_instance = new self;
    }

    public function clueProperties($class)
    {
        $baseProperties = [];

        foreach ($this as $name => $item) {
            $property = $class::get($name);

            //Клеим массивы
            if (is_array($property) && is_array($item)) {
                //Вызываем метод
                $baseProperties[$name] = $this->arrayMergeRecursive($this->$name, $property);
                continue;
            }

            if (!$property) $baseProperties[$name]->$name;
        }
        return $baseProperties;
    }

    //Клеим массивы - рекурсивный метод
    public function arrayMergeRecursive()
    {
        $arrays = func_get_args();
        $base = array_shift($arrays);

        foreach ($arrays as $array) {
            foreach ($array as $key => $value) {
                if (is_array($value) && is_array($base[$key])) {
                    $base[$key] = $this->arrayMergeRecursive($base[$key], $value);
                } else {
                    if (is_int($key)) {
                        if (!in_array($value, $base)) array_push($base, $value);
                        continue; //Если все хорошо идем на следующую итерацию цикла.
                    }
                    $base[$key] = $value;
                }
            }
        }
        return $base;
    }

}