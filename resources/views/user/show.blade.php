@extends('layouts.master')
@section('title')
Show user
@endsection

@section('content')

<h1>{{ $user->name }}
</h1>
<div>{{ $user->name }}</div>

<small>Created on {{ Carbon\Carbon::parse($user->created_at)->format('l jS \\of F Y h:i:s A') }}</small>
<hr>


@endsection

