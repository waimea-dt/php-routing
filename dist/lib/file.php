<?php

/*=====================================================================
 * PHP File Utility Library
 * 
 * Steve Copley @ Digital Technologies Dept. Waimea College 
 * https://github.com/waimea-dt/php-library/blob/main/lib/file.php
 *=====================================================================*/


/**
 * Setup an output stream to write to for a file download
 *
 * Argument: $filename - The download filename, no extension
 *           $type     - The download file type, text-based
 *                       txt  - plain text
 *                       csv  - CSV data
 *                       json - JSON data
 *
 * Note: regardless of the type, you still have to output the
 *       actual data in the appropriate format using fputs(),
 *       fputcsv(), json_encode(), etc.
 *
 * Returns: the output stream file handle
 */
function prepareDownload( $filename='data', $type='txt' ) {
    $type = strtolower( $type );

        if( $type == 'txt'  ) $mimetype = 'text/plain';
    elseif( $type == 'csv'  ) $mimetype = 'text/csv';
    elseif( $type == 'json' ) $mimetype = 'application/json';
    else showErrorAndDie( 'Invalid data type' );

    header( 'Content-Type: '.$mimetype.'; charset=utf-8' );
    header( 'Content-Disposition: attachment; filename='.$filename.'.'.$type );
    header( 'Pragma: no-cache' );
    header( 'Expires: 0' );

    $handle = fopen( 'php://output', 'w' );

    return $handle;
}


/**
 * Close an output stream for a file download
 *
 * Argument: $handle - The output stream handle
 */
function finaliseDownload( $handle ) {
    fclose( $handle );
}



