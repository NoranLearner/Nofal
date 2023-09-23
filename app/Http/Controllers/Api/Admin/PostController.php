<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Post;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Events\NewNotification;
use App\Http\Helper\HelperFile;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;


class PostController extends Controller
{

    use GeneralTrait;

    public function index(Request $request){

        $token = $request->header('auth-token');

        if ($token) {

            try {

                $posts = PostResource::collection(Post::select(
                    'id',
                    'title_' . app()->getLocale() . ' as title',
                    'description_' . app()->getLocale() . ' as description',
                    'image',
                    'status')->get());

            } catch (TokenExpiredException $e) {

                return $this->returnError('401', 'Unauthenticated');

            } catch (JWTException $e) {

                return $this->returnError('', 'token_invalid, ' . $e->getMessage());

            }

            return $this->returnData('posts', $posts, 'Get Data Successfully');

        }

    }

    public function postDetails(Request $request){

        $token = $request->header('auth-token');

        if ($token) {

            try {

                $post = Post::select(
                    'id',
                    'title_' . app()->getLocale() . ' as title',
                    'description_' . app()->getLocale() . ' as description',
                    'image',
                    'status')->find($request->id);

                if($post){
                    return $this->returnData('post',  new PostResource($post), 'This is Post Details');
                } else{
                    return $this->returnError('404', 'Post Not Found');
                }

            } catch (TokenExpiredException $e) {

                return $this->returnError('401', 'Unauthenticated');

            } catch (JWTException $e) {

                return $this->returnError('', 'token_invalid, ' . $e->getMessage());

            }
        }

    }

    public function create(Request $request)
    {

        $token = $request->header('auth-token');

        if ($token) {

            try {

                $validator = validator::make($request->all(), [
                    // 'id'=>'required|max:11',
                    'title_en'=>'required|min:5|max:255',
                    'title_ar'=>'required|min:5|max:255',
                    'description_en'=>'required|min:10|max:255',
                    'description_ar'=>'required|min:10|max:255',
                    'image'=>'required|image|mimes:png,jpeg,jpg,gif|max:2048',
                    'status'=> 'required|boolean',
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
                    'status'=>$request->status,
                ]);

                if ($post) {

                    return $this->returnSuccessMessage('Post Save Successfully');

                } else {

                    return $this->returnError('400', 'Post Not Save');

                }

            } catch (TokenExpiredException $e) {

                return $this->returnError('401', 'Unauthenticated');

            } catch (JWTException $e) {

                return $this->returnError('', 'token_invalid, ' . $e->getMessage());

            }

        }


    }

    public function destroy(Request $request){

        $token = $request->header('auth-token');

        if ($token) {

            try {

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

            } catch (TokenExpiredException $e) {

                return $this->returnError('401', 'Unauthenticated');

            } catch (JWTException $e) {

                return $this->returnError('', 'token_invalid, ' . $e->getMessage());

            }

        }

    }

    public function update(Request $request){

        $token = $request->header('auth-token');

        if ($token) {

            try {

                $validator = validator::make($request->all(), [
                    // 'id'=>'required|max:11',
                    'title_en'=>'required|min:5|max:255',
                    'title_ar'=>'required|min:5|max:255',
                    'description_en'=>'required|min:10|max:255',
                    'description_ar'=>'required|min:10|max:255',
                    'image'=>'required|image|mimes:png,jpeg,jpg,gif|max:2048',
                    'status'=> 'required|boolean',
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
                    'status'=>$request->status,
                ]);

                $post_title = Post::select('title_' . app()->getLocale() . ' as title')->find($id);

                $data=[
                    'id' => $request->id,
                    'post_title' => $post_title->title,
                    'status'=>$request->status,
                ];

                event(new NewNotification($data));


                if ($post) {
                    return $this->returnSuccessMessage('Post Updated Successfully');
                }

            } catch (TokenExpiredException $e) {

                return $this->returnError('401', 'Unauthenticated');

            } catch (JWTException $e) {

                return $this->returnError('', 'token_invalid, ' . $e->getMessage());

            }

        }


    }

    public function changePostStatus(Request $request){

        $token = $request->header('auth-token');

        if ($token) {

            try {

                $validator = validator::make($request->all(), [
                    // 'id'=>'required|max:11',
                    'status'=> 'required|boolean',
                ]);

                if ($validator->fails()) {
                    return $this->returnError('400', $validator->errors());
                }

                $id = $request->id;

                $post = Post::find($id);

                if (!$post) {
                    return $this->returnError('404', 'post not found');
                }

                $post_title = Post::select('title_' . app()->getLocale() . ' as title')->find($id);

                // return $post_title;

                // dd($post_title);

                $post->update([
                    'status'=>$request->status,
                ]);

                $data=[
                    'id' => $request->id,
                    'post_title' => $post_title->title,
                    'status'=>$request->status,
                ];

                event(new NewNotification($data));


                if ($post) {
                    return $this->returnSuccessMessage('Post Status Changed Successfully');
                }

            } catch (TokenExpiredException $e) {

                return $this->returnError('401', 'Unauthenticated');

            } catch (JWTException $e) {

                return $this->returnError('', 'token_invalid, ' . $e->getMessage());

            }

        }

    }

}
