<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait UploadImgTrait{

    public function uploadImg(Request $request, $folderName){

        $image = $request->file('image')->getClientOriginalName();
        $path = $request->file('image')->storeAs($folderName,$image , 'public_only');
        // dd($path);
        return $path;

    }

}

?>
