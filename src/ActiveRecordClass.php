<?php

namespace vg\active_record;

/***
 * Class ActiveRecord
 * @package vg\active_record
 *
 * defines all the class methods
 */
class ActiveRecordClass
{
    /***
     * @var connection_adapter\IConnectionAdapter
     *
     * The database connection adapter for interacting with the actual database.
     */
    public static $connection;

    /***
     * @var query_builder\IQueryBuilder
     *
     * The sql builder class which constructs sql statements from methods
     */
    public static $query_builder;


    /***
     * @var string
     *
     * The database table name automatically inferred from the class name.
     */
    public static $table_name;
    public static $validates;

    /***
     * @var array
     *
     * Ignores the database type and casts to and from to the specified datatype
     */
    public static $types;

    public static $has_many;
    public static $accessible;
    public static $belongs_to;

    /***
     * @var array
     *
     */
    protected static $default_attributes;

    /***
     *
     */
    public static function first($limit = 1)
    {

    }

    /***
     * @return array
     *
     * Gets the attributes from the database with the default values
     */
    protected static function get_default_attributes()
    {
        if (static::$default_attributes === null)
        {
            static::$default_attributes = self::create_attributes();
        }

        return static::$default_attributes;
    }

    /***
     * @param $attributes Attribute[]
     */
    protected static function save_attributes($attributes)
    {
        $query = static::$query_builder->save_attributes(static::get_table_name(), $attributes);

        static::$connection->save($query);
    }

    protected static function update_attributes($attributes)
    {

    }

    /***
     * @return Attribute[]
     *
     * Creates attributes based on the columns of the table
     */
    private static function create_attributes()
    {
        $columns = static::$connection->get_columns(static::$query_builder->get_columns(self::get_table_name()));

        $attributes = [];

        foreach ($columns as $col_name => $column)
        {
            $attributes[$col_name] = new Attribute($column->name, $column->type, $column->default_value, $column->is_primary);
        }

        return $attributes;
    }

    /***
     *
     */
    private static function get_table_name()
    {
        if (self::$table_name === null)
        {
            self::$table_name = class_to_table_name(get_called_class());
        }

        return self::$table_name;
    }
}
