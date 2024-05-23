<?php

// Site info
define('SITE_NAME',  'PHP Routing with HTMX');
define('SITE_OWNER', 'Waimea College');

// Libraries
require_once 'lib/utils.php';
require_once 'lib/router.php';

// Initialise the router
$router = new Router();

// Define routes
$router->route(GET,  PAGE, '/',          'pages/welcome.php', 'layouts/hero.php');
$router->route(GET,  PAGE, '/about',     'pages/about.php');
$router->route(GET,  PAGE, '/contact',   'pages/contact.php');
$router->route(GET,  PAGE, '/things',    'pages/things.php');
$router->route(GET,  PAGE, '/thing/$id', 'pages/thing.php');

$router->route(GET,  HTMX, '/things',    'components/thing-list.php');
$router->route(GET,  HTMX, '/thing/$id', 'components/thing-preview.php');

$router->route(POST, HTMX, '/message',   'components/send-message.php');

// Geenrate the required view
$router->view();

?>
