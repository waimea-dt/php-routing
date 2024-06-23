<?php

/*=====================================================================
 * PHP Text Utility Library
 * 
 * Steve Copley @ Digital Technologies Dept. Waimea College 
 * https://github.com/waimea-dt/php-library/blob/main/lib/text.php
 *=====================================================================*/


/**
 * Convert any newlines in some given text to HTML <p>...</p>
 *
 * Argument: $text - the text to convert
 *
 * Returns: a string full of HTML paragraphs, if any were found
 *          a blank string otherwise
 */
function text2paras( $text ) {
    $paragraphs = explode( PHP_EOL, $text );

    $paragraphsHTML = '';

    foreach( $paragraphs as $para ) {
        $trimmed = trim( $para );

        if( !empty( $trimmed ) ) {
            $paragraphsHTML .= '<p>'.$trimmed.'</p>';
        }
    }

    return $paragraphsHTML;
}



