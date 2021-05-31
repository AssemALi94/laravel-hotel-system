@extends('layouts.master')



@section('title')
    Edit reservation <span class="text-primary">{{$reservation->reserved->name}}</span>
@endsection


@section('content')


    <div class="card card-outline card-primary">
        <div class="card-body">
            <!-- <form method="POST" action="/reservation"> -->
            <form method="Post" action="{{route('reservation.update',['reservation' => $reservation->id])}}">
            @method('PUT')
            @csrf

            <!-- input states -->
                <div class="form-group">
                    <label class="col-form-label" for=""><i class="fas fa-users"></i> Number of accompany</label>
                    <input type="text" class="form-control " id="accompanies" name="accompanies" placeholder="Enter numbr of accompany ..." value="{{$reservation['accompanies']}}">
                </div>

                <!-- service -->
                <div class="form-group">
                    <label for="post_creator" class="form-label">Choose Service</label>
                    <select class="form-control" name="service_id">
                        @foreach($services as $service)
                            <option {{$service->id == $reservation->service_id?"selected":""}}  value="{{$service->id}}">{{$service->name}}</option>
                        @endforeach
                    </select>
                </div>

{{--                {{dd($reservation->room)}}--}}
                <!-- room  -->
                <div class="form-group">
                    <label for="post_creator" class="form-label">Choose Room</label>
                    <select class="form-control" name="room_number">
                        @foreach($rooms as $room)
                            @if($room->status =='available')
                                <option {{$room->id == $reservation->room_number?"selected":""}} value="{{$room->number}}">{{$room->number}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <!-- date -->


                <!-- date -->
                <div class="form-group">
                    <label for="dateRange">Check in - Check out</label>
                    <input type="text" id="dateRange" class="form-control"
                        value="{{\Carbon\Carbon::createFromDate($reservation->check_in)->format('Y-m-d')}} - {{\Carbon\Carbon::createFromDate($reservation->check_out)->format('Y-m-d')}}"
                    >

                    <input type="date" hidden id="check_in" name="check_in" class="form-control" value="{{\Carbon\Carbon::createFromDate($reservation->check_in)->format('Y-m-d')}}">
                    <input type="date" hidden id="check_out" name="check_out" class="form-control" value="{{\Carbon\Carbon::createFromDate($reservation->check_out)->format('Y-m-d')}}">
                </div>



                <!-- total price Hidden input-->
                <input type="hidden" id="reservation_price" name="reservation_price" value="">


                <div class="mb-3">
                    <label class="form-label">Choose Client</label>
                    <select class="form-control" name="reserved_by">
                        @foreach($users as $user)
                            @if($user->role =='client')

                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>


                @if(in_array(Auth::user()->role,['admin','manager','receptionist']))
                    @if($reservation->confirmed_by==null)
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <div class="icheck-primary">
                                    <input class="custom-control-input switch" value="{{Auth::user()->id}}" type="checkbox" name="confirmed_by" id="confirmed_by">
                                    <label for="confirmed_by">Approve client information</label>
                                </div>
                            </div>
                        </div>
                    @else
                        <span class="h6 pt-2 text-success font-weight-bold">Client information verified successfully</span>
                    @endif

                @else
                    @if($reservation->confirmed_by==null)
                        <span class="h5 pt-2 text-danger font-weight-bold">Not confirmed yet</span>
                    @endif
                @endif


                <!-- submit -->
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Save edits</button>
                </div>

            </form>

        </div>
    </div>

@endsection


@push('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>

    <script>
        $(function () {

            let dateRange = $('#dateRange');
            let check_in = $('#check_in');
            let check_out = $('#check_out');
            dateRange.daterangepicker({
                startDate: check_in.val(), // after open picker you'll see this dates as picked
                endDate: check_out.val(),
                locale: {
                    format: 'YYYY-MM-DD',
                }
            }, function (start, end, label) {
                //what to do after change
            }).val(check_in.val() + " - " + check_out.val()); //set it to see it inside input (don't forget to format dates)

            let start;
            let end;


            dateRange.on('apply.daterangepicker', function (ev, picker) {
                start = picker.startDate.format('Y-MM-DD');
                end = picker.endDate.format('Y-MM-DD');

                // alert(start)
                // alert(end)

                check_in.val(start)
                check_out.val(end)
                $(this).val(start + ' - ' + end);
            });

            dateRange.on('cancel.daterangepicker', function (ev, picker) {
                start = '';
                end = '';

                check_in.val(start)
                check_out.val(end)

                $(this).val('');
            });
        });
    </script>
@endpush
