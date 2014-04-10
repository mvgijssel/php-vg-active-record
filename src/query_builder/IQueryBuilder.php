<?php

namespace vg\active_record\query_builder;

interface IQueryBuilder
{
    /***
     * @param $table_name string
     * @return string
     *
     * Returns the query object for getting table column information
     */
    public function get_columns($table_name);

    /***
     * @param $table_name
     * @param $attributes \vg\active_record\Attribute[]
     * @return mixed
     */
    public function save_attributes($table_name, $attributes);
}
