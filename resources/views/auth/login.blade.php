@extends('layouts.app')

@section('content')
<div class="mt-4 container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white bg-dark mb-3">{{ __('Login') }}</div>

                <div class="card-body text-white bg-dark">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-success" style="width: 200px;">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?')}}
                                    </a><a href="/register"></a>
                                @endif
                            </div>
                        </div>
                        <br>
                       <div class="row">
                            <div class="col-md-4">
                                <a href="{{ route('login.facebook') }}" type="submit" class="btn btn-primary facebook-button" style="width: 200px;">
                                    {{ __('Connect with Facebook') }}
                                </a>
                            </div><br>
                            <div class="col-md-4">
                                <a href="{{ route('login.google') }}" type="submit" class="btn btn-danger" style="width: 200px;">
                                    {{ __('Connect with Google') }}
                                </a>
                            </div><br>
                            <div class="col-md-4">
                                <a href="/register" type="submit" class="btn btn-success" style="width: 200px;">
                                    {{ __('Create an account') }}
                                </a>
                            </div><br>
                       </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
