@extends('layouts.master_auth')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

    <div class="register-box">
        <!-- /.register-logo -->
        <div class="card card-outline card-primary">
        <div class="card-header">
            <h1 class="mb-0 text-center"><b>Register</b> New User</h1>
        </div>
        <div class="card-body register-card-body">
            <p class="register-box-msg">Register a new membership</p>
            <form action="{{ route('register') }}" method="post">
            @csrf
            <div class="input-group mb-1">
                <div class="form-floating">
                <input id="registerFullName" type="text" class="form-control" placeholder="" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus />
                <label for="registerFullName">Full Name</label>
                </div>
                <div class="input-group-text"><span class="bi bi-person"></span></div>
            </div>
            <div class="input-group mb-1">
                <div class="form-floating">
                <input id="registerEmail" type="email" class="form-control" placeholder="" name="email" value="{{ old('email') }}" required autocomplete="email" />
                <label for="registerEmail">Email</label>
                </div>
                <div class="input-group-text"><span class="bi bi-envelope"></span></div>
            </div>
            <div class="input-group mb-1">
                <div class="form-floating">
                <input id="registerPassword" type="password" class="form-control" placeholder="" name="password" required autocomplete="new-password" />
                <label for="registerPassword">Password</label>
                </div>
                <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
            </div>

            {{-- Confirm Password --}}
            <div class="input-group mb-1">
                <div class="form-floating">
                <input id="registerPasswordConfirmation" type="password" class="form-control" placeholder="" name="password_confirmation" required autocomplete="new-password" />
                <label for="registerPasswordConfirmation">Confirm Password</label>
                </div>
                <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
            </div>
            <!--begin::Row-->
            <div class="row">
                <div class="col-8 d-inline-flex align-items-center">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                    <label class="form-check-label" for="flexCheckDefault">
                    I agree to the <a href="#">terms</a>
                    </label>
                </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Sign Up</button>
                </div>
                </div>
                <!-- /.col -->
            </div>
            <!--end::Row-->
            </form>
            <div class="social-auth-links text-center mb-3 d-grid gap-2">
            <p>- OR -</p>
            <a href="#" class="btn btn-primary">
                <i class="bi bi-facebook me-2"></i> Sign in using Facebook
            </a>
            <a href="#" class="btn btn-danger">
                <i class="bi bi-google me-2"></i> Sign in using Google+
            </a>
            </div>
            <!-- /.social-auth-links -->
            <p class="mb-0">
            <a href="{{route('login')}}" class="link-primary text-center"> I already have a membership </a>
            </p>
        </div>
        <!-- /.register-card-body -->
        </div>
    </div>
@endsection
