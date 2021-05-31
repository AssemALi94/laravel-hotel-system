@extends('layouts.master')

@section('title')
    Room
    <span class="text-primary">{{$room->number}}</span>
    in floor
    <span class="text-primary">{{$room->floor->number}}</span>
@endsection

@section('content')

<div class="card ">
  <div class="card-body">
      <h5 class="card-title mb-1">Room Number: {{$room->number}}</h5>
      <h5 class="card-text mb-1">Floor: {{$room->floor->name}} ( {{$room->floor_number}} )</h5>
      <h5 class="card-text mb-1">Created By: {{$room->creator->name}}</h5>
      <h5 class="card-text mb-1">Room Price: {{$room->room_price}}</h5>
      <h5 class="card-text mb-1">Room Capacity: {{$room->capacity}}</h5>
      <h5 class="card-text mb-1">Room Status: {{$room->status}}</h5>
    </div>
  </div>

@endsection
