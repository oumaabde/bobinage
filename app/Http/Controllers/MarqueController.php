<?php

namespace App\Http\Controllers;

use App\Http\Requests\MarqueRequest;
use App\Models\Marque;
use Illuminate\Http\Request;

class MarqueController extends Controller
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
        return view('admin.marque.index', ['marques' => Marque::orderBy('name')->with('moteurs')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.marque.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MarqueRequest $request)
    {
        //dd($request);
        $marqueFind = Marque::where('name', strtoupper($request->input('name')))->first();
        if ($marqueFind) {
            $request->session()->flash('message', 'Marque ' . $marqueFind->name . ' Existe');
            return redirect()->route('marques.index');
        }
        $marque = new Marque();

        $marque->name = strtoupper($request->input('name'));

        $marque->save();

        $request->session()->flash('message', 'Marque ' . $marque->name . ' has been added');
        return redirect()->back();
        //return redirect()->route('marques.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Marque  $marque
     * @return \Illuminate\Http\Response
     */
    public function show(Marque $marque)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Marque  $marque
     * @return \Illuminate\Http\Response
     */
    public function edit(Marque $marque)
    {
        return view('admin.marque.edit')->with(['marque' => $marque]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Marque  $marque
     * @return \Illuminate\Http\Response
     */
    public function update(MarqueRequest $request, Marque $marque)
    {
        $marque = Marque::find($marque->id);

        $marque->name = strtoupper($request->input('name'));

        $marque->save();

        $request->session()->flash('message', ' Marque ' . $marque->name . ' has been updated');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Marque  $marque
     * @return \Illuminate\Http\Response
     */
    public function destroy(Marque $marque)
    {
        $id = $marque->id;

        if (is_null($id) || empty($id)) {

            return redirect()->route('marques.index');
        }


        Marque::destroy($id);

        return redirect()->route('marques.index');
    }
}
