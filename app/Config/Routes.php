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
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'UsersController::index');
// $routes->get('/dashboard', 'UsersController::dashboard', ['filter' => 'authGuard']);
// $routes->get('/agent-dashboard', 'UsersController::agent_dashboard', ['filter' => 'authGuard']);
// $routes->get('/register', 'UsersController::register');
$routes->get('/', 'UsersController::login');
// $routes->post('/users-registration', 'UsersController::users_registration');
$routes->post('/logining-in', 'UsersController::loginAuth');
$routes->get('/logout', 'UsersController::logout');




// $routes->match(['get', 'post'], 'login', 'UserController::login', ["filter" => "noauth"]);

// Admin routes
$routes->group("admin", ["filter" => "authGuard"], function ($routes) {
    $routes->get("/", "AdminController::guest_posting_leads");
    // $routes->get('guest-posting', 'AdminController::guest_posting');
    $routes->get('guest-posting-leads', 'AdminController::guest_posting_leads');
    $routes->get('manage-users', 'AdminController::manage_users');
    $routes->get('edit-users/(:alphanum)', 'AdminController::edit_users/$1');
    $routes->post('update-user', 'AdminController::update_user');
    $routes->get('approve-payment/(:alphanum)', 'AdminController::approve_payment/$1');
    $routes->get('add-user', 'AdminController::add_user');
    $routes->post('users-registration', 'AdminController::users_registration');
    $routes->get('edit-guestpost/(:alphanum)', 'AdminController::edit_guestpost/$1');
    $routes->post('update-guestpost', 'AdminController::update_guestpost');
    $routes->get('project', 'AdminController::project');
    $routes->post('add-project', 'AdminController::add_project');
    $routes->get('all-projects', 'AdminController::all_projects');
    $routes->get('edit-project/(:alphanum)', 'AdminController::edit_project/$1');
    $routes->post('update-project', 'AdminController::update_project/$1');
    $routes->get('view-project-leads/(:alphanum)', 'AdminController::view_project_leads/$1');
    $routes->post('guestpost-leads-date-range', 'AdminController::guestpost_leads_date_range');
    // $routes->get('guestpost-leads-date-range', 'AdminController::get_guestpost_leads_pagination');
    $routes->get('payment-mode', 'AdminController::payment_method');
    $routes->post('add-payment-mode', 'AdminController::add_payment_method');
    $routes->get('currency', 'AdminController::currency');
    $routes->post('add-currency', 'AdminController::add_currency');





    // $routes->get('update-user', 'AdminController::update_user');
});

$routes->group("agent", ["filter" => "authGuard"], function ($routes) {
    $routes->get("/", "AgentController::guest_posting_leads");
    $routes->get('guest-posting', 'AgentController::guest_posting');
    $routes->post('save-guestpost', 'AgentController::save_guestpost');
    $routes->get('guest-posting-leads', 'AgentController::guest_posting_leads');
    $routes->get('edit-guestpost/(:alphanum)', 'AgentController::edit_guestpost/$1');
    $routes->post('update-guestpost', 'AgentController::update_guestpost');
});
// $routes->post('/logining-in', 'UsersController/loginAuth':: 'UsersController::loginAuth');


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
