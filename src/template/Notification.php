<?php
/**
 * Created by PhpStorm.
 * User: Mr.Zhou
 * Date: 2018/10/22
 * Time: 下午2:14
 */

namespace getui\template;

class Notification implements Template
{
    /**
     * 通知栏消息布局样式，详见Style说明
     * @var Style
     */
    protected $style;

    /**
     * 收到消息是否立即启动应用，true为立即启动，false则广播等待启动，默认是否
     * @var bool
     */
    protected $transmission_type = false;

    /**
     * 透传内容（一般是json字符串）
     * @var string
     */
    protected $transmission_content = '';

    /**
     * 设定展示开始时间，格式为yyyy-MM-dd HH:mm:ss
     * @var string
     */
    protected $duration_begin;

    /**
     * 设定展示结束时间，格式为yyyy-MM-dd HH:mm:ss
     * @var string
     */
    protected $duration_end;

    /**
     * 获取应用模板
     * @return array
     */
    public function getEntity() : array
    {
        $res = [];
        $this->style && $res['style'] = $this->style;
        $res['transmission_type'] = $this->transmission_type;
        $res['transmission_content'] = $this->transmission_content;
        $this->duration_begin && $res['duration_begin'] = $this->duration_begin;
        $this->duration_end && $res['duration_end'] = $this->duration_end;
        return $res;
    }

    /**
     * @param Style $style
     * @return $this
     */
    public function setStyle(Style $style)
    {
        $this->style = $style->getEntity();
        return $this;
    }

    /**
     * @param bool $transmission_type
     * @return $this
     */
    public function setTransmissionType(bool $transmission_type)
    {
        $this->transmission_type = $transmission_type;
        return $this;
    }

    /**
     * @param string $transmission_content
     * @return $this
     */
    public function setTransmissionContent(string $transmission_content)
    {
        $this->transmission_content = $transmission_content;
        return $this;
    }

    /**
     * @param string $duration_begin
     * @return $this
     */
    public function setDurationBegin(string $duration_begin)
    {
        $this->duration_begin = $duration_begin;
        return $this;
    }

    /**
     * @param string $duration_end
     * @return $this
     */
    public function setDurationEnd(string $duration_end)
    {
        $this->duration_end = $duration_end;
        return $this;
    }


}