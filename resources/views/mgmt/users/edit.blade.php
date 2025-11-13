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
                <h4 class="fw-semibold mb-0">Edit user</h4>
            </div>
        </div>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-2">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mt-2">
                <strong>{{ session('error') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
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

        <div class="card">
            <div class="card-body p-3">
                <form method="post" action="{{ route('mgmt-user.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        {{-- Name --}}
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $user->name) }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $user->email) }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="col-md-4 mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" name="current_password" id="current_password" class="form-control">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control">
                        </div>



                        {{-- Hotels
                        <div class="col-md-6 mb-3">
                            <label for="hotels" class="form-label">Select Hotels</label>
                            <select id="hotels" name="hotels[]" class="form-control select2bs5" multiple>
                                @foreach($hotels as $hotel)
                                <option value="{{ $hotel->hotelId }}" {{ in_array($hotel->hotelId, explode(',',
                                    $user->hotelIds)) ? 'selected' : '' }}>
                                    {{ $hotel->hotelName }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        --}}


                        <div class="col-md-6 mb-3">
                            <label for="properties" class="form-label">Select Properties</label>
                            <select id="properties" name="propertyIds[]"
                                class="form-control @error('propertyIds') is-invalid @enderror" multiple>
                                @foreach($properties as $property)
                                    <option value="{{ $property->propertyId }}" {{ in_array($property->propertyId, explode(',', $user->propertyIds)) ? 'selected' : '' }}>{{ $property->propertyName }}</option>
                                @endforeach
                            </select>
                            @error('propertyIds')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Permissions
                        <div class="col-md-12 mb-3">
                            @if (!empty($groupedPermissions))
                            @foreach ($groupedPermissions as $mainModule => $modules)
                            @if(in_array($mainModule, ['page', 'report']))
                            <h5 class="mt-4 text-capitalize">{{ $mainModule }} Permissions</h5>
                            <div class="row border p-2 rounded mx-1">
                                @foreach ($modules as $module)
                                <div class="col-md-4 col-lg-3">
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input permission-checkbox"
                                            name="permissions[]" value="{{ $module['id'] }}" id="perm-{{ $module['id'] }}"
                                            {{ $user->permissions->pluck('id')->contains($module['id']) ? 'checked' : '' }}>
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
                        <a href="{{ route('mgmt-users') }}" class="btn btn-secondary ms-2">Cancel</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

@section('customJs')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"
        integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>


    {{--
    <script src="{{ asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>
    --}}
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