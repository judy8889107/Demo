<?php

require_once 'vendor/autoload.php';

//引入ReplyClass底下所有php
foreach (glob("ReplyClass/*") as $filename) {
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

$botman->hears('.*你好.*', function (BotMan $bot) {
    $bot->reply('你好啊');
});

$botman->hears('(今天|明天|後天|.*).*星期.*(?!天氣)', function (BotMan $bot, $day) {
	$weekarray = array("星期日","星期一","星期二","星期三","星期四","星期五","星期六");
	$index = date('w');
	
	
	if($day == '明天'|$day == '後天'){
		if($day == '明天') $index += 1;
		if($day == '後天') $index += 2;
		$bot->reply($day.'是'.$weekarray[($index)%7]);
	}
	else $bot->reply('不要問那麼多&#128545');
	
	
	
    
});

//ReplyClass
$botman->hears('.*說?講?笑話.*', 'Joke@RandomJoke'); //可以引用外部的(class@functionName)

//caloriedb匹配




// Start listening
$botman->listen();




