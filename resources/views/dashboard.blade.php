@extends('layouts.master')

@section('content')
{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                     </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}


<div class="container">
    <a class="btn btn-success" href="{{ route('moteurs.index') }}">MOTEURS</a>
                    <a class="btn btn-success" href="{{ route('ots.index') }}">OTS</a>
                    <a class="btn btn-success" href="{{ route('rapports.index') }}">RAPPORTS</a>
                    <a class="btn btn-success" href="{{ route('unites.index') }}">UNITES</a>
                    <a class="btn btn-success" href="{{ route('marques.index') }}">MARQUES</a>
                    <a class="btn btn-success" href="{{ route('locals.index') }}">LOCAUX</a>
                    <a class="btn btn-success" href="{{ route('agents.index') }}">AGENTS</a>

    <div class="row p-3">
        <div class="col-4">
            <div class="card">
                OTS COUNT
            {{ $otsCount }}
            </div>
        </div>

        <div class="col-4">
            <div class="card">
                MOTEURS COUNT
            {{ $moteursCount }}
            </div>
        </div>
    </div>


  <!-- Chart's container -->
    <div id="chart" style="height: 300px;"></div>
    <!-- Charting library -->
    <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
    <!-- Your application script -->
    <script>
      const chart = new Chartisan({
        el: '#chart',
        url: "@chart('ot_chart')",
      });
    </script> 
               
</div>
@endsection