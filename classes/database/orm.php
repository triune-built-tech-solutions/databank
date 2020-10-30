<?php

namespace Database;

use PDO;

/**
 * @package Simple Database ORM for fast database abstraction.
 * @author amadi ifeanyi <amadiify.com/repo/php-orm>
 */

class ORM
{
    // connection string
    public static $connection = [];

    // instance 
    private static $_instance = null;

    // table name
    private $tableName = null;

    // binds
    private $binds = [];

    // fetch row
    public $fetch = [];

    // smt instance
    private $smtInstance = null;

    // orm instance
    private $ormInstance = null;

    // current method
    private $currentMethod = null;

    // row
    private $row = 0;
    private $max = null;
    private $resultQuery = [];

    // fetchs 
    private static $dbfetch = [];

    // connect
    public static function instance()
    {
        if (! (self::$_instance instanceof self))
        {
            try
            {
                $con = (object) self::$connection;
                // // create dsn
                // $dsn = 'mysql:host='.$con->host.';dbname='.$con->db.';charset=UTF8;';
                // self::$_instance = new PDO($dsn, $con->user, $con->pass);
                
                self::$_instance = new \mysqli($con->host, $con->user, $con->pass, $con->db);

                if (self::$_instance->connect_error)
                {
                    throw new \Exception("Error Connecting to database.");
                }

                self::$_instance->set_charset('utf8mb4');
            }
            catch(PDOException $e)
            {
                die($e->getMessage());
            }
        }

        return self::$_instance;
    }

    // REGISTRY
    public function __call(string $meth, array $args)
    {
        return call_user_func_array([$this, $meth], $args);
    }

    public static function __callStatic($meth, $args)
    {
        $ins = new ORM();
        $ins->ormInstance  = $ins;
        if ($meth == 'table')
        {
            $meth = '_table';
        }

        return call_user_func_array([$ins, $meth], $args);
    }

    // 
    public function __get(string $name)
    {
        // set method
        $this->currentMethod = 'get';

        if ($this->fetch !== null)
        {
            $fetch = $this->fetch;
            return isset($fetch->{$name}) ? $fetch->{$name} : null;
        }

        if ($this->tableName == null)
        {
            $this->tableName = $name;
        }

        return $this;
    }

    public function _table(string $name)
    {
        if (!is_null($this->ormInstance))
        {
            $orm = $this->ormInstance;
        }
        else
        {
            $orm = new ORM();
        }
        
        $orm->tableName = $name;
        return $orm;
    }

    // insert query
    public function insert($data)
    {
        $table = $this->tableName;

        $sql = 'INSERT INTO '.$table.' (%keys) VALUES (%values)';

        if (is_object($data) || is_array($data))
        {
            // get keys
            $keys = is_array($data) ? array_keys($data) : array_keys(((array) $data));
            $_keys = implode(',', $keys);
            $sql = str_replace('%keys', $_keys, $sql);

            // set values
            $values = [];
            $binds = [];
            foreach ($keys as $index => $string)
            {
                $values[':'.$string] = $data[$string];
                $binds[] = '?';
            }

            // get keys for values
            $sql = str_replace('%values', implode(',', array_keys($values)), $sql);

            // send values to bind
            $this->binds = $values;
        }
        else
        {
            $sql = 'INSERT INTO '.$table.' VALUES '. $data;
        }


        return $this->execute($sql);
    }

    public function doFetch(&$ins, $stmt, $object=true)
    {
        if (is_null($ins->max))
        {
            $ins->row = 0;
            $ins->max = $stmt->num_rows;
            $ins->bind_array($stmt, $fetch, $ins);
        }

        if ($ins->row == $ins->max)
        {
            $ins->row = null;
            $ins->max = null;
            $ins = null;
            return false;
        }
        else
        {
            // get data
            $toarr = $ins->resultQuery[$ins->row];
            array_walk($toarr, function($e, $i) use (&$toarr){
                $e = stripslashes($e);
                $toarr[$i] = html_entity_decode($e, ENT_QUOTES, 'UTF-8');
            });
            $fetch = $toarr;
            
            if ($object)
            {
                $fetch = (object) $fetch;
            }

            $ins->row += 1;
            return $fetch;
        }
    }

