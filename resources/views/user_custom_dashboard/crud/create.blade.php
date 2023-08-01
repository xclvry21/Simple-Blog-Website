@extends('user_custom_dashboard.user_master')
@section('user')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">{{$title}}</h4>
                        
                        <form action="{{ route('post.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">

                                {{-- title --}}
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" id="example-text-input" value="{{ old('title') }}" name="title">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- /title --}}

                                {{-- image --}}
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Upload image here</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" id="image" name="image">
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror     
                                    </div>
                                </div>
                                
                                {{-- preview image --}}
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                        <img src="" id="showImage">    
                                </div>
                                {{-- /image --}}

                                {{-- body --}}
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Body</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" rows="3" name="body">{{ old('body') }}</textarea>
                                        @error('body')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                               
                                {{-- /body --}}
                            </div>
                        
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary waves-effect waves-light" value="Save" id="#">
                            </div>
                        </form>
                       
                    
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
