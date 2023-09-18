<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $posts=Post::all();

        $posts=Post::orderBy('author', 'ASC')->paginate(env('PAGINATION_COUNT'));

        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {

        if ($request->hasFile("cover")) {

            $file = $request->file("cover");

            $imageName = Str::random(20).time().'.'.$file->getClientOriginalExtension();

            $file->move(\public_path("cover/"),$imageName);

            $post = Post::create([
                "title" =>$request->title,
                "author" =>$request->author,
                "body" =>$request->body,
                "cover" =>$imageName,
            ]);

        }

        if ($request->hasFile("images")) {

            $files = $request->file("images");

            foreach ($files as $file) {

                $imageName = Str::random(20).time().'.'.$file->getClientOriginalExtension();

                $file->move(\public_path("images/"),$imageName);

                Image::create([
                    "post_id" =>$post->id,
                    "image" =>$imageName,
                ]);

            }

        }

        return redirect()->route('posts.index')->with('success','Post created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, $id)
    {

        $post = Post::findOrFail($id);

        if ($request->hasFile("cover")) {

            if (File::exists("cover/".$post->cover)) {
                File::delete("cover/".$post->cover);
            }

            $file = $request->file("cover");

            $post->cover = Str::random(20) . time() . '.' . $file->getClientOriginalExtension();

            $file->move(\public_path("cover/"),$post->cover);

        }

        $post->update([
            "title" =>$request->title,
            "author"=>$request->author,
            "body"=>$request->body,
            "cover"=>$post->cover,
        ]);

        if ($request->hasFile("images")) {

            $files = $request->file("images");

            foreach($files as $file){

                $imageName = Str::random(20) . time() . '.' . $file->getClientOriginalExtension();

                $file->move(\public_path("images/"),$imageName);

                Image::create([
                    "post_id" => $id,
                    "image" => $imageName,
                ]);

            }

        }

        return redirect()->route('posts.index')->with('success','Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post=Post::findOrFail($id);

        if (File::exists("cover/".$post->cover)) {
            File::delete("cover/".$post->cover);
        }

        $images=Image::where("post_id",$post->id)->get();

        foreach ($images as $image) {

            if (File::exists("images/".$image->image)) {
                File::delete("images/".$image->image);
            }

        }

        $post->delete();

        return redirect()->route('posts.index')->with('success','Post deleted successfully');
    }

    public function imageDelete($id)
    {

        $images = Image::findOrFail($id);

        if (File::exists("images/" . $images->image)) {
            File::delete("images/" . $images->image);
        }

        Image::find($id)->delete();

        return back();

    }

    public function coverDelete($id)
    {

        $cover = Post::findOrFail($id)->cover;

        if (File::exists("cover/" . $cover)) {
            File::delete("cover/" . $cover);
        }

        return back();

    }

    public function deleteSelect(Request $request){

        request()->validate([
            'idp'=>'required',
            'idp.*'=>'required|integer|exists:posts,id',
        ]);

        $idp = $request->idp;

        $coverImages = Post::whereIn('id', $idp)->get()->pluck('cover')->toArray();

        foreach ($coverImages as $coverImg) {

            if (File::exists("cover/" . $coverImg)) {
                File::delete("cover/" . $coverImg);
            }

        }

        $images = Image::whereIn('post_id', $idp)->get()->pluck('image')->toArray();

        foreach ($images as $image) {

            if (File::exists("images/".$image)) {
                File::delete("images/".$image);
            }

        }

        $post = Post::whereIn('id', $idp);

        $post->delete();

        return response()->json(["success"=>"Selected Post have been Deleted"]);

    }

}
