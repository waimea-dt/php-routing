<?php

/*=====================================================================
 * PHP Debugging Utility Library
 * 
 * Steve Copley @ Digital Technologies Dept. Waimea College 
 * https://github.com/waimea-dt/php-library/blob/main/lib/debug.php
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


/**
 * Display debug info at bottom right of window (shows on hover)
 * for the standard PHP arrays: GET / POST / FILE / SESSION
 */
function showDebugInfo() {
    $havePost    = isset( $_POST )    && sizeof( $_POST )    > 0;
    $haveGet     = isset( $_GET )     && sizeof( $_GET )     > 0;
    $haveFiles   = isset( $_FILES )   && sizeof( $_FILES )   > 0;
    $haveSession = isset( $_SESSION ) && sizeof( $_SESSION ) > 0;

    $haveInfo = $havePost || $haveGet || $haveFiles || $haveSession;

    $debugInfo  = '<div style="
                        box-sizing: border-box; 
                        font-family: system-ui, sans-serif; 
                        background: rgba(0,0,0,0.8); 
                        color: #fff; 
                        font-size: 18px; 
                        line-height: 1em; 
                        position: fixed; 
                        right: 0; 
                        bottom: 20px; 
                        padding: 10px 30px 10px 5px; 
                        width: 40px; 
                        max-width: 95vw; 
                        max-height: 90vh; 
                        border-radius: 10px 0 0 10px; 
                        display: flex; 
                        gap: 20px; 
                        z-index: 999; 
                        overflow-x: hidden; 
                        box-shadow: 0 0 5px 1px #00000040;
                    " ';
    $debugInfo .= 'onclick="this.style.width = this.style.width==\'auto\' ? \'40px\' : \'auto\';">';

    $debugInfo .= '<div style="
                        box-sizing: inherit; 
                        padding: 0; 
                        writing-mode: vertical-lr; 
                        align-self: flex-end; 
                        cursor: pointer; 
                        color: ' . ($haveInfo ? '#ff0' : '#666') . ';
                    ">
                        DEBUG INFO
                    </div>';

    $debugInfo .= '<pre style="
                        margin: 0; 
                        font-size: 16px; 
                        line-height: 16px; 
                        text-align: left; 
                        color: #fff;
                        background-color: transparent;
                    ">';

    if( $haveInfo ) {
        if( $havePost    ) $debugInfo .=    'POST: '.print_r( $_POST,    True ) . PHP_EOL;
        if( $haveGet     ) $debugInfo .=     'GET: '.print_r( $_GET,     True ) . PHP_EOL;
        if( $haveFiles   ) $debugInfo .=   'FILES: '.print_r( $_FILES,   True ) . PHP_EOL;
        $debugInfo .= 'SESSION: ('.print_r( session_name(), True ).') ';
        if( $haveSession ) $debugInfo .=             print_r( $_SESSION, True ) . PHP_EOL;
    }
    else {
        $debugInfo .= 'NONE';
    }

    $debugInfo .= '</pre></div>';

    echo $debugInfo;
}

