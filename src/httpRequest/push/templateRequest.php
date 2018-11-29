<?php
/**
 * Created by PhpStorm.
 * User: wujie
 * Date: 2018/11/27
 * Time: 15:02
 */

namespace getui\httpRequest\push;


use getui\template\Link;
use getui\template\Notification;
use getui\template\Notypopload;
use getui\template\PushInfo;
use getui\template\Style;

trait templateRequest
{
    protected $link;

    protected $notification;

    protected $notypopload;

    protected $style;

    protected $pushInfo;

    /**
     * @return array
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param Link $link
     * @return $this
     */
    public function setLink(Link $link)
    {
        $this->link = $link->getEntity();
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNotification()
    {
        return $this->notification;
    }

    /**
     * @param mixed $notification
     * @return $this
     */
    public function setNotification(Notification $notification)
    {
        $this->notification = $notification->getEntity();
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNotypopload()
    {
        return $this->notypopload;
    }

    /**
     * @param mixed $notypopload
     * @return $this
     */
    public function setNotypopload(Notypopload $notypopload)
    {
        $this->notypopload = $notypopload->getEntity();
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * @param mixed $style
     * @return $this
     */
    public function setStyle(Style $style)
    {
        $this->style = $style->getEntity();
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPushInfo()
    {
        return $this->pushInfo;
    }

    /**
     * @param mixed $pushInfo
     * @return $this
     */
    public function setPushInfo(PushInfo $pushInfo)
    {
        $this->pushInfo = $pushInfo->getEntity();
        return $this;
    }

}