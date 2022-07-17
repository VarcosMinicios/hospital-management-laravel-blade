<label for="{{$name}}" class="form-label pl-5">{{$label}} @if(str_contains($class, 'required')) * @endif</label>
<div class="input-group mb-3 {{$classDiv}}">
    <span class="input-group-text" id="basic-addon1"><i class="{{$icon}}"></i></span>
    <select
        {{ $attributes }}
        @if($isDisabled()) disabled @endif
        class="form-select text-uppercase {{$class}}"
        x-init="setSelect2($el, {{$isMultiple()}})"
        {{$multiple ? 'multiple="multiple"' : ''}}
        name="{{$name}}"
        id="{{ $id }}"
    >
        <option value="">SELECIONE</option>
        {{ $slot }}
    </select>
</div>
