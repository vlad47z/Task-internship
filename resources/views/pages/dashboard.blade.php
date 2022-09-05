@extends('layouts.app')
    <div class="hero-area hero-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 offset-lg-2 text-center">
                    <div class="hero-text">
                        <div class="hero-text-tablecell">
                        @guest
                            <p class="subtitle">Article Management App</p>
                            <h2 class="text-white">Log In or continue as a guest!</h2>
                            <div class="hero-btns">
                                <a href="{{ route('login') }}" class="boxed-btn">Login</a>
                                <a href="/news" class="bordered-btn">Read news</a>
                            </div>
                        @else
                           
                            <p class="subtitle">Article Management App</p>
                            @if(auth()->check() && auth()->user()->is_admin == 1)
                            <h2 class="text-white">Welcome {!! auth()->user()->name  !!}, you are administrator!</h2>
                            <div class="hero-btns">
                                <a href="/news" class="bordered-btn">Read news</a>
                                <a href="/news/create" class="boxed-btn" >Create news</a>
                            </div>
                            @else
                            <h2 class="text-white">Welcome {!! auth()->user()->name  !!}. Ready to read some news?</h1>
                            <div class="hero-btns">
                                <a href="/news" class="bordered-btn">Read news</a>
                            </div>

                            @endif
                            
                        @endguest    
                         
                        
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>