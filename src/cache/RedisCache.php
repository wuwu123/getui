<?php
/**
 * Created by PhpStorm.
 * User: wujie
 * Date: 2018/11/26
 * Time: 10:43
 */

namespace getui\src\cache;


class RedisCache implements CacheInterface
{
    /**
     * @var \Redis
     */
    private $redis;

    public function __construct($redis)
    {
        $this->redis = $redis;
    }

    /**
     * @param $key
     * @param $value
     * @param int $time
     * @return bool
     */
    public function set($key, $value, $time = 8600)
    {
        return $this->redis->set($key, $value, $time);
    }

    /**
     * @param $key
     * @param null $default
     * @return bool|string
     */
    public function get($key)
    {
        return $this->redis->get($key);
    }

    /**
     * @param $key
     * @return int
     */
    public function del($key)
    {
        return $this->redis->delete($key);
    }


}