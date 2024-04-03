<?php

// Site info
define('SITE_NAME',  'PHP Routing with HTMX');
define('SITE_OWNER', 'Waimea College');

// Libraries
require_once 'lib/utils.php';
require_once 'lib/routing.php';

// Get the current URL...
$url = $_SERVER['REQUEST_URI'];
// ... and parse it
$request = parseURL($url);
// ... and extract the resulting information
$method = $request['method'];   // GET or POST
$type   = $request['type'];     // PAGE or COMPONENT
$route  = $request['route'];    // The route string
$params = $request['params'];   // An array of any parameters

// Process the route
switch ([$method, $type, $route]) {

    // Landing page --------------------------------------
    case [GET, PAGE, '']:
        $view = 'welcome.php';
        $layout = 'hero.php';   // Special layout in this case
        break;

    // Normal Pages ---------------------------------------------
    case [GET, PAGE, 'about']:
        $view = 'about.php';
        $layout = 'default.php';
        break;

    // Contact Form -----------------------------------------------
    case [GET, PAGE, 'contact']:
        $view = 'contact.php';
        $layout = 'default.php';
        break;

    case [POST, COMPONENT, 'send-message']:
        $name    = $_POST['name'] ?? '';
        $message = $_POST['message'] ?? '';
        $view    = 'send-message.php';
        break;

    // Things --------------------------------------------------
    case [GET, PAGE, 'things']:
        $view = 'things.php';
        $layout = 'default.php';
        break;

    case [GET, COMPONENT, 'thing-list']:
        $view = 'thing-list.php';
        break;

    case [GET, COMPONENT, 'thing-preview']:
        $id   = $params[0] ?? null;
        $view = 'thing-preview.php';
        break;

    // 404 -------------------------------------------------------
    default:
        http_response_code(404);
        $view = '404.php';
        $layout = 'default.php';
}

// Is this is full page request?
if ($type == PAGE) {
    // Return the content within the page template in the layout
    require LAYOUTS . $layout;
}
else {
    // It's an HTMX request, so return just the component content
    require COMPONENTS . $view;
}


// Show debug info
consoleGroupStart('NEW REQUEST');
    consoleLog($url,    'Request URL');
    consoleLog($method, 'Method');
    consoleLog($type,   'Type');
    consoleLog($route,  'Route');

    consoleLog($view,   'View');
    if ($type == PAGE) consoleLog($layout,   'Layout');

    if ($params)   consoleLog($params,   'Parameters');
    if ($_GET)     consoleLog($_GET,     'GET Data');
    if ($_POST)    consoleLog($_POST,    'POST Data');
    if ($_FILES)   consoleLog($_FILES,   'FILES Data');
consoleGroupEnd();

?>
