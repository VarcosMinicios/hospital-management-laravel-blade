@extends('main', ['navLink' => 'patients'])

@section('title', 'Pacientes')

@section('content')

    @component('components.table', [
        'columns' => $columns,
        'data' => $data,
        'url' => route('patients.search'),
        'prefix' => $prefix,
        'urlPaginate' => route('patients.paginate'),
        'totalRecords' => $totalRecords,
        'length' => $length,
        'offset' => $offset,
        'totalPages' => $totalPages,
    ]) @endcomponent

    <div class="text-center">
        <a href="{{route('patients.create')}}" class="btn btn-primary">Cadastrar Paciente</a>
    </div>

@endsection
