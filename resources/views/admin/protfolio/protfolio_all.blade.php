@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Portfolio All</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Protfolio All Data</h4>
                            <p class="card-title-desc">
                                All of the multiple images showing from databases
                            </p>

                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Protfolio Name</th>
                                    <th>Protfolio Title</th>
                                    <th>Protfolio Image</th>
                                    <th>Action</th>
                                </tr>
                                </thead>


                                <tbody>
                                @php($i=1)
                                @foreach($allPortfolio as $singlePortfolio)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$singlePortfolio->portfolio_name}}</td>
                                        <td>{{$singlePortfolio->portfolio_title}}</td>
                                        <td><img src="{{asset($singlePortfolio->portfolio_image)}}" width="60px" height="50px"></td>
                                        <td>
                                            <a href="{{route('edit.multi.image',$singleImage->id)}}" class="btn btn-info sm"><i class="fas fa-edit"></i></a>

                                            <a href="{{route('delete.multi.image',$singleImage->id)}}" class="btn btn-danger delete sm"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div>
@endsection
