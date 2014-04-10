<?php

namespace vg\active_record\connection_adapter;

/***
 * Class MySQLAdapter
 * @package vg\active_record\connection_adapter
 *
 * - CRUD: tables / columns
 */
class MySQLAdapter implements IConnectionAdapter
{
    private $username;
    private $password;
    private $database;
    private $server;
    private $link;

    function __construct($username, $password, $database, $server)
    {
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        $this->server = $server;
    }

    public function connect()
    {
        if ($this->link === null)
        {
            $this->link = mysql_connect($this->server, $this->username, $this->password);
            mysql_select_db($this->database, $this->link);
        }
    }

    /***
     *
     */
    public function disconnect()
    {
        mysql_close($this->link);
    }

    /***
     * @param $query
     * @return Column[]
     *
     * Gets the column information from the specified table name
     */
    public function get_columns($query)
    {
        $this->connect();

        $result = mysql_query($query);

        $columns = array();

        while ($row = mysql_fetch_assoc($result))
        {
            $name = $row['Field'];
            $default_value = $row['Default'];
            $type = $row['Type'];
            $is_primary = $row['Key'] == 'PRI';

            $columns[$name] = new Column($name, $default_value, $type, $is_primary);
        }

        return $columns;
    }

    /***
     * @param $query string
     * @throws \Exception
     * @return mixed
     *
     * Executes a saving query
     */
    public function save($query)
    {
        $this->connect();

        echo "SQL: $query";

        $result = mysql_query($query);

        if (!$result)
        {
            throw new \Exception(mysql_error($this->link));
        }
    }
}
