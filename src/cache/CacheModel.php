<?php
/**
 * Created by PhpStorm.
 * User: wujie
 * Date: 2018/11/27
 * Time: 16:40
 */

namespace getui\src\cache;


trait CacheModel
{
    /**
     * @var CacheInterface
     */
    private $cacheModel;

    /**
     * @return CacheInterface
     */
    public function getCacheModel(): CacheInterface
    {
        if ($this->cacheModel) {
            return $this->cacheModel;
        }
        $this->cacheModel = new FileCache();
        return $this->cacheModel;
    }

    /**
     * @param CacheInterface $cacheModel
     * @return $this
     */
    public function setCacheModel(CacheInterface $cacheModel)
    {
        $this->cacheModel = $cacheModel;
        return $this;
    }


}