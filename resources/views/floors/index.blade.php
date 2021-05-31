@extends('layouts.master')
@section('title')
    Floors
@endsection

@section('content')
    {{$dataTable->table()}}
@endsection


@push('scripts')
    {{$dataTable->scripts()}}
@endpush
