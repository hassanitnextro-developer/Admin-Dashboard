@extends('dashboard.layouts.main')
@section('content')
<style>
    .container {
        margin-top: 100px;
        margin-left: 300px;
        padding: 10px;
        width: 1000px;
        min-height: calc(100vh - 200px);
    }
    .main-frame {
        width: 100%;
        height: 400px;
        border: 1px solid #ddd;
        border-radius: 10px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f9f9f9;
    }
    .main-img {
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
    }
    .thumb-img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        cursor: pointer;
        margin: 5px;
        border: 2px solid transparent;
        border-radius: 5px;
    }
    .thumb-img.active { border: 2px solid #000; }
    .color-circle {
        display: inline-block;
        width: 30px; height: 30px;
        border-radius: 50%;
        cursor: pointer;
        border: 2px solid #ccc;
        margin-right: 5px;
    }
</style>

<div class="container">
    <div class="card shadow p-3">
        <div class="row">
            <!-- Left Side Images -->
            <div class="col-md-6 text-center">
                <div class="main-frame mb-3">
                    <img id="mainImage" class="main-img" src="" alt="Product Image">
                </div>
                <div id="thumbnails" class="d-flex justify-content-center flex-wrap"></div>
            </div>

            <!-- Right Side Details -->
            <div class="col-md-6">
                <h1>{{ $product->pName }}</h1>
                <p><strong>Category:</strong> {{ $product->category->name }} → {{ $product->subCategory->name }}</p>

                <p><strong>Sizes:</strong>
                    @if ($product->sizes)
                        @foreach (json_decode($product->sizes, true) as $size)
                            <span class="badge bg-primary">{{ $size }}</span>
                        @endforeach
                    @endif
                </p>
                <h5>
                <span class="mr-2"><strong>Price:</strong></span>
                <span class="mt-1">{{$product->price }}</span><br>
            </h5>
            <h6>
                <span><strong>Stock:</strong></span>
                <span class="badge bg-light" style="font-size: 19px">{{ $product->stock }}</span>
            </h6>
                <p><strong>Colors:</strong></p>
                <div id="colors" class="mb-3">
                    @if ($product->colors)
                        @foreach (json_decode($product->colors, true) as $color)
                            <span class="color-circle" data-index="{{ $loop->index }}" style="background:{{ $color }}"></span>
                        @endforeach
                    @endif
                </div>

                <p><strong>Description:</strong></p>
                <p>{!! $product->description !!}</p>
                <a href="{{route('indexProduct')}}" class="btn btn-sm btn-info">Back</a>
            </div>
        </div>
    </div>
</div>

<script>
    const productImages = @json(json_decode($product->images, true));
    // [["red1.jpg","red2.jpg"], ["blue1.jpg","blue2.jpg"]]
    const mainImage = document.getElementById("mainImage");
    const thumbnails = document.getElementById("thumbnails");
    const colorCircles = document.querySelectorAll(".color-circle");

    // Function to load images of a color
    function loadColorImages(index) {
        thumbnails.innerHTML = "";
        if (!productImages[index] || productImages[index].length === 0) {
            mainImage.src = "";
            return;
        }

        // Pehli image main banado
        mainImage.src = "{{ asset('uploads/products') }}/" + productImages[index][0];

        // Thumbnails generate
        productImages[index].forEach((img, i) => {
            let thumb = document.createElement("img");
            thumb.src = "{{ asset('uploads/products') }}/" + img;
            thumb.className = "thumb-img" + (i === 0 ? " active" : "");
            thumb.addEventListener("click", () => {
                document.querySelectorAll(".thumb-img").forEach(t => t.classList.remove("active"));
                thumb.classList.add("active");
                mainImage.src = "{{ asset('uploads/products') }}/" + img;
            });
            thumbnails.appendChild(thumb);
        });
    }

    // Default load: pehla color
    if (colorCircles.length > 0) {
        loadColorImages(0);
    }

    // On color click
    colorCircles.forEach((circle, idx) => {
        circle.addEventListener("click", function() {
            loadColorImages(idx);
        });
    });
</script>
@endsection
