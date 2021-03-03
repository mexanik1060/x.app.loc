<?php


namespace System\engine;


use System\settings\Settings;
use System\settings\ShopSettings;


class Router extends Controller
{
    static private $_instance;

    protected $routes;


    public function __clone()
    {
    }

    //Шаблон проэктирования Синголтон
    public static function getInstance()
    {

        if (self::$_instance instanceof self) {
            return self::$_instance;
        }

        return self::$_instance = new self;
    }


    public function __construct()
    {
        //Получаем адресную строку
        $adress_str = $_SERVER['REQUEST_URI'];


        if (strrpos($adress_str, '/') === strlen($adress_str) - 1 && strrpos($adress_str, '/') !== 0) {
            $this->redirect(rtrim($adress_str, '/'), 301);
        }

        $path = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'], 'index.php'));

        if ($path === PATH) {

            $this->routes = Settings::get('routes');
            if (!$this->routes) {throw new RouteException("Сайт находится на техобслуживании!");}


            $url = explode('/', substr($adress_str, strlen(PATH)));

            if ($url[0] && $url[0] === $this->routes['admin']['alias']){
                // Административная панель
                array_shift($url);



                    if ($url[0] && is_dir($_SERVER['DOCUMENT_ROOT'] . PATH . $this->routes['plugins']['path'] . $url[0])) {

                        $plugin = array_shift($url);
                        $pluginSettings = $this->routes['settings']['path'] . ucfirst($plugin . 'Settings');

                        if (file_exists($_SERVER['DOCUMENT_ROOT'] . PATH . $pluginSettings . '.php')) {
                            $pluginSettings = str_replace('/', '\\', $pluginSettings);
                            $this->routes = $pluginSettings::get('routes');
                        }

                        $dir = $this->routes['plugins']['dir'] ? '/' . $this->routes['plugins']['dir'] . '/' : '/';
                        $dir = str_replace('//', '/', $dir);

                        $this->controller = $this->routes['plugins']['path'] . $plugin . $dir;
                        $hrUrl = $this->routes['plugins']['hrUrl'];

                        $route = 'plugins';
                    } else {
                        $this->controller = $this->routes['admin']['path'];
                        $hrUrl = $this->routes['admin']['hrUrl'];
                        //admin
                        $route = 'admin';
                    }


                // Конец административной панели.
            } else {

                $hrUrl = $this->routes['user']['hrUrl'];
                $this->controller = $this->routes['app']['path'];

                //Пользовательская часть
                $route = 'app';
            }

            $this->createRoute($route, $url);

            if ($url[1]) {
                $count = count($url);
                $key = '';

                if (!$hrUrl) {
                    $i = 1;
                } else {
                    $this->parameters['alias'] = $url[1];
                    $i = 2;
                }
                for (; $i < $count; $i++) {
                    if (!$key) {
                        $key = $url[$i];
                        $this->parameters[$key] = '';
                    } else {
                        $this->parameters[$key] = $url[$i];
                        $key = '';
                    }
                }
            }
           //exit(); //для тестов. Убираем когда ксасс готов к работе

            /*--------------------------------------*/
        } else {

            try {
                throw new \Exception('Не корректная дирректория сайта');
            } catch (\Exception $e) {
                exit($e->getMessage());
            }
        }
    }


    private function createRoute($var, $arr)
    {
        $route = [];

        if (!empty($arr[0])) {
            if ($this->routes[$var]['routes'][$arr[0]]) {
                $route = explode('/', $this->routes[$var]['routes'][$arr[0]]);

                 $this->controller .= ucfirst($route[0] . 'Controller');// 'Controller' нужно убрать если не будет находить контроллер по имени - .
                //$this->controller .= ucfirst($route[0] );

            } else {
                $this->controller .= ucfirst($arr[0] . 'Controller');// 'Controller' нужно убрать если не будет находить контроллер по имени - .
                //$this->controller .= ucfirst($arr[0]);
            }
        } else {
            $this->controller .= $this->routes['default']['controller'];
        }

        $this->inputMethod = $route[1] ?? $this->routes['default']['inputMethod'];
        $this->outputMethod = $route[2] ?? $this->routes['default']['outputMethod'];

    }
/*
    private function redirect($rtrim, $int)
    {

    }
*/
}
