<?php
/**
 * Created by PhpStorm.
 * User: Mr.Zhou
 * Date: 2018/10/22
 * Time: 下午2:14
 */

namespace getui\src\template;

class Link implements Template
{
    /**
     * 通知栏消息布局样式，详见Style说明
     *
     * @var array
     */
    protected $style = [];

    /**
     * 打开网址
     *
     * @var string
     */
    protected $url;

    /**
     * 设定展示开始时间，格式为yyyy-MM-dd HH:mm:ss
     *
     * @var string
     */
    protected $duration_begin;

    /**
     * 设定展示结束时间，格式为yyyy-MM-dd HH:mm:ss
     *
     * @var string
     */
    protected $duration_end;

    /**
     * @param array $style
     * @return $this
     */
    public function setStyle(array $style)
    {
        $this->style = $style;
        return $this;
    }

    /**
     * @param string $url
     * @return $this
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
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



    /**
     * 获取应用模板
     *
     * @return array
     */
    public function getEntity() :array
    {
        $res = [
            'style' => $this->style,
            'url' => $this->url
        ];
        $this->duration_begin && $res['duration_begin'] = $this->duration_begin;
        $this->duration_end && $res['duration_end'] = $this->duration_end;
        return $res;
    }


}