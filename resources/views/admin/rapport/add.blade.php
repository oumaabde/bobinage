@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboread
                    <a class="btn btn-primary" href="{{ route('ots.index') }}">OTS</a>
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
                                    ADD OT
                                  </h5>
                                 
                                </button>
                                  
                              </h2>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                              <div class="card-body">
                                <h5 class="card-title"></h5>
                            <form action="{{ route('ots.store') }}" method="post" >
 
                                  @csrf
                                <div class="form-row">
                                  <div class="form-group col-md-4">
                                      <label for="inputNOt">N?? OT</label>
                                      <input type="text"  class="form-control" id="inputNOt" name="n_ot" value="{{ $ot->n_ot }}" placeholder="N?? OT" required>
                                  </div>
                                    <div class="form-group col-md-4">
                                    <label for="inputNSerieMoteur">N?? Serie Moteur</label>
                                    <select class="custom-select custom-select-md" id="inputNSerieMoteur" name="moteur_id" placeholder="Moteur" required>
                                      <option selected value="">Select N?? Serie Moteur</option>
                                        @foreach ($moteurs as $moteur )
                                            <option  value="{{ $moteur->id }}">{{ $moteur->n_serie }}</option>
                                        @endforeach
                                        
                                    </select> 
                                  </div>
                                    <div class="form-group col-md-4">
                                    <label for="inputRecepteur">Recepteur</label>
                                    <select class="custom-select custom-select-md" id="inputRecepteur" name="recepteur_id" placeholder="Recepteur" required>
                                      <option value="">Select Recepteur</option>
                                        @foreach ($users as $user )
                                            <option selected = {{ $user->id == $ot->recepteur_id ? 'selected' : '' }}  value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                        
                                    </select> 
                                  </div>
                                  <div class="form-group col-md-4">
                                    <label for="inputTesteur">Testeur</label>
                                    <select class="custom-select custom-select-md" id="inputTesteur" name="testeur_id" placeholder="Testeur" >
                                      <option selected value="">Select Testeur</option>
                                        @foreach ($users as $user )
                                            <option selected = {{ $user->id == $ot->testeur_id ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                        
                                    </select> 
                                  </div>
                                    <div class="form-group col-md-4">
                                    <label for="inputLocal">Local</label>
                                    <select class="custom-select custom-select-md" id="inputLocal" name="local_id" placeholder="Local" required>
                                      <option selected value="">Select Local</option>
                                        @foreach ($locals as $local )
                                            <option selected = {{ $local->id == $ot->local_id ? 'selected' : '' }} value="{{ $local->id }}">{{ $local->name }}</option>
                                        @endforeach
                                        
                                    </select> 
                                  </div>
                                    <div class="form-group col-md-4">
                                      <label for="inputEmetteur">Emetteur</label>
                                      <input type="text"  class="form-control" id="inputEmetteur" name="emetteur" value="{{ $ot->emetteur != null ? $ot->emetteur : '' }}" placeholder="Emetteur" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                      <label for="inputDateReception">Date reception</label>
                                      <input type="date"  class="form-control" id="inputDateReception" name="date_reception" value="{{ $ot->date_reception != null ? $ot->date_reception : '' }}" placeholder="Date Reception" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                      <label for="inputDescription">Description</label>
                                      <textarea  class="form-control" id="inputDescription" name="description" value="" placeholder="Description" required>{{ $ot->description != null ? $ot->description : '' }}</textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                      <label for="inputNBobines">Numbre des bobines</label>
                                      <input type="text"  class="form-control" id="inputNBobines" name="n_bobines" value="{{ $ot->n_bobines != null ? $ot->n_bobines : '' }}" placeholder="Emetteur" required>
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
@endsection
