@extends('layouts.app')
@section('title', 'Task|Editor mode')

@section('content')
    <script src="https://code.jquery.com/jquery-3.6.0.js"
                integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <!-- //load stand-alone-button -->
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    
<div class="container mb-2"><br>
      <h1 class="mt-4">Edit the article:</h1>
      
      {{Form::open(['action' => ['App\Http\Controllers\NewsController@update', $post->id], 'method' => 'POST'])}}
      @csrf
      <!-- Article title div -->
      <div class="form-group mt-4">
          {{Form::label('title', 'Title')}}
          {{Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' =>'Title ...'])}}
      </div>


      <!-- Article description div -->
      <div class="form-group">
          {{Form::label('body', 'Body')}}
          {{Form::textarea('body', $post->body, ['id'=>'body', 'class' => 'form-control', 'placeholder' =>'Text'])}}
      </div>

      <br><label><h4>Change thumbnail image for this article:</h4></label>
        <div class="input-group">
        <span class="input-group-btn">
            <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-danger text-white">
            <i class="fas fa-image"></i> Choose a picture
            </a>
        </span>
            <input id="thumbnail" class="form-control" type="text" name="filepath" value="{{$post->cover_image}}" readonly>
        </div>
        <img id="holder" style="margin-top:15px;max-height:100px;">

        <script>
            var route_prefix = "{{route('unisharp.lfm.show')}}";
            $('#lfm').filemanager('image', {prefix: route_prefix});
        </script>

      <br><label><h4>SEO attributes section:</h4></label>
      
        <div class="form-group">
           <label>SEO title:</label>
           <input type="text" class="form-control" name="seo_title" id="seo_title_edit"  value="{!! $post->seo_title  !!}" required>
            <i class="fas fa-comment"> Create a short and strict SEO title for your article</i>
        </div>
      
        <div class="form-group">
            {{Form::label('metabody', 'Meta description:')}}
            {{Form::textarea('metabody', $post->meta_description, ['id'=>'metabodyedit', 'rows' => '2', 'class' => 'form-control', 'placeholder' =>'. . .'])}}
            <i class="fas fa-comment"> Meta description for your article</i>
        </div>
      
      
      <!-- Submit button div -->
    <div class="post_button">
        <br>{{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Save changes', ['class'=>'btn btn-success pl-5 pr-5'])}}
    {{Form::close()}}
    <a href="/home" style="width: 172px;" class="btn btn-danger">Cancel edit</a>
    </div>
</div>
@endsection