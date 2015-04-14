<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['admin']                           =   'admin/login';
$route['admin/login']                     =   'admin/login';
$route['admin/dashboard']                 =   'admin/dashboard';
$route['admin/user']                      =   'admin/user/index';
$route['admin/user/add_user']             =   'admin/user/add_user';
$route['admin/user/update_user']          =   'admin/user/update_user';
$route['admin/user/filter']               =   'admin/user/index';
$route['admin/user/filter/(:any)']        =   'admin/user/index/$1';
$route['admin/logout']                    =   'admin/user/logout';
$route['admin/login/verify']              =   'admin/login/verify';
$route['admin/user/delete_user/(:any)']   =   'admin/user/delete_user/$1';
$route['admin/user/edit_user/(:any)']     =   'admin/user/edit_user/$1';

$route['admin/accesslevel']               =   'admin/accesslevel';
$route['admin/accesslevel/add']           =   'admin/accesslevel/add';

$route['admin/groups']               =   'admin/groups';
$route['admin/groups/add']           =   'admin/groups/add';
$route['admin/groups/insert']        =   'admin/groups/insert';
$route['admin/groups/edit/(:any)']   =   'admin/groups/edit/$1';

$route['admin/articles']             =   'admin/articles';
$route['admin/articles/add']         =   'admin/articles/add';
$route['admin/articles/insert']      =   'admin/articles/insert';
$route['admin/articles/edit/(:any)'] =   'admin/articles/edit/$1';

$route['news/delete_news/(:any)']   =   'news/delete_news/$1';
$route['news/edit_news/(:any)']     =   'news/edit_news/$1';
$route['news/update_news']          =   'news/update_news/$1';
$route['news/add_news']             =   'news/add_news/$1';
$route['news/insert_news']          =   'news/insert_news/$1';
$route['news/(:any)']               =   'news/view/$1';
$route['news']                      =   'news';

$route['front']                     =   'front';

//$route['default_controller'] = "page/view";
//$route['(:any)'] = 'pages/view/$1';
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */