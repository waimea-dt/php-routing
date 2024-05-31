<?php

/*=====================================================================
 * PHP Debugging Utility Library
 * 
 * Version: 1.3 (May 2024)
 * 
 * Steve Copley
 * Waimea College 
 * Digital Technologies Dept.
 *
 * https://github.com/...
 * 
 *---------------------------------------------------------------------
 * Functions to:
 * 
 *  - Display debug info in the JS console: consoleLog()
 *                                          consoleError()
 *                                          consoleGroupStart()
 *                                          consoleGroupEnd()
 *                                          consoleDivider()
 * 
 *---------------------------------------------------------------------
 * History:
 * 
 *  1.0 (2024-03-04) - Initial release
 *  1.1 (2024-03-08) - Tweaks to the console output
 *  1.2 (2024-03-18) - Console grouping functions and output tweaks
 *  1.3 (2024-05-30) - New consoleError() and some tidying up
 * 
 *=====================================================================*/


/**
 * Add debug info to the JS Console in the browser
 *
 * Arguments: $var     - a variable to display
 *            $heading - an optional heading to show beforhand
 *            $error   - false for plain log, true for error
 */
function consoleLog($var, $heading='', $error=false) {
    // Is this an error or just info?
    $logCmd   = $error ? 'console.error' : 'console.log';
    $logLabel = $error ? '⚠ PHP ERROR' : '★ PHP';
    // Log the message
    echo PHP_EOL . '<script>';
    echo $logCmd . '(`%c' . $logLabel . '%c : ';
    // Heading if present
    if ($heading) echo $heading . ' : ';
    // Message content as a pre-formatted, multi-line string
    print_r($var);
    // Provide styling CSS
    echo '`, `color: #e26;`, `color: inherit;`);';
    echo '</script>' . PHP_EOL;
}

/**
 * Add debug error message to the JS Console in the browser
 *
 * Arguments: $var     - a variable to display
 *            $heading - an optional heading to show beforhand
 */
function consoleError($var, $heading='') {
    consoleLog($var, $heading, true);
}


/**
 * Begin a debug group within the JS Console in the browser
 *
 * Arguments: $label - an optional label for the group
 */
function consoleGroupStart($label='') {
    echo PHP_EOL . '<script>console.group(`';
    if ($label) echo $label;
    echo '`);</script>' . PHP_EOL;
}


/**
 * End a previously started debug group within the JS Console
 * in the browser
 */
function consoleGroupEnd() {
    echo PHP_EOL . '<script>console.groupEnd();</script>' . PHP_EOL;
}


/**
 * Add a visual seperator within the JS Console in the browser
 */
function consoleDivider() {
    echo PHP_EOL . '<script>console.log(';
    echo   '`%c――――――――――――――――――――――――――――――――――――――――`,';
    echo   '`color: #e26;`';
    echo ');</script>' . PHP_EOL;
}


