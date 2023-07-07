<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'Frontend_Controller';
$route['Register'] = 'Frontend_Controller/register';

$route['admin'] = 'Admin_Controller';
$route['dashboard'] = 'Admin_Controller/dashboard';
$route['logout'] = 'Admin_Controller/logout';
$route['admin-user'] = 'Admin_Controller/adminuser';
$route['dashboard/add-resident'] = 'Admin_Controller/addresident';
$route['dashboard/add-officials'] = 'Admin_Controller/addofficials';
$route['dashboard/view-resident'] = 'Admin_Controller/viewresident';
$route['dashboard/view-officials'] = 'Admin_Controller/viewofficials';
$route['dashboard/delete-resident/(:any)'] = 'Admin_Controller/deleteresident/$1';
$route['dashboard/delete-officials/(:any)'] = 'Admin_Controller/deleteofficials/$1';
$route['dashboard/update-resident/(:any)'] = 'Admin_Controller/update_resident/$1';
$route['dashboard/update-officials/(:any)'] = 'Admin_Controller/updateofficials/$1';

 /* AJAX  */
$route['dashboard/ajax-update-official-form']['post'] = 'Admin_Controller/ajax_update_official_form';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;