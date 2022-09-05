@extends('layouts.app')
@section('title', 'Admin panel')
@section('content')
<style>
	p, h2, a, i, h3 {
		word-wrap: break-word;
	}
</style>
<br><br><br><br><div class="container-xxl">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card ml-8 mr-8">
                <div class="card-header text-white bg-dark mb-3 text-left">{{ __('Administration panel') }}
                <a class="btn btn-light btn-sm text-black text-right float-right" href="/news/create">Create article</a>
                </div>
                <div class="card">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <br><h3 class="ml-3 text-center">Posted articles</h3>
                    @if (count($posts) > 0)
                        <table class="table">
                            <tr>
                                <th colspan="6">Titlu</th>
                            </tr>
                            @foreach ($posts as $post)
                            <tr>
                                <td>{{$post->title}}</td>
                                <td colspan="2"><a href="/news/{{$post->slug}}/edit" class="ml-4 float-right btn btn-success btn-sm">Modify article</a></td>
                                <td>
                                    {!!Form::open(['action' =>['App\Http\Controllers\NewsController@destroy', $post->slug], 'method' => 'POST', 'class' => 'float-right'])!!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit('Delete article', ['class'=>'ml-2 btn btn-danger btn-sm float-right'])}}
                                    {!!Form::close()!!}
                                </td>
                                <td colspan="2"><a style="width: 100px;" href="/news/{{$post->slug}}" class="ml-2 float-right btn btn-primary btn-sm">Read more</a></td>
                            </tr>   
                            @endforeach
                        </table>   
                    @else
                        <p class="ml-3 font-weight-bold text-center">(!) Niciun articol postat inca</p>
                    @endif
                </div>
            </div>
        </div>
    </div><br>
</div><br>
@endsection
