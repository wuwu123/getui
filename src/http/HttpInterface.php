<?php
/**
 * Created by PhpStorm.
 * User: wujie
 * Date: 2018/11/29
 * Time: 17:49
 */

namespace getui\http;


interface HttpInterface
{

    public function getStatusCode();

    public function getBody();

    public function request($method, $uri = '', array $options = []);

}