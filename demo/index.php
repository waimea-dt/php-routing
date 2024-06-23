<?php

//-------------------------------------------------------------
// Libraries
require_once 'lib/debug.php';
require_once 'lib/router.php';


//-------------------------------------------------------------
// Site Configuration
const SITE_NAME  = 'PHP Routing with HTMX';
const SITE_OWNER = 'Waimea College';


//-------------------------------------------------------------
// Setup a session
session_name('ROUTINGTEST');
session_start();


//-------------------------------------------------------------
// Check which type of user we
$userName   = $_SESSION['user']['name']     ?? 'Guest';
$isLoggedIn = $_SESSION['user']['loggedIn'] ?? false;


//-------------------------------------------------------------
// Initialise the router
$router = new Router(['debug' => true]);


//-------------------------------------------------------------
// Define routes

// Landing page uses a unique layout template
$router->route(GET,    PAGE, '/',          'pages/welcome.php', 'layouts/hero.php');

// Plain pages, no further HTMX requests
$router->route(GET,    PAGE, '/about',     'pages/about.php');
$router->route(GET,    PAGE, '/routing',   'pages/routing.php');

// Admin dashboard, contenrt loaded via HTMX
$router->route(GET,    PAGE, '/dashboard', 'pages/dashboard.php');
$router->route(GET,    HTMX, '/sales',     'components/data-sales.php');
$router->route(GET,    HTMX, '/system',    'components/data-system.php');

// Login / logout handled by HTMX
$router->route(GET,    PAGE, '/login',     'pages/login.php');
$router->route(POST,   HTMX, '/login',     'actions/login-user.php');
$router->route(POST,   HTMX, '/logout',    'actions/logout-user.php');

// Examples of CRUD interactions
$router->route(GET,    PAGE, '/requests',       'pages/requests.php');
$router->route(GET,    PAGE, '/request/post',   'pages/example-form-user-create.php');   // [C]reate
$router->route(GET,    PAGE, '/request/get',    'pages/example-button-user-read.php');   // [R]ead
$router->route(GET,    PAGE, '/request/put',    'pages/example-form-user-update.php');   // [U]pdate
$router->route(GET,    PAGE, '/request/delete', 'pages/example-button-user-delete.php'); // [D]elete
// CRUD examples, triggered via HTMX in above examples
$router->route(POST,   HTMX, '/user',           'actions/create-user.php');     // [C]reate
$router->route(GET,    HTMX, '/user/$id',       'components/details-user.php'); // [R]ead
$router->route(PUT,    HTMX, '/user/$id',       'actions/update-user.php');     // [U]pdate
$router->route(DELETE, HTMX, '/user/$id',       'actions/delete-user.php');     // [D]elete


//-------------------------------------------------------------
// Generate the required view
$router->view();

?>
