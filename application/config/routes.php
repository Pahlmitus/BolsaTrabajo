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
$route['default_controller'] = 'frontoffice';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// ADMIN
$route['admin'] = 'admin';
$route['admin/(:any)'] = 'admin/$1';
$route['admin/(:any)/(:any)'] = 'admin/$1/$2';
$route['admin/(:any)/(:any)/(:any)'] = 'admin/$1/$2/$3';

// FRONT
$route['frontoffice'] = 'frontoffice';
$route['frontoffice/(:any)'] = 'frontoffice/$1';
    /* Mostrar todas */
    $route['all'] = 'frontoffice/all';
    $route['all/(:any)'] = 'frontoffice/all/$1';
    /* Buscar */
    $route['search'] = 'frontoffice/search';
    $route['search/(:any)'] = 'frontoffice/search/$1';
    /* Mostrar por etiqueta */
    $route['tag'] = 'frontoffice/tag';
    $route['tag/(:any)'] = 'frontoffice/tag/$1';
    /* Mostrar por provincia */
    $route['location'] = 'frontoffice/location';
    $route['location/(:any)'] = 'frontoffice/location/$1';

    /* Candidatos */
    $route['candidates'] = 'frontoffice/candidates';
    $route['candidates/profile'] = 'frontoffice/profile';
    $route['candidates/profile/(:any)'] = 'frontoffice/profile/$1';

// BACK
$route['perfil'] = 'backoffice';
$route['backoffice/(:any)'] = 'backoffice/$1';

// Login y logout
$route['login'] = 'backoffice/login';
$route['logout'] = 'backoffice/logout';

// Registro
$route['register'] = 'frontoffice/register';
$route['register/trabajador'] = 'backoffice/registerTrabajador';
$route['register/empresario'] = 'backoffice/registerEmpresario';
$route['register/empresa'] = 'backoffice/registerEmpresa';