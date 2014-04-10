<?php

namespace vg\active_record\connection_adapter;

class Column
{
    public $name;
    public $default_value;
    public $type;
    public $is_primary;

    function __construct($name, $default_value, $type, $is_primary)
    {
        $this->name = $name;
        $this->default_value = $default_value;
        $this->type = $type;
        $this->is_primary = $is_primary;
    }
}
