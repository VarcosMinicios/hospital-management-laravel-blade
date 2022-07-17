<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
</button>

{{-- data-bs-backdrop="static" data-bs-keyboard="false" --}}

<div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content shadow">
            <div class="modal-header mb-1">
                <h5 class="modal-title" id="modalTitle">Cadastrar Recepção</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <section class="m-3">
                    <form id="register_reception_form" data-type="submit"
                        data-route=""
                        action=""
                        autocomplete="off">

                        @csrf

                        <h3 class="fs-4 text-center">Pesquisar Paciente</h3>
                        <hr>

                        <fieldset class="row">

                            <x-field-group>
                                <x-input name="cpf" class="cpf" placeholder="Digite o CPF" disabled="{{isset($visualize)}}"
                                         label="CPF" icon="bi bi-credit-card-fill"/>
                            </x-field-group>

                            <x-field-group>
                                <x-input name="cns" class="cns" placeholder="Digite o CNS" disabled="{{isset($visualize)}}"
                                         label="CNS" icon="bi bi-credit-card-fill"/>
                            </x-field-group>

                            <x-field-group>
                                <x-input name="chart" placeholder="Prontuário" disabled="{{isset($visualize)}}"
                                         label="Prontuário" icon="bi bi-credit-card-fill"/>
                            </x-field-group>

                        </fieldset>

                        <fieldset class="row">

                            <x-field-group>
                                <x-input name="name" placeholder="Digite o nome do paciente" disabled="{{isset($visualize)}}"
                                         label="Nome" icon="bi bi-person-fill"/>
                            </x-field-group>

                            <x-field-group>
                                <x-input name="mother_name" placeholder="Digite o nome da mãe do paciente" disabled="{{isset($visualize)}}"
                                         label="Nome da Mãe" icon="bi bi-person-fill"/>
                            </x-field-group>

                        </fieldset>
                    </form>
                </section>
            </div>

            <div class="modal-footer">
                <div class="text-center">
                    <a href="{{route('patient.index')}}" class="btn btn-secondary"><i class="bi bi-arrow-counterclockwise"></i> Voltar</a>
                    @if (!isset($visualize))
                        <x-submit-form/>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
