<?php

// From the URL of the routing script, obtain the base URL for all links
define('SITE_BASE', dirname($_SERVER['SCRIPT_NAME']));

// Define key view folders
define('LAYOUTS',    __DIR__ . '/../views/layouts/');
define('PAGES',      __DIR__ . '/../views/pages/');
define('PARTIALS',   __DIR__ . '/../views/partials/');
define('COMPONENTS', __DIR__ . '/../views/components/');

// Constants for request methods
define('GET',  'GET');
define('POST', 'POST');

// Constants for request types
define('PAGE',      'PAGE');        // A normal, page request
define('COMPONENT', 'COMPONENT');   // An HTMX request

/**
 * Parse the current request URL to extract:
 *  - The type of request, GET or POST
 *  - The route (first part of URL)
 *  - Parameters (array of subsequent parts of URL)
 *  - Whether this was a request for a page or a component
 *
 * Returns an array containing the above
 */
function parseURL($url) {
    // Trim off the base URL from the start of request to give a relative URL
    $relativeURL = substr($url, strlen(SITE_BASE));
    // Remove any GET filters
    $routing = explode('?', $relativeURL)[0];

    // Get the first term from this URL - this defines the route
    $route = strtok($routing, '/');

    // Other terms define any parameters
    $params = [];
    $param = strtok('/');
    while ($param !== false) {
        $params[] = $param;
        $param = strtok('/');
    }

    // Was this an HTMX request for a page component, or a full page request / HTMX boosted page?
    $htmx    = $_SERVER['HTTP_HX_REQUEST'] ?? false;
    $boosted = $_SERVER['HTTP_HX_BOOSTED'] ?? false;
    $type    = !$htmx || $boosted ? PAGE : COMPONENT;

    // What type of request was it?
    $method = $_SERVER['REQUEST_METHOD'];

    // Return the data parsed from the URL
    return [
        'method' => $method,     // GET or POST
        'type'   => $type,       // PAGE or COMPONENT
        'route'  => $route,      // Route string
        'params' => $params      // Array of parameters (after route)
    ];
}

