<?php


namespace System\engine;

/**
 * This is my autoloader for my PSR-4 clases.
 * I prefer to use composer's autoloader, but this works for legacy projects that can't use composer.
 * Simple autoloader, so we don't need Composer just for this.
 */
class Autoloader
{
    public static function register()
    {
        spl_autoload_register(function ($class_name) {
            $file = str_replace('\\', DIRECTORY_SEPARATOR, $class_name).'.php';
            if (file_exists($file)) {
                require_once $file;
                return true;
            }
            return false;
        });
    }
}
Autoloader::register();