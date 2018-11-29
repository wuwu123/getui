<?php
/**
 * Created by PhpStorm.
 * User: wujie
 * Date: 2018/11/26
 * Time: 12:08
 */

namespace getui\src\httpRequest;


use getui\config\Config;
use getui\src\cache\CacheInterface;
use getui\src\cache\CacheModel;
use getui\src\cache\FileCache;
use getui\src\exception\RequestException;

class AuthToken
{
    use CacheModel;
    /**
     * @var Config
     */
    private $config;

    private $cacheKey;

    public function getCacheModel(): CacheInterface
    {
        if ($this->cacheModel) {
            return $this->cacheModel;
        }
        if ($this->config->getCacheModel() instanceof CacheInterface) {
            $this->cacheModel = $this->config->getCacheModel();
        }
        $this->cacheModel = new FileCache();
        return $this->cacheModel;
    }

    /**
     * @return Config
     * @desc
     */
    public function getConfig(): Config
    {
        return $this->config;
    }

    /**
     * @param Config $config
     * @desc
     */
    public function setConfig(Config $config)
    {
        $this->config = $config;
    }


    public function __construct(Config $config)
    {
        $this->setConfig($config);
        $this->setCacheKey();
    }

    public function setCacheKey()
    {
        $this->cacheKey = "gettui:auth_sign:" . $this->getConfig()->getAppKey();
    }

    /**
     * @return HttpRequest
     */
    private function getAuthRequest()
    {
        $timestamp = (int)floor(microtime(true) * 1000);
        $sign = hash('sha256', "{$this->config->getAppKey()}{$timestamp}{$this->config->getMasterSecret()}");
        $postData = [
            "sign" => $sign,
            "timestamp" => $timestamp,
            "appkey" => $this->config->getAppKey()
        ];
        $httpModel = new HttpRequest(1);
        return $httpModel->setConfig($this->getConfig())->request(HttpRequest::METHOD_POST, "auth_sign", $postData, false);
    }


    /**
     * 获取token
     *
     * @param bool $new
     * @return null
     * @throws RequestException
     */
    public function getAuthToken($new = false)
    {
        $auth_token = $new ? null : $this->getCacheModel()->get($this->cacheKey);
        if (!$auth_token) {
            $this->getCacheModel()->del($this->cacheKey);
            $httpRequest = $this->getAuthRequest();
            if (!$httpRequest->isSuccess() || !isset($httpRequest->getResultDataBody()['auth_token'])) {
                throw new RequestException($httpRequest->getDesc());
            }
            $auth_token = $httpRequest->getResultDataBody()['auth_token'];
            $this->cacheModel->set($this->cacheKey, $auth_token, 86000);
        }
        return $auth_token;
    }

    private function delAuthRequest()
    {
        $postData = [
            "appid" => $this->config->getAppId()
        ];
        $httpModel = new HttpRequest(0);
        return $httpModel->request(HttpRequest::METHOD_POST, "auth_close", $postData);
    }

    /**
     * @desc 删除token
     */
    public function delAuthToken()
    {
        $this->getCacheModel()->del($this->cacheKey);
        $this->delAuthRequest();
    }
}