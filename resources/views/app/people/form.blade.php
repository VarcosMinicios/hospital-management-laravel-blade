<section>
    <form id="register_people_form" data-type="submit" data-dependency="false" {{isset($people)  && !isset($visualize) || !isset($visualize) ? 'method=POST' : ''}}
        data-route="{{isset($people) && !isset($visualize) ? route('people.update', $people->id) : route('people.store')}}"
        action="{{isset($people)  && !isset($visualize) ? route('people.update', $people->id) : route('people.store')}}" autocomplete="off" >

        <fieldset id="form_inputs">

            @csrf

            @if(isset($people) && !isset($visualize))
                @method('PUT')
            @endif

            <h3 class="fs-4 text-center">Informação Pessoal</h3>
            <hr>

            <fieldset class="row">

                <x-field-group>
                    <x-input name="cpf" class="cpf required" placeholder="Digite o CPF" disabled="{{isset($visualize)}}"
                            label="CPF" icon="bi bi-credit-card-fill" value="{{$people->cpf ?? ''}}"/>
                </x-field-group>

                <x-field-group>
                    <x-input name="rg" placeholder="Digite o RG" disabled="{{isset($visualize)}}"
                            label="RG" icon="bi bi-credit-card-fill" value="{{$people->rg ?? ''}}"/>
                </x-field-group>

            </fieldset>

            <fieldset class="row">

                <x-field-group>
                    <x-input name="name" class="required" placeholder="Digite o nome do paciente" disabled="{{isset($visualize)}}"
                            label="Nome" icon="bi bi-person-fill" value="{{$people->name ?? ''}}"/>
                </x-field-group>

                <x-field-group colSize="5">
                    <x-input name="cns" class="cns" placeholder="Digite o CNS" disabled="{{isset($visualize)}}"
                            label="CNS" icon="bi bi-credit-card-fill" value="{{$people->cns ?? ''}}"/>
                </x-field-group>

            </fieldset>


            <fieldset class="row">

                <x-field-group>
                    <x-input name="father_name" class="{{isset($people->father_unknown) && $people->father_unknown ? '' : 'required'}}"
                            placeholder="Digite o nome do pai" disabled="{{isset($visualize)}}" readonly="{{$people->father_unknown ?? 'false'}}"
                            label="Nome do Pai" icon="bi bi-person-fill" value="{{$people->father_name ?? ''}}"/>
                </x-field-group>

                <x-field-group colSize="2">
                    <x-switch-toggle name="father_unknown" label="Pai Desconhecido" x-on:input="disableFather($el)"
                                    disabled="{{isset($visualize)}}" checked="{{$people->father_unknown ?? false}}"/>
                </x-field-group>

                <x-field-group colSize="3">
                    <x-input name="born_date" class="date required" placeholder="DD/MM/AAAA" disabled="{{isset($visualize)}}"
                            label="Data de Nascimento" icon="bi bi-calendar-fill" value="{{$people->born_date ?? ''}}"/>
                </x-field-group>

            </fieldset>

            <fieldset class="row">

                <x-field-group>
                    <x-input name="mother_name" class="required" placeholder="Digite o nome da Mãe" disabled="{{isset($visualize)}}"
                            label="Nome da Mãe" icon="bi bi-person-fill" value="{{$people->mother_name ?? ''}}"/>
                </x-field-group>

                <x-field-group colSize="5">
                    <x-select name="gender" class="required" label="Sexo" icon="bi bi-gender-ambiguous" disabled="{{isset($visualize)}}">
                        <option value="masculino" {{isset($people) && $people->gender == "Masculino" ? 'selected' : ''}}>Masculino</option>
                        <option value="feminino" {{isset($people) && $people->gender == "Feminino" ? 'selected' : ''}}>Feminino</option>
                    </x-select>
                </x-field-group>

            </fieldset>

            <fieldset class="row">

                <x-field-group>
                    <x-select name="skin_color" class="required" label="Raça/Cor" icon="bi bi-person-fill" disabled="{{isset($visualize)}}">
                        @foreach ($skinColors as $skinColor)
                            <option value="{{$skinColor->description}}" {{isset($people) && $people->skinColor == $skinColor->description ? 'selected' : ''}}>{{$skinColor->description}}</option>
                        @endforeach
                    </x-select>
                </x-field-group>

                <x-field-group>
                    <x-input name="profession" class="required" placeholder="Digite a Profissão" disabled="{{isset($visualize)}}"
                            label="Profissão" icon="bi bi-briefcase-fill" value="{{$people->profession ?? ''}}"/>
                </x-field-group>

                <x-field-group>
                    <x-select name="nationality" class="required" label="Nacionalidade" icon="bi bi-globe2" disabled="{{isset($visualize)}}">
                        @foreach ($nationalities as $nationality)
                            <option value="{{$nationality->description}}" {{isset($people) && $people->nationality == $nationality->description ? 'selected' : ''}}>{{$nationality->description}}</option>
                        @endforeach
                    </x-select>
                </x-field-group>

            </fieldset>

            <fieldset class="row">

                <x-field-group>
                    <x-input name="contact[]" type="email" placeholder="Digite o Email" disabled="{{isset($visualize)}}"
                            label="Email" icon="bi bi-envelope-fill"
                            value="{{isset($people) && isset($people->contacts[0]) ? $people->contacts[0]->type == 'E-mail' ? $people->contacts[0]->contact : '' : ''}}"/>
                    <input class="visually-hidden" type="hidden" name="contact_type[]" value="E-mail">
                </x-field-group>

                <x-field-group>
                    <x-input name="contact[]" class="phone" placeholder="Digite o Número" disabled="{{isset($visualize)}}"
                            label="Telefone Residencial" icon="bi bi-telephone-fill"
                            value="{{isset($people) && isset($people->contacts[1]) ? $people->contacts[1]->type == 'Telefone' ? $people->contacts[1]->contact : '' : ''}}"/>
                    <input class="visually-hidden" type="hidden" name="contact_type[]" value="Telefone">
                </x-field-group>

                <x-field-group>
                    <x-input name="contact[]" class="phone" placeholder="Digite o Número" disabled="{{isset($visualize)}}"
                            label="Telefone Celular" icon="bi bi-phone-fill"
                            value="{{isset($people) && isset($people->contacts[2]) ? $people->contacts[2]->type == 'Celular' ? $people->contacts[2]->contact : '' : ''}}"/>
                    <input class="visually-hidden" type="hidden" name="contact_type[]" value="Celular">
                </x-field-group>

            </fieldset>

            @include('address')

        </fieldset>

        @if (isset($showButtons) && $showButtons)
            <div class="text-center">
                <a href="{{route('people.index')}}" class="btn btn-secondary"><i class="bi bi-arrow-counterclockwise"></i> Voltar</a>
                @if (!isset($visualize))
                    <x-submit-form/>
                @endif
            </div>
        @endif
    </form>
</section>
