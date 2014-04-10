<?php

namespace vg\active_record;

class Attribute
{
    public $name;
    public $type;
    public $default_value;
    public $value;
    public $is_primary;

    function __construct($name, $type, $default_value, $is_primary)
    {
        $this->name = $name;
        $this->type = $type;
        $this->value = $this->default_value = $default_value;
        $this->is_primary = $is_primary;
    }
}
