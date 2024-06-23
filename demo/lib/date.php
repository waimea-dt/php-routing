<?php

/*=====================================================================
 * PHP Date Formatting Utility Library
 * 
 * Steve Copley @ Digital Technologies Dept. Waimea College 
 * https://github.com/waimea-dt/php-library/blob/main/lib/date.php
 *=====================================================================*/


/**
 * Convert a given timestamp in standard PHP/MySQL date/time
 * format (YYYY-MM-DD HH:MM:SS) into a nicely formated date
 *
 * Arguments: $timestamp - string containing timestamp
 *            $format - date format, defaults to D MMM YYYY
 *
 * Returns: date string, using the given format
 */
function formattedDate( $timestamp, $format='j M Y' ) {
    $date = new DateTime( $timestamp );
    return $date->format( $format );
}


/**
 * Convert a given timestamp in standard PHP/MySQL date/time
 * format (YYYY-MM-DD HH:MM:SS) into a nicely formated time
 *
 * Arguments: $timestamp - string containing timestamp
 *            $format - time format, defaults to H:MMam/pm
 *
 * Returns: date string, using the given format
 */
function formattedTime( $timestamp, $format='g:ia' ) {
    $date = new DateTime( $timestamp );
    return $date->format( $format );
}


/**
 * Check if a given timestamp in standard PHP/MySQL date/time
 * format (YYYY-MM-DD HH:MM:SS) is today
 *
 * Arguments: $timestamp - string containing timestamp
 *
 * Returns: true if is today, false otherwise
 */
function isToday( $timestamp ) {
    $date = new DateTime( $timestamp );
    $today = new DateTime( 'today' );
    $diff = $today->diff( $date );

    return ($diff->days == 0);
}


/**
 * Check if a given timestamp in standard PHP/MySQL date/time
 * format (YYYY-MM-DD HH:MM:SS) is in the past
 *
 * Arguments: $timestamp - string containing timestamp
 *
 * Returns: true if in past, false otherwise
 */
function isInPast( $timestamp ) {
    $date = new DateTime( $timestamp );
    $today = new DateTime( 'today' );
    $diff = $today->diff( $date );

    return $diff->invert;
}


/**
 * Convert a given timestamp in standard PHP/MySQL date/time
 * format (YYYY-MM-DD HH:MM:SS) into relative number of days:
 *    0 -> today
 *   -1 -> yesterday
 *   +1 -> tomorrow
 *   -n -> n days ago
 *   +n -> in n days
 *
 * Arguments: $timestamp - string containing timestamp
 *
 * Returns: relative date string
 */
function daysFromToday( $timestamp ) {
    $date = new DateTime( $timestamp );
    $today = new DateTime( 'today' );
    $diff = $today->diff( $date );

    if( $diff->days == 0 )                  return 'today';
    if( $diff->invert && $diff->days == 1 ) return 'yesterday';
    if( $diff->invert )                     return $diff->days.' days ago';
    if( $diff->days == 1 )                  return 'tomorrow';
                                            return 'in '.$diff->days.' days';
}



/**
 * Convert a given timestamp in standard PHP/MySQL date/time
 * format (YYYY-MM-DD HH:MM:SS) into an age in years:
 *    0 -> less than a year old
 *    1 -> 1 year old
 *   +n -> n years old
 *
 * Arguments: $timestamp - string containing timestamp
 *
 * Returns: age string
 */
function ageInYears( $timestamp ) {
    $date = new DateTime( $timestamp );
    $today = new DateTime( 'today' );
    $diff = $date->diff( $today );

    if( $diff->y == 0 ) return 'less than a year old';
    if( $diff->y == 1 ) return '1 year old';
                        return $diff->y.' years old';
}


