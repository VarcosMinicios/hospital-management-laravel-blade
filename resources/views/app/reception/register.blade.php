<div class="modal" id="modal-reception" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">

    <div class="modal-dialog modal-xl" role="document">

        <div class="modal-content shadow">

            <div class="modal-header ms-2 me-2">

                <h5 class="fw-bold fs-4 modal-title ms-3">Cadastrar Recepção</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body">

                <section class="m-3">

                    <form id="register_reception_form" data-type="post" autocomplete="off" data-dependency="false" {{isset($reception)  && !isset($visualize) || !isset($visualize) ? 'method=POST' : ''}}
                        data-route="{{isset($reception) && !isset($visualize) ? route('reception.update', $reception->id) : route('reception.store')}}" >

                        @csrf

                        @if(isset($reception) && !isset($visualize))
                            @method('PUT')
                        @endif

                        <fieldset class="row">

                            <x-field-group>
                                <x-input name="cpf" class="cpf required" x-on:input="getPatient($el)" placeholder="Digite o CPF" disabled="{{isset($visualize)}}"
                                        label="CPF" icon="bi bi-credit-card-fill" data-url="{{route('people.getPatient')}}" value="{{$reception->people->cpf ?? ''}}"/>
                            </x-field-group>

                            <input type="hidden" id="patient_id" name="patient_id" value="{{$reception->people ?? ''}}">

                            <x-field-group>
                                <x-input name="cns" class="cns" placeholder="Digite o CNS" disabled="{{isset($visualize)}}"
                                        label="CNS" icon="bi bi-credit-card-fill" value="{{$reception->people->cns ?? ''}}"/>
                            </x-field-group>

                            <x-field-group>
                                <x-input name="chart" class="required" placeholder="Prontuário" disabled="{{isset($visualize)}}"
                                        label="Prontuário" icon="bi bi-credit-card-fill" value="{{$reception->chart ?? ''}}"/>
                            </x-field-group>

                        </fieldset>

                        <fieldset class="row">

                            <x-field-group>
                                <x-input name="name" class="required" placeholder="Digite o nome do paciente" disabled="{{isset($visualize)}}"
                                        label="Nome" icon="bi bi-person-fill" value="{{$reception->people->name ?? ''}}"/>
                            </x-field-group>

                            <x-field-group>
                                <x-input name="mother_name" class="required" placeholder="Digite o nome da mãe do paciente" disabled="{{isset($visualize)}}"
                                        label="Nome da Mãe" icon="bi bi-person-fill" value="{{$reception->people->mother_name ?? ''}}"/>
                            </x-field-group>

                        </fieldset>

                        <fieldset class="row">

                            <x-field-group>
                                <x-select name="professional_id" class="required" label="Profissional" icon="bi bi-globe2" disabled="{{isset($visualize)}}">
                                    @foreach ($professionals as $professional)
                                        <option value="{{$professional->id}}" {{isset($reception) && $reception->professional_id == $professional->id ? 'selected' : ''}}>{{$professional->name}}</option>
                                    @endforeach
                                </x-select>
                            </x-field-group>

                            <x-field-group>
                                <x-select name="doctor_id" class="required" label="Médico Assistente" icon="bi bi-globe2" disabled="{{isset($visualize)}}">
                                    @foreach ($doctors as $doctor)
                                        <option value="{{$doctor->id}}" {{isset($reception) && $reception->doctor_id == $doctor->id ? 'selected' : ''}}>{{$doctor->name}}</option>
                                    @endforeach
                                </x-select>
                            </x-field-group>

                        </fieldset>

                        <fieldset class="row">

                            <x-field-group>
                                <x-input name="security_deposit" class="required" placeholder="Valor de depósito" disabled="{{isset($visualize)}}"
                                        label="Depósito Calção" icon="bi bi-person-fill" value="{{$reception->security_deposit ?? ''}}"/>
                            </x-field-group>

                            <x-field-group>
                                <x-input name="admission_date" class="date today required" placeholder="DD/MM/AAAA" disabled="{{isset($visualize)}}"
                                        label="Data de Admissão" icon="bi bi-person-fill" value="{{$reception->admission_date ?? ''}}"/>
                            </x-field-group>

                            <x-field-group>
                                <x-select name="clinic" class="required" label="Clínica de Internação" icon="bi bi-globe2" disabled="{{isset($visualize)}}">
                                    @foreach ($clinics as $clinic)
                                        <option value="{{$clinic}}" {{isset($reception) && $reception->clinic == $clinic ? 'selected' : ''}}>{{$clinic}}</option>
                                    @endforeach
                                </x-select>
                            </x-field-group>

                            <x-field-group>
                                <x-select name="dependency" class="required" label="Dependência" icon="bi bi-globe2" disabled="{{isset($visualize)}}">
                                    @foreach ($dependencies as $dependency)
                                        <option value="{{$dependency}}" {{isset($reception) && $reception->dependency == $dependency ? 'selected' : ''}}>{{$dependency}}</option>
                                    @endforeach
                                </x-select>
                            </x-field-group>

                        </fieldset>

                        <hr>

                        <div class="text-center col-md-12 mt-3">
                            <a data-bs-dismiss="modal" class="btn btn-secondary"><i class="bi bi-arrow-counterclockwise"></i> Voltar</a>
                            @if (!isset($visualize))
                                <x-submit-form/>
                            @endif
                        </div>

                    </form>

                </section>

            </div>

        </div>
    </div>
</div>
