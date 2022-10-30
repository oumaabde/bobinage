@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboread
                          <a class="btn btn-primary" href="{{ route('moteurs.index') }}">Moteurs</a>
                          <a class="btn btn-success" href="{{ route('dashboard') }}">Home</a>
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
                                    Add Moteur
                                  </h5>
                                 
                                </button>
                                  
                              </h2>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                              <div class="card-body">
                                <h5 class="card-title"></h5>
                            <form action="{{ route('moteurs.store') }}" method="post" >
 
                                  @csrf

                                  <div class="form-row">
                                <div class="form-group col-md-4">
                                 
                                    <div class="col-12 p-0" style="display: inline-block;">
                                       <div class="align-self-end" style="display: contents;">
                                      <a class="btn btn-primary confimationAddMarque"  data-toggle="modal" data-target="#confimationAddMarque">+</a>
                                    </div>
                                      <label for="inputMarqueId">Marques</label>
                                    <select class="custom-select custom-select-md" id="inputMarqueId" name="marque_id" placeholder="Marque" required>
                                      <option selected value="">Select Marque</option>
                                        @foreach ($marques as $marque )
                                            <option  value="{{ $marque->id }}">{{ $marque->name }}</option>
                                        @endforeach
                                        
                                    </select> 
                                    </div>
                                    
                                    
                                  </div>

                                  <div class="form-group col-md-4">
                                    
                                    <div class="col-12 p-0" style="display: inline-block;">
                                      <div class="align-self-end" style="display: contents;">
                                      <a class="btn btn-primary confimationAddUnite"  data-toggle="modal" data-target="#confimationAddUnite">+</a>
                                    </div>
                                      <label for="inputUniteId">Unites</label>
                                      <select class="custom-select custom-select-md" id="inputUniteId" name="unite_id" placeholder="Unites" required>
                                        <option selected value="">Select Unite</option>
                                          @foreach ($unites as $unite )
                                              <option  value="{{ $unite->id }}">{{ $unite->name ." ( " . $unite->imputation . " )" }}</option>
                                          @endforeach
                                          
                                      </select> 
                                    </div>
                                  </div>
                                  <div class="form-group col-md-4">
                                      <label for="inputNSerie">N° Serie</label>
                                      <input type="text"  class="form-control" id="inputNSerie" name="n_serie" value="{{ old('n_serie') }}" placeholder="N° Serie" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                      <label for="inputPuissance">Puissance</label>
                                      <input type="text"  class="form-control" id="inputPuissance" name="puissance" value="" placeholder="Puissance" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                      <label for="inputCourant">Courant</label>
                                      <input type="text"  class="form-control" id="inputCourant" name="courant" value="" placeholder="Courant" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                      <label for="inputVitesse">Vitesse</label>
                                      <input type="text"  class="form-control" id="inputVitesse" name="vitesse" value="" placeholder="Vitesse" >
                                    </div>
                                    <div class="form-group col-md-4">
                                      <label for="inputFrequence">Frequence</label>
                                      <input type="text"  class="form-control" id="inputFrequence" name="frequence" value="" placeholder="Frequence" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                      <label for="inputTension">Tension</label>
                                      <input type="text"  class="form-control" id="inputTension" name="tension" value="" placeholder="Tension" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                      <label for="inputCosph">Cosph</label>
                                      <input type="text"  class="form-control" id="inputCosph" name="cosph" value="" placeholder="Cosph" >
                                    </div>
                                    <div class="form-group col-md-4">
                                      <label for="inputRoulementA">Roulement A</label>
                                      <input type="text"  class="form-control" id="inputRoulementA" name="roulement_a" value="" placeholder="Roulement A" >
                                    </div>
                                    <div class="form-group col-md-4">
                                      <label for="inputRoulementB">Roulement B</label>
                                      <input type="text"  class="form-control" id="inputRoulementB" name="roulement_b" value="" placeholder="Roulement B" >
                                    </div>
                                    <div class="form-group col-md-4">
                                    <label for="inputCouplage">Couplage</label>
                                    <select class="custom-select custom-select-md" id="inputCouplage" name="couplage" placeholder="Couplage" >
                                      <option selected value="">Select Couplage</option>
                                      <option  value="traingle">Traingle</option>
                                    <option  value="etoile">Etoile</option>
                                    </select> 
                                  </div>
                                    <div class="form-group col-md-4">
                                      <label for="inputUser"></label>
                                            <input type="text"  class="form-control"  id="inputUser"  name="user_id" value="{{ $user->id }}" placeholder="User" hidden>
                                    </div>
                                    
                                  </div>
                                  
                                  <button type="submit" class="btn btn-primary btn-lg btn-block">Add</button>
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


    <div class="modal fade" id="confimationAddMarque" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Marque</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="marque_add_form" class="col-md-12" action="{{ route('marques.store') }}" method="post">
                    @csrf
            <div class="modal-body text-right">
                <div class="form-group">
                  <label for="AddMarque">Marque</label>
                  <input type="text"  class="form-control col-12" id="AddMarque" name="name" value="" placeholder="New Marque" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                
                    
                    <button type="submit" class="btn btn-danger">Add Marque</button>
                </form>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confimationAddUnite" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Unite</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="unite_add_form" class="col-md-12" action="{{ route('unites.store') }}" method="post">
                    @csrf
            <div class="modal-body text-right">
                <div class="form-group">
                  <label for="AddUnite">Unite</label>
                  <input type="text"  class="form-control col-12" id="AddUnite" name="name" value="" placeholder="Name Unite" required>
                
                  <label for="AddImputation">Impultation</label>
                  <input type="text"  class="form-control col-12" id="AddImputation" name="imputation" value="" placeholder="Imputation" required>
                
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                
                    
                    <button type="submit" class="btn btn-danger">Add Unite</button>
                </form>
            </div>
            </div>
        </div>
    </div>


@endsection
