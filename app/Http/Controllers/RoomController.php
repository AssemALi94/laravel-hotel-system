<?php


namespace App\Http\Controllers;

use App\DataTables\RoomDataTable;
use App\Models\Floor;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RoomDataTable $dataTable)
    {
        $this->authorize('all',new Floor);
        return $dataTable->render('Room.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('all',new Floor);
        return view('Room.create', [
            'floors' => Floor::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('all',new Floor);

        $data = $request->all();

        $request->validate([
            //  'number' => ['required', 'min:1000', 'integer'],
            'floor_number' => ['required', 'min:1', 'integer'],
            'created_by' => ['required', 'integer'],
            'room_price' => ['required', 'min:10', 'integer'],
            'capacity' => ['required', 'min:1', 'max:10', 'integer'],
            'status' => ['required', 'string'],

        ]);

        Room::create($data);
        return redirect()->route('rooms.index')->with('success', 'Room created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($room)
    {
        $this->authorize('all',new Floor);
        $room = Room::find($room);

        return view('room.show', [
            'room' => $room
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($room)
    {
        $this->authorize('all',new Floor);
        $room = Room::findOrFail($room);
        return view('room.edit', [
            'room' => $room,
            'floors' => Floor::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $room)
    {
        $this->authorize('all',new Floor);

        $request->validate([
            'room_price' => ['required', 'min:1', 'integer'],
            'capacity' => ['required', 'min:1', 'max:10', 'integer'],
            'status' => ['required', 'string'],

        ]);

        $room = Room::findOrFail($room);
        $room->update([
            'room_price' => $request['room_price'],
            'capacity' => $request['capacity'],
            'status' => $request['status'],
        ]);
        return redirect()->route('rooms.index')->with('success', 'Room updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($room)
    {
        $this->authorize('all',new Floor);
        Room::destroy($room);
        return redirect()->route('rooms.index')->with('success', 'Room deleted Successfully');
    }
}


