
@extends('layouts.app')
@section('title', 'Read news')
@section('content')

<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p>Article Management App</p>
                    <h1>Read or create some news</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end breadcrumb section -->
<!-- latest news -->
<div class="latest-news mt-150 mb-150">
    <div class="container">
        <div class="row">
        @if (count($posts) > 0)
        @foreach ($posts as $post)
        <div class="col-lg-4 col-md-6">
            <div class="single-latest-news ml-8 mr-8">
                <a href="/news/{{$post->slug}}"><div class="latest-news-bg"><img width="350px" height="200px" width="" src="{{ $post->cover_image }}"></div></a>
                <div class="news-text-box">
                    <h3><a style="color: black;" href="/news/{{$post->slug}}">{!!preg_replace("/&#?[a-z0-9]{2,8};/i", " ", Str::limit($post->title, 20))!!}</a></h3>
                    <p class="blog-meta">
                    
                    <span style="color: black;" class="author"><i class="fas fa-user"></i>{{$post->user->name}}</span>
                    <span style="color: black;" class="date"><i class="fas fa-calendar"></i>{{ date("D, d M | Y", strtotime($post->created_at)) }}</span>
                    </p>
                    <p style="color: black;" class="excerpt">{!! preg_replace("/&#?[a-z0-9]{2,8};/i", " ", strip_tags(Str::limit($post->body, 40))) !!}</p>
                    <a style="color: black;" href="/news/{{$post->slug}}" class="read-more-btn">keep reading <i class="fas fa-angle-right"></i></a>
                </div>
            </div>
        </div>
        @endforeach
        </div>
        
        <div class="float-right">
            {{$posts->links('include.my-paginate')}} 
        @else
            <p><strong>(!)Niciun articol postat încă</strong></p>
        @endif
        </div>
        
    </div>
</div>
@endsection
<!-- End latest news -->