<?php
/**
 * Created by PhpStorm.
 * User: wujie
 * Date: 2018/11/28
 * Time: 15:15
 */

namespace getui\httpRequest;


use getui\config\Config;

class HttpRequestCommon
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @var HttpRequest
     */
    private $httpModel;

    private $method = HttpRequest::METHOD_POST;

    private $url;

    private $requestBody = [];

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     * @return $this
     */
    public function setMethod(string $method)
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRequestBody()
    {
        return $this->requestBody;
    }

    /**
     * @param mixed $requestBody
     * @return $this
     */
    public function setRequestBody($requestBody)
    {
        $this->requestBody = $requestBody;
        return $this;
    }


    /**
     * @return HttpRequest
     */
    public function getHttpModel(): HttpRequest
    {
        return $this->httpModel;
    }

    /**
     * @param HttpRequest $httpModel
     * @return $this
     */
    public function setHttpModel(HttpRequest $httpModel)
    {
        $this->httpModel = $httpModel;
        return $this;
    }


    /**
     * @return Config
     */
    public function getConfig(): Config
    {
        return $this->config;
    }

    /**
     * @param Config $config
     * @return $this
     */
    public function setConfig(Config $config)
    {
        $this->config = $config;
        return $this;
    }


    public function __construct(Config $config)
    {
        $this->setConfig($config);
    }


    public static function make()
    {
        return new static(...func_get_args());
    }

    public function request()
    {
        $this->httpModel = new HttpRequest(...func_get_args());
        $this->httpModel = $this->httpModel->setConfig($this->getConfig())->request($this->method, $this->url, $this->getRequestBody());
        return $this;
    }

    public function getRequestGetuiResult()
    {
        return $this->httpModel->getResultData()->getBody()->getContents();
    }

    public function getRequestResult()
    {
        return $this->httpModel->getResultDataBody();
    }

}