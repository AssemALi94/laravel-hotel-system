@extends('layouts.master')
@section('title')
Users
@endsection

@section('content')
    {{$dataTable->table()}}


@endsection


@push('scripts')
    {{$dataTable->scripts()}}
@endpush




