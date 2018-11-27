<?php
/**
 * 常规参数
 * Created by PhpStorm.
 * User: wujie
 * Date: 2018/11/26
 * Time: 17:00
 */

namespace getui\src\httpRequest\push;


use getui\src\template\Style;

trait RequestParams
{
    private $text = "";
    private $title = "";
    private $logourln = "";
    private $duration_begin = "";
    private $duration_end = "";


    /**
     * @param mixed $duration_begin
     * @return $this
     */
    public function setDurationBegin($duration_begin)
    {
        if ($this->duration_begin) {
            $this->duration_begin = $duration_begin;
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
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
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
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
     * @return string
     */
    public function getLogourln(): string
    {
        return $this->logourln;
    }

    /**
     * @param string $logourln
     * @return $this
     */
    public function setLogourln(string $logourln)
    {
        $this->logourln = $logourln;
        return $this;
    }

    /**
     * @return string
     */
    public function getDurationBegin(): string
    {
        return $this->duration_begin;
    }

    /**
     * @return string
     */
    public function getDurationEnd(): string
    {
        return $this->duration_end;
    }


    /**
     * @param mixed $duration_end
     * @return $this
     */
    public function setDurationEnd($duration_end)
    {
        if ($duration_end) {
            $this->duration_end = $duration_end;
        }
        return $this;
    }

    public function getMessageContentCommon()
    {
        $style = new Style();
        $style->setTitle($this->getTitle())->setText($this->getText())->setLogourl($this->config->getLogoUrl());
        $data["style"] = $style->getEntity();
        if ($this->getDurationBegin()) {
            $data["duration_begin"] = $this->getDurationBegin();
        }
        if ($this->getDurationEnd()) {
            $data["duration_end"] = $this->getDurationEnd();
        }
        return $data;
    }
}