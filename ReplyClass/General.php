<?php

use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;

// 一般聊天回應

class General{

    //總共50張迷因
    private $memeImgTotal = 50; 

    //機器人資訊
    private $botName = "愛供偎&#128588;";
    private $botAge = "年齡是秘密&#129323;";
    private $botGender = "我也不清楚&#129300;";
    private $botHeight = "10cm&#128546;";
    private $botWeight = "999kg&#129322;";
	

	//日期回應
	public function Date($bot, $day, $wd) {
		$weekarray = array("星期日","星期一","星期二","星期三","星期四","星期五","星期六");
        date_default_timezone_set("Asia/Taipei");
        $index = date('w');
        $arr = array("前天","昨天","今天","明天","後天");
        $date = date("Y/m/d");
        
        if(in_array($day, $arr)){
            if($day == '前天'){
                $index = ($index-2)+7;
                $date = date("Y/m/d", strtotime("-2 day"));
            } 
            if($day == '昨天'){ 
                $index = ($index-1)+7;
                $date = date("Y/m/d", strtotime("-1 day"));
            }
            if($day == '明天') {
                $index += 1;
                $date = date("Y/m/d", strtotime("+1 day"));
            }
            if($day == '後天') {
                $index += 2;
                $date = date("Y/m/d", strtotime("+2 day"));
            }

            //回覆
            if($wd == '星期') $bot->reply($day.'是'.$weekarray[($index)%7]."&#128515;");
            if($wd == '是'|$wd == '日期') $bot->reply($day."是 ".$date.$weekarray[($index)%7]."&#128515;");
        }

        //問太多天會生氣
        else $bot->reply('不要問那麼多天&#128545');
    }

    //打招呼回應
	public function Hello($bot, $str) {
        $str = ucfirst($str);
        $bot->reply($str.$str.'&#128516;&#128588;');
    }

    //機器人資訊
	public function RobotInfo($bot) {
        $reply = sprintf("我是 %s<br>年齡：%s<br>性別：%s<br>身高：%s<br>體重：%s",
        $this->botName, $this->botAge, $this->botGender, $this->botHeight, $this->botWeight);
        $bot->reply($reply);
    }

    //回傳 迷因圖片
    public function Meme($bot){
        // 需要將FilePath轉換成URL
        $random = rand(1,$this->memeImgTotal); //隨機選擇回傳圖片
        $path = sprintf('http://localhost/Demo/ReplyClass/Meme/img%d.jpg', $random);
        $attachment = new Image($path, [
            'custom_payload' => true,
        ]);
        $message = OutgoingMessage::create('')
                    ->withAttachment($attachment);

        // 回覆圖片
        $bot->reply($message);
    }

    // 隨機選擇笑話
    public function RandomJoke($bot) {
		$data = file_get_contents('http://localhost/Demo/ReplyClass/Joke.txt');
		$arr = explode(PHP_EOL, $data);
		$index = rand(0,sizeof($arr)-1);
        $bot->reply($arr[$index]);
    }
	
	

}

?>