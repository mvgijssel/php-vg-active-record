<?php

namespace vg\active_record\query_builder;

class SQLBuilder implements IQueryBuilder
{

    /***
     * @param $table_name string
     * @return string
     *
     * Returns the query object for getting table column information
     */
    public function get_columns($table_name)
    {
        return "DESCRIBE $table_name";
    }

    /***
     * @param $table_name
     * @param $attributes \vg\active_record\Attribute[]
     * @return mixed
     */
    public function save_attributes($table_name, $attributes)
    {
        $sql = "INSERT INTO $table_name ";

        $columns = '';
        $values = '';

        foreach ($attributes as $attr_name => $attribute)
        {
            if ($attribute->is_primary)
                continue;

            if ($attribute->name == 'updated_at')
                $attribute->value = \vg\active_record\now();

            if ($attribute->name == 'created_at')
                $attribute->value = \vg\active_record\now();

            $columns .= "$attr_name, ";
            $values .= \vg\active_record\value_to_string($attribute->value) . ', ';
        }

        // remove the trailing comma
        $columns = substr($columns, 0, -2);
        $values = substr($values, 0, -2);

        $sql .= "($columns) VALUES ($values)";

        return $sql;
    }
}
