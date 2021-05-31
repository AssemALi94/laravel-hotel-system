@extends('layouts.master')

@section('title')
    Add Room
@endsection

@section('content')

    <div class="card card-outline card-primary">
        <div class="card-body">
            <form method="POST" action="{{route('rooms.store')}}">
                @csrf

                <div class="mb-3">
                    <label for="floor_number" class="form-label">Floor Number</label>

                    <select class="form-control select2" name="floor_number" id="floor_number" value="{{ old('floor_number') }}">
                        @foreach ($floors as $floor)
                            {{$floor->rooms}}

                            @if ($floor['no_of_rooms'] !=0 && $floor['no_of_rooms']>count($floor->rooms) )

                                <option value="{{$floor['number']}}">{{ $floor['name'] }}</option>
                            @endif

                        @endforeach
                    </select>

                </div>
                <div class="mb-3">

                    <input type="hidden" class="form-control" name="created_by" value="{{ Auth::user()->id }}"/>

                </div>
                <div class="mb-3">
                    <label for="room_price" class="form-label">Room Price</label>
                    <input type="number" min="1" class="form-control" name="room_price" value="{{ old('room_price') }}">
                </div>
                <div class="mb-3">
                    <label for="capacity" class="form-label">Capacity</label>
                    <input type="number" min="1" max="10" class="form-control" name="capacity" value="{{ old('capacity') }}">
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control select2" id="status" name="status" value="{{ old('status') }}">
                        <option value="busy">busy</option>
                        <option value="renewing">renewing</option>
                        <option selected value="available">available</option>
                    </select>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
@endsection
