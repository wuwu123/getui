<?php
/**
 * Created by PhpStorm.
 * User: wujie
 * Date: 2018/11/26
 * Time: 10:58
 */

namespace getui\httpRequest;

use getui\config\Config;
use getui\exception\ErrorCode;
use getui\exception\RequestException;
use GuzzleHttp\Client;

class HttpRequest
{
    const METHOD_POST = "POST";
    const METHOD_GET = "GET";

    const HTTP_SUCCESS = "ok";
    const HTTP_ERROR = "error";
    /**
     * @var Client
     */
    private $httpClient;

    private $resultData;

    private $resultDataBody = [];

    /**
     * @var float 超时时间
     */
    private $timeOut = 5;

    private $requestConfig = [];

    /**
     * @var int 重试次数
     */
    private $retry = 0;

    /**
     * @var int 错误次数
     */
    private $errorCount = 0;

    private $baseUrl = 'https://restapi.getui.com/v1/';

    /**
     * @var Config
     */
    private $config = null;

    private $newAuth = false;


    /**
     * @return Client
     */
    public function getHttpClient(): Client
    {
        return $this->httpClient;
    }

    /**
     * @param Client $httpClient
     * @return $this
     */
    public function setHttpClient(Client $httpClient)
    {
        $this->httpClient = $httpClient;
        return $this;
    }


    public function getResultData()
    {
        return $this->resultData;
    }

    /**
     * @return $this
     */
    public function setResultData($resultData)
    {
        $this->resultData = $resultData;
        return $this;
    }

    /**
     * @return array
     */
    public function getResultDataBody(): array
    {
        return $this->resultDataBody;
    }

    /**
     * @return float
     */
    public function getTimeOut(): float
    {
        return $this->timeOut;
    }

    /**
     * @param float $timeOut
     * @return $this
     */
    public function setTimeOut(float $timeOut)
    {
        $this->timeOut = $timeOut;
        return $this;
    }

    /**
     * @return int
     */
    public function getRetry(): int
    {
        return $this->retry;
    }

    /**
     * @return int
     */
    public function getErrorCount(): int
    {
        return $this->errorCount;
    }

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
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

    /**
     * @param array $requestConfig
     * @return $this
     */
    public function setRequestConfig(array $requestConfig)
    {
        $this->requestConfig = $requestConfig;
        return $this;
    }

    /**
     * @return array
     * @desc
     */
    public function getRequestConfig(): array
    {
        if ($this->requestConfig) {
            return $this->requestConfig;
        }
        return ["timeout" => $this->getTimeOut()];
    }


    public function __construct(int $retry = 0, int $timeOut = 1)
    {
        $this->retry = $retry;
        $this->setTimeOut($timeOut);
    }

    /**
     * 请求前初始化参数
     */
    private function init()
    {
        $this->httpClient = new Client($this->getRequestConfig());
        $this->resultData = null;
        $this->resultDataBody = [];
    }

    /**
     * 请求url
     *
     * @param $url
     * @return string
     */
    public function getRequestUrl($url)
    {
        return $this->getBaseUrl() . $this->getConfig()->getAppId() . "/" . $url;
    }


    public function getRequestData($data, $isAuth)
    {
        $request = [
            "json" => $data,
        ];
        if ($isAuth && $this->getConfig()) {
            $request["headers"] = [
                "authtoken" => (new AuthToken($this->config))->getAuthToken($this->newAuth)
            ];
        }
        return $request;

    }

    /**
     * @param $method
     * @param string $url
     * @param array $data
     * @param bool $isAuth
     * @return $this
     */
    public function request($method, string $url, array $data = [], $isAuth = true)
    {
        $this->errorCount = 0;
        do {
            try {
                $this->init();
                $this->resultData = $this->httpClient->request($method, $this->getRequestUrl($url), $this->getRequestData($data, $isAuth));
                $this->newAuth = false;
                if ($this->resultData->getStatusCode() != 200) {
                    throw new RequestException(ErrorCode::REQUEST_ERROR, $this->resultData->getStatusCode());
                }
                $this->resultDataBody = json_decode($this->resultData->getBody()->getContents(), true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    throw new RequestException(json_last_error_msg());
                }
                $this->requestAfter();
                if ($this->errorCount < $this->retry && $this->getDesc() == ErrorCode::NOT_AUTH) {
                    $this->retry = max($this->retry, 1);
                    $this->newAuth = true;
                    throw new RequestException(ErrorCode::NOT_AUTH);
                }
                return $this;
            } catch (\Throwable $e) {
                $this->errorCount++;
                $this->resultDataBody["result"] = self::HTTP_ERROR;
                $this->resultDataBody["error_desc"] = $e->getMessage();
            }
        } while ($this->errorCount < $this->retry);
        return $this;
    }

    public function requestAfter()
    {
        $this->resultDataBody = array_merge($this->resultDataBody, [
            "result" => $this->resultDataBody["result"] == self::HTTP_SUCCESS ? self::HTTP_SUCCESS : self::HTTP_ERROR,
            "error_desc" => $this->resultDataBody["result"] ?? "",
        ]);
    }

    public function isSuccess()
    {
        $result = $this->resultDataBody["result"] ?? self::HTTP_ERROR;
        return $result == self::HTTP_SUCCESS;
    }

    public function getDesc()
    {
        return $this->resultDataBody["error_desc"] ?? "";
    }

}