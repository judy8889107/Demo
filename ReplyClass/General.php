<?php

// 一般聊天回應

class General{
	

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
	public function Hello($bot) {
        $bot->reply('你好啊&#128588;');
    }
	
	

}

?>