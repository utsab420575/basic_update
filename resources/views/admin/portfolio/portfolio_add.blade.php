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
                            <h4 class="card-title">Portfolio Page</h4><br><br>
                            <!-- multipart/form-data is necessary when your form includes file inputs.
                            It ensures that the file data and other form fields are sent as separate parts in the HTTP request.-->
                            <form method="POST" action="{{ route('store.portfolio') }}" enctype="multipart/form-data">
                                @csrf

                                {{-- Portfolio Name --}}
                                <div class="row mb-3">
                                    <label for="portfolio_name" class="col-sm-2 col-form-label">Portfolio Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" value="{{ old('portfolio_name') }}" id="portfolio_name" name="portfolio_name">
                                        @error('portfolio_name')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Portfolio Title --}}
                                <div class="row mb-3">
                                    <label for="portfolio_title" class="col-sm-2 col-form-label">Portfolio Title</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" value="{{ old('portfolio_title') }}" id="portfolio_title" name="portfolio_title">
                                        @error('portfolio_title')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Long Description --}}
                                <div class="row mb-3">
                                    <label for="portfolio_description" class="col-sm-2 col-form-label">Long Description</label>
                                    <div class="col-sm-10">
                                        <textarea id="elm1" name="portfolio_description">{{ old('portfolio_description') }}</textarea>
                                        @error('portfolio_description')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Portfolio Image Button --}}
                                <div class="row mb-3">
                                    <label for="portfolio_image_button" class="col-sm-2 col-form-label">Portfolio Image</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" id="portfolio_image_button" name="portfolio_image_button">
                                        @error('portfolio_image_button')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Image Showing --}}
                                <div class="row mb-3">
                                    <label for="portfolio_slider_image" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <img
                                            id="portfolio_slider_image"
                                            class="rounded avatar-lg"
                                            style="width: 200px; height: 200px;"
                                            alt="300x300" data-holder-rendered="true"
                                            {{--src="{{ old('portfolio_image_button') ? asset('upload/portfolio/' . old('portfolio_image_button')) : asset('upload/no_image.jpg') }}">--}}
                                            src="{{asset('upload/no_image.jpg') }}">
                                    </div>
                                </div>

                                {{-- Submit Button --}}
                                <div class="mb-2 mt-4 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-info btn-rounded waves-effect waves-light"><i class="fas fa-edit"></i>Add Portfolio</button>
                                </div>

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
            $('#portfolio_image_button').on('change', function (e) {
                // Get the selected file
                var file = e.target.files[0];

                // Check if a file was selected
                if (file) {
                    var reader = new FileReader();

                    // Set the src of the image when the file is loaded
                    reader.onload = function (e) {
                        $('#portfolio_slider_image').attr('src', e.target.result);
                    };

                    // Read the file as a data URL
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endsection
