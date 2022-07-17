<section>
    <form id="register_professional_form" data-type="submit" autocomplete="off" data-dependency="true" {{isset($professional)  && !isset($visualize) || !isset($visualize) ? 'method=POST' : ''}}
        data-route="{{isset($professional) && !isset($visualize) ? route('professional.update', $professional->id) : route('professional.store')}}"
        action="{{isset($professional)  && !isset($visualize) ? route('professional.update', $professional->id) : route('professional.store')}}" >

        <fieldset id="form_inputs">

            @csrf

            @if(isset($professional) && !isset($visualize))
                @method('PUT')
            @endif

            <h3 class="fs-4 text-center">Informação Profissional</h3>
            <hr>

            <fieldset class="row">

                <x-field-group>
                    {{-- //TODO: implement select --}}
                    <x-input name="sector" class="required" placeholder="Digite o setor" disabled="{{isset($visualize)}}"
                            label="Setor de Trabalho" icon="bi bi-credit-card-fill" value="{{$professional->sector ?? ''}}"/>
                </x-field-group>

                <x-field-group>
                    <x-input name="role" class="required" placeholder="Digite o cargo de trabalho" disabled="{{isset($visualize)}}"
                            label="Cargo" icon="bi bi-person-fill" value="{{$professional->role ?? ''}}"/>
                </x-field-group>

                <x-field-group colSize="2">
                    <x-input name="workload" type="time" disabled="{{isset($visualize)}}"
                            label="Carga Horária" icon="bi bi-credit-card-fill" value="{{$professional->workload ?? ''}}"/>
                </x-field-group>

            </fieldset>

            <fieldset class="row">

                {{-- //TODO: implement select --}}
                <x-field-group>
                    <x-input name="class_council" placeholder="Digite o Conselho de classe" disabled="{{isset($visualize)}}"
                            label="Conselho de Classe" icon="bi bi-credit-card-fill" value="{{$professional->class_council ?? ''}}"/>
                </x-field-group>

                <x-field-group>
                    <x-input name="register_number" placeholder="Digite o número de registro" disabled="{{isset($visualize)}}"
                            label="Registro de conselho" icon="bi bi-credit-card-fill" value="{{$professional->register_number ?? ''}}"/>
                </x-field-group>

            </fieldset>

            <fieldset class="row">

                <x-field-group>
                    <x-input name="admission_date" class="date required" placeholder="DD/MM/AAAA" disabled="{{isset($visualize)}}"
                            label="Data de Admissão" icon="bi bi-person-fill" value="{{$professional->admission_date ?? ''}}"/>
                </x-field-group>

                <x-field-group>
                    <x-input name="discharge_date" class="date" placeholder="DD/MM/AAAA" disabled="{{isset($visualize)}}"
                            label="Data de Demissão" icon="bi bi-person-fill" value="{{$professional->discharge_date ?? ''}}"/>
                </x-field-group>

            </fieldset>

        </fieldset>

        <div class="text-center">
            <a class="btn btn-secondary" x-data={} x-on:click="document.querySelector('#nav-personal-tab').click()"><i class="bi bi-arrow-left"></i> Retornar</a>
            @if (!isset($visualize))
                <x-submit-form/>
            @endif
        </div>
    </form>
</section>
