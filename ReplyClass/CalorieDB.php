<?php

class CalorieDB{
	
	//查找資料庫
	public function FindDB($bot, $str) {

        //連接資料庫
        $host = 'localhost';  //host
        $dbuser ='team06';  //帳號
        $dbpassword = 'team06'; //密碼
        $dbname = 'team06'; //資料庫名稱
        $link = mysqli_connect($host,$dbuser,$dbpassword,$dbname);


        if(!$link) $bot->reply("熱量資料庫連接錯誤");
        else {
            // $bot->reply("資料庫OK");
            //判斷使用者打的string
            // 匹配 查詢熱量|熱量查詢
            if(preg_match("(.*查詢.*)", $str)){
                $bot->reply("請輸入要查詢的資料&#128269;<br>(ex:玉米的熱量 or 玉米熱量&#127805;)");
            }
            //匹配 含有熱量關鍵字
            else{
                $str = str_replace(['的','熱量','//s*/'],"",$str); //將"的","熱量",空格去掉
                $sql = "SELECT 樣品名稱,俗名,每100克含量,食品分類 FROM caloriedb";
                mysqli_query($link, 'SET NAMES utf8');  //送出UTF8編碼的MySQL指令
                $result = mysqli_query($link, $sql);

                $tmparr = array();
                while($row = mysqli_fetch_row($result)){
                    $arr = explode(",", $row[1]);
                    array_unshift($arr, $row[0]);

                    $tmparr = array_merge(preg_grep("/$str/", $arr),$tmparr);

                    if(in_array($str,$arr)){
                        $reply = $row[2];
                        $catogory = $row[3];
                        break;
                    }
                }
                //若找不到熱量，則提示關鍵字
                if(!isset($reply)){
                    $reply = "找不到此項資料&#128534;";
                    if(sizeof($tmparr)!=0) $reply = $reply."<br>試試看這些關鍵字&#128269;<br><br>";
                    else $reply = $reply."<br>我們會努力優化資料庫的&#128170;!!";
                    for($i=0;$i<sizeof($tmparr);$i++){
                        $reply = $reply.$tmparr[$i];
                        if($i<sizeof($tmparr)-1)
                        $reply = $reply."<br>";
                    }
                
                }
                //找到則輸出結果及該食物分類
                else{
                    $reply = "100克".$str."的熱量為".$reply."大卡<br>分類為「".$catogory."」喔&#128521;";
                }

                $bot->reply($reply);
                
                
                mysqli_close($link); //關閉資料庫
            }
            
           
        }
    }
	

}

?>