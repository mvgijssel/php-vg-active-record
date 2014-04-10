<?php

namespace vg\active_record;

/***
 * Class ActiveRecordObject
 * @package vg\active_record
 *
 * defines all the instance methods
 */
class ActiveRecord extends ActiveRecordClass
{
    /***
     * @var Attribute[]
     */
    private $attributes;

    /***
     * @var bool
     *
     * Whether or not the record is a new record
     */
    private $is_new_record;

    public function __construct($attributes)
    {
        $this->attributes = static::get_default_attributes();
        $this->is_new_record = true;
        $this->set_attributes($attributes);
    }

    /***
     * Saves the current object to the database
     */
    public function save()
    {
        if ($this->is_new_record)
        {
            static::save_attributes($this->attributes);
        }
        else
        {
            static::update_attributes($this->attributes);
        }
    }

    /***
     * Checks whether the object attribute values are valid
     */
    public function is_valid()
    {

    }

    /***
     *
     */
    public function is_new_record()
    {
        return $this->is_new_record;
    }

    /***
     * @param $attributes array
     *
     * @throws \Exception
     */
    public function set_attributes($attributes)
    {
        foreach ($attributes as $attr_name => $attr_value) {
            if (in_array($attr_name, static::$accessible)) {
                $this->set_attribute($attr_name, $attr_value);
            } else {
                throw new \Exception(get_class($this) . ": can't mass assign attribute '$attr_name'");
            }
        }
    }

    /***
     * @param $name string
     * @return mixed
     *
     * Magic getter, gets the variable value
     */
    public function __get($name)
    {
        return $this->get_attribute($name);
    }

    /***
     * @param $name string
     * @param $value mixed
     *
     * Magic setter, sets the variable to the specified value
     */
    public function __set($name, $value)
    {
        $this->set_attribute($name, $value);
    }

    /***
     * @return string
     *
     * Converts the object to a string, called when: echo / print / .. is called
     */
    public function __toString()
    {
        $str = "[" . get_class($this) . " <";

        foreach ($this->attributes as $attr_name => $attribute) {
            $str = $str . "$attr_name: " . value_to_string($attribute->value) . ", ";
        }

        // remove the trailing ", "
        $str = substr($str, 0, -2);

        $str = $str . ">]";

        return $str;
    }

    /***
     * @param $name string
     * @return mixed
     * @throws \Exception
     *
     * Gets the attribute with the passed name
     */
    private function get_attribute($name)
    {
        if (isset($this->attributes[$name]))
        {
            return $this->attributes[$name]->value;
        }
        else
        {
            throw new \Exception("unknown attribute '$name'");
        }
    }

    /***
     * @param $name
     * @param $value
     * @throws \Exception
     *
     * Sets the attribute with the passed name
     */
    private function set_attribute($name, $value)
    {
        if (isset($this->attributes[$name]))
        {
            $this->attributes[$name]->value = $value;
        }
        else
        {
            throw new \Exception("unknown attribute '$name'");
        }
    }
}
