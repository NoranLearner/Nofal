<?php

namespace App\Http\Controllers\Api;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProductRequest;

class ProductController extends Controller
{

    public function addProduct(ProductRequest $request){

        $product = Product::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'price' => $request->price,
            'amount' => $request->amount,
            'expiration' => $request->expiration,
            'cat_id' => $request->cat_id,
        ]);

        //***** Start Upload Image *****//

        $files = $request->file("image");

        $img_db=[];

        foreach ($files as $file) {


            $imageName = Str::random(20).time().'.'.$file->getClientOriginalExtension();

            $file->move(\public_path("productImg/"),$imageName);

            $img_db[]=[
                "product_id" =>$product->id,
                "image" =>$imageName,
            ];

        }

        Image::insert($img_db);


        //***** End Upload Image *****//

        if ($product) {

            return response()->json([
                'message' => 'Product Save Successfully',
                'Product' => $product,
                // 'Image' => $img_db,
            ], 201);

        }

    }

}
