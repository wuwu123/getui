<?php
/**
 * Created by PhpStorm.
 * User: wujie
 * Date: 2018/11/27
 * Time: 15:48
 */

namespace getui\src\httpRequest\push;


use getui\src\exception\RequestException;

class PushList extends Base
{
    public function getRequestBody(): array
    {
        return $this->requestBody;
    }


    /**
     * 设置发送内容
     *
     * @return $this
     */
    public function listBody()
    {
        $this->setUrl("save_list_body");
        $this->requestBody = array_merge([
            "message" => $this->getMessage(),
        ], $this->getMessageContent());
        return $this;
    }

    /**
     * 要发送哪些用户
     *
     * @param array $cid
     * @param string $taskid
     * @return $this
     */
    public function pushList(array $cid, string $taskid)
    {
        $this->setUrl("push_list");
        $this->requestBody = [
            "cid" => $cid,
            "taskid" => $taskid,
            "need_detail" => true
        ];
        return $this;
    }

    /**
     * 批量推送
     *
     * @param array $cid
     * @return $this
     */
    public function pushListSend(array $cid)
    {
        $this->listBody()->request();
        $taskid = $this->getResult()["taskid"] ?? null;
        if (!$taskid) {
            return $this;
        }
        $this->pushList($cid, $taskid);
        return $this;
    }

}