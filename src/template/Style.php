<?php
/**
 * Created by PhpStorm.
 * User: Mr.Zhou
 * Date: 2018/10/22
 * Time: 下午1:44
 */

namespace getui\src\template;

/**
 * 安卓通知样式实体类
 * Class Style
 *
 * @package GeTui\Template
 */
class Style implements Template
{
    const TYPE_SYSTEM = 0;
    const TYPE_GETUI = 1;
    const TYPE_BF = 4;
    const TYPE_DETAIL = 6;
    /**
     * 通知类型 0系统 1个推 4背景图样式 6展开通知样式
     *
     * @var int
     */
    protected $type = 0;

    /**
     * 通知标题
     *
     * @var string
     */
    protected $title;

    /**
     * 通知内容
     *
     * @var string
     */
    protected $text;

    /**
     * 通知的图标名称，包含后缀名（需要在客户端开发时嵌入），如“push.png”
     *
     * @var string
     */
    protected $logo = '';

    /**
     * 通知图标URL地址
     *
     * @var string
     */
    protected $logourl;

    /**
     * 通知展示样式类型
     * 1 通知展示大图样式，参数是大图的URL地址
     * 2 通知展示文本+长文本样式，参数是长文本
     * 3 通知展示大图+小图样式，参数是大图URL和小图URL
     *
     * @var int
     */
    protected $big_style;

    /**
     * 通知大图URL地址
     *
     * @var string
     */
    protected $big_image_url;

    /**
     * 通知展示文本+长文本样式，参数是长文本
     *
     * @var string
     */
    protected $big_text;

    /**
     * 通知小图URL地址
     *
     * @var string
     */
    protected $banner_url;

    /**
     * 收到通知是否响铃：true响铃，false不响铃。默认响铃
     *
     * @var bool
     */
    protected $is_ring = true;

    /**
     * 收到通知是否振动：true振动，false不振动。默认振动
     *
     * @var bool
     */
    protected $is_vibrate = true;

    /**
     * 通知是否可清除： true可清除，false不可清除。默认可清除
     *
     * @var bool
     */
    protected $is_clearable = true;

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
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param string $text
     * @return $this
     */
    public function setText(string $text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @param string $logo
     * @return $this
     */
    public function setLogo(string $logo)
    {
        $this->logo = $logo;
        return $this;
    }

    /**
     * @param string $logourl
     * @return $this
     */
    public function setLogourl(string $logourl)
    {
        $this->logourl = $logourl;
        return $this;
    }

    /**
     * @param int $big_style
     * @return $this
     */
    public function setBigStyle(int $big_style)
    {
        $this->big_style = $big_style;
        return $this;
    }

    /**
     * @param string $big_image_url
     * @return $this
     */
    public function setBigImageUrl(string $big_image_url)
    {
        $this->big_image_url = $big_image_url;
        return $this;
    }

    /**
     * @param string $big_text
     * @return $this
     */
    public function setBigText(string $big_text)
    {
        $this->big_text = $big_text;
        return $this;
    }

    /**
     * @param string $banner_url
     * @return $this
     */
    public function setBannerUrl(string $banner_url)
    {
        $this->banner_url = $banner_url;
        return $this;
    }

    /**
     * @param bool $is_ring
     * @return $this
     */
    public function setIsRing(bool $is_ring)
    {
        $this->is_ring = $is_ring;
        return $this;
    }

    /**
     * @param bool $is_vibrate
     * @return $this
     */
    public function setIsVibrate(bool $is_vibrate)
    {
        $this->is_vibrate = $is_vibrate;
        return $this;
    }

    /**
     * @param bool $is_clearable
     * @return $this
     */
    public function setIsClearable(bool $is_clearable)
    {
        $this->is_clearable = $is_clearable;
        return $this;
    }



    /**
     * @return bool
     */
    public function isClearable(): bool
    {
        return $this->is_clearable;
    }

    public function getEntity(): array
    {
        switch ($this->type) {
            case self::TYPE_SYSTEM:
                return $this->getSystemEntity();
                break;
            case self::TYPE_GETUI:
                return $this->getGeTuiEntity();
                break;
            case self::TYPE_BF:
                return $this->getBannerEntity();
                break;
            case self::TYPE_DETAIL:
                return $this->getExpandEntity();
                break;
        }
    }

    /**
     * 获取系统通知样式实体
     *
     * @return array
     */
    private function getSystemEntity()
    {
        $this->type = 0;
        return [
            'type' => $this->type,
            'title' => $this->title,
            'text' => $this->text,
            'logo' => $this->logo,
            'logo_url' => $this->logourl,
            'is_ring' => $this->is_ring,
            'is_vibrate' => $this->is_vibrate,
            'is_clearable' => $this->is_clearable,
        ];
    }

    /**
     * 获取个推通知样式实体
     *
     * @return array
     */
    private function getGeTuiEntity()
    {
        $this->type = 1;
        return [
            'type' => $this->type,
            'title' => $this->title,
            'text' => $this->text,
            'logo' => $this->logo,
            'logo_url' => $this->logourl,
            'is_ring' => $this->is_ring,
            'is_vibrate' => $this->is_vibrate,
            'is_clearable' => $this->is_clearable,
        ];
    }

    /**
     * 获取背景图片通知样式实体
     *
     * @return array
     */
    private function getBannerEntity()
    {
        $this->type = 4;
        return [
            'type' => $this->type,
            'logo' => $this->logo,
            'banner_url' => $this->banner_url,
            'is_ring' => $this->is_ring,
            'is_vibrate' => $this->is_vibrate,
            'is_clearable' => $this->is_clearable,
        ];
    }

    /**
     * 获取展开通知样式实体
     *
     * @return array
     */
    private function getExpandEntity()
    {
        $this->type = 6;
        $res = [
            'type' => $this->type,
            'title' => $this->title,
            'text' => $this->text,
            'logo' => $this->logo,
            'logo_url' => $this->logourl,
            'big_style' => $this->big_style,
            'is_ring' => $this->is_ring,
            'is_vibrate' => $this->is_vibrate,
            'is_clearable' => $this->is_clearable,
        ];
        if ($this->big_style == 1) {
            $res['big_image_url'] = $this->big_image_url;
        } elseif ($this->big_style == 2) {
            $res['big_text'] = $this->big_text;
        } elseif ($this->big_style == 3) {
            $res['big_image_url'] = $this->big_image_url;
            $res['banner_url'] = $this->banner_url;
        }
        return $res;
    }

}