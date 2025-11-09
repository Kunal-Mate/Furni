@extends('layouts.app') {{-- Make sure this includes Bootstrap --}}

@section('content')
    <div class="container-fluid px-5">
        <div class="row mb-4">
            <div class="col">
                <h2 class="fw-semibold text-dark">Profile</h2>
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row px-5">
            <div class="col-md-6 col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Update Profile Information</h5>
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ auth()->user()->name }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ auth()->user()->email }}" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Update Password -->
            <div class="col-md-6 col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Update Password</h5>
                        <form action="{{ route('password.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="current_password" class="form-label">Current Password</label>
                                <input type="password" class="form-control" id="current_password" name="current_password"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Change Password</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Delete Account -->
            <div class="col-md-5 col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Delete Account</h5>
                        <form action="{{ route('profile.destroy') }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
                            @csrf
                            @method('DELETE')
                            <div class="mb-3">
                                <label for="password_delete" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="password_delete" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-danger">Delete Account</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4>Active Sessions</h4>


                        <ul class="list-group">
                            @foreach ($sessions as $session)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>IP:</strong> {{ $session->ip_address ?? 'Unknown' }}<br>
                                        <strong>User Agent:</strong> {{ Str::limit($session->user_agent, 50) }}<br>
                                        <small>Last active:
                                            {{ \Carbon\Carbon::createFromTimestamp($session->last_activity)->diffForHumans() }}</small>
                                    </div>

                                    @if ($session->id !== $currentSessionId)
                                        <form action="{{ route('userSessions.destroy', $session->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure to logout this session?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Logout</button>
                                        </form>
                                    @else
                                        <span class="badge bg-success">Current Device</span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection