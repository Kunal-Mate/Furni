@extends('layouts.guest')
@section('content')
    <div class="row justify-content-center w-100">
        <div class="col-md-8 col-lg-6 col-xxl-4">
            <div class="card mb-0">
                <div class="card-body">
                    <a href="#" class="logo-img text-center d-block py-3 w-100">
                        <img src="{{ asset('assets/images/logos/dark-logo.svg') }}" width="180" alt="">
                    </a>
                    <p class="text-center">User Login</p>
                    @include('components.massage')
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('userAuthenticate') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ old('email') }}">
                            @error('email')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control  @error('password') is-invalid @enderror"
                                id="password" name="password">
                            @error('password')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- <div class="d-flex justify-content-between mb-4">
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                                                                <label class="form-check-label" for="remember">
                                                                                    Remember me
                                                                                </label>
                                                                            </div>
                                                                            <a href="#" class="text-primary fw-bold">Forgot Password?</a>
                                                                        </div> -->
                        <button type="submit" class="btn btn-primary w-100 py-2 mb-4">Sign In</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection