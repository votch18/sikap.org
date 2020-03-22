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
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['filemanager/(:any)']            = 'filemanager/$1';
$route['posts/(:any)']                  = 'posts/$1';
$route['themes/(:any)']                 = 'themes/$1';
$route['users/(:any)']                  = 'users/$1';

$route['admin']                         = 'admin';
$route['admin/filemanager']             = 'admin/filemanager';
$route['admin/pages']                   = 'admin/pages';
$route['admin/pages/create']            = 'admin/pages_create/';
$route['admin/pages/edit/(:any)']       = 'admin/pages_create/$1';
$route['admin/templates']               = 'admin/templates';
$route['admin/settings']                = 'admin/settings';
$route['admin/users']                   = 'admin/users';
$route['admin/dashboard']               = 'admin/dashboard';
$route['admin/logout']                  = 'admin/logout';
$route['admin/login']                   = 'admin/login';
$route['admin/profile']                 = 'admin/profile';
$route['admin/update_info']             = 'admin/update_info';
$route['admin/do_upload']               = 'admin/do_upload';


//admin page posts
$route['admin/(:any)']                  = 'admin/posts/$1';
$route['admin/(:any)/create']           = 'admin/create_posts/$1';
$route['admin/(:any)/edit/(:any)']      = 'admin/edit_posts/$1/$2';

//public page
$route['(:any)']                      = 'home/posts/$1/';
$route['(:any)/(:any)']               = 'home/view/$1/$2';
$route['preview/(:any)/(:any)']       = 'home/view/$1/$2/true';
