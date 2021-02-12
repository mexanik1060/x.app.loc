<?php

namespace System\settings;

use System\settings\Settings;

class ShopSettings
{
    ###########################################
    static private $_instance;

    private $baseSettings;
    // Массивы - значения можно изменять
    private array $routes =
        [
            'plugins' => [
                //'path' => 'system/library/plugins/',// можно убрать
                //'path' => 'app/plugins/', // задаем альтернативный путь размещения файлов
                //'hrUrl' => false, // можно убрать
                //'dir' => 'controller', // подключаем когда понадобятся плагины
                'dir' => false,
                'routes' => [

                ],
            ],
        ];


    private array $templateArr = [
        'text' => ['price', 'short', 'name'],
        'textarea' => ['text'],
    ];


    #####################################################
    public static function get($property)
    {
        return self::instance()->$property;
    }


    # Шаблон проэктирования Синголтон
    public static function instance(): ShopSettings
    {

        if (self::$_instance instanceof self) {
            return self::$_instance;
        }

        self::$_instance = new self;
        self::$_instance->baseSettings = Settings::instance();
        $baseProperties = self::$_instance->baseSettings->clueProperties(get_class());
        self::$_instance->setProperty($baseProperties);

        return self::$_instance;
    }

    protected function setProperty($properties)
    {
        if ($properties) {
            foreach ($properties as $name => $property) {
                $this->$name = $property;
            }
        }
    }

    # Конец Синголтон

    public function __construct()
    {
    }

    public function __clone()
    {
    }


    #####################################################
}//Конец класса ShopSettings
