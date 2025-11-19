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
                        <h4 class="text-black">Product Table</h4>
                        <a href="{{route('addProduct')}}" class="btn btn-sm btn-warning">Add Product</a>
                    </div>
                    <p></p>
                    <div class="table-responsive">

                        <div class="card m-t-3">
                            <div class="card-body">
                                <h5>All Product</h5>
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Product Name</th>
                                                <th>Slug</th>
                                                <th>Description</th>
                                                <th>Category</th>
                                                <th>Sub Category</th>
                                                <th>Size</th>
                                                <th>Colors</th>
                                                <th>Images</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($product as $item )
                                            <tr>
                                                <td>{{$item->pName}}</td>
                                                <td>{{$item->slug}}</td>
                                                <td>{!! $item->description !!}</td>
                                                <td>{{$item->category->name}}</td>
                                                <td>{{$item->subCategory->name}}</td>
                                                <td>
                                                    @if($item->sizes)
                                                        @foreach(json_decode($item->sizes, true) as $size)
                                                            <span class="badge bg-primary">{{ $size }}</span>
                                                        @endforeach
                                                    @endif
                                                </td>

                                                <td>
                                                    @if($item->colors)
                                                        @foreach(json_decode($item->colors, true) as $color)
                                                            <span style="display:inline-block;width:20px;height:20px;background:{{ $color }};border:1px solid #000;border-radius:4px;margin-right:5px;"></span>
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td>
                                                    @php
                                                        $images = json_decode($item->images, true);
                                                    @endphp

                                                    @if(!empty($images))
                                                        <div style="display:flex; flex-wrap:nowrap; gap:5px; overflow-x:auto; max-width:250px;">
                                                            @foreach($images as $group)
                                                                @foreach($group as $img)
                                                                    <img src="{{ asset('uploads/products/'.$img) }}"
                                                                         alt="product image"
                                                                         width="50"
                                                                         height="50"
                                                                         style="border-radius:5px; flex:0 0 auto;">
                                                                @endforeach
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        No Images
                                                    @endif
                                                </td>




                                                <td>
                                                    <div class="d-flex g-2">
                                                        <form action="{{route('editProduct',$item->id)}}" method="get">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-info">Edit</button>
                                                        </form>
                                                        <form action="{{route('detailProduct',$item->id)}}" method="get">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-light">Details</button>
                                                        </form>
                                                        <form action="{{route('deleteProduct',$item->id)}}" method="post">
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
                    confirmButtonText: "Delete "
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // ✅ Form ko submit karo, route sahi chalega
                    }
                });
            });
        });
    </script>


    @endsection
