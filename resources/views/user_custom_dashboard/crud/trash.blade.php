@extends('user_custom_dashboard.user_master')
@section('user')

<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">{{$title}}</h4>
                        <p class="mb-0 text-danger"><em>*Deleting in this section will be permanently</em></p>
                        
                        <table id="datatable" class="table dt-responsive nowrap w-100 ">
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
                                        if(!$post->photo_path){
                                            $photo = asset('images')  . "/no-image.jpg";
                                        }
                                        if(str_contains($post->photo_path, '{width}')){
                                            // if image don't show, api has prob (faker class)
                                            $photo = str_replace(['{width}', '{height}'], ["100","100"], $post->photo_path);
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
                                            <a href="{{ route('post.restore', $post->id) }}" class="btn btn-success sm" title="Restore" id="restore"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3C140.6 6.8 151.7 0 163.8 0zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm192 64c-6.4 0-12.5 2.5-17 7l-80 80c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l39-39V408c0 13.3 10.7 24 24 24s24-10.7 24-24V273.9l39 39c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-80-80c-4.5-4.5-10.6-7-17-7z"/></svg></a>  

                                            <a href="{{ route('post.destroy', $post->id) }}" class="btn btn-danger sm" title="Delete" id="delete"> <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg></a>
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
