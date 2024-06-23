<?php

/*=====================================================================
 * Database Utility Library
 * 
 * Steve Copley @ Digital Technologies Dept. Waimea College 
 * https://github.com/waimea-dt/php-library/blob/main/lib/db.php
 *=====================================================================*/

require_once 'debug.php';

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
        consoleError('_db.ini file missing', 'DB Config');
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
        consoleError($e->getMessage(), 'DB Connect');
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

