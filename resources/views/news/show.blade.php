@extends('layouts.app')
@section('title', $post[0]->title)
@section('meta_description', $post[0]->meta_description)

<!--your post content -->

@section('content')

<div class="mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="single-article-section">
						<div class="single-article-text">
							<div class="row">
								<a href="/news" class="btn btn-outline-primary" style="width: 167px"><i class="fas fa-arrow-left"></i> Back to news</a>
								@if(auth()->check() && auth()->user()->is_admin == 1)
									{!!Form::open(['action' =>['App\Http\Controllers\NewsController@destroy', $post[0]->slug], 'method' => 'POST'])!!}
										{{Form::hidden('_method', 'DELETE')}}
										{{Form::submit('Delete article', ['class'=>'ml-2 btn btn-outline-danger', 'style' => 'width:167px'])}}
									{!!Form::close()!!}
								<a href="/news/{{$post[0]->slug}}/edit" style="width: 167px" class="ml-2 btn btn-outline-success">Edit article</a>
								@endif
							</div><br>
							<div class="single-artcile-bg"><img width="750px" height="450px" src="{{$post[0] -> cover_image}}" /></div>
							<p class="blog-meta">
								<span class="author"><i class="fas fa-user"></i> {{$post[0]->user->name}}</span>
								<span class="date"><i class="fas fa-calendar"></i> {{$post[0]->created_at}}</span>
								<span class="date"><i class="fas fa-bolt"></i> {{$post[0]->slug}}</span>
							</p>
							<h2>{{$post[0]->title}}</h2><hr>
							<p>{!! preg_replace("/&#?[a-z0-9]{2,8};/i", " ", $post[0]->meta_description) !!}</p><hr>
							<p>{!! preg_replace("/&#?[a-z0-9]{2,8};/i", " ", $post[0]->body) !!}</p>
						</div>						
					</div><br>					
				</div>
				
				<div class="col-lg-4">
					<div class="sidebar-section">
						<div class="recent-posts">
							<h4>Recent Posts</h4>
							<ul>
								@foreach ($posts as $post)
									<li><a href="/news/{{$post->slug}}"> {{$post->title}} </a></li>
								@endforeach		
							</ul>
						</div>

						<div class="archive-posts">
							<h4>Archive Posts</h4>
							<ul>
								<li><a href="#"> ... </a></li>	
							</ul>
						</div>

						<div class="tag-section">
							<h4>Tags</h4>
							<ul>
								<li><a href=" ">IT</a></li>
								<li><a href=" ">Code</a></li>
								<li><a href=" ">Laravel</a></li>
								<li><a href=" ">Articles</a></li>
								<li><a href=" ">Latest News</a></li>
								<li><a href=" ">News</a></li>
							</ul>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end single article section -->

@endsection