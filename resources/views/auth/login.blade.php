@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                </div>
                                <form class="user" method="POST" action="{{ route('login') }}">
                                    @csrf
                                    {{-- <div class="form-group">
                                        <input type="email"
                                        class="form-control form-control-user @error('email') is-invalid @enderror"
                                        id="email" aria-describedby="emailHelp"
                                        placeholder="Enter Email Address..." name="email" value="{{ old('email') }}"
                                        required autocomplete="email" autofocus>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div> --}}
                                    <div class="form-group">
                                        <input type="text"
                                        class="form-control form-control-user @error('username') is-invalid @enderror"
                                        id="username" aria-describedby="emailHelp"
                                        placeholder="Enter email or dni number..." name="username" value="{{ old('username') }}"
                                        required autocomplete="username" autofocus>
                                        @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="password"
                                        class="form-control form-control-user @error('pasword') is-invalid @enderror"
                                        id="password" placeholder="Password" name="password" required
                                        autocomplete="current-password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck"
                                            {{ old('remember') ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="customCheck">Remember
                                            Me</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Login
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="/forgot-password">Forgot Password?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="/register">Create an Account!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection