<?php
/**
 * Created by PhpStorm.
 * User: wujie
 * Date: 2018/11/28
 * Time: 15:11
 */

namespace getui\httpRequest\user;

use getui\httpRequest\HttpRequest;
use getui\httpRequest\HttpRequestCommon;

class User extends HttpRequestCommon
{
    private $cuid;

    /**
     * @return mixed
     */
    public function getCuid()
    {
        return $this->cuid;
    }

    /**
     * @param mixed $cuid
     * @return $this
     */
    public function setCuid($cuid)
    {
        $this->cuid = $cuid;
        return $this;
    }


    /**
     * 用户状态
     *
     * @param $cuid
     * @return $this
     */
    public function userStatus($cuid)
    {
        $this->setCuid($cuid);
        $this->setUrl("user_status/" . $this->getCuid());
        $this->setMethod(HttpRequest::METHOD_GET);
        return $this;
    }

    /**
     * @param int $time 时间戳
     * @return $this
     */
    public function appUser(int $time)
    {
        $time = date("Y-m-d", $time);
        $this->setUrl("query_app_user/" . $time);
        $this->setMethod(HttpRequest::METHOD_GET);
        return $this;
    }

    /**
     * 获取单日推送数据接口
     *
     * @param int $time
     * @return $this
     */
    public function appPush(int $time)
    {
        $time = date("Y-m-d", $time);
        $this->setUrl("query_app_push/" . $time);
        $this->setMethod(HttpRequest::METHOD_GET);
        return $this;
    }

    /**
     * 用户添加标签
     *
     * @param string $cuid
     * @param array $tagList
     * @return $this
     */
    public function userAddTag(string $cuid, array $tagList)
    {
        $this->setUrl("set_tags");
        $this->setRequestBody([
            "cid" => $cuid,
            "tag_list" => array_values($tagList)
        ]);
        $this->setMethod(HttpRequest::METHOD_POST);
        return $this;
    }

    /**
     * 查询用户标签
     *
     * @param $cuid
     * @return $this
     */
    public function userTag($cuid)
    {
        $this->setCuid($cuid);
        $this->setUrl("get_tags/" . $this->getCuid());
        $this->setMethod(HttpRequest::METHOD_GET);
        return $this;
    }

}