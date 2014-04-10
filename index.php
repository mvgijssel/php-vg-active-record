<?php
/**
 * Created by PhpStorm.
 * User: Maarten
 * Date: 10-4-14
 * Time: 7:55
 */

namespace vg\active_record;

use vg\active_record\connection_adapter\MySQLAdapter;
use vg\active_record\query_builder\SQLBuilder;

/***
 * TODO: localization
 * TODO: logging
 */

require_once __DIR__ . '/vendor/autoload.php';

// composition
ActiveRecord::$connection = new MySQLAdapter('root', '', 'active_record', 'localhost');
ActiveRecord::$query_builder = new SQLBuilder();

class User extends ActiveRecord
{
    public static $accessible = array(
        "name"
    );

    public static $validates = array(
        "name" => array(
            "presence" => true
        )
    );
}


$user = new User(array("name" => "maarten"));

$user->save();

echo $user;
