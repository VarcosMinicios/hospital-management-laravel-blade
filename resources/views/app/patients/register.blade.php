@extends('main', ['navLink' => 'patients'])

@section('title', 'Cadastro de Pessoas')

@section('content')

    @include('app.patients.form', ['showButtons' => true])

@endsection

@section('scripts')

    <script src="{{asset('js/patients/register.js')}}" type="text/javascript"></script>

@endsection
