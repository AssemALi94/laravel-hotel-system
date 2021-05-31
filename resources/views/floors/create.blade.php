@extends('layouts.master')

@section('title')
    Add Floor
@endsection
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-body">

            <form method="POST" action="{{route('floors.store')}}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Floor Name</label>
                    {{--                    <input type="text" class="form-control" name="name" id="name">--}}
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">floor</div>
                        </div>
                        <input type="text" class="form-control" name="name" id="name" placeholder="floor number" value="{{old('name')}}">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="no_of_rooms" class="form-label">Max Numbers of rooms</label>
                    <input type="text" class="form-control" name="no_of_rooms" id="no_of_rooms" {{old('no_of_rooms')}}>
                </div>

                <div class="mb-3">
                    <input type="hidden" class="form-control" name="creator_id" id="creator_id" value="{{Auth::User()->id}}">
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Add floor</button>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
