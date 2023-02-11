<section>
    <form id="register_patient_form" data-type="submit" data-dependency="false" {{isset($patient)  && !isset($visualize) || !isset($visualize) ? 'method=POST' : ''}}
        action="{{isset($patient)  && !isset($visualize) ? route('patients.update', $patient->id) : route('patients.store')}}" autocomplete="off" >

        <fieldset id="form_inputs">

            @csrf

            @if(isset($patient) && !isset($visualize))
                @method('PUT')
            @endif

            <h3 class="fs-4 text-center">Informação Pessoal</h3>
            <hr>

            <fieldset class="row">

                <x-field-group>
                    <x-input name="cpf" class="cpf required" placeholder="Digite o CPF" disabled="{{isset($visualize)}}"
                            label="CPF" icon="bi bi-credit-card-fill" value="{{$patient->people->cpf ?? ''}}"/>
                </x-field-group>

                <x-field-group>
                    <x-input name="rg" placeholder="Digite o RG" disabled="{{isset($visualize)}}"
                            label="RG" icon="bi bi-credit-card-fill" value="{{$patient->people->rg ?? ''}}"/>
                </x-field-group>

            </fieldset>

            <fieldset class="row">

                <x-field-group>
                    <x-input name="name" class="required" placeholder="Digite o nome do paciente" disabled="{{isset($visualize)}}"
                            label="Nome" icon="bi bi-person-fill" value="{{$patient->name ?? ''}}"/>
                </x-field-group>

                <x-field-group colSize="5">
                    <x-input name="cns" class="cns" placeholder="Digite o CNS" disabled="{{isset($visualize)}}"
                            label="CNS" icon="bi bi-credit-card-fill" value="{{$patient->people->cns ?? ''}}"/>
                </x-field-group>

            </fieldset>


            <fieldset class="row">

                <x-field-group>
                    <x-input name="father_name" class="{{isset($people->father_unknown) && $people->father_unknown ? '' : 'required'}}"
                            placeholder="Digite o nome do pai" disabled="{{isset($visualize)}}" readonly="{{$people->father_unknown ?? 'false'}}"
                            label="Nome do Pai" icon="bi bi-person-fill" value="{{$patient->people->father_name ?? ''}}"/>
                </x-field-group>

                <x-field-group colSize="2">
                    <x-switch-toggle name="father_unknown" label="Pai Desconhecido" x-on:input="disableFather($el)"
                                    disabled="{{isset($visualize)}}" checked="{{$patient->people->father_unknown ?? false}}"/>
                </x-field-group>

                <x-field-group colSize="3">
                    <x-input name="birth_date" class="date required" placeholder="DD/MM/AAAA" disabled="{{isset($visualize)}}"
                            label="Data de Nascimento" icon="bi bi-calendar-fill" value="{{$patient->people->birth_date ?? ''}}"/>
                </x-field-group>

            </fieldset>

            <fieldset class="row">

                <x-field-group>
                    <x-input name="mother_name" class="required" placeholder="Digite o nome da Mãe" disabled="{{isset($visualize)}}"
                            label="Nome da Mãe" icon="bi bi-person-fill" value="{{$patient->people->mother_name ?? ''}}"/>
                </x-field-group>

                <x-field-group colSize="5">
                    <x-select name="gender" class="required" label="Sexo" icon="bi bi-gender-ambiguous" disabled="{{isset($visualize)}}">
                        <option value="masculino" {{isset($patient) && $patient->people->gender == "masculino" ? 'selected' : ''}}>Masculino</option>
                        <option value="feminino" {{isset($patient) && $patient->people->gender == "feminino" ? 'selected' : ''}}>Feminino</option>
                    </x-select>
                </x-field-group>

            </fieldset>

            <fieldset class="row">

                <x-field-group>
                    <x-select name="skin_color" class="required" label="Raça/Cor" icon="bi bi-person-fill" disabled="{{isset($visualize)}}">
                        @foreach ($skinColors as $skinColor)
                            <option value="{{$skinColor->description}}" {{isset($patient) && $patient->people->skin_color == $skinColor->description ? 'selected' : ''}}>{{$skinColor->description}}</option>
                        @endforeach
                    </x-select>
                </x-field-group>

                <x-field-group>
                    <x-input name="profession" class="required" placeholder="Digite a Profissão" disabled="{{isset($visualize)}}"
                            label="Profissão" icon="bi bi-briefcase-fill" value="{{$patient->people->profession ?? ''}}"/>
                </x-field-group>

                <x-field-group>
                    <x-select name="nationality" class="required" label="Nacionalidade" icon="bi bi-globe2" disabled="{{isset($visualize)}}">
                        @foreach ($nationalities as $nationality)
                            <option value="{{$nationality->description}}" {{isset($patient) && $patient->people->nationality == $nationality->description ? 'selected' : ''}}>{{$nationality->description}}</option>
                        @endforeach
                    </x-select>
                </x-field-group>

            </fieldset>

            <fieldset class="row">
                <x-field-group>
                    <x-input name="contact[]" type="email" placeholder="Digite o Email" disabled="{{isset($visualize)}}"
                            label="Email" icon="bi bi-envelope-fill"
                            value="{{isset($patient) && isset($patient->people->contacts) && $patient->people->getEmailAttribute() ? $patient->people->getEmailAttribute()->contact : ''}}"/>
                    <input class="visually-hidden" type="hidden" name="contact_type[]" value="0">
                </x-field-group>

                <x-field-group>
                    <x-input name="contact[]" class="phone" placeholder="Digite o Número" disabled="{{isset($visualize)}}"
                            label="Telefone Residencial" icon="bi bi-telephone-fill"
                            value="{{isset($patient) && isset($patient->people->contacts) && $patient->people->getPhoneAttribute() ? $patient->people->getPhoneAttribute()->contact : ''}}"/>
                    <input class="visually-hidden" type="hidden" name="contact_type[]" value="1">
                </x-field-group>

                <x-field-group>
                    <x-input name="contact[]" class="phone" placeholder="Digite o Número" disabled="{{isset($visualize)}}"
                            label="Telefone Celular" icon="bi bi-phone-fill"
                            value="{{isset($patient) && isset($patient->people->contacts) && $patient->people->getCellPhoneAttribute() ? $patient->people->getCellPhoneAttribute()->contact : ''}}"/>
                    <input class="visually-hidden" type="hidden" name="contact_type[]" value="2">
                </x-field-group>

            </fieldset>

            @include('address', ['people' => $patient->people ?? ''])

        </fieldset>

        @if (isset($showButtons) && $showButtons)
            <div class="text-center">
                <a href="{{route('patients.index')}}" class="btn btn-secondary"><i class="bi bi-arrow-counterclockwise"></i> Voltar</a>
                @if (!isset($visualize))
                    <x-submit-form/>
                @endif
            </div>
        @endif
    </form>
</section>
