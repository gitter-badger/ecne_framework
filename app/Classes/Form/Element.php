<?php

/**
 * Class Element
 * @author John O'Grady
 * @date 23/06/15
 */

namespace Classes\Form;

class Element
{
    const TYPE_TEXT = 'text';
    const TYPE_EMAIL = 'email';
    const TYPE_PASSWORD = 'password';
    const TYPE_SUBMIT = 'submit';
    const TYPE_HIDDEN = 'hidden';

    /**
     * @var string
     */
    private $type;

    /**
     * @var array
     */
    private $attributes = array();


    /**
     * @method constructor
     * @access public
     * @param $type
     * @param $attributes
     */
    public function __construct($type, $attributes)
    {
        $this->type = $type;
        $this->setAttribute('type', $this->type);
        foreach ($attributes as $key => $val) {
            $this->setAttribute($key, $val);
        }
    }

    /**
     * @method setAttribute
     * @access public
     * @param $field
     * @param $value
     */
    public function setAttribute($field, $value)
    {
        $this->attributes[$field] = $value;
    }

    /**
     * @method getAttribute
     * @access public
     * @param $key
     * @return mixed
     */
    public function getAttribute($key)
    {
        if (isset($this->attributes[$key])) {
            return $this->attributes[$key];
        }
    }

    /**
     * @method getAttributesArray
     * @access public
     * @return array
     */
    public function getAttributesArray()
    {
        return $this->attributes;
    }

    /**
     * @method getAttributes
     * @access public
     * @return string
     */
    public function getAttributes()
    {
        $attributes = array();
        foreach ($this->attributes as $key => $val) {
            array_push($attributes, $key . '=' . \Classes\Helper::returnDoubleQuotes($val));
        }
        return join(" ", $attributes);
    }

    /**
     * @method hasAttribute
     * @access public
     * @param $key
     * @return bool
     */
    public function hasAttribute($key)
    {
        return (isset($this->attributes[$key])) ? true : false;
    }

    /**
     * @method addClass
     * @access public
     * @param $class
     */
    public function addClass($class)
    {
        if ($this->hasAttribute('class')) {
            $this->attributes['class'] .= ' ' . $class;
        } else {
            $this->attributes['class'] = $class;
        }
    }

    /**
     * @method hasClass
     * @access public
     * @param $class
     * @return bool
     */
    public function hasClass($class)
    {
        if ($this->hasAttribute('class')) {
            if (preg_match("/{$class}/", $this->getAttribute('class'))) {
                return true;
            }
        }
        return false;
    }

    /**
     * @method render
     * @access public
     * @return string
     */
    public function render()
    {
        return '<input ' . $this->getAttributes() . ' />';
    }

}
