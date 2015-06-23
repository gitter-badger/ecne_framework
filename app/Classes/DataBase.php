<?php

/**
 *    Class DataBase
 * @note Supplies an API for querying various databases independent of DB driver,
 *      -- and calls most queries for general use in most web projects
 * @author John O'Grady <ogradyjp@ogradyjohn.com or ogradjp@gmail.com>
 * @version 1.0
 * @date May 2015
 **/

namespace Classes;

use \PDO;
use \PDOStatement;

class DataBase
{
    /**
     * constants
     */
    const SQL_GET = 'SELECT ';
    const SQL_DEL = 'DELETE ';
    const SQL_LIMIT = 'LIMIT ';
    const SQL_OFFSET = ', ';
    const SQL_ORDER = 'ORDER BY ';
    const SQL_ASC = 'ASC ';
    const SQL_DESC = 'DESC ';
    const SQL_WHERE = 'WHERE ';
    const SQL_INSERT = 'INSERT INTO ';
    const SQL_AND = ' AND ';

    /**
     * @var \Classes\DB\DBDriver
     */
    private $dbDriver;

    /**
     * @var \Classes\DataBase
     */
    private static $instance;
    /**
     * @var \PDO
     */
    private $pdo;
    /**
     * @var \PDOStatement
     */
    private $query;
    /**
     * @var bool
     */
    private $error = false;
    /**
     * @var array
     */
    private $results;
    /**
     * @var int
     */
    private $count = 0;
    /**
     * @var string
     */
    private $table;
    /**
     * @var array
     */
    private $selectColumns = array('*');
    /**
     * @var array
     */
    private $insert = array();
    /**
     * @var int
     */
    private $limit;
    /**
     * @var int
     */
    private $offset;
    /**
     * @var string
     */
    private $orderBy;
    /**
     * @var array
     */
    private $paramArray = array();
    /**
     * @var array
     */
    private $whereClause = array();

    /**
     * @method default constructor
     * @note uses singleton pattern so only one instance of our database is used for all queries and connections...
     * @note host, db, username, and password are all supplied by the Config::get method getting data from our gloBal config array defined in Core/init.php
     * @access private
     */
    private function __construct()
    {
        $this->dbDriver = new DB\DBDriver(Config::get('mysql/driver'));
        try {
            $this->pdo = new PDO($this->dbDriver->getDSN(), 'root', '');
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * @method getInstance
     * @access public
     * @note if an instance of DB doesn't exist create a new instance of DB, if an instance of DB does exists return that
     * @return DataBase
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new DataBase();
        }
        return self::$instance;
    }

    /**
     * @method selectColumns
     * @access public
     * @param $cols
     * @return $this
     */
    public function selectColumns($cols)
    {
        $this->selectColumns = $cols;
        return $this;
    }

    /**
     * @method fromTable
     * @access public
     * @param $table
     * @return $this
     */
    public function fromTable($table)
    {
        $this->table = $table;
        return $this;
    }

    /**
     * @method insert
     * @access public
     * @param $insert
     * @return $this
     */
    public function insert($insert)
    {
        if(count($insert)) {
            $this->insert = $insert;
        }
        return $this;
    }

    /**
     * @method whereEquals
     * @access public
     * @param array
     * @return $this
     */
    public function whereEquals($whereEquals)
    {
        if (count($whereEquals) > 0) {
            $conditions = count($whereEquals)/ 2;
            for ($i = 0; $i < count($whereEquals); $i+=2) {
                array_push($this->whereClause, $whereEquals[$i]);
                array_push($this->whereClause, ' = ');
                array_push($this->whereClause, ' ? ');
                array_push($this->paramArray, $whereEquals[$i+1]);
                if ($i < ($conditions - 1)) {
                    array_push($this->whereClause, self::SQL_AND);
                }
            }
        }
        return $this;
    }

    /**
     * @method whereNotEquals
     * @access public
     * @param $field
     * @param $value
     * @return $this
     */
    public function whereNotEquals($field, $value)
    {
        array_push($this->whereClause, array($field, '!=', ' ? '));
        array_push($this->paramArray, $value);
        return $this;
    }

