<?php
/**
 * Created by PhpStorm.
 * User: wujie
 * Date: 2018/11/26
 * Time: 18:06
 */

require __DIR__."/../vendor/autoload.php";

$configArray = [
    "app_key" => "1",
    "app_id" => "2",
    "master_secret" => "3",
    "logo_url" => "http://dev.img.ybzg.com/static/app/user/getui_logo.png"
];
$configArray = require __DIR__."/config.php";
$config = new \getui\config\Config($configArray);
$config->setHttpModelConfig(new \getui\http\GuHttp());
//用户状态
//$user = \getui\httpRequest\user\User::make($config)->userStatus("1f118061aef2af0aaca1617a6d48d2d7")->request();

//单日用户数据接口
//$user = \getui\httpRequest\user\User::make($config)->appUser(time())->request();
//$user = \getui\httpRequest\user\User::make($config)->appPush(time())->request();

//设置标签
//$user = \getui\httpRequest\user\User::make($config)->userAddTag("1f118061aef2af0aaca1617a6d48d2d7" , ["ceshi" , "wujie"])->request();

//查询用户标签
$user = \getui\httpRequest\user\User::make($config)->userTag("1f118061aef2af0aaca1617a6d48d2d7")->request();
var_dump($user->getRequestResult());
exit();

//获取授权码
//$auth = new \getui\httpRequest\AuthToken($config);
//echo $auth->getAuthToken() . "\n";
//echo $auth->delAuthToken();
//echo $auth->getAuthToken();
//exit();

//$push = new \getui\httpRequest\push\PushSign($config);
//$push->setMsgtype(\getui\template\Message::MSG_TYPE_LINK)
//    ->setTitle("1")
//    ->setText("22")
//    ->setTransmission("https://www.baidu.com")
//    ->setCid("1f118061aef2af0aaca1617a6d48d2d7")
//    ->request();
//var_dump($push->getHttpModel()->getResultDataBody());

//$push->setMsgtype(\getui\template\Message::MSG_TYPE_TRANSMISSION)
//    ->setTitle("1")
//    ->setText("22")
//    ->setTransmission("https://www.baidu.com")
//    ->setCid("1f118061aef2af0aaca1617a6d48d2d7")
//    ->request();
//var_dump($push->getHttpModel()->getResultDataBody());


//批量推送
$push = new \getui\httpRequest\push\PushList($config);
//$condition = new \getui\httpRequest\push\appCondition\AppConditions();
//$condition->addCondition(\getui\httpRequest\push\appCondition\AppConditions::PHONE_TYPE, ["ANDROID"]);
$push->setMsgtype(\getui\template\Message::MSG_TYPE_NOTIFICATION)
    ->setTitle("1")
    ->setText("22")
    ->setTransmission("https://www.baidu.com")
    ->pushListSend(["1f118061aef2af0aaca1617a6d48d2d7"])
    ->request(0 , 5);// request(1) 失败重试一次 request(1 ， 1) 失败重试一次  超时时间 1秒
var_dump($push->getHttpModel()->getResultDataBody());