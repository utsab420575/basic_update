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
                            <h4 class="card-title">Change Password</h4><br><br>
                            <!-- Display Validation Errors -->
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger" role="alert">
                                        {{$error}}
                                    </div>
                                @endforeach
                            @endif
                            <form METHOD="POST" action="{{route('update.password')}}">
                                @csrf

                                <div class="row mb-3">
                                    <label for="old_password" class="col-sm-2 col-form-label">Old Password</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="password" value="" id="old_password"
                                               name="old_password">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="new_password" class="col-sm-2 col-form-label">New Password</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="password" value="" id="new_password"
                                               name="new_password">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="confirm_password" class="col-sm-2 col-form-label">Confirm
                                        Password</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="password" value="" id="confirm_password"
                                               name="confirm_password">
                                    </div>
                                </div>


                                <!-- Input using : 1. You need a simple submit button.
                                           2. No additional styling or complex content is required.-->
                                {{-- <input type="submit" class="mt-4 btn btn-info btn-rounded waves-effect waves-light" value="Update Profile">--}}

                                <!-- button using : You need more flexibility (e.g., including icons, images, or other content inside the button). -->

                                <div class="mb-2 mt-4 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-info btn-rounded waves-effect waves-light"><i
                                            class="fas fa-edit"></i> Update Password
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
@endsection
