<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/25
 * Time: 18:56
 */

//读取高精度磁测数据
if (! function_exists('maghead')) {
    function maghead($line){
        if(starts_with($line,'/ID')){

            $rome = array("Ⅰ"=>"1", "Ⅱ"=>"2", "Ⅲ"=>"3", "Ⅳ"=>"4", "V"=>"05",
                "VI"=>"06", "VII"=>"07", "Ⅷ"=>"08", "Ⅸ"=>"09", "Ⅹ"=>"10",
                "Ⅺ"=>"11", "Ⅻ"=>"12");
            //$header = [];
            $header['serial'] = mb_substr($line, 3, 3);//仪器型号
            $header['date'] = (string)"20" .mb_substr($line,30,2). "-"
                .$rome[trim(mb_substr($line,27,3))]. "-"
                .mb_substr($line,24,2);

            return $header;
        }
        return null;
    };
}

if (! function_exists('magfilter')) {
    function magfilter($line){
        return !(starts_with($line,'/') | mb_strlen($line)<5);
    };
}

if (! function_exists('mageach')) {
    function mageach($line){
        $line=trim($line);

        $line_= (integer)mb_substr($line,0,5);
        $station =(integer)mb_substr($line,10,5);
        $magvalue = (float)mb_substr($line,18,10);
        $ext = (integer)mb_substr($line,29,2);
        $time = (string)mb_substr($line,43,2). ":".mb_substr($line,45,2).":".mb_substr($line,47,2);
        $line = ['line'=>$line_, 'station'=>$station, 'magvalue'=>$magvalue, 'ext'=>$ext, 'time'=>$time];
        return $line;
    };
}

if(! function_exists('addtimestamp')){

    function addtimestamp(){
        $timestamp = ['created_at' => \Carbon\Carbon::now()->toDateTimeString(),'updated_at' => \Carbon\Carbon::now()->toDateTimeString()];
        return $timestamp;
    }

}

