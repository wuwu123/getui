<?php
/**
 * Created by PhpStorm.
 * User: wujie
 * Date: 2018/11/28
 * Time: 19:02
 */

namespace getui\src\httpRequest\push\appCondition;


class AppConditions
{
    //手机类型
    const PHONE_TYPE = "phonetype";
    //地区
    const REGION = "region";
    //自定义tag
    const TAG = "tag";

    const _OR_ = 0;
    const _AND_ = 1;
    const _NOT_ = 2;

    //条件
    private $condition = [];

    public function addCondition($key, array $values, $optType = self::_OR_)
    {
        $item = array();
        $item["key"] = $key;
        $item["values"] = $values;
        $item["opt_type"] = $optType;
        $this->condition[] = $item;
        return $this;
    }

    public function getCondition()
    {
        return $this->condition;
    }
}