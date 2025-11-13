@extends('admin.layouts.app')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-0">Edit Product</h4>
                </div>
            </div>
        </div>
    </div>
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    <div class="product-list ">
        <div class="card">
            <div class="card-body p-3">
                <form action="{{ route('products.update', $product->productId) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="image" class="form-label">Product Name</label>
                                <input type="text" name="name" value="{{ $product->productName }}"
                                    placeholder="Enter product name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Product Category</label>
                                <select name="category_id" class="form-control" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->catId }}" {{ $product->catId == $cat->catId ? 'selected' : '' }}>
                                            {{ $cat->catName }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Product Description</label>
                                <textarea name="description" placeholder="Enter product description" class="form-control"
                                    rows="2">{{ old('description', $product->description) }}</textarea>

                            </div>

                            <div class="mb-3">
                                <div class=" mb-3">
                                    <label for="image" class="form-label">Product Image</label>
                                    <input hidden type="text" name="image" accept="image/*" class="form-control" id="image">
                                    <div class="dropzone dz-clickable mb-2 flex-wrap" id="myDropzone">
                                        <div class="dz-default dz-message"><button class="dz-button" type="button">Drop
                                                files
                                                here or click to
                                                upload</button></div>
                                    </div>
                                </div>
                                <div class=" d-flex justify-content-center align-items-center">
                                    @if (!empty($cat->catImg))
                                        <img src="{{ asset('uploads/products/' . $product->productImg) }}" alt="Product Image"
                                            class="rounded" width="150" height="150" style="object-fit: cover;">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" id="priceForm">
                            <label for="image" class="form-label">Pricing</label>
                            @foreach ($unitPrices as $un)
                                <div class="repeater">
                                    <div data-repeater-list="prices">
                                        <div data-repeater-item class="row mb-2" data-priceId = {{ $un['priceId'] }}>
                                            <div class="col-md-5">
                                                <select name="unit_id" class="form-control" required>
                                                    <option value="">Select Unit</option>
                                                    @foreach ($units as $unit)
                                                        <option value="{{ $unit->unitId }}" 
                                                        {{ $un['unitId'] == $unit->unitId ? 'selected' : '' }}>
                                                        {{ $unit->unitName }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-5">
                                                <input type="number" name="price" class="form-control" placeholder="Enter price"
                                                     value="{{ $un['price'] }}">
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" data-repeater-delete class="btn btn-danger">✕</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="repeater">
                                <div data-repeater-list="prices">
                                    <div data-repeater-item class="row mb-2" >
                                        <div class="col-md-5">
                                            <select name="unit_id" class="form-control" >
                                                <option value="">Select Unit</option>
                                                @foreach ($units as $unit)
                                                    <option value="{{ $unit->unitId }}">{{ $unit->unitName }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="number" name="price" class="form-control" placeholder="Enter price"
                                                >
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" data-repeater-delete class="btn btn-danger" >✕</button>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" data-repeater-create class="btn btn-primary mt-2" >+ Add</button>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <button type="button" class="btn btn-secondary">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('customJs')
    <script>
        $('.repeater').repeater({
            initEmpty: false,
            show: function () {
                $(this).slideDown();
            },
            hide: function (deleteElement) {
                let self = this; 
                if (confirm('Are you sure you want to delete this?')) {
                    let priceId = $(self).attr('data-priceId');
                    if (priceId) {
                        $.ajax({
                            url: "{{ route('products.updatePrice') }}",
                            type: "POST",
                            dataType: "json",
                            data: {
                                id: priceId,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function (response) {
                                if (response.success) {
                                    Swal.fire("Deleted!", response.message, "success").then(() => {
                                        $(self).slideUp(deleteElement);
                                    });
                                } else {
                                    Swal.fire("Error!", "Something went wrong. Please try again.", "error");
                                }
                            },
                            error: function (xhr, status, error) {
                                Swal.fire("Error!", "Something went wrong. Please try again.", "error");
                                console.error("AJAX Error:", error);
                            },
                        });
                    } else {
                        $(self).slideUp(deleteElement);
                    }
                }
            }
        });



        Dropzone.autoDiscover = false;
        const myDropzone = new Dropzone("#myDropzone", {
            url: "{{ route('temp-image.create') }}",
            paramName: "image",
            addRemoveLinks: true,
            dictDefaultMessage: "Drop files here or click to upload",
            autoProcessQueue: true,
            maxFiles: 1,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            init: function () {
                this.on("success", function (file, response) {
                    $('#image').val(response.imageId);
                });
            }
        });
    </script>
@endsection