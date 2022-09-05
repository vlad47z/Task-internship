@extends('layouts.app')
@section('title', 'Task | Size Adjustment')

@section('content')
<!-- //load jquery v3.6 (* its important) -->
<script src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<!-- //load stand-alone-button -->
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

<script>
    var route_prefix = "{{route('unisharp.lfm.show')}}";
    $('#lfm').filemanager('image', {prefix: route_prefix});
</script>


<div class="container"><br>
    <div class="row mt-2 mb-2">
        <a href="/users" style="width: 150px;" class=" ml-2 btn btn-danger text-center"><i class="fas fa-arrow-left"></i> Back</a>
        <a style="width: 200px;" id="lfm" data-input="thumbnail" data-preview="holder" class=" ml-2 btn btn-primary text-white"><i class="fas fa-box"></i> File management</a>
    </div>
    <div class="card mt-4 mb-4">
        <div class="card-header bg-dark text-white">
            <strong>(!) Size adjustments for articles list page (pixels) - </strong>
        </div>
    {{Form::open(['action' => 'App\Http\Controllers\ResizeController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data'])}}
    @csrf
    @foreach ($sizes as $size)
        <div class="card-body">
           <label class="mt-2 mb-2">Width: </label>
           <input type="text" maxlength="4" class="form-control" name="widthlist" value="{{$size->width_list}}" required>

           <label class="mt-2 mb-2">Height: </label>
           <input type="text" maxlength="4" class="form-control" name="heightlist" value="{{$size->height_list}}" required>
        </div>
    </div>
    <div class="card mt-4 mb-4">
        <div class="card-header bg-dark text-white">
            <strong>(!) Size adjustments for single article page (pixels) - </strong>
        </div>

        <div class="card-body">
           <label class="mt-2 mb-2">Width: </label>
           <input type="text" maxlength="4" class="form-control" name="widthsng" value="{{$size->width_single}}" required>

           <label class="mt-2 mb-2">Height: </label>
           <input type="text" maxlength="4" class="form-control" name="heightsng"  value="{{$size->height_single}}" required>
        </div>
    @endforeach
    </div>
    {{Form::submit('Save changes', ['class'=>'btn btn-success', 'style'=>'width:150px'])}}
    {{Form::close()}} 
</div>
@endsection