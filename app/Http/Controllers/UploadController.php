<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\FileParser;

class UploadController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $fileParser;
    public function __construct()
    {
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->isMethod('post')){
            $file = $request->file('picture');
            //文件是否上传成功
            //获取文件相关信息
            $originalName = $file->getClientOriginalName(); // 文件原名
            $ext = $file->getClientOriginalExtension();     // 扩展名
            $realPath = $file->getRealPath();   //临时文件的绝对路径
            $type = $file->getClientMimeType();     // image/jpeg
            // 上传文件
            //$filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
            $filename = $originalName;
            // 使用我们新建的uploads本地存储空间（目录）
            $bool = Storage::disk('local')->put($filename, file_get_contents($realPath));
            $fileParser = app('parse');
            $fileParser->setFile(storage_path('app').'/'.$filename, ' ');
            $data =$fileParser->head("maghead")->filter("magfilter")->each("mageach")->parse();
            DB::table("mobile_mags")->insert($data);
        }

        return "OK";
    }

}
