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
$route['home'] = 'home';
$route['about'] = 'about';
$route['management'] = 'management';
$route['career'] = 'career';
$route['career/success'] = 'career/mailsent';
$route['career/failed'] = 'career/mailerror';
$route['contact'] = 'contact';
$route['enquiry'] = 'enquiry';
$route['customer'] = 'customer';
$route['supplier'] = 'supplier';
$route['products'] = 'products';
$route['products/(:any)'] = 'products/view/$1';
$route['enquiry/success'] = 'enquiry/mailsent';
$route['enquiry/failed'] = 'enquiry/mailerror';
$route['services'] = 'services';
$route['search'] = 'search';
$route['admin'] = 'admin/admin';
$route['admin/login'] = 'admin/admin/login';
$route['admin/dashboard'] = 'admin/dashboard';
$route['admin/product/new'] = 'admin/product/newproduct';
$route['admin/product/add'] = 'admin/product/add';
$route['admin/product/list'] = 'admin/product/listproduct';
$route['admin/product/edit/(:any)'] = 'admin/product/edit/$1';
$route['admin/product/image/(:any)'] = 'admin/image/edit/$1';
$route['admin/product/image/update'] = 'admin/image/update';
$route['admin/product/gallery/(:any)'] = 'admin/gallery/view/$1';
$route['admin/product/gallery/add'] = 'admin/gallery/add';
$route['admin/product/gallery/delete/(:any)'] = 'admin/gallery/delete/$1';
$route['admin/product/delete/(:any)'] = 'admin/product/delete/$1';
$route['admin/category'] = 'admin/category/view';
$route['admin/category/add'] = 'admin/category/add';
$route['admin/statistics'] = 'admin/statistics';
$route['admin/account'] = 'admin/account';
$route['admin/account/update'] = 'admin/account/update';
$route['admin/enquiries'] = 'admin/enquiry/view';
$route['admin/logout'] = 'admin/admin/logout';
$route['terms'] = 'terms';
$route['privacy'] = 'privacy';
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
