<?php

/**
 * @package Request Handler
 * @author Amadi ifeanyi <amadiify.com>
 */
class Request
{
    // handle request data
    protected static $requestData = [];

    // request method
    protected $requestMethod = 'GET';

    // manual access
    protected $accessModel = null;

    // set request method
    public function __construct()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $this->requestMethod = $method;

        // push data to request data
        $this->pushData();
    }

    // check if key exists
    public function has()
    {
        $method = $this->requestMethod;
        // get params
        $params = func_get_args();
        // found = 0
        $found = 0;

        array_walk($params, function($val) use ($method, &$found){
            if (isset(self::$requestData[$method][$val]))
            {
                $found++;
            }
        });

        if ($found > 0)
        {
            return true;
        }

        return false;
    }

    // get value
    public function get(string $name)
    {
        $method = $this->requestMethod;
        $value = isset(self::$requestData[$method][$name]) ? self::$requestData[$method][$name] : null;
        return $value;
    }

    // get all data
    public function data()
    {
        $method = $this->requestMethod;
        return self::$requestData[$method];
    }

    // check if it's empty
    public function isEmpty()
    {
        $method = $this->requestMethod;

        if (count(self::$requestData[$method]) == 0)
        {
            return true;
        }

        return false;
    }

    // registry
    public function __get(string $name)
    {
        if ($name == 'get' || $name == 'post')
        {
            $this->requestMethod = strtoupper($name);
            return $this;
        }
        else
        {
            return $this->get($name);
        }
    }

    // set new data
    public function set(string $key, $value)
    {
        $method = $this->requestMethod;

        if (is_callable($value))
        {
            $val = isset(self::$requestData[$method][$key]) ? self::$requestData[$method][$key] : null;
            $value = call_user_func($value, $val);
        }

        self::$requestData[$method][$key] = $value;
    }

    // unset data
    public function remove()
    {
        $method = $this->requestMethod;

        $args = func_get_args();

        foreach ($args as $index => $key)
        {
            if (isset(self::$requestData[$method][$key]))
            {
                unset(self::$requestData[$method][$key]);
            }
        }
    }

    // push data
    private function pushData()
    {
        // PUSH POST
        self::$requestData['POST'] = $_POST;
        // PUSH GET
        self::$requestData['GET'] = $_GET;
    }

    // full data
    protected function fillDrum($method = 'POST', $data = [])
    {
        self::$requestData[strtoupper($method)] = $data;
    }

}

// create instance
$request = new Request();