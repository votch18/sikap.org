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

$route['news']                      = 'home/posts/1/';
$route['preview/news/(:any)']       = 'home/view/1/$1';

$route['announcements']                      = 'home/posts/2/';
$route['preview/announcements/(:any)']       = 'home/view/2/$1';

$route['publications']                      = 'home/posts/3/';
$route['preview/publications/(:any)']       = 'home/view/3/$1';

$route['awards']                      = 'home/posts/4/';
$route['preview/awards/(:any)']       = 'home/view/4/$1';

$route['programs']                      = 'home/posts/5/';
$route['preview/programs/(:any)']       = 'home/view/5/$1';

$route['gallery']                      = 'home/posts/6/';
$route['preview/gallery/(:any)']       = 'home/view/6/$1';

//news
$route['admin/news']                = 'admin/posts';
$route['admin/news/create']         = 'admin/create_posts';
$route['admin/news/edit/(:any)']    = 'admin/edit_posts/$1';

//publications
$route['admin/publications']                = 'admin/posts';
$route['admin/publications/create']         = 'admin/create_posts';
$route['admin/publications/edit/(:any)']    = 'admin/edit_posts/$1';

//announcements
$route['admin/announcements']                = 'admin/posts';
$route['admin/announcements/create']         = 'admin/create_posts';
$route['admin/announcements/edit/(:any)']    = 'admin/edit_posts/$1';

//awards
$route['admin/awards']                = 'admin/posts';
$route['admin/awards/create']         = 'admin/create_posts';
$route['admin/awards/edit/(:any)']    = 'admin/edit_posts/$1';

//projects
$route['admin/programs']                = 'admin/posts';
$route['admin/programs/create']         = 'admin/create_posts';
$route['admin/programs/edit/(:any)']    = 'admin/edit_posts/$1';

//gallery
$route['admin/gallery']                = 'admin/posts';
$route['admin/gallery/create']         = 'admin/create_posts';
$route['admin/gallery/edit/(:any)']    = 'admin/edit_posts/$1';

//gallery
$route['admin/slider']                = 'admin/posts';
$route['admin/slider/create']         = 'admin/create_posts';
$route['admin/slider/edit/(:any)']    = 'admin/edit_posts/$1';