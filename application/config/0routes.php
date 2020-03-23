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
/*contact*/
$route['admin/contact'] = ADMIN.'Contact';
$route['admin/view-contact/(:any)'] = ADMIN.'Contact/view_contact/$1';
/*contact*/
/*newsletter*/
$route['admin/newsletter'] = ADMIN.'Contact/newsletter';
/*newsletter*/
/*bulletin*/
$route['admin/manage-bulletin'] = ADMIN.'Bulletin';
$route['admin/add-bulletin'] = ADMIN.'Bulletin/add_bulletin';
$route['admin/add-bulletin/(:any)'] = ADMIN.'Bulletin/add_bulletin/$1';
/*bulletin*/
/*calendar*/
$route['admin/manage-calendar'] = ADMIN.'Calendar';
$route['admin/add-calendar'] = ADMIN.'Calendar/add_event';
$route['admin/add-calendar/(:any)'] = ADMIN.'Calendar/add_event/$1';
/*calendar*/
/*content*/
$route['admin/manage-terms'] = ADMIN.'Content/terms';
$route['admin/manage-privacy'] = ADMIN.'Content/privacy';
$route['admin/manage-content-policy'] = ADMIN.'Content/content_policy';
$route['admin/manage-paid-content-partnerships'] = ADMIN.'Content/paid_content_partnerships';
$route['admin/manage-legal'] = ADMIN.'Content/legal';
/*content*/
/*social*/
$route['admin/social-media'] = ADMIN.'Content/social_media';
/*social*/

$route['login'] = FRONTEND.'Login';
$route['forgot-password'] = FRONTEND.'Login/forgot_Password';
$route['reset-password/(:any)'] = FRONTEND.'Login/ResetPassword/$1';
$route['change-password'] = FRONTEND.'Login/change_Password';
$route['searchquery'] = 'Home/searchquery';
$route['searchquery/(:any)'] = 'Home/searchquery/$1';
$route['search'] = 'Home/search';
$route['search/(:any)'] = 'Home/search/$1';
$route['my-profile'] = FRONTEND.'Login/Profile';

$route['schools'] = FRONTEND.'School/index';
$route['school/(:any)'] = FRONTEND.'School/school_details/$1';
$route['find-school'] = 'Home/search_by_area';
$route['find-school/(:any)'] = 'Home/search_by_area/$1';
$route['find-school-page/(:any)'] = 'Home/search_by_area/$1';

$route['teachers'] = FRONTEND.'Teacher/index';
$route['teacher/(:any)'] = FRONTEND.'Teacher/teacher_details/$1';
$route['find-teacher'] = FRONTEND.'Teacher/search_result';
$route['find-teacher/(:any)'] = FRONTEND.'Teacher/search_result/$1';

$route['compare-school'] = 'Home/compare_school';
$route['compare-teacher'] = 'Home/compare_teacher';

$route['bulletin'] = FRONTEND.'Bulletin/index';
$route['bulletin-detail/(:any)'] = FRONTEND.'Bulletin/bulletin_details/$1';
$route['save-question'] = FRONTEND.'Bulletin/save_question';

/*calendra*/
$route['calendar'] = FRONTEND.'Calendar/index';
$route['calendar/view/(:any)'] = FRONTEND.'Calendar/index/$1';
$route['calendar/view_all/(:any)'] = FRONTEND.'Calendar/view_all/$1';
$route['save_task'] = FRONTEND.'Calendar/add_task';
$route['paypal/cancel'] = FRONTEND.'Calendar/Paypal_Cancel';
$route['paypal/success'] = FRONTEND.'Calendar/Paypal_Success';
$route['paypal/ipn_calendar'] = FRONTEND.'Calendar/Paypal_ipn_Calendar';


/* Static Pages */
$route['about'] = FRONTEND.'Pages/about';
$route['services'] = FRONTEND.'Pages/services';
$route['team'] = FRONTEND.'Pages/team';
$route['contact'] = FRONTEND.'Pages/contact';
$route['terms'] = FRONTEND.'Pages/terms';
$route['privacy-policy'] = FRONTEND.'Pages/privacy_policy';
$route['content-integrity-policy'] = FRONTEND.'Pages/content_integrity_policy';
$route['paid-content-partnerships'] = FRONTEND.'Pages/paid_content_partnerships';
$route['who-we-are'] = FRONTEND.'Pages/who_we_are';
$route['legal'] = FRONTEND.'Pages/legal';
/* Static Pages */

$route['user/teacher/teacher_approval/(:any)/(:any)'] = FRONTEND.'Teacher/approval/$1/$2';


$route['html/home'] = 'Pages/home';

$route['Cron.php'] = 'Cron/mycron';
// Front End End
$route['404_override'] = 'NotFoundController';
$route['404'] = 'NotFoundController';
$route['translate_uri_dashes'] = FALSE;
/* HD */



