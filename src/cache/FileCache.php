<?php
/**
 * Created by PhpStorm.
 * User: wujie
 * Date: 2018/11/27
 * Time: 16:35
 */

namespace getui\src\cache;


use Symfony\Component\Cache\Simple\FilesystemCache;

class FileCache implements CacheInterface
{

    private $model;

    public function __construct()
    {
        $this->model = new FilesystemCache();
    }

    public function getKey($key)
    {
        $string = "{}()/\@:";
        $search = str_split($string);
        $replace = array_pad([], count($search), "_");
        return str_replace($search, $replace, $key);
    }

    /**
     * @param $key
     * @param $value
     * @param int $time
     * @return bool
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function set($key, $value, $time = 8600)
    {
        $key = $this->getKey($key);
        return $this->model->set($key, $value, $time);
    }

    /**
     * @param $key
     * @param null $default
     * @return bool|string
     */
    public function get($key)
    {
        $key = $this->getKey($key);
        return $this->model->get($key);
    }

    /**
     * @param $key
     * @return int
     */
    public function del($key)
    {
        $key = $this->getKey($key);
        return $this->model->delete($key);
    }
}