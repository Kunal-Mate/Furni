@extends('layouts.guest')
@section('content')
    <div class="row justify-content-center w-100">
        <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
                <div class="card-body">
                    <a href="#" class="logo-img text-center d-block py-3 w-100">
                        <img src="{{ asset('assets/images/logos/dark-logo.svg') }}" width="180" alt="">
                    </a>
                    <p class="text-center">Admin register</p>
                    @include('components.massage')
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('registration') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="userName" class="form-label">Name</label>
                            <input type="text" class="form-control" name="userName" id="userName"
                                aria-describedby="textHelp">
                            @error('userName')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
                            @error('email')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password">
                            @error('password')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign Up</button>
                        <div class="d-flex align-items-center justify-content-center">
                            <p class="fs-4 mb-0 fw-bold">Already have an Account?</p>
                            <a class="text-primary fw-bold ms-2" href="/login">Sign In</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection