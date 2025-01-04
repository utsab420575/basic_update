@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <img
                            class="rounded-circle avatar-xl mx-auto d-block mt-2"
                            style="width: 200px; height: 200px;object-fit: contain;"
                            alt="300x300"
                            data-holder-rendered="true"
                            src="{{ empty($admin_data->profile_image) ? url('upload/no_image.jpg') : url('upload/admin_images/'.$admin_data->profile_image) }}">
                        <div class="card-body">
                            <h4 class="card-title">Name : {{$admin_data->name}}</h4>
                            <hr>
                            <h4 class="card-title">Email : {{$admin_data->email}}</h4>
                            <hr>
                            <h4 class="card-title">User Name : {{$admin_data->user_name}}</h4>
                            <hr>
                            <a href="{{route('edit.profile')}}" class="btn btn-info btn-rounded waves-effect waves-light">Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
