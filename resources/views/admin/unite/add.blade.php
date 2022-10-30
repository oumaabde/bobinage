@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboread
                    <a class="btn btn-primary" href="{{ route('unites.index') }}">Unites</a>
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
                                   Unite
                                  </h5>
                                 
                                </button>
                                  
                              </h2>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                              <div class="card-body">
                                <h5 class="card-title"></h5>
                            <form action="{{ route('unites.store') }}" method="post" >
 
                                  @csrf

                                  <div class="form-row">
                          
                                  <div class="form-group col-md-4">
                                      <label for="inputUnite">Unite Name</label>
                                      <input type="text"  class="form-control" id="inputUnite" name="name" value="" placeholder="Unite Name" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                      <label for="inputUniteImputation">Imputation</label>
                                      <input type="text"  class="form-control" id="inputUniteImputation" name="imputation" value="" placeholder="Unite Imputation" required>
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
