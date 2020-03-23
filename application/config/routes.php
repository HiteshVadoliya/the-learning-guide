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
/*teacher*/
$route['admin/manage-language'] = ADMIN.'Language';
$route['admin/add-language'] = ADMIN.'Language/add_language';
$route['admin/add-language/(:any)'] = ADMIN.'Language/add_language/$1';
/*teacher*/
/*contact*/
$route['admin/contact'] = ADMIN.'Contact';
$route['admin/edit-contact'] = ADMIN.'Contact/edit_contact';
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
/*instafeed*/
$route['admin/insta-feed'] = ADMIN.'Bulletin/insta_feed';
$route['admin/insta-feed-details/(:any)'] = ADMIN.'Bulletin/insta_feed_details/$1';
/*instafeed*/
/*calendar*/
$route['admin/manage-calendar'] = ADMIN.'Calendar';
$route['admin/add-calendar'] = ADMIN.'Calendar/add_event';
$route['admin/add-calendar/(:any)'] = ADMIN.'Calendar/add_event/$1';
/*calendar*/

/*calendar*/
$route['admin/manage-review/school'] = ADMIN.'Review';
$route['admin/manage-review/teacher'] = ADMIN.'Review';
// $route['admin/add-review'] = ADMIN.'Review/add_event';
// $route['admin/add-review/(:any)'] = ADMIN.'Review/add_event/$1';
/*calendar*/

/*content*/
$route['admin/manage-terms'] = ADMIN.'Content/terms';
$route['admin/manage-privacy'] = ADMIN.'Content/privacy';
$route['admin/manage-content-policy'] = ADMIN.'Content/content_policy';
$route['admin/manage-paid-content-partnerships'] = ADMIN.'Content/paid_content_partnerships';
$route['admin/manage-legal'] = ADMIN.'Content/legal';
$route['admin/manage-faq'] = ADMIN.'Content/faq';
$route['admin/manage-stories'] = ADMIN.'Content/stories';
$route['admin/manage-services'] = ADMIN.'Content/services';
$route['admin/manage-team'] = ADMIN.'Content/team';
$route['admin/manage-partners'] = ADMIN.'Content/partners';
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

$route['full_search'] = 'Home/full_search';

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

$route['payment'] = 'Home/buy';
$route['paypal-credit-card-payment'] = 'Home/paypal_credit_card_payment';

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
$route['faq'] = FRONTEND.'Pages/faq';
/* Static Pages */

$route['user/teacher/teacher_approval/(:any)/(:any)'] = FRONTEND.'Teacher/approval/$1/$2';


$route['html/home'] = 'Pages/home';

$route['Cron.php'] = 'Cron/mycron';
// Front End End
$route['404_override'] = 'NotFoundController';
$route['404'] = 'NotFoundController';
$route['translate_uri_dashes'] = FALSE;
/* HD */



