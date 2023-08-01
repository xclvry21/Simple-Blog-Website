@extends('user_custom_dashboard.user_master')
@section('user')

<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">{{$title}}</h4>
                        
                        <table id="datatable" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
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
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$post->title}}</td>
                                        <td><img src="{{$photo}}" alt="" class="rounded avatar-lg"></td>
                                        <td>          
                                            <a href="{{ route('post.show', $post) }}" id="edit" class="btn btn-info sm waves-effect waves-light"><i class="fas fa-regular fa-eye"></i></a>

                                            <a href="{{ route('post.edit', $post->id) }}" id="edit" class="btn btn-primary sm waves-effect waves-light"><i class="far fa-edit" ></i></a>

                                            <a href="{{ route('post.delete', $post->id) }}" class="btn btn-danger sm" title="Delete" id="delete"> <i class="fas fa-trash" ></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->

    </div>
</div>

@endsection
