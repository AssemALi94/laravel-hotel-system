<?php

namespace App\Http\Controllers;
use App\DataTables\FloorDataTable;
use App\Models\Floor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FloorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param FloorDataTable $dataTable
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(FloorDataTable $dataTable)
    {
//        $floor= new Floor;
        $this->authorize('all',new Floor);

        return $dataTable->render('floors.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('all',new Floor);
        return view('floors.create',[
            'floors'=>Floor::all()
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
        $this->authorize('all',new Floor);
        $data=$request->all();
        $request->validate([
            'name' => ['required','integer','min:100', 'max:1000'],
            'no_of_rooms' => ['required', 'integer','max:50'],

        ]);
        $data['name']="floor".$request['name'];
        Floor::create($data);
        return redirect()->route('floors.index')->with('success', 'floor created');
    }

    /**
     * Display the specified resource.
     *
     * @param $floor
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($floor)
    {
        $this->authorize('all',new Floor);
        $this->authorize('view',$floor);
        $floor =Floor::find($floor);
        return view('floors.show', [
            'floor' => $floor
        ])->with('success', 'floor created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $floor
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($floor)
    {
        $this->authorize('all',new Floor);
        $floor = Floor::find($floor);
//        dd($floor);
        return view('floors.edit', [
            'floor' => $floor
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $floor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $floor): \Illuminate\Http\RedirectResponse
    {

        $this->authorize('all',new Floor);
        $floor= Floor::findorFail($floor);
        $request=$request->all();
        $request->validate([
            'name' => ['required','integer','min:100', 'max:1000'],
            'no_of_rooms' => ['required', 'integer','max:50'],

        ]);
        $floor->name ="floor".$request->input('name');
        $floor->no_of_rooms = $request->input('no_of_rooms');

        $floor->save();
        return redirect()->route('floors.index')->with('success', 'Floor Updated Successfully');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $floor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($floor)
    {
        $this->authorize('all',new Floor);
        $floor= Floor::find($floor);
        $floor->delete($floor);
        return redirect()->route('floors.index')->with('success', 'Floor Removed Successfully');;

    }
}
