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
                            <h4 class="card-title">Edit Profile Page</h4><br><br>
                            <!-- multipart/form-data is necessary when your form includes file inputs.
                            It ensures that the file data and other form fields are sent as separate parts in the HTTP request.-->
                            <form METHOD="POST" action="{{route('store.profile')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" value="{{$edit_data->name}}" id="name" name="name">
                                        @error('name')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="email" value="{{$edit_data->email}}" id="email" name="email">
                                        @error('email')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="user_name" class="col-sm-2 col-form-label">User Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" value="{{$edit_data->user_name}}" id="user_name" name="user_name">
                                        @error('user_name')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="profile_image_button" class="col-sm-2 col-form-label">Profile Image</label>
                                    <div class="col-sm-10">
                                        <input  class="form-control" type="file" id="profile_image_button" name="profile_image_button">
                                        @error('profile_image_button')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="profile_image" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <img
                                            id="profile_image"
                                            class="rounded avatar-lg"
                                            style="width: 200px; height: 200px;"
                                            alt="300x300" data-holder-rendered="true"
                                            src="{{ empty($edit_data->profile_image) ? url('upload/no_image.jpg') : url('upload/admin_images/'.$edit_data->profile_image) }}">
                                    </div>
                                </div>

                               <!-- Input using : 1. You need a simple submit button.
                                          2. No additional styling or complex content is required.-->
                               {{-- <input type="submit" class="mt-4 btn btn-info btn-rounded waves-effect waves-light" value="Update Profile">--}}

                                <!-- button using : You need more flexibility (e.g., including icons, images, or other content inside the button). -->

                                <div class="mb-2 mt-4 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-info btn-rounded waves-effect waves-light"><i class="fas fa-edit"></i> Update Profile</button>
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
            $('#profile_image_button').on('change', function (e) {
                // Get the selected file
                var file = e.target.files[0];

                // Check if a file was selected
                if (file) {
                    var reader = new FileReader();

                    // Set the src of the image when the file is loaded
                    reader.onload = function (e) {
                        $('#profile_image').attr('src', e.target.result);
                    };

                    // Read the file as a data URL
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endsection
