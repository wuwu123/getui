<?php
/**
 * Created by PhpStorm.
 * User: wujie
 * Date: 2018/11/26
 * Time: 12:11
 */
namespace getui\config;
use getui\cache\CacheModel;

class Config
{
    use CacheModel;
    private $app_key;
    private $app_id;
    private $master_secret;
    private $logo_url;

    /**
     * @return mixed
     * @desc
     */
    public function getAppKey()
    {
        return $this->app_key;
    }

    /**
     * @param mixed $app_key
     * @desc
     */
    public function setAppKey($app_key)
    {
        $this->app_key = $app_key;
    }

    /**
     * @return mixed
     * @desc
     */
    public function getAppId()
    {
        return $this->app_id;
    }

    /**
     * @param mixed $app_id
     * @desc
     */
    public function setAppId($app_id)
    {
        $this->app_id = $app_id;
    }

    /**
     * @return mixed
     * @desc
     */
    public function getMasterSecret()
    {
        return $this->master_secret;
    }

    /**
     * @param mixed $master_secret
     * @desc
     */
    public function setMasterSecret($master_secret)
    {
        $this->master_secret = $master_secret;
    }

    /**
     * @return mixed
     * @desc
     */
    public function getLogoUrl()
    {
        return $this->logo_url;
    }

    /**
     * @param mixed $logo_url
     * @desc
     */
    public function setLogoUrl($logo_url)
    {
        $this->logo_url = $logo_url;
    }


    public function __construct(array $config)
    {
        foreach ($config as $key => $val) {
            $function = "set" . ucfirst(\getui\Tool::toCamelCase($key));
            if (method_exists($this, $function)) {
                $this->$function($val);
            }
        }
    }

}