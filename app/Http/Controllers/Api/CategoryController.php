<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CategoryRequest;
use App\Models\Product;

class CategoryController extends Controller
{

    public function addCategory(CategoryRequest $request)
    {

        //***** Start Upload Image *****//

        $file = $request->file("image");

        $imageName = Str::random(20) . time() . '.' . $file->getClientOriginalExtension();

        $file->move(\public_path("catImg/"), $imageName);

        //***** End Upload Image *****//

        // $category = Category::create($request->all());

        $category = Category::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description,
            'image' => $imageName
        ]);

        if ($category) {

            return response()->json([
                'message' => 'Category Save Successfully',
                'category' => $category,
            ], 201);

        }

    }

    public function mostProductCat(){

        // https://laraveldaily.com/post/eloquent-withcount-get-related-records-amount

        /* $cats = Category::withCount(['products'])->get();

        return $cats; */

        // https://stackoverflow.com/questions/17553181/laravel-4-how-to-order-by-using-eloquent-orm

        $cats = Category::withCount(['products'])->orderBy('products_count', 'DESC')->limit(5)->get();

        // return $cats;

        if (!$cats) {
            return response()->json([
                'message' => 'Category Not Found',
            ], 404);
        }

        if ($cats) {

            return response()->json([
                'message' => 'Get Data Successfully',
                'category' => $cats,
            ], 201);

        }

    }

}
