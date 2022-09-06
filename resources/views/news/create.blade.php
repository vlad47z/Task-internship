@extends('layouts.app')
@section('title', 'Task | Creator mode')
@section('content')
<!-- //load jquery v3.6 (* its important) -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<!-- //load stand-alone-button -->
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>

    <div class="container"><br><br><br>
        <h1>Creează un articol</h1>
        <!-- Article title div -->
        {{Form::open(['action' => 'App\Http\Controllers\NewsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data'])}}
        <br><div class="form-group">
            {{Form::label('title', 'Titlu:')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' =>'. . .'])}}
        </div>

        <!-- Article description div -->
        <div class="form-group">
            {{Form::label('body', 'Descriere:')}}
            {{Form::textarea('body', '', ['id'=>'body', 'class' => 'form-control', 'placeholder' =>'. . .'])}}
        </div>


        <!-- Set a cover image div -->
        <!-- <br><label><h4>Set a cover image for this article:</h4></label>
        <div class="form-group">
            {{Form::file('cover_image')}}
        </div> -->

        <br><label><h4>Set a thumbnail image for this article:</h4></label>
        <div class="input-group">
        <span class="input-group-btn">
            <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-danger text-white"><i class="fas fa-image"></i> Choose a picture</a>
        </span>
            <input id="thumbnail" class="ml-2 form-control-plaintext" type="text" name="filepath" readonly>
        </div>
        <img name="holder"  style="margin-top:15px;max-height:100px;">

        <script>
            var route_prefix = "{{route('unisharp.lfm.show')}}";
            $('#lfm').filemanager('image', {prefix: route_prefix});
        </script>
        

        <br><label class="mt-4 mb-4"><h4>SEO attributes section:</h4></label>
        <!-- SEO Section -->

         <!-- Slug URL -->
        <div class="form-group">
            {{Form::label('seo_title', 'SEO title:')}}
            {{Form::text('seo_title', null, array('id'=>'seo_title', 'class' => 'form-control', 'placeholder'=>'. . .'))}}
            <i class="fas fa-comment"> Create a short and strict SEO title for your article</i>
        </div>

        <div class="form-group">
            {{Form::label('metabody', 'Meta description:')}}
            {{Form::textarea('metabody', '', ['id'=>'metabody', 'rows' => '2', 'class' => 'form-control', 'placeholder' =>'. . .'])}}
            <i class="fas fa-comment">Meta description for your article</i>
        </div>


        <!-- Submit button div -->
        <div class="post_button">
            <br>{{Form::submit('Create article', ['class'=>'btn btn-danger pl-5 pr-5'])}}
            {{Form::close()}} 
        </div>
    </div>
    
@endsection

