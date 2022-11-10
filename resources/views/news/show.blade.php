@extends('layouts.app')
@section('title', $post[0]->seo_title)
@section('meta_description', $post[0]->meta_description)

<!-- single article section -->
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
										{{Form::submit('Delete article', ['class'=>'ml-2 btn btn-dark', 'style' => 'width:167px'])}}
									{!!Form::close()!!}
								<a href="/news/{{$post[0]->slug}}/edit" style="width: 167px" class="ml-2 btn btn-dark">Edit article</a>
								@endif
							</div><br>
							<div class="single-artcile-bg"><img width="750px" height="450px" src="{{$posts[0]->cover_image}}"/></div>
							<p class="blog-meta">
								<span class="author"><i class="fas fa-user"></i> {{$post[0]->user->name}}</span>
								<span class="date"><i class="fas fa-calendar"></i> {{ date("D, d M | Y", strtotime($post[0]->created_at)) }}</span>
								
								@if (round(str_word_count($post[0]->body) / 200) <= 0)
								<span class="date"><i class="fas fa-book-reader"></i>less than a minute for reading</span>
								@else
								<span><i class="fas fa-book-reader"></i>≈ {!! round(str_word_count($post[0]->body) / 200) !!} minutes for reading</span>
								@endif
								<span><i class="fas fa-edit"></i> {{str_word_count($post[0]->body)}} words</span>
							</p>
							<h2>{{$post[0]->title}}</h2><hr>
							<p>{!!preg_replace("/&#?[a-z0-9]{2,8};/i", " ", $post[0]->meta_description)!!}</p><hr>
							<p>{!!preg_replace("/&#?[a-z0-9]{2,8};/i", " ", $post[0]->body)!!}</p>
						</div>						
					</div><br>					
				</div>

				<div class="col-lg-4">
					<div class="sidebar-section">
						<div class="recent-posts">
							<h4>Recent Posts</h4>
							<ul>
								@foreach ($posts as $post)
									<li><a href="/news/{{$post->slug}}">{{$post->title}}</a></li>
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
							<h4>Article tags</h4>
	
							<ul>
								<li><a href=" "> ... </a></li>
								<li><a href=" "> ... </a></li>
								<li><a href=" "> ... </a></li>
								<li><a href=" "> ... </a></li>
								<li><a href=" "> aaa </a></li>
							</ul>	
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
	<!-- end single article section -->
@endsection