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
            background: white;
            border: 1px solid red;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            text-align: center;
            line-height: 23px;
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
                    <form action="{{route('updateProduct',$product->id)}}" method="post" enctype="multipart/form-data" id="productForm">
                        @csrf
                        @method('put')
                        <h4 class="text-black">Update Product</h4>
                        <div class="row">
                            <div class="col-lg-6 mt-3">
                                <label>Product Name</label>
                                <input class="form-control" placeholder="Enter product name" id="name" type="text"
                                    name="name" value="{{ $product->pName }}">
                            </div>
                            <div class="col-lg-6 mt-3">
                                <label>Slug</label>
                                <input class="form-control" id="slug" type="text" name="slug"
                                    value="{{ $product->slug }}">
                            </div>
                            <div class="col-lg-6 mt-3">
                                <select name="category_id" id="category" class="form-control">
                                    <option value="">Select Category</option>
                                    @foreach ($category as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $item->id == $product->category_id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-6 mt-3">
                                <select name="subCategory_id" id="subcategory" class="form-control rounded-3 shadow-sm">
                                    <option value="">Select Subcategory</option>
                                    @foreach ($subCategory as $subcat)
                                        <option value="{{ $subcat->id }}"
                                            {{ $subcat->id == $product->subCategory_id ? 'selected' : '' }}>
                                            {{ $subcat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-6 mt-3">
                                <label>Price</label>
                                <input class="form-control" placeholder="Enter product price" id="price" type="number"
                                    name="price" value="{{ $product->price }}">
                            </div>
                            <div class="col-lg-6 mt-3">
                                <label>Stock</label>
                                <input class="form-control" placeholder="Enter stock" id="stock" type="number"
                                    name="stock" value="{{ $product->stock }}">
                            </div>

                            @php
                                $selectedSizes = json_decode($product->sizes, true) ?? [];
                            @endphp

                            <div class="col-lg-6 mt-3">
                                <label>Size</label><br>
                                <input type="checkbox" name="size[]" value="S" class="me-2"
                                    {{ in_array('S', $selectedSizes) ? 'checked' : '' }}> Small
                                <input type="checkbox" name="size[]" value="M" class="me-2"
                                    {{ in_array('M', $selectedSizes) ? 'checked' : '' }}> Medium
                                <input type="checkbox" name="size[]" value="L" class="me-2"
                                    {{ in_array('L', $selectedSizes) ? 'checked' : '' }}> Large
                                <input type="checkbox" name="size[]" value="XL" class="me-2"
                                    {{ in_array('XL', $selectedSizes) ? 'checked' : '' }}> XL
                            </div>

                            <div class="col-lg-12 mt-3">
                                <label>Description</label>
                                <textarea id="summernote" name="description">{!! $product->description !!}</textarea>
                            </div>

                            @php
                                $colors = json_decode($product->colors, true) ?? [];
                                $images = json_decode($product->images, true) ?? [];
                            @endphp

                            <div class="col-lg-12 mt-4">
                                <h5>Product Colors & Images</h5>
                                <button type="button" class="btn btn-primary mb-3" id="addColorImage">
                                    + Add Color & Image
                                </button>
                                <div id="colorImageContainer">
                                    @foreach ($colors as $index => $color)
                                        <div class="color-image-block" data-index="{{ $index }}">
                                            <span class="remove-block">X</span>
                                            <div class="form-group">
                                                <label>Select Color</label>
                                                <div style="display:flex;align-items:center;gap:10px;">
                                                    <div class="color-box" id="colorBox-{{ $index }}" style="background: {{ $color }}"></div>
                                                    <input type="text" class="form-control" id="colorName-{{ $index }}" value="{{ $color }}" readonly>
                                                    <input type="hidden" name="colors[{{ $index }}]" id="colorValue-{{ $index }}" value="{{ $color }}">
                                                </div>
                                            </div>
                                            <div class="form-group mt-2">
                                                <label>Upload Images</label>
                                                <input type="file" multiple class="form-control color-files" name="images[{{ $index }}][]" data-index="{{ $index }}">
                                                <div class="preview-container" id="preview-{{ $index }}">
                                                    @if(isset($images[$index]))
                                                        @foreach($images[$index] as $imgIndex => $img)
                                                            <div class="preview-image-wrapper">
                                                                <img src="{{ asset('uploads/products/' . $img) }}" width="80" height="80">
                                                                <span class="remove-image" onclick="removeExistingImage(this, '{{ $img }}')">X</span>
                                                                <input type="hidden" name="old_images[{{ $index }}][]" value="{{ $img }}">
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-lg-9 mt-3">
                                <button class="btn btn-sm bg-info" type="submit">
                                    <i class="fa-solid fa-floppy-disk"></i> Update Product
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let blockIndex = {{ count($colors) ?? 0 }};

            function initPickr(index, defaultColor = "#000000") {
                const pickr = Pickr.create({
                    el: '#colorBox-' + index,
                    theme: 'classic',
                    default: defaultColor,
                    components: {
                        preview: true, opacity: true, hue: true,
                        interaction: { hex: true, rgba: true, input: true, save: true }
                    }
                });
                pickr.on('save', color => {
                    let hex = color.toHEXA().toString().toUpperCase();
                    $("#colorBox-" + index).css("background", hex);
                    $("#colorName-" + index).val(hex);
                    $("#colorValue-" + index).val(hex);
                    pickr.hide();
                });
            }

            // Init existing pickrs
            @foreach($colors as $i => $c)
                initPickr({{ $i }}, "{{ $c }}");
            @endforeach

            // Add new color block
            $("#addColorImage").on('click', function() {
                const currentIndex = blockIndex;
                const html = `
                <div class="color-image-block" data-index="${currentIndex}">
                    <span class="remove-block">X</span>
                    <div class="form-group">
                        <label>Select Color</label>
                        <div style="display:flex;align-items:center;gap:10px;">
                            <div class="color-box" id="colorBox-${currentIndex}" style="background:#000000"></div>
                            <input type="text" class="form-control" id="colorName-${currentIndex}" value="#000000" readonly>
                            <input type="hidden" name="colors[${currentIndex}]" id="colorValue-${currentIndex}" value="#000000">
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label>Upload Images</label>
                        <input type="file" multiple class="form-control color-files" name="images[${currentIndex}][]" data-index="${currentIndex}">
                        <div class="preview-container" id="preview-${currentIndex}"></div>
                    </div>
                </div>`;
                $("#colorImageContainer").append(html);
                initPickr(currentIndex, "#000000");
                blockIndex++;
            });

            // Remove color block
            $(document).on('click', '.remove-block', function() {
                $(this).closest('.color-image-block').remove();
            });

            // File preview (new images only)
            $(document).on('change', '.color-files', function(e) {
                const input = this;
                const $block = $(this).closest('.color-image-block');
                const $container = $block.find('.preview-container').first();

                // Reset only new previews
                $container.find('.preview-image-wrapper[data-new="1"]').remove();

                Array.from(input.files).forEach((file, idx) => {
                    const reader = new FileReader();
                    reader.onload = function(ev) {
                        $container.append(`
                            <div class="preview-image-wrapper" data-new="1" data-file-index="${idx}">
                                <img src="${ev.target.result}" width="80" height="80">
                                <span class="remove-image" data-new="1">X</span>
                            </div>
                        `);
                    };
                    reader.readAsDataURL(file);
                });
            });

            // Remove individual image
            $(document).on('click', '.remove-image', function() {
                const $wrapper = $(this).closest('.preview-image-wrapper');
                const isNew = $wrapper.attr('data-new') === '1';
                const $block = $(this).closest('.color-image-block');

                if (isNew) {
                    const fileInput = $block.find('.color-files')[0];
                    if (fileInput) {
                        const removeIndex = Number($wrapper.attr('data-file-index'));
                        const dt = new DataTransfer();
                        Array.from(fileInput.files).forEach((f, i) => {
                            if (i !== removeIndex) dt.items.add(f);
                        });
                        fileInput.files = dt.files;
                    }
                } else {
                    $wrapper.find('input[type="hidden"][name^="old_images"]').remove();
                }
                $wrapper.remove();
            });
        });
        </script>

@endsection