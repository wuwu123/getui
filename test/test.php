<?php
/**
 * Created by PhpStorm.
 * User: wujie
 * Date: 2018/11/26
 * Time: 18:06
 */

require "../vendor/autoload.php";

$config = new \getui\config\Config([
    "app_key" => "1",
    "app_id" => "2",
    "master_secret" => "3",
    "logo_url" => "http://dev.img.ybzg.com/static/app/user/getui_logo.png"
]);
$push = new \getui\src\httpRequest\push\PushSign($config);
//$push->setMsgtype(\getui\src\template\Message::MSG_TYPE_LINK)
//    ->setTitle("1")
//    ->setText("22")
//    ->setRequestOtherParams("https://www.baidu.com")
//    ->setCid("1f118061aef2af0aaca1617a6d48d2d7")
//    ->request();
//var_dump($push->getHttpModel()->getResultDataBody());

//$push->setMsgtype(\getui\src\template\Message::MSG_TYPE_TRANSMISSION)
//    ->setTitle("1")
//    ->setText("22")
//    ->setTransmission("https://www.baidu.com")
//    ->setCid("1f118061aef2af0aaca1617a6d48d2d7")
//    ->request();
//var_dump($push->getHttpModel()->getResultDataBody());


//批量推送
$push = new \getui\src\httpRequest\push\PushList($config);
$push->setMsgtype(\getui\src\template\Message::MSG_TYPE_NOTIFICATION)
    ->setTitle("1")
    ->setText("22")
    ->setTransmission("https://www.baidu.com")
    ->pushListSend(["1f118061aef2af0aaca1617a6d48d2d7"])
    ->request();
var_dump($push->getHttpModel()->getResultDataBody());