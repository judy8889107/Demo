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
            $bot->reply("資料庫OK");
            //判斷使用者打的string
            // 匹配 查詢熱量|熱量查詢
            if(preg_match("(.*查詢.*)", $str)){
                $bot->reply("請輸入要查詢的資料(ex:玉米的熱量 or 玉米熱量)");
            }
            //匹配 含有熱量關鍵字
            else{
                $str = str_replace(['的','熱量','//s*/'],"",$str); //將"的","熱量",空格去掉
                $sql = "SELECT `樣品名稱` FROM `caloriedb`";
                mysqli_query($link, 'SET NAMES utf8');  //送出UTF8編碼的MySQL指令
                $result = mysqli_query($link, $sql);

                $row = mysqli_fetch_row($result);
                $arr = mysqli_fetch_array($result, MYSQLI_BOTH);
                $count = sizeof($row);
                $bot->reply("");
                mysqli_close($link);
            }
            
           
        }
    }
	

}

?>