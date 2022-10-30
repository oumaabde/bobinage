<?php

namespace App\Http\Controllers;

use App\Http\Requests\AgentRequest;
use App\Http\Requests\OtRequest;
use App\Models\Agent;
use App\Models\Local;
use App\Models\Moteur;
use App\Models\Ot;
use App\Models\Unite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function GuzzleHttp\Promise\all;

class OtController extends Controller
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
        //dd(Ot::with('moteur', 'local', 'recepteur', 'testeur')->get());
        return view('admin.ot.index', ['ots' => Ot::with('moteur', 'local', 'recepteur','testeur')->get()]);
    }

    public function dashboard()
    {
        $otsCount = Ot::all()->count();
        $moteursCount = Moteur::all()->count();
        return view('dashboard')->with([ 'otsCount' => $otsCount, 'moteursCount' => $moteursCount,]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $users = Agent::orderBy('name')->get();
        $locals = Local::orderBy('name')->get();
        $moteurs = Moteur::orderBy('n_serie')->get();
        return view('admin.ot.add')->with(['user' => $user,'users' => $users, 'moteurs' => $moteurs, 'locals' => $locals]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OtRequest $request)
    {
        //dd($request);
        $otFind = Ot::where('n_ot', $request->input('n_ot'))->first();
        if ($otFind) {
            $request->session()->flash('message', 'OT ' . $otFind->n_ot . ' Existe');
            return redirect()->route('ots.index');
        }
        $ot = new Ot();

        $ot->n_ot = $request->input('n_ot');
        $ot->moteur_id = $request->input('moteur_id');
        $ot->user_id = $request->input('user_id');
        $ot->recepteur_id = $request->input('recepteur_id');
        $ot->local_id = $request->input('local_id');
        $ot->emetteur = strtoupper($request->input('emetteur'));
        $ot->description = $request->input('description');
        $ot->date_reception = $request->input('date_reception');

        $ot->save();

        $request->session()->flash('message', 'OT ' . $ot->n_ot . ' has been added');

        return redirect()->route('ots.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ot  $ot
     * @return \Illuminate\Http\Response
     */
    public function show(Ot $ot)
    {
        return $ot;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ot  $ot
     * @return \Illuminate\Http\Response
     */
    public function edit(Ot $ot)
    {
        $user = Auth::user();
        $users = User::orderBy('name')->get();;
        $agents = Agent::orderBy('name')->get();;
        $locals = Local::orderBy('name')->get();;
        $moteurs = Moteur::orderBy('n_serie')->get();;
        return view('admin.ot.edit')->with(['ot'=> $ot,'moteurs' => $moteurs, 'user' => $user, 'users' => $users,'agents' => $agents, 'locals' => $locals]);
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ot  $ot
     * @return \Illuminate\Http\Response
     */
    public function update(OtRequest $request, Ot $ot)
    {

        $ot = Ot::find($ot->id);

        $ot->n_ot = $request->input('n_ot');
        $ot->moteur_id = $request->input('moteur_id');
        $ot->user_id = $request->input('user_id');
        $ot->recepteur_id = $request->input('recepteur_id');
        $ot->local_id = $request->input('local_id');
        $ot->emetteur = strtoupper($request->input('emetteur'));
        $ot->description = $request->input('description');
        $ot->date_reception = $request->input('date_reception');

        $ot->save();

        $request->session()->flash('message', ' OT ' . $ot->n_ot . ' has been updated');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ot  $ot
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ot $ot)
    {
        $id = $ot->id;

        if (is_null($id) || empty($id)) {

            return redirect()->route('ots.index');
        }


        Ot::destroy($id);

        return redirect()->route('ots.index');
   
    }
}
