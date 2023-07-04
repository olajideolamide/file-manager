<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');


$routes->group('auth', static function ($routes) {
    $routes->match(['get', 'post'], 'login', 'Auth::login', ['filter' => 'guestFilter']);
    $routes->get('logout', 'Auth::logout');
});






/** Drive */
$routes->group('drive', static function ($routes) {
    $routes->match(['get'], '/', 'Drive::index', ['filter' => 'authFilter']);
    $routes->match(['get'], '(:segment)', 'Drive::index/$1', ['filter' => 'authFilter']);
});



$routes->group('api', static function ($routes) {
    $routes->match(['get'], 'drive/file-entries', 'API\Drive::fileEntries'); //get file entries
    $routes->match(['post'], 'drive/upload', 'API\Drive::upload');  //upload
    $routes->match(['post'], 'drive/folder', 'API\Drive::createFolder'); //create folder
    $routes->match(['get'], 'drive/folders', 'API\Drive::folders'); //grab all folders for this parent
    $routes->match(['get'], 'drive/path/(:num)', 'API\Drive::path/$1'); //get path
    $routes->match(['post'], 'drive/move', 'API\Drive::move'); //move items to a destination

    $routes->match(['get'], 'photo/thumb/(:num)', 'API\Photo::thumb/$1'); //get thumb
    $routes->match(['get'], 'photo/resize/(:segment)/(:num)', 'API\Photo::resize/$1/$2'); //resize a photo
});



$routes->group('api/modal', static function ($routes) {
    $routes->match(['get'], 'drive/new-folder', 'API\Modal\Drive::newFolder');
    $routes->match(['get'], 'drive/move/(:segment)', 'API\Modal\Drive::move/$1');
});




/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
