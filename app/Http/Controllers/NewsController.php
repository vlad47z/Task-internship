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

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except'=>'index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(6);
        
         
        return view('news.index', compact('posts'));

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('news.create');
    }

    /**
     * Store a newly created resource inRead or create some news
     */
  
    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required|max:100|min:10',
            'body' => 'required|max:50000|min:500',
            'seo_title' => 'required|max:150|min:10',
            'metabody' => 'required|max:300|min:50',
            'filepath' => 'required',
        ]);
        
        $insert = [
            'slug' => SlugService::createSlug(Post::class, 'slug', $request->seo_title),
            'title' => $request->input('title'),
            'meta_description' => $request->input('metabody'),
            'user_id' => Auth::id(),
            'seo_title' => $request->input('seo_title'),
            'body' => $request->input('body'),
            'cover_image' => trim($request->input('filepath'), env('APP_URL')),
            'created_at' => now(),
            // 'thumbnail' => Size::resizeImage($request->cover_image),
        ];
        Post::insertGetId($insert);
        
        // $post = new Post();
        // $post->user_id = Auth::id();
        // $post->title = $request->input('title');
        // $post->seo_title = $request->input('seo_title');
        // $post->slug = Str::slug($request->seo_title);
        // $post->body = $request->input('body');
        // $post->meta_description = $request->input('metabody');
        // $post->cover_image = $image_name;
        // $post->save();       
        return redirect('/news')->with('success', 'Articolul a fost creat cu succes!');
    }
//  

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug',$slug)->get();    
        $posts = Post::orderBy('created_at', 'desc')->limit('5')->get();
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
    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->first();
    
        if(auth()->check() && auth()->user()->is_admin != 1) {
            return redirect('/news')->with('error', 'Neautorizat! Nu detii permisiuni de administrator sau moderator!');
        }
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
            'body' => 'required|max:50000|min:500',
            'seo_title' => 'required|max:150|min:10',
            'metabody' => 'required|max:300|min:50',
        ]);

        $post = Post::find($slug);
        $post -> title = $request -> input('title');
        $post -> slug = SlugService::createSlug(Post::class, 'slug', $request->seo_title);
        $post -> meta_description = $request->input('metabody');
        $post -> cover_image = trim($request->input('filepath'), env('APP_URL'));
        $post -> body = $request->input('body');
        $post -> seo_title = $request->input('seo_title');
        // $post -> cover_image = $request -> input('cover_image');
        $post -> save();

        // $insert = [
        //     'title' => $request->input('title'),
        //     'meta_description' => $request->input('metabody'),
        //     'seo_title' => $request->input('seo_title'),
        //     'body' => $request->input('body'),
        //     'updated_at' => now(),
        //     'created_at' => now(),
        //     'user_id' => Auth::id(),
        //     'slug' => SlugService::createSlug(Post::class, 'slug', $request->seo_title),
        // ];
        // Post::insertGetId($insert);
        return redirect('/news')->with('success', 'Articolul a fost modificat cu succes!');
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
        return redirect('/news')->with('success', 'Articolul a fost sters cu succes!');
    }
}
