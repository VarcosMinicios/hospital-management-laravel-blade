<br>
<h3 class="fs-4 text-center">Informação Residencial</h3>
<hr>

<fieldset class="row">

    <x-field-group>
        <x-input name="cep" class="cep required" x-on:input="getCep(document.getElementById('cep').value)" disabled="{{isset($visualize)}}"
                 placeholder="Digite o CEP" label="CEP" icon="bi bi-geo-alt-fill" value="{{$patient->physicalPerson->address->cep ?? ''}}"/>
    </x-field-group>

    <x-field-group>
        <x-select name="state" label="Estado" class="required" icon="bi bi-flag-fill" disabled="{{isset($visualize)}}">
            @foreach ($states as $state)
            <option value="{{$state->abbreviation}}" {{isset($patient) && $patient->physicalPerson->address->state == $state->abbreviation ? 'selected' : ''}}>{{$state->description}}</option>
            @endforeach
        </x-select>
    </x-field-group>

    <x-field-group>
        <x-input name="city" placeholder="Digite a Cidade" class="required" disabled="{{isset($visualize)}}"
                 label="Cidade" icon="bi bi-pin-map-fill" value="{{$patient->physicalPerson->address->city ?? ''}}"/>
    </x-field-group>

</fieldset>

<fieldset class="row">

    <x-field-group>
        <x-input name="district" placeholder="Digite o Bairro" class="required" disabled="{{isset($visualize)}}"
                 label="Bairro" icon="bi bi-geo-alt-fill" value="{{$patient->physicalPerson->address->district ?? ''}}"/>
    </x-field-group>

    <x-field-group>
        <x-input name="type" placeholder="Tipo de Logradouro" class="required" disabled="{{isset($visualize)}}"
                 label="Tipo de Logradouro" icon="bi bi-geo-alt-fill" value="{{$patient->physicalPerson->address->type ?? ''}}"/>
    </x-field-group>

    <x-field-group colSize="6">
        <x-input name="street" placeholder="Digite o Endereço" class="required" disabled="{{isset($visualize)}}"
                 label="Logradouro" icon="bi bi-geo-alt-fill" value="{{$patient->physicalPerson->address->street ?? ''}}"/>
    </x-field-group>

</fieldset>

<fieldset class="row">

    <x-field-group>
        <x-input name="number" placeholder="Digite o Número" class="required" disabled="{{isset($visualize)}}"
                 label="Número" icon="bi bi-geo-alt-fill" value="{{$patient->physicalPerson->address->number ?? ''}}"/>
    </x-field-group>

    <x-field-group colSize="6">
        <x-input name="reference" placeholder="Digite a Referência" disabled="{{isset($visualize)}}"
                 label="Ponto de Referência" icon="bi bi-geo-alt-fill" value="{{$patient->physicalPerson->address->reference ?? ''}}"/>
    </x-field-group>

    <x-field-group>
        <x-input name="ibge_code" placeholder="Digite o Código" disabled="{{isset($visualize)}}"
                 label="Código IBGE" icon="bi bi-geo-alt-fill" value="{{$patient->physicalPerson->address->ibge_code ?? ''}}"/>
    </x-field-group>

</fieldset>


<fieldset class="row">
    <x-field-group>
        <x-input name="complement" placeholder="Digite o Complemento" disabled="{{isset($visualize)}}"
                 label="Complemento" icon="bi bi-geo-alt-fill" value="{{$patient->physicalPerson->address->complement ?? ''}}"/>
    </x-field-group>
</fieldset>
