@extends('layouts.master')

@section('title')
    Edit Room
    <span class="text-primary">{{$room->number}}</span>
    in floor
    <span class="text-primary">{{$room->floor->number}}</span>
@endsection
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-body">
            <form method="POST" action="{{route('rooms.update',['room' => $room->number])}}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="floorr" class="form-label">Floor</label>

                    <input type="text" disabled class="form-control" value="{{ $room->floor['name'] }}">

                </div>
                <div class="mb-3">
                    <label for="room_price" class="form-label">Room Price</label>
                    <input type="number" min="1" class="form-control" name="room_price" value="{{ old('room_price') ?? $room->room_price}}">
                </div>
                <div class="mb-3">
                    <label for="capacity" class="form-label">Capacity</label>
                    <input type="number" min="1" max="10" class="form-control" name="capacity" value="{{ old('capacity') ?? $room->capacity}}">
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control select2" name="status">
                        <option {{$room->status=='busy'?'selected':'' }} value="busy">busy</option>
                        <option {{$room->status=='renewing'?'selected':'' }} value="renewing">renewing</option>
                        <option {{$room->status=='available'?'selected':'' }} value="available">available</option>
                    </select>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
