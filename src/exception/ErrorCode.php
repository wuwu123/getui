<?php
/**
 * Created by PhpStorm.
 * User: wujie
 * Date: 2018/11/26
 * Time: 11:55
 */

namespace getui\src\exception;


class ErrorCode
{

    const REQUEST_ERROR = "请求异常";

    const NOT_AUTH = "not_auth";
    const NOT_AUTH_MESSAGE = "无效的授权码";
}