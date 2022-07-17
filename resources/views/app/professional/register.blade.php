@extends('main', ['navLink' => 'professionals'])

@section('title', 'Cadastro de Profissionais')

@section('content')

    <nav>
        <div class="nav nav-tabs mb-2" id="nav-tab" role="tablist">
            <a class="nav-link active" id="nav-personal-tab" data-bs-toggle="tab" data-bs-target="#tab-personal" role="button" aria-controls="tab-personal" aria-selected="true">Perfil Pessoal</a>
            <a class="nav-link" id="nav-professional-tab" data-bs-toggle="tab" data-bs-target="#tab-professional" role="button" aria-controls="tab-professional" aria-selected="false">Perfil Profissional</a>
        </div>
    </nav>

    <div class="tab-content" id="nav-professional">

        <div class="tab-pane fade show active" id="tab-personal" role="tabpanel" aria-labelledby="nav-personal-tab" tabindex="0">

            @include('app.patient.form', ['showButtons' => false, 'patient' => $professional ?? null])

            <div class="text-center">
                <a href="{{route('professional.index')}}" class="btn btn-secondary"><i class="bi bi-arrow-counterclockwise"></i> Voltar</a>
                <a class="btn btn-primary" x-data={} x-on:click="document.querySelector('#nav-professional-tab').click()"><i class="bi bi-arrow-right"></i> Avançar</a>
            </div>

        </div>

            <div class="tab-pane fade" id="tab-professional" role="tabpanel" aria-labelledby="nav-professional-tab" tabindex="0">

                @include('app.professional.form')

            </div>
    </div>

@endsection
