@extends('layouts.master')

@section('title')
    Floor <span class="text-primary">{{$floor->name}}</span> Details
@endsection

@section('content')

    <div class="card card card-outline card-primary container">
        <div class="card-body">
            <h5 class="card-title mb-1">Floor Number: {{$floor->number}}</h5>
            <h5 class="card-text mb-1">Floor Name: {{$floor->name}}</h5>
            <h5 class="card-text mb-1">Creator: {{$floor->creator['name']}}</h5>
        </div>
    </div>

@endsection
