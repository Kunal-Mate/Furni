@extends('admin.layouts.app')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-0">Products</h4>
                </div>
                <div class="col-3">
                    <div class="text-center">
                        <a class="btn btn-primary" href="{{ route('products.create') }}">
                            <i class="ti ti-plus"></i> Add New Product</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
            <strong>{{ session('error') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
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
        <form method="GET" action="{{ route('products.index') }}" class="row g-2 mb-3 align-items-end justify-content-end ">
            <div class="col-md-3">
                <label for="productName" class="form-label mb-0">Product Name</label>
                <input type="text" class="form-control" id="productName" name="productName"
                    value="{{ request('productName') }}" placeholder="Search by product name">
            </div>
            <div class="col-md-3">
                <label for="category_id" class="form-label mb-0">Category</label>
                <select class="form-select" id="category_id" name="category_id">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->catId }}" {{ request('category_id') == $cat->catId ? 'selected' : '' }}>
                            {{ $cat->catName }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
            <div class="col-md-1">
                <a href="{{ route('products.index') }}" class="btn btn-secondary w-100">Reset</a>
            </div>
        </form>
        <div class="card">
            <div class="card-body p-3">
                <table class="table align-middle text-nowrap mb-0 text-center">
                    <thead>
                        <tr>
                            <th scope="col">Sr.No</th>
                            <th scope="col">Image</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($products->isNotEmpty())
                            @foreach ($products as $key => $pro)
                                <tr class="userRow">
                                    <td class="text-center">
                                        <h6 class="fw-semibold mb-0">
                                            {{ ($products->currentPage() - 1) * $products->perPage() + $key + 1 }}
                                        </h6>
                                    </td>
                                    <td class="text-center">
                                        @if (!empty($pro->productImg))
                                            <img src="{{ asset('uploads/products/' . $pro->productImg) }}" alt="products Image"
                                                class="rounded-circle" width="50" height="50" style="object-fit: cover;">
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <h6 class="fw-semibold mb-0">{{ $pro->productName }}</h6>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center gap-2">
                                            <span class="badge bg-success fw-semibold">{{ $pro->category?->catName }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a class="fs-6 text-muted" href="javascript:void(0)" data-bs-toggle="dropdown"
                                                aria-expanded="false" data-bs-placement="top" data-bs-title="Options">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item text-primary"
                                                        href="{{ route('products.show', $pro->productId) }}">
                                                        <i class="ti ti-eye"></i> View
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item text-primary"
                                                        href="{{ route('products.edit', $pro->productId) }}">
                                                        <i class="ti ti-pencil"></i> Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item text-danger sa-confirm" data-id="{{ $pro->productId }}"
                                                        data-name="{{ $pro->productName }}"><i class="ti ti-trash"></i> Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5"> No Data Found !</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-body-secondary">
                {{ $products->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection

@section('customJs')
    <script>
        $(document).on("click", ".sa-confirm", function () {
            const Id = $(this).data("id");
            const Name = $(this).data("name");
            Swal.fire({
                title: "Are you sure?",
                text: `You want to delete '${Name}' Product!`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('products.delete') }}",
                        type: "POST",
                        dataType: "json",
                        data: {
                            id: Id,
                        },
                        success: function (response) {
                            if (response.success) {
                                Swal.fire("Deleted!", response.message, "success").then(() => {
                                    $(`.sa-confirm[data-id='${Id}']`).closest(".userRow").remove();
                                    setTimeout(function () {
                                        location.reload();
                                    }, 1000);
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
                }
            });
        });


        $('#categoryForm').submit(function (event) {
            event.preventDefault();
            var form = this;
            var formData = new FormData(form);
            $.ajax({
                url: "{{ route('cate.store') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function (response) {
                    if (response["status"] == true) {
                        Swal.fire("Success!", response['message'], "success").then(() => {
                            $(form).closest('.modal').modal('hide');
                            location.reload();
                        });
                    } else {
                        $('#categoryForm .form-control').removeClass('is-invalid');
                        $('#categoryForm .invalid-feedback').remove();
                        if (response.errors) {
                            $.each(response.errors, function (field, messages) {
                                const input = $(`[name="${field}"]`);
                                input.addClass('is-invalid');
                                input.siblings('p').remove();
                                input.after(`<p class="invalid-feedback">${messages[0]}</p>`);
                            });
                        }
                    }
                },
                error: function (jqXHR, exception) {
                    console.log('something went wrong.');
                    Swal.fire("Error!", "AJAX request failed. Please try again.", "error");
                }
            });
        });

        //   $("#name").change(function (params) {
        //     var element = $(this);
        //     $.ajax({
        //         url: "{{ route('getSlug') }}",
        //         type: "get",
        //         data: { 'title': element.val() },
        //         dataType: "json",
        //         success: function (response) {
        //             if (response["status"] == true) {
        //                 $('#slug').val(response["slug"]);
        //                 $('#slug').removeClass('is-invalid')
        //                     .siblings('p')
        //                     .removeClass('invalid-feedback')
        //                     .html("");

        //             }
        //         },
        //         error: function (jqXHR, exception) {
        //             console.log('something went wrong.');
        //             Swal.fire("Error!", "AJAX request failed. Please try again.", "error");
        //         }
        //     });
        // })
    </script>
@endsection