<?php
namespace App\Handlers;



use Image;

class ImageUploadHandler
{
//    允许上传的文件后缀
    const ALLOWED_EXT=['png','jpg','gif','jpeg'];

    public function save($file,$folder,$file_prefix,$max_width = false)
    {
//        构建存储的文件夹规则
        $folder_name="upload/images/{$folder}/".date("Ym/d",time());
//        设置文件存储绝对路径'public_path'获取的是public的绝对路径
        $upload_path=public_path().'/'.$folder_name;
//        获取文件后缀名
        $extension=strtolower($file->getClientOriginalExtension()) ?? 'png';
//        拼接文件名
        $filename=$file_prefix.'_'.time().'_'.str_random(10).'.'.$extension;
//        如果上传的不是图片将终止操作
        if(!in_array($extension,self::ALLOWED_EXT)){
            return false;
        }
//        将文件移动到存储目录中
        $file->move($upload_path,$filename);

        // 如果限制了图片宽度，就进行裁剪
        if ($max_width && $extension != 'gif') {

            // 此类中封装的函数，用于裁剪图片
            $this->reduceSize($upload_path . '/' . $filename, $max_width);
        }
        return [
            'path'=>config('app.url')."/{$folder_name}/{$filename}"
        ];

    }

    /**
     * 裁剪图片大小
     * @param $file_path '文件物理路径'
     * @param $max_width '裁剪大小'
     */
    public function reduceSize($file_path,$max_width)
    {
//        实例化图片处理类
        $image=Image::make($file_path);
//        进行大小调整操作
        $image->resize($max_width,null,function ($content){
            // 设定宽度是 $max_width，高度等比例双方缩放
            $content->aspectRatio();
            // 防止裁图时图片尺寸变大
            $content->upsize();
        });
        $image->save();
    }
}