@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboread
                    <a class="btn btn-primary" href="{{ route('ots.index') }}">OTS</a>
                </div>

                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                     @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        </div>
                    @endif
                    <div class="row">
                        <div class="accordion col-md-12" id="accordionExample">


                        <div class="card">

                            <div class="card-header" id="headingOne">
                              <h2 class="mb-0">
                                <button class="btn btn-success btn-lg btn-block" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                  <h5 class="">
                                    Rapport (OT : {{ $ot->n_ot }})
                                  </h5>
                                 
                                </button>
                                  
                              </h2>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                              <div class="card-body">
                                <h5 class="card-title"></h5>
                            <form action="{{ route('rapports.update',$ot) }}" method="post" >
 
                                  @csrf
                                    <input type="hidden" name="_method" value="PUT">
                                  <div class="form-row">
                                <div class="form-group col-md-4">
                                      <label for="inputNOt">N° OT</label>
                                      <input type="text"  class="form-control" id="inputNOt" name="n_ot" value="{{ $ot->n_ot }}" placeholder="N° OT" required>
                                  </div>
                                    <div class="form-group col-md-4">
                                    <label for="inputNSerieMoteur">N° Serie Moteur</label>
                                    <select class="custom-select custom-select-md" id="inputNSerieMoteur" name="moteur_id" placeholder="Moteur" required>
                                      <option value="">Select N° Serie Moteur</option>
                                        @foreach ($moteurs as $moteur )
                                            <option {{ $moteur->id == $ot->moteur->id ? 'selected' : '' }} value="{{ $moteur->id }}">{{ $moteur->n_serie }}</option>
                                        @endforeach
                                        
                                    </select> 
                                  </div>
                                    <div class="form-group col-md-4">
                                    <label for="inputRecepteur">Recepteur</label>
                                    <select class="custom-select custom-select-md" id="inputRecepteur" name="recepteur_id" placeholder="Recepteur" required>
                                      <option  value="">Select Recepteur</option>
                                        @foreach ($agents as $agent )
                                            <option {{ $agent->id == $ot->recepteur_id ? 'selected' : '' }} value="{{ $agent->id }}">{{ $agent->name }}</option>
                                        @endforeach
                                        
                                    </select> 
                                  </div>
                                  <div class="form-group col-md-4">
                                    <label for="inputResponsable">Responsable d'éxecution</label>
                                    <select class="custom-select custom-select-md" id="inputResponsable" name="responsable_id" placeholder="Responsable d'éxecution" >
                                      <option  value="">Select Responsable d'éxecution</option>
                                        @foreach ($agents as $agent )
                                            <option {{ $agent->id == $ot->responsable_id ? 'selected' : '' }} value="{{ $agent->id }}">{{ $agent->name }}</option>
                                        @endforeach
                                        
                                    </select> 
                                  </div>
                                    <div class="form-group col-md-4">
                                    <label for="inputLocal">Local</label>
                                    <select class="custom-select custom-select-md" id="inputLocal" name="local_id" placeholder="Local" required>
                                      <option  value="">Select Local</option>
                                        @foreach ($locals as $local )
                                            <option {{ $local->id == $ot->local_id ? 'selected' : '' }} value="{{ $local->id }}">{{ $local->name }}</option>
                                        @endforeach
                                        
                                    </select> 
                                  </div>
                                    <div class="form-group col-md-4">
                                      <label for="inputEmetteur">Emetteur</label>
                                      <input type="text"  class="form-control" id="inputEmetteur" name="emetteur" value="{{ $ot->emetteur }}" placeholder="Emetteur" >
                                    </div>
                                    <div class="form-group col-md-4">
                                      <label for="inputDateReception">Date reception</label>
                                      <input type="date"  class="form-control" id="inputDateReception" name="date_reception" value="{{ $ot->date_reception }}" placeholder="Date Reception" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                      <label for="inputDescription">Description</label>
                                      <textarea  class="form-control" id="inputDescription" name="description"  placeholder="Description" >{{ $ot->description != null ? $ot->description : '' }}</textarea>
                                      </textarea>
                                    </div>

                                    <div class="form-group col-md-4">
                                      <label for="inputConnexion">Connexion</label>
                                    
                                      <select class="custom-select custom-select-md" id="inputLocal" name="connexion" placeholder="Connexion">
                                      <option  value="">Select Connexion</option>
                                      
                                            <option {{ $ot->connexion == 'serie' ? 'selected' : '' }} value="serie">serie</option>

                                            <option {{ $ot->connexion == 'parallel' ? 'selected' : '' }} value="parallel">parallel</option>

                                            <option {{ $ot->connexion == 'serie parallel' ? 'selected' : '' }} value="{serie parallel">serie parallel</option>
                                      
                                        
                                    </select> 
                                    </div>

                                    <div class="form-group col-md-4">
                                      <label for="inputNBobines">Numbre des bobines</label>
                                      <input type="text"  class="form-control" id="inputNBobines" name="n_bobines" value="{{ $ot->n_bobines ? $ot->n_bobines : '' }}" placeholder="Entrer Numbre des bobines">
                                    </div>

                                    <div class="form-group col-md-4">
                                      <label for="inputNGroupes">Numbre des groupes</label>
                                      <input type="text" class="form-control" id="inputNGroupes" name="n_groupes" value="{{ $ot->n_groupes ? $ot->n_groupes : '' }}" placeholder="Entrer Numbre des groupes">
                                    </div>

                                    <div class="form-group col-md-4">
                                      <label for="inputNBobinesGroupe">Numbre des bobines par groupe</label>
                                      <input type="text" class="form-control" id="inputNBobinesGroupe" name="n_bobines_group" value="{{ $ot->n_bobines_group ? $ot->n_bobines_group : '' }}" placeholder="Entrer Numbre des bobines par groupe">
                                    </div>

                                    <div class="form-group col-md-4">
                                      <label for="inputNBobines">Numbre des spires bobine</label>
                                      <input type="text" class="form-control" id="inputNBobines" name="n_spires_bobine" value="{{ $ot->n_spires_bobine ? $ot->n_spires_bobine : '' }}" placeholder="Entrer Numbre des spires par bobine">
                                    </div>

                                    <div class="form-group col-md-4">
                                      <label for="inputNPhases">Numbre des phases</label>
                                      <input type="number" min="0" class="form-control" id="inputNPhases" name="n_phases" value="{{ $ot->n_phases ? $ot->n_phases : '' }}" placeholder="Entrer Numbre des phases">
                                    </div>

                                    <div class="form-group col-md-4">
                                      <label for="inputNEncouches">Numbre des encouches</label>
                                      <input type="number" min="0" class="form-control" id="inputNEncouches" name="n_encouches" value="{{ $ot->n_encouches ? $ot->n_encouches : '' }}" placeholder="Entrer Numbre des encouches">
                                    </div>

                                    <div class="form-group col-md-4">
                                      <label for="inputNPoles">Numbre des poles</label>
                                      <input type="number" min="0" class="form-control" id="inputNPoles" name="n_poles" value="{{ $ot->n_poles ? $ot->n_poles : '' }}" placeholder="Entrer Numbre des poles">
                                    </div>

                                    <div class="form-group col-md-4">
                                      <label for="inputPas">Pas</label>
                                      <input type="text"  class="form-control" id="inputPas" name="pas" value="{{ $ot->pas ? $ot->pas : '' }}" placeholder="Entrer le pas">
                                    </div>

                                    <div class="form-group col-md-4">
                                      <label for="inputNFilesEncouche">Numbre des fils par encouche</label>
                                      <input type="text"  class="form-control" id="inputNFilesEncouche" name="n_fils_encouche" value="{{ $ot->n_fils_encouche ? $ot->n_fils_encouche : '' }}" placeholder="Entrer Numbre des fils par encouche">
                                    </div>

                                    <div class="form-row">
                                      <div class="form-group col-md-2">
                                      <label for="inputNFil01">Section Fil 01</label>
                                      <input type="number" step="0.01" min="0" class="form-control" id="inputNFil01" name="n_fil_1" value="{{ $ot->n_fil_1 ? $ot->n_fil_1 : '' }}" placeholder="Entrer Section Fil 01">
                                    </div>

                                    <div class="form-group col-md-2">
                                      <label for="inputNFil02">Section Fil 02</label>
                                      <input type="number" step="0.01" min="0" class="form-control" id="inputNFil02" name="n_fil_2" value="{{ $ot->n_fil_2 ? $ot->n_fil_2 : '' }}" placeholder="Entrer Section Fil 02">
                                    </div>

                                    <div class="form-group col-md-2">
                                      <label for="inputNFil03">Section Fil 03</label>
                                      <input type="number" step="0.01" min="0" class="form-control" id="inputNFil03" name="n_fil_3" value="{{ $ot->n_fil_3 ? $ot->n_fil_1 : '' }}" placeholder="Entrer Section Fil 03">
                                    </div>

                                    <div class="form-group col-md-2">
                                      <label for="inputNFil04">Section Fil 04</label>
                                      <input type="number" step="0.01" min="0" class="form-control" id="inputNFil04" name="n_fil_4" value="{{ $ot->n_fil_4 ? $ot->n_fil_4 : '' }}" placeholder="Entrer Section Fil 04">
                                    </div>

                                    <div class="form-group col-md-2">
                                      <label for="inputNFil05">Section Fil 05</label>
                                      <input type="number" step="0.01" min="0" class="form-control" id="inputNFil05" name="n_fil_5" value="{{ $ot->n_fil_5 ? $ot->n_fil_5 : '' }}" placeholder="Entrer Section Fil 05">
                                    </div>

                                    <div class="form-group col-md-2">
                                      <label for="inputNFil06">Section Fil 06</label>
                                      <input type="number" step="0.01" min="0" class="form-control" id="inputNFil01" name="n_fil_6" value="{{ $ot->n_fil_6 ? $ot->n_fil_6 : '' }}" placeholder="Entrer Section Fil 06">
                                    </div>

                                    <div class="form-group col-md-2">
                                      <label for="inputNFil07">Section Fil 07</label>
                                      <input type="number" step="0.01" min="0" class="form-control" id="inputNFil07" name="n_fil_7" value="{{ $ot->n_fil_7 ? $ot->n_fil_7 : '' }}" placeholder="Entrer Section Fil 07">
                                    </div>

                                    <div class="form-group col-md-2">
                                      <label for="inputNFil08">Section Fil 08</label>
                                      <input type="number" step="0.01" min="0" class="form-control" id="inputNFil08" name="n_fil_8" value="{{ $ot->n_fil_8 ? $ot->n_fil_8 : '' }}" placeholder="Entrer Section Fil 08">
                                    </div>

                                    <div class="form-group col-md-2">
                                      <label for="inputNFil09">Section Fil 09</label>
                                      <input type="number" step="0.01" min="0" class="form-control" id="inputNFil09" name="n_fil_9" value="{{ $ot->n_fil_9 ? $ot->n_fil_9 : '' }}" placeholder="Entrer Section Fil 09">
                                    </div>

                                    <div class="form-group col-md-2">
                                      <label for="inputNFil10">Section Fil 10</label>
                                      <input type="number" step="0.01" min="0" class="form-control" id="inputNFil10" name="n_fil_10" value="{{ $ot->n_fil_10 ? $ot->n_fil_10 : '' }}" placeholder="Entrer Section Fil 10">
                                    </div>
                                    </div>

                                    <div class="form-row">
                                      <div class="form-group col-md-4">
                                      <label for="inputPhaseA">Courant phase A</label>
                                      <input type="number" step="0.01" min="0" class="form-control" id="inputPhaseA" name="phase_test_a" value="{{ $ot->phase_test_a ? $ot->phase_test_a : '' }}" placeholder="Entrer Courant phase A">
                                    </div>

                                    <div class="form-group col-md-4">
                                      <label for="inputPhaseB">Courant phase B</label>
                                      <input type="number" step="0.01" min="0" class="form-control" id="inputPhaseB" name="phase_test_b" value="{{ $ot->phase_test_b ? $ot->phase_test_b : '' }}" placeholder="Entrer Courant phase B">
                                    </div>

                                    <div class="form-group col-md-4">
                                      <label for="inputPhaseC">Courant phase C</label>
                                      <input type="number" step="0.01" min="0" class="form-control" id="inputPhaseC" name="phase_test_c" value="{{ $ot->phase_test_c ? $ot->phase_test_c : '' }}" placeholder="Entrer Courant phase C">
                                    </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                      <label for="inputTravauxEffectues">Travaux Effectues</label>
                                      <textarea  class="form-control" id="inputTravauxEffectues" name="travaux_effectues"  placeholder="Travaux Effectues" >{{ $ot->travaux_effectues != null ? $ot->travaux_effectues : '' }}</textarea>
                                      </textarea>
                                    </div>

                                    <div class="form-group col-md-4">
                                      <label for="inputDateEssai">Date Essai</label>
                                      <input type="date"  class="form-control" id="inputDateEssai" name="date_essai" value="{{ $ot->date_essai ? $ot->date_essai : ''}}" placeholder="date_essai" >
                                    </div>

                                    <div class="form-group col-md-4">
                                      <label for="inputDateEnlevement">Date Enlevement</label>
                                      <input type="date"  class="form-control" id="inputDateEnlevement" name="date_enlevement" value="{{ $ot->date_enlevement ? $ot->date_enlevement : ''}}" placeholder="Date Enlevement" >
                                    </div>

                                    <div class="form-group col-md-4">
                                      <label for="inputEmetteur">Statut</label>
                                      <input type="text"  class="form-control" id="inputEmetteur" name="statut" value="{{ $ot->statut ? $ot->statut : ''}}" placeholder="Statut">
                                    </div>

                                    <div class="form-group col-md-12">
                                      <label for="inputModification">modification</label>
                                      <textarea  class="form-control" id="inputModification" name="modification"  placeholder="Modification" >{{ $ot->modification != null ? $ot->modification : '' }}</textarea>
                                      </textarea>
                                    </div>



                                    <div class="form-group col-md-4">
                                      <label for="inputUser"></label>
                                            <input type="text"  class="form-control"  id="inputUser"  name="user_id" value="{{ $user->id }}" placeholder="User" hidden>
                                    </div>
                                    
                                  </div>
                                  
                                  <button type="submit" class="btn btn-primary btn-lg btn-block">Update</button>
                                </form>
                              </div>
                            </div>
                          </div>
                     </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

