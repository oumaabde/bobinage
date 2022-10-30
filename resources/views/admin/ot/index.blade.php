@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <h2>Liste des Ots</h2>
            <a class="btn btn-primary" href="{{ route('ots.create') }}">Add New OT</a>
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
                <th scope="col">Date reception</th>
                <th scope="col">N° OT</th>
                <th scope="col">N° Serie Moteur</th>
                <th scope="col">Marque</th>
                <th scope="col">Puissance</th>
                <th scope="col">Recepteur</th>
                <th scope="col">Local</th>
                <th scope="col">Date enlevement</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                
                @foreach ( $ots as $ot )
                    <tr>
                        <th>{{ $ot->date_reception ? $ot->date_reception : "...." }}</th>
                    <td scope="row">{{ $ot->n_ot ? $ot->n_ot : "...." }}</td>
                        <td>
   
                        <a class="btn btn-success" href="{{ route('moteurs.show', ['moteur' => $ot->moteur]) }}">{{ $ot->moteur->n_serie }}</a>
           
                        </td>
                        <td>{{ $ot->moteur_id ? $ot->moteur->marque->name  : "...." }}</td>
                        <td>{{ $ot->moteur_id ? $ot->moteur->puissance : "...." }}</td>
                        <td>{{ $ot->recepteur_id ? $ot->recepteur->name : "...."}}</td>
                        <td>{{ $ot->local_id ? $ot->local->name : "...." }}</td> 
                        <td>{{ $ot->date_enlevement ? $ot->date_enlevement : "...." }}</td>

                        <td>
                            <a class="btn btn-primary" href="{{ route('rapports.edit',  $ot->id) }}">Rapport</a>
                            <a class="btn btn-primary" href="{{ route('ots.edit', $ot) }}">Edit OT</a>
                            <form style="display: inline-block;" action="ots/{{ $ot->id }}" method="post">

                                  @csrf
                                  <input type="hidden" name="_method" value="delete" />
                                  <input type="hidden" name="ot_id" value="{{ $ot->id }}">
                                
                                </form>
                                <a class="btn btn-danger confimationDelete" data-otid="{{ $ot->id }}" data-toggle="modal" data-target="#confimationDelete">Delete</a>
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
                <h5 class="modal-title" id="exampleModalLabel">Delete Ot</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-right">
                <h3>you are sure??</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                <form id="ot_id_delete_form" class="col-md-6" action="" method="post">
                    @csrf
                    
                    <button type="submit" class="btn btn-danger col-md-12">حذف</button>
                    <input type="hidden" name="_method" value="delete" />
                    <input id="ot_id_delete" type="hidden" name="ot_id" value="">
                </form>
            </div>
            </div>
        </div>
    </div>

@endsection
