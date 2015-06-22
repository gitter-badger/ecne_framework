<?php


namespace Classes\DB;
class DBDriver
{
    const MYSQL = 'MYSQL';
    const POSTGRESQL = 'POSTGRESQL';
    const SQLITE = 'SQLITE';
    const MARIADB = 'MARIADB';

    /**
     * @var string
     */
    private $driver;

    /**
     * @var string
     */
    private $DSN;

    /**
     * @method construct
     * @access public
     * @param $driverType
     */
    public function __construct($driverType)
    {
        $this->driver = $driverType;
    }

    /**
     * @method getDSN
     * @access public
     * @return string
     */
    public function getDSN()
    {
        switch ($this->driver) {
            case self::MYSQL:
                $this->DSN = 'mysql:host='.\Classes\Config::get('mysql/host').';dbname='.\Classes\Config::get('mysql/db');
                break;
            case self::POSTGRESQL:
                break;
            case self::SQLITE:
                break;
            case self::MARIADB:
                break;
            default:
                break;
        }
    }
}