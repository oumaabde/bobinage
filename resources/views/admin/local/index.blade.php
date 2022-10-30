@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <h2>Liste des Locaux <a class="btn btn-primary" href="{{ route('locals.create') }}">Add New Local</a></h2>
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
                <th scope="col">Local Name</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                
                @foreach ( $locaux as $local )
                    <tr>
                    <th scope="row">{{ $local->name ? $local->name : "...." }}</th>

                        <td class="col-3">
                            <a class="btn btn-primary" href="{{ route('locals.edit', ['local' => $local]) }}">Edit Local</a>
                            <form style="display: inline-block;" action="locals/{{ $local->id }}}" method="post">

                                  @csrf
                                  <input type="hidden" name="_method" value="delete" />
                                  <input type="hidden" name="local_id" value="{{ $local->id }}">
                                
                                </form>
                                <a class="btn btn-danger confimationDelete" data-localid="{{ $local->id }}" data-toggle="modal" data-target="#confimationDelete">Delete</a>
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
                <h5 class="modal-title" id="exampleModalLabel">Delete Local</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-right">
                <h3>you are sure??</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                <form id="local_id_delete_form" class="col-md-6" action="" method="post">
                    @csrf
                    
                    <button type="submit" class="btn btn-danger col-md-12">حذف</button>
                    <input type="hidden" name="_method" value="delete" />
                    <input id="local_id_delete" type="hidden" name="local_id" value="">
                </form>
            </div>
            </div>
        </div>
    </div>

@endsection
