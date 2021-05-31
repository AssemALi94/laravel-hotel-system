@extends('layouts.master')
@section('title')
    Reservation <span class="text-primary">{{$reservation->room_number}}</span>
@endsection

@section('content')

<!-- <a href="/reservation" class="btn btn-secondary float-right">Go Back</a> -->

<!-- ********************************* -->



<div class="card card-outline card-primary">
  <div class="card-body">
      <b class="card-text mb-1">Accompanies </b><span> {{$reservation['accompanies']}}</span> <br>
      <!-- <b class="card-text mb-1">room_number </b><span> {{$reservation['room_number']}}</span> <br> -->
      <b class="card-text mb-1">check out </b><span> {{$reservation['check_out']}}</span> <br>
      <b class="card-text mb-1">check in </b><span> {{$reservation['check_in']}}</span> <br>
      <b class="card-text mb-1">confirmed_by </b><span> {{$reservation->confirmed->name}}</span> <br>
      <b class="card-text mb-1">reserved_by </b><span>  {{$reservation->reserved->name}}</span> <br>
      <b class="card-text mb-1">Service </b><span>  {{$reservation->service->name}}</span> <br>


      <table class="mt-4 table table-striped">
          <tr>
              <td>No of days</td>
              <td>
                  {{\Carbon\Carbon::parse($reservation->check_in)->diffInDays(\Carbon\Carbon::parse($reservation->check_out))}}
              </td>
          </tr>
          <tr>
              <td>Service price</td>
              <td>
                  {{$reservation->service->name}} - <span class="currency">{{$reservation->service->service_price}}</span>
              </td>
          </tr>
          <tr>
              <td>Room</td>
              <td>
                  Room No.{{$reservation->room->number}} - <span class="currency">{{$reservation->room->room_price}}</span>/day
              </td>
          </tr>
          <tr class="font-weight-bold">
                <td>Total price:</td>
                <td class="currency">{{$reservation->reservation_price}}</td>
          </tr>
      </table>

    </div>
  </div>


@endsection