    /**
     * @method orderBy
     * @access public
     * @param $orderBy
     * @return $this
     */
    public function orderBy($orderBy)
    {
        if (count($orderBy) == 2) {
            $this->orderBy = $orderBy;
            array_push($this->paramArray, $orderBy[0]);
        }
        return $this;
    }

    /**
     * @method limit
     * @access public
     * @param $limit
     * @return $this
     */
    public function limit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @param $offset
     * @return $this
     */
    public function offset($offset)
    {
        $this->offset = $offset;
        return $this;
    }

    /**
     * @method buildSelect
     * @access public
     * @return string
     */
    public function buildSelect()
    {
        $sql = self::SQL_GET . join(', ', $this->selectColumns) . ' FROM ' . $this->table . ' ';
        return $sql;
    }

    /**
     * @method buildInsert
     * @access public
     * @return string
     */
    public function buildInsert()
    {
        $sql = self::SQL_INSERT . $this->table .' ';
        $cols = array();
        $vals = array();
        foreach ($this->insert as $col => $val) {
            array_push($cols, $col);
            array_push($vals, ' ? ');
            array_push($this->paramArray, $val);
        }
        $sql .= ' ( ' . join(", ", $cols) . ' ) VALUES ( ' . join(", ", $vals) . ' ) ';
        return $sql;
    }

    /**
     * @method buildWhere
     * @access public
     * @return string
     */
    public function buildWhere()
    {
        if (count($this->whereClause) == 3) {
            $sql = 'WHERE ' . join(' ', $this->whereClause);
            return $sql;
        }
        return '';
    }

    /**
     * @method buildOrderBy
     * @access public
     * @return string
     */
    public function buildOrderBy()
    {
        if (isset($this->orderBy)) {
            $sql = 'ORDER BY ' . join(' ', $this->orderBy) . ' ';
            return $sql;
        } else {
            return '';
        }
    }

    /**
     * @method buildLimit
     * @access public
     * @return string
     */
    public function buildLimit()
    {
        if (isset($this->limit)) {
            $sql = 'LIMIT ' . $this->limit;
            if (isset($this->offset)) {
                $sql .= ', ' . $this->offset;
            }
            return $sql;
        }
        return '';
    }

    /**
     * @method buildQuery
     * @access public
     * @return string
     */
    public function buildQuery()
    {
        if (count($this->insert) > 0) {
            return $this->buildInsert();
        } else {
            return join(" ", array(
                    $this->buildSelect(),
                    $this->buildWhere(),
                    $this->buildOrderBy(),
                    $this->buildLimit()
                )
            );
        }
    }

    /**
     * @method run
     * @access public
     * @return $this
     */
    public function run()
    {
        $this->execute($this->buildQuery());
        return $this;
    }

    /**
     * @method execute
     * @access public
     * @param $query
     * @return $this
     */
    public function execute($query)
    {
        $this->error = false;
        if ($query) {
            if ($this->query = $this->pdo->prepare($query)) {
                if (count($this->paramArray)) {
                    $x = 1;
                    foreach ($this->paramArray as $param) {
                        if (is_null($param)) {
                            $var = PDO::PARAM_NULL;
                        } elseif (is_int($param)) {
                            $var = PDO::PARAM_INT;
                        } elseif (is_bool($param)) {
                            $var = PDO::PARAM_BOOL;
                        } else {
                            $var = PDO::PARAM_STR;
                        }
                        $this->query->bindValue($x, $param, $var);
                        $x++;
                    }
                }  /* End Foreach... */
                if ($this->query->execute()) {
                    $this->results = $this->query->fetchAll(PDO::FETCH_OBJ);
                    $this->count = $this->query->rowCount();
                } else {
                    $this->error = true;
                }
            }
        }
        self::reset();
        return $this;
    }

    public function reset()
    {
        $this->paramArray = array();
    }

    /**
     * @method result
     * @access public
     * @return mixed
     */
    public function result()
    {
        return $this->results;
    }

    /**
     * @method one
     * @access public
     * @return mixed
     */
    public function one()
    {
        return $this->results[0];
    }

    /**
     * @method error
     * @access public
     * @return bool
     */
    public function error()
    {
        return $this->error;
    }
}  /** End Class Definition **/