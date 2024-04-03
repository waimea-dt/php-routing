<?php

// Site info
define('SITE_NAME',  'The Best Things!');
define('SITE_OWNER', 'Things Inc.');

// Libraries
require_once 'lib/utils.php';
require_once 'lib/routing.php';
require_once 'lib/session.php';

// Check which type of user we
$userName   = $_SESSION['user']['name']     ?? 'Guest';
$isLoggedIn = $_SESSION['user']['loggedIn'] ?? false;

// Get the current URL...
$url = $_SERVER['REQUEST_URI'];
// ... and parse it
$request = parseURL($url);
// ... and extract the resulting information
$method = $request['method'];    // GET or POST
$type   = $request['type'];      // PAGE or COMPONENT
$route  = $request['route'];     // The route string
$params = $request['params'];    // An array of any parameters

// We don't need a layout if this a request for a component
// But if it's a page, assume the default layout
$layout = ($type == PAGE) ? 'default.php' : null;
// Start with no initial view
$view = null;

// Process the route
switch ([$method, $type, $route]) {

    // Landing page --------------------------------------
    case [GET, PAGE, '']:
        $view = 'welcome.php';
        $layout = 'hero.php';   // Special layout in this case
        break;

    // Login & Logout ----------------------------------------
    case [GET, PAGE, 'login']:
        $view = 'login.php';
        break;

    case [POST, COMPONENT, 'login']:
        $user = $_POST['username'] ?? '';
        $pass = $_POST['password'] ?? '';
        $view = 'do-login.php';
        break;

    case [POST, COMPONENT, 'logout']:
        $view = 'do-logout.php';
        break;

    // Normal Pages ---------------------------------------------
    case [GET, PAGE, 'about']:
        $view = 'about.php';
        break;

    // Contact Form -----------------------------------------------
    case [GET, PAGE, 'contact']:
        $view = 'contact.php';
        break;

    case [POST, COMPONENT, 'send-message']:
        $name    = $_POST['name'] ?? '';
        $message = $_POST['message'] ?? '';
        $view    = 'send-message.php';
        break;

    // Things --------------------------------------------------
    case [GET, PAGE, 'things']:
        $view = 'things.php';
        break;

    case [GET, COMPONENT, 'thing-list']:
        $view = 'thing-list.php';
        break;

    case [GET, COMPONENT, 'thing-preview']:
        $id   = $params[0] ?? null;
        $view = 'thing-preview.php';
        break;

    case [GET, PAGE, 'thing']:
        $id = $params[0] ?? null;
        $view = 'thing.php';
        break;

    case [GET, COMPONENT, 'thing']:
        $id   = $params[0] ?? null;
        $view = 'thing-full.php';
        break;

    case [GET, COMPONENT, 'thing-edit']:
        $id   = $params[0] ?? null;
        $view = 'thing-form.php';
        break;

    case [POST, COMPONENT, 'thing']:
        $id    = $params[0] ?? null;
        $name  = $_POST['name'] ?? '';
        $desc  = $_POST['description'] ?? '';
        $image = $_POST['image'] ?? '';
        $view  = 'update-thing.php';
        break;

    // Dashboard ------------------------------------------------
    case [GET, PAGE, 'dashboard']:      // Only available if logged in
        if ($isLoggedIn) {
            $view = 'dashboard.php';
        }
        else {
            http_response_code(403);
            $view = '403.php';
        }
        break;

    case [GET, COMPONENT, 'system']:
        if ($isLoggedIn) {
            $view = 'system-info.php';
        }
        break;

    case [GET, COMPONENT, 'sales']:
        if ($isLoggedIn) {
            $view = 'sales-data.php';
        }
        break;

    // 404 -------------------------------------------------------
    default:
        http_response_code(404);
        $view = '404.php';
}

// Do we actually have a view to show?
if ($view) {
    // Is this is full page request?
    if ($type == PAGE) {
        // Return the content within the page template in the layout
        require LAYOUTS . $layout;
    }
    else {
        // It's an HTMX request, so return just the component content
        require COMPONENTS . $view;
    }
}


// Show debug info
consoleGroupStart('NEW REQUEST');
    consoleLog($url,    'Request URL');
    consoleLog($method, 'Method');
    consoleLog($type,   'Type');
    consoleLog($route,  'Route');
    if ($params)   consoleLog($params,   'Parameters');
    if ($_GET)     consoleLog($_GET,     'GET Data');
    if ($_POST)    consoleLog($_POST,    'POST Data');
    if ($_FILES)   consoleLog($_FILES,   'FILES Data');
    if ($_SESSION) consoleLog($_SESSION, 'SESSION Data');
    consoleLog($view,   'View');
consoleGroupEnd();

?>
