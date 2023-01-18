<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Tag;
use Illuminate\Support\Str;
use APP\Http\Controllers\str_slug;
use GuzzleHttp\Psr7\UploadedFile;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts',Post::all());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories',Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            "title"    => "required",
            "content"  => "required",
            "category_id"=> "required",
            "featured" => "required|image:png,jpg,jpeg",
        ]);
        

        $featured = $request->featured;
        $featured_new_name = time().$featured->getClientOriginalName();
        $featured->move('uploads/posts/',$featured_new_name);


        $post = Post::create([
            "title"    => $request->title,
            "content"  => $request->content,
            "featured" => 'uploads/posts/'.$featured_new_name,
            "category_id"=> $request->category_id,
            "slug"     => $slug = Str::slug($request->title),
            //"slug"    => str_slug($request->title), // my new post => my-new-post
           // "user_id" => Auth::id()
        ]);

        return redirect()->back();
        dd($request->all());
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::find($id);
        return view('posts.edit')->with('posts',$post)->with('categories',Category::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $post = Post::find($id);

        $this->validate($request,[
            "title"    => "required",
            "content"  => "required",
            "category_id"  => "required" 
            
        ]);


        if ( $request->hasFile('featured')  ) {
            $featured = $request->featured;
            $featured_new_name = time().$featured->getClientOriginalName();
            $featured->move('uploads/posts/',$featured_new_name);

            $post->featured = 'uploads/posts/'.$featured_new_name;
    
        }

       // dd($post);
        $post->title =  $request->title;
        $post->content =  $request->content;
        $post->category_id = $request->category_id;
        $post->save();

        
        return redirect()->route('posts');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete($id);
        return redirect()->back();
    }

}
