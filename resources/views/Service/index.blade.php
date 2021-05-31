@extends('layouts.master')
@section('title')
    Services
@endsection

@section('content')
    {{$dataTable->table()}}


@endsection


@push('scripts')
    {{$dataTable->scripts()}}
@endpush
