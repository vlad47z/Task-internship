@extends('layouts.app')

@section('content')

<div class="container"><br>
    <div class="card">
        <div class="card-header">
            <strong>(!) User panel</strong>
        </div>

        <div class="card-body">
            <a style="text-decoration: none;" href="users/profile">Change username</a><br>
            <hr>
            <a style="text-decoration: none;" href="users/change-password" >Change user password</a>
            @if(auth()->check() && auth()->user()->is_admin == 1)
            <hr>
            <a style="text-decoration: none;" class="font-weight-bold" href="home">(!) Article management</a><br>
            <hr>
            <a  class="font-weight-bold" href="{{ route('sizepanel') }}">(!) Picture size adjustments</a>
            @endif
        </div>
    </div>
</div>
@endsection