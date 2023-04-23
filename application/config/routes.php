<?php
defined('BASEPATH') or exit('No direct script access allowed');


$route['default_controller'] = 'site/index';

/**Auth*/
$route['auth/login'] = 'auth/login';
$route['auth/logout'] = 'auth/logout';


/** Drive */
$route['drive'] = 'drive/index';
$route['drive/upload'] = 'drive/upload';
$route['drive/create-folder'] = 'drive/create_folder';


/** Drive API */
$route['api/drive'] = 'DriveAPI/index';






$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
