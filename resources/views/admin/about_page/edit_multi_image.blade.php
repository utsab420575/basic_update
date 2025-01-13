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
                            <h4 class="card-title">Edit Multi Image</h4><br><br>
                            <!-- multipart/form-data is necessary when your form includes file inputs.
                            It ensures that the file data and other form fields are sent as separate parts in the HTTP request.-->
                            <form METHOD="POST" action="{{route('update.multi.image')}}" enctype="multipart/form-data">
                                @csrf
                                {{--we use 1st id as slider option--}}
                                <input type="hidden" name="id" value="{{$multiImage->id}}">

                                {{--image button--}}
                                <div class="row mb-3">
                                    <label for="edit_multi_image_button" class="col-sm-2 col-form-label">Change Image</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" id="edit_multi_image_button"
                                               name="edit_multi_image_button">
                                        @error('edit_multi_image_button')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{--image showing--}}
                                <div class="row mb-3">
                                    <label for="edit_multi_image_preview" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <img
                                            id="edit_multi_image_preview"
                                            class="rounded avatar-lg"
                                            style="width: 200px; height: 200px;"
                                            alt="300x300" data-holder-rendered="true"
                                            {{--src="{{ empty($homeslide->home_slide) ? url('upload/no_image.jpg') : url('upload/home_slide/'.$homeslide->home_slide) }}">--}}
                                            src="{{ empty($multiImage->multi_image) ? url('upload/no_image.jpg') : asset($multiImage->multi_image) }}">
                                    </div>
                                </div>


                                <!-- Input using : 1. You need a simple submit button.
                                           2. No additional styling or complex content is required.-->
                                {{-- <input type="submit" class="mt-4 btn btn-info btn-rounded waves-effect waves-light" value="Update Profile">--}}

                                <!-- button using : You need more flexibility (e.g., including icons, images, or other content inside the button). -->

                                <div class="mb-2 mt-4 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-info btn-rounded waves-effect waves-light"><i
                                            class="fas fa-edit"></i> Update Image
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
            $('#edit_multi_image_button').on('change', function (e) {
                // Get the selected file
                var file = e.target.files[0];

                // Check if a file was selected
                if (file) {
                    var reader = new FileReader();

                    // Set the src of the image when the file is loaded
                    reader.onload = function (e) {
                        $('#edit_multi_image_preview').attr('src', e.target.result);
                    };

                    // Read the file as a data URL
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endsection
