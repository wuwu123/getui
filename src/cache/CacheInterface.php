<?php
/**
 * Created by PhpStorm.
 * User: wujie
 * Date: 2018/11/26
 * Time: 10:41
 */

namespace getui\src\cache;


interface CacheInterface
{
    public function set($key, $value, $time);

    public function get($key);

    public function del($key);
}