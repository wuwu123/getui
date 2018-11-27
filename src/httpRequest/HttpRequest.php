<?php
/**
 * Created by PhpStorm.
 * User: wujie
 * Date: 2018/11/26
 * Time: 10:58
 */

namespace getui\src\httpRequest;

use getui\config\Config;
use getui\src\cache\CacheInterface;
use getui\src\cache\CacheModel;
use getui\src\exception\ErrorCode;
use getui\src\exception\RequestException;
use GuzzleHttp\Client;

class HttpRequest
{
    use CacheModel;
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

    private $authtoken = null;

    /**
     * @var Config
     */
    private $config = null;


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
     * @param array $resultDataBody
     * @return $this
     */
    public function setResultDataBody(array $resultDataBody)
    {
        $this->resultDataBody = $resultDataBody;
        return $this;
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
     * @param int $retry
     * @return $this
     */
    public function setRetry(int $retry)
    {
        $this->retry = $retry;
        return $this;
    }

    /**
     * @return int
     */
    public function getErrorCount(): int
    {
        return $this->errorCount;
    }

    /**
     * @param int $errorCount
     * @return $this
     */
    public function setErrorCount(int $errorCount)
    {
        $this->errorCount = $errorCount;
        return $this;
    }

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * @param string $baseUrl
     * @return $this
     */
    public function setBaseUrl(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
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
     * @param null $authtoken
     * @return $this
     */
    public function setAuthtoken($authtoken)
    {
        $this->authtoken = $authtoken;
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


    public function __construct($retry = 0, $timeOut = 1)
    {
        $this->retry = $retry;
        $this->setTimeOut($timeOut);
    }

    private function init()
    {
        $this->httpClient = new Client($this->getRequestConfig());
        $this->resultData = null;
        $this->resultDataBody = [];
    }

    public function getRequestUrl($url)
    {
        return $this->getBaseUrl() . $this->getConfig()->getAppId() . "/" . $url;
    }

    /**
     * @return null
     * @throws RequestException
     */
    public function getAuthtoken()
    {
        if ($this->authtoken) {
            return $this->authtoken;
        }
        $authToken = new AuthToken($this->config);
        if ($this->cacheModel) {
            $authToken->setCacheModel($this->cacheModel);
        }
        $this->authtoken = $authToken->getAuthToken();
        return $this->authtoken;
    }


    public function getRequestData($data, $isAuth)
    {
        $request = [
            "json" => $data,
        ];
        if ($isAuth && $this->getConfig()) {
            $request["headers"] = [
                "authtoken" => $this->getAuthtoken()
            ];
        }
        return $request;

    }

    /**
     * @param string $method
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
                if ($this->resultData->getStatusCode() == 405) {
                    throw new RequestException($url . "未开通", $this->resultData->getStatusCode());
                }
                if ($this->resultData->getStatusCode() != 200) {
                    throw new RequestException(ErrorCode::REQUEST_ERROR, $this->resultData->getStatusCode());
                }
                $this->resultDataBody = json_decode($this->resultData->getBody()->getContents(), true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    throw new RequestException(ErrorCode::REQUEST_ERROR, json_last_error_msg());
                }
                return $this;
            } catch (\Throwable $e) {
                $this->errorCount++;
                $this->resultDataBody["result"] = self::HTTP_ERROR;
                $this->resultDataBody["desc"] = $e->getMessage();
            }
        } while ($this->errorCount < $this->retry);
        return $this;
    }

    public function requestAfter()
    {
        $this->resultDataBody = array_merge($this->resultDataBody, [
            "result" => $this->resultDataBody["result"] == self::HTTP_SUCCESS ? self::HTTP_SUCCESS : self::HTTP_ERROR,
            "desc" => $this->resultDataBody["result"] ?? "",
        ]);
    }

    public function isSuccess()
    {
        $result = $this->resultDataBody["result"] ?? self::HTTP_ERROR;
        return $result == self::HTTP_SUCCESS;
    }

    public function getDesc()
    {
        return $this->resultDataBody["desc"] ?? "";
    }

}