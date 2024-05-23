<?php

/*=====================================================================
 * Waimea College Basic Routing Library with HTMX
 * Steve Copley
 * Digital Technologies Dept.
 *
 * Version: 2.0 (May 2024)
 *
 * Located at: https://github.com/waimea-dt/php-routing
 *
 * Influenced by https://phprouter.com/
 * 
 * Router class holds the defined routes. Has functions to:
 *
 *   - Define a route:                       route()
 *   - Output a view for a requested route:  view()
 *
 *---------------------------------------------------------------------
 * History:
 *
 *  2.0 (2024-05-23) - Rewrite of previous library
 *  1.1 (2024-05-02) - Tweaks to login/out and .htacces
 *  1.0 (2024-04-04) - Initial version
 *=====================================================================*/


require_once 'lib/utils.php';

// From the URL of the routing script, obtain the base URL for all links
define('SITE_BASE', dirname($_SERVER['SCRIPT_NAME']));

// Define key view folders and views
define('VIEWS',          __DIR__ . '/../views/');
define('DEFAULT_LAYOUT', 'layouts/default.php');
define('PAGE_404',       'pages/404.php');

// Constants for request methods
define('GET',  'GET');
define('POST', 'POST');

// Constants for request types
define('PAGE', 'PAGE');   // A normal, page request
define('HTMX', 'HTMX');   // An HTMX request



class Router {
    private $routes = [];

    /**
     * Define a route
     * 
     * Params:  $method - GET or POST
     *          $type   - PAGE or HTMX
     *          $url    - URL pattern to match. 
     *                    Can contain parameter values, e.g. $id
     *          $view   - Corresponding view
     *          $layout - Optional layout. Defualt used if missing
     */
    function route($method, $type, $url, $view, $layout=DEFAULT_LAYOUT) { 
        if ($method != GET && $method != POST) die('ROUTING - Invalid method: ' . $method);
        if ($type != PAGE && $type != HTMX)    die('ROUTING - Invalid type: ' . $type);
        if (!file_exists(VIEWS . $view))       die('ROUTING - Missing view: ' . $view);
        if (!file_exists(VIEWS . $layout))     die('ROUTING - Missing layout: ' . $layout);

        // Remove any leading and trailing slashes
    	$url = ltrim($url, '/');
    	$url = rtrim($url, '/');
        // Break up the URL
	    $urlParts = explode('/', $url);
    
        $this->routes[] = [
            'method' => $method, 
            'type'   => $type, 
            'url'    => $url,
            'parts'  => $urlParts, 
            'view'   => $view, 
            'layout' => $layout
        ];
    }

    /**
     * Display a view corresponding to a request route
     * 
     * Displays 404 if no route can be matched
     */
    function view() {
        // Parse the request -----------------------------------------------------
        
        // Get the requested URL
        $requestURL = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
        // Trim off the base URL from the start of request to give a relative URL
        $requestURL = substr($requestURL, strlen(SITE_BASE));
        // Remove any leading and trailing slashes
    	$requestURL = ltrim($requestURL, '/');
    	$requestURL = rtrim($requestURL, '/');
        // Remove any GET filters
        $requestURL = strtok($requestURL, '?');
        // Break up the URL
	    $requestParts = explode('/', $requestURL);

        // Was this a GET or POST request?
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        // Was this an HTMX request, or a full page request?
        $htmx    = $_SERVER['HTTP_HX_REQUEST'] ?? false;
        $boosted = $_SERVER['HTTP_HX_BOOSTED'] ?? false;
        $requestType = !$htmx || $boosted ? PAGE : HTMX;

        // Match a route -----------------------------------------------------
        
        // Work through all possible routes, looking for a match
        $routeMatched = false;
        foreach ($this->routes as $routeInfo) {
            $routeParts = $routeInfo['parts'];

            // Mismatch in methods?
            if ($routeInfo['method'] != $requestMethod) continue;
            // Mismatch in type?
            if ($routeInfo['type'] != $requestType) continue;
            // Mismatch in number of parts?
            if (count($routeParts) != count($requestParts)) continue;
            // Otherwsie, work thriugh the parts
            for ($i = 0; $i < count($routeParts); $i++) { 
                // Mismatch and not a parameter value?
                if (!preg_match('/^[$]/', $routeParts[$i]) && 
                    $routeParts[$i] != $requestParts[$i]) continue 2;
            }

            // If we got here, there were no mismatches - found our route
            $routeMatched = true;
            $route = $routeInfo['parts'][0];
            // What view should we show?
            $view = $routeInfo['view'];
            $layout = $routeInfo['layout'];
            // Create any parameter variables
            $vars = [];
            for ($i = 0; $i < count($routeParts); $i++) { 
                // Is a parameter value?
                if (preg_match('/^[$]/', $routeParts[$i])) {
                    // Yes, so create a variable and assign value;
                    $varName = ltrim($routeParts[$i], '$');
                    $$varName = $requestParts[$i];
                    // And keep a copy for debug
                    $vars[$routeParts[$i]] = $requestParts[$i];
                }
            }

            // And we can stop looking
            break;
        }

        // No route matched? ---------------------------------------------------

        if (!$routeMatched) {
            http_response_code(404);
            // Is there a 404 page?
            if (file_exists(VIEWS . PAGE_404)) {
                $view   = PAGE_404;
                $layout = DEFAULT_LAYOUT;
            }
            else {
                // No, so default text
                echo '<h1>Not Found (404)</h1>';
                return;
            }
        }

        // Output the view -----------------------------------------------------

        // Capture buffer so URLs can be updates
        ob_start('rebaseURLs');
        // For a full page request, load the layout. For HTMX, just the component
        require VIEWS . (($requestType == PAGE) ? $layout : $view);
        // End capture - return resulting HTML
        ob_end_flush();


        // Show debug info ------------------------------------------------------
        
        consoleGroupStart('NEW REQUEST');
            consoleLog($requestURL,    'Request URL');
            consoleLog($requestMethod, 'Method');
            consoleLog($requestType,   'Type');

            if ($routeMatched) { consoleLog($routeInfo['url'], 'Match'); consoleLog($route, 'Route'); }
            else consoleLog('No matching route', '', ERROR);

            if ($requestType == HTMX) consoleLog($view, 'Comp');
            else { consoleLog($view, 'Page'); consoleLog($layout, 'Layout'); }

            if ($vars ?? null) consoleLog($vars, 'Variables');

            if ($_GET)   consoleLog($_GET,   'GET Data');
            if ($_POST)  consoleLog($_POST,  'POST Data');
            if ($_FILES) consoleLog($_FILES, 'FILES Data');
        consoleGroupEnd();
    }
}


/**
 * Rebase all links / urls to incluide the base URL
 * Allows for sites to be run from within server sub-folders
 * whilst still having URLs that read as if in the server root
 */
function rebaseURLs($buffer)
{
    // Update links
    $buffer = str_replace('href="/',    'href="'    . SITE_BASE . '/', $buffer);
    // Update images / scripts
    $buffer = str_replace('src="/',     'src="'     . SITE_BASE . '/', $buffer);
    // Update HTMX gets
    $buffer = str_replace('hx-get="/',  'hx-get="'  . SITE_BASE . '/', $buffer);
    // Update HTMX gets
    $buffer = str_replace('hx-post="/', 'hx-post="' . SITE_BASE . '/', $buffer);

    return $buffer;
}