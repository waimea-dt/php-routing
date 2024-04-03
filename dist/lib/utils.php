<?php

/*=====================================================================
 * Waimea College Utility Library
 * Steve Copley
 * Digital Technologies Dept.
 *
 * Version: 3.3 (March 2024)
 *
 * Located at:
 * https://gist.github.com/waimea-cpy/ee38e663a380e5bef6d19b316dafd7f5
 *
 * Rewrite / update of
 * https://gist.github.com/waimea-cpy/7ae035ca308f5c18d4ff5a138e683c8b
 *
 * Functions to:
 *
 *   - Connect to MySQL server database via PDO:    connectToDB()
 *
 *   - Help with uploading images to the server:    uploadedImageData()
 *
 *   - Display debug info in the JS console:        consoleLog()
 *                                                  consoleGroupStart()
 *                                                  consoleGroupEnd()
 *                                                  consoleDivider()
 *
 *---------------------------------------------------------------------
 * History:
 *
 *  3.0 (2024-03-04) - Initial release
 *  3.1 (2024-03-08) - Tweaks to the console output
 *  3.2 (2024-03-18) - Console grouping functions and output tweaks
 *  3.3 (2024-03-22) - Image upload function
 *=====================================================================*/


// Constants to define how errors are logged to the JS console
define('INFO', false);
define('ERROR', true);


/**
 * Connect to MySQL database via PDO (PHP Data Objects)
 *
 * Requires: A config file called _db.ini with these fields...
 *             name="_______"  (the database to connect to)
 *             user="_______"  (the MySQL username)
 *             pass="_______"  (the MySQL password)
 *
 * Returns: the PDO database connection object
 */
function connectToDB() {
    // Do we have a config file?
    if (!file_exists('_db.ini')) {
        consoleLog('_db.ini file missing', 'DB Config', ERROR);
        die('Missing database configuration');
    }

    // Parse the  config file
    $db = parse_ini_file( '_db.ini', true );
    // Generate a Databse Source Name string
    $dsn = 'mysql:host=localhost;charset=utf8mb4;dbname=' . $db['name'];
    // Set some useful options (errors as exception, associative arrays)
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    // Attempt to connect
    try {
        // Return the newly connected PDO object
        return new PDO($dsn, $db['user'], $db['pass'], $options);
    }
    catch (PDOException $e) {
        // Something went wrong, so log it
        consoleLog($e->getMessage(), 'DB Connect', ERROR);
        die('There was an error when connecting to the database');
    }
}


/**
 * Validates an image upload and returns image data
 * which can then be stored inside a BLOB field
 *
 * Arguments: $image - an entry from the $_FILES array
 *                     with uploded file information
 *
 * Returns: an array conataining...
 *          - the binary data of the uploaded image
 *            suitable to be stored within a BLOB
 *          - the image type (e.g. image/png)
 */
function uploadedImageData($image) {
    // Check for uplaod error
    if ($image['error']) die('There was an error uploading the image');

    // Get uploaded image details
    $imageType = $image['type'];
    $imageFile = $image['tmp_name'];

    // Check if image is an actual image (excluding SVG which are text files)
    if( $imageType != 'image/svg+xml' ) {
        $validImage = getimagesize( $imageFile );
        if( !$validImage ) die( 'The file is not an image file!' );
    }

    // Check the image is of a suitable type
    if( $imageType != 'image/svg+xml' &&
        $imageType != 'image/png'     &&
        $imageType != 'image/jpeg'    &&
        $imageType != 'image/gif'     &&
        $imageType != 'image/webp' ) die( 'Only images are allowed' );

    // Get uploaded image data
    $imageData = file_get_contents($imageFile);

    return [
        'data' => $imageData,
        'type' => $imageType
    ];
}



/**
 * Add debug info to the JS Console in the browser
 *
 * Note, if a constant DEBUG is defined and set to false, this
 *       will suppress the output, otherwise it is shown
 *
 * Arguments: $var - a variable to display
 *            $heading - an optional heading to show beforhand
 *            $level - either INFO (default) or ERROR level
 */
function consoleLog($var, $heading='', $level=INFO) {
    // Only log if DEBUG not set to false
    if (defined('DEBUG') ? DEBUG : true) {
        // Is this an error or just info?
        $logCmd   = $level == ERROR ? 'console.error' : 'console.log';
        $logLabel = $level == ERROR ? '⚠ PHP ERROR' : '★ PHP';
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
}


/**
 * Begin a debug group within the JS Console in the browser
 *
 * Note, if a constant DEBUG is defined and set to false, this
 *       will suppress the output, otherwise it is shown
 *
 * Arguments: $label - an optional label for the group
 */
function consoleGroupStart($label='') {
    if (defined('DEBUG') ? DEBUG : true) {
        echo PHP_EOL . '<script>console.group(`';
        if ($label) echo $label;
        echo '`);</script>' . PHP_EOL;
    }
}


/**
 * End a previously started debug group within the JS Console
 * in the browser
 *
 * Note, if a constant DEBUG is defined and set to false, this
 *       will suppress the output, otherwise it is shown
 */
function consoleGroupEnd() {
    if (defined('DEBUG') ? DEBUG : true) {
        echo PHP_EOL . '<script>console.groupEnd();</script>' . PHP_EOL;
    }
}


/**
 * Add a visual seperator within the JS Console in the browser
 *
 * Note, if a constant DEBUG is defined and set to false, this
 *       will suppress the output, otherwise it is shown
 */
function consoleDivider() {
    if (defined('DEBUG') ? DEBUG : true) {
        echo PHP_EOL . '<script>console.log(';
        echo   '`%c――――――――――――――――――――――――――――――――――――――――`,';
        echo   '`color: #e26;`';
        echo ');</script>' . PHP_EOL;
    }
}




