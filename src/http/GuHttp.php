<?php
/**
 * Created by PhpStorm.
 * User: wujie
 * Date: 2018/11/29
 * Time: 18:03
 */

namespace getui\http;


use GuzzleHttp\Client;
use GuzzleHttp\Promise\PromiseInterface;

class GuHttp implements HttpInterface
{
    private $client;
    /**
     * @var PromiseInterface
     */
    private $resource;


    public function __construct($config = [])
    {
        $this->client = new Client($config);
    }

    public function getBody()
    {
        if (!$this->resource) {
            return json_encode(["result" => "无效的请求"]);
        }
        return $this->resource->getBody()->getContents();
    }

    public function getStatusCode()
    {
        if (!$this->resource) {
            return 200;
        }
        return $this->resource->getStatusCode();
    }

    public function request($method, $uri = '', array $options = []) : self
    {
        $this->resource = $this->client->request($method, $uri, $options);
        return $this;
    }

}