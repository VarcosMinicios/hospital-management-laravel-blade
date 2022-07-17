@extends('main', ['navLink' => 'professionals'])

@section('title', 'Profissionais')

@section('content')

    @component('components.table', ['columns' => $columns, 'data' => $data, 'url' => route('professional.search'), 'prefix' => $prefix]) @endcomponent

    <div class="text-center">
        <a href="{{route('professional.create')}}" class="btn btn-primary">Cadastrar Profissional</a>
    </div>

@endsection
