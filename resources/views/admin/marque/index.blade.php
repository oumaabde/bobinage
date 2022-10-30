@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <h2>Liste des Marques <a class="btn btn-primary" href="{{ route('marques.create') }}">Add New Marque</a></h2>
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
                <th scope="col">Marque Name</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                
                @foreach ( $marques as $marque )
                    <tr>
                    <th class="col-9" scope="row">{{ $marque->name ? $marque->name : "...." }}</th>

                        <td class="col-3">
                            <a class="btn btn-primary" href="{{ route('marques.edit', ['marque' => $marque]) }}">Edit Marque</a>
                            <form style="display: inline-block;" action="marques/{{ $marque->id }}}" method="post">

                                  @csrf
                                  <input type="hidden" name="_method" value="delete" />
                                  <input type="hidden" name="marque_id" value="{{ $marque->id }}">
                                
                                </form>
                                <a class="btn btn-danger confimationDelete" data-marqueid="{{ $marque->id }}" data-toggle="modal" data-target="#confimationDelete">Delete</a>
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
                <h5 class="modal-title" id="exampleModalLabel">Delete Marque</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-right">
                <h3>you are sure??</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                <form id="marque_id_delete_form" class="col-md-6" action="" method="post">
                    @csrf
                    
                    <button type="submit" class="btn btn-danger col-md-12">حذف</button>
                    <input type="hidden" name="_method" value="delete" />
                    <input id="marque_id_delete" type="hidden" name="marque_id" value="">
                </form>
            </div>
            </div>
        </div>
    </div>

@endsection
