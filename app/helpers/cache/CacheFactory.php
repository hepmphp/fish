<?php

namespace  app\helpers\cache;

class CacheFactory {
    CONST FILE='file';
    CONST MEMCACHE = 'memcache';
    CONST MEMCACHED = 'memcached';
    CONST REDIS = 'redis';
    public static function get_instance($type='file',$config=array())
    {
        if($type==self::FILE){
            return new File($config);
        }elseif($type==self::MEMCACHE){
            return new Memcache($config);
        }elseif($type==self::MEMCACHED){
            return new Memcached($config);
        }elseif($type==self::REDIS){
            return new CacheRedis($config);
        }
    }
}