<?php

/*=====================================================================
 * Basic Routing Library with HTMX
 * 
 * Version: 1.0 (June 2024)
 * 
 * Steve Copley
 * Waimea College 
 * Digital Technologies Dept.
 *
 * https://github.com/waimea-dt/php-routing
 * 
 *---------------------------------------------------------------------
 * Influenced by https://phprouter.com/
 * 
 * Router class holds the defined routes. Has public functions to:
 *
 *  - Create a router with a given config:  __construct()
 *  - Define a route:                       route()
 *  - Output a view for a requested route:  view()
 * 
 *---------------------------------------------------------------------
 * History:
 * 
 *  0.1 (2024-04-04) - Initial version
 *  0.2 (2024-05-02) - Tweaks to login/out and .htacces
 *  0.3 (2024-05-23) - Pretty big rewrite to use classes
 *  0.4 (2024-05-29) - Restructuring of views / partials
 *  0.5 (2024-05-30) - Allow PUT and DELETE requests
 *  1.0 (2024-06-01) - Rewrite complete and ready to go
 * 
 *=====================================================================*/


require_once 'debug.php';


// From the URL of the routing script, obtain the base URL for all links
define('SITE_BASE', dirname($_SERVER['SCRIPT_NAME']));

// Request methods
const POST   = 'POST';
const GET    = 'GET';
const PUT    = 'PUT';
const DELETE = 'DELETE';

// Request types
const PAGE = 'PAGE';   // A normal, page request
const HTMX = 'HTMX';   // An HTMX request

/**
 * The main router class
 */
class Router {
    private $routes = [];
    private $debug = false;

    const VALIDMETHODS = [POST, GET, PUT, DELETE];
    const VALIDTYPES   = [PAGE, HTMX];

    /**
     * Class constructor
     * 
     * Params:  $config - Associate array of config values
     * 
     * Default values assume folder naming / heirarchy as per the GitHub repo.
     */
    public function __construct($config=null) {
        $this->viewsDir      = $config['views']         ?? __DIR__ . '/../views';
        $this->defaultLayout = $config['defaultLayout'] ?? 'layouts/default.php';
        $this->page404       = $config['page404']       ?? 'pages/404.php';
        $this->debug         = $config['debug']         ?? false;
        $this->viewsDir .= '/';
    }

    /**
     * Define a route
     * 
     * Params:  $method - GET, POST, PUT, DELETE
     *          $type   - PAGE or HTMX
     *          $url    - URL pattern to match. 
     *                    Can contain parameter values, e.g. $id
     *          $view   - Corresponding view
     *          $layout - Optional layout. Defualt used if missing
     */
    function route($method, $type, $url, $view, $layout=null) { 
        $layout = $layout == null ? $this->defaultLayout : $layout;
        if (!in_array($method, self::VALIDMETHODS))  die('ROUTING - Invalid method: ' . $method);
        if (!in_array($type,   self::VALIDTYPES))    die('ROUTING - Invalid type: '   . $type);
        if (!file_exists($this->viewsDir . $view))   die('ROUTING - Missing view: '   . $view);
        if (!file_exists($this->viewsDir . $layout)) die('ROUTING - Missing layout: ' . $layout);

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

        // Was this a PUT request? If so, setup $_PUT array, since PHP doesn't do this!
        if ($requestMethod == PUT) {
            parse_str(file_get_contents('php://input'), $_PUT);
        }
        else {
            $_PUT = null;
        }


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
            if (file_exists($this->viewsDir . $this->page404)) {
                $view   = $this->page404;
                $layout = $this->defaultLayout;
            }
            else {
                // No, so default text
                echo '<h1>Not Found (404)</h1>';
                return;
            }
        }

        // Output the view -----------------------------------------------------

        // Capture buffer so URLs can be updates
        ob_start([$this, 'rebaseURLs']);

        // Is this a full page request?
        if ($requestType == PAGE) {
            // Yes, so define the content and load the layout
            $pageContent = $this->viewsDir . $view;
            require $this->viewsDir . $layout;
        }
        else {
            // No, it's HTMX, so just the action / fragment
            require $this->viewsDir . $view;
        }

        // End capture - return resulting HTML
        ob_end_flush();


        // Show debug info ------------------------------------------------------
        if ($this->debug) {
            consoleGroupStart('NEW REQUEST');
                consoleLog($requestURL,    'Request URL');
                consoleLog($requestMethod, 'Method');
                consoleLog($requestType,   'Type');

                if ($routeMatched) { consoleLog($routeInfo['url'], 'Match'); consoleLog($route, 'Route'); }
                else consoleError('No matching route', '');

                consoleLog($view, 'View');
                if ($requestType == PAGE) consoleLog($layout, 'Layout');

                if ($vars ?? null) consoleLog($vars, 'Variables');

                if ($_GET)   consoleLog($_GET,   'GET Data');
                if ($_POST)  consoleLog($_POST,  'POST Data');
                if ($_PUT)   consoleLog($_PUT,   'PUT Data');
                if ($_FILES) consoleLog($_FILES, 'FILES Data');
            consoleGroupEnd();
        }
    }


    /**
     * Rebase all links / urls to incluide the base URL
     * Allows for sites to be run from within server sub-folders
     * whilst still having URLs that read as if in the server root
     */
    private function rebaseURLs($buffer)
    {
        $urlPrefixes = [
            'href="',       // Links
            'src="',        // Images / scripts
            'hx-post="',    // POST requests   (Create)
            'hx-get="',     // GET requests    (Read)
            'hx-put="',     // PUT requests    (Update)
            'hx-delete="'   // DELETE requests (Delete)
        ];

        foreach ($urlPrefixes as $prefix) {
            $buffer = str_replace($prefix . '/', $prefix . SITE_BASE . '/', $buffer);
        }

        return $buffer;
    }
}
