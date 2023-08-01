@extends('blog.master')
@section('blog_contents')

@php
use App\Models\User;

$post_creator = User::find($post->user_id);

if(str_contains($post->photo_path, '{width}')){
    // if image don't show, api has prob (faker class)
    $photo = str_replace(['{width}', '{height}'], ["1000","1000"], $post->photo_path);
}
else if(!$post->photo_path){
    $photo = asset('images')  . "/no-image.jpg";
}
else{
    $photo = "/storage/".$post->photo_path;
}
@endphp

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Post content-->
            <article>
                <!-- Post header-->
                <header class="mb-4">
                    <!-- Post title-->
                    <h1 class="fw-bolder mb-1">{{$post->title}}</h1>
                    <!-- Post meta content-->
                    <div class="text-muted fst-italic mb-2">Created by {{$post_creator->name}} • {{$post->created_at->diffForHumans()}}</div>
                    
                </header>
                <!-- Preview image figure-->
                <figure class="mb-4"><img class="img-fluid rounded" src="{{$photo}}" alt="{{$post->title}}" style="width: 900px; height:400px"/></figure>
                <!-- Post content-->
                <section class="mb-5">
                    <p class="fs-5 mb-4">{{$post->body}}</p>  
                </section>
            </article>
            <!-- Comments section-->
            <section class="mb-5">
                <div class="card bg-light">
                    <div class="card-body">
                        <!-- Comment form-->
                        @if (Auth::user())
                            <form class="mb-4" action="{{ route('comment.store') }}" method="post">@csrf
                                <textarea class="form-control" rows="3" placeholder="Join the discussion and leave a comment!" name="body" required></textarea>
                                <input type="hidden" value="{{$post->id}}" name="post_id">

                                <input type="submit" class="btn btn-sm m-1 btn-primary waves-effect waves-light" value="Submit" id="#" style="float: right;">
                            </form>
                        @else
                            <p>Please login first your account to comment.</p>
                        @endif
                        
                        <h5>Comments ({{$comments->count()}})</h5>
                        @foreach ($comments as $comment)
                            @php
                                $user = User::findOrFail($comment->user_id);

                                $name = trim(collect(explode(' ', $user->name))->map(function ($segment) {
                                    return mb_substr($segment, 0, 1);
                                })->join(' '));

                                $default_pic = 'https://ui-avatars.com/api/?name='.urlencode($name).'&color=7F9CF5&background=EBF4FF';
                            @endphp

                            <div class="d-flex mb-4">
                                <div class="flex-shrink-0"><img src="{{ $user->profile_photo_path ?  asset('storage\/') . $user->profile_photo_path : $default_pic }}" alt="" class="be-ava-comment" style="height: 50px"></div>
                                <div class="ms-3">
                                    <div><span class="fw-bold">{{$user->name}}</span> • {{$comment->created_at->diffForHumans()}}</div>
                                   {{$comment->body}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
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