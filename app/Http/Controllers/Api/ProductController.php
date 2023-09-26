<?php

namespace App\Http\Controllers\Api;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Api\ProductRequest;
use Illuminate\Support\Facades\Validator;
// use App\Http\Requests\Api\ProductUpdateRequest;

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

        foreach ($files as $file) {

            $imageName = Str::random(20).time().'.'.$file->getClientOriginalExtension();

            $file->move(\public_path("productImg/"),$imageName);

            $image = Image::create([
                "product_id" =>$product->id,
                "image" =>$imageName,
            ]);

        }

        //***** End Upload Image *****//

        if ($product) {

            return response()->json([
                'message' => 'Product Save Successfully',
                'Product' => $product,
                // 'Image' => $image,
            ], 201);

        }

    }

    // ProductUpdateRequest
    public function updateProduct(Request $request){

        $id = $request->id;

        $product = Product::with('images')->findOrFail($id);
        // $product_images =  $product->images;
        $product_images =  $product->images->pluck('image')->toarray();
        // return $product_images;

        $validator = validator::make($request->all(), [
            'name' => [
                'required',
                Rule::unique('products')->ignore($product->id, 'id'),
            ],
            'slug' => [
                Rule::unique('products')->ignore($product->slug, 'slug'),
            ],
            'price' => 'numeric|gt:0',
            'image.*' => 'image|mimes:png,jpeg,jpg,gif|max:2048',
            'amount' => 'numeric',
            'expiration' => 'in:valid,expire',
            'cat_id' => 'exists:categories,id',
        ]);

        if ($validator->fails()) {
            return $this->returnError('400', $validator->errors());
        }

        if (!$product) {
            return response()->json([
                'message' => 'Product Not Found',
            ], 404);
        }

        $product->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'price' => $request->price,
            'amount' => $request->amount,
            'expiration' => $request->expiration,
            'cat_id' => $request->cat_id,
        ]);

        //***** Start Delete Old Image *****//

        foreach ($product_images as $value) {

            // Delete Images From File
            if (File::exists("productImg/".$value)) {
                File::delete("productImg/".$value);
            }

            // Delete Images From Database
            Image::where('product_id', $id)->delete();

        }

        //***** End Delete Old Image *****//

        //***** Start Upload New Image *****//

        $files = $request->file('image');

        // dd($files);

        foreach ($files as $file) {

            $imageName = Str::random(20).time().'.'.$file->getClientOriginalExtension();

            $file->move(\public_path("productImg/"),$imageName);

            Image::create([
                "product_id" =>$product->id,
                "image" =>$imageName,
            ]);

        }

        //***** End Upload New Image *****//

        if ($product) {
            return response()->json([
                'message' => 'Product Updated Successfully',
                'Product' => $product,
            ], 200);
        }

    }

    public function delExpProduct(){

        $expire_product = Product::where('expiration', '=', 'expire')->with('images')->get();
        // return $expire_product;

        $expire_product_id = $expire_product->pluck('id');
        // return $expire_product_id;

        $expire_product_images = Image::where('product_id', '=', $expire_product_id)->get();
        // return $expire_product_images;

        $images_array= $expire_product_images->pluck('image');
        // return $images_array;


        if (!$expire_product) {
            return response()->json([
                'message' => 'There are no expired products',
            ], 404);
        }

        //***** Start Delete Old Image *****//

        foreach ($images_array as $value) {

            // Delete Expire Product Images From File
            if (File::exists("productImg/".$value)) {
                File::delete("productImg/".$value);
            }

            // Delete Expire Product Images From Database
            Image::where('product_id', $expire_product_id)->delete();

        }

        //***** End Delete Old Image *****//

        // ***** Delete Expire Product *****//

        $expire_product_delete = Product::where('expiration', '=', 'expire')->delete();

        if ($expire_product_delete) {
            return response()->json([
                'message' => 'Post Deleted Successfully',
            ], 200);
        }

    }

    public function highPrice(Request $request){

        $cat_id = $request->cat_id;

        $validator = validator::make($request->all(), [
            'cat_id' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return $this->returnError('400', $validator->errors());
        }

        $specific_product = Product::where('cat_id', '=', $cat_id)->with('images')->orderBy('price', 'DESC')->limit(5)->get();

        // return $specific_product;

        if ($specific_product) {
            return response()->json([
                'message' => 'Get Data Successfully',
                'Product' => $specific_product,
            ], 200);
        }

    }


}
