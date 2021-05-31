<?php

namespace App\Http\Controllers;

use App\DataTables\ReservationDataTable;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ReservationDataTable $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(ReservationDataTable $dataTable)
    {
        return $dataTable->render('reservation.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('reservation.create', [
            'services' => Service::all(),
            'rooms' => Room::all(),
            'users' => User::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */



    public function store(Request $request)
    {
        $room = $request->get('room_number');

        $roomprice = Room::where('number', $room)->value('room_price'); /// to use it in total price calculation
        $service =  $request->get('service_id');
        $serviceprice = Service::where('id', $service)->value('service_price'); /// to use it in total price calculation

        $data = request()->all();

        $totalprice = ReservationController::calculateTotalPrice($roomprice,$serviceprice,$request->check_in,$request->check_out);

        $data['reservation_price'] = $totalprice;

        //Validation
        $capacity = Room::where('number', $room)->value('capacity');
        $allowedpeople = $capacity - 1;

        $validated = $request->validate([
            'accompanies' => "required|numeric|max:$allowedpeople",
            'room_number' => 'required',
            'service_id' => 'required',
            'check_out' => 'required|after:check_in',
            'check_in' => 'required|before:check_out',
            'reserved_by' => 'required'
        ]);

        Reservation::create($data);

        return redirect()
            ->route('reservation.index')
            ->with('success', 'Reservation added successfully');
    }






    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $reservation = Reservation::find($id);

        return view('reservation.show', [
            'reservation' => $reservation,
            'reservations' => Reservation::all(),
            'services' => Service::all(),
            'rooms' => Room::all(),
            'users' => User::all(),
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $service =  $request->get('service_id');

        $serviceName = Service::where('id', $service)->value('name');


        $reservation = Reservation::find($id);
        // dd($reservation);
        return view('reservation.edit', [
            'reservation' => $reservation,
            'reservations' => Reservation::all(),
            'services' => Service::all(),
            'rooms' => Room::all(),
            'users' => User::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $reservation_price = Reservation::where('id', $id)->value('reservation_price');
        $service =  $request->get('service_id');


        $data=$request->all();
        // $request = Reservation::with('service')->get();
        $room = $request->get('room_number');
        // dd($room);
        $reservation= Reservation::findorFail($id);
        $data['reservation_price'] = $reservation_price;
        $capacity = Room::where('number', $room)->value('capacity');


        $totalprice = ReservationController::calculateTotalPrice(
            $reservation->room->room_price,
            $reservation->service->service_price,
            $request->check_in,
            $request->check_out
        );
        $data['reservation_price'] = $totalprice;


        $allowedpeople = $capacity - 1;




        $confirmation = $request->confirmed_by;
        $reservation->confirmed_by = $confirmation?$confirmation:$reservation->confirmed_by;



        $validated = $request->validate([
            'accompanies' => "required|numeric|max:$allowedpeople",
            'room_number' => 'required',
            'service_id' => 'required',
            'check_out' => 'required|after:check_in',
            'check_in' => 'required|before:check_out',
            'confirmed_by' => 'required',
            'reserved_by' => 'required'
        ]);
        $reservation->update($data);


        return redirect()->route('reservation.index')->with('success', 'Reservation updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        Reservation::destroy($id);
        return redirect()->route('reservation.index');
    }


    public function calculateTotalPrice(
        $roomprice,
        $serviceprice,
        $in,
        $out
    ){
        $check_in = $in;
        $check_out = $out;
        // dd($check_in);
        $datetimeIN = Carbon::parse($check_in);
        $datetimeOUT = Carbon::parse($check_out);


        $diff = $datetimeIN->diffInDays($datetimeOUT); /// dDiff between days to calculate the price

//        dd($datetimeIN,$datetimeOUT,$diff);
        // totalprice calculation
        return ($roomprice+$serviceprice) * $diff ;
    }
}
