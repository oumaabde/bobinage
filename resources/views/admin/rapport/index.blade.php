@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <h2>Liste des Rapports</h2>
            <a class="btn btn-primary" href="{{ route('rapports.create') }}">Add New Rapport</a>
            <a class="btn btn-success" href="{{ route('dashboard') }}">Home</a>
        </div>
        <div class="row">
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
        </div>
        <table id="bobinage-table" class="table table-striped"class="table">
            <thead>
                <tr>
                <th scope="col">N° OT</th>
                <th scope="col">N° Serie Moteur</th>
                <th scope="col">Marque</th>
                <th scope="col">Puissance</th>
                <th scope="col">Recepteur</th>
                <th scope="col">Local</th>
                <th scope="col">Testeur</th>
                <th scope="col">Les participants test</th>
                <th scope="col">Preneur</th>
                <th scope="col">Emetteur</th>
                <th scope="col">Travaux Effectues</th>
                <th scope="col">Date reception</th>
                <th scope="col">Date enlevement</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                
                @foreach ( $rapports as $rapport )
                    @if ( $rapport->rapport == true)
                        <tr>
                    <th scope="row">{{ $rapport->n_ot ? $rapport->n_ot : "...." }}</th>
                        <td>
                            {{ $rapport->moteur_id ? $rapport->moteur->n_serie : "...." }}
   
                        <a class="btn btn-success" href="{{ route('moteurs.show', ['moteur' => $rapport->moteur]) }}">{{ $rapport->moteur->n_serie }}</a>
           
                        </td>
                        <td>{{ $rapport->moteur_id ? $rapport->moteur->marque->name  : "...." }}</td>
                        <td>{{ $rapport->moteur_id ? $rapport->moteur->puissance . " Kw" : "...." }}</td>
                        <td>{{ $rapport->recepteur_id ? $rapport->recepteur->name : "...."}}</td>
                        <td>{{ $rapport->local_id ? $rapport->local->name : "...." }}</td>
                        <td>{{ $rapport->testeur_id ? $rapport->testeur->name : "...." }}</td>
                        <td>{{ $rapport->noms_participants_test ? $rapport->noms_participants_test : "...." }}</td>
                        <td>{{ $rapport->preneur ? $rapport->preneur : "...." }}</td>
                        <td>{{ $rapport->emetteur ? $rapport->emetteur : "...." }}</td>
                        <td>{{ $rapport->travaux_effectues ? $rapport->travaux_effectues : "...." }}</td>
                        <td>{{ $rapport->date_reception ? $rapport->date_reception : "...." }}</td>
                        <td>{{ $rapport->date_enlevement ? $rapport->date_enlevement : "...." }}</td>

                        <td>
                            <a class="btn btn-primary" href="{{ route('rapports.edit', ['rapport' => $rapport]) }}">Edit Rapport</a>
                            <form style="display: inline-block;" action="ots/{{ $rapport->id }}" method="post">

                                  @csrf
                                  <input type="hidden" name="_method" value="delete" />
                                  <input type="hidden" name="rapport_id" value="{{ $rapport->id }}">
                                
                                </form>
                                <a class="btn btn-danger confimationDelete" data-otid="{{ $rapport->id }}" data-toggle="modal" data-target="#confimationDelete">Delete</a>
                        </td>
                        
                        
                    </tr>
                    @endif
                @endforeach
                
            </tbody>
            </table>
    </div>


    <div class="modal fade" id="confimationDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Rapport</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-right">
                <h3>you are sure??</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                <form id="rapport_id_delete_form" class="col-md-6" action="" method="post">
                    @csrf
                    
                    <button type="submit" class="btn btn-danger col-md-12">حذف</button>
                    <input type="hidden" name="_method" value="delete" />
                    <input id="rapport_id_delete" type="hidden" name="rapport_id" value="">
                </form>
            </div>
            </div>
        </div>
    </div>

@endsection
