<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = 'Error404';
$route['translate_uri_dashes'] = false;

//Login Ion-Auth
// $route['login'] = 'auth/login';
// $route['logout'] = 'auth/logout';
// $route['ativar-usuario/(:num)'] = 'auth/activate/$1';
// $route['desativar-usuario/(:num)'] = 'auth/deactivate/$1';

$route['login'] = 'login';
$route['logout'] = 'login/logout';






//Usuários
$route['usuarios'] = 'usuario';
//$route['auth-usuarios'] = 'auth/usuarios';
$route['usuarios/cadastro'] = 'usuario';
$route['usuarios/editar/(:num)'] = 'usuario/editar/$1';
$route['salvar-usuario'] = 'usuario/salvar';
$route['atualizar-usuario'] = 'usuario/atualizar';
$route['exluir-usuario/(:num)'] = 'usuario/delete/$1';
$route['acesso-restrito'] = 'Error403';
$route['desativar-usuario/(:num)'] = 'usuario/desativarUsuario/$1';
$route['ativar-usuario/(:num)'] = 'usuario/ativarUsuario/$1';


//Clientes
$route['clientes/cadastro'] = 'home';
$route['clientes/editar/(:num)'] = 'home/editar/$1';
$route['clientes/pagamento/(:num)'] = 'cliente/verify_pagamento/$1';
$route['salvar-cliente'] = 'home/salvar';
$route['atualizar-cliente'] = 'home/atualizar';
$route['exluir-cliente/(:num)'] = 'home/excluir/$1';








