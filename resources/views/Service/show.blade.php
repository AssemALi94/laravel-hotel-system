@extends('layouts.master')
@section('title')
    Show Service
@endsection

@section('content')

    <h1>{{ $service->name }}</h1>
    <div>{{ $service->service_price }}</div>

    <hr>


@endsection
