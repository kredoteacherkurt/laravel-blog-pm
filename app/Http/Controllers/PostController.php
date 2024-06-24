<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class PostController extends Controller
{
    const LOCAL_STORAGE_FOLDER = 'public/images/';
    private $post;
    public function __construct(Post $post){
        $this->post = $post;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $all_posts = $this->post->latest()->get();

        return view('posts.index')
                ->with('all_posts', $all_posts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->post->title = $request->title;
        $this->post->body = $request->body;
        $this->post->image = $this->saveImage($request);
        $this->post->user_id = Auth::id();
        $this->post->save();

        return redirect()->route('index');
    }
    public function saveImage($request){
        // rename the  file
        $image_name = time().".".$request->image->extension();
        #1718958733.jpeg
        // where to upload the file
        $request->image->storeAs(self::LOCAL_STORAGE_FOLDER, $image_name);

        return $image_name;
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //

        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //

        $post->title = $request->title;
        $post->body = $request->body;
        if($request->image){
            $this->deleteImage($post);
            $post->image = $this->saveImage($request);
        }
        $post->save();

        return redirect()->route('index');
    }
    public function deleteImage($post){
        $image_path = self::LOCAL_STORAGE_FOLDER.$post->image;

        if(Storage::exists($image_path)){
            Storage::delete($image_path);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
        $post->delete();

        return redirect()->route('index');
    }
}
