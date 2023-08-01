@extends('blog.master')
@section('blog_contents')
@php
    if(str_contains($latest->photo_path, '{width}')){
        // if image don't show, api has prob (faker class)
        $photo = str_replace(['{width}', '{height}'], ["1000","1000"], $post->photo_path);
    }
    else if(!$latest->photo_path){
        $photo = asset('images')  . "/no-image.jpg";
    }
    else{
        $photo = "/storage/".$latest->photo_path;
    }
@endphp
        <!-- Page header with logo and tagline-->
        <header class="py-5 bg-light border-bottom mb-4">
            <div class="container">
                <div class="text-center my-5">
                    <h1 class="fw-bolder">Welcome to {{config('app.name')}}</h1>
                    <p class="lead mb-0">Show what's on your mind. Create your blog post now!</p>
                </div>
            </div>
        </header>
        <!-- Page content-->
        <div class="container">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-8">
                    <!-- Featured blog post-->
                    <div class="card mb-4">
                        <a href="{{route('blog.show', $latest )}}"><img class="card-img-top" src="{{$photo}}" alt="{{$latest->title}}" /></a>
                        <div class="card-body">
                            <div class="small text-muted">{{$latest->created_at->diffForHumans()}}</div>
                            <h2 class="card-title">{{$latest->title}}</h2>
                            <p class="card-text">{{ Str::limit($latest->body, 200)}}</p>
                            <a class="btn btn-primary" href="{{route('blog.show', $latest )}}">Read more →</a>
                        </div>
                    </div>
                    <!-- Nested row for non-featured blog posts-->
                    {{-- @foreach ($posts as $post) --}}
                    <div class="row">
                        @foreach ($posts as $post)
                        @php
                            if(str_contains($post->photo_path, '{width}')){
                                // if image don't show, api has prob (faker class)
                                $photo = str_replace(['{width}', '{height}'], ["100","100"], $post->photo_path);
                            }
                            else if(!$post->photo_path){
                                $photo = asset('images')  . "/no-image.jpg";
                            }
                            else{
                                $photo = "/storage/".$post->photo_path;
                            }
                        @endphp
                        <div class="col-lg-6">
                            <!-- Blog post-->
                            <div class="card mb-4">
                                <a href="{{route('blog.show', $post )}}"><img class="card-img-top" src="{{$photo}}" alt="{{$post->title}}" /></a>
                                <div class="card-body">
                                    <div class="small text-muted">{{$post->created_at->diffForHumans()}}</div>
                                    <h2 class="card-title h4">{{$post->title}}</h2>
                                    <p class="card-text">{{ Str::limit($post->body, 100)}}</p>
                                    <a class="btn btn-primary" href="{{route('blog.show', $post )}}">Read more →</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    {{-- @endforeach --}}

                    <!-- Pagination-->
                    {{$posts->links()}}
                </div>
                <!-- Side widgets-->
                <div class="col-lg-4">
                    <!-- Search widget-->
                    <div class="card mb-4">
                        <div class="card-header">Search</div>
                        <div class="card-body">
                            <div class="input-group">
                                <input class="form-control" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                                <button class="btn btn-primary" id="button-search" type="button">Go!</button>
                            </div>
                        </div>
                    </div>
                    <!-- Categories widget-->
                    <div class="card mb-4">
                        <div class="card-header">Categories</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        <li><a href="#!">Web Design</a></li>
                                        <li><a href="#!">HTML</a></li>
                                        <li><a href="#!">Freebies</a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        <li><a href="#!">JavaScript</a></li>
                                        <li><a href="#!">CSS</a></li>
                                        <li><a href="#!">Tutorials</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Side widget-->
                    <div class="card mb-4">
                        <div class="card-header">Side Widget</div>
                        <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and feature the Bootstrap 5 card component!</div>
                    </div>
                </div>
            </div>
        </div>
@endsection