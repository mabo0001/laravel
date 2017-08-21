<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/25
 * Time: 18:56
 */

//读取高精度磁测数据(文件头)
if (! function_exists('maghead')) {
    function maghead($line){

        if(starts_with($line,'/ID')){


            $rome = array("Ⅰ"=>"1", "Ⅱ"=>"2", "Ⅲ"=>"3", "Ⅳ"=>"4", "V"=>"05",
                "VI"=>"06", "VII"=>"07", "VIII"=>"08", "Ⅸ"=>"09", "Ⅹ"=>"10",
                "Ⅺ"=>"11", "Ⅻ"=>"12");
            //$header = [];
            $header['serial'] = trim(mb_substr($line, 3, 3));//仪器型号
            #dd(mb_substr($line,6));
            $line1 = trim(mb_substr($line,6));
            #dd($line1);
            #dd(trim(mb_substr($line,6)));
            #dd(trim(mb_substr($line1,20,4)));

            $header['date'] = (string)"20" .mb_substr($line1,24,2). "-"
                .$rome[trim(mb_substr($line1,20,4))]. "-"
                .mb_substr($line1,18,2);

            return $header;

        }
        return null;
    };
}


//读取高精度磁测数据(过滤器)
if (! function_exists('magfilter')) {
    function magfilter($line){
        return (starts_with($line,'/') | mb_strlen($line)<5);
    };
}

//读取高精度磁测数据(mobile数据)
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

//读取高精度磁测数据(base数据)
if(! function_exists('basemageach')){
    function basemageach($line){
        $time = (string)mb_substr($line,0,2). ":".mb_substr($line,2,2).":".mb_substr($line,4,2);
        $basevalue = (float)mb_substr($line,9,10);;
        $ext = (integer)mb_substr($line,19,2);;
        $line = ['time' => $time, 'basevalue'=>$basevalue, 'ext'=>$ext];
        return $line;
    }
}

//读取高精度磁测数据(给数据加时间戳)
if(! function_exists('addtimestamp')){
    function addtimestamp(){
        $timestamp = ['created_at' => \Carbon\Carbon::now()->toDateTimeString(),'updated_at' => \Carbon\Carbon::now()->toDateTimeString()];
        return $timestamp;
    }

}

//读取原始测量数据(头文件)
if (! function_exists('cordhead')) {
    function cordhead($line){

        return null;
    };
}

//读取原始测量数据(过滤器)
if (! function_exists('cordfilter')) {
    function cordfilter($line){
        return !str_contains($line, '/') | mb_strlen($line)<5;
    };
}

//读取原始测量数据(cord数据)
if (! function_exists('cordeach')) {
    function cordeach($line){
        $b= explode(",", $line);
        $b1 = explode('/', $b['0']);


        return ['line'=>$b1[1], 'station'=>$b1[0], 'actual_x'=>$b[2], 'actual_y'=>$b[3], 'actual_z'=>trim($b[4])];
    };
}








//文件上传
/**
 * 返回可读性更好的文件尺寸
 */
function human_filesize($bytes, $decimals = 2)
{
    $size = ['B', 'kB', 'MB', 'GB', 'TB', 'PB'];
    $factor = floor((strlen($bytes) - 1) / 3);

    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) .@$size[$factor];
}

/**
 * 判断文件的MIME类型是否为图片
 */
function is_image($mimeType)
{
    return starts_with($mimeType, 'image/');
}