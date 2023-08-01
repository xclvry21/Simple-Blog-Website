@extends('user_custom_dashboard.user_master')
@section('user')
<link rel="stylesheet" href="{{ URL::asset('custom/comments.css') }}">

@php
use App\Models\User;

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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="">{{$post->title}}</h4>
                        <div class="row mb-3">
                            <img src="{{$photo}}" style="width:300px; height: 200px;">    
                        </div>
                        <div class="row mb-3">
                            <p>{{$post->body}}</p>  
                        </div>

                        <h5>Comments ( {{$comments->count()}} )</h5>
                        <div class="container">
                            <form class="mb-4" action="{{ route('comment.store') }}" method="post">@csrf
                                <textarea class="form-control" rows="3" placeholder="Join the discussion and leave a comment!" name="body" required></textarea>
                                <input type="hidden" value="{{$post->id}}" name="post_id">

                                <input type="submit" class="btn btn-sm m-1 btn-primary waves-effect waves-light" value="Submit" id="#" style="float: right;">
                            </form>
                            
                            <div class="be-comment-block">
                            @foreach ($comments as $comment)
                            @php
                                $user = User::findOrFail($comment->user_id);

                                $name = trim(collect(explode(' ', $user->name))->map(function ($segment) {
                                    return mb_substr($segment, 0, 1);
                                })->join(' '));

                                $default_pic = 'https://ui-avatars.com/api/?name='.urlencode($name).'&color=7F9CF5&background=EBF4FF';
                            @endphp
                                <div class="be-comment">
                                    <div class="be-img-comment">	
                                        <a href="blog-detail-2.html">
                                            <img src="{{ $user->profile_photo_path ?  asset('storage\/') . $user->profile_photo_path : $default_pic }}" alt="" class="be-ava-comment">
                                        </a>
                                    </div>
                                    <div class="be-comment-content">
                                            <span class="">
                                                <a href="#">{{ $user->name }}</a>
                                                </span>
                                            <span class="be-comment-time">
                                                <i class="fa fa-clock-o"></i>
                                                {{$comment->created_at->diffForHumans()}}
                                            </span>
                            
                                        <p class="be-comment-text">
                                            {{$comment->body}}
                                        </p>
                                    </div>
                                </div>
                                
                            @endforeach
                            </div>
                        </div>
                       

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->

       

    </div>
</div>

<script type="text/javascript">

    $(document).ready(function(){
        $('#image').change(function (e) { 
            console.log()
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

</script>

@endsection
