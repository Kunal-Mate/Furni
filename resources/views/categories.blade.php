@extends('layouts.app')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-0">Categories</h4>
                </div>
                <div class="col-3">
                    <div class="text-center">
                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Add" href="javascript:void(0)"><i
                                class="ti ti-plus"></i> Add New Category</a>
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
    <div class="product-list">
        <div class="card">
            <div class="card-body p-3">
                <table class="table align-middle text-nowrap mb-0 text-center">
                    <thead>
                        <tr>
                            <th scope="col">Sr.No</th>
                            <th scope="col">Image</th>
                            <th scope="col">Category Name</th>
                            <!-- <th scope="col">Status</th> -->
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($categories->isNotEmpty())
                            @foreach ($categories as $key => $cat)
                                <tr class="userRow">
                                    <td class="text-center">
                                        <h6 class="fw-semibold mb-0">
                                            {{ ($categories->currentPage() - 1) * $categories->perPage() + $key + 1 }}
                                        </h6>
                                    </td>
                                    <td class="text-center">
                                        @if (!empty($cat->catImg))
                                            <img src="{{ asset($cat->catImg) }}" alt="Category Image" class="rounded-circle" width="50"
                                                height="50" style="object-fit: cover;">
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <h6 class="fw-semibold mb-0">{{ $cat->catName }}</h6>
                                    </td>

                                    <td>
                                        <div class="dropdown">
                                            <a class="fs-6 text-muted" href="javascript:void(0)" data-bs-toggle="dropdown"
                                                aria-expanded="false" data-bs-placement="top" data-bs-title="Options">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item text-primary" data-bs-toggle="modal"
                                                        data-bs-target="#edit{{ $cat->catId }}" href="javascript:void(0)">
                                                        <i class="ti ti-pencil"></i> Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item text-danger sa-confirm" data-id="{{ $cat->catId }}"
                                                        data-name="{{ $cat->catName }}"><i class="ti ti-trash"></i> Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade" id="edit{{ $cat->catId }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">New Category</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form method="post" enctype="multipart/form-data"
                                                action="{{ route('cate.update', $cat->catId) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Name</label>
                                                        <input type="text" name="name" value="{{ old('name', $cat->catName) }}"
                                                            class="form-control @error('name') is-invalid @enderror">
                                                        @error('name')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                        <input type="hidden" name="id" value="{{ $cat->catId }}">
                                                    </div>


                                                    <div class="mb-3">
                                                        <label for="image" class="form-label">Image</label>
                                                        <input hidden type="text" name="image" id="image-{{ $cat->catId }}"
                                                            value="{{ old('image', $cat->catImg) }}"
                                                            class="form-control @error('image') is-invalid @enderror">
                                                        @error('image')
                                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                                        @enderror

                                                        <div class="dropzone dz-clickable mb-2 flex-wrap"
                                                            id="dropzone-{{ $cat->catId }}" data-cat-id="{{ $cat->catId }}">
                                                            <div class="dz-default dz-message">
                                                                <button class="dz-button" type="button">Drop files here or click to
                                                                    upload</button>
                                                            </div>
                                                        </div>
                                                        @if (!empty($cat->catImg))
                                                            <img src="{{ asset($cat->catImg) }}" alt="Category Image"
                                                                class="rounded-circle" width="250" height="250"
                                                                style="object-fit: cover;">
                                                        @else
                                                            <span class="text-muted">No Image</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">No</button>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
                {{ $categories->links() }}
            </div>
        </div>


        <div class="modal fade" id="Add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" enctype="multipart/form-data" id="categoryForm" name="categoryForm">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control" aria-describedby="emailHelp">
                                <p></p>
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input hidden type="text" name="image" class="form-control" id="image">
                                <div class="dropzone dz-clickable mb-2 flex-wrap" id="myDropzone">
                                    <div class="dz-default dz-message"><button class="dz-button" type="button">Drop files
                                            here or click to
                                            upload</button></div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('customJs')
    <script>
        Dropzone.autoDiscover = false;

        // Add New Category Dropzone
        document.addEventListener("DOMContentLoaded", function () {
            if (document.querySelector("#myDropzone")) {
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
            }

            // Edit Modals Dropzones
            $('.dropzone[data-cat-id]').each(function () {
                const catId = $(this).data('cat-id');
                const dropzoneId = `#dropzone-${catId}`;
                const inputId = `#image-${catId}`;

                const myDropzone = new Dropzone(dropzoneId, {
                    url: "{{ route('temp-image.create') }}",
                    paramName: "image",
                    addRemoveLinks: true,
                    dictDefaultMessage: "Drop files here or click to upload",
                    autoProcessQueue: true,
                    maxFiles: 1,
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    init: function () {
                        this.on("success", function (file, response) {
                            $(inputId).val(response.imageId);
                        });
                    }
                });
            });
        });

        // Delete Category
        $(document).on("click", ".sa-confirm", function () {
            const Id = $(this).data("id");
            const Name = $(this).data("name");
            Swal.fire({
                title: "Are you sure?",
                text: `You want to delete '${Name}' Category!`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('cate.delete') }}",
                        type: "POST",
                        dataType: "json",
                        data: { id: Id },
                        success: function (response) {
                            if (response.status) {
                                Swal.fire("Deleted!", response.message, "success").then(() => {
                                    $(`.sa-confirm[data-id='${Id}']`).closest(".userRow").remove();
                                    setTimeout(() => location.reload(), 800);
                                });
                            } else {
                                Swal.fire("Error!", "Something went wrong. Please try again.", "error");
                            }
                        },
                        error: function (xhr, status, error) {
                            Swal.fire("Error!", "Something went wrong. Please try again.", "error");
                            console.error("AJAX Error:", error);
                        }
                    });
                }
            });
        });

        // Add Category Form Submit (AJAX)
        $('#categoryForm').submit(function (event) {
            event.preventDefault();
            const form = this;
            const formData = new FormData(form);
            $.ajax({
                url: "{{ route('cate.store') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function (response) {
                    if (response.status) {
                        Swal.fire("Success!", response.message, "success").then(() => {
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
                error: function () {
                    Swal.fire("Error!", "AJAX request failed. Please try again.", "error");
                }
            });
        });
    </script>
@endsection