    // fetch method
    public static function fetch($stmt, $object = true, $reset=false)
    {
        $id = spl_object_hash($stmt);

        if (!isset(self::$dbfetch[$id]))
        {
            self::$dbfetch[$id] = new ORM;
        }

        $ins = self::$dbfetch[$id];

        $fetch = $ins->doFetch($ins, $stmt, $object);

        if ($reset)
        {
            $ins->row = 0;
        }
        
        return $fetch;
    }

    // get rows
    public static function getRows(&$smt)
    {
        $rows = 0;
        if ($smt->num_rows > 0)
        {
            $rows = $smt->num_rows;
        }
        else
        {
            if ($smt->affected_rows > 0)
            {
                $rows = $smt->affected_rows;
            }
        }
        // return rows;
        return $rows;
    }

    // private execute query
    private function execute($sql, $fetchData=false)
    {
        $pdo = self::instance();

        if (preg_match('/[:]([\S]*)/', $sql))
        {
            $_query = $sql;

            $bind = $this->binds;

            preg_match_all('/([:][a-zA-Z0-9\-\_]+)/', $sql, $matches);
            if (count($matches[0]) > 0 && count($bind) > 0)
            {
                foreach ($matches[1] as $index => $param)
                {
                    $replace = $param;
                    $param = trim($param);
                    $param = preg_replace('/^[:]/','',$param);
                    
                    $val = isset($bind[':'.$param]) ? $bind[':'.$param] : null;

                    $type = '';

                    switch (gettype($val))
                    {
                        case 'integer':
                            $type = 'i';
                        break;
                        case 'string':
                            $type = 's';
                        break;
                        case 'double':
                            $type = 'd';
                        break;
                        case 'blob':
                            $type = 'b';
                        break;
                        default:
                            $type = 'i';
                    }

                    $order[] = [
                        'type' => $type,
                        'val' => $val
                    ];
                }
            }

            $_query = preg_replace('/([:][a-zA-Z0-9\-\_]+)/','?',$_query);

            $_query = preg_replace('/[\?]([a-zA-Z]*)/','? $1', $_query);
            $sql = $_query;
        }

        // prepare sql
        $smt = $pdo->prepare($sql);

        // bind if exists
        if (count($this->binds) > 0)
        {
            $bind = $this->binds;

            if (count($bind) > 0)
            {
                /*
                $index = 0;

                foreach ($bind as $key => $val)
                {
                    if (is_array($val) && isset($val[$index]))
                    {
                        $val = $val[$index];
                        $index++;
                    }
                    
                    if (is_string($val))
                    {
                        $smt->bindValue($key, $val, PDO::PARAM_STR);
                    }
                    elseif (is_int($val))
                    {
                        $smt->bindValue($key, $val, PDO::PARAM_INT);
                    }
                    elseif (is_bool($val))
                    {
                        $smt->bindValue($key, $val, PDO::PARAM_BOOL);
                    }
                    elseif (is_null($val))
                    {
                        $smt->bindValue($key, $val, PDO::PARAM_NULL);
                    }
                    else
                    {
                        $smt->bindValue($key, $val);
                    }
                }
                */


                $binds = [];
                $types = [];

                if (count($order) > 0)
                {
                    foreach($order as $i => $arr)
                    {
                        $types[] = $arr['type'];
                        $binds[] = $arr['val'];
                    }
                }

                $types = implode('', $types);
                $refArr = $binds;
                if ($smt !== false)
                {
                    $smt->bind_param($types, ...$refArr);
                    $_binds = [$types];
                    $_binds = array_merge($_binds, $binds);
                    $this->binds = $_binds;
                }
            }
        }

        // reset
        $this->binds = [];
        $this->fetch = null;
        $this->smtInstance = null;

        // execute query
        try
        {
            $run = $smt->execute();

            if ($run)
            {
                $smt->store_result();

                if (is_object($smt) && property_exists($smt, 'num_rows'))
                {
                    $rows = $smt->num_rows;
                }
                else
                {
                    $rows = $smt->affected_rows;
                }

                if ($fetchData)
                {
                    if ($rows == 1)
                    {
                        $this->bind_array($smt, $row);
                        $smt->fetch();
                        $smt->reset();

                        $this->fetch = (object) $row;
                    }
                }

                return $smt;
            }

            return (object) ['error' => 'Failed!'];
        }
        catch(PDOException $e)
        {
            die($e->getMessage());
        }
    }

    // bind array
    private function bind_array(&$stmt, &$row=[], &$ins=null)
    {
        $md = $stmt->result_metadata(); 
        $params = array();
        while($field = $md->fetch_field()) {
            $params[] = &$row[$field->name];
        }

        call_user_func_array(array($stmt, 'bind_result'), $params);

        if (!is_null($ins))
        {
            $result = [];
            $stmt->execute();
            while ($stmt->fetch()) { 
                foreach($row as $key => $val) 
                { 
                    $c[$key] = $val; 
                } 
                $result[] = $c; 
            } 

            $ins->resultQuery = $result;
        }
    }

    // update query
    public function update()
    {
        $args = func_get_args();
        $data = $args[0];
        $where = $args[1];
        $_binds = array_splice($args,2);

        $table = $this->tableName;

        $sql = 'UPDATE '.$table.' SET %values WHERE ';

        if (is_object($data) || is_array($data))
        {
            // get keys
            $keys = is_array($data) ? array_keys($data) : array_keys(((array) $data));
            $values = [];
            foreach ($keys as $index => $key)
            {
                $values[] = $key.' = :'.$key;
            }
            $sql = str_replace('%values', implode(',', $values), $sql);

            // set values
            $values = [];
            foreach ($keys as $index => $string)
            {
                $values[':'.$string] = $data[$string];
            }

            $sql .= $where;

            // send values to bind
            $this->binds = $values;
        }
        else
        {
            $sql = str_replace('%values', $data, $sql);
            $sql .= $where;
        }

        // add to binds
        if (count($_binds) > 0)
        {
            $binds = $this->binds;

            preg_match_all("/[:](\S*)/", $where, $params);
            if (count($params) > 0 && isset($params[0]) && count($params[0]) > 0)
            {
                $bind = [];
                $end = end($_binds);
                foreach ($params[0] as $index => $b)
                {
                    if (isset($_binds[$index]))
                    {
                        $bind[$b] = $_binds[$index];
                    }
                    else
                    {
                        $bind[$b] = $end;
                    }
                }

                $binds = array_merge($binds, $bind);
                $this->binds = $binds;
            }
        }

        return $this->execute($sql);
    }

    // select query
    public function get()
    {
        $table = $this->tableName;
        $args = func_get_args();
        $where = isset($args[0]) ? $args[0] : null;
        $binds = array_splice($args,1);

        $sql = 'SELECT * FROM '.$table;

        if (!is_null($where))
        {
            if (!preg_match("/^(order by|limit)/i", $where))
            {
                $sql .= ' WHERE '. $where;
            }
            else
            {
                $sql .= ' '.$where;
            }

            if (count($binds) > 0)
            {
                // check for params
                preg_match_all("/[:](\S*)/", $sql, $params);
                if (count($params) > 0 && isset($params[0]) && count($params[0]) > 0)
                {
                    $bind = [];
                    $end = end($binds);
                    foreach ($params[0] as $index => $b)
                    {
                        if (isset($binds[$index]))
                        {
                            $bind[$b] = $binds[$index];
                        }
                        else
                        {
                            $bind[$b] = $end;
                        }
                    }
                    $binds = $bind;
                }
            }
            
            $this->binds = $binds;
        }

        return $this->execute($sql, true);
    }

    // delete query
    public function del()
    {
        $table = $this->tableName;
        $args = func_get_args();
        $where = isset($args[0]) ? $args[0] : null;
        $binds = array_splice($args,1);

        $sql = 'DELETE FROM '.$table;

        if (!is_null($where))
        {
            $sql .= ' WHERE '. $where;

            if (count($binds) > 0)
            {
                // check for params
                preg_match_all("/[:](\S*)/", $sql, $params);
                if (count($params) > 0 && isset($params[0]) && count($params[0]) > 0)
                {
                    $bind = [];
                    $end = end($binds);
                    foreach ($params[0] as $index => $b)
                    {
                        if (isset($binds[$index]))
                        {
                            $bind[$b] = $binds[$index];
                        }
                        else
                        {
                            $bind[$b] = $end;
                        }
                    }

                    $binds = $bind;
                }
            }

            $this->binds = $binds;
        }

        return $this->execute($sql);   
    }
}