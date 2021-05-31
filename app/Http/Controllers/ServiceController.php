<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\DataTables\ServiceDataTable;
use App\Models\Service;
use Illuminate\Http\Response;


class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index(ServiceDataTable $dataTable)
    {
        $this->authorize('all',new Service);
        return $dataTable->render('service.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('service.create',[
            'service'=>Service::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $data=$request->all();
        $request->validate([
            'name' => ['required','string'],
            'service_price' => ['required', 'integer'],

        ]);
        Service::create($data);
        return redirect()->route('service.index')->with('success', 'Service Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param $service
     * @return Response
     */
    public function show($service)
    {
        $service =Service::find($service);
        return view('service.show', [
            'service' => $service
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $service
     * @return Application|Factory|View|Response
     */
    public function edit($service)
    {
        $service = Service::find($service);
        return view('service.edit', [
            'service' => $service
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $service
     * @return RedirectResponse
     */
    public function update(Request $request, $service): RedirectResponse
    {


        $request->validate([
            'name' => ['required','string'],
            'service_price' => ['required', 'integer'],
        ]);


        $service= Service::findorFail($service);

        $service->update([
            'name'=>$request['name'],
            'service_price'=>$request['service_price']
        ]);

        return redirect()->route('service.index')->with('success', 'Service Updated Successfully');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $service
     * @return RedirectResponse
     */
    public function destroy($service)
    {
        $service= Service::find($service);
        $service->delete($service);
        return redirect()->route('service.index')->with('success', 'Service Removed Successfully');;

    }

}
