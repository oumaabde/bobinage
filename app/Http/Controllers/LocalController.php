<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocalRequest;
use App\Models\Local;
use App\Models\Ot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocalController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.local.index', ['locaux' => Local::orderBy('name')->with('ots')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.local.add');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocalRequest $request)
    {
            //dd($request);
            $localFind = Local::where('name', strtoupper($request->input('name')))->first();
            if ($localFind) {
                $request->session()->flash('message', 'Local ' . $localFind->name . ' Existe');
                return redirect()->route('locals.index');
            }
            $local = new Local();

            $local->name = strtoupper($request->input('name'));

            $local->save();

            $request->session()->flash('message', 'Local ' . $local->name . ' has been added');

            return redirect()->route('locals.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Local  $local
     * @return \Illuminate\Http\Response
     */
    public function show(Local $local)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Local  $local
     * @return \Illuminate\Http\Response
     */
    public function edit(Local $local)
    {
        return view('admin.local.edit')->with(['local' => $local]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Local  $local
     * @return \Illuminate\Http\Response
     */
    public function update(LocalRequest $request, Local $local)
    {

        $local = Local::find($local->id);

        $local->name = strtoupper($request->input('name'));

        $local->save();

        $request->session()->flash('message', ' Local ' . $local->name . ' has been updated');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Local  $local
     * @return \Illuminate\Http\Response
     */
    public function destroy(Local $local)
    {
        $id = $local->id;

        if (is_null($id) || empty($id)) {

            return redirect()->route('locals.index');
        }


        Local::destroy($id);

        return redirect()->route('locals.index');
    }
}
