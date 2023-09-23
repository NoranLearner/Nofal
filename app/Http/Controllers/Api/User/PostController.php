<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Helper\HelperFile;
use App\Models\Post;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

    use GeneralTrait;

    public function index()
    {

        $posts = PostResource::collection(Post::select(
            'id',
            'title_' . app()->getLocale() . ' as title',
            'description_' . app()->getLocale() . ' as description',
            'image'
        )->get());

        return $this->returnData('posts', $posts, 'Get Data Successfully');

    }

    public function postDetails(Request $request)
    {

        $post = Post::select(
            'id',
            'title_' . app()->getLocale() . ' as title',
            'description_' . app()->getLocale() . ' as description',
            'image'
        )->find($request->id);

        if ($post) {
            return $this->returnData('post', new PostResource($post), 'This is Post Details');
        } else {
            return $this->returnError('404', 'Post Not Found');
        }
    }

    public function create(Request $request)
    {

        $validator = validator::make($request->all(), [
            // 'id'=>'required|max:11',
            'title_en'=>'required|min:5|max:255',
            'title_ar'=>'required|min:5|max:255',
            'description_en'=>'required|min:10|max:255',
            'description_ar'=>'required|min:10|max:255',
            'image'=>'required|image|mimes:png,jpeg,jpg,gif|max:2048',
        ]);


        if ($validator->fails()) {
            return $this->returnError('400', $validator->errors());
        }

        $image = HelperFile::upload($request->image , 'posts');

        // $request["image"] = $image["name"];

        $post = Post::create([
            'title_en'=> $request->title_en,
            'title_ar'=>$request->title_ar,
            'description_en'=>$request->description_en,
            'description_ar'=>$request->description_ar,
            'image'=>$image["name"],
        ]);

        // $post = Post::create($request->all());

        if ($post) {

            return $this->returnSuccessMessage('Post Save Successfully');

        } else {

            return $this->returnError('400', 'Post Not Save');

        }

    }

    public function destroy(Request $request){

        $id = $request->id;

        $post = Post::find($id);

        if (!$post) {
            return $this->returnError('404', 'post not found');
        }

        HelperFile::delete($post->image, 'posts');

        $post->delete();

        if ($post) {
            return $this->returnSuccessMessage('Post Deleted Successfully');
        }

    }

    public function update(Request $request){

        $validator = validator::make($request->all(), [
            // 'id'=>'required|max:11',
            'title_en'=>'required|min:5|max:255',
            'title_ar'=>'required|min:5|max:255',
            'description_en'=>'required|min:10|max:255',
            'description_ar'=>'required|min:10|max:255',
            'image'=>'required|image|mimes:png,jpeg,jpg,gif|max:2048',
        ]);


        if ($validator->fails()) {
            return $this->returnError('400', $validator->errors());
        }

        $id = $request->id;

        $post = Post::find($id);

        if (!$post) {
            return $this->returnError('404', 'post not found');
        }

        HelperFile::delete($post->image, 'posts');

        $image = HelperFile::upload($request->image , 'posts');

        $post->update([
            'title_en'=> $request->title_en,
            'title_ar'=>$request->title_ar,
            'description_en'=>$request->description_en,
            'description_ar'=>$request->description_ar,
            'image'=>$image["name"],
        ]);

        if ($post) {
            return $this->returnSuccessMessage('Post Updated Successfully');
        }

    }

}
