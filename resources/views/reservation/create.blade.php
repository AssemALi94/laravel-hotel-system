@extends('layouts.master')


@section('title')
    Add Reservation
@endsection

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-body">
            <form method="POST" action="{{route('reservation.store')}}">
            @csrf


{{--
                <input type="text" disabled id="cost_service">
                <input type="text" disabled id="cost_room">
                <input type="text" disabled id="days_diff" val="1">
--}}

            <!-- input states -->
                <div class="form-group">
                    <label class="col-form-label" for=""><i class="fas fa-users"></i> Number of accompany</label>
                    <input type="text" class="form-control " id="accompanies" name="accompanies" placeholder="Enter numbr of accompany ..." value="0">
                </div>

                <!-- service -->
                <div class="form-group">
                    <label for="post_creator" class="form-label">Choose Service</label>
                    <select class="form-control" name="service_id" onchange="calculateTotal()">
                        @foreach($services as $service)
                            <option value="{{$service->id}}">{{$service->name}}</option>
                        @endforeach
                    </select>
                </div>

                <!-- room  -->
                <div class="form-group">
                    <label for="room_number" class="form-label">Choose Room</label>
                    <select id="room_number" class="form-control select2" name="room_number" onchange="calculateTotal()">
                        @foreach($rooms as $room)
                            @if($room->status =='available')
                                <option  data-capacity="{{$room->capacity}}" value="{{$room->number}}">{{$room->number}} - capacity: {{$room->capacity}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>


                <!-- date -->
                <div class="form-group">
                    <label for="dateRange">Check in - Check out</label>
                    <input type="text" id="dateRange" class="form-control" onchange="calculateTotal()">

                    <input type="date" hidden id="check_in" name="check_in" class="form-control" >
                    <input type="date" hidden id="check_out" name="check_out" class="form-control">
                </div>

                <!-- total price Hidden input-->
                <input type="hidden" id="reservation_price" name="reservation_price" value="">


                @if(in_array(Auth::user()->role,['admin','manager','receptionist']))
                <div class="form-group">
                    <label class="form-label" for="reserved_by">Choose Client</label>
                    <select class="form-control select2" id="reserved_by" name="reserved_by" >
                        @foreach($users as $user)
                            @if($user->role =='client')
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                @else
                    <input type="hidden" name="reserved_by" value="{{Auth::user()->id}}">
                @endif

                <!-- submit -->
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Create reservation</button>
                </div>
                <!-- /.card-body -->
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <script>
        $(function() {

            let dateRange = $('#dateRange');
            let check_in = $('#check_in');
            let check_out = $('#check_out');

            let start;
            let end;


            dateRange.daterangepicker({
                startDate: moment(),
                endDate: moment().add(1, 'day'),
                minDate: moment(),
            });

            check_in.val(moment().format('Y-MM-DD'))
            check_out.val(moment().add(1, 'day').format('Y-MM-DD'))

            dateRange.on('apply.daterangepicker', function(ev, picker) {
                start = picker.startDate.format('Y-MM-DD');
                end = picker.endDate.format('Y-MM-DD');

                check_in.val(start)
                check_out.val(end)
                $(this).val(start + ' - ' + end);
            });

            dateRange.on('cancel.daterangepicker', function(ev, picker) {
                start = '';
                end = '';

                check_in.val(start)
                check_out.val(end)

                $(this).val('');
            });




        });


        function calculateTotal(){
            var a = moment($('#check_out').val());
            var b = moment($('#check_in').val());


            $('#days_diff').val(moment.duration(a.diff(b)).asHours());


        }




    </script>

    <!-- Stripe Library -->
    <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
    <script src="https://js.stripe.com/v3/"></script>

@endpush
