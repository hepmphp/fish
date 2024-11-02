<?php
/**
 *  fiename: fish/Config.php$
 *  date: 2024/10/17 22:25:10$
 *  author: hepm<ok_fish@qq.com>$
 */

namespace base;

class Config implements \ArrayAccess
{
    protected $path;
    protected $configs = array();

    function __construct($path)
    {
        $this->path = $path;
    }

    function offsetGet($key):mixed
    {
        if (empty($this->configs[$key]))
        {
            $file_path = $this->path.'/'.$key.'.php';
            if(file_exists($file_path)){
                $config = require_once $file_path;
                $this->configs[$key] = $config;
            }

        }
        return $this->configs[$key];
    }

    function offsetSet($key, $value):void
    {
        throw new \Exception("cannot write config file.");
    }

    function offsetExists($key):bool
    {
        $res =  isset($this->configs[$key])?true:false;
        return $res;
    }

    function offsetUnset($key):void
    {
        unset($this->configs[$key]);
    }
}