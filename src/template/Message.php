<?php
/**
 * Created by PhpStorm.
 * User: Mr.Zhou
 * Date: 2018/10/22
 * Time: 下午3:18
 */

namespace getui\src\template;

class Message implements Template
{
    /**
     * 配置信息
     *
     * @var string
     */
    protected $app_key;

    /**
     * 是否离线发送
     *
     * @var bool
     */
    protected $is_offline = true;

    /**
     * 消息有效时间
     *
     * @var float|int
     */
    protected $expire_time = 24 * 3600 * 30;

    /**
     * 消息类型 应用:notification 下载:notypopload 网页:link 透传:transmission
     *
     * @var string
     */
    protected $msgtype;

    /**
     * 应用消息类型
     */
    const MSG_TYPE_NOTIFICATION = 'notification';

    /**
     * 网页消息类型
     */
    const MSG_TYPE_LINK = 'link';

    /**
     * 下载消息类型
     */
    const MSG_TYPE_NITYPOPLOAD = 'notypopload';

    /**
     * 透传消息类型
     */
    const MSG_TYPE_TRANSMISSION = 'transmission';

    /**
     * @param string $app_key
     * @return $this
     */
    public function setAppKey(string $app_key)
    {
        $this->app_key = $app_key;
        return $this;
    }

    /**
     * @param bool $is_offline
     * @return $this
     */
    public function setIsOffline(bool $is_offline)
    {
        $this->is_offline = $is_offline;
        return $this;
    }

    /**
     * @param float|int $expire_time
     * @return $this
     */
    public function setExpireTime($expire_time)
    {
        $this->expire_time = $expire_time;
        return $this;
    }

    /**
     * @param string $msgtype
     * @return $this
     */
    public function setMsgtype(string $msgtype)
    {
        $this->msgtype = $msgtype;
        return $this;
    }



    /**
     * 获取实体
     *
     * @return array
     */
    public function getEntity(): array
    {
        return [
            'appkey' => $this->app_key,
            'is_offline' => $this->is_offline,
            'offline_expire_time' => $this->expire_time,
            'msgtype' => $this->msgtype,
        ];
    }
}