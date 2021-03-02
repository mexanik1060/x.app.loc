<?php

//USERS
/*
 * 'routes' => [
                        //'папка' => 'ходные данные/выходные двнные в шаблон'
                        'personnel'=>'employee/getEmployee/addEmpl'

 *  http://x.app.loc/папка/alias/inputMethod/outputMethod
 *
 * http://x.app.loc/папка/alias/ --- В пользовательской части ссылки должны начинаться именно так.
 * В пользовательской части /alias/ - это контроллер. А у нас должна быть папка внутри которой лежит контроллер
 * http://x.app.loc/personnel/employee/ --- В пользовательской части ссылки должны насинаться именно так.
 *
 *  http://x.app.loc/personnel/employee/getEmployee/addEmpl
 *
$this = {System\engine\Router} [6]
 _instance = null
 controller = "app/controller/EmployeeController"
 inputMethod = "getEmployee"
 outputMethod = "addEmpl"
 parameters = {array} [2]
  alias = "employee"
  getEmployee = "addEmpl"


http://x.app.loc/personnel/employee/getEmployee/addEmpl/id/1/page/2

$adress_str = "/personnel/employee/getEmployee/addEmpl/id/1/page/2"
$this = {System\engine\Router} [6]
 _instance = null
 controller = "app/controller/EmployeeController"
 inputMethod = "getEmployee"
 outputMethod = "addEmpl"
 parameters = {array} [4]
  alias = "employee"
  getEmployee = "addEmpl"
  id = "1"
  page = "2"
*/
