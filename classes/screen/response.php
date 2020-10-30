<?php

namespace Screen;

class Response
{
    private static $message = [];

    private static function setMessage(string $message, string $type)
    {
        if (count(self::$message) == 0)
        {
            self::$message = [
                'statusMsgClass' => 'alert-'.$type,
                'statusMsg' => $message
            ];
        }
    }

    // static method
    public static function __callStatic($meth, $args)
    {
        return self::setMessage($args[0], $meth);
    }

    // get message
    public static function getMessage(&$class=null, &$msg=null)
    {
        if (count(self::$message) > 0)
        {
            $class = self::$message['statusMsgClass'];
            $msg = self::$message['statusMsg'];
        }
    }
}