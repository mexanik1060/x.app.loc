<?php


namespace System\library\template;



use Twig\Environment;
use Twig\Loader\FilesystemLoader;


final class Twig
{

    private $twig;
    public  $data = [];

    /**
     * должны попасть данные из базы
     * @param $key
     * @param $value
     */
    public function setTwigData($key, $value)
    {
        $this ->data[$key] = $value;
    }

    public function renderTwig($template, bool $cache = false)
    {
        // указываем где хранятся шаблоны -> view
        $loader = new FilesystemLoader(DIR_TEMPLATE);
        // инициализируем Twig
        $config_cache = ['autoescape' => false];
        if ($cache) {
            $config_cache['cache'] = DIR_CACHE;
        }
        $this->twig = new Environment($loader, $config_cache);
        try {
            // загрузить шаблон -> view
            $template = $this->twig->load($template . '.html.twig');
            //передать данные в шаблон
           //return $template->render($this->data);
            echo $template->render($this->data);
        } catch (\Exception $e) {
            trigger_error('Ошибка: не удалось загрузить шаблон ' . $template . '!');
            exit();
        }


    }


}



/*
 * //Twig -> работает
$template = 'testTmp';// имя шаблона задаем в параметрах URL через контроллер router и настройки маршрутизации

$data['title'] = 'Тестовая страница';
$data['login'] = 'Sasha';
$data['password'] = '879845646844684';
//$data =['title'=>'Тестовая страница','login'=>'Саша','password'=>'123456'];

$twig = new Twig();
//$twig->data = $data; // тащим массив из базы данных и передаем в массив $twig->data
$twig->setTwigData('login', 'myLogin');
$twig->setTwigData('password', 'myPassword');
$twig->renderTwig($template, 'template_cache'); // Как вытащить $_['template_cache'] из app.php ?

 */