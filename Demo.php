<?php

require_once 'vendor/autoload.php';

//引入ReplyClass底下所有php
foreach (glob("ReplyClass/*.php") as $filename) {
  require $filename;
}

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;

$config = [
    'web' => [
    	'matchingData' => [
            'driver' => 'web',
        ],
    ]
];

// Load the driver(s) you want to use
DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);

// Create an instance
$botman = BotManFactory::create($config);


//支持正則表達

//一般正常聊天匹配 
/* 	

.：任意匹配字元
*：0到多次 
?!：不包含整個字串
emoji使用：將emoji轉換成dex即可顯示

*/


//ReplyClass
$botman->hears('.*說?講?笑話.*', 'General@RandomJoke'); //引用外部的(class@functionName)
$botman->hears('(.*熱量.*)', 'CalorieDB@FindDB'); 
$botman->hears('.*(迷因|meme).*', 'General@Meme'); 
$botman->hears('.*(你好|哈瞜|Hello|Hi).*', 'General@Hello'); 
$botman->hears('.*你.*(?=名字|性別|歲|年齡|誰|是|生日).*', 'General@RobotInfo'); 
$botman->hears('(大*前天|昨天|今天|明天|大*後天).*(是|日期|星期).*(?!天氣)', 'General@Date'); 











// Start listening
$botman->listen();





