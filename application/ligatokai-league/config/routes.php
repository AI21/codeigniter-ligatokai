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
$route['default_controller'] = 'C_Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// HOME
$route['(:num)'] = 'C_Home/index/$1';

// C_Mvp
$route['team'] = 'C_Mvp/index';
$route['team/(:num)'] = 'C_Mvp/index/$1';
$route['team/detail'] = 'C_Mvp/detail';
$route['team/detail/(:num)'] = 'C_Mvp/detail/$1';
$route['team/detail/(:num)/(:num)'] = 'C_Mvp/detail/$1/$2';

// C_Schejule
$route['schejule'] = 'C_Schejule/index';
$route['schejule/(:num)'] = 'C_Schejule/index/$1';
// $route['schejule/class'] = 'C_Schejule/class';
// $route['schejule/class/(:num)'] = 'C_Schejule/class/$1';

// C_Ranking
$route['ranking'] = 'C_Ranking/index';
$route['ranking/(:num)'] = 'C_Ranking/index/$1';
$route['ranking/team'] = 'C_Ranking/team';
$route['ranking/team/(:num)'] = 'C_Ranking/team/$1';
$route['ranking/indi'] = 'C_Ranking/indi';
$route['ranking/indi/(:num)'] = 'C_Ranking/indi/$1';

// C_Versus
$route['versus'] = 'C_Versus/index';
$route['versus/(:num)'] = 'C_Versus/index/$1';
$route['versus/team'] = 'C_Versus/team';
$route['versus/team/(:num)'] = 'C_Versus/team/$1';
$route['versus/indi'] = 'C_Versus/indi';
$route['versus/indi/(:num)'] = 'C_Versus/indi/$1';

// C_Result
$route['result'] = 'C_Result/index';
$route['result/(:num)'] = 'C_Result/index/$1';

// C_Rule
$route['rule'] = 'C_Rule/index';
$route['rule/(:num)'] = 'C_Rule/index/$1';

// C_Map
$route['map'] = 'C_Map/index';
$route['map/(:num)'] = 'C_Map/index/$1';

// C_Inquire
$route['inquire'] = 'C_Inquire/index';
$route['inquire/(:num)'] = 'C_Inquire/index/$1';

// C_Entry
$route['entry'] = 'C_Entry/index';
$route['entry/(:num)'] = 'C_Entry/index/$1';

// C_Mvp
$route['mvp'] = 'C_Mvp/index';
$route['mvp/(:num)'] = 'C_Mvp/index/$1';
$route['mvp/(:num)/(:num)/(:num)'] = 'C_Mvp/index/$1/$2/$3';
$route['mvp/main'] = 'C_Mvp/main/';
$route['mvp/main/(:num)'] = 'C_Mvp/main/$1';