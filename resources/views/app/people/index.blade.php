@extends('main', ['navLink' => 'patients'])

@section('title', 'Pacientes')

@section('content')

    @component('components.table', ['columns' => $columns, 'data' => $data, 'url' => route('people.search'), 'prefix' => $prefix]) @endcomponent

    <div class="text-center">
        <a href="{{route('people.create')}}" class="btn btn-primary">Cadastrar Paciente</a>
    </div>

@endsection
