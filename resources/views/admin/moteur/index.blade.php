@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <h2>Liste des Moteurs <a class="btn btn-primary" href="{{ route('moteurs.create') }}">Add New Moteur</a></h2>
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
        <table id="bobinage-table" class="table table-striped">
            <thead>
                <tr>
                <th scope="col">Marque</th>
                <th scope="col">N° Serie</th>
                <th scope="col">Puissance</th>
                <th scope="col">Courant</th>
                <th scope="col">Tension</th>
                <th scope="col">Frequence</th>
                <th scope="col">Roulement A</th>
                <th scope="col">Roulement B</th>
                <th scope="col">Unite</th>
                <th scope="col">Ots count</th>
                <th scope="col">Local</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                
                @foreach ( $moteurs as $moteur )
                    <tr>
                    <th scope="row">{{ $moteur->marque->name ? $moteur->marque->name : "...." }}</th>
                        <td>{{ $moteur->n_serie ? $moteur->n_serie : "...." }}</td>
                        <td>{{ $moteur->puissance ? $moteur->puissance : "...."}}</td>
                        <td>{{ $moteur->courant ? $moteur->courant : "...." }}</td>
                        <td>{{ $moteur->tension ? $moteur->tension : "...." }}</td>
                        <td>{{ $moteur->frequence ? $moteur->frequence : "...." }}</td>
                        <td>{{ $moteur->roulement_a ? $moteur->roulement_a : "...." }}</td>
                        <td>{{ $moteur->roulement_b ? $moteur->roulement_b : "...." }}</td>
                        <td>{{ $moteur->unite->name ? $moteur->unite->name : "...." }}</td>
                        <td>
                            {{ $moteur->ots->count()  ?? $moteur->ots->count()  }}
                            @foreach ( $moteur->ots as $ot )
                        <a class="btn btn-success" href="{{ route('ots.show', ['ot' => $ot]) }}">{{ $ot->n_ot }}</a>
                    @endforeach
                        </td>
                        <td>@if ($moteur->ots->count() > 0)
                            {{ $moteur->ots[$moteur->ots->count()-1]->local ? $moteur->ots[$moteur->ots->count()-1]->local->name : "...."}}
                            @else
                            ....
                        @endif
                    </td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('moteurs.edit', ['moteur' => $moteur]) }}">Edit Moteur</a>
                            <form style="display: inline-block;" action="moteurs/{{ $moteur->id }}" method="post">

                                  @csrf
                                  <input type="hidden" name="_method" value="delete" />
                                  <input type="hidden" name="moteur_id" value="{{ $moteur->id }}">
                                
                                </form>
                                <a class="btn btn-danger confimationDelete" data-moteurid="{{ $moteur->id }}" data-toggle="modal" data-target="#confimationDelete">Delete</a>
                        </td>
                        
                        
                    </tr>
                    
                @endforeach
                
            </tbody>
            </table>
    </div>


    <div class="modal fade" id="confimationDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Moteur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-right">
                <h3>you are sure??</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                <form id="moteur_id_delete_form" class="col-md-6" action="" method="post">
                    @csrf
                    
                    <button type="submit" class="btn btn-danger col-md-12">حذف</button>
                    <input type="hidden" name="_method" value="delete" />
                    <input id="moteur_id_delete" type="hidden" name="moteur_id" value="">
                </form>
            </div>
            </div>
        </div>
    </div>

@endsection
