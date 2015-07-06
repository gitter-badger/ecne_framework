<?php

/**
 *  Class \Classes\DateFormat
 * @author Johhn O'Grady
 * @date 06/07/15
 */

namespace Classes;


class DateFormat
{
    private static $instance;
    /**
     * The date string
     *
     * @var string
     */
    private $date;

    /**
     * The date format
     *
     * @var string
     */
    private $format;

    public static function get()
    {
        self::$instance = new DateFormat();
        return self::$instance;
    }

    public function date($date)
    {
        $this->date = $date;
        return $this;
    }

    public function format($format)
    {
        $this->format = $format;
        return $this;
    }

    public function run()
    {
        $date = new \DateTime($this->date);
        return $date->format($this->format);
    }
}