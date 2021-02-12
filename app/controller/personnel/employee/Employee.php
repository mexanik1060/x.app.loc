<?php


namespace App\controller\personnel\employee;


class Employee
{
    public function __construct()
    {
        echo 'Employee.php' . ' - Я файл из конструктора.';
    }

    public function getEmployee()
    {
        echo 'getEmployee' . ' - Я метод.';
    }

}