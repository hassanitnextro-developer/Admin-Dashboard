@extends('dashboard.layouts.main')
@section('content')
<style>
    .content-wrapper{
        margin-top: 58px;
    }
</style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <div class="content">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="text-black">SubCategory Table</h4>
                        <a href="{{route('showSub')}}" class="btn btn-sm btn-warning">Add SubCategory</a>
                    </div>
                    <p></p>
                    <div class="table-responsive">

                        <div class="card m-t-3">
                            <div class="card-body">
                                <h5>All SubCategories</h5>
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>SubCategory</th>
                                                <th>Slug</th>
                                                <th>Image</th>
                                                <th>Description</th>
                                                <th>Category</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($subCategory as $item )
                                            <tr>
                                                <td>{{$item->name}}</td>
                                                <td>{{$item->slug}}</td>
                                                <td><img src="{{asset($item->image)}}" alt="" height="60" width="60"></td>
                                                <td>{{$item->description}}</td>
                                                <td>{{$item->category->name}}</td>
                                                <td>
                                                    <div class="d-flex g-2">
                                                        <form action="{{route('editSub',$item->id)}}" method="get">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-info">Edit</button>
                                                        </form>
                                                        <form action="{{route('deleteSub',$item->id)}}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="btn btn-sm btn-danger delete-btn" type="submit">Delete</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.content -->
                </div>
            </div>
        </div> <!-- /.content-wrapper -->
    </div>
    <script>
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault(); // Form submit rokna
                let form = this.closest('form'); // Button ka parent form lo

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // ✅ Form ko submit karo, route sahi chalega
                    }
                });
            });
        });
    </script>


    @endsection
