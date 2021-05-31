@extends('layouts.master')
@section('title')
    Edit Service
@endsection

@section('content')

    <!-- /.edit -->
    <div class="card card-outline card-primary">
        <div class="card-body">
            <form method="POST" action="{{ route('service.update', $service->id) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">

                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <input id="name" type="text" class="form-control"
                                   name="name" value="{{ $service['name'] }}" placeholder="name" required
                                   autocomplete="name" autofocus>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <input id="service_price" type="text" class="form-control" name="service_price"
                                   value="{{ $service['service_price'] }}" required autocomplete="service_price" autofocus
                                   min="1">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <input
                                id="created_by"
                                type="hidden"
                                class="form-control"
                                name="created_by"
                                value="{{ Auth::User()->id}}"
                                required
                                autofocus
                            >

                        </div>
                    </div>


                    <div class="col-12">
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Update Service</button>
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
