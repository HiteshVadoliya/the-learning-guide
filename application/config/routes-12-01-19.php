<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* HD */
$route['default_controller'] = 'Home';
$route['admin'] = ADMIN.'Login';
$route['admin/Product'] = ADMIN.'Product';

/*school*/
$route['admin/manage-school'] = ADMIN.'School';
$route['admin/add-school'] = ADMIN.'School/add_school';
$route['admin/add-school/(:any)'] = ADMIN.'School/add_school/$1';
/*school*/
/*teacher*/
$route['admin/manage-teacher'] = ADMIN.'Teacher';
$route['admin/add-teacher'] = ADMIN.'Teacher/add_teacher';
$route['admin/add-teacher/(:any)'] = ADMIN.'Teacher/add_teacher/$1';
/*teacher*/

$route['login'] = FRONTEND.'Login';
$route['forgot-password'] = FRONTEND.'Login/forgot_Password';
$route['reset-password/(:any)'] = FRONTEND.'Login/ResetPassword/$1';
$route['change-password'] = FRONTEND.'Login/change_Password';
$route['searchquery'] = 'Home/searchquery';
$route['searchquery/(:any)'] = 'Home/searchquery/$1';
$route['search'] = 'Home/search';
$route['search/(:any)'] = 'Home/search/$1';

$route['schools'] = FRONTEND.'School/index';
$route['school/(:any)'] = FRONTEND.'School/school_details/$1';
$route['find-school'] = 'Home/search_by_area';

$route['teachers'] = FRONTEND.'Teacher/index';
$route['teacher/(:any)'] = FRONTEND.'Teacher/teacher_details/$1';
$route['find-teacher'] = FRONTEND.'Teacher/search_result';

$route['html/home'] = 'Pages/home';

$route['Cron.php'] = 'Cron/mycron';
// Front End End
$route['404_override'] = 'NotFoundController';
$route['404'] = 'NotFoundController';
$route['translate_uri_dashes'] = FALSE;
/* HD */