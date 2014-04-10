<?php

namespace vg\active_record;


/***
 *
 */
function class_to_table_name($class_name)
{
    // remove the namespace
    $name = explode('\\', $class_name);
    $name = end($name);

    // make plural
    $name = strtolower($name) . 's';

    return $name;
}

/***
 * @param $value mixed
 * @return string
 *
 * Converts the argument to a string
 */
function value_to_string($value)
{
    return var_export($value, true);
}

/***
 * @return \DateTime
 */
function now() {

    list($microseconds, $unix_time) = explode(' ', microtime());

    // remove the 0. from the start of the string and only get 6 digits
    $microseconds = substr($microseconds, 2, 6);

    $timezone = 'UTC';
    $format = 'd-m-Y H:i:s.u';

    $datetime_now = date('Y-m-d H:i:s\.', $unix_time) . $microseconds;

    // set timezone to user timezone
    // date_default_timezone_set($str_user_timezone);

    $date = new \DateTime($datetime_now, new \DateTimeZone($timezone));

    // to get the format, call format!
    $return = $date->format($format);

    // return timezone to server default
    // date_default_timezone_set($str_server_timezone);

    return $return;
}

