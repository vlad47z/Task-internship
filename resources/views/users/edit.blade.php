@extends('layouts.app')
@section('content')
<br><div class="container"><br>
    <a href="/users" style="width: 150px; justify-content:center;" class="mb-4 btn btn-danger"> ← Back</a>
    <div class="card">
        <div class="card-header">
            <strong>(!) User panel</strong>
        </div>
        <div class="card-body">
            <form action="{{ route('users.update-profile') }}" method="POST"> 
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name: </label>
                    <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}" maxlength="20">
                    <small>At least 20 characters, in a single word</small>
                </div>
                <button type="submit" class="btn btn-danger">Update profile</button>
            </form>
        </div>
    </div>
</div>
@endsection