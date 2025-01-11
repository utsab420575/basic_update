@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="page-content">
        <div class="container-fluid">
            {{--<div class="row justify-content-center">--}}
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">About Page</h4><br><br>
                            <!-- multipart/form-data is necessary when your form includes file inputs.
                            It ensures that the file data and other form fields are sent as separate parts in the HTTP request.-->
                            <form METHOD="POST" action="{{route('update.about')}}" enctype="multipart/form-data">
                                @csrf
                                {{--we use 1st id as slider option--}}
                                <input type="hidden" name="id" value="{{$aboutpage->id}}">

                                {{--title--}}
                                <div class="row mb-3">
                                    <label for="title" class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" value="{{$aboutpage->title}}" id="title"
                                               name="title">
                                        @error('title')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{--short title--}}
                                <div class="row mb-3">
                                    <label for="short_title" class="col-sm-2 col-form-label">Short Title</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" value="{{$aboutpage->short_title}}"
                                               id="short_title" name="short_title">
                                        @error('short_title')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{--short description--}}
                                <div class="row mb-3">
                                    <label for="short_description" class="col-sm-2 col-form-label">Short
                                        Descripton</label>
                                    <div class="col-sm-10">

                                        <textarea
                                            id="short_description"
                                            name="short_description"
                                            class="form-control"
                                            rows="5"
                                            required>{{ $aboutpage->short_description }}</textarea>

                                        @error('short_description')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{--long description--}}
                                <div class="row mb-3">
                                    <label for="long_description" class="col-sm-2 col-form-label">Long
                                        Description</label>
                                    <div class="col-sm-10">
                                        <textarea id="elm1" name="long_description">
                                            {{$aboutpage->long_description}}
                                        </textarea>
                                        @error('long_description')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{--image button--}}
                                <div class="row mb-3">
                                    <label for="about_image_button" class="col-sm-2 col-form-label">Slider Image</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" id="about_image_button"
                                               name="about_image_button">
                                        @error('about_image_button')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{--image showing--}}
                                <div class="row mb-3">
                                    <label for="about_image" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <img
                                            id="about_image"
                                            class="rounded avatar-lg"
                                            style="width: 200px; height: 200px;"
                                            alt="300x300" data-holder-rendered="true"
                                            {{--src="{{ empty($homeslide->home_slide) ? url('upload/no_image.jpg') : url('upload/home_slide/'.$homeslide->home_slide) }}">--}}
                                            src="{{ empty($aboutpage->about_image) ? url('upload/no_image.jpg') : asset($aboutpage->about_image) }}">
                                    </div>
                                </div>


                                <!-- Input using : 1. You need a simple submit button.
                                           2. No additional styling or complex content is required.-->
                                {{-- <input type="submit" class="mt-4 btn btn-info btn-rounded waves-effect waves-light" value="Update Profile">--}}

                                <!-- button using : You need more flexibility (e.g., including icons, images, or other content inside the button). -->

                                <div class="mb-2 mt-4 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-info btn-rounded waves-effect waves-light"><i
                                            class="fas fa-edit"></i> Update About
                                    </button>
                                </div>


                                <!-- end row -->

                            </form>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>

    <!-- For Showing Image When Select Choose Button -->
    <script>
        $(document).ready(function () {
            $('#about_image_button').on('change', function (e) {
                // Get the selected file
                var file = e.target.files[0];

                // Check if a file was selected
                if (file) {
                    var reader = new FileReader();

                    // Set the src of the image when the file is loaded
                    reader.onload = function (e) {
                        $('#about_image').attr('src', e.target.result);
                    };

                    // Read the file as a data URL
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endsection
