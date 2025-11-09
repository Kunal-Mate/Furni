@extends('layouts.app') {{-- Make sure this includes Bootstrap --}}

@section('content')
    <div class="container-fluid px-5">
        <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-0">Users</h4>
                    </div>
                    <div class="col-3">
                        <div class="text-center">
                            {{-- @can('create users') --}}
                            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Add"
                                href="javascript:void(0)"><i class="ti ti-plus"></i> Add New User</a>
                            {{-- @endcan --}}
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
                                <th scope="col">Roles</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($users->isNotEmpty())
                                @foreach ($users as $key => $us)
                                    <tr class="userRow">
                                        <td class="text-center">
                                            <h6 class="fw-semibold mb-0">
                                                {{  $key + 1 }}
                                            </h6>
                                        </td>
                                        <td class="text-center">
                                            <h5 class="fw-semibold mb-0">{{ $us->name }}</h5>
                                            <span class="mb-0 fw-normal fs-3">{{ $us->email }}</span>
                                        </td>
                                        <td class="text-center">

                                            <div class="d-flex justify-content-center align-items-center gap-2">
                                                <span class="badge bg-secondary-subtle text-secondary fw-semibold">
                                                    {{ $us->roles->pluck('name')->join(', ') }}
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center align-items-center gap-2">
                                                <span
                                                    class="badge bg-{{ $us->isActive == 1 ? 'success' : 'danger' }} rounded-3 fw-semibold">{{ $us->isActive == 1 ? 'Active' : 'Block' }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="fs-6 text-muted" href="javascript:void(0)" data-bs-toggle="dropdown"
                                                    aria-expanded="false" data-bs-placement="top" data-bs-title="Options">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    @can('edit users')
                                                        <li>
                                                            <a class="dropdown-item text-primary" data-bs-toggle="modal"
                                                                data-bs-target="#edit{{ $us->id }}" href="javascript:void(0)">
                                                                <i class="ti ti-pencil"></i> Edit
                                                            </a>
                                                        </li>
                                                    @endcan
                                                    @can('delete users')
                                                        <li>
                                                            <a class="dropdown-item text-danger sa-confirm" data-id="{{ $us->id }}"
                                                                data-name="{{ $us->name }}"><i class="ti ti-trash"></i> Delete</a>
                                                        </li>
                                                    @endcan

                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="edit{{ $us->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form method="post" enctype="multipart/form-data"
                                                    action="{{ route('users.update', $us->id) }}">
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
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="email" class="form-label">Email</label>
                                                            <input type="email" name="email" id="email{{ $us->id }}"
                                                                value="{{ old('email', $us->email) }}"
                                                                class="form-control @error('email') is-invalid @enderror">
                                                            @error('email')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="current_password" class="form-label">Current
                                                                Password</label>
                                                            <input type="password" class="form-control"
                                                                id="current_password{{ $us->id }}" name="current_password">
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="password" class="form-label">New Password</label>
                                                            <input type="password" class="form-control" id="password{{ $us->id }}"
                                                                name="password">
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="password_confirmation" class="form-label">Confirm New
                                                                Password</label>
                                                            <input type="password" class="form-control"
                                                                id="password_confirmation{{ $us->id }}"
                                                                name="password_confirmation">
                                                        </div>

                                                        <div class="row">
                                                            <label for="name" class="form-label">Roles</label>
                                                            @if ($roles->isNotEmpty())
                                                                @foreach ($roles as $key => $p)
                                                                    <div class="col-md-3 mb-2">
                                                                        <div class="form-check">
                                                                            <input {{ $us->roles->pluck('name')->contains($p->name) ? 'checked' : '' }} type="checkbox" class="form-check-input"
                                                                                name="role[]" value="{{ $p->name }}" id="perm-{{ $key }}">
                                                                            <label class="form-check-label"
                                                                                for="perm-{{ $key }}">{{ $p->name }}</label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @else
                                                                <div class="col-12">
                                                                    <h4>No Data Found!</h4>
                                                                </div>
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
                <div class="card-footer text-body-secondary pb-0">
                </div>
            </div>


            <div class="modal fade" id="Add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" enctype="multipart/form-data" id="categoryForm" name="categoryForm">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        aria-describedby="emailHelp">
                                    <p></p>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control">
                                    <p></p>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" id="password" class="form-control">
                                    <p></p>
                                </div>
                                <div class="row">
                                    <label for="name" class="form-label">Roles</label>
                                    @if ($roles->isNotEmpty())
                                        @foreach ($roles as $key => $p)
                                            <div class="col-md-3 mb-2">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" name="role[]"
                                                        value="{{ $p->name }}" id="perm-{{ $key }}">
                                                    <label class="form-check-label" for="perm-{{ $key }}">{{ $p->name }}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="col-12">
                                            <h4>No Data Found!</h4>
                                        </div>
                                    @endif
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
                text: `You want to delete '${Name}' User!`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('users.delete') }}",
                        type: "POST",
                        dataType: "json",
                        data: {
                            id: Id,
                        },
                        success: function (response) {
                            if (response.status) {
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
                url: "{{ route('users.store') }}",
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


    </script>
@endsection