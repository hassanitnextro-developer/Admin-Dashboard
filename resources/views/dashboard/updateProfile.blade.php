@extends('dashboard.layouts.main')
@section('content')
    <style>
        .content-wrapper {
            margin-top: 70px;
            padding: 10px;
        }
    </style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        {{-- <div class="content-header sty-two">
      <h1 class="text-white">Sinup Form</h1>
      <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li><i class="fa fa-angle-right"></i> <a href="#">Form</a></li>
        <li><i class="fa fa-angle-right"></i> Sinup Form</li>
      </ol>
    </div> --}}

        <!-- Main content -->
        <div class="content">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('update')}}" method="post" enctype="multipart/form-data" >
                        @csrf
                        @method('put')
                    <h4 class="text-black">Profile Setting</h4>
                    <div class="row">
                        <div class="col-lg-9 mt-3">
                            <label>Enter your name</label>
                            <input class="form-control" id="basicInput" type="text" name="name"  value="{{$data->name}}">
                        </div>
                        <div class="col-lg-9 mt-3">
                            <label>Enter your email</label>
                            <input class="form-control" id="basicInput" type="email" name="email" value="{{$data->email}}">
                        </div>
                        <div class="col-lg-9 mt-3">
                            <label>Enter your image</label>
                            <input class="form-control" id="basicInput" type="file" name="image">
                        </div>
                        <div class="col-lg-9 mt-3">
                            <label>Enter your password</label>
                            <input class="form-control" id="basicInput" type="password" placeholder="Enter your new password" name="password">
                        </div>
                        <div class="col-lg-9 mt-3">
                            <button class="btn btn-sm bg-info" type="submit"><i class="fa-solid fa-floppy-disk"></i>Save</button>
                        </div>
                    </div>
                </form>
                    <hr class="m-t-3 m-b-3">
                </div>
            </div>
            <!-- Main row -->
        </div>
        <!-- /.content -->
    </div>


@endSection
