@extends('layouts.app')
@section('customCss')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css"
        integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
    <style>
        .selectize-control.multi .selectize-input [data-value] {
            text-shadow: 0 1px 0 rgba(0, 51, 83, 0.3) !important;
            border-radius: 3px !important;
            background-color: #1b9dec !important;
            background-image: linear-gradient(to bottom, #1da7ee, #178ee9) !important;
            background-repeat: repeat-x !important;
            box-shadow: 0 1px 0 rgba(0, 0, 0, 0.2), inset 0 1px rgba(255, 255, 255, 0.03) !important;
            color: white !important;
        }

        .selectize-control.multi .selectize-input>div {
            cursor: pointer;
            margin: 0 3px 3px 0;
            padding: 3px 4px;
            background: #efefef;
            color: #333;
            border: 0 solid transparent;
        }

        .selectize-dropdown-content .option:hover .option.active {
            background-color: #1b9dec;
            color: white;
        }

        .selectize-dropdown-content .option.active {
            background-color: #1b9dec;
            color: white;
        }

        .selectize-input {
            padding: 8px 16px;
            font-size: .875rem;
            font-weight: 400;
            line-height: 1.5;
            color: #5a6a85;
            background-color: transparent;
            background-clip: padding-box;
            border: var(--bs-border-width) solid #dfe5ef;
            appearance: none;
            border-radius: 7px;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid px-5">
        <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-0">Add New Users</h4>
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
                    <form method="post" enctype="multipart/form-data" action="{{ route(name: 'mgmt-user.store') }}">
                        @csrf
                        <div class="row">
                            @if(auth()->user()->userType === 'superAdmin')
                                <div class="col-md-6 mb-3">
                                    <label class="col-form-label">Admin</label>
                                    <select name="adminId" class="form-control" required>
                                        <option value="">Select Admin</option>
                                        @foreach($admins as $admin)
                                            <option value="{{ $admin->id }}" {{ request('adminId') == $admin->id ? 'selected' : '' }}>
                                                {{ $admin->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('adminId')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <hr>
                            @else
                                <input type="hidden" name="adminId" value="{{ auth()->user()->id }}">
                            @endif
                            <div class="col-md-6  mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror" aria-describedby="emailHelp"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6  mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password"
                                    class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="properties" class="form-label">Select Properties</label>
                                <select id="properties" name="propertyIds[]"
                                    class="form-control @error('propertyIds') is-invalid @enderror" multiple>
                                    @foreach($properties as $property)
                                        <option value="{{ $property->propertyId }}">{{ $property->propertyName }}</option>
                                    @endforeach
                                </select>
                                @error('propertyIds')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- <div class="row">
                                <label for="name" class="form-label">Roles</label>
                                @if ($roles->isNotEmpty())
                                @foreach ($roles as $key => $p)
                                <div class="col-md-3 mb-2">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="role[]" value="{{ $p->name }}"
                                            id="perm-{{ $key }}">
                                        <label class="form-check-label" for="perm-{{ $key }}">{{ $p->name }}</label>
                                    </div>
                                </div>
                                @endforeach
                                @else
                                <div class="col-12">
                                    <h5>No Data Found!</h5>
                                </div>
                                @endif
                            </div>
                            <div class="col-md-12 mb-3">
                                @if (!empty($groupedPermissions))
                                @foreach ($groupedPermissions as $mainModule => $modules)
                                @if(in_array($mainModule, ['emp', 'emp']))
                                <h5 class="mt-4 text-capitalize">{{ $mainModule }} Permissions</h5>
                                <div class="row border p-2 rounded mx-1">
                                    @foreach ($modules as $module)
                                    <div class="col-md-4 col-lg-3 ">
                                        <div class="form-check mb-2">
                                            <input type="checkbox" class="form-check-input permission-checkbox"
                                                name="permissions[]" value="{{ $module['id'] }}"
                                                id="perm-{{ $module['id'] }}">
                                            <label class="form-check-label" for="perm-{{ $module['id'] }}">
                                                {{ ucfirst(str_replace('_', ' ', $module['name'])) }}
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @endif
                                @endforeach
                                @else
                                <p>No permissions found.</p>
                                @endif
                            </div>--}}
                        </div>
                        <div class="footer mt-3 text-end">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a type="button" class="btn btn-secondary me-2" href="{{ route('mgmt-users') }}">No</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('customJs')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"
        integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {
            $('#properties').selectize({
                maxItems: null,
                valueField: 'id',
                labelField: 'title',
                searchField: 'title',
                create: false
            });
        });
    </script>
@endsection