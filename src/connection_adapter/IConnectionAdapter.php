<?php
/**
 * Created by PhpStorm.
 * User: Maarten
 * Date: 10-4-14
 * Time: 9:20
 */

namespace vg\active_record\connection_adapter;

interface IConnectionAdapter
{
    /***
     * @return mixed
     */
    public function connect();

    /***
     *
     */
    public function disconnect();

    /***
     * @param $query
     * @return Column[]
     *
     * Gets the column information from the specified table name
     */
    public function get_columns($query);

    /***
     * @param $query string
     * @throws \Exception
     * @return mixed
     *
     * Executes a saving query
     */
    public function save($query);

}
