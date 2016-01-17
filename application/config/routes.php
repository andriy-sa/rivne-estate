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
|	http://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['estate/(:num)']               = "Estate/estate/$1";
$route['rieltors']                    = "Estate/rieltors";

/* admin */
$route['admin/estates']               = "AdminEstate/index";
$route['admin/estates/insert']        = "AdminEstate/insert";
$route['admin/estates/update/(:num)'] = "AdminEstate/update/$1";
$route['admin/estates/photo/(:num)']  = "AdminEstate/photo/$1";
$route['admin/estates/delete/(:num)'] = "AdminEstate/delete/$1";
$route['admin/estates/category']      = "AdminEstate/category";
$route['admin/estates/districts']     = "AdminEstate/districts";
$route['admin/rieltors']              = "Admin/rieltors";
$route['admin/rieltors/insert']       = "Admin/rieltors_insert";
$route['admin/rieltors/update/(:num)'] = "Admin/rieltors_update/$1";
$route['admin/rieltors/delete/(:num)'] = "Admin/rieltors_delete/$1";
$route['admin/slides']                 = "Admin/slides";
$route['admin/slides/insert']          = "Admin/slides_insert";
$route['admin/slides/update/(:num)']   = "Admin/slides_update/$1";
$route['admin/slides/delete/(:num)']   = "Admin/slides_delete/$1";