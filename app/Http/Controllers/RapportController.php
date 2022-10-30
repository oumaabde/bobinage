<?php

namespace App\Http\Controllers;

use App\Http\Requests\RapportRequest;
use App\Models\Agent;
use App\Models\Local;
use App\Models\Moteur;
use App\Models\Ot;
use App\Models\Unite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RapportController extends Controller
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
        return view('admin.rapport.index', ['rapports' => Ot::with('moteur', 'local', 'recepteur', 'testeur')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $users = User::orderBy('name')->get();
        $locals = Local::orderBy('name')->get();
        $moteurs = Moteur::orderBy('n_serie')->get();
        $ots = Ot::orderBy('name')->get();
        return view('admin.rapport.add')->with(['ots' => $ots, 'user' => $user, 'users' => $users, 'moteurs' => $moteurs, 'locals' => $locals]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RapportRequest $request)
    {
        
        //dd($request);
        $otFind = Moteur::where('n_ot', $request->input('n_ot'))->first();
        if ($otFind) {
            $request->session()->flash('message', 'Rapport ' . $otFind->n_ot . ' Existe');
            return redirect()->route('rapports.index');
        }
        $ot = new Ot();

        $ot->n_ot = $request->input('n_ot');
        $ot->moteur_id = $request->input('moteur_id');
        $ot->user_id = $request->input('user_id');
        $ot->recepteur_id = $request->input('recepteur_id');
        $ot->local_id = $request->input('local_id');
        $ot->testeur_id = $request->input('testeur_id');
        $ot->responsable_id = $request->input('responsable_id');
        $ot->noms_participants_test = $request->input('noms_participants_test');
        $ot->preneur = strtoupper($request->input('preneur'));
        $ot->emetteur = strtoupper($request->input('emetteur'));
        $ot->description = $request->input('description');
        $ot->n_bobines = $request->input('n_bobines');
        $ot->n_bobines_group = $request->input('n_bobines_group');
        $ot->n_spires_bobine = $request->input('n_spires_bobine');
        $ot->n_phases = $request->input('n_phases');
        $ot->n_encouches = $request->input('n_encouches');
        $ot->n_poles = $request->input('n_poles');
        $ot->pas = $request->input('pas');
        $ot->n_fils_encouche = $request->input('n_fils_encouche');
        $ot->n_fil_1 = $request->input('n_fil_1');
        $ot->n_fil_2 = $request->input('n_fil_2');
        $ot->n_fil_3 = $request->input('n_fil_3');
        $ot->n_fil_4 = $request->input('n_fil_4');
        $ot->n_fil_5 = $request->input('n_fil_5');
        $ot->n_fil_6 = $request->input('n_fil_6');
        $ot->n_fil_7 = $request->input('n_fil_7');
        $ot->n_fil_8 = $request->input('n_fil_8');
        $ot->n_fil_9 = $request->input('n_fil_9');
        $ot->n_fil_10 = $request->input('n_fil_10');
        $ot->phase_test_a = $request->input('phase_test_a');
        $ot->phase_test_b = $request->input('phase_test_b');
        $ot->phase_test_c = $request->input('phase_test_c');
        $ot->travaux_effectues = $request->input('travaux_effectues');
        $ot->date_reception = $request->input('date_reception');
        $ot->date_essai = $request->input('date_essai');
        $ot->date_enlevement = $request->input('date_enlevement');
        $ot->rapport = $request->input('rapport');
        $ot->statut = $request->input('statut');
        $ot->modification = $request->input('modification');
        $ot->responsable_id = $request->input('responsable_id');
        

        $ot->save();

        $request->session()->flash('message', 'Rapport ' . $ot->n_ot . ' has been added');

        return redirect()->route('rapports.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ot  $ot
     * @return \Illuminate\Http\Response
     */
    public function show(Ot $ot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ot  $ot
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //dd(Ot::find($id));
        $user = Auth::user();
        $users = User::orderBy('name')->get();
        $locals = Local::orderBy('name')->get();
        $moteurs = Moteur::orderBy('n_serie')->get();
        $agents = Agent::orderBy('name')->get();
        $ot = Ot::find($id);
//$ot = Ot::find($id);
        return view('admin.rapport.edit')->with(['agents' => $agents,'ot' => $ot ,'moteurs' => $moteurs, 'user' => $user, 'users' => $users, 'locals' => $locals]);
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ot  $ot
     * @return \Illuminate\Http\Response
     */
    public function update(RapportRequest $request, $id)
    {
        $ot = Ot::find($id);
        //dd(Ot::find($id));

        $ot->n_ot = $request->input('n_ot');
        $ot->moteur_id = $request->input('moteur_id');
        $ot->user_id = $request->input('user_id');
        $ot->recepteur_id = $request->input('recepteur_id');
        $ot->local_id = $request->input('local_id');
        $ot->testeur_id = $request->input('testeur_id');
        $ot->noms_participants_test = $request->input('noms_participants_test');
        $ot->preneur = $request->input('preneur');
        $ot->emetteur = $request->input('emetteur');
        $ot->description = $request->input('description');
        $ot->n_bobines = $request->input('n_bobines');
        $ot->n_bobines_group = $request->input('n_bobines_group');
        $ot->n_spires_bobine = $request->input('n_spires_bobine');
        $ot->n_phases = $request->input('n_phases');
        $ot->n_encouches = $request->input('n_encouches');
        $ot->n_poles = $request->input('n_poles');
        $ot->pas = $request->input('pas');
        $ot->n_fils_encouche = $request->input('n_fils_encouche');
        $ot->n_fil_1 = $request->input('n_fil_1');
        $ot->n_fil_2 = $request->input('n_fil_2');
        $ot->n_fil_3 = $request->input('n_fil_3');
        $ot->n_fil_4 = $request->input('n_fil_4');
        $ot->n_fil_5 = $request->input('n_fil_5');
        $ot->n_fil_6 = $request->input('n_fil_6');
        $ot->n_fil_7 = $request->input('n_fil_7');
        $ot->n_fil_8 = $request->input('n_fil_8');
        $ot->n_fil_9 = $request->input('n_fil_9');
        $ot->n_fil_10 = $request->input('n_fil_10');
        $ot->phase_test_a = $request->input('phase_test_a');
        $ot->phase_test_b = $request->input('phase_test_b');
        $ot->phase_test_c = $request->input('phase_test_c');
        $ot->travaux_effectues = $request->input('travaux_effectues');
        $ot->date_reception = $request->input('date_reception');
        $ot->date_essai = $request->input('date_essai');
        $ot->date_enlevement = $request->input('date_enlevement');
        $ot->rapport = $request->input('rapport') != '' ?  $request->input('rapport') : 0;
        $ot->statut = $request->input('statut');
        $ot->modification = $request->input('modification');
        $ot->responsable_id = $request->input('responsable_id');

        $ot->save();

        $request->session()->flash('message', ' Rapport ' . $ot->n_ot . ' has been updated');

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

            return redirect()->route('rapports.index');
        }


        Ot::destroy($id);

        return redirect()->route('rapports.index');
   
    }
}
