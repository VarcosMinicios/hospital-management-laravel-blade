@extends('main', ['navLink' => 'peoples'])

@section('title', 'Cadastro de Pessoas')

@section('content')

    @include('app.people.form', ['showButtons' => true])

@endsection

@section('scripts')

    <script src="{{asset('js/people/register.js')}}" type="text/javascript"></script>

@endsection
