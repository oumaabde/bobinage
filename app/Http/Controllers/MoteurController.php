<?php

namespace App\Http\Controllers;

use App\Http\Requests\MoteurRequest;
use App\Models\Marque;
use App\Models\Moteur;
use App\Models\Unite;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MoteurController extends Controller
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
        return view('admin.moteur.index', ['moteurs' => Moteur::with('unite', 'marque', 'ots')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $marques = Marque::orderBy('name')->get();
        $unites = Unite::orderBy('name')->get();
        return view('admin.moteur.add')->with(['user' => $user, 'marques' => $marques, 'unites' => $unites]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MoteurRequest $request)
    {
        //dd($request);
        $moteurFind = Moteur::where('n_serie', $request->input('n_serie'))->first();
        if ($moteurFind) {
            $request->session()->flash('message', 'Moteur ' . $moteurFind->n_serie . ' Existe');
            return redirect()->route('moteurs.index');
        }
        $moteur = new Moteur();

        $moteur->marque_id = $request->input('marque_id');
        $moteur->unite_id = $request->input('unite_id');
        $moteur->user_id = $request->input('user_id');
        $moteur->puissance = $request->input('puissance');
        $moteur->courant = $request->input('courant');
        $moteur->vitesse = $request->input('vitesse');
        $moteur->frequence = $request->input('frequence');
        $moteur->tension = $request->input('tension');
        $moteur->cosph = $request->input('cosph');
        $moteur->roulement_a = $request->input('roulement_a');
        $moteur->roulement_b = $request->input('roulement_b');
        $moteur->couplage = $request->input('couplage');
        $moteur->n_serie = $request->input('n_serie');

        $moteur->save();

        $request->session()->flash('message', 'Moteur ' . $moteur->n_serie . ' has been added');

        return redirect()->route('moteurs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Moteur  $moteur
     * @return \Illuminate\Http\Response
     */
    public function show(Moteur $moteur)
    {
        return $moteur;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Moteur  $moteur
     * @return \Illuminate\Http\Response
     */
    public function edit(Moteur $moteur)
    {
        $user = Auth::user();
        $marques = Marque::orderBy('name')->get();
        $unites = Unite::orderBy('name')->get();
        return view('admin.moteur.edit')->with(['moteur' => $moteur,'user' => $user, 'marques' => $marques, 'unites' => $unites]);
    
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Moteur  $moteur
     * @return \Illuminate\Http\Response
     */
    public function update(MoteurRequest $request, Moteur $moteur)
    {


        $moteur_id = $moteur->id;

        $moteur = Moteur::find($moteur->id);

        $moteur->marque_id = $request->input('marque_id');
        $moteur->unite_id = $request->input('unite_id');
        $moteur->user_id = $request->input('user_id');
        $moteur->puissance = $request->input('puissance');
        $moteur->courant = $request->input('courant');
        $moteur->vitesse = $request->input('vitesse');
        $moteur->frequence = $request->input('frequence');
        $moteur->tension = $request->input('tension');
        $moteur->cosph = $request->input('cosph');
        $moteur->roulement_a = $request->input('roulement_a');
        $moteur->roulement_b = $request->input('roulement_b');
        $moteur->couplage = $request->input('couplage');
        $moteur->n_serie = $request->input('n_serie');

        $moteur->save();

        $request->session()->flash('message', ' Moteur ' . $moteur->n_serie . ' has been updated');

        return redirect()->back();
    }

    public function delete(MoteurRequest $request)
    {

        $id = $request->input('moteur_id');

        if (is_null($id) || empty($id)) {
            $request->session()->flash('message', 'Moteur ID is required');

            return redirect()->back();
        }


        Moteur::destroy($id);

        $request->session()->flash('message', 'Moteur has been deleted');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Moteur  $moteur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Moteur $moteur)
    {
        $id = $moteur->id;

        if (is_null($id) || empty($id)) {

            return redirect()->route('moteurs.index');
        }


        Moteur::destroy($id);

        return redirect()->route('moteurs.index');
    }
}
