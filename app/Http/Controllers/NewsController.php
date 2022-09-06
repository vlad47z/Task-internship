<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Size;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableObserver;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;
use Redirect;
use App\Http\Controllers\ResizeController;
use Symfony\Component\Console\Input\Input;
use function GuzzleHttp\Promise\all;
use Illuminate\Support\Carbon;

class NewsController extends Controller 
{
    public function __construct() {
        $this->middleware('auth', ['except'=>'index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $posts = Post::orderBy('created_at', 'desc')->paginate(6);
        
        return view('news.index', compact('posts'));

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {

        return view('news.create');
    }

    /**
     * Store a newly created resource inRead or create some news
     */
  
    public function store(Request $request) {

        $this->validate($request, [
            'title' => 'required|max:100|min:10',
            'body' => 'required|max:50000|min:500',
            'seo_title' => 'required|max:150|min:10',
            'metabody' => 'required|max:300|min:20',
            'filepath' => 'required',
        ]);
        $input = $request->all();
        $insert = [
            'slug' => SlugService::createSlug(Post::class, 'slug', $request->seo_title),
            'title' => $request->input('title'),
            'meta_description' => $request->input('metabody'),
            'user_id' => Auth::id(),
            'seo_title' => $request->input('seo_title'),
            'body' => $request->input('body'),
            // 'cover_image' => trim($request->input('filepath'), env('APP_URL')),
            'cover_image' => $request->input('filepath'),
            'created_at' => now(),
            'thumbnail' => str_replace("http://a911-217-26-164-216.eu.ngrok.io/storage/photos/4/", " ", $request->input('filepath')),
        ];
        Post::insertGetId($insert);
        
        // $post = new Post();
        // $post->user_id = Auth::id();
        // $post->title = $request->input('title');
        // $post->seo_title = $request->input('seo_title');
        // $post->slug = Str::slug($request->seo_title);
        // $post->body = $request->input('body');
        // $post->meta_description = $request->input('metabody');
        // $post->cover_image = trim($request->input('filepath'), env('APP_URL'));
        // $post->save();       
        return redirect('/news')->with('success', 'Your article was succesfully created!');
    }
//  

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$slug) {
        $post=Post::all();
        $post = Post::where('slug',$slug)->get();    
        $posts = Post::orderBy('created_at', 'desc')->limit('5')->get();

        // $size=Size::where('id', 1)->first();
        // $posts->load($post[0]->cover_image);
        // $posts->resizeToWidth($size[0]->width_single);
        // $posts->resizeToHeight($size[0]->height_single);
        // $posts->save(public_path('uploads/resized_' . $post[0]->cover_image));

        return view ('news.show', compact('post', 'posts'));
    }

     // public function show($id)
    // {
    //     $post = Post::find($id);
    //     return view('news.show')->with('post', $post);
    //     $posts 
    // }

    /**
    
    * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug) {
        $post = Post::where('slug', $slug)->first();
        if(auth()->check() && auth()->user()->is_admin != 1) {
            return redirect('/news')->with('error', '(!) Error. You are not the administrator or the author of that article.');
        } else
        return view ('news.editmode')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $this->validate($request, [
            'title' => 'required|max:100|min:10',
            'body' => 'required|max:50000|min:100',
            'seo_title' => 'required|max:150|min:10',
            'metabody' => 'required|max:300|min:20',
        ]);
        
        $input = $request->all();
        $post = Post::find($slug);
       
        $post->title = $request -> input('title');
        $post->slug = SlugService::createSlug(Post::class, 'slug', $request->seo_title);
        $post->meta_description = $request->input('metabody');
        $post->cover_image = $request->input('filepath');
        $post->body = $request->input('body');
        $post->seo_title = $request->input('seo_title');
        $post->updated_at = now();
        $post->thumbnail = str_replace("http://127.0.0.1:8000/storage/photos/4/", "", $request->input('filepath'));
        // $post->thumbnail = basename($post->cover_image, ".php");
        $post -> save();
        
        return redirect('/news')->with('success', 'Article was succesfully modified!');
    }
    

    /**
     * Remove the specified resource from storage.
     * @param  \Illuminate\Http\Request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $post = Post::where('slug', $slug)->first();
        if(auth()->check() && auth()->user()->is_admin != 1) {
            return redirect('/news')->with('error', 'Neautorizat!');
        }
        $post -> delete();
        return redirect('/news')->with('success', 'The article was succesfully deleted!');
    }
    // Commit
    
}
