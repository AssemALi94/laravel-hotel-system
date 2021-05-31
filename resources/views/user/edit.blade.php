@extends('layouts.master')
@section('title')
    Edit user
@endsection

@section('content')

    <!-- /.edit -->
    <div class="card card-outline card-primary">
        <div class="card-body">
            @if($user['avatar'])

            <img src="{{ Auth::user()->avatar ? "/storage/avatar/".Auth::user()->avatar:asset('img/user2-160x160.jpg') }}" class="d-block mx-auto my-4 rounded-circle shadow img-thumbnail"
                 style="width:150px" alt="{{$user->name}}">
            @endif

            <form method="POST" action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <input id="email" type="email" class="form-control
                                        @error('email') is-invalid
                                        @enderror" name="email" value="{{ $user['email'] }}"
                                placeholder="{{ __('E-Mail Address') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    @if(in_array(Auth::user()->role,['admin','manager','receptionist']))
                        <div class="col-md-6">

                            <div class="input-group mb-3">
                            <input id="password" type="password" class="form-control" value="" placeholder="{{ __('Password') }}"
                                @error('email') is-invalid @enderror name="password"
                                autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>
                    @endif
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <input id="name" type="text" class="form-control
                                        @error('name') is-invalid
                                        @enderror" name="name" value="{{ $user['name'] }}" placeholder="name" required
                                autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <input id="phone" type="text" class="form-control
                                        @error('phone') is-invalid
                                        @enderror" name="phone" value="{{ $user['phone'] }}" placeholder="phone" required
                                autocomplete="phone" autofocus pattern="[0-9]{10}" maxlength="10" minlength="10">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <input id="national_id" type="text" class="form-control
                                        @error('national_id') is-invalid
                                        @enderror" name="national_id" value="{{ $user['national_id'] }}"
                                placeholder="national_id" required autocomplete="national_id" autofocus pattern="[0-9]{14}"
                                maxlength="14" minlength="14">
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
                                <input type="radio" value="male" id="male" name="gender" required {{ $user->gender == 'male' ? 'checked' : ''}}>
                                <label for="male">Male</label>
                            </div>
                            <div class="icheck-primary d-inline-block mr-3">
                                <input type="radio" value="female" id="female" name="gender" required {{ $user->gender == 'female' ? 'checked' : ''}}>
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
                            <select id="role" class="form-control select2
                                        @error('role') is-invalid
                                        @enderror" name="role" required autocomplete="role" autofocus>
                                <option value="client" {{($user->role === 'client') ? 'Selected' : ''}}>client</option>


                                @if(in_array(Auth::user()->role,['admin']))
                                    <option value="receptionist" {{($user->role === 'receptionist') ? 'Selected' : ''}}>receptionist</option>
                                    <option value="manager" {{($user->role === 'manager') ? 'Selected' : ''}}>manager</option>
                                    <option value="admin" {{($user->role === 'admin') ? 'Selected' : ''}}>admin</option>
                                @endif



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
                            <select id="country" class="form-control select2
                                        @error('country') is-invalid
                                        @enderror" name="country" required autocomplete="country" autofocus>
                                @foreach (countries() as $country)
                                    <option
                                        value="{{ $country['iso_3166_1_alpha3'] }}"
                                        {{$user['country']== $country['iso_3166_1_alpha3']?'selected':''}}
                                    >
                                        {{  $country['name'] }}
                                    </option>
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

                    @if($user->approval_id==null && in_array(Auth::user()->role,['admin','manager']))
                        <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="icheck-primary">
                                <input class="custom-control-input switch" value="{{Auth::user()->id}}" type="checkbox" name="approval_id" id="approval_id">
                                <label for="approval_id">Approve client information</label>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <span class="h6 pt-2 text-success font-weight-bold">Client information verified successfully</span>
                        </div>
                    </div>
                    @endif
                    <!-- /.col -->
                    <div class="col-12">
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Update user</button>


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
