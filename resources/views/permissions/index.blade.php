@extends('layouts.app') {{-- Make sure this includes Bootstrap --}}

@section('content')
    <div class="container-fluid px-5">
        <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-0">Permissions</h4>
                    </div>
                    <div class="col-3">
                        <div class="text-center">
                            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Add"
                                href="javascript:void(0)"><i class="ti ti-plus"></i> Add New Permission</a>
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
                                <th scope="col">Name</th>
                                <th scope="col">Created at</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($permissions->isNotEmpty())
                                @foreach ($permissions as $key => $us)
                                    <tr class="userRow">
                                        <td class="text-center">
                                            <h6 class="fw-semibold mb-0">
                                                {{ ($permissions->currentPage() - 1) * $permissions->perPage() + $key + 1 }}
                                            </h6>
                                        </td>
                                        <td class="text-center">
                                            <h6 class="fw-semibold mb-0">{{ $us->name }}</h6>
                                        </td>
                                        <td class="text-center">
                                            <p class="mb-0 fw-normal">{{ \Carbon\Carbon::parse($us->created_at)->format('d M, Y') }}
                                            </p>
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
                                                            data-bs-target="#edit{{ $us->id }}" href="javascript:void(0)">
                                                            <i class="ti ti-pencil"></i> Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item text-danger sa-confirm" data-id="{{ $us->id }}"
                                                            data-name="{{ $us->name }}"><i class="ti ti-trash"></i> Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="edit{{ $us->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">New Category</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form method="post" enctype="multipart/form-data"
                                                    action="{{ route('permissions.update', $us->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Name</label>
                                                            <input type="text" name="name" value="{{ old('name', $us->name) }}"
                                                                class="form-control @error('name') is-invalid @enderror">
                                                            @error('name')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                            <input type="hidden" name="id" value="{{ $us->id }}">
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
                <div class="card-footer text-body-secondary pb-0">
                    {{ $permissions->links() }}
                </div>
            </div>


            <div class="modal fade" id="Add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New Permission</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" enctype="multipart/form-data" id="PermissionForm" name="PermissionForm">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Permission Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        aria-describedby="emailHelp">
                                    <p></p>
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
    </div>
@endsection

@section('customJs')
    <script>
        $(document).on("click", ".sa-confirm", function () {
            const Id = $(this).data("id");
            const Name = $(this).data("name");
            Swal.fire({
                title: "Are you sure?",
                text: `You want to delete '${Name}' Permission!`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('permissions.delete') }}",
                        type: "delete",
                        dataType: "json",
                        data: {
                            id: Id
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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

        $('#PermissionForm').submit(function (event) {
            event.preventDefault();
            var form = this;
            var formData = new FormData(form);
            $.ajax({
                url: "{{ route('permissions.store') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function (response) {
                    if (response["success"] == true) {
                        Swal.fire("Success!", response['message'], "success").then(() => {
                            $(form).closest('.modal').modal('hide');
                            location.reload();
                        });
                    } else {
                        $('#PermissionForm .form-control').removeClass('is-invalid');
                        $('#PermissionForm .invalid-feedback').remove();
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


    </script>
@endsection