@extends('main', ['navLink' => 'reception'])

@section('title', 'Recepção')

@section('content')

    @component('components.table', ['columns' => $columns, 'data' => $data, 'url' => route('reception.search'), 'prefix' => $prefix, 'modal' => true]) @endcomponent

    <div id="modal">

    </div>

    <div class="text-center">
        <a data-url="{{route('reception.create')}}" x-data={} x-on:click="loadModal($el)" class="btn btn-primary">Cadastrar</a>
    </div>

@endsection

@section('scripts')

    <script src="{{asset('js/reception/index.js')}}" type="text/javascript"></script>

@endsection
