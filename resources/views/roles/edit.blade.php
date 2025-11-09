@extends('layouts.app') {{-- Make sure this includes Bootstrap --}}
@section('customCss')
<style>
    .checkbox-sm {
    width: 16px;
    height: 16px;
}
input[type="checkbox"]:disabled {
        cursor: not-allowed;
        opacity: 0.6;
        pointer-events: visible;
    }
</style>
@endsection
@section('content')
    <div class="container-fluid px-5">
        <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-0">Edit Role</h4>
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
                    <form method="post" enctype="multipart/form-data" action="{{ route('roles.update', $role->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3 col-4">
                            <label for="name" class="form-label">Role Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $role->name) }}"
                                class="form-control" aria-describedby="emailHelp">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-4">
                            <label for="name" class="form-label">Description</label>
                            <textarea rows="3" type="text" name="description" id="description"
                                class="form-control"
                                aria-describedby="emailHelp" placeholder="Max 500 Charecters">{{ old('description', $role->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="card border-1 col-10">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Employee</h5>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="permissionToggle" checked>
                                </div>
                            </div>
                            <div class="card-body mb-0 p-2">
                                @if (!empty($groupedPermissions))
                                    @foreach ($groupedPermissions as $mainModule => $modules)
                                        @if($mainModule == 'emp')

                                        <table class="table">
                                            <thead class="text-center">
                                                <tr>
                                                    <th></th>
                                                    <th class="fs-3 bg-info-subtle text-dark">Full Access</th>
                                                    <th class="fs-3 text-dark">View</th>
                                                    <th class="fs-3 text-dark">Create</th>
                                                    <th class="fs-3 text-dark">Edit</th>
                                                    <th class="fs-3 text-dark">Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center text-dark">
                                                @foreach ($modules as $module => $actions)
                                                    <tr>
                                                        <td class="text-start text-dark">{{ ucfirst($module) }}</td>
                                                        @foreach (['manage', 'view', 'create', 'edit', 'delete'] as $action)
                                                            <td @if ($action === 'manage') class="bg-info-subtle" @endif>
                                                                @php
                                                                    $permissionName = strtolower($mainModule . ':' . $action . ' ' . $module);
                                                                    $hideDeleteFor = ['salary details', 'personal details']; // Add more module names to this array if needed
                                                                    $shouldShow = !(strtolower($action) === 'delete' && in_array(strtolower($module), $hideDeleteFor));
                                                                @endphp

                                                                @if ($shouldShow)
                                                                    <input type="checkbox" class="form-check-input checkbox-sm permission-checkbox"
                                                                    {{ ($hasPermissions->contains($permissionName)) ? 'checked' : '' }}
                                                                        data-action="{{ $action }}"
                                                                        value="{{ $permissionName }}"
                                                                        name="permission[]">
                                                                @endif
                                                            </td>
                                                        @endforeach
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                         @endif

                                    @endforeach
                                @else
                                    <p>No permissions found.</p>
                                @endif
                            </div>
                        </div>
                         <div class="card border-1 col-10">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Payroll Run</h5>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="permissionToggle" checked>
                                </div>
                            </div>
                            <div class="card-body mb-0 p-2">
                                @if (!empty($groupedPermissions))
                                    @foreach ($groupedPermissions as $mainModule => $modules)
                                        @if($mainModule == 'pr')

                                            <table class="table">
                                                <thead class="text-center">
                                                    <tr>
                                                        <th></th>
                                                        <th class="fs-3 bg-info-subtle text-dark">Full Access</th>
                                                        <th class="fs-3 text-dark">View</th>
                                                        <th class="fs-3 text-dark">Create</th>
                                                        <th class="fs-3 text-dark">Edit</th>
                                                        <th class="fs-3 text-dark">Delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center text-dark">
                                                    @foreach ($modules as $module => $actions)
                                                        <tr>
                                                            <td class="text-start text-dark">{{ ucfirst($module) }}</td>
                                                            @foreach (['manage', 'view', 'create', 'edit', 'delete', 'approve', 'pay'] as $action)
                                                                <td @if ($action === 'manage') class="bg-info-subtle" @endif>
                                                                    @php
                                                                        $permissionName = strtolower($mainModule . ':' . $action . ' ' . $module);
                                                                        $hideDeleteFor = ['salary details', 'personal details']; // Add more module names to this array if needed
                                                                        $shouldShow = !(strtolower($action) === 'delete' && in_array(strtolower($module), $hideDeleteFor));
                                                                    @endphp
                                                                    @if ($shouldShow)
                                                                        <input
                                                                            type="checkbox" class="form-check-input checkbox-sm permission-checkbox"
                                                                            name="permission[]"
                                                                            value="{{ $permissionName }}"
                                                                            data-action="{{ $action }}"
                                                                            {{ isset($actions[$action]) && $actions[$action] ? 'checked' : '' }}
                                                                        >
                                                                    @endif
                                                                </td>
                                                            @endforeach
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @endif
                                    @endforeach
                                @else
                                    <p>No permissions found.</p>
                                @endif
                            </div>
                        </div>
                        <div class="">
                            <!-- <button type="button" class="btn btn-secondary me-2" >No</button> -->
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
        $(document).ready(function () {
            $('#permissionToggle').on('change', function () {
                const isEnabled = $(this).is(':checked');
                $('input.permission-checkbox').prop('disabled', !isEnabled);
                if (!isEnabled) {
                    $('input.permission-checkbox').prop('checked', false);
                }
            });

            $(document).on('change', 'input.permission-checkbox[data-action="manage"]', function () {
                const $row = $(this).closest('tr');
                const isChecked = $(this).is(':checked');
                $row.find('input.permission-checkbox').prop('checked', isChecked);
            });

            // Sync Full Access checkbox when all others in a row are checked
            $(document).on('change', 'input.permission-checkbox:not([data-action="manage"])', function () {
                const $row = $(this).closest('tr');
                const total = $row.find('input.permission-checkbox:not([data-action="manage"])').length;
                const checked = $row.find('input.permission-checkbox:not([data-action="manage"]):checked').length;
                $row.find('input.permission-checkbox[data-action="manage"]').prop('checked', total === checked);
            });
        });
    </script>
@endsection
