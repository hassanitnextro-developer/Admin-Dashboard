@extends('dashboard.layouts.main')
@section('content')
<style>
    .content-wrapper {
        margin-top: 70px;
        padding: 10px;
    }
</style>
<div class="content-wrapper">
<div class="content">
    <div class="card">
        <div class="card-body">
            <form action="{{route('updateSub',$subCat->id)}}" method="post" enctype="multipart/form-data" >
                @csrf
                @method('put')
            <h4 class="text-black">Update SubCategaory</h4>
            <div class="row">
                <div class="col-lg-12 mt-3">
                    <select name="category_id" id="" class="form-control">
                        <option value="">Select Category</option>
                        @foreach ($category as $item)
                            <option value="{{ $item->id }}" {{ $item->id == $subCat->category_id ? 'selected' : '' }}>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-6 mt-3">
                    <label>SubCategory name</label>
                    <input class="form-control" placeholder="Enter SubCategory name" id="name" type="text" name="name" value="{{$subCat->name}}" >
                </div>
                <div class="col-lg-6 mt-3">
                    <label>Slug</label>
                    <input class="form-control" id="slug" type="text" name="slug" value="{{$subCat->slug}}">
                </div>
                <div class="col-lg-12 mt-3">
                    <label>Enter Category image</label>
                    <input class="form-control" type="file" id="image" name="image">

                    <div class="mt-2">
                        @if(!empty($subCat->image))
                            <!-- Agar old image hai to show karo -->
                            <img id="preview" src="{{ asset($subCat->image) }}"
                                 alt="Image Preview"
                                 style="width: 120px; height: 120px; object-fit: cover; border:1px solid #ccc; border-radius: 8px;">
                        @else
                            <!-- Agar image nahi hai to hide karo -->
                            <img id="preview" src=""
                                 alt="Image Preview"
                                 style="display:none; width: 120px; height: 120px; object-fit: cover; border:1px solid #ccc; border-radius: 8px;">
                        @endif
                    </div>
                </div>
                <div class="col-lg-12 mt-3">
                    <label for="">SubCategory Description</label>
                    <textarea name="description" id="" cols="5" rows="5" placeholder="Enter Description" class="form-control">{{$subCat->description}}</textarea>
                </div>
                <div class="col-lg-9 mt-3">
                    <button class="btn btn-sm bg-info" type="submit"><i class="fa-solid fa-floppy-disk"></i>Update SubCategory</button>
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
<script>
    document.getElementById('image').addEventListener('change', function(event) {
        let preview = document.getElementById('preview');
        let file = event.target.files[0];

        if(file){
            let reader = new FileReader();
            reader.onload = function(e){
                preview.style.display = "block";
                preview.src = e.target.result; // nayi image ka preview
            }
            reader.readAsDataURL(file);
        } else {
            preview.style.display = "none";
            preview.src = "";
        }
    });

    document.getElementById('name').addEventListener('keyup', function () {
        let name = this.value;
        let slug = name
            .toLowerCase()
            .replace(/ /g, '-')
            .replace(/[^\w-]+/g, '');

        document.getElementById('slug').value = slug;
    });
</script>

@endsection