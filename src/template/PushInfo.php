<?php
/**
 * Created by PhpStorm.
 * User: Mr.Zhou
 * Date: 2018/10/22
 * Time: 下午2:44
 */

namespace getui\src\template;

class PushInfo implements Template
{
    /**
     * ios的推送机制
     *
     * @var array
     */
    protected $aps;

    /**
     * 弹窗
     *
     * @var array
     */
    protected $alert;

    /**
     * 通知文本消息
     *
     * @var string
     */
    protected $body;

    /**
     * 用于多语言支持）指定执行按钮所使用的Localizable.strings
     *
     * @var string
     */
    protected $action_loc_key;

    /**
     * 用于多语言支持）指定Localizable.strings文件中相应的key
     *
     * @var string
     */
    protected $loc_key;

    /**
     * 如果loc-key中使用了占位符，则在loc-args中指定各参数
     *
     * @var string
     */
    protected $loc_args;

    /**
     * 指定启动界面图片名
     *
     * @var string
     */
    protected $launch_image;

    /**
     * 通知标题
     *
     * @var string
     */
    protected $title;

    /**
     * (用于多语言支持）对于标题指定执行按钮所使用的Localizable.strings,仅支持iOS8.2以上版本
     *
     * @var string
     */
    protected $titile_loc_key;

    /**
     * 对于标题,如果loc-key中使用的占位符，则在loc-args中指定各参数,仅支持iOS8.2以上版本
     *
     * @var string
     */
    protected $title_loc_args;

    /**
     * 通知子标题,仅支持iOS8.2以上版本
     *
     * @var string
     */
    protected $subtitle;

    /**
     * 当前本地化文件中的子标题字符串的关键字,仅支持iOS8.2以上版本
     *
     * @var string
     */
    protected $subtitle_loc_key;

    /**
     * 当前本地化子标题内容中需要置换的变量参数 ,仅支持iOS8.2以上版本
     *
     * @var string
     */
    protected $subtitle_loc_args;

    /**
     * 用于计算icon上显示的数字，还可以实现显示数字的自动增减，如“+1”、 “-1”、 “1” 等，计算结果将覆盖badge
     *
     * @var string
     */
    protected $auto_badge = '+1';

    /**
     * 通知铃声文件名，无声设置为“com.gexin.ios.silence”
     *
     * @var string
     */
    protected $sound = 'default';

    /**
     * 推送直接带有透传数据 -1 1
     *
     * @var integer
     */
    protected $content_available = 1;

    /**
     * 在客户端通知栏触发特定的action和button显示
     *
     * @var string
     */
    protected $category;

    /**
     * 透传，自定义数据
     *
     * @var string
     */
    protected $payload;

    /**
     * 多媒体
     *
     * @var array
     */
    protected $multimedia;

    /**
     * 多媒体资源地址
     *
     * @var string
     */
    protected $url;

    /**
     * 资源类型（1.图片，2.音频， 3.视频）
     *
     * @var int
     */
    protected $type;

    /**
     * 是否只在wifi环境下加载，如果设置成true,但未使用wifi时，会展示成普通通知
     *
     * @var bool
     */
    protected $only_wifi = false;

    /**
     * @param array $aps
     * @return $this
     */
    public function setAps(array $aps)
    {
        $this->aps = $aps;
        return $this;
    }

    /**
     * @param array $alert
     * @return $this
     */
    public function setAlert(array $alert)
    {
        $this->alert = $alert;
        return $this;
    }

    /**
     * @param string $body
     * @return $this
     */
    public function setBody(string $body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @param string $action_loc_key
     * @return $this
     */
    public function setActionLocKey(string $action_loc_key)
    {
        $this->action_loc_key = $action_loc_key;
        return $this;
    }

    /**
     * @param string $loc_key
     * @return $this
     */
    public function setLocKey(string $loc_key)
    {
        $this->loc_key = $loc_key;
        return $this;
    }

    /**
     * @param string $loc_args
     * @return $this
     */
    public function setLocArgs(string $loc_args)
    {
        $this->loc_args = $loc_args;
        return $this;
    }

    /**
     * @param string $launch_image
     * @return $this
     */
    public function setLaunchImage(string $launch_image)
    {
        $this->launch_image = $launch_image;
        return $this;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param string $titile_loc_key
     * @return $this
     */
    public function setTitileLocKey(string $titile_loc_key)
    {
        $this->titile_loc_key = $titile_loc_key;
        return $this;
    }

    /**
     * @param string $title_loc_args
     * @return $this
     */
    public function setTitleLocArgs(string $title_loc_args)
    {
        $this->title_loc_args = $title_loc_args;
        return $this;
    }

    /**
     * @param string $subtitle
     * @return $this
     */
    public function setSubtitle(string $subtitle)
    {
        $this->subtitle = $subtitle;
        return $this;
    }

    /**
     * @param string $subtitle_loc_key
     * @return $this
     */
    public function setSubtitleLocKey(string $subtitle_loc_key)
    {
        $this->subtitle_loc_key = $subtitle_loc_key;
        return $this;
    }

    /**
     * @param string $subtitle_loc_args
     * @return $this
     */
    public function setSubtitleLocArgs(string $subtitle_loc_args)
    {
        $this->subtitle_loc_args = $subtitle_loc_args;
        return $this;
    }

    /**
     * @param string $auto_badge
     * @return $this
     */
    public function setAutoBadge(string $auto_badge)
    {
        $this->auto_badge = $auto_badge;
        return $this;
    }

    /**
     * @param string $sound
     * @return $this
     */
    public function setSound(string $sound)
    {
        $this->sound = $sound;
        return $this;
    }

    /**
     * @param int $content_available
     * @return $this
     */
    public function setContentAvailable(int $content_available)
    {
        $this->content_available = $content_available;
        return $this;
    }

    /**
     * @param string $category
     * @return $this
     */
    public function setCategory(string $category)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @param string $payload
     * @return $this
     */
    public function setPayload(string $payload)
    {
        $this->payload = $payload;
        return $this;
    }

    /**
     * @param array $multimedia
     * @return $this
     */
    public function setMultimedia(array $multimedia)
    {
        $this->multimedia = $multimedia;
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
     * @param int $type
     * @return $this
     */
    public function setType(int $type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param bool $only_wifi
     * @return $this
     */
    public function setOnlyWifi(bool $only_wifi)
    {
        $this->only_wifi = $only_wifi;
        return $this;
    }

    /**
     * 获取弹窗通知实体
     *
     * @return array
     */
    public function getAlertEntity()
    {
        $res = [
            'aps' => [
                'alert' => [
                    "title" => $this->title,
                    "body" => $this->body,
                ],
                'autoBadge' => $this->auto_badge,
                'content-available' => $this->content_available,
                'sound' => $this->sound,
            ],
        ];
        $this->url && $res['aps']['multimedia'] = [
            'type' => $this->type,
            'url' => $this->url,
            'only_wifi' => $this->only_wifi,
        ];
        $this->payload && $res['payload'] = $this->payload;
        return $res;
    }
}