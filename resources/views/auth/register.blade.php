@extends('layouts.auth')

@section('content')

    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h3 class="text-center form-title font-weight-bold text-uppercase">{{ __('Register') }}</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="input-group mb-3">

                        <input
                            id="name"
                            type="text"
                            class="form-control
                            @error('name') is-invalid @enderror
                            "
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="{{ __('Name') }}"

                            autocomplete="name"
                            autofocus
                        >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">

                        <input
                            id="email"
                            type="email"
                            class="form-control
                            @error('email') is-invalid @enderror"
                            placeholder="{{ __('Email') }}"
                            name="email"
                            autocomplete="email"
                            autofocus
                        >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">

                        <input
                            id="password"
                            type="password"
                            class="form-control
                            @error('password') is-invalid @enderror"
                            placeholder="{{ __('Password') }}"
                            name="password"
                            autocomplete="new-password"
                            autofocus
                        >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input
                            id="password_confirmation"
                            type="password"
                            class="form-control
                            @error('password_confirmation') is-invalid @enderror"
                            placeholder="{{ __('Confirm Password') }}"
                            name="password_confirmation"
                            autocomplete="new-password"
                            autofocus
                        >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>


                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input class="custom-control-input" type="checkbox" name="terms" id="terms" {{ old('remember') ? 'checked' : '' }} required>
                                <label for="terms">
                                    Agree to terms
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">{{ __('Register') }}</button>
                        </div>
                        <!-- /.col -->
                    </div>

                    <p class="mb-0">
                        <a href="{{route('login')}}" class="text-center">Already have an account?</a>
                    </p>

                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.register-box -->
@endsection
