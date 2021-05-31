@extends('layouts.master')
@section('title')
    Create user
@endsection

@section('content')

    <!-- /.Create -->
    <div class="card card-outline card-primary">
        <div class="card-body">
            <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <input
                                id="email"
                                type="email"
                                class="form-control
                            @error('email') is-invalid
                            @enderror"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="{{ __('E-Mail Address') }}"
                                required
                                autocomplete="email"
                                autofocus
                            >
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3">

                            <input
                                id="password"
                                type="password"
                                class="form-control"
                                placeholder="{{ __('Password') }}"
                                @error('email') is-invalid @enderror
                                name="password"
                                required
                                autocomplete="current-password"
                            >
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <input
                                id="name"
                                type="text"
                                class="form-control
                            @error('name') is-invalid
                            @enderror"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="name"
                                required
                                autocomplete="name"
                                autofocus
                            >
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <input
                                id="phone"
                                type="text"
                                class="form-control
                            @error('phone') is-invalid
                            @enderror"
                                name="phone"
                                value="{{ old('phone') }}"
                                placeholder="phone"
                                required
                                autocomplete="phone"
                                autofocus
                                pattern="[0-9]{10}"
                                maxlength="10"
                                minlength="10"
                            >
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <input
                                id="national_id"
                                type="text"
                                class="form-control
                            @error('national_id') is-invalid
                            @enderror"
                                name="national_id"
                                value="{{ old('national_id') }}"
                                placeholder="national_id"
                                required
                                autocomplete="national_id"
                                autofocus
                                pattern="[0-9]{14}"
                                maxlength="14"
                                minlength="14"
                            >
                            @error('national_id')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group clearfix">
                            <div class="icheck-primary d-inline-block mr-3">
                                <input type="radio" value="male" id="male" name="gender" required>
                                <label for="male">Male</label>
                            </div>
                            <div class="icheck-primary d-inline-block mr-3">
                                <input type="radio" value="female" id="female" name="gender" required>
                                <label for="female">Female</label>
                            </div>

                            @error('gender')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <select
                                id="role"
                                class="form-control select2
                            @error('role') is-invalid
                            @enderror"
                                name="role"
                                required
                                autocomplete="role"
                                autofocus
                            >
                                <option value="client">client</option>
                                <option value="receptionist">receptionist</option>
                                <option value="manager">manager</option>
                                <option value="admin">admin</option>
                            </select>
                            @error('role')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <select
                                id="country"
                                class="form-control select2
                            @error('country') is-invalid
                            @enderror"
                                name="country"
                                required
                                autocomplete="country"
                                autofocus
                            >
                                @foreach (countries() as $country)
                                    <option value="{{$country['iso_3166_1_alpha3']}}">{{ $country['name'] }}</option>
                                @endforeach
                            </select>
                            @error('country')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="input-group mb-3">

                            <label class="custom-file-label" for="avatar">Choose avatar</label>
                            <input
                                type="file"
                                id="avatar"
                                class="custom-file-input
                            @error('avatar') is-invalid
                            @enderror"
                                name="avatar"
                                autocomplete="avatar"
                                autofocus
                            />
                            @error('avatar')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <!-- /.col -->
                    </div>

                    <div class="col-12">
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Add user</button>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->


@endsection

