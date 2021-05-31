@extends('layouts.master')


@section('title')
    Update <span class="text-primary">{{$floor->name}}</span> Details
@endsection

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-body">
            <form method="Post" action="{{route('floors.update',['floor' => $floor->number])}}">
                @method('PUT')
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">floor name</label>
                    <input type="text" class="form-control" name="name" id="name" value={{$floor->name}} >
                </div>
                <div class="mb-3">
                    <label for="no_of_rooms" class="form-label">number of rooms</label>
                    <input type="text" class="form-control" name="no_of_rooms"  id="no_of_rooms" value={{$floor->no_of_rooms}}>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Update floor</button>
                </div>
            </form>
        </div>
    </div>
@endsection
