<?php

namespace App\Http\Helper;


use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class HelperFile
{
    public static function uploadMulti($files,$type){
        $names=[];
        foreach($files as $file){
            $extension= $file->getClientOriginalExtension();
            $fileName=self::randText().".".$extension;
            $file->move(self::folderSave().$type, $fileName);
            $names[]=['name'=>$fileName];

        }
        return $names;
    }


    public static function upload($file,$type){
        $extension= $file->getClientOriginalExtension();
        $fileName=self::randText().".".$extension;
        $file->move(self::folderSave().$type, $fileName);
        return  ['name'=>$fileName];
    }


    public static function deleteMultiFiles($files,$type){
        foreach($files as $file){

            if(File::exists('uploads/'.$type.$file->name)){
                unlink('uploads/'.$type.$file->name);
            }
        }

    }

    public static function delete($fileName,$type){
        if(File::exists('uploads/'.$type."/".$fileName)){
            unlink('uploads/'.$type."/".$fileName);
        }
    }



    private static function randText(){
        return Str::random(20).time();
    }


    private static function folderSave(){
        return  public_path('uploads/');
    }
}

