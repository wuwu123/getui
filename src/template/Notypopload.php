<?php
/**
 * Created by PhpStorm.
 * User: Mr.Zhou
 * Date: 2018/10/22
 * Time: 下午2:28
 */

namespace getui\template;

class Notypopload implements Template
{
    /**
     * 通知栏消息布局样式，详见Style说明
     *
     * @var Style
     */
    protected $style;

    /**
     * 通知栏图标 (必传)
     *
     * @var string
     */
    protected $notyicon;

    /**
     * 通知标题 (必传)
     *
     * @var string
     */
    protected $notytitle;

    /**
     * 通知内容 (必传)
     *
     * @var string
     */
    protected $notycontent;

    /**
     * 弹出框标题 (必传)
     *
     * @var string
     */
    protected $poptitle;

    /**
     * 弹出框内容 (必传)
     *
     * @var string
     */
    protected $popcontent;

    /**
     * 弹出框图标 (必传)
     *
     * @var string
     */
    protected $popimage;

    /**
     * 弹出框左边按钮名称 (必传)
     *
     * @var string
     */
    protected $popbutton1;

    /**
     * 弹出框右边按钮名称 (必传)
     *
     * @var string
     */
    protected $popbutton2;

    /**
     * 下载图标
     *
     * @var string
     */
    protected $loadicon;

    /**
     * 下载标题
     *
     * @var string
     */
    protected $loadtitle;

    /**
     * 下载文件地址 (必传)
     *
     * @var string
     */
    protected $loadurl;

    /**
     * 是否自动安装，默认值false
     *
     * @var bool
     */
    protected $is_autoinstall = false;

    /**
     * 安装完成后是否自动启动应用程序，默认值false
     *
     * @var bool
     */
    protected $is_actived = false;

    /**
     * 安装完成后是否自动启动应用程序，默认值false
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
     * 安卓标识
     *
     * @var string
     */
    protected $androidmark;

    /**
     * 塞班标识
     *
     * @var string
     */
    protected $symbianmark;

    /**
     * 苹果标识
     *
     * @var string
     */
    protected $iphonemark;

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
     * @param string $notyicon
     * @return $this
     */
    public function setNotyicon(string $notyicon)
    {
        $this->notyicon = $notyicon;
        return $this;
    }

    /**
     * @param string $notytitle
     * @return $this
     */
    public function setNotytitle(string $notytitle)
    {
        $this->notytitle = $notytitle;
        return $this;
    }

    /**
     * @param string $notycontent
     * @return $this
     */
    public function setNotycontent(string $notycontent)
    {
        $this->notycontent = $notycontent;
        return $this;
    }

    /**
     * @param string $poptitle
     * @return $this
     */
    public function setPoptitle(string $poptitle)
    {
        $this->poptitle = $poptitle;
        return $this;
    }

    /**
     * @param string $popcontent
     * @return $this
     */
    public function setPopcontent(string $popcontent)
    {
        $this->popcontent = $popcontent;
        return $this;
    }

    /**
     * @param string $popimage
     * @return $this
     */
    public function setPopimage(string $popimage)
    {
        $this->popimage = $popimage;
        return $this;
    }

    /**
     * @param string $popbutton1
     * @return $this
     */
    public function setPopbutton1(string $popbutton1)
    {
        $this->popbutton1 = $popbutton1;
        return $this;
    }

    /**
     * @param string $popbutton2
     * @return $this
     */
    public function setPopbutton2(string $popbutton2)
    {
        $this->popbutton2 = $popbutton2;
        return $this;
    }

    /**
     * @param string $loadicon
     * @return $this
     */
    public function setLoadicon(string $loadicon)
    {
        $this->loadicon = $loadicon;
        return $this;
    }

    /**
     * @param string $loadtitle
     * @return $this
     */
    public function setLoadtitle(string $loadtitle)
    {
        $this->loadtitle = $loadtitle;
        return $this;
    }

    /**
     * @param string $loadurl
     * @return $this
     */
    public function setLoadurl(string $loadurl)
    {
        $this->loadurl = $loadurl;
        return $this;
    }

    /**
     * @param bool $is_autoinstall
     * @return $this
     */
    public function setIsAutoinstall(bool $is_autoinstall)
    {
        $this->is_autoinstall = $is_autoinstall;
        return $this;
    }

    /**
     * @param bool $is_actived
     * @return $this
     */
    public function setIsActived(bool $is_actived)
    {
        $this->is_actived = $is_actived;
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
     * @param string $androidmark
     * @return $this
     */
    public function setAndroidmark(string $androidmark)
    {
        $this->androidmark = $androidmark;
        return $this;
    }

    /**
     * @param string $symbianmark
     * @return $this
     */
    public function setSymbianmark(string $symbianmark)
    {
        $this->symbianmark = $symbianmark;
        return $this;
    }

    /**
     * @param string $iphonemark
     * @return $this
     */
    public function setIphonemark(string $iphonemark)
    {
        $this->iphonemark = $iphonemark;
        return $this;
    }

    public function getEntity(): array
    {
        $res = [
            'style' => $this->style,
            'notyicon' => $this->notyicon,
            'notytitle' => $this->notytitle,
            'notycontent' => $this->notycontent,
            'poptitle' => $this->poptitle,
            'popcontent' => $this->popcontent,
            'popimage' => $this->popimage,
            'popbutton1' => $this->popbutton1,
            'popbutton2' => $this->popbutton2,
            'loadicon' => $this->loadicon,
            'loadtitle' => $this->loadtitle,
            'loadurl' => $this->loadurl,
            'is_autoinstall' => $this->is_autoinstall,
            'is_actived' => $this->is_actived,
        ];
        $this->duration_begin && $res['duration_begin'] = $this->duration_begin;
        $this->duration_end && $res['duration_end'] = $this->duration_end;
        return $res;
    }

}