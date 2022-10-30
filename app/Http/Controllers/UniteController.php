<?php

namespace App\Http\Controllers;

use App\Http\Requests\UniteRequest;
use App\Models\Unite;
use Illuminate\Http\Request;

class UniteController extends Controller
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
        return view('admin.unite.index', ['unites' => Unite::orderBy('name')->with('moteurs')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.unite.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UniteRequest $request)
    {
        //dd($request);
        $uniteFind = Unite::where('name', strtoupper($request->input('name')))->first();
        $uniteFind2 = Unite::where('imputation', $request->input('imputation'))->first();
        if ($uniteFind) {
            $request->session()->flash('message', 'Unite ' . $uniteFind->name . ' Existe');
            return redirect()->route('unites.index');
        }elseif($uniteFind2){
            $request->session()->flash('message', 'Unite ' . $uniteFind->imputation . ' Existe');
            return redirect()->route('unites.index');
        }
        $unite = new Unite();

        $unite->name = strtoupper($request->input('name'));
        $unite->imputation = $request->input('imputation');

        $unite->save();

        $request->session()->flash('message', 'Unite ' . $unite->name . ' has been added');

        return redirect()->back();
        //return redirect()->route('unites.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unite  $unite
     * @return \Illuminate\Http\Response
     */
    public function show(Unite $unite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unite  $unite
     * @return \Illuminate\Http\Response
     */
    public function edit(Unite $unite)
    {
        return view('admin.unite.edit')->with(['unite' => $unite]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unite  $unite
     * @return \Illuminate\Http\Response
     */
    public function update(UniteRequest $request, Unite $unite)
    {
        $unite = Unite::find($unite->id);

        $unite->name = strtoupper($request->input('name'));
        $unite->imputation = $request->input('imputation');

        $unite->save();

        $request->session()->flash('message', ' Unite ' . $unite->name . ' has been updated');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unite  $unite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unite $unite)
    {
        $id = $unite->id;

        if (is_null($id) || empty($id)) {

            return redirect()->route('unites.index');
        }


        Unite::destroy($id);
        return redirect()->route('unites.index');
    }
}
