@extends('dashboard.layouts.main')
@section('content')
<style>
    .content-wrapper {
        margin-top: 70px;
        padding: 10px;
    }
    .color-image-block {
        border: 1px solid #ddd;
        padding: 15px;
        margin-bottom: 15px;
        border-radius: 8px;
        background: #f9f9f9;
        position: relative;
    }
    .remove-block {
        position: absolute;
        top: 5px;
        right: 10px;
        cursor: pointer;
        color: red;
        font-weight: bold;
    }
    .color-box {
        width: 40px;
        height: 40px;
        border: 1px solid #ccc;
        border-radius: 5px;
        cursor: pointer;
    }
    .preview-container {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 10px;
    }
    .preview-image-wrapper {
        position: relative;
        display: inline-block;
    }
    .preview-image-wrapper img {
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    .preview-image-wrapper .remove-image {
        position: absolute;
        top: -5px;
        right: -5px;
        background: red;
        color: white;
        border-radius: 50%;
        width: 18px;
        height: 18px;
        text-align: center;
        line-height: 18px;
        font-size: 12px;
        cursor: pointer;
    }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css" />
<script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr"></script>

<div class="content-wrapper">
    <div class="content">
        <div class="card">
            <div class="card-body">
                <form action="{{route('storeProduct')}}" method="POST" enctype="multipart/form-data" id="productForm">
                    @csrf
                    <h4 class="text-black">Add Product</h4>
                    <div class="row">
                        <div class="col-lg-6 mt-3">
                            <label>Product Name</label>
                            <input class="form-control" placeholder="Enter product name" id="name" type="text" name="name">
                        </div>
                        <div class="col-lg-6 mt-3">
                            <label>Slug</label>
                            <input class="form-control" id="slug" type="text" name="slug">
                        </div>
                        <div class="col-lg-6 mt-3">
                            <select name="category_id" id="category" class="form-control">
                                <option value="">Select Category</option>
                                @foreach ($category as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6 mt-3">
                            <select name="subCategory_id" id="subCategory" class="form-control">
                                <option value="">Select SubCategory</option>
                            </select>
                        </div>
                        <div class="col-lg-6 mt-3">
                            <label>Price</label>
                            <input class="form-control" placeholder="Enter product price" id="price" type="number" name="price">
                        </div>
                        <div class="col-lg-6 mt-3">
                            <label>Stock</label>
                            <input class="form-control" placeholder="Enter stock" id="stock" type="number" name="stock">
                        </div>
                        <div class="col-lg-6 mt-3">
                            <label>Size</label><br>
                            <input type="checkbox" name="size[]" value="S" class="me-2"> Small
                            <input type="checkbox" name="size[]" value="M"> Medium
                            <input type="checkbox" name="size[]" value="L"> Large
                            <input type="checkbox" name="size[]" value="XL"> XL
                        </div>
                        <div class="col-lg-12 mt-3">
                            <label>Description</label>
                            <textarea id="summernote" name="description"></textarea>
                        </div>

                        <!-- Add Colors & Images Section -->
                        <div class="col-lg-12 mt-4">
                            <h5>Product Colors & Images</h5>
                            <button type="button" class="btn btn-primary mb-3" id="addColorImage">
                                + Add Color & Image
                            </button>
                            <div id="colorImageContainer"></div>
                        </div>

                        <div class="col-lg-9 mt-3">
                            <button class="btn btn-sm bg-info" type="submit">
                                <i class="fa-solid fa-floppy-disk"></i> Add Product
                            </button>
                        </div>
                    </div>
                </form>
                <hr class="m-t-3 m-b-3">
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
const categorySelect=document.getElementById('category');
const SubcategorySelect=document.getElementById('subCategory');
categorySelect.addEventListener('change',async function(){
    const category_id=this.value;
    if(category_id==''){
        SubcategorySelect.innerHTML='<option value="">Select SubCategory</option>';
        return;
    }
    const route = "{{ route('filterSub') }}"; // Blade generates full URL
    const res = await fetch(`${route}?category_id=${category_id}`);
    const data=await res.json();
    let options='<option value="">Select SubCategory</option>';
    data.subCategories.forEach(sub=>{
        options+=`<option value="${sub.id}">${sub.name}</option>`;
    })
    SubcategorySelect.innerHTML=options;
})




</script>








<script>
$(document).ready(function () {
    let blockIndex = 0;
    let filesArray = {}; // track files per color block

    $("#addColorImage").click(function () {
        let currentIndex = blockIndex;
        filesArray[currentIndex] = [];

        let html = `
        <div class="color-image-block">
            <span class="remove-block">X</span>
            <div class="form-group">
                <label>Select Color</label>
                <div style="display:flex;align-items:center;gap:10px;">
                    <div class="color-box" id="colorBox-${currentIndex}"></div>
                    <input type="text" class="form-control" id="colorName-${currentIndex}" value="#000000" readonly>
                    <input type="hidden" name="colors[${currentIndex}]" id="colorValue-${currentIndex}" value="#000000">
                </div>
            </div>
            <div class="form-group mt-2">
                <label>Upload Images</label>
                <input type="file" multiple class="form-control color-files" name="images[${currentIndex}][]" data-index="${currentIndex}">
                <div class="preview-container"></div>
            </div>
        </div>`;

        $("#colorImageContainer").append(html);

        // Initialize color picker
        const pickr = Pickr.create({
            el: '#colorBox-' + currentIndex,
            theme: 'classic',
            default: '#000000',
            components: {
                preview: true,
                opacity: true,
                hue: true,
                interaction: { hex: true, rgba: true, input: true, save: true }
            }
        });

        pickr.on('change', (color) => {
            let hex = color.toHEXA().toString().toUpperCase();
            $("#colorBox-" + currentIndex).css("background", hex);
            $("#colorName-" + currentIndex).val(hex);
            $("#colorValue-" + currentIndex).val(hex);
        });

        pickr.on('save', (color) => {
            let hex = color.toHEXA().toString().toUpperCase();
            $("#colorBox-" + currentIndex).css("background", hex);
            $("#colorName-" + currentIndex).val(hex);
            $("#colorValue-" + currentIndex).val(hex);
            pickr.hide();
        });

        blockIndex++;
    });

    // Remove color block
    $(document).on("click", ".remove-block", function () {
        let parentIndex = $(this).siblings('.form-group').find('.color-box').attr('id').split('-')[1];
        delete filesArray[parentIndex];
        $(this).parent(".color-image-block").remove();
    });

    // Image preview & sync
    $(document).on('change', '.color-files', function(e) {
        let index = $(this).data('index');
        let container = $(this).siblings('.preview-container');
        let inputFiles = Array.from(this.files);

        // merge new files
        filesArray[index] = filesArray[index].concat(inputFiles);
        container.html(''); // clear old preview

        filesArray[index].forEach((file, i) => {
            const reader = new FileReader();
            reader.onload = function(event) {
                const imgHtml = `<div class="preview-image-wrapper" data-index="${i}">
                                    <img src="${event.target.result}" width="80" height="80">
                                    <span class="remove-image">X</span>
                                </div>`;
                container.append(imgHtml);
            }
            reader.readAsDataURL(file);
        });

        // rebuild the input files
        let dt = new DataTransfer();
        filesArray[index].forEach(file => dt.items.add(file));
        this.files = dt.files;
    });

    // Remove individual image
    $(document).on('click', '.remove-image', function() {
        let block = $(this).closest('.color-image-block');
        let index = block.find('.color-files').data('index');
        let imgIndex = $(this).parent().data('index');

        filesArray[index].splice(imgIndex, 1);
        $(this).parent().remove();

        let fileInput = block.find('.color-files')[0];
        let dt = new DataTransfer();
        filesArray[index].forEach(file => dt.items.add(file));
        fileInput.files = dt.files;
    });
});
</script>
@endsection
