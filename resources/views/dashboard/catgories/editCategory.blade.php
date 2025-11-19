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
            <form action="{{route('updateCategory',$category->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <h4 class="text-black">Add Category</h4>
                <div class="row">
                    <div class="col-lg-6 mt-3">
                        <label>Enter category name</label>
                        <input class="form-control" id="name" type="text" name="name" value="{{ old('name', $category->name ?? '') }}">
                    </div>
                    <div class="col-lg-6 mt-3">
                        <label>Enter Slug</label>
                        <input class="form-control" id="slug" type="text" name="slug" value="{{ old('slug', $category->slug ?? '') }}">
                    </div>

                    <div class="col-lg-12 mt-3">
                        <label>Enter Category image</label>
                        <input class="form-control" type="file" id="image" name="image">

                        <div class="mt-2">
                            @if(!empty($category->image))
                                <!-- Agar old image hai to show karo -->
                                <img id="preview" src="{{ asset($category->image) }}"
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
                        <label for="">Enter Category Description</label>
                        <textarea name="description" cols="5" rows="5" placeholder="Enter Description" class="form-control">{{ old('description', $category->description ?? '') }}</textarea>
                    </div>

                    <div class="col-lg-9 mt-3">
                        <button class="btn btn-sm bg-info" type="submit">
                            <i class="fa-solid fa-floppy-disk"></i> Update
                        </button>
                    </div>
                </div>
            </form>
            <hr class="m-t-3 m-b-3">
        </div>
    </div>
</div>
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